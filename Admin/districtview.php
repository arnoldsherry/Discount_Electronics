<?php
include_once("header.php");
include("../dboperation.php");
$obj=new dboperation();
$s="select * from tbl_district";
$res=$obj->executequery($s);
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
                             <br><br>
                            <a href="district.php" class="btn btn-warning">ADD districts</a>
                            <br>
                            <span class="ml-1">Datatable</span>
                            
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                   
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Datatable</h4>

                               >
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>District Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i =1;
                                            while($r=mysqli_fetch_array($res))
                                            {
                                            
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo $r["district_name"]; ?></td>
                                                    <td><a class="btn btn-danger btn-sm" href="districtdelete.php?district_id=<?php echo $r["district_id"]; ?>">DELETE</a></td>
                                                    <td><a class="btn btn-success btn-sm" href="districtedit.php?district_id=<?php echo $r["district_id"]; ?>">EDIT</a></td>
                                            
                                            </tr>
                                        
                                                <?php
                                                
                                            }
                                            ?>
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
include_once("footer.php");
?>