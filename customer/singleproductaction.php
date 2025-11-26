<?php
session_start();
include_once("../dboperation.php");
$customer_id = $_SESSION['customer_id'];
$cart_key = 'cart_' . $customer_id;

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    $sql = "SELECT * FROM tbl_product WHERE product_id='$product_id'";
    $obj = new dboperation();
    $result = $obj->executequery($sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $price = $row['price'];
        $stock= $row['stock'];
        $offerprice=$row['offer_price'];
    
        $total = $offerprice * $quantity;

        // ✅ store product_image in session
        $cart_item = [
            'product_id'    => $row['product_id'],
            'product_name'  => $row['product_name'],
            'product_image' => $row['product_image'], 
            'price'         => $price,
            'stock'         => $stock,
            'offerprice'   =>$offerprice,
            'quantity'      => $quantity,
            'total'         => $total,
            
        ];

        if (!isset($_SESSION[$cart_key])) {
            $_SESSION[$cart_key] = [];
        }

        // ✅ Check if product already in cart
        $found = false;
        foreach ($_SESSION[$cart_key] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] += $quantity;
                $item['total']    = $item['quantity'] * $offerprice;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION[$cart_key][] = $cart_item;
        }
    }
}

// Redirect back to cart
header("Location: cart.php");
exit;
?>
