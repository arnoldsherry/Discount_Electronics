<?php
include_once("../dboperation.php");
$obj=new dboperation();

if(isset($_POST['submit']))
{
    $catname = $_POST['brand'];
    $photo = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $photo);

    $sqlquery="SELECT * FROM tbl_brand WHERE brand_name='$catname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        echo "<script>alert('Already exists');window.location='brand.php'</script>";
    }
    else
    {
        $sqlquery1="insert into tbl_brand(brand_name,image) values('$catname','$photo')";
        $result1=$obj->executequery($sqlquery1);
        if($result1)
        {
            echo "<script>alert('Registration successfull');window.location='brandview.php'</script>";
        }
        else
        {
            echo "<script>alert('Registration failed');window.location='brandview.php'</script>";
    }
}
}
?>
