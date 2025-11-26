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

// Fetch stock alerts (example: products with qty < 10)
$sql2 = "SELECT p.product_id,p.product_name,p.product_image, p.stock, b.brand_name, c.category_name 
         FROM tbl_product p 
         INNER JOIN tbl_brand b ON p.brand_id=b.brand_id
         INNER JOIN tbl_category c ON p.category_id=c.category_id
         WHERE p.seller_id='$seller_id' AND p.stock < 10";
$res2 = $obj->executequery($sql2);

//fetch all from products
$sql3 = "
    SELECT p.*, b.brand_name, c.category_name
    FROM tbl_product p
    INNER JOIN tbl_brand b ON p.brand_id = b.brand_id
    INNER JOIN tbl_category c ON p.category_id = c.category_id
    WHERE p.seller_id='$seller_id'
   
";

$res3 = $obj->executequery($sql3);


?>
<body style="background-image: url(images/dasboard.png); background-size: cover;">
<br>
<br>
<br>
<br>
<br>
<div class="dashboard-bg">
    <div class="overlay">
        <div class="container py-5">

            <!-- Heading -->
            <div class="text-center text-white mb-5">
                <h1 class="display-4 fw-bold animate__animated animate__fadeInDown"><span style="    background: linear-gradient(to right, #ff0000, #ff000024);
    color: white;
    border-radius: 22px;">Stock Alerts</i></h1>
                <p class="lead animate__animated animate__fadeIn animate__delay-1s">
                    Monitor products running low on stock and restock before it’s too late.
                </p>
            </div>

            <!-- Table -->
            <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
                <div class="card-body p-4" style="background: linear-gradient(45deg,#111,#1d3c45,#0cd1ea30); color:white;">
                    <h4 class="mb-4"><span class='bg-danger text-dark p-2 rounded'> Low Stock Products</span></h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-bordered align-middle">
                            <thead class="table-warning text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Stock Left</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                if(mysqli_num_rows($res2) > 0){
                                    while($row = mysqli_fetch_assoc($res2)){
                                        $pid=$row['product_id'];
                                        $stock = $row['stock'];
                                        $stockClass = ($stock <= 3) ? "bg-danger text-white p-2 rounded" : "bg-warning text-dark p-2 rounded";
                                        
                                        echo "<tr class='animate__animated animate__fadeInUp animate__delay-{$i}00ms'>
                                                <td>{$i}</td>
                                                <td>{$row['product_name']}</td>
                                                <td>{$row['brand_name']}</td>
                                                <td>{$row['category_name']}</td>
                                                <td><img src='../uploads/{$row['product_image']}' style='max-width:100px; max-height:80px; object-fit:contain;'/></td>
                                                <td><span class='$stockClass'>$stock</span></td>
                                                <td>
                                                    <a href='product_edit.php?product={$row['product_name']}&productid={$pid}' class='btn btn-sm btn-success'>
                                                        <i class='bi bi-bag-plus'></i> Restock
                                                    </a>
                                                </td>
                                              </tr>";
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center text-muted'> All stocks are healthy!</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <br>
                    <br>
                
                    <!--full stock table-->
                    <h4 class="mb-4"><span class='bg-success text-dark p-2 rounded'> current Stock</span></h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-bordered align-middle">
                            <thead class="table-warning text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Stock Left</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$i = 1;
if (mysqli_num_rows($res3) > 0) {
    while ($row = mysqli_fetch_assoc($res3)) {
        $pid   = $row['product_id'];
        $stock = $row['stock'];

        // CSS class + stock text
        if ($stock <= 3) {
            $stockClass = "bg-danger text-white p-2 rounded";
            $stockText  = "not safe";
        } else {
            $stockClass = "bg-warning text-dark p-2 rounded";
            $stockText  = "safe";
        }

        echo "<tr class='animate__animated animate__fadeInUp animate__delay-{$i}00ms'>
        <td>{$i}</td>
        <td>{$row['product_name']}</td>
        <td>{$row['brand_name']}</td>
        <td>{$row['category_name']}</td>
        <td><img src='../uploads/{$row['product_image']}' style='max-width:100px; max-height:80px; object-fit:contain;'/></td>
        <td>
            <span class='{$stockClass}'>{$stock}</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class='{$stockClass}'>{$stockText}</span>
        </td>
        <td>
            <a href='product_edit.php?product={$row['product_name']}&productid={$pid}' 
               class='btn btn-sm btn-success'>
               <i class='bi bi-bag-plus'></i> Edit stocks
            </a>
        </td>
      </tr>";

        $i++;
    }
} else {
    echo "<tr><td colspan='6' class='text-center text-muted'> No products found! </td></tr>";
}
?>

                            </tbody>
                        </table>
                    </div>




                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary btn-lg shadow-sm animate__animated animate__fadeInUp animate__delay-1s">
                    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
                </a>
            </div>
                                <?php
                                if(isset($pid))
                                {
                                echo "<span class='badge bg-secondary'><?php echo $pid; ?></span>";
                                }
                            
                                ?>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.table td, .table th {
    vertical-align: middle;
    text-align: center;
}
.btn-success {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.btn-success:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0,255,0,0.3);
}
</style>

<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</body>
