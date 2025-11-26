<?php
session_start();
include("../dboperation.php");
$obj = new dboperation();

// Seller ID (from login session)
$seller_id = $_SESSION['seller_id'];

// ---------- 1. Top Selling Products ----------
$sqlTop = "
    SELECT p.product_name, SUM(b.quantity) as total_sold 
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    WHERE p.seller_id = '$seller_id'
    GROUP BY p.product_id
    ORDER BY total_sold DESC
    LIMIT 5";
$resTop = $obj->executequery($sqlTop);

// ---------- 2. Total Revenue ----------
$sqlRevenue = "
   SELECT SUM(p.amount) AS revenue
   FROM tbl_payment p
   INNER JOIN tbl_bookingdetails b ON p.booking_id = b.booking_id
   INNER JOIN tbl_product pr ON b.product_id = pr.product_id
   WHERE p.status = 'paid' 
     AND pr.seller_id = '$seller_id';
";
$resRevenue = $obj->executequery($sqlRevenue);
$rowRevenue = mysqli_fetch_assoc($resRevenue);
$totalRevenue = $rowRevenue['revenue'] ?? 0;

// ---------- 3. Total Orders ----------
$sqlOrders = "SELECT COUNT(DISTINCT b.booking_id) AS orders
FROM tbl_bookingdetails b
INNER JOIN tbl_product p ON b.product_id = p.product_id
WHERE p.seller_id = '$seller_id';
";
$resOrders = $obj->executequery($sqlOrders);
$rowOrders = mysqli_fetch_assoc($resOrders);
$totalOrders = $rowOrders['orders'] ?? 0;

// ---------- 4. Stock Alerts ----------
$sqlStock = "
    SELECT product_name, stock 
    FROM tbl_product 
    WHERE seller_id='$seller_id' AND stock < 10
    ORDER BY stock ASC";
$resStock = $obj->executequery($sqlStock);

// ---------- 5. Revenue by Category ----------
$sqlCat = "SELECT c.category_name, SUM(b.amount) AS total
FROM tbl_bookingdetails b
INNER JOIN tbl_product p ON b.product_id = p.product_id
INNER JOIN tbl_category c ON p.category_id = c.category_id
INNER JOIN tbl_payment pay ON b.booking_id = pay.booking_id
WHERE p.seller_id = '$seller_id' 
  AND pay.status = 'paid'
GROUP BY c.category_id
ORDER BY total DESC";
$resCat = $obj->executequery($sqlCat);

// store category data into arrays
$catLabels = [];
$catTotals = [];
while($row = mysqli_fetch_assoc($resCat)){
    $catLabels[] = $row['category_name'];
    $catTotals[] = $row['total'];
}

// ---------- 6. Revenue per Product ----------
$sqlProdRevenue = "
    SELECT p.product_name, SUM(b.amount) AS revenue
    FROM tbl_bookingdetails b
    INNER JOIN tbl_product p ON b.product_id = p.product_id
    INNER JOIN tbl_payment pay ON b.booking_id = pay.booking_id
    WHERE p.seller_id = '$seller_id' 
      AND pay.status = 'paid'
    GROUP BY p.product_id
    ORDER BY revenue DESC";
$resProdRevenue = $obj->executequery($sqlProdRevenue);

// store product revenue for chart
$productLabels = [];
$productTotals = [];
while($prow = mysqli_fetch_assoc($resProdRevenue)){
    $productLabels[] = $prow['product_name'];
    $productTotals[] = $prow['revenue'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Reports</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { background: #f5f7fa; font-family: 'Segoe UI', sans-serif; }
    .card { border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s; }
    .card:hover { transform: translateY(-5px); }
    h2 { font-weight: 600; }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4 text-center"> Seller Report Dashboard</h2>

  <!-- Quick Stats -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card text-center p-4 bg-primary text-white">
        <h4>Total Revenue</h4>
        <h2>₹<?php echo number_format($totalRevenue, 2); ?></h2>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center p-4 bg-success text-white">
        <h4>Total Orders</h4>
        <h2><?php echo $totalOrders; ?></h2>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center p-4 bg-warning text-dark">
        <h4>Low Stock Products </h4>
        
        <h4>[stock < 10]</h4>
        <h2><?php echo mysqli_num_rows($resStock); ?></h2>
      </div>
    </div>
  </div>

  <!-- Top Selling Products -->
  <div class="card p-4 mb-4">
    <h4>Top Selling Products</h4>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr><th>Product</th><th>Total Sold</th></tr>
      </thead>
      <tbody>
        <?php while($row=mysqli_fetch_assoc($resTop)){ ?>
          <tr>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['total_sold']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Revenue per Product Chart -->
  <div class="card p-4 mb-4">
    <h4>Revenue per Product</h4>
    <canvas id="prodChart" height="120"></canvas>
  </div>

  <!-- Revenue by Category (Chart) -->
  <div class="card p-4 mb-4">
    <h4>Revenue by Category</h4>
    <canvas id="catChart" height="120"></canvas>
  </div>

  <!-- Stock Alerts -->
  <div class="card p-4 mb-4">
    <h4> Low Stock Products</h4>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr><th>Product</th><th>Stock Left</th></tr>
      </thead>
      <tbody>
        <?php while($srow=mysqli_fetch_assoc($resStock)){ ?>
          <tr>
            <td><?php echo $srow['product_name']; ?></td>
            <td class="text-danger fw-bold"><?php echo $srow['stock']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script>
// Revenue by Category Chart
const ctxCat = document.getElementById('catChart').getContext('2d');
const catChart = new Chart(ctxCat, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($catLabels); ?>,
        datasets: [{
            data: <?php echo json_encode($catTotals); ?>,
            backgroundColor: [
              '#ff6384','#36a2eb','#ffce56','#4bc0c0','#9966ff',
              '#f77825','#9acd32','#8b0000','#20b2aa','#ff7f50'
            ]
        }]
    },
    options: {
        plugins: { legend: { position: 'bottom' } }
    }
});

// Revenue per Product Chart (Bar)
const ctxProd = document.getElementById('prodChart').getContext('2d');
const prodChart = new Chart(ctxProd, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($productLabels); ?>,
        datasets: [{
            label: 'Revenue (₹)',
            data: <?php echo json_encode($productTotals); ?>,
            backgroundColor: '#36a2eb',
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: { mode: 'index', intersect: false }
        },
        scales: {
            x: { ticks: { autoSkip: false } },
            y: { beginAtZero: true }
        },
        animation: {
            duration: 1500,
            easing: 'easeOutBounce'
        }
    }
});
</script>
</body>
</html>
