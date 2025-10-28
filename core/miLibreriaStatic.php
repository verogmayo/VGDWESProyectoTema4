<?php

    /**
     * @author Véronique
     * @since 19/10/2025
     * 
     * Librería con funciones matemáticas creado una clase
     */
    class miLibreriaStatic {

        /**
         * Suma de dos números
         * @param float $a Primer número
         * @param float $b Segundo número
         * @return float Resultado de la suma
         */
        public static function sumar($a, $b) {
            return $a + $b;
        }

        /**
         * Resta dos números
         * @param float $a Primer número
         * @param float $b Segundo número
         * @return float Resultado de la resta
         */
        public static function restar($a, $b) {
            return $a - $b;
        }

        /**
         * Función para validar una pregunta de seguridad con valores predefinidos.
         *
         * @param string $respuestaSeguridad Valor introducido por el usuario.
         * @param array $aValoresValidos Lista de respuestas válidas permitidas.
         * @param bool $obligatorio Indica si el campo es obligatorio (1 si true, 0 si false).
         * @return string|null Devuelve mensaje de error si hay problema, o null si es válido.
         */
        
        public static function comprobarPreguntaSeguridad($respuestaSeguridad, $aValoresValidos, $obligatorio) {
            $mensajeError = null;
            
            // Elimina espacios en blanco al principio y al final
            $respuestaSeguridad = trim($respuestaSeguridad);

            // Si el campo es obligatorio y está vacío
            if ($obligatorio == 1 && empty($respuestaSeguridad)) {
                $mensajeError = "La pregunta de seguridad no puede estar vacía.";
            }

            // Si no está vacío y no coincide con ninguno de los valores válidos
            if (!empty($respuestaSeguridad) && !in_array($respuestaSeguridad, $aValoresValidos)) {
                $mensajeError = "La respuesta de seguridad es incorrecta.";
            }

            // Si todo está correcto
            return $mensajeError;
        }
    }

?>