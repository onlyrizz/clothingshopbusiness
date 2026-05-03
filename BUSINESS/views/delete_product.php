<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ProductController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new ProductController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $controller->deleteProductByName($name);
    echo "<p style='color:green;font-weight:bold;'>Product deleted successfully!</p>";
}
?>

<form method="POST">
    <label>Product Name to Delete:</label>
    <input type="text" name="product_name" placeholder="shirt, hoodie, short" required>
    <button type="submit">Delete Product</button>
</form>
