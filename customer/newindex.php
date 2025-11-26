<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

// Fetch brands
$brand_sql = "SELECT brand_id, brand_name, image FROM tbl_brand";
$brand_res = $obj->executequery($brand_sql);
$brands = [];
while ($row = mysqli_fetch_assoc($brand_res)) $brands[] = $row;

// Fetch categories
$cat_sql = "SELECT category_id, category_name, image FROM tbl_category";
$cat_res = $obj->executequery($cat_sql);
$categories = [];
while ($row = mysqli_fetch_assoc($cat_res)) $categories[] = $row;

// Base64 placeholder (180x140 grey image with text "No Image")
$placeholder = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABeCAYAAABVrFvUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAACXZwQWcAAABeAAAAWgEz3yz8AAABJUlEQVR4nO3TMQ0AAAgDMO5f9FdhAqE9BmcGmKxHBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwC7UAAeX1sVfAAAAAASUVORK5CYII=";

// Function to render card
function renderCard($image, $name) {
    global $placeholder;
    $imagePath = "../uploads/" . $image;
    $finalImage = (!empty($image) && file_exists($imagePath)) ? $imagePath : $placeholder;

    return "<div class='card'>
                <img src='{$finalImage}' alt='" . htmlspecialchars($name) . "'>
                <h5>" . htmlspecialchars($name) . "</h5>
            </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="mobile-web-app-capable" content="yes">
  <title>Customer Dashboard</title>
  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin:0; padding:20px; background:#121212; color:#f5f5f5; }
    h1,h2 { text-align:center; margin-bottom:20px; }
    .marquee-container { overflow:hidden; white-space:nowrap; padding:15px 0; background:#1e1e1e; border-radius:12px; margin-bottom:40px; }
    .marquee-content { display:inline-flex; gap:20px; animation:marquee 30s linear infinite; }
    .marquee-container:hover .marquee-content { animation-play-state:paused; }
    @keyframes marquee { 0% { transform:translateX(0); } 100% { transform:translateX(-50%); } }
    .card { flex:0 0 auto; width:180px; height:220px; border-radius:12px; background:#2c2c2c; box-shadow:0 4px 15px rgba(0,0,0,0.4); overflow:hidden; text-align:center; transition:transform 0.3s ease, box-shadow 0.3s ease; padding:5px; }
    .card:hover { transform:scale(1.08); box-shadow:0 8px 20px rgba(0,0,0,0.6); }
    .card img { width:100%; height:140px; object-fit:cover; border-radius:8px; }
    .card h5 { margin:10px 0; font-size:1rem; color:#f5f5f5; }
    .bottom-nav { position:fixed; bottom:20px; width:100%; display:flex; justify-content:center; gap:40px; z-index:1000; }
    .bottom-nav a { display:flex; align-items:center; justify-content:center; width:50px; height:50px; background:#1e1e1e; border-radius:50%; box-shadow:0 4px 10px rgba(0,0,0,0.5); transition:transform 0.2s; }
    .bottom-nav a:hover { transform:scale(1.2); }
    .bottom-nav img { width:30px; height:30px; }
  </style>
</head>
<body>

<h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<h2>Our Brands</h2>
<div class="marquee-container">
  <div class="marquee-content">
    <?php foreach ($brands as $brand) echo renderCard($brand['image'], $brand['brand_name']); ?>
    <?php foreach ($brands as $brand) echo renderCard($brand['image'], $brand['brand_name']); ?>
  </div>
</div>

<h2>Our Categories</h2>
<div class="marquee-container">
  <div class="marquee-content">
    <?php foreach ($categories as $cat) echo renderCard($cat['image'], $cat['category_name']); ?>
    <?php foreach ($categories as $cat) echo renderCard($cat['image'], $cat['category_name']); ?>
  </div>
</div>

<div class="bottom-nav">
  <a href="paymenthistory.php"><img src="images/rupee.png" alt="Payments"></a>
  <a href="cart.php"><img src="images/cart.jpg" alt="Cart"></a>
  <a href="edit_profile.php"><img src="images/profile.png" alt="Profile"></a>
</div>

</body>
</html>
