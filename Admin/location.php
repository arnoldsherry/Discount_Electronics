<?php
include_once('header.php');


include_once("../dboperation.php");
$obj = new dboperation();
$sql = "select * from tbl_district";
$res = $obj->executequery($sql);

?>





<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card" style="margin-left:21%;margin-top:137px;">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Location Registration</h4>
            <p class="card-description">

            </p>
            <form action="location_action.php" class="forms-sample" method="post">
              <div class="form-group">


                <label>select a district</label>

                <select class="form-control" name="districtid"
                  id="seldistrictid" onchange="this.form.submit()">

                  <option>--------Select District-----------</option>
                  <?php
                  while ($display = mysqli_fetch_array($res)) { ?>


                    <option value="<?php echo $display["district_id"] ?>"> <?php echo $display["district_name"] ?> </option> <?php
                                                                                                                          }
                                                                                                                            ?>
                </select>


                <label for="exampleInputUsername1">location name</label>
                <input type="text" class="form-control" name="locationname" id="locationname" placeholder="Location name">
              </div>


              <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>



            </form>
          </div>
        </div>
      </div>
    </div>

    <br><br><br><br><br><br><br><br><br>




    <!-- content-wrapper ends -->
    <?php
    include_once('footer.php');
    ?>