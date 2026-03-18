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
    <title>Status</title>
</head>
<body>
<div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); 
                 $result=""; $username="";  $leave=""; $user_name=""; $mobile_number=""; $request_date="";
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    

                    if(!empty($username)){
                        $result = "SELECT * FROM emp_form WHERE user_name='$username'";

                        if(!empty($result)){
                            $user = $conn->query($result);
                        }

                        if(!empty($user)){
                            foreach($user as $list){
                                $mobile_number = $list['emp_mobile'];
                            }
                        }

                        $selected_date ="";
                        $selected_date = date('Y-m-d');
                        $sql = "SELECT * FROM  leave_form WHERE req_date = '$selected_date' AND mobile_number = $mobile_number";
                        if(!empty($sql)){
                            $leave = mysqli_query($conn, $sql);
                        }
                        if(!empty($leave)){
                        foreach($leave as $list){
                            $request_date = $list['req_date'];
                            $from_date = $list['from_date'];
                            $to_date = $list['to_date'];
                            $total_days = $list['no_days'];
                            $status = $list['lev_status'];
                        }
                        }
                    }
                }
                
                ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center py-3">Leave Request Status</h3>
                <form action="department.php" method="POST">
                    <div class="container pl-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <?php if(!empty($selected_date)){
                                    if($selected_date == $request_date){?>
                                        <div id="status" class="py-3 px-5">
                                        <h4 > <i class="bi bi-calendar3"></i> Leave Request Date - <?php if(!empty($request_date)){echo $request_date; }?>  </h4><br>
                                        <!-- <h4 > <i class="bi bi-calendar-check"></i> To Date - <?php if(!empty($to_date)){echo $to_date; }?>  </h4> <br>
                                        <h4 > <i class="bi bi-plus-square"></i> Total Days - <?php if(!empty($total_days)){echo $total_days; }?>  </h4><br> -->
                                        <h4 > <i class="bi bi-check"></i> Status - <?php if(!empty($status)){echo $status; }?>  </h4><br>
                                        </div>
                                   <?php }
                                } ?>
                                
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
    // $(document).ready(function(){
    //     $('#status').fadeIn();
    // })
</script>