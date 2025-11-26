<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET['catid']))
{
  $cid=$_GET["catid"];
  $sql="select * from tbl_seller where seller_id='$cid'";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);

  $sql="update tbl_seller set status='accepted' where seller_id='$cid'";
  $res=$obj->executequery($sql);
}

  echo "<script>alert('accepted Successfully!!');window.location='sellerverification.php'</script>";

?>
