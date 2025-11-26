<?php
session_start();
include_once("header.php");
include_once("../dboperation.php");

$obj = new dboperation();

// Fetch all categories
$sql = "SELECT * FROM tbl_category";
$res = $obj->executequery($sql);
?>
<br>
<br>
<br>
<br>
<br>
<div class="container py-5">
    <h2 style="color:black;">Available Categories</h2>
    <div class="row mt-4">
        <?php if($res && mysqli_num_rows($res) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($res)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <?php 
                        // Category image
                        $imagePath = !empty($row['image']) 
                            ? "../uploads/" . $row['image'] 
                            : "images/no-image.png";
                        ?>
                        <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo $row['category_name']; ?>" style="height:150px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $row['category_name']; ?></h5>
                            
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No categories available.</p>
        <?php endif; ?>
    </div>
</div>


