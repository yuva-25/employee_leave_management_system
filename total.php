<?php
require('db.php');


$count=""; $count_list=""; $approve=""; $reject="";$selected_date = "";


$selected_date = date('Y-m-d');


$sql = "SELECT COUNT(lev_status) as count FROM  leave_form WHERE lev_status='pending'";
$count_list = mysqli_query($conn, $sql);
if(!empty($count_list)){
    foreach($count_list as $data){
        $count = $data['count'];
    }
}

$sql = "SELECT COUNT(lev_status) as count FROM  leave_form WHERE lev_status='approved'";
$count_list = mysqli_query($conn, $sql);
if(!empty($count_list)){
    foreach($count_list as $data){
        $approve = $data['count'];
    }
}

$sql = "SELECT COUNT(lev_status) as count FROM  leave_form WHERE lev_status='rejected'";
$count_list = mysqli_query($conn, $sql);
if(!empty($count_list)){
    foreach($count_list as $data){
        $reject = $data['count'];
    }
}

// echo $count;
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
    <title>Leave Request Details</title>
</head>
<body>

    <input type="hidden" id="to_date" name="to_date" value="<?php if(!empty($selected_date)){ echo $selected_date; } ?>">
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php'); ?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center py-3">Leave Request Status</h3>
                <!-- <form action="department.php" method="POST"> -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="b1 seo">
                            <h4 onclick="getpendingreport()" id="pending">Total Leave Request  <br> <?php if(!empty($count)){ echo $count;} else{echo 0;}?></h4>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="b2 seo">
                            <h4 onclick="getapprovereport()" id="approve"> Approved Request  <br> <?php if(!empty($approve)){ echo $approve;} else{echo 0;}?></h4>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="b3 seo">
                            <h4 onclick="getrejectreport()" id="reject">Rejected Request   <br><?php if(!empty($reject)){ echo $reject;} else{echo 0;}?></h4>
                        </div>
                    </div>
                </div>        
                <!-- </form> -->
                <div class="col-lg-12 py-5" id="table_result">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function getpendingreport(){
        var pending=""; var to_date="";
        
        if($('#to_date').length > 0){
            to_date = $('#to_date').val();
        }
        
        if($('#pending').length > 0){
            pending = $('#pending').val();
        }
        var post_url = "total_change.php?select_pending="+pending+"&select_date="+to_date;

        $.ajax({ url:post_url, success:function(result){
            if($("#table_result").length > 0) {
                $("#table_result").html(result);
            }
        }});
    }

    function getapprovereport(){
       
        var approved=""; to_date ="";
        if($('#to_date').length > 0){
            to_date = $('#to_date').val();
        }

        if($('#approve').length > 0){
            approved = $('#approve').val();
        }
        var post_url = "total_change.php?select_approve="+approved+"&approve_date="+to_date;;

        $.ajax({ url:post_url, success:function(result){
            if($("#table_result").length > 0) {
                $("#table_result").html(result);
            }
        }});
    }


    function getrejectreport(){
        var rejected=""; to_date ="";
        if($('#to_date').length > 0){
            to_date = $('#to_date').val();
        }
        if($('#reject').length > 0){
            approved = $('#reject').val();
        }
        var post_url = "total_change.php?select_reject="+rejected+"&reject_date="+to_date;;

        $.ajax({ url:post_url, success:function(result){
            if($("#table_result").length > 0) {
                $("#table_result").html(result);
            }
        }});
    }
</script>