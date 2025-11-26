<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $offer_perc = $_POST['offer_perc'];
    $offer_price = $_POST['offer_price'];

    $product_img = $_FILES["product_image"]["name"];
    $img_path = "../uploads/" . $product_img;

    // If a new image is uploaded
    if (!empty($product_img)) {
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $img_path);
        $sql = "UPDATE tbl_product SET 
                    product_name = '$product_name',
                    product_image = '$product_img',
                    price = '$price',
                    description = '$description',
                    stock = '$stock',
                    offer_perc = '$offer_perc',
                    offer_price = '$offer_price'
                WHERE product_id = $id";
    } else {
        // No new image uploaded
        $sql = "UPDATE tbl_product SET 
                    product_name = '$product_name',
                    price = '$price',
                    description = '$description',
                    stock = '$stock',
                    offer_perc = '$offer_perc',
                    offer_price = '$offer_price'
                WHERE product_id = $id";
    }

    $result = $obj->executequery($sql);

    if ($result == 1) {
        echo "<script>alert('Product updated successfully'); window.location='product_view.php';</script>";
    } else {
        echo "<script>alert('Update failed'); window.location='product_view.php';</script>";
    }
}
?>