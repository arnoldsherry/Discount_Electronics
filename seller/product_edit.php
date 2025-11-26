<html>
<body>
<?php
include_once("header.php");
include_once('../dboperation.php');
$obj = new dboperation();

if (isset($_GET['productid'])) {
    $cid = $_GET['productid'];
    $sql = "SELECT * FROM tbl_product WHERE product_id = $cid";
    $res = $obj->executequery($sql);
    $display = mysqli_fetch_array($res);
}
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <p class="mb-0">Your business dashboard template</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="product_edit_action.php" method="post" enctype="multipart/form-data">
                            <h4>Product Details</h4>

                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $display['product_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="../uploads/<?php echo $display['product_image']; ?>" style="width:150px;"><br><br>
                                <label>Upload New Image</label>
                                <input type="file" name="product_image" class="form-control">
                            </div>

                            <input type="hidden" name="product_id" value="<?php echo $display['product_id']; ?>">

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="<?php echo $display['price']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="<?php echo $display['description']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Stock</label>
                                <input type="text" name="stock" class="form-control" value="<?php echo $display['stock']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Offer Percentage</label>
                                <input type="text" name="offer_perc" id="percent" class="form-control" value="<?php echo $display['offer_perc']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Offer Price</label>
                                <input type="text" name="offer_price" id="offerprice" class="form-control" value="<?php echo $display['offer_price']; ?>">
                            </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>
  

<script>
function calculateofferprice() {
    var actual = parseFloat(document.getElementById("price").value);
    var percent = parseFloat(document.getElementById("percent").value);
    if (!isNaN(actual) && !isNaN(percent)) {
        var offerprice = actual - (actual * percent / 100);
        document.getElementById("offerprice").value = offerprice.toFixed(2);
    }
}
document.getElementById("percent").oninput = calculateofferprice;
</script>

</body>
</html>