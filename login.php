<?php
session_start();
require('db.php');

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin123");

$user_reg = ""; $password_reg = ""; $user_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['user_name'])){
        $username = $_POST['user_name'];
    }
    if(empty($username)) {
        $user_name_error = "Enter User Name";
        $error = 1;
    } else {
        if(!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,23}[0-9a-zA-Z]$/', $username)) {
        $user_name_error = "Invalid User Name"; 
        $error = 1;
        }
    }
   
    if(isset($_POST['user_password'])){
        $password = $_POST['user_password'];
    }
    if(empty($password)) {
        $password_error = "Enter password";
        $error = 1;
    }//else {
    //     if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/', $password)) {
    //     $password_error = "Invalid Password. Password minimum length should be 8.
    //     at least one uppercase letter,
    //     at least one lowercase letter,
    //     and one digit."; 
    //     $error = 1;
    //     }
    // }

    // Check if admin is logging in
    if(!empty($username)){
        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            $_SESSION['userid'] = "admin"; // Unique identifier for admin.
            $_SESSION['username'] = ADMIN_USERNAME;
            $_SESSION['role'] = "admin";
    
            header("Location: dashboard.php");
            exit();
        }
        else{
            if(!empty($username)){
                $sql = "SELECT  user_name, user_password FROM emp_form WHERE user_name='$username'";
                if(!empty($sql)){
                    $user_details = $conn->query($sql);
                }
                if(!empty($user_details)){
                    foreach($user_details as $data){
                        $user_reg = $data['user_name'];
                        $password_reg = $data['user_password'];
                    }
                    
                    if($username == $user_reg  && $password == $password_reg){
                            $_SESSION['username'] = $username;
                            // $_SESSION['password'] = $password;
                            $_SESSION['role'] = "user";
            
                            header("Location: dashboard.php");
                            exit();
                    }else {
                        $user_error = "Invalid User.";
                    }   
               }
            }
        } 
    }
    
}  

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .tre{font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;}
        .bo{padding: 0; margin: 30px 0px 0px;}
        .img1 img{height: auto; border-radius: 70px 0px 70px 0px;}
        .for{font-size: 20px;margin-top: 50px; text-align: center;}
        .ep{font-size: 35px;}
        .lo{color: #8686ff;}
        .btn-primary:hover {background-color: #7682cd; border-color: #7682cd;}
        .btn-primary {background-color: #7682cd; border-color: #7682cd;}
    </style>
    <title>Login Form</title>
</head>
<body>
<form action="login.php" method="POST">
        <div class="container mt-4">
        <h3 class="tre text-center ep">Employee Leave <span style="color: #7682cd;">Management System</span></h3>
            <div class="row bo">     
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="bg2">
                            <div class="img1">
                            <img src="images/login1.png"  alt="login" class="img-fluid" title="login" height="100">
                            </div>
                        </div> 
                    </div>      
                <div class="col-lg-6 col-md-6 col-12 for pl-5">  
                    <h4 class="tre  my-4 pb-3 lo">LOGIN FORM</h4>
                    Username: <input type="text" name="user_name"><br>
                    <span style="color:red" ><?php if(!empty($user_name_error)) { echo $user_name_error; } ?></span><br><br>
                    Password: <input type="password" name="user_password"><br>
                    <span style="color:red" ><?php if(!empty($password_error)) { echo $password_error; } ?></span><br><br>
                    <span style="color:red" ><?php if(!empty($user_error)) { echo $user_error; } ?></span>
                    <center><input type="submit" name="submit" value="Login" class="btn btn-primary"></center>
                </div>
                
            </div>
        </div>
           
        
    </form>
</body>
</html>