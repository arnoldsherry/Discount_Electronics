<?php
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sql = "select * from tbl_brand";
$res = $obj->executequery($sql);
$sql1 = "select * from tbl_category";
$res1 = $obj->executequery($sql1);

?>
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Enter Product Details</h5>
        <div class="card">
          <div class="card-body">

            <form action="product_register_action.php" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="productname" class="form-label">Product Name</label>
                <input type="text" name="prodname" class="form-control" id="productname" aria-describedby="productname">
              </div>
              <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description">
              </div>
              <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock">
              </div>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Actual Price</label>
            <input type="number" name="price" class="form-control" id="price">
          </div>
        </div>
        <div class="mb-3">
          <label for="offer%" class="form-label">Offer percentage</label>
          <input type="number" name="offer_perc" class="form-control" id="percent">
        </div>
        <div class="mb-3">
          <label for="offer_price" class="form-label">Offer Price</label>
          <input type="number" name="offer_price" class="form-control" id="offerprice">
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label">brand</label>
          <div class="ms-auto mt-3 mt-md-0">
            <select class="form-select theme-select border-1" aria-label="Default select example" name="brand" id="brand">
              <option>--------Select brand----------</option>
              <?php
              while ($display = mysqli_fetch_array($res)) { ?>
                <option value="<?php echo $display["brand_id"] ?>"><?php echo $display["brand_name"] ?></option><?php

                                                                                                              }
                                                                                                                ?>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <div class="ms-auto mt-3 mt-md-0">
            <select class="form-select theme-select border-1" aria-label="Default select example" name="category" id="category" ">
                       <option>--------Select category----------</option>
                       <?php
                        while ($display = mysqli_fetch_array($res1)) { ?>
                       <option value=" <?php echo $display["category_id"] ?>"><?php echo $display["category_name"] ?></option><?php

                                                                                                                            }
                                                                                                                              ?>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Insert product image</label>
          <input type="file" name="product_image" id="productimage" class="form-control" required><br><br>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
        </form>
      </div>
       
    </div>
    <script>
      function calculateofferprice() {
        var actual = document.getElementById("price").value;
        var percent = document.getElementById("percent").value;
        if (actual && percent) {
          var offerprice = actual - (actual * percent / 100);
          document.getElementById("offerprice").value = offerprice.toFixed(2);
        }
      }
      document.getElementById("percent").oninput = calculateofferprice;
</script>
