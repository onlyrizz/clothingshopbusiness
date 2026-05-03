<?php
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    echo "<p style='color:green;font-weight:bold;'>You have successfully logged out.</p>";
}
?>

<?php
require_once __DIR__ . '/../../config/db.php';

if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    echo "<p style='color:green;font-weight:bold;'>Registration successful! Please log in below.</p>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'];

        header("Location: ../views/index.php?page=home");
        exit;
    } else {
        echo "<p style='color:red;font-weight:bold;'>Invalid login!</p>";
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
