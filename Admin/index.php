<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();
?>

<style>
/* ===== Dark Theme Base ===== */
body {
    background: black;
    background-size: cover;
    background-attachment: fixed;
    color: #e0e0e0;
}
.card-body
{
        background-image: url(images/admindark.jpg);
    background-size: cover;
    border: 1px solid #1200ff;
    border-radius: 19px;
}
/* Dark overlay for readability */
/* body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    /* background: rgba(0, 0, 0, 0.65);  
    z-index: 1;*/

.content-body {
    /* background-color: #121212; */
    padding: 20px;
}

/* ===== Card Styling ===== */
.card.shadow {
    background-color: #1e1e2f; 
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease-in-out;
    color: #e0e0e0;
}
.card.shadow:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.7);
}

/* Card Title */
.card-title {
    font-weight: 400;
    color: white;
    font-size:24px;
}

/* Card Numbers */
.card h2 {
    font-weight: bold;
    color: #00bcd4; /* teal/cyan for contrast */
    font-size: 2.2rem;
}

/* Buttons inside cards */
.card .btn {
    width: 100%;
    border-radius: 8px;
    margin-top: 10px;
    transition: all 0.2s ease;
    font-weight: 500;
}
.card .btn:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

/* Hover highlight for text-muted */
.card p.text-muted {
    transition: color 0.3s ease;
    color: #9ca3af;
}
.card:hover p.text-muted {
    color: #f5f5f5;
}

/* Master Data buttons */
.btn-outline-primary {
    border-width: 2px;
    color: #00bcd4;
    border-color: #00bcd4;
    transition: all 0.3s ease;
}
.btn-outline-primary:hover {
    background-color: #00bcd4;
    color: #121212;
    transform: scale(1.08);
}

/* Welcome Section */
.card.bg-primary {
    background: linear-gradient(135deg, #0d47a1, #1976d2);
    border-radius: 15px;
    box-shadow: 0px 6px 15px rgba(0,0,0,0.5);
}
.card.bg-primary h3 {
    color: #fff;
}
.card.bg-primary .badge {
    font-weight: 600;
}

/* Border Cards */
.border-warning {
    border-left: 6px solid #ffb300 !important;
}
.border-success {
    border-left: 6px solid #4caf50 !important;
}
</style>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Welcome, Admin</h3>
                        <span class="badge bg-light text-dark px-3 py-2">Dashboard Overview</span>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // DB Queries here (same as before)
        $resSeller = $obj->executequery("SELECT COUNT(*) as total FROM tbl_seller WHERE status='accepted'");
        $rowSeller = mysqli_fetch_assoc($resSeller);
        $totalSellers = $rowSeller['total'];

        $resSeller1 = $obj->executequery("SELECT COUNT(*) as total FROM tbl_seller WHERE status='rejected'");
        $rowSeller1 = mysqli_fetch_assoc($resSeller1);
        $totalSellers1 = $rowSeller1['total'];

        $resBrand = $obj->executequery("SELECT COUNT(*) as total FROM tbl_brand");
        $rowBrand = mysqli_fetch_assoc($resBrand);
        $totalBrands = $rowBrand['total'];

        $resCat = $obj->executequery("SELECT COUNT(*) as total FROM tbl_category");
        $rowCat = mysqli_fetch_assoc($resCat);
        $totalCategories = $rowCat['total'];

        $resDist = $obj->executequery("SELECT COUNT(*) as total FROM tbl_district");
        $rowDist = mysqli_fetch_assoc($resDist);
        $totalDistricts = $rowDist['total'];

        $resPending = $obj->executequery("SELECT COUNT(*) as total FROM tbl_seller WHERE status='pending'");
        $rowPending = mysqli_fetch_assoc($resPending);
        $pendingSellers = $rowPending['total'];
        ?>

        <!-- Quick Stats -->
        <div class="row g-4">
            
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title">Sellers</h5>
                        <h2><?php echo $totalSellers; ?></h2>
                        <a href="sellerview.php" class="btn btn-success btn-sm">View Sellers</a>
                        <p class="text-muted mt-2">Accepted Sellers</p>
                    </div>
                </div>
            </div>

            <!-- Rejected Sellers -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title">Rejected Sellers</h5>
                        <h2 class="text-danger"><?php echo $totalSellers1; ?></h2>
                        <a href="sellerview.php" class="btn btn-danger btn-sm">View Rejected</a>
                        <p class="text-muted mt-2">Rejected Sellers</p>
                    </div>
                </div>
            </div>

            <!-- Brands -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title">Brands</h5>
                        <h2><?php echo $totalBrands; ?></h2>
                        <a href="brandview.php" class="btn btn-primary btn-sm">View Brands</a>
                        <p class="text-muted mt-2">All Brands</p>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <h2><?php echo $totalCategories; ?></h2>
                        <a href="categoryview.php" class="btn btn-warning btn-sm">View Categories</a>
                        <p class="text-muted mt-2">Active Categories</p>
                    </div>
                </div>
            </div>

            <!-- Districts -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title">Districts</h5>
                        <h2><?php echo $totalDistricts; ?></h2>
                        <a href="districtview.php" class="btn btn-success btn-sm">View Districts</a>
                        <p class="text-muted mt-2">Registered Districts</p>
                    </div>
                </div>
            </div>

           

        </div>

        <!-- Verification Section -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card border-warning shadow">
                    <div class="card-body">
                        <h4 class="card-title">Seller Verification</h4>
                        <p class="text-muted">Pending Requests: 
                            <strong class="text-warning"><?php echo $pendingSellers; ?></strong>
                        </p>
                        <a href="sellerverification.php" class="btn btn-warning btn-sm">Manage Verification</a>
                    </div>
                </div>
            </div>
            
            <!-- <div class="col-lg-6">
                <div class="card border-success shadow">
                    <div class="card-body">
                        <h4 class="card-title">View Sellers</h4>
                        <p class="text-muted">Total Registered Sellers: 
                            <strong class="text-success"><?php echo $totalSellers; ?></strong>
                        </p>
                        <a href="sellerview.php" class="btn btn-success btn-sm">View All Sellers</a>
                    </div>
                </div>
            </div> -->


             <!-- Reports -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5 class="badge bg-light text-dark">Report</h5>
                        <!--  -->
                        <a href="report.php" class="btn btn-success btn-sm">View Reports</a>
                        <!-- <p class="text-muted mt-2">Registered Districts</p> -->
                    </div>
                </div>
            </div>

        </div>

        <!-- Master Data Section
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Master Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="brands.php" class="btn btn-outline-primary">Brands</a>
                            <a href="districts.php" class="btn btn-outline-primary">Districts</a>
                            <a href="categories.php" class="btn btn-outline-primary">Categories</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>
</div>
<!--**********************************
    Content body end
***********************************-->
<?php
include("footer.php");
?>
