<?php
// utils/Response.php - Clase para manejar respuestas HTTP

class Response
{
    /**
     * Envía una respuesta JSON con éxito
     * @param mixed $data Datos a enviar
     * @param int $status Código de estado HTTP
     */
    public static function json($data, $status = 200)
    {
        http_response_code($status);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Envía una respuesta de error
     * @param string $message Mensaje de error
     * @param int $status Código de estado HTTP
     */
    public static function error($message, $status = 400)
    {
        http_response_code($status);
        echo json_encode([
            "status" => "error",
            "message" => $message
        ], JSON_PRETTY_PRINT);
        exit;
    }
}
