<?php
include("dbcon.php");

if(isset($_POST["sign_up"]))
{
    $uemail = $_POST["uEmail"];
    $pass = $_POST["upwd"];
    $uname = $_POST["uName"];
    $status="Offline";
    $file = $_FILES['photo'];

    $filename = $file['name'];
    $filepath = $file['tmp_name'];
    $filerror = $file['error'];


    if($name == ''){
        echo"<script>alert('We can not Verify Your name')</script>";
    }
    $check_email = "Select * from users where user_email ='$uemail'";
    $run_email = mysqli_query($connect,$check_email);

    $check = mysqli_num_rows($run_email);

    if($check == 1){
        echo"<script>alert('Email already exist , please try again!')</script>";
        echo"<script>window.open('signup.php','_self')</script>";
        exit();
    }
    elseif($filerror == 0){

        $destfile = 'upload/'.$filename;
        move_uploaded_file($filepath,$destfile);
        $sql = "INSERT INTO users (User,email,pwd,log_in,pp) VALUES ('$uname','$uemail','$pass','$status','$destfile')";

    }
    
    if($connect->query($sql))
        header('Location: index.php');
    else
    {
        echo"<script>alert('Registration failed , please try again!')</script>";
            echo"<script>window.open('registerUser.php','_self')</script>";
    }
        // echo "Error,Please Try Again.";
}
?>