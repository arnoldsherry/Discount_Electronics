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

// Fetch seller details
$sql = "SELECT * FROM tbl_seller WHERE seller_id='$seller_id'";
$res = $obj->executequery($sql);
$seller = mysqli_fetch_assoc($res);

// Handle form submission
if(isset($_POST['update_profile'])){
    $seller_name = $_POST['seller_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $idproof = $_POST['idproof'];
    $license = $_POST['license'];

    // Update query
    $sql_update = "UPDATE tbl_seller SET 
                   seller_name='$seller_name',
                   email='$email',
                   phone='$phone',
                   username='$username',
                   password='$password',
                   idproof='$idproof',
                   license='$license'
                   WHERE seller_id='$seller_id'";
    $res_update = $obj->executequery($sql_update);

    if($res_update){
        echo "<script>alert('Profile updated successfully'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to update profile');</script>";
    }
}
?>
<br><br><br><br>
<div class="container py-5">
    <h2>Seller Profile</h2>
    <form method="post" onsubmit="return validateForm();" action="">
        <div class="mb-3">
            <label class="form-label">Seller Name:</label>
            <input type="text" name="seller_name" id="seller_name" class="form-control" value="<?php echo htmlspecialchars($seller['seller_name']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($seller['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($seller['phone']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($seller['username']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($seller['password']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Proof:</label>
            <input type="text" name="idproof" id="idproof" class="form-control" value="<?php echo htmlspecialchars($seller['idproof']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">License:</label>
            <input type="text" name="license" id="license" class="form-control" value="<?php echo htmlspecialchars($seller['license']); ?>">
        </div>

        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<script>
function validateForm() {
    // Seller Name: letters & spaces only
    let name = document.getElementById('seller_name').value.trim();
    if(!/^[a-zA-Z\s]+$/.test(name)) {
        alert('Seller Name can contain letters and spaces only.');
        return false;
    }

    // Email: basic validation
    let email = document.getElementById('email').value.trim();
    if(!/^\S+@\S+\.\S+$/.test(email)) {
        alert('Enter a valid email address.');
        return false;
    }

    // Phone: digits only, length 10-15
    let phone = document.getElementById('phone').value.trim();
    if(!/^\d{10,15}$/.test(phone)) {
        alert('Phone must be 10-15 digits.');
        return false;
    }

    // Username: alphanumeric, min 3 chars
    let username = document.getElementById('username').value.trim();
    if(!/^[a-zA-Z0-9]{3,}$/.test(username)) {
        alert('Username must be alphanumeric and at least 3 characters.');
        return false;
    }

    // // Password: min 6 chars
    // let password = document.getElementById('password').value.trim();
    // if(password.length < 6) {
    //     alert('Password must be at least 6 characters.');
    //     return false;
    // }

    // Optional: ID Proof & License max length 50
    let idproof = document.getElementById('idproof').value.trim();
    if(idproof.length > 50) {
        alert('ID Proof cannot exceed 50 characters.');
        return false;
    }

    let license = document.getElementById('license').value.trim();
    if(license.length > 50) {
        alert('License cannot exceed 50 characters.');
        return false;
    }

    return true; // all checks passed
}
</script>


