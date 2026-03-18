<?php
 
require('db.php');

$name=""; $mobile=""; $address=""; $username=""; $password=""; $update_id="";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['update_id'])){
        $update_id = $_POST['update_id'];
    }
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }

    if(isset($_POST['mobile'])) {
        $mobile = $_POST['mobile'];
    }

    if(isset($_POST['address'])) {
        $address = $_POST['address'];
    }

    if(isset($_POST['user_name'])){
        $username = $_POST['user_name'];
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }

    $sql = "UPDATE emp_form SET emp_name = '$name', emp_mobile = '$mobile', emp_address = '$address',  user_password = '$password' WHERE emp_id ='$update_id' ";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";

    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Profile</title>
</head>
<body>
<div class="container-fluid da">
        <div class="row">   
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); 
                $result=""; $user=""; $mobile_number = "";
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    if(!empty($username)){
                       $result = "SELECT * FROM emp_form WHERE user_name='$username'";

                        if(!empty($result)){
                            $user = $conn->query($result);
                        }
                        if(!empty($user)){
                            foreach($user as $list){
                                $update_id = $list['emp_id'];
                                $update_name = $list['emp_name'];
                                $update_mobile = $list['emp_mobile'];
                                $update_address = $list['emp_address'];
                                $update_username = $list['user_name'];
                                $update_password = $list['user_password'];
                            }
                        }
                    }
                    
                }
                ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center my-5">Employee Update Form</h3>
                <form action="profile.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                                Name: <input type="text" name="name" id="name" value="<?php if(!empty($update_name)){ echo $update_name; }?>"><br>
                                <span style="color:red" ><?php if(!empty($name_error)) { echo $name_error; } ?></span><br>
                                Mobile Number: <input type="text" name="mobile" id="mobile" maxlength="10" value="<?php if(!empty($update_mobile)){ echo $update_mobile; }?>"><br>
                                <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                                Address: <textarea name="address" rows="3" cols="30"><?php if(!empty($update_address)) { echo $update_address; } ?></textarea><br><br>
                                <!-- Username: <input type="text" name="user_name" id="user_name" value="<?php if(!empty($update_username)){ echo $update_username; }?>"><br><br>
                                <span style="color:red" ><?php if(!empty($username_error)) { echo $username_error; } ?></span><br> -->
                                Password: <input type="text" name="password" id="user_name" value="<?php if(!empty($update_password)){ echo $update_password; }?>"><br><br>
                                <span style="color:red" ><?php if(!empty($password_error)) { echo $password_error; } ?></span><br>
                                <center><input type="submit" name="submit" value="UPDATE" class="btn btn-primary"></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>