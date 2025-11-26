<?php
// session_start();
include("header.php");
include("../dboperation.php"); // adjust path if needed
$obj = new dboperation();

// fetch sellers
$sql = "SELECT * FROM tbl_seller where STATUS='accepted'";
$sql1 = "SELECT * FROM tbl_seller where STATUS='rejected'";
$result = mysqli_query($obj->con, $sql);
$result1 = mysqli_query($obj->con, $sql1);
?>
<!--**********************************
    Content body start
***********************************-->
<body style="background-image: url(images/admindark.jpg); background-size:cover;">
<div class="content-body" style="min-height: 876px;background: black;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background: black;">
                        <img class="testimonial-author-img ml-3" src="./images/seller admin side logo.jpeg" alt="">
                    </div>
                    <div class="card-body" style="background: black;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                    <tr>
                                 <thead class="thead-color">
                                       <?php
                                       if ($result && mysqli_num_rows($result) > 0) {
                                         // print column names dynamically
                                         ?>
                                        <h1 style="font-size:22px;" class="btn btn-success text-dark">Accepted Sellers</h1>
                                        <br>
                                        <br>
                                        <?php
                                            $fieldinfo = mysqli_fetch_fields($result);
                                            foreach ($fieldinfo as $field) {
                                                echo "<th>" . htmlspecialchars($field->name) . "</th>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        mysqli_data_seek($result, 0); // rewind result
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            foreach ($row as $value) {
                                                echo "<td>"."<span class='btn btn-success'>". htmlspecialchars($value) ."</span>". "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='100%' class='text-center'>No sellers found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            
                            <table class="table table-bordered table-striped">
                                    <tr>
                                 <thead class="thead-color">
                                       <?php
                                       if ($result1 && mysqli_num_rows($result1) > 0) {
                                        ?>
                                         <!-- // print column names dynamically -->
                                         <h1 style="font-size:22px;" class="btn btn-danger text-light">Rejected Sellers</h1>
                                        <br>
                                        <br>
                                         <?php
                                            $fieldinfo = mysqli_fetch_fields($result1);
                                            foreach ($fieldinfo as $field) {
                                                echo "<th>" . htmlspecialchars($field->name) . "</th>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result1 && mysqli_num_rows($result1) > 0) {
                                        mysqli_data_seek($result1, 0); // rewind result
                                        while ($row = mysqli_fetch_assoc($result1)) {
                                            echo "<tr>";
                                            foreach ($row as $value) {
                                                echo "<td>" ."<span class='btn btn-danger'>". htmlspecialchars($value) ."</span>". "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='100%' class='text-center'>No sellers found</td></tr>";
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
</body>
<!--**********************************
    Content body end
***********************************-->
<?php
include("footer.php");
?>
