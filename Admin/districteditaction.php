<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['district_id'];
    $Category_name=$_POST['district_name'];
           $sql="UPDATE tbl_district set district_name='$Category_name' where district_id=$id";
    $result=$obj->executequery($sql);
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='districtview.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='districtview.php' </script>";
}
}
?>