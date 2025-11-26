<?php
session_start();
include_once("../dboperation.php");
$obj=new dboperation();
    $prodname=$_POST['prodname'];
    $description=$_POST['description'];
    $stock=$_POST['stock'];
    $price=$_POST['price'];
    $offer_perc=$_POST['offer_perc'];
    $offer_price=$_POST['offer_price'];
    $brand=$_POST['brand'];
    $category=$_POST['category'];
    $prod_img=$_FILES['product_image']['name'];
    move_uploaded_file($_FILES["product_image"]["tmp_name"],"../uploads/".$prod_img);
    $seller_id=$_SESSION['seller_id'];
    $sqlquery="SELECT * FROM tbl_product WHERE product_name='$prodname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        echo "<script>alert('Already exists');window.location='product_register.php'</script>";
    }
    else
    {
        $sqlquery1="insert into tbl_product(product_name,description,stock,price,offer_perc,offer_price,brand_id,category_id,seller_id,product_image) values('$prodname','$description','$stock','$price','$offer_perc','$offer_price','$brand','$category','$seller_id','$prod_img')";
        $result1=$obj->executequery($sqlquery1);
        if($result1)
        {
            echo "<script>alert('Registration successfull');window.location='product_view.php'</script>";
        }
        else
        {
         echo "<script>alert('Registration failed');window.location='product_register.php'</script>";
   }
}

?>
