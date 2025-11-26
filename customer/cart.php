<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");

$customer_id = $_SESSION['customer_id'];
$cart_key = 'cart_' . $customer_id;
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
  


<div class="container py-5">
    <h2 style="color:black;">Your Cart</h2>
    <br><br><br>

    <?php if (isset($_SESSION[$cart_key]) && count($_SESSION[$cart_key]) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th> <!-- New Stock column -->
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($_SESSION[$cart_key] as $item): 
                    $grand_total += $item['total'];

                    // Set image path
                    $imagePath = !empty($item['product_image']) 
                        ? "../uploads/" . $item['product_image'] 
                        : "images/no-image.png";
                ?>
                <tr>
                    <td>
                        <img src="<?php echo $imagePath; ?>" 
                             alt="<?php echo $item['product_name']; ?>" 
                             width="80" height="80">
                    </td>
                    <td><?php echo $item['product_name']; ?></td>
                    <td>₹<?php echo $item["offerprice"]; ?></td>
                    <td><?php echo $item['stock']; ?></td> <!-- Display stock -->
                    <td>
                        <form method="post" action="update_cart.php" class="d-flex">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">

                            <input type="number" 
                                   name="quantity" 
                                   id="quantity_<?php echo $item['product_id']; ?>" 
                                   value="<?php echo $item['quantity']; ?>" 
                                   min="1" 
                                   oninput="updateQuantity(<?php echo $item['product_id']; ?>, <?php echo $item['stock']; ?>);" 
                                   class="form-control form-control-sm me-2" 
                                   style="width: 80px;">

                            <button type="submit" class="btn btn-primary btn-sm">
                                Update
                            </button>
                        </form>
                    </td>
                    <td>₹<?php echo number_format($item['total']); ?></td>
                    <td>
                        <a href="remove_from_cart.php?id=<?php echo $item['product_id']; ?>" 
                           class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="5" align="right"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>₹<?php echo number_format($grand_total); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <a href="checkout.php?total=<?php echo $grand_total; ?>" class="btn btn-success">Proceed to Checkout</a>
        <a href="searchbc.php?total=<?php echo $grand_total; ?>" class="btn btn-danger">Add more</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<!-- JS: auto-submit on quantity change with stock validation -->
<script>
function updateQuantity(pid, stock) {
    let qtyInput = document.getElementById("quantity_" + pid);
    let qty = parseInt(qtyInput.value);

    // Stock validation
    if (qty > stock) {
        alert("Choose less than available stock");
        qtyInput.value = stock;
        qty = stock;
    }

    // Prevent quantity < 1
    if (qty < 1) {
        qtyInput.value = 1;
        qty = 1;
    }

    // Auto-submit the parent form
    let form = qtyInput.closest("form");
    form.submit();
}
</script>

<?php include_once("footer.php"); ?>
