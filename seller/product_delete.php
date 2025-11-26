<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET['productid']))
{
  $cid=$_GET["productid"];
  $sql="select * from tbl_product where product_id='$cid'";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);

 $imagefiles=["../uploads/" .$display["product_image"]];

  foreach($imagefiles as $file)
  {
    if(file_exists($file))
    {
      unlink($file);
    }
  }
  $sql="delete from tbl_product where product_id='$cid'";
  $res=$obj->executequery($sql);
}

  echo "<script>alert('Deleted Successfully!!');window.location='product_view.php'</script>";

?>
