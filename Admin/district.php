<html>
<body>
<?php
include_once("header.php");
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
                                <form action="districtaction.php" method="post" id="step-form-horizontal" class="step-form-horizontal">
                                    <div>
                                        <h4>Personal Info</h4>

                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Enter your district</label>
                                                        <input type="text" name="districtname" id="districtid" class="form-control" required><br><br>
                                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
