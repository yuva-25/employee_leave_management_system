<?php
require('db.php');
$emp_list = "";
$sql = "SELECT * FROM emp_form";
$emp_list = mysqli_query($conn,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php');?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center my-4">Employee list</h3>
                <form action="employelist.php" method="POST">
                    <a href="creation.php" class="btn btn-outline-primary my-3">ADD</a>
                    <table class = "table table-hover">
                        <thead>
                            <tr>
                                <th scope = "col">S.No</th>
                                <th scope = "col">Employee Name</th>
                                <th scope = "col">Mobile Number</th>
                                <th scope = "col">Address</th>
                                <th scope = "col">Department</th>
                                <th scope = "col">Username</th>
                                <!-- <th scope = "col">Password</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($emp_list)) {
                                    foreach($emp_list as $data) { ?>
                                        <tr>
                                            <td><?php if(!empty($data['emp_id'])) { echo $data['emp_id']; } ?></td>
                                            <td><?php if(!empty($data['emp_name'])) { echo $data['emp_name']; } ?></td>
                                            <td><?php if(!empty($data['emp_mobile'])) { echo $data['emp_mobile']; } ?></td>
                                            <td><?php if(!empty($data['emp_address'])) { echo $data['emp_address']; } ?></td>
                                            <td><?php if(!empty($data['emp_dep'])) { echo $data['emp_dep']; } ?></td>
                                            <td><?php if(!empty($data['user_name'])) { echo $data['user_name']; } ?></td>
                                            <!-- <td><?php if(!empty($data['user_password'])) { echo $data['user_password']; } ?></td> -->
                                            <!-- <td>
                                                <a href ="department.php?update_id=<?php echo $data['dep_id']; ?>"class = "btn btn-primary">UPDATE</a>
                                                <a href="departmentlist.php?delete_id=<?php echo $data['dep_id'] ?>" class = "btn btn-primary">DELETE</a>
                                            </td> -->

                                        </tr>
                                <?php  }
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>