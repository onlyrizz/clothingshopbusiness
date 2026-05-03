<?php
class ProductController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addProduct($brand_id, $name, $category, $price, $added_by) {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (brand_id, product_name, category, price, added_by, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$brand_id, $name, $category, $price, $added_by]);
    }

    public function getProducts() {
        $stmt = $this->pdo->query("
            SELECT p.*, u.first_name AS added_by_name, u2.first_name AS updated_by_name
            FROM products p
            LEFT JOIN users u ON p.added_by = u.id
            LEFT JOIN users u2 ON p.last_updated_by = u2.id
            ORDER BY p.product_id DESC
        ");
        return $stmt->fetchAll();
    }

    public function updateProduct($id, $name, $category, $price, $user_id) {
        $stmt = $this->pdo->prepare("
            UPDATE products
            SET product_name=?, category=?, price=?, last_updated_by=?, last_updated=NOW()
            WHERE product_id=?
        ");
        $stmt->execute([$name, $category, $price, $user_id, $id]);
    }

    public function deleteProductByName($name) {
        $stmt = $this->pdo->prepare("
            DELETE FROM products 
            WHERE product_name = ?
        ");
        $stmt->execute([$name]);
    }
}
?>
