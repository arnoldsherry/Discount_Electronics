<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();
$username = $_POST["username"];
$password = $_POST["password"];

$sqlquery = "select * from tbl_adminlogin where username='$username' and password='$password'";
$result = $obj->executequery($sqlquery);
 $sqlquery1 = "select * from tbl_seller where username='$username' and password='$password' and status='accepted'";
$result1 = $obj->executequery($sqlquery1);
$sqlquery2 = "select * from tbl_customer where username='$username' and password='$password'";
$result2 = $obj->executequery($sqlquery2);
if (mysqli_num_rows($result) == 1) {
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["loginid"] = $row["loginid"];
   header("location:..\Admin\index.php");
} 
else if(mysqli_num_rows($result1) == 1)
{


   $row1 = mysqli_fetch_array($result1);
   $_SESSION["username"] = $username;
   $_SESSION["seller_id"] = $row1["seller_id"];

   header("location:..\seller\index.php");   
}
else {

if (mysqli_num_rows($result2) == 1) {
   $row2 = mysqli_fetch_array($result2);
   $_SESSION["username"] = $username;
   $_SESSION["customer_id"] = $row2["customer_id"];

   header("location:..\customer\searchbc.php");
} 
   // Invalid login, display an error message
   echo "<script>alert('Invalid Username/Password!!'); window.location='login.php'</script>";
}
