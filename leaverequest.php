<?php
require('db.php');
$request_list = "";
$sql = "SELECT * FROM leave_form WHERE lev_status='pending' ";
$request_list = mysqli_query($conn, $sql);
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
    <title>Leave Bending Request</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center my-4">Employee Leave Request</h3>
                <form action="leaverequest.php" method="POST">
                            <table class = "table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope = "col">S.No</th>
                                <th scope = "col">Mobile Number</th>
                                <th scope = "col">Request Date</th>
                                <th scope = "col">From Date</th>
                                <th scope = "col">TO Date</th>
                                <th scope = "col">Total Leave Days</th>
                                <th scope = "col">Reason</th>
                                <th scope = "col">Status</th>
                                <th scope = "col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($request_list)) {
                                    foreach($request_list as $data) { ?>
                                        <tr>
                                            <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
                                            <td><?php if(!empty($data['mobile_number'])) { echo $data['mobile_number']; } ?></td>
                                            <td><?php if(!empty($data['req_date'])) { echo $data['req_date']; } ?></td>
                                            <td><?php if(!empty($data['from_date'])) { echo $data['from_date']; } ?></td>
                                            <td><?php if(!empty($data['to_date'])) { echo $data['to_date']; } ?></td>
                                            <td><?php if(!empty($data['no_days'])) { echo $data['no_days']; } ?></td>
                                            <td><?php if(!empty($data['lev_reason'])) { echo $data['lev_reason']; } ?></td>
                                            <td><?php if(!empty($data['lev_status'])) { echo $data['lev_status']; } ?></td>
                                            <td>
                                                <a href ="request_update.php?update_id=<?php echo $data['id']; ?>"class = "btn btn-primary">UPDATE</a>
                                            </td>

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

