<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Asistente de IA para las emprendedoras.
 * Solo recibe información del producto; nunca datos personales.
 */
class AiController extends Controller
{
    public function productText(Request $request, GeminiService $gemini): JsonResponse
    {
        $validated = $request->validate([
            'type'    => 'required|in:descripcion,publicacion',
            'name'    => 'required|string|max:120',
            'details' => 'nullable|string|max:1000',
            'price'   => 'nullable|string|max:20',
        ], [
            'name.required' => 'Primero escribe el nombre del producto.',
        ]);

        if (! $gemini->isConfigured()) {
            return response()->json([
                'message' => 'El asistente de IA no está disponible en este momento.',
            ], 503);
        }

        $system = 'Eres un asistente que ayuda a mujeres emprendedoras colombianas a vender sus productos. '
            . 'Escribes en español de Colombia, con un tono cercano, claro y positivo. '
            . 'No inventes características, materiales, medidas ni beneficios que no aparezcan en la información recibida. '
            . 'No incluyas datos de contacto, precios inventados ni enlaces. Responde solo con el texto final, sin títulos ni explicaciones.';

        $info = "Producto: {$validated['name']}";
        if (! empty($validated['details'])) {
            $info .= "\nInformación que dio la emprendedora: {$validated['details']}";
        }
        if (! empty($validated['price'])) {
            $info .= "\nPrecio: \${$validated['price']} pesos colombianos";
        }

        $prompt = $validated['type'] === 'descripcion'
            ? "Escribe una descripción atractiva para este producto en una tienda en línea, de máximo 80 palabras.\n\n{$info}"
            : "Escribe un texto corto para publicar este producto en el estado de WhatsApp o en Instagram, de máximo 50 palabras, con 2 o 3 emojis y una invitación a comprar. Si hay precio, inclúyelo.\n\n{$info}";

        $text = $gemini->generate($system, $prompt);

        if ($text === null) {
            return response()->json([
                'message' => 'No pudimos generar el texto. Intenta de nuevo en unos minutos.',
            ], 502);
        }

        return response()->json(['text' => $text]);
    }
}
