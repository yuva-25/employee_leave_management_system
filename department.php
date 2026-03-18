<?php
require('db.php');

$update_id = ""; $user_details = array(); $prev_list = array(); $prev_id = "";

if(isset($_REQUEST['update_id'])) {
  $update_id = $_REQUEST['update_id'];

  if(!empty($update_id)) {
    $update_sql = "SELECT * FROM  department WHERE dep_id='$update_id'";

    if(!empty($update_sql)) {
      $user_details = $conn->query($update_sql);
    }

    if(!empty($user_details)) {
        foreach($user_details as $data) {
          $update_name = $data['dep_name'];
        }
    }
  }
}

$dep_name = ""; $dep_error = ""; $error=0;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['name'])){
        $dep_name=$_POST['name'];
    }

    if(empty($dep_name)){
        $dep_error = "Enter Department Name";
        $error=1;
    }else{
    if(!preg_match('/^[a-zA-z\s]+$/', $dep_name)) {
            $dep_error = "Invalid Department Name";
            $error = 1;
        }
    }
    if(!empty($dep_name)) {
        $sql = "SELECT dep_id FROM department WHERE dep_name='$dep_name'";
    
        if(!empty($sql)) {
          $prev_list = $conn->query($sql);
        }
    
        if(!empty($prev_list)) {
          foreach($prev_list as $list) {
            $prev_id = $list['dep_id'];
          }
        }
    
        if($prev_id != "" && $prev_id != $update_id) {
          $dep_error = "This Department Name is Already Exists";
          $error = 1;
        }
    }

    if($error == 0 ){
        if(empty($update_id)){
            $sql = "INSERT INTO department (dep_name)
            VALUES('$dep_name')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                header("Location: departmentlist.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }else{
            $sql = "UPDATE department SET dep_name = '$dep_name' WHERE dep_id='$update_id' ";
            if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
              header("Location: departmentlist.php");
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }  
        }
       
    }

    
}
// echo $dep_error."hello";

mysqli_close($conn);
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
    <title>Department Name</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center">Add Department Name</h3>
                <form action="department.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                                Department Name: <input type="text" name="name" id="name" value="<?php if(!empty($update_name)){ echo $update_name; }?>"><br><br>
                                <span style="color:red" ><?php if(!empty($dep_error)) { echo $dep_error; } ?></span><br><br>
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