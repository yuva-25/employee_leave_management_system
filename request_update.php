<?php
require('db.php');
$update_id = ""; $user_details = array();

if(isset($_REQUEST['update_id'])){
    $update_id = $_REQUEST['update_id'];

    if(!empty($update_id)){
        $update_sql = "SELECT * FROM  leave_form WHERE id='$update_id'";

        if(!empty($update_sql)){
            $user_details = $conn->query($update_sql);
        }

        if(!empty($user_details)) {
            foreach($user_details as $data) {
            $update_from_date = $data['from_date'];
            $update_to_date = $data['to_date'];
            $update_days = $data['no_days'];
            $update_reason = $data['lev_reason'];
            }
        }
    }

}

$status=""; $remark=""; $booking_no="";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
   
    if(isset($_POST['update_id'])){
        $status=$_POST['update_id'];
    }
    if(isset($_POST['status'])){
        $status=$_POST['status'];
    }
    if(isset($_POST['remark'])){
        $remark=$_POST['remark'];
    }

    $sql = "UPDATE leave_form SET lev_status = '$status', lev_remark = '$remark' WHERE id='$update_id'";
    if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    header("Location: leaverequest.php");
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }   

}


// echo $status;
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Update</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center my-4">Leave Request</h3>
                <form action="request_update.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                                From Date: <input type="date" name="from_date" id="from_date" onchange="getdays()" class = "btn btn-outline-primary" value="<?php if(!empty($update_from_date)){ echo $update_from_date; } ?>"><br>
                                <span style="color:red" ><?php if(!empty($fromdate_error)) { echo $fromdate_error; } ?></span><br>
                                To Date: <input type="date" name="to_date" id="to_date" onchange="getdays()" class = "btn btn-outline-primary" value="<?php if(!empty($update_to_date)){ echo $update_to_date; } ?>"><br>
                                <span style="color:red" ><?php if(!empty($todate_error)) { echo $todate_error; } ?></span><br>
                                No of Days: <input type="text" name="days" id="days" value="<?php if(!empty($update_days)){ echo $update_days; } ?>"><br>
                                <span style="color:red" ><?php if(!empty($days_error)) { echo $days_error; } ?></span><br>
                                Reason: <input type="text" name="reason" id="reason" value="<?php if(!empty($update_reason)){ echo $update_reason; } ?>"><br>
                                <span style="color:red" ><?php if(!empty($reason_error)) { echo $reason_error; } ?></span><br>
                                <span style="color:red" ><?php if(!empty($leave_error)) { echo $leave_error; } ?></span><br>
                                <div class="stat">
                                    <select name="status" id="status" class="btn btn-primary">
                                        <option value="">Status</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select><br><br>
                                    Remarks: <input type="text" name="remark" id="remark"><br><br>
                                    <input type="submit" value="Update" name="submit" class="btn btn-primary"><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>