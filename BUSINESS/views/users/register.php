<?php
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $rawPassword = $_POST['password'];

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $rawPassword)) {
        echo "<p style='color:red;font-weight:bold;'>
                Password must be at least 8 characters long and include 
                uppercase, lowercase, and numbers.
              </p>";
    } else {

        $password = password_hash($rawPassword, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $email, $password]);

        header("Location: ../views/index.php?page=login&registered=1");
        exit;
    }
}
?>

<form method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
