<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sellername = $_SESSION['username'];
$customerid = $_SESSION['customer_id'];
echo "<h1>Welcome " . $sellername . "</h1>";

// Fetch categories and brands
$categoryQuery = "SELECT * FROM tbl_category";
$categoryResult = $obj->executequery($categoryQuery);

$brandQuery = "SELECT * FROM tbl_brand";
$brandResult = $obj->executequery($brandQuery);
?>
<!-- jQuery -->
<script src="../jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    function loadProducts() {
      var category_id = $("#categoryid").val();
      var brand_id = $("#brandid").val();

      if (category_id && brand_id) {
        $.ajax({
          url: "getbc.php",
          method: "POST",
          data: { categoryid: category_id, brandid: brand_id },
          success: function (response) {
            $("#product").html(response);
          },
          error: function () {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else if (category_id) {
        $.ajax({
          url: "getcat.php",
          method: "POST",
          data: { categoryid: category_id },
          success: function (response) {
            $("#product").html(response);
          },
          error: function () {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else if (brand_id) {
        $.ajax({
          url: "getbrand.php",
          method: "POST",
          data: { brand_id: brand_id },
          success: function (response) {
            $("#product").html(response);
          },
          error: function () {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else {
        $("#product").html("<p>Please select a category or brand.</p>");
      }
    }

    $("#categoryid, #brandid").change(loadProducts);
  });
</script>

<body style="background-image: url(images/sbc.png);">

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


<div class="tabs-header d-flex justify-content-between border-bottom my-5">
  <h3>Select Brand and Category to Display Products</h3>
</div>

<div class="col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
  <div class="search-bar row bg-light p-3 my-4 rounded-4 align-items-center">

    <!-- Category Dropdown -->
    <div class="col-md-6 mb-2 mb-md-0">
      <select class="form-select border-0" id="categoryid">
        <option value="">Select Category</option>
        <?php while ($row = mysqli_fetch_array($categoryResult)) { ?>
          <option value="<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"]; ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Brand Dropdown -->
    <div class="col-md-6">
      <select class="form-select border-0" id="brandid">
        <option value="">Select Brand</option>
        <?php while ($row = mysqli_fetch_array($brandResult)) { ?>
          <option value="<?php echo $row["brand_id"]; ?>"><?php echo $row["brand_name"]; ?></option>
        <?php } ?>
      </select>
    </div>

  </div>
  <h1>Products</h1>
</div>

<div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5" id="product" style="display: flex; flex-wrap: wrap; gap: 20px; padding: 20px;">
  <?php
  $productQuery = "SELECT * FROM tbl_product";
  $productResult = $obj->executequery($productQuery);

  while ($row = mysqli_fetch_assoc($productResult)) {
  ?>
    <div class="card shadow-sm" style="width: 200px; border-radius: 10px; overflow: hidden;">
      <img src="../uploads/<?php echo $row['product_image']; ?>" 
           class="card-img-top" 
           alt="<?php echo $row['product_name']; ?>" 
           style="max-height:50%;max-width:50%; object-fit: cover;"/>
      <div class="card-body">
        <h6 class="card-title"><?php echo $row['product_name']; ?></h6>
        <p class="card-text">Stock: <?php echo $row['stock']; ?></p>
        <p class="card-text">Actual Price: <?php echo $row['price']; ?></p>
        <p class="card-text"><span class="bg bg-danger text-dark">Offer Price: <?php echo $row['offer_price']; ?></span></p>
        <a href="single_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-sm">View</a>
      </div>
    </div>
  <?php } ?>
</div>

</body>

<?php include_once("footer.php"); ?>
