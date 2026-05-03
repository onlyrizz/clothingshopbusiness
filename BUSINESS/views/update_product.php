<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ProductController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new ProductController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id       = $_POST['product_id'];
    $name     = $_POST['product_name'];
    $category = $_POST['category'];
    $price    = $_POST['price'];
    $user_id  = $_SESSION['user_id'];

    $controller->updateProduct($id, $name, $category, $price, $user_id);

    echo "<p style='color:green;font-weight:bold;'>Product updated successfully!</p>";
}
?>
<form method="POST">
    <input type="hidden" name="product_id" value="2">
    <input type="text" name="product_name" placeholder="Product Name" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" name="price" placeholder="Price" required>
    <button type="submit">Update Product</button>
</form>
