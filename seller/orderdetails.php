<?php
session_start();
include_once("../dboperation.php");

if (!isset($_GET['bookingid'])) {
    header("Location: orders.php");
    exit;
}

$bookingid = intval($_GET['bookingid']);
$obj = new dboperation();

// Fetch booking + payment + customer info
$sqlBooking = "
    SELECT b.bookingid, b.totalamount, b.status AS booking_status,
           p.payment_id, p.amount AS payment_amount, p.status AS payment_status, p.date AS payment_date
    FROM tbl_booking b
    LEFT JOIN tbl_payment p ON b.bookingid = p.booking_id
    WHERE b.bookingid='$bookingid' LIMIT 1
";

$resBooking = $obj->executequery($sqlBooking);
if (mysqli_num_rows($resBooking) == 0) {
    die("Order not found.");
}
$booking = mysqli_fetch_assoc($resBooking);

// Fetch delivery address
$sqlAddr = "SELECT address, landmark, pincode FROM tbl_deliveryaddress WHERE booking_id='$bookingid' LIMIT 1";
$resAddr = $obj->executequery($sqlAddr);
$addr = mysqli_fetch_assoc($resAddr);

// Fetch products
$sqlProducts = "
    SELECT pr.product_name, bd.quantity, bd.amount 
    FROM tbl_bookingdetails bd
    INNER JOIN tbl_product pr ON bd.product_id = pr.product_id
    WHERE bd.booking_id='$bookingid'
";
$resProducts = $obj->executequery($sqlProducts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order #<?php echo $booking['bookingid']; ?> Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f8f9fa; }
.card { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 20px; }
.card-header { background: #007bff; color: #fff; font-weight: bold; }
.list-group-item { border: none; padding-left: 0; }
</style>
</head>
<body class="p-4">

<div class="container">
    <a href="orders.php" class="btn btn-secondary mb-3">← Back to Orders</a>

    <div class="card">
        <div class="card-header">Order #<?php echo $booking['bookingid']; ?> - <?php echo ucfirst($booking['booking_status']); ?></div>
        <div class="card-body">
            <p><strong>Total Amount:</strong> ₹<?php echo $booking['totalamount']; ?></p>
            <p><strong>Status:</strong> <?php echo ucfirst($booking['booking_status']); ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Delivery Address</div>
        <div class="card-body">
            <?php if ($addr) { ?>
                <p><?php echo htmlspecialchars($addr['address']); ?>, <?php echo htmlspecialchars($addr['landmark']); ?>, <?php echo htmlspecialchars($addr['pincode']); ?></p>
            <?php } else { ?>
                <p>N/A</p>
            <?php } ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Products</div>
        <ul class="list-group list-group-flush">
            <?php while ($prod = mysqli_fetch_assoc($resProducts)) { ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($prod['product_name']); ?> - Qty: <?php echo $prod['quantity']; ?> - ₹<?php echo $prod['amount']; ?>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="card">
        <div class="card-header">Payment Details</div>
        <div class="card-body">
            <p><strong>Payment ID:</strong> <?php echo $booking['payment_id'] ?? 'N/A'; ?></p>
            <p><strong>Amount:</strong> ₹<?php echo $booking['payment_amount'] ?? '0'; ?></p>
            <p><strong>Status:</strong> <?php echo ucfirst($booking['payment_status'] ?? 'Pending'); ?></p>
            <p><strong>Date:</strong> <?php echo $booking['payment_date'] ?? 'N/A'; ?></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
