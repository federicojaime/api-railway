<?php
// controllers/ProductController.php - Controlador para productos

class ProductController
{
    /**
     * Obtiene todos los productos
     */
    public function getAll()
    {
        $products = Database::getAllProducts();
        Response::json([
            "status" => "success",
            "data" => $products,
            "count" => count($products)
        ]);
    }

    /**
     * Obtiene un producto por ID
     */
    public function getById($id)
    {
        $product = Database::getProductById($id);

        if (!$product) {
            Response::error("Producto no encontrado", 404);
        }

        Response::json([
            "status" => "success",
            "data" => $product
        ]);
    }

    /**
     * Crea un nuevo producto
     */
    public function create($data)
    {
        // Validaciones básicas
        if (!isset($data["name"]) || empty($data["name"])) {
            Response::error("El nombre del producto es requerido");
        }

        if (!isset($data["price"]) || !is_numeric($data["price"])) {
            Response::error("El precio debe ser un número válido");
        }

        $newProduct = Database::createProduct($data);

        Response::json([
            "status" => "success",
            "message" => "Producto creado correctamente",
            "data" => $newProduct
        ], 201);
    }
}
