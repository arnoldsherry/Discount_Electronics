<?php
include("../dboperation.php");
$obj=new dboperation();

  $did=$_GET["district_id"];
  $sql="delete from tbl_district where district_id=$did";
  $res=$obj->executequery($sql);
 
  
  echo "<script>alert('Deleted Successfully!!');window.location='districtview.php'</script>";

?>