<?php
session_start();
include_once("../dboperation.php");
if (isset($_POST["categoryid"])) {
    $categoryid = $_POST["categoryid"];
    $brandid = $_POST['category_id'];
    $id = $_SESSION["seller_id"];
    $sql = "select * from tbl_product p inner join tbl_category c on p.category_id=c.category_id inner join tbl_brand b on p.brand_id=b.brand_id where p.seller_id='$id' and p.category_id='$categoryid' and p.brand_id='$brandid'";
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
        <tbody id="product">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

            <div class="card shadow-sm" style="width: 200px; border-radius: 10px; overflow: hidden;">
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
                    <td><img src="../uploads/<?php echo $row["product_image"]; ?>" style="max-width:50%;max-height:50%;object-fit:contain;overflow-hidden;"></td>
                    <td>
                        <a href="product_edit.php?productid=<?php echo $row["product_id"]; ?>" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <a href="product_delete.php?productid=<?php echo $row["product_id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>

            </div>
            <?php
            }
            ?>
        </tbody>
<?php
    } else {
        echo "No products found for the selected category and brand.";
}
}
?>
