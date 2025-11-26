<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET['catid']))
{
  $cid=$_GET["catid"];
  $sql="select * from tbl_brand where brand_id='$cid'";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);

 $imagefiles=["../uploads/" .$display["image"]];

  foreach($imagefiles as $file)
  {
    if(file_exists($file))
    {
      unlink($file);
    }
  }
  $sql="delete from tbl_brand where brand_id='$cid'";
  $res=$obj->executequery($sql);
}

  echo "<script>alert('Deleted Successfully!!');window.location='brandview.php'</script>";

?>
