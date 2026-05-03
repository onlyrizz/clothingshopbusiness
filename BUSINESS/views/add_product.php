<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ProductController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: users/login.php");
    exit;
}

$productController = new ProductController($pdo);
$brand_id = 1; // static for now

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $added_by = $_SESSION['user_id'];
    $productController->addProduct($brand_id, $_POST['product_name'], $_POST['category'], $_POST['price'], $added_by);
    echo "Product added successfully by " . htmlspecialchars($_SESSION['user_name']) . "!";
}
?>
<form method="post">
    Product Name: <input type="text" name="product_name" required><br>
    Category:
    <select name="category" required>
        <option value="Shirt">Shirt</option>
        <option value="Hoodie">Hoodie</option>
        <option value="Short">Short</option>
    </select><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    <button type="submit">Add Product</button>
</form>
