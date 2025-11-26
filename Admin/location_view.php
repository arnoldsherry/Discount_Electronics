<?php
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sql = "select * from tbl_district";
$res = $obj->executequery($sql);
?>
<script src="../jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
            //alert("a")
			$("#districtid").change(function() {
               // alert("a")
				var district_id = $(this).val();

                // alert(district_id)

                
				$.ajax({
					url: "getlocation.php",
					method: "POST",
					data: { districtid: district_id },
					success: function(response) 
                    {
						$("#location").html(response);
					},
					error: function() 
                    {
						$("#location").html("Error occurred while getting location!");
					}
				});
			});
		});
	</script>


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
           
        </div>
        <!-- row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-header">
                        
                    </div>
                    <div class="form-group">


                <label>select a district</label>

                <select class="form-control" name="districtid"
                  id="districtid" onchange="this.form.submit()">

                  <option>--------Select District-----------</option>
                  <?php
                  while ($display = mysqli_fetch_array($res)) { ?>


                    <option value="<?php echo $display["district_id"] ?>"> <?php echo $display["district_name"] ?> </option> <?php
                                                                                                                          }
                                                                                                                            ?>
                </select>


                <!-- <label for="exampleInputUsername1">location name</label> -->
                <!-- <input type="text" class="form-control" name="locationname" id="locationname" placeholder="Location name"> -->
              </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="location">
                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>