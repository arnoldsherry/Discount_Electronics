<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['customer_id'])) {
    // Redirect if no customer logged in
    header("Location: login.php");
    exit;
}

$customerid = (int)$_SESSION['customer_id'];

// Fetch customer data
$sql = "SELECT customer_name, email, contact, Landmark, address, pincode, username 
        FROM tbl_customer WHERE customer_id = '$customerid'";

$result = $obj->executequery($sql);

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>No customer found.</div>";
    include_once("footer.php");
    exit;
}

$customer = $result->fetch_assoc();
?>

<section class="py-5">
  <div class="container-fluid">
    <div class="bg-secondary py-5 my-5 rounded-5" style="background: url('images/bg-leaves-img-pattern.png') no-repeat;">
      <div class="container my-5">
        <div class="row">
          <div class="col-md-6 p-5">
            <div class="section-header">
              <h2 class="section-title display-4"><span class="text-primary">Edit</span> Your Profile</h2>
            </div>
          </div>
          <div class="col-md-6 p-5">
            <form action="update_profile.php" method="post">
              <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customerid); ?>">
              
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter Your Name" required
                  value="<?php echo htmlspecialchars($customer['customer_name']); ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com" required
                  value="<?php echo htmlspecialchars($customer['email']); ?>">
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Contact</label>
                <input type="tel" class="form-control form-control-lg" name="contact" id="phone" placeholder="Enter Your contact Number" required
                  value="<?php echo htmlspecialchars($customer['contact']); ?>">
              </div>
              <div class="mb-3">
                <label for="landmark" class="form-label">Landmark</label>
                <input type="text" class="form-control form-control-lg" name="landmark" id="landmark" placeholder="Enter Your Landmark" required
                  value="<?php echo htmlspecialchars($customer['Landmark']); ?>">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control form-control-lg" name="address" id="address" placeholder="Enter Your Address" required
                  value="<?php echo htmlspecialchars($customer['address']); ?>">
              </div>
              <div class="mb-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control form-control-lg" name="pincode" id="pincode" placeholder="Enter Your Pincode" required
                  value="<?php echo htmlspecialchars($customer['pincode']); ?>">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username" required
                  value="<?php echo htmlspecialchars($customer['username']); ?>">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Set new password (leave blank to keep current)</label>
                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
              </div>
              
              <div class="d-grid gap-2">
                <input type="submit" value="Update Profile" class="btn btn-dark btn-lg">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include_once("footer.php");
?>
