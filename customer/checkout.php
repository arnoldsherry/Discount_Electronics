<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");
$customer_id=$_SESSION['customer_id'];
$cart_key='cart_'.$customer_id;


if (!isset($_SESSION[$cart_key]) || count($_SESSION[$cart_key]) == 0) {
    echo "<div class='container py-5'><h4>Your cart is empty.</h4></div>";
    include_once("footer.php");
    exit;
}

$obj = new dboperation();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    echo "<script>console.log('POST request received');</script>";
    
    $customerid =  $customer_id; // assuming login
    $address     = $_POST['address'];
    $landmark    = $_POST['landmark'];
    $pincode     = $_POST['pincode'];
    $date        = date('Y-m-d');

    // Debug: Check if cart exists and has items
    if (!isset($_SESSION[$cart_key]) || empty($_SESSION[$cart_key])) {
        echo "<script>alert('Cart is empty or not found'); history.back();</script>";
        exit;
    }
    
    echo "<script>console.log('Cart items: " . count($_SESSION[$cart_key]) . "');</script>";

    $booking_id = null; // Initialize booking_id
    
    // Insert each cart item into tbl_bookingdetails
    foreach ($_SESSION[$cart_key] as $index => $item) {
        echo "<script>console.log('Processing item " . ($index + 1) . "');</script>";
        
        // Check if required keys exist
        if (!isset($item['product_id']) || !isset($item['quantity']) || !isset($item['total'])) {
            echo "<script>alert('Invalid cart item data at index $index'); history.back();</script>";
            exit;
        }
        
        $product_id = mysqli_real_escape_string($obj->con, $item['product_id']);
        $quantity   = mysqli_real_escape_string($obj->con, $item['quantity']);
        $amount     = mysqli_real_escape_string($obj->con, $item['total']);

        echo "<script>console.log('Processing product ID: " . $item['product_id'] . "');</script>";

        $sql_details = "INSERT INTO tbl_bookingdetails 
                        (product_id, quantity, amount, date, customer_id) 
                        VALUES ('$product_id', '$quantity', '$amount', '$date', '$customer_id')";
        
        echo "<script>console.log('Executing booking details query');</script>";
        
        $result = $obj->executequery($sql_details);
        
        if (!$result) {
            $error = addslashes(mysqli_error($obj->con));
            echo "<script>alert('Error placing order: $error'); history.back();</script>";
            exit;
        }

        // get last inserted details_id
        $booking_id = $obj->con->insert_id;
        echo "<script>console.log('Booking ID generated: $booking_id');</script>";

        // Escape delivery address data
        $safe_address = mysqli_real_escape_string($obj->con, $address);
        $safe_landmark = mysqli_real_escape_string($obj->con, $landmark);
        $safe_pincode = mysqli_real_escape_string($obj->con, $pincode);

        // Delivery address (linked with details_id as booking_id)
        $sql_delivery = "INSERT INTO tbl_deliveryaddress 
                        (customer_id, booking_id, address, landmark, pincode)
                         VALUES ('$customer_id', '$booking_id', '$safe_address', '$safe_landmark', '$safe_pincode')";
        
        echo "<script>console.log('Executing delivery address query');</script>";
        
        $result_delivery = $obj->executequery($sql_delivery);
        
        if (!$result_delivery) {
            $error = addslashes(mysqli_error($obj->con));
            echo "<script>alert('Error saving delivery address: $error'); history.back();</script>";
            exit;
        }
        
        echo "<script>console.log('Item " . ($index + 1) . " completed successfully');</script>";
    }

    // Clear cart
    unset($_SESSION[$cart_key]);

    echo "<script>console.log('About to redirect with booking_id: $booking_id');</script>";
    
    if ($booking_id) {
        echo "<script>
            alert('Booking successful! Redirecting to payment page...');
            console.log('Redirecting to: payment.php?booking_id=$booking_id');
            window.location.href='payment.php?booking_id=$booking_id';
        </script>";
    } else {
        echo "<script>alert('Error: No booking ID generated'); history.back();</script>";
    }
    exit;
}
?>


<!-- Logout Button -->
    <div style="position: absolute; top: 10px; right: 276px; z-index: 1000;">
      <a href="logout.php" class="btn btn-danger" name="logout">Logout</a>
    </div>

    <!-- Payment History -->
    <div style="position: absolute; top: 10px; right: 180px; z-index: 1000;">
      <a  href="paymenthistory.php" class="rounded-circle bg-light p-2 mx-1" style="background:'red';" name="payhistory">
        <img src="images/rupee.png" alt="payhistory" style="width:30px; height:30px;">
         
      </a>
    </div>

    <!-- Cart -->
    <div style="position: absolute; top: 10px; right: 120px; z-index: 1000;">
      <a href="cart.php" class="rounded-circle bg-light p-2 mx-1" name="cart">
        <img src="images/cart.jpg" alt="cart" style="width:30px; height:30px;">
         
      </a>
    </div>

    <!-- Profile -->
    <div style="position: absolute; top: 10px; right: 20px; z-index: 1000;">
      <a href="edit_profile.php" class="rounded-circle bg-light p-2 mx-1" name="profile">
        <img src="images/profile.png" alt="Profile" style="width:30px; height:30px;">
          
      </a>
    </div>

<div class="container py-5">
    <h2>Checkout</h2>
    <form method="post" action="checkout.php">
        <div class="mb-3">
            <label class="form-label">Delivery Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Landmark</label>
            <input type="text" name="landmark" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Pincode</label>
            <input type="text" name="pincode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>

<?php include_once("footer.php"); ?>
