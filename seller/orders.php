<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");

if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit;
}

$obj = new dboperation();

// Fetch all bookings from tbl_booking
$sqlBookings = "SELECT booking_id, totalamount, status FROM tbl_booking ORDER BY booking_id DESC";
$resBookings = $obj->executequery($sqlBookings);

$orders = [];
while ($booking = mysqli_fetch_assoc($resBookings)) {
    $booking_id = $booking['booking_id'];

    // Fetch customer_id from tbl_bookingdetails (first item)
    $sqlCustomer = "SELECT customer_id FROM tbl_bookingdetails WHERE booking_id='$booking_id' LIMIT 1";
    $resCustomer = $obj->executequery($sqlCustomer);
    $customerData = mysqli_fetch_assoc($resCustomer);
    $customer_id = $customerData['customer_id'] ?? 0;

    // Fetch delivery address
    $sqlAddress = "SELECT address, landmark, pincode FROM tbl_deliveryaddress 
                   WHERE booking_id='$booking_id' AND customer_id='$customer_id' LIMIT 1";
    $resAddress = $obj->executequery($sqlAddress);
    $address = mysqli_fetch_assoc($resAddress);

    // Fetch items
    $sqlItems = "SELECT details_id, product_id, quantity, amount FROM tbl_bookingdetails WHERE booking_id='$booking_id'";
    $resItems = $obj->executequery($sqlItems);
    $items = [];
    while ($item = mysqli_fetch_assoc($resItems)) {
        $items[] = $item;
    }

    $orders[$booking_id] = [
        'booking_id' => $booking_id,
        'totalamount' => $booking['totalamount'],
        'status' => $booking['status'],
        'customer_id' => $customer_id,
        'address' => $address['address'] ?? 'N/A',
        'landmark' => $address['landmark'] ?? '',
        'pincode' => $address['pincode'] ?? '',
        'items' => $items
    ];
}
?>

<body class="bg-dark text-light">
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">📦 Orders</h2>

    <?php if (empty($orders)) { ?>
        <div class="alert alert-info text-center shadow-lg">No orders yet.</div>
    <?php } else { ?>
        <div class="row g-4">
            <?php foreach ($orders as $order) { ?>
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4 bg-gradient" style="background: linear-gradient(135deg, #1d1f27, #2a2d3a);">
                        <div class="card-body">
                            <h5 class="card-title text-warning">Order #<?php echo $order['booking_id']; ?></h5>

                            <?php
                                $q2 = "SELECT customer_name FROM tbl_customer WHERE customer_id='" . $order['customer_id'] . "'";
                                $res2 = $obj->executequery($q2);
                                $row2 = mysqli_fetch_assoc($res2);
                                $customerName = $row2['customer_name'] ?? 'Unknown';
                            ?>
                                <br>
                                <h5 class="card-title text-danger"><span class='badge bg-secondary'>Customer Name :</span>&nbsp;&nbsp;<?php echo htmlspecialchars($customerName); ?></h5>
                                <br>

                            <p class="mb-1"><strong>Total:</strong> ₹<?php echo $order['totalamount']; ?></p>
                            <p class="mb-1"><strong>Status:</strong> 
                                <span class="badge bg-<?php echo ($order['status'] == 'completed') ? 'success' : 'secondary'; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </p>

                            <button class="btn btn-outline-info btn-sm mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#items<?php echo $order['booking_id']; ?>">
                                View Items
                            </button>

                            <a href="paymentdetails.php?booking_id=<?php echo $order['booking_id']; ?>" class="btn btn-outline-success btn-sm mt-2">
                                Payment Details
                            </a>
                        </div>

                        <div class="collapse" id="items<?php echo $order['booking_id']; ?>">
                            <div class="card-body border-top">
                                <!-- <h6 class="text-warning">Delivery Address</h6>
                                <p><?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['landmark']); ?>, <?php echo $order['pincode']; ?></p> -->

                                <h6 class="text-warning mt-3">Items</h6>
                                <?php if (!empty($order['items'])) { ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($order['items'] as $item) { ?>
                                            <li class="list-group-item bg-transparent text-light">
                                                Product ID: <?php echo $item['product_id'];
                                                $pid=$item['product_id']; ?> 
                                            </li>

                                                <?php
                                                // Fetch product name for the given product ID
                                                $q = "SELECT product_name,product_image FROM tbl_product WHERE product_id='$pid'";
                                                $res = $obj->executequery($q);
                                                $row = mysqli_fetch_assoc($res);
                                                $productName = $row['product_name'] ?? 'Unknown';
                                                
                                                ?>

                                                <li class="list-group-item bg-transparent text-light">
                                                    <span class="badge bg-warning text-dark">Product Name: <?php echo htmlspecialchars($productName); ?></span>
                                                </li>

                                                <li class="list-group-item bg-transparent text-light">
                                                    <span class="badge bg-secondary text-dark">
                                                    Product image: 
                                                    <img src="../uploads/<?php echo $row['product_image'];?>" 
                                                        style="max-width:162px; max-height:162px; object-fit:contain; vertical-align:middle; border-radius:3px;"/>
                                                </span>

                                                </li>


                                                <li class="list-group-item bg-transparent text-light">
                                                 Qty: <?php echo $item['quantity']; ?> 
                                                </li> 
                                                <li class="list-group-item bg-transparent text-light">
                                                 ₹<?php echo $item['amount']; ?>
                                                </li>
                                                <br>
                                                <!-- <li class="list-group-item bg-transparent text-light">
                                                 ₹<?php echo $item['']; ?>
                                                </li> -->
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <p class="text-muted">No items found.</p>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
