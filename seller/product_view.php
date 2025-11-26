<?php
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$s2 = "SELECT * FROM tbl_category";
$res2 = $obj->executequery($s2);
$s3 = "select * from tbl_brand";
$res3 = $obj->executequery($s3);
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // alert("a")
     $("#categoryid").change(function() {
      //  alert("a")
      var category_id = $(this).val();
      //  alert(category_id)

      if (category_id) {

        $.ajax({
          url: "getproduct.php",
          method: "POST",
          data: {
            categoryid: category_id,
          },
          success: function(response) {
            $("#product").html(response);
          },
          error: function() {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else {
        $("#product").html("Please select both category and brand.");
      }
    });
      $("#brandid").change(function() {
      //  alert("a")
      var brandid = $(this).val();
      //  alert(category_id)

      if (brandid) {

        $.ajax({
          url: "getproductbrand.php",
          method: "POST",
          data: {
            brandid: brandid,
          },
          success: function(response) {
            $("#product").html(response);
          },
          error: function() {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else {
        $("#product").html("Please select both category and brand.");
      }
    });
    $("#brandid").change(function() {
      //  alert("a")
      var brandid = $(this).val();

      //  alert(brandid)
      var category_id = $("#categoryid").val();
      //  alert(category_id)

      if (category_id && brandid) {

        $.ajax({
          url: "getproduct1.php",
          method: "POST",
          data: {
            categoryid: category_id,
            brandid: brandid
          },
          success: function(response) {
            $("#product").html(response);
          },
          error: function() {
            $("#product").html("Error occurred while getting product!");
          }
        });
      } else {
        $("#product").html("Please select both category and brand.");
      }
    });
  });
</script>
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Product View</h4>
            <label>select a category</label>

            <select class="form-control" name="categoryid"
              id="categoryid" required>

              <option>--------Select Category-----------</option>
              <?php
              while ($display = mysqli_fetch_array($res2)) { ?>


                <option value="<?php echo $display["category_id"] ?>"> <?php echo $display["category_name"] ?> </option> <?php
                                                                                                                        }
                                                                                                                          ?>
            </select>
            <label>select a brand</label>

            <select class="form-control" name="brandid"
              id="brandid" required>

              <option>--------Select Brand-----------</option>
              <?php
              while ($display = mysqli_fetch_array($res3)) { ?>


                <option value="<?php echo $display["brand_id"] ?>"> <?php echo $display["brand_name"] ?> </option> <?php
                                                                                                                  }
                                                                                                                    ?>
            </select>
          </div>

        </div>
      </div>


      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex align-items-center">
              <div>
                <h4 class="card-title">Products</h4>

              </div>
            </div>
            <span class="btn btn-danger" onclick="window.location.href='product_register.php'">Add Products</span>
            <div class="table-responsive mt-4">
              <table class="table mb-0 text-nowrap varient-table align-middle fs-3" id="product">
               

                </tbody>
              </table>
            </div>
          </div>
        </div>
</div>
