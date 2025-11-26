<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");

if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit;
}

$obj = new dboperation();

// Get booking ID safely
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    echo "<div class='container py-5'><div class='alert alert-danger text-center'>Invalid booking ID.</div></div>";
    exit;
}

// Step 1: Fetch booking info and customer
$sqlBooking = "
    SELECT b.booking_id, b.totalamount, b.status AS booking_status,
           bd.customer_id, c.customer_name
    FROM tbl_booking b
    LEFT JOIN tbl_bookingdetails bd ON b.booking_id = bd.booking_id
    LEFT JOIN tbl_customer c ON bd.customer_id = c.customer_id
    WHERE b.booking_id='$booking_id'
    LIMIT 1
";
$resBooking = $obj->executequery($sqlBooking);
$booking = mysqli_fetch_assoc($resBooking);

if (!$booking) {
    echo "<div class='container py-5'><div class='alert alert-danger text-center'>Booking not found.</div></div>";
    exit;
}

$customer_id = $booking['customer_id'] ?? 0;

// Step 2: Fetch delivery address
$sqlAddress = "
    SELECT address, landmark, pincode
    FROM tbl_deliveryaddress
    WHERE booking_id='$booking_id' AND customer_id='$customer_id'
    LIMIT 1
";
$resAddress = $obj->executequery($sqlAddress);
$address = mysqli_fetch_assoc($resAddress);

// Fallback to latest address if none for booking
if (!$address) {
    $sqlFallback = "
        SELECT address, landmark, pincode
        FROM tbl_deliveryaddress
        WHERE customer_id='$customer_id'
        ORDER BY deliveryaddress_id DESC
        LIMIT 1
    ";
    $resFallback = $obj->executequery($sqlFallback);
    $address = mysqli_fetch_assoc($resFallback);
}

// Step 3: Fetch payment info
$sqlPayment = "
    SELECT payment_id, date AS payment_date, amount AS payment_amount, status AS payment_status
    FROM tbl_payment
    WHERE booking_id='$booking_id'
    LIMIT 1
";
$resPayment = $obj->executequery($sqlPayment);
$payment = mysqli_fetch_assoc($resPayment);
?>

<body class="bg-dark text-light">
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">💳 Payment Details</h2>

    <div class="card shadow-lg border-0 rounded-4 bg-gradient p-4" style="background: linear-gradient(135deg, #1d1f27, #2a2d3a);">
        <h4 class="text-warning mb-3">Booking #<?php echo htmlspecialchars($booking['booking_id']); ?></h4>
        <p><strong>Customer:</strong> <?php echo htmlspecialchars($booking['customer_name'] ?? 'N/A'); ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo htmlspecialchars($booking['totalamount'] ?? '0'); ?></p>

        <hr class="border-secondary">

        <h5 class="text-info">Payment Info</h5>
        <?php if ($payment) { ?>
            <p><strong>Payment ID:</strong> <?php echo htmlspecialchars($payment['payment_id'] ?? 'N/A'); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($payment['payment_date'] ?? 'N/A'); ?></p>
            <p><strong>Amount:</strong> ₹<?php echo htmlspecialchars($payment['payment_amount'] ?? '0'); ?></p>
            <p><strong>Status:</strong> 
                <span class="badge bg-<?php echo ($payment['payment_status']=='success' || $payment['payment_status']=='Paid') ? 'success' : 'warning'; ?>">
                    <?php echo htmlspecialchars($payment['payment_status'] ?? 'Pending'); ?>
                </span>
            </p>
        <?php } else { ?>
            <div class="alert alert-info">No payment info found.</div>
        <?php } ?>

        <hr class="border-secondary">

        <h5 class="text-info mt-3">Delivery Address</h5>
        <?php if ($address) { ?>
            <p>
                <strong>Address:</strong> <?php echo htmlspecialchars($address['address'] ?? 'N/A'); ?><br>
                <?php if (!empty($address['landmark'])) { ?>
                    <strong>Landmark:</strong> <?php echo htmlspecialchars($address['landmark']); ?><br>
                <?php } ?>
                <strong>Pincode:</strong> <?php echo htmlspecialchars($address['pincode'] ?? 'N/A'); ?>
            </p>
        <?php } else { ?>
            <div class="alert alert-warning">No delivery address found.</div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
