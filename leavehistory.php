<?php
require('db.php');
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
    <title>Leave History</title>
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
                <h3 class="text-center my-4">Leave History</h3>
                <input type="hidden" id="mobile" name="mobile" value="<?php if(!empty($mobile_number)){ echo $mobile_number; } ?>">
                <form action="userleave.php" method="POST">
                    <div class="container">
                        <div class="row justify-content-center">                                                        
                            <div class="col-lg-3">
                                <input type="date" name="from_date" id="from_date" onchange="getreport()" class = "btn btn-outline-primary">
                            </div>
                            <div class="col-lg-3 pb-5">
                                <input type="date" name="to_date" id="to_date" onchange="getreport()" class = "btn btn-outline-primary">
                            </div>
                            <table class = "table table-hover">
                                <thead>
                                    <tr>
                                        <th scope = "col">S.No</th>
                                        <th scope = "col">From Date</th>
                                        <th scope = "col">TO Date</th>
                                        <th scope = "col">No of Leave Days</th>
                                        <th scope = "col">Reason</th>
                                        <th scope = "col">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="report">
                                </tbody>
                            </table>                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function getreport(){

        var from_date = ""; var selected_to_date = "";  var mobile = "";
        if($('#from_date').length > 0){
            from_date = $('#from_date').val();
        }

        if($('#to_date').length > 0){
            selected_to_date = $('#to_date').val();
        }
        if($('#mobile').length > 0){
            mobile = $('#mobile').val();
        }

        var post_url = "leave_change.php?selected_from_date="+from_date+"&selected_to_date="+selected_to_date+"&selected_mobile="+mobile;

        $.ajax({ url:post_url, success:function(result){
            if($("#report").length > 0) {
                $("#report").html(result);
            }
        }});
    }
</script>