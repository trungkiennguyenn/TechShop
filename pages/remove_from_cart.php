<?php
session_start();

if (isset($_GET['key']) && isset($_SESSION['cart'][$_GET['key']])) {
    unset($_SESSION['cart'][$_GET['key']]);
}

header("Location: cart.php");
exit;
