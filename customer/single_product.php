<?php
session_start();
$customer_id = $_SESSION['customer_id'];
$cart_key = 'cart_' . $customer_id;
include_once("header.php");
include_once("../dboperation.php");

$obj = new dboperation();
$productid = $_GET['id'];
$_SESSION['pid']=$productid;
// Get product id from URL
if (isset($_GET['id'])) {
    $productid = $_GET['id'];
    $sql = "SELECT * FROM tbl_product WHERE product_id='$productid'";
    $res = $obj->executequery($sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
    } else {
        echo "<h2>Product not found.</h2>";
        include_once("footer.php");
        exit();
    }
} else {
    echo "<h2>No product selected.</h2>";
    include_once("footer.php");
    exit();
}
?>


 
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
    
<form action="singleproductaction.php" class="forms-sample" method="POST">
    <div class="container-fluid container-team py-5">
        <div class="container pb-5">
            <div class="row g-5 align-items-center mb-5">
                
                <!-- Product Image -->
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <img class="img-fluid w-100" 
                         src="../uploads/<?php echo $row['product_image']; ?>" 
                         alt="<?php echo $row['product_name']; ?>">
                </div>

                <!-- Product Details -->
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 mb-3"><?php echo $row['product_name']; ?></h1>
                    
                    <h4 class="text-success mb-3"><?php echo "<strong style='color: black;'>Actual prize </strong>"."₹".number_format($row['price']); ?></h4>
                    <h4 class="text-success mb-3"><?php echo "<strong style='color: black;'>Offer prize </strong>"."₹".number_format($row['offer_price']); ?></h4>

                    <p class="mb-4">
                        <strong>Description:</strong><br>
                        <?php echo $row['description']; ?>
                    </p>

                    <!-- Stock -->
                    <p class="mb-4">
                        <strong>Available Stock:</strong><br>
                        <?php echo $row['stock']; ?>
                    </p>
                    
                    

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" 
                               class="form-control" min="1" max="<?php echo $row['stock'];?>"
                               oninput="zeroduty();checkQuantity();calculateTotal();">
                    </div>
                    
                    <script>
                        var st=<?php echo $row['stock'];?>;
                        function checkQuantity()
                        {
                        a = document.getElementById("quantity");
                        b=a.value;
                        if(b>st)
                        {
                        alert("Choose less than available stock");
                        a.value=st;
                        }
                        }
                    </script>


                    
    

                    <!-- Hidden Price -->
                    <input type="hidden" name="price" id="price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="offer_price" id="offer_price" value="<?php echo $row['offer_price']; ?>">
                    
                    <!-- Total Amount -->
                    <div class="mb-3">
                        <label class="form-label">Total Amount:</label>
                        <input type="text" id="total" name="total" 
                               value="<?php echo $row['offer_price']; ?>" 
                               readonly class="form-control">
                    </div>

                    <!-- Hidden Product ID -->
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

                    <!-- Buttons -->
                    <div id="buttonmanager" class="d-flex gap-3">
                        <button type="submit" name="add_to_cart" class="btn btn-primary">
                            Add to Cart
                        </button>
                        <button type="submit" name="buy_now" class="btn btn-success">
                            Buy Now
                        </button>
                    </div>

                    <!-- Social Icons -->
                    <div class="d-flex mt-4">
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include_once("footer.php"); ?>

<script>
    function calculateTotal() {
        let quantity = document.getElementById('quantity').value;
        let offerPrice = document.getElementById('offer_price').value;
        let total = quantity * offerPrice;
        document.getElementById('total').value = total;
    }
</script>

<!--Zero duty -->
                     <script>
                        var st=<?php echo $row['stock'];?>;
                        function zeroduty()
                        {
                        a = document.getElementById("quantity");
                        amt = document.getElementById("total");
                        managebutton=document.getElementById("buttonmanager");
                        b=a.value;
                        if(st==0)
                        {
            
                        a.value=0;
                        amt.value=0;
                        managebutton.innerHTML="";
                        managebutton.innerHTML += "<div class='d-flex gap-3'><h1 style='background:black;color:white;border:2px solid red;'>Out of Stock</h1></div>";
                        managebutton.innerHTML += "<div class='d-flex gap-3'><span class='btn btn-success' onclick=\"window.location.href='searchbc.php'\">choose<br> other</span></div>";
                        }
                        }
                        window.onload=zeroduty;
                    </script>
