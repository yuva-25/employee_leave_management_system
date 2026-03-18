<?php
require('db.php');

$from_date = ""; $fromdate_error=""; $to_date = ""; $todate_error=""; $days=""; $days_error=""; $reason = ""; $reason_error=""; $leave=""; $leave_error=""; $error=0; $status=""; $datetime1 = ""; $datetime2 =""; $dateDiff=""; $interval=""; $req_date=""; $mobile=""; $mobile_error="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['reqs_date']){
        $req_date=$_POST['reqs_date'];
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

    if($_POST['from_date']){
        $from_date=$_POST['from_date'];
    }
    if(empty($from_date)){
        $fromdate_error = "Select From Date";
        $error = 1;
    }

    if($_POST['to_date']){
        $to_date=$_POST['to_date'];
    }
    if(empty($to_date)){
        $todate_error = "Select From Date";
        $error = 1;
    }

    if($_POST['days']){
        $days=$_POST['days'];
    }
    if(empty($days)){
        $days_error = "Enter No of days";
        $error = 1;
    }else{
        if(!preg_match('/^[0-9]+$/', $days)){
            $days_error = "Invalid Days";
            $error =1;
            
        }
    }
    if($_POST['reason']){
        $reason=$_POST['reason'];
    }
    if(empty($reason)){
        $reason_error = "Enter Reason";
        $error = 1;
    }else{
        if(!preg_match('/^[a-zA-z\s]+$/', $reason)){
            $reason_error = "Invalid Only In letters";
            $error = 1;   
        }
    }
    
    if($_POST['leave']){
        $leave=$_POST['leave'];
    }
    if(empty($leave)){
        $leave_error = "Select Leave Type";
        $error = 1;
    }
    if($_POST['status']){
        $status=$_POST['status'];
    }

    if(!empty($from_date) && !empty($to_date)){
        if($to_date > $from_date){
            function dateDiffInDays($date1, $date2) {
        
                // Calculating the difference in timestamps
                $diff = strtotime($date2) - strtotime($date1);
    
                // 1 day = 24 hours
                // 24 * 60 * 60 = 86400 seconds
                return abs(round($diff / 86400));
            }
    
            // Start date
            $date1=$from_date;
    
            // End date
            $date2 = $to_date;
    
            // Function call to find date difference
            $dateDiff = dateDiffInDays($date1, $date2);
    
            // Display the result
            // printf("Difference between two dates: "
            //     . $dateDiff . " Days ");
        }else{
            $todate_error = "To date Must be greater than the ".$from_date;
        }
        // Function to find the difference 
        // between two dates.

       
    }
    if($error == 0){
        $sql = "INSERT INTO leave_form (mobile_number, req_date, from_date, to_date, no_days, lev_reason, lev_type, lev_status)
        VALUES('$mobile', '$req_date', '$from_date', '$to_date', '$dateDiff', '$reason', '$leave', '$status')";
        if (mysqli_query($conn, $sql)) {
            // echo "Created Record successfully";
            // header("Location: departmentlist.php");
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }  
    }
    
}

$req_date = date('Y-m-d');

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
    <title>Leave Form</title>
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
                       $result = "SELECT emp_mobile FROM emp_form WHERE user_name='$username'";

                        if(!empty($result)){
                            $user = $conn->query($result);
                        }

                        if(!empty($user)){
                            foreach($user as $list){
                                $mobile_number = $list['emp_mobile'];
                            }
                        }
                    }
                }
                ?>
                
            </div>
            <div class="col-lg-9">
                <h3 class="text-center">Leave Form</h3>
                <form action="userleave.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                                Mobile Number : <input type="text" name="mobile" id="mobile" maxlength="10" value="<?php if(!empty($mobile_number)){echo $mobile_number; } ?>" ><br>
                                <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                                Request Date: <input type="date" name="reqs_date" id="reqs_date"  class = "btn btn-outline-primary" value="<?php if(!empty($req_date)){ echo $req_date; }?>"><br>
                                <span style="color:red" ><?php if(!empty($fromdate_error)) { echo $fromdate_error; } ?></span><br>
                                From Date: <input type="date" name="from_date" id="from_date" onchange="getdays()" class = "btn btn-outline-primary"><br>
                                <span style="color:red" ><?php if(!empty($fromdate_error)) { echo $fromdate_error; } ?></span><br>
                                To Date: <input type="date" name="to_date" id="to_date" onchange="getdays()" class = "btn btn-outline-primary"><br>
                                <span style="color:red" ><?php if(!empty($todate_error)) { echo $todate_error; } ?></span><br>
                                No of Days: <input type="text" name="days" id="days" readonly><br>
                                <span style="color:red"><?php if(!empty($days_error)) { echo $days_error; } ?></span><br>
                                Reason: <input type="text" name="reason" id="reason"><br>
                                <span style="color:red" ><?php if(!empty($reason_error)) { echo $reason_error; } ?></span><br>
                                Leave Type: <select name="leave" id="leave" class="btn btn-outline-primary">
                                    <option value="" >Select Leave Type</option>
                                    <option value="causalleave">Causal Leave</option>
                                    <option value="sickleave">Sick Leave</option>
                                </select><br>
                                <span style="color:red" ><?php if(!empty($leave_error)) { echo $leave_error; } ?></span><br>
                                <input type="hidden" name="status" id="status" value="pending">
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
<script>
    function getdays(){        
        // Calculating the time difference
        // of two dates
        var get_to_date = $('#from_date').val();
        var get_from_date = $('#to_date').val();


        if( get_to_date != "" && get_from_date != ""){
            var date1 = new Date(get_to_date);
            var date2 = new Date(get_from_date);
            if(date2 > date1) {
                var Difference_In_Time =
                date2.getTime() - date1.getTime();

                // Calculating the no. of days between
                // two dates
                var Difference_In_Days =
                    Math.round
                    (Difference_In_Time / (1000 * 3600 * 24));

            } else {
                $('#to_date').after('<span> To date Must be greater than the '+ get_to_date+'</span>');
            }
            
           
            $('#days').val(Difference_In_Days);
            // alert(Difference_In_Days);
        }
        
    }
</script>