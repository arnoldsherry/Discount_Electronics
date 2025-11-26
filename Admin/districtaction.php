<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
    $districtname=$_POST['districtname'];
    $sqlquery="SELECT * FROM tbl_district WHERE district_name='$districtname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        echo "<script>alert('Already exists');window.location='district.php'</script>";
    }
    else
    {
        $sqlquery1="insert into tbl_district(district_name) values('$districtname')";
        $result1=$obj->executequery($sqlquery1);
        if($result1)
        {
            echo "<script>alert('Registration successfull');window.location='districtview.php'</script>";
        }
        else
        {
            echo "<script>alert('Registration failed');window.location='district.php'</script>";
        }
    }
}
?>