<?php
require('db.php');


$sql = "SELECT * FROM department";
$dep_list = $dep_list = mysqli_query($conn, $sql);

$name=""; $name_error=""; $mobile=""; $mobile_error=""; $address=""; $deparment=""; $department_error="";
 $username=""; $username_error=""; $password=""; $password_error=""; $error =0;$prev_id=""; $prev_list="";$update_id="";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['name'])){
        $name=$_POST['name'];
    }
    if(empty($name)){
        $name_error="Enter Name";
        $error = 1;
    }else {
        if(!preg_match('/^[a-zA-z\s]+$/', $name)) {
          $name_error = "Invalid Name"; 
          $error = 1;
        }
    }

    if(isset($_POST['mobile'])) {
        $mobile = $_POST['mobile'];
    }
    if(empty($mobile)){
    $mobile_error = "Enter Mobile No";
    $error=1;
    } else{
    if(!preg_match('/^[0-9]{10}+$/', $mobile)){
        $mobile_error = "Invalid Mobile Number";
        $error = 1;
    }
    }
    
    if(!empty($mobile)) {
        $sql = "SELECT emp_id FROM emp_form WHERE emp_mobile='$mobile'";

        if(!empty($sql)) {
        $prev_list = $conn->query($sql);
        }

        if(!empty($prev_list)) {
        foreach($prev_list as $list) {
            $prev_id = $list['emp_id'];
        }
        }

        if($prev_id != "" && $prev_id != $update_id) {
        $mobile_error = "This Number Already Exists";
        $error = 1;
        }
    }

    if(isset($_POST['address'])) {
        $address = $_POST['address'];
    }

    if(isset($_POST['department'])) {
        $deparment = $_POST['department'];
    }
    if(empty($deparment)){
        $department_error = "Select Department";
        $error=1;
    } 

    if(isset($_POST['user_name'])){
        $username = $_POST['user_name'];
    }
    if(empty($username)) {
        $username_error = "Enter User Name";
        $error = 1;
    } else {
        if(!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,23}[0-9a-zA-Z]$/', $username)) {
        $username_error = "Invalid User Name"; 
        $error = 1;
        }
    }
    if(!empty($username)) {
        $sql = "SELECT emp_id FROM emp_form WHERE user_name ='$username'";

        if(!empty($sql)) {
        $prev_list = $conn->query($sql);
        }

        if(!empty($prev_list)) {
        foreach($prev_list as $list) {
            $prev_id = $list['emp_id'];
        }
        }

        if($prev_id != "" && $prev_id != $update_id) {
        $username_error = "This User Name is  Already Exists";
        $error = 1;
        }
    }


    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    if(empty($password)) {
        $password_error = "Enter password";
        $error = 1;
    }

    if($error == 0){
        $sql = "INSERT INTO  emp_form (emp_name, emp_mobile, emp_address, emp_dep, user_name, user_password) VALUES ('$name', '$mobile', '$address', '$deparment', '$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header("Location: employelist.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
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
    <title>Employee Form</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mt-3">Employee Form</h3>
                <form action="creation.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                                Name: <input type="text" name="name" id="name" value="<?php if(!empty($update_name)){ echo $update_name; }?>"><br>
                                <span style="color:red" ><?php if(!empty($name_error)) { echo $name_error; } ?></span><br>
                                Mobile Number: <input type="text" name="mobile" id="mobile" maxlength="10"><br>
                                <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                                Address: <textarea name="address" rows="3" cols="30"><?php if(!empty($update_address)) { echo $update_address; } ?></textarea><br><br>
                                Department:  <select name="department" id="department">
                                    <option value="">Select Department</option>
                                    <?php
                                    if(!empty($dep_list)){
                                        foreach($dep_list as $list){?>
                                        <option value="<?php if(!empty($list['dep_name'])){ echo $list['dep_name']; } ?>"><?php if(!empty($list['dep_name'])){ echo $list['dep_name']; } ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select><br><br>
                                <span style="color:red" ><?php if(!empty($department_error)) { echo $department_error; } ?></span><br>
                                Username: <input type="text" name="user_name" id="user_name"><br><br>
                                <span style="color:red" ><?php if(!empty($username_error)) { echo $username_error; } ?></span><br>
                                Password: <input type="password" name="password" id="user_name"><br><br>
                                <span style="color:red" ><?php if(!empty($password_error)) { echo $password_error; } ?></span><br>
                                <center><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary"></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>