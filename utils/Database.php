<?php
// utils/Database.php - Simulación de una base de datos para pruebas

class Database {
    private static $products = [
        ["id" => 1, "name" => "Laptop HP", "price" => 899.99, "stock" => 15],
        ["id" => 2, "name" => "Monitor LG", "price" => 249.99, "stock" => 30],
        ["id" => 3, "name" => "Teclado Logitech", "price" => 59.99, "stock" => 50]
    ];
    
    private static $users = [
        ["id" => 1, "name" => "Juan Pérez", "email" => "juan@ejemplo.com", "role" => "admin"],
        ["id" => 2, "name" => "María García", "email" => "maria@ejemplo.com", "role" => "user"]
    ];
    
    /**
     * Obtiene todos los productos
     */
    public static function getAllProducts() {
        return self::$products;
    }
    
    /**
     * Obtiene un producto por ID
     */
    public static function getProductById($id) {
        foreach (self::$products as $product) {
            if ($product["id"] == $id) {
                return $product;
            }
        }
        return null;
    }
    
    /**
     * Crea un nuevo producto
     */
    public static function createProduct($data) {
        // Genera un ID único (en una aplicación real, esto lo haría la base de datos)
        $newId = count(self::$products) + 1;
        
        $newProduct = [
            "id" => $newId,
            "name" => $data["name"] ?? "Producto sin nombre",
            "price" => $data["price"] ?? 0,
            "stock" => $data["stock"] ?? 0
        ];
        
        self::$products[] = $newProduct;
        return $newProduct;
    }
    
    /**
     * Obtiene todos los usuarios
     */
    public static function getAllUsers() {
        return self::$users;
    }
    
    /**
     * Obtiene un usuario por ID
     */
    public static function getUserById($id) {
        foreach (self::$users as $user) {
            if ($user["id"] == $id) {
                return $user;
            }
        }
        return null;
    }
    
    /**
     * Crea un nuevo usuario
     */
    public static function createUser($data) {
        // Genera un ID único
        $newId = count(self::$users) + 1;
        
        $newUser = [
            "id" => $newId,
            "name" => $data["name"] ?? "Usuario sin nombre",
            "email" => $data["email"] ?? "sin@email.com",
            "role" => $data["role"] ?? "user"
        ];
        
        self::$users[] = $newUser;
        return $newUser;
    }
}
?>