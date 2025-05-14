<?php
// controllers/UserController.php - Controlador para usuarios

class UserController
{
    /**
     * Obtiene todos los usuarios
     */
    public function getAll()
    {
        $users = Database::getAllUsers();
        Response::json([
            "status" => "success",
            "data" => $users,
            "count" => count($users)
        ]);
    }

    /**
     * Obtiene un usuario por ID
     */
    public function getById($id)
    {
        $user = Database::getUserById($id);

        if (!$user) {
            Response::error("Usuario no encontrado", 404);
        }

        Response::json([
            "status" => "success",
            "data" => $user
        ]);
    }

    /**
     * Crea un nuevo usuario
     */
    public function create($data)
    {
        // Validaciones básicas
        if (!isset($data["name"]) || empty($data["name"])) {
            Response::error("El nombre del usuario es requerido");
        }

        if (!isset($data["email"]) || empty($data["email"])) {
            Response::error("El email es requerido");
        }

        // Validación simple de formato de email
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            Response::error("El formato del email no es válido");
        }

        $newUser = Database::createUser($data);

        Response::json([
            "status" => "success",
            "message" => "Usuario creado correctamente",
            "data" => $newUser
        ], 201);
    }
}
