<?php
// index.php - Punto de entrada principal
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Manejar solicitudes OPTIONS para CORS
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    http_response_code(200);
    exit;
}

// Obtener la ruta de la URL (compatible con PHP built-in server)
$request_uri = $_SERVER["REQUEST_URI"];
// Eliminar parámetros de consulta si existen
if (false !== $pos = strpos($request_uri, '?')) {
    $request_uri = substr($request_uri, 0, $pos);
}
$uri_parts = explode("/", trim($request_uri, "/"));
$route = isset($uri_parts[0]) ? $uri_parts[0] : "";
$id = isset($uri_parts[1]) ? $uri_parts[1] : null;

// Incluir archivos de utilidades
require_once "utils/Response.php";
require_once "utils/Database.php";
require_once "controllers/ProductController.php";
require_once "controllers/UserController.php";

// Enrutamiento básico
try {
    switch ($route) {
        case "":
            // Ruta principal - Información de la API
            Response::json([
                "status" => "success",
                "message" => "API PHP para Railway funcionando correctamente",
                "version" => "1.0.0",
                "endpoints" => [
                    "/products" => "GET - Obtener todos los productos",
                    "/products/{id}" => "GET - Obtener un producto por ID",
                    "/products" => "POST - Crear un nuevo producto",
                    "/users" => "GET - Obtener todos los usuarios",
                    "/users/{id}" => "GET - Obtener un usuario por ID",
                    "/users" => "POST - Crear un nuevo usuario"
                ]
            ]);
            break;

        case "products":
            $controller = new ProductController();
            
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if ($id) {
                    $controller->getById($id);
                } else {
                    $controller->getAll();
                }
            } 
            else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->create($data);
            } 
            else {
                Response::error("Método no permitido", 405);
            }
            break;

        case "users":
            $controller = new UserController();
            
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if ($id) {
                    $controller->getById($id);
                } else {
                    $controller->getAll();
                }
            } 
            else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->create($data);
            } 
            else {
                Response::error("Método no permitido", 405);
            }
            break;

        default:
            Response::error("Ruta no encontrada", 404);
            break;
    }
} catch (Exception $e) {
    Response::error($e->getMessage(), 500);
}
?>