<?php
session_start();
include('db.php');

    $captcha = $_POST['captcha'];
    $ccaptcha = $_POST['ccaptcha'];
    $otp = $_POST['otp'];
    $n = $_SESSION['$n'];
    if($otp == $n){
        if($captcha == $ccaptcha){
            $email = $_POST["user-email"];
        
            $password = $_POST['password'];

            $cpassword = $_POST['cuser-password'];
            if($password == $cpassword){
                $pass = md5($password);
                $user_login = mysqli_query($conn,"Update user_info set user_password = '$pass' WHERE email='$email'");
                header('location: ../login.php');
            }
            else{
                header('location: ../forgotpass.php?result=pass-dont-match'); 
            }
        }
        else{
            header('location: ../forgotpass.php?result=wrong-captcha'); 
        }
    }else{
        header('location: ../forgotpass.php?result=wrong-otp');
    }
    
?>