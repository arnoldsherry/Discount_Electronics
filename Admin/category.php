<?php
include_once("header.php");
?>

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

                        <h4>Personal Info</h4>
                        <div class="col-lg-12 mb-4">
                            <form action="category_action.php" method="POST" enctype="multipart/form-data">
                                <!-- <div class="form-group"> -->
                                <label class="text-label">Enter your Category</label>
                                <input type="text" name="category" id="category" class="form-control"><br><br>
                                <input type="file" name="image" id="image" class="form-control"><br><br>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("footer.php");
?>