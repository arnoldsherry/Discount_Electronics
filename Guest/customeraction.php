<?php
include_once("../dboperation.php");
$obj=new dboperation();

    $customername=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['contact'];
    $Landmark=$_POST['Landmark'];
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sqlquery="SELECT * FROM tbl_customer WHERE customer_name='$customername'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        echo "<script>alert('Already exists');window.location='customer.php'</script>";
    }
    else
    {
        $sqlquery1="insert into tbl_customer(customer_name,email,contact,Landmark,address,pincode,username,password) values('$customername','$email','$phone','$Landmark','$address','$pincode','$username','$password')";
        $result1=$obj->executequery($sqlquery1);
        if($result1)
        {
             echo "<script>alert('Registration successfull');window.location='login.php'</script>";
             if($result1==1){
             $bodyContent="Dear $customername,Your registration is successfull.";
                $mailtoaddress=$email;
                require('../phpmailer.php');

                echo "<script>alert('Registration Successful!');
                window.location='Guest/login.php'</script>";
            
             }
        }
        else
        {
             echo "<script>alert('Registration failed');window.location='customer.php'</script>";
    }
}

?>
