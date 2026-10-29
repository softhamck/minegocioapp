<?php

namespace App\Support;

/**
 * Utilidades para manejar valores en pesos colombianos (COP).
 */
class Money
{
    /**
     * Formatea un valor como pesos colombianos: 80600 -> "$80.600".
     */
    public static function cop($value): string
    {
        return '$' . number_format((float) $value, 0, ',', '.');
    }

    /**
     * Formatea un valor para mostrarlo dentro de un campo de formulario: 80600 -> "80.600".
     */
    public static function input($value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        return number_format((float) $value, 0, ',', '.');
    }

    /**
     * Convierte lo que escribe la usuaria a un número válido.
     *
     * Acepta el formato colombiano, donde el punto separa miles y la coma decimales:
     *   "80.600"     -> 80600
     *   "$ 1.250.000" -> 1250000
     *   "80.600,50"  -> 80600.50
     *   "80600"      -> 80600
     */
    public static function parse($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $negative = str_contains((string) $value, '-');
        $clean = preg_replace('/[^\d.,]/', '', (string) $value);

        if ($clean === '') {
            return null;
        }

        if (str_contains($clean, ',')) {
            // La coma es el separador decimal; los puntos son de miles.
            $clean = str_replace('.', '', $clean);
            $clean = str_replace(',', '.', $clean);
        } elseif (preg_match('/^\d{1,3}(\.\d{3})+$/', $clean)) {
            // "80.600" o "1.250.000": los puntos son separadores de miles.
            $clean = str_replace('.', '', $clean);
        }

        if (! is_numeric($clean)) {
            return null;
        }

        // Se conserva el signo para que la validación (min:0) rechace precios negativos
        return $negative ? '-' . $clean : $clean;
    }
}
