<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['location_id'];
    $Category_name=$_POST['location_name'];
           $sql="UPDATE tbl_location set location_name='$Category_name' where location_id=$id";
    $result=$obj->executequery($sql);
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='location_view.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='location_view.php' </script>";
}
}
?>