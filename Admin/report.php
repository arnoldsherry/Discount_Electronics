<?php
// session_start();
include("header.php");
include("../dboperation.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$obj = new dboperation();

// ---------------- Quick Stats ----------------
function getCount($obj, $table, $condition = '1') {
    $res = $obj->executequery("SELECT COUNT(*) AS total FROM $table WHERE $condition");
    $row = mysqli_fetch_assoc($res);
    return $row['total'] ?? 0;
}

$totalSellers = getCount($obj, 'tbl_seller', "status='accepted'");
$rejectedSellers = getCount($obj, 'tbl_seller', "status='rejected'");
$pendingSellers = getCount($obj, 'tbl_seller', "status='pending'");
$totalBrands = getCount($obj, 'tbl_brand');
$totalCategories = getCount($obj, 'tbl_category');
$totalDistricts = getCount($obj, 'tbl_district');

// ---------------- Reports ----------------

// Top Sellers (by total quantity sold)
$topSellersSQL = "
    SELECT s.seller_id, s.seller_name, SUM(b.quantity) AS total_sold
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    INNER JOIN tbl_seller s ON p.seller_id = s.seller_id
    GROUP BY s.seller_id
    ORDER BY total_sold DESC
    LIMIT 10
";
$topSellersRes = $obj->executequery($topSellersSQL);

// Top Sold Brands
$topBrandsSQL = "
    SELECT br.brand_id, br.brand_name, SUM(b.quantity) AS total_sold
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    INNER JOIN tbl_brand br ON p.brand_id = br.brand_id
    GROUP BY br.brand_id
    ORDER BY total_sold DESC
    LIMIT 5
";
$topBrandsRes = $obj->executequery($topBrandsSQL);

// Best Seller (single seller with highest sales)
$bestSellerSQL = "
    SELECT s.seller_id, s.seller_name, SUM(b.quantity) AS total_sold
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    INNER JOIN tbl_seller s ON p.seller_id = s.seller_id
    GROUP BY s.seller_id
    ORDER BY total_sold DESC
    LIMIT 1
";
$bestSellerRes = $obj->executequery($bestSellerSQL);


//top 3 catehories
$topCategorySQL = "
    SELECT c.category_id, c.category_name, c.image, SUM(b.quantity) AS total_sold
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    INNER JOIN tbl_category c ON p.category_id = c.category_id
    GROUP BY c.category_id
    ORDER BY total_sold DESC
    LIMIT 3
";

$resultc = $obj->executequery($topCategorySQL);
?>




<style>
body { font-family:'Segoe UI', sans-serif; 
        background-image: url(images/admindark.jpg);
    background-size: cover; color:#f5f5f5; margin:0; padding:20px; }
.card { background:#1e1e2f; border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.4); padding:15px; margin-bottom:20px; }
.card h2,h4,h5 { margin:5px 0; color:#f5f5f5; }
.card .btn { margin-top:10px; }
.row { display:flex; flex-wrap:wrap; gap:20px; }
.col-lg-3, .col-lg-4, .col-lg-6 { flex:1 1 calc(25% - 20px); }
.col-lg-4 { flex:1 1 calc(33.33% - 20px); }
.col-lg-6 { flex:1 1 calc(50% - 20px); }
.table { width:100%; border-collapse: collapse; }
.table th, .table td { padding:8px;  text-align:left; }
.table-dark { background:#1e1e2f; }
.table-striped tbody tr:nth-child(even) { background: rgba(255, 255, 255, 0.21);}
</style>

<div class="content-body">
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>


<!-- Reports Section -->
<div class="row">
    <!-- Top Sellers -->
    <div class="col-lg-4">
        <div class="card">
            <h4 class="btn btn-success btn-sm">Top Sellers</h4>
            <table class="table table-dark table-striped">
                <thead><tr><th>Seller</th><th>Products Sold</th></tr></thead>
                <tbody>
                    <?php while($s = mysqli_fetch_assoc($topSellersRes)) { ?>
                    <tr><td class="btn btn-warning btn-sm"><?php echo htmlspecialchars($s['seller_name']); ?></td><td><span class="btn btn-danger btn-sm"><?php echo $s['total_sold']; ?></span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Brands -->
    <div class="col-lg-4">
        <div class="card">
            <h4 class="btn btn-success btn-sm">Top Sold Brands</h4>
            <table class="table table-dark table-striped">
                <thead><tr><th>Brand</th><th>Products Sold</th></tr></thead>
                <tbody>
                    <?php while($b = mysqli_fetch_assoc($topBrandsRes)) { ?>
                    <tr><td><span class="btn btn-warning btn-sm"><?php echo htmlspecialchars($b['brand_name']); ?></span></td><td><span class="btn btn-danger btn-sm"><?php echo $b['total_sold']; ?></span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Best Seller -->
    <div class="col-lg-4">
        <div class="card">
            <h4 class="btn btn-success btn-sm">Best Seller</h4>
            <table class="table table-dark table-striped">
                <thead><tr><th>Seller</th><th>Products Sold</th></tr></thead>
                <tbody>
                    <?php if($best = mysqli_fetch_assoc($bestSellerRes)) { ?>
                    <tr><td><span class="btn btn-warning btn-sm"><?php echo htmlspecialchars($best['seller_name']); ?></td></span><td><span class="btn btn-danger btn-sm"><?php echo $best['total_sold']; ?></span></td></tr>
                    <?php } else { ?>
                    <tr><td colspan="2">No sales yet</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Top category
    <div class="col-lg-4">
        <div class="card">
            <h4 class="btn btn-success btn-sm">Category Maximum sales</h4>
            <table class="table table-dark table-striped">
                <thead><tr><th>Seller</th><th>category Sold</th></tr></thead>
                <tbody>
                    <?php if($best = mysqli_fetch_assoc($bestSellerRes)) { ?>
                    <tr><td><span class="btn btn-warning btn-sm"><?php echo htmlspecialchars($best['seller_name']); ?></td></span><td><span class="btn btn-danger btn-sm"><?php echo $best['total_sold']; ?></span></td></tr>
                    <?php } else { ?>
                    <tr><td colspan="2">No sales yet</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div> -->



    <!-- top 3 categories-->
     <?php
     echo "<div class='col-lg-4'>
        <div class='card'>";
        ?>
        <h4 class="btn btn-primary btn-sm">Top category Sold</h4>
        <?php
        $rank = 1;
        while($rowc = mysqli_fetch_assoc($resultc)) {
            // Add red border if it's the first
            $style = $rank == 1 
                ? "background: #e6ff0042; padding:10px; border-radius:10px; text-align:center;" 
                : "border: 1px solid #ccc; padding:10px; border-radius:10px; text-align:center;";
            
            echo "<div style='$style'>";
            echo "<img src='../uploads/" . $rowc['image'] . "' alt='" . $rowc['category_name'] . "' style='width:150px; height:100px; object-fit:cover; border-radius:8px;'><br>";

            echo "<strong>".$rowc['category_name']."</strong><br>";
            echo "<span class='btn btn-danger'>"."Sold: ".$rowc['total_sold']."</span>";
            echo "</div>";

            $rank++;
        }

        echo "</div></div>";
        ?>


</div>

</div>

<?php include("footer.php"); ?>
