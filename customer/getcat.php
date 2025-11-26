<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (!empty($_POST['categoryid'])) {
  $categoryid = $_POST['categoryid'];
  $sql = "SELECT * FROM tbl_product WHERE category_id = '$categoryid'";
  $result = $obj->executequery($sql);

  while ($row = mysqli_fetch_array($result)) {
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
    <?php
  }
} else {
  echo "<p>No category selected.</p>";
}
?>
