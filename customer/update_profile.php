<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = (int)$_POST['customer_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $landmark = trim($_POST['landmark']);
    $address = trim($_POST['address']);
    $pincode = trim($_POST['pincode']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Optional

    if (empty($name) || empty($email) || empty($contact) || empty($landmark) || empty($address) || empty($pincode) || empty($username)) {
        echo "<div class='alert alert-danger'>Please fill in all required fields.</div>";
        exit;
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tbl_customer SET 
                customer_name='$name', 
                email='$email', 
                contact='$contact', 
                Landmark='$landmark', 
                address='$address', 
                pincode='$pincode', 
                username='$username',
                password='$hashed_password'
                WHERE customer_id = $customer_id";
    } else {
        $sql = "UPDATE tbl_customer SET 
                customer_name='$name', 
                email='$email', 
                contact='$contact', 
                Landmark='$landmark', 
                address='$address', 
                pincode='$pincode', 
                username='$username'
                WHERE customer_id = $customer_id";
    }

    $result = $obj->executequery($sql);

   if ($result) {
    echo "<script>
            alert('Profile updated successfully!');
            window.location.href = '../guest/login.php';
          </script>";
    exit;
} else {
    echo "<div class='alert alert-danger'>Error updating profile: " . $obj->con->error . "</div>";
    exit;
}
}
?>
