<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Cliente mínimo para la API de Google Gemini (generateContent).
 *
 * Prueba varios modelos en orden: si uno está saturado (503), con límite (429)
 * o tarda demasiado, pasa al siguiente. Los primeros son modelos livianos y
 * rápidos, suficientes para textos cortos de venta.
 *
 * IMPORTANTE (Ley 1581 de 2012): en el plan gratuito, Google puede usar lo que
 * se le envía para mejorar sus productos. Nunca enviar datos personales
 * (nombres, teléfonos, correos, direcciones, pedidos): solo información del producto.
 */
class GeminiService
{
    /** Segundos máximos de espera por cada modelo. */
    private const TIMEOUT_PER_MODEL = 15;

    /** Segundos máximos en total, sumando todos los intentos. */
    private const TOTAL_BUDGET = 40;

    public function isConfigured(): bool
    {
        return filled(config('services.gemini.key'));
    }

    /**
     * Devuelve el texto generado o null si ningún modelo respondió.
     */
    public function generate(string $systemInstruction, string $prompt): ?string
    {
        if (! $this->isConfigured()) {
            return null;
        }

        // Evita que PHP corte la petición antes de terminar los intentos
        @set_time_limit(60);

        $start = microtime(true);

        foreach ($this->models() as $model) {
            $remaining = self::TOTAL_BUDGET - (microtime(true) - $start);
            if ($remaining < 5) {
                break;
            }

            $text = $this->tryModel($model, $systemInstruction, $prompt, (int) min(self::TIMEOUT_PER_MODEL, $remaining));

            if ($text !== null) {
                return $text;
            }
        }

        return null;
    }

    /**
     * Lista de modelos a probar, en orden (configurable con GEMINI_MODELS).
     */
    private function models(): array
    {
        $models = config('services.gemini.models');

        if (is_string($models)) {
            $models = explode(',', $models);
        }

        return array_values(array_filter(array_map('trim', (array) $models)));
    }

    private function tryModel(string $model, string $systemInstruction, string $prompt, int $timeout): ?string
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        try {
            $response = Http::timeout($timeout)
                ->connectTimeout(5)
                ->withHeaders(['x-goog-api-key' => config('services.gemini.key')])
                ->post($url, [
                    'systemInstruction' => [
                        'parts' => [['text' => $systemInstruction]],
                    ],
                    'contents' => [
                        ['role' => 'user', 'parts' => [['text' => $prompt]]],
                    ],
                    'generationConfig' => $this->generationConfig($model),
                ]);

            if ($response->failed()) {
                Log::warning('Gemini API error', [
                    'model' => $model,
                    'status' => $response->status(),
                    'message' => $response->json('error.message') ?? substr($response->body(), 0, 300),
                ]);

                return null;
            }

            $parts = $response->json('candidates.0.content.parts', []);
            // Se ignoran las partes de "razonamiento" del modelo (thought = true)
            $text = trim(collect($parts)->reject(fn ($p) => ! empty($p['thought']))->pluck('text')->filter()->implode(''));

            if ($text === '') {
                Log::warning('Gemini API respuesta vacía', [
                    'model' => $model,
                    'finishReason' => $response->json('candidates.0.finishReason'),
                ]);

                return null;
            }

            return $text;
        } catch (\Throwable $e) {
            Log::warning('Gemini API exception', ['model' => $model, 'message' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * Configuración de generación con el menor "razonamiento" posible para cada familia de modelos:
     * son textos cortos y no necesitan pensar mucho.
     */
    private function generationConfig(string $model): array
    {
        $config = [
            'temperature' => 0.7,
            // Incluye los tokens de razonamiento: si es muy bajo, la respuesta puede salir vacía
            'maxOutputTokens' => 1024,
        ];

        if (str_starts_with($model, 'gemini-2.5')) {
            // En 2.5 se puede apagar el razonamiento por completo
            $config['thinkingConfig'] = ['thinkingBudget' => 0];
        } elseif (str_starts_with($model, 'gemini-3') && str_contains($model, 'flash-lite')) {
            $config['thinkingConfig'] = ['thinkingLevel' => 'minimal'];
        } elseif (str_starts_with($model, 'gemini-3')) {
            // Gemini 3 Flash no acepta 'minimal'; 'low' es lo más rápido
            $config['thinkingConfig'] = ['thinkingLevel' => 'low'];
        }

        return $config;
    }
}
