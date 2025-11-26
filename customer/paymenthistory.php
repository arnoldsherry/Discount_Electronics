<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['customer_id'])) {
    echo "<p>Please login to view your payment history.</p>";
    exit;
}

$customerid = $_SESSION['customer_id'];
$sellername = $_SESSION['username'];

echo "<h1>Welcome " . htmlspecialchars($sellername) . "</h1>";
echo "<h2>Your Payment History</h2>";

// Fetch payment history
$payments_sql = "SELECT b.booking_id, b.totalamount, p.date, p.amount, p.status
                 FROM tbl_booking b
                 JOIN tbl_payment p ON b.booking_id = p.booking_id
                 JOIN tbl_bookingdetails d ON d.booking_id = b.booking_id
                 WHERE d.customer_id = '$customerid'
                 ORDER BY p.payment_id DESC";

$payments_result = $obj->executequery($payments_sql);
?>

<style>
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #0073e6;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    h1, h2 {
        text-align: center;
        font-family: Arial, sans-serif;
        margin-top: 20px;
    }
</style>

<?php
if ($payments_result && mysqli_num_rows($payments_result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Booking ID</th>
            <th>Total Amount</th>
            <th>Payment Date</th>
            <th>Paid Amount</th>
            <th>Status</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($payments_result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['totalamount']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No payment history found.</p>";
}

include_once("footer.php");
?>
