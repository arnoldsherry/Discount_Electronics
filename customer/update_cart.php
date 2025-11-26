<?php
session_start();
include_once("../dboperation.php");
$customer_id = $_SESSION['customer_id'];
$cart_key = 'cart_' . $customer_id;

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity  = (int) $_POST['quantity'];

    if ($quantity < 1) {
        $quantity = 1; // prevent 0 or negative qty
    }

    if (isset($_SESSION[$cart_key]) && count($_SESSION[$cart_key]) > 0) {
        foreach ($_SESSION[$cart_key] as $index => $item) {
            if ($item['product_id'] == $productId) {
                $_SESSION[$cart_key][$index]['quantity'] = $quantity;
                $_SESSION[$cart_key][$index]['total'] = $quantity * $item['offerprice'];
                break;
            }
        }
    }
}

// Redirect back to cart
header("Location: cart.php");
exit();
