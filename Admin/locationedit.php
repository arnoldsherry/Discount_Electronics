<html>
<body>
<?php
include_once("header.php");
include_once('../dboperation.php');
$obj = new dboperation();


if(isset($_GET['locationid']))
{
$cid= $_GET['locationid'];
$sql="select * from tbl_location where location_id=$cid";
$res=$obj->executequery($sql);
$display=mysqli_fetch_array($res);
}
?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0">Your business dashboard template</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Components</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                           
                            <div class="card-body">
                                <form action="locationeditaction.php" method="post" id="step-form-horizontal" class="step-form-horizontal" enctype="multipart/form-data">
                                    <div>
                                        <h4>Location details</h4>

                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Enter your Location name</label>
                                                        <input type="text" name="location_name" id="category_name" class="form-control" value="<?php echo $display['location_name'];?>"><br><br>
                                                        
                                                        
                                                        <input type="hidden" name="location_id" value="<?php echo $display['location_id'];?>">
                                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                    </div>
                                        </form>
                                                </div>
                                            </div>
                                        </section>
                                       
    
                                        </section>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
    

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    


    <script src="./vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="./js/plugins-init/jquery.validate-init.js"></script>



    <!-- Form step init -->
    <script src="./js/plugins-init/jquery-steps-init.js"></script>
<?php
include_once("footer.php");
?>

</body>

</html>

