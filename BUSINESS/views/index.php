<?php
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id']) && ($_GET['page'] ?? '') !== 'login' && ($_GET['page'] ?? '') !== 'register') {
    header("Location: index.php?page=login");
    exit;
}

$page = $_GET['page'] ?? 'home';

echo "<h1>UrbanRizz Clothing Shop</h1>";
echo "<nav>
    <a href='index.php?page=register'>Register</a> |
    <a href='index.php?page=login'>Login</a> |
    <a href='index.php?page=add_product'>Add Product</a> |
    <a href='index.php?page=list_products'>View Products</a> |
    <a href='index.php?page=update_product'>Update Product</a> |
    <a href='index.php?page=delete_product'>Delete Product</a> |
    <a href='users/logout.php'>Logout</a>
</nav><hr>";


switch($page) {
    case 'register': include __DIR__ . '/users/register.php'; break;
    case 'login': include __DIR__ . '/users/login.php'; break;
    case 'logout': include __DIR__ . '/users/logout.php'; break;
    case 'add_product': include __DIR__ . '/add_product.php'; break;
    case 'list_products': include __DIR__ . '/list_products.php'; break;
    case 'update_product': include __DIR__ . '/update_product.php'; break;
    case 'delete_product': include __DIR__ . '/delete_product.php'; break;
    default:
        echo "<p>Welcome, " . ($_SESSION['user_name'] ?? 'Guest') . "! Use the menu above to manage brands and products.</p>";
}
?>
