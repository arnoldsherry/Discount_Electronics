<?php
session_start();

$customer_id = $_SESSION['customer_id'];
$cart_key = 'cart_' . $customer_id;

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    if (isset($_SESSION[$cart_key]) && count($_SESSION[$cart_key]) > 0) {
        foreach ($_SESSION[$cart_key] as $index => $item) {
            if ($item['product_id'] == $productId) {
                unset($_SESSION[$cart_key][$index]);
                break; // stop after removing
            }
        }

        // Reindex array so keys remain sequential
        $_SESSION[$cart_key] = array_values($_SESSION[$cart_key]);
    }
}

// Redirect back to cart
header("Location: cart.php");
exit();
