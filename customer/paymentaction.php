<?php
session_start();
$customer_id = $_SESSION["customer_id"];
include_once('../dboperation.php');
$obj = new dboperation();

$date = date('Y-m-d');

// 1. Get total booking amount
$sql = "SELECT SUM(amount) as total FROM tbl_bookingdetails 
        WHERE customer_id='$customer_id' AND booking_id='0'";
$res = $obj->executequery($sql);
$display = mysqli_fetch_array($res);
$amount = $display['total'];

// 2. Insert booking
$sql1 = "INSERT INTO tbl_booking(totalamount,status) VALUES('$amount','successful')";
$res1 = $obj->executequery($sql1);
$bookingid = mysqli_insert_id($obj->con);

// 3. Update bookingdetails with booking_id
$sql2 = "UPDATE tbl_bookingdetails 
         SET booking_id='$bookingid' 
         WHERE customer_id='$customer_id' AND booking_id='0'";
$res2 = $obj->executequery($sql2);

// 4. Reduce stock for each purchased product
$sql_products = "SELECT product_id, quantity FROM tbl_bookingdetails 
                 WHERE customer_id='$customer_id' AND booking_id='$bookingid'";
$res_products = $obj->executequery($sql_products);

if($res_products) {
    while($row = mysqli_fetch_assoc($res_products)) {
        $pid = $row['product_id'];
        $qty = $row['quantity'];
        // Reduce stock
        $sql_update_stock = "UPDATE tbl_product 
                             SET stock = stock - $qty 
                             WHERE product_id='$pid'";
        $obj->executequery($sql_update_stock);
    }
}

// 5. Insert payment
$sql3 = "INSERT INTO tbl_payment(date,booking_id,amount,status) 
         VALUES('$date','$bookingid','$amount','paid')";
$res3 = $obj->executequery($sql3);

// 6. Success / failure message
if ($res1 && $res2 && $res3) {
    echo "<script>
        alert('Payment successful & stock updated');
        window.location='bill.php';
    </script>";
} else {
    echo "<script>
        alert('Failed');
        window.location='cart.php';
    </script>";
}
?>
