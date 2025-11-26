<?php
session_start();
include_once('../dboperation.php');

if (!isset($_SESSION["customer_id"])) {
    echo "<script>alert('Please login first'); window.location='login.php';</script>";
    exit;
}

$customer_id = $_SESSION["customer_id"];
$obj = new dboperation();

// Fetch the latest booking_id for this customer
$sql = "SELECT b.booking_id, b.totalamount, p.date, p.amount, p.status
        FROM tbl_booking b
        JOIN tbl_payment p ON b.booking_id = p.booking_id
        JOIN tbl_bookingdetails d ON d.booking_id = b.booking_id
        WHERE d.customer_id = '$customer_id'
        ORDER BY p.payment_id DESC
        LIMIT 1";
        
$res = $obj->executequery($sql);
if (mysqli_num_rows($res) == 0) {
    echo "<script>alert('No payment found'); window.location='cart.php';</script>";
    exit;
}
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Bill</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background: #f8f9fa;
    }
    .invoice-box {
        max-width: 700px;
        margin: 50px auto;
        padding: 40px;
        border: 1px solid #ddd;
        background: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        color: #333;
    }
    .invoice-title {
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .text-right {
        text-align: right;
    }
    .btn-print {
        margin-top: 20px;
    }
    @media print {
        .btn-print {
            display: none;
        }
    }
  </style>
</head>
<body>

<div class="invoice-box">
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2 class="invoice-title">Payment Receipt</h2>
            <p><strong>Date:</strong> <?php echo date("d M Y", strtotime($row['date'])); ?></p>
        </div>
        <div class="text-end">
            <p><strong>Booking ID:</strong> <?php echo $row['booking_id']; ?></p>
        </div>
    </div>

    <table class="table">
        <tbody>
            <tr>
                <th>Customer ID:</th>
                <td><?php echo $customer_id; ?></td>
            </tr>
            <tr>
                <th>Total Amount:</th>
                <td><strong>$<?php echo number_format($row['totalamount'], 2); ?></strong></td>
            </tr>
            <tr>
                <th>Paid Amount:</th>
                <td>$<?php echo number_format($row['amount'], 2); ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    <span class="badge bg-<?php echo strtolower($row['status']) === 'paid' ? 'success' : 'warning'; ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <p class="text-center">Thank you for your payment!</p>

    <div class="text-center">
        <button class="btn btn-primary btn-print" onclick="window.location.href='searchbc.php'">close</button>
    </div>
</div>

</body>
</html>
