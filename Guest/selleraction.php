<?php
include_once("../dboperation.php");
$obj=new dboperation();

    $sellername=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $idproof=$_POST['idproof'];
    $license=$_POST['license'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sqlquery="SELECT * FROM tbl_seller WHERE seller_name='$sellername'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        echo "<script>alert('Already exists');window.location='seller.php'</script>";
    }
    else
    {
        $sqlquery1="insert into tbl_seller(seller_name,email,phone,idproof,license,username,password,status) values('$sellername','$email','$phone','$idproof','$license','$username','$password','requested')";
        $result1=$obj->executequery($sqlquery1);
        if($result1)
        {
            echo "<script>alert('Registration successfull');window.location='login.php'</script>";
            if($result1==1){
             $bodyContent="Dear $sellername,Your registration is successfull.";
                $mailtoaddress=$email;
                require('../phpmailer.php');

                echo "<script>alert('Registration Successful!');
                window.location='Guest/login.php'</script>";
            
             }
        }
        else
        {
            echo "<script>alert('Registration failed');window.location='seller.php'</script>";
    }
}

?>
