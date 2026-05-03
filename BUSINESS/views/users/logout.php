<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

// Redirect back to login with a flag
header("Location: ../index.php?page=login&logout=1");
exit;
?>
