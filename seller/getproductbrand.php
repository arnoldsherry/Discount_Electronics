<?php
session_start();
include_once("../dboperation.php");
if (isset($_POST["brandid"])) {
    $brandid = $_POST["brandid"];
    $id = $_SESSION["seller_id"];
    $sql = "select * from tbl_product p inner join tbl_category c on p.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id where p.seller_id='$id' and p.brand_id='$brandid'";
    $obj = new dboperation();
    $result = $obj->executequery($sql);
    $s = 1;
    if (mysqli_num_rows($result) > 0) {
?>
        <thead>
            <tr>
                <th scope="col" class="px-0 text-muted text-end">
                    Product ID
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Product Name
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Price
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Description
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    stock
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Brand Name
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Category
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Offer Percentage
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Offer Price
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Product Image
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Action
                </th>
                <th scope="col" class="px-0 text-muted text-end">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>


                <tr>
                    <td><?php echo $s++; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["stock"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["offer_perc"]; ?></td>
                    <td><?php echo $row["offer_price"]; ?></td>
                    <td><img src="../uploads/<?php echo $row["product_image"]; ?>" style="width:150px;height:150px;"></td>
                    <td>
                        <a href="productedit.php?productid=<?php echo $row["product_id"]; ?>" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <a href="productdelete.php?productid=<?php echo $row["product_id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>


            <?php
            }
            ?>
        </tbody>
<?php
    } else {
        echo "No products found for the selected brand.";
}
}
?>
