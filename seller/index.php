<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");

if(!isset($_SESSION['seller_id'])){
    header("Location: login.php");
    exit;
}

$seller_id = $_SESSION['seller_id'];
$obj = new dboperation();

// Fetch seller name
$sql = "SELECT seller_name FROM tbl_seller WHERE seller_id='$seller_id'";
$res = $obj->executequery($sql);
$seller = mysqli_fetch_assoc($res);
$seller_name = $seller['seller_name'];
?>
<body style="    background-image: url(images/dasboard.png);
    background-size: cover;">
<!-- Full page background -->
 <br>
 <br>
 <br>
 <br>
 <br>
<div class="dashboard-bg">
    <div class="overlay">
        <div class="container py-5">
            <!-- Welcome Section -->
            <div class="text-center mb-5 text-white">
                <h1 style="color:white;" class="display-4 fw-bold">Welcome, <?php echo htmlspecialchars($seller_name); ?>!</h1>
                <p class="lead">Manage your products, categories, brands, and orders efficiently from your dashboard.</p>
            </div>

            <!-- Dashboard Cards -->
            <div class="row g-4">
                <!-- Profile -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-person-circle display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Profile</h5>
                            <p class="card-text">View and edit your seller profile.</p>
                            <a href="sellerprofile.php" class="btn btn-primary btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-box-seam display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Products</h5>
                            <p class="card-text">Add, edit, or delete your products.</p>
                            <a href="product_view.php" class="btn btn-success btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-tags display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Categories</h5>
                            <p class="card-text">Manage product categories.</p>
                            <a href="availablecategory.php" class="btn btn-warning btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Brands -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-award display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Brands</h5>
                            <p class="card-text">Manage your product brands.</p>
                            <a href="availablebrands.php" class="btn btn-info btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Stock Alerts -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-award display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red; font-size:31px;">STOCK Alerts !!!</h5>
                            <p class="card-text">Manage your stocks.</p>
                            <a href="stockalerts.php" class="btn btn-info btn-sm">checkout</a>
                        </div>
                    </div>
                </div>
                

                <!-- Orders -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-cart-check display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Orders</h5>
                            <p class="card-text">View customer orders and payments.</p>
                            <a href="orders.php" class="btn btn-danger btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Logout -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-box-arrow-right display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Logout</h5>
                            <p class="card-text">Sign out of your dashboard.</p>
                            <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
                        </div>
                    </div>
                </div>

                <!--report -->
                <!-- Logout -->
                <div class="col-md-3">
                    <div class="card dashboard-card h-100 text-center" data-tilt data-tilt-glare>
                        <div class="card-body">
                            <i class="bi bi-box-arrow-right display-3 mb-3"></i>
                            <h5 class="card-title" style="color:red;">Report</h5>
                            <p class="card-text">manage Your reports.</p>
                            <a href="seller_report.php" class="btn btn-danger btn-sm">Report</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
/* Background image with overlay */
.dashboard-bg {
    background: url('../images/dashboard-bg.jpg') no-repeat center center/cover;
    min-height: 100vh;
    position: relative;
}
.overlay {
    background-color: rgba(0, 0, 0, 0.6);
    min-height: 100vh;
    padding-top: 50px;
}

/* Card hover + tilt + shadow */
.dashboard-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    color: #fff;
        background: linear-gradient(45deg, black, #0cd1ea45);
}
.dashboard-card i {
    color: #ffc107;
}
.dashboard-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
}

/* Button hover */
.btn-sm:hover {
    transform: scale(1.05);
    transition: 0.3s;
}
</style>

<!-- JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>

<!-- Optional: Activate Vanilla Tilt -->
<script>
VanillaTilt.init(document.querySelectorAll(".dashboard-card"), {
    max: 15,
    speed: 400,
    glare: true,
    "max-glare": 0.3,
});
</script>
</body>

