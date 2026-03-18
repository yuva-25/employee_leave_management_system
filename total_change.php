<?php
require('db.php');

if(isset($_REQUEST['select_pending'])){
    $select_pending = "";  $select_date="";
    $select_pending = $_REQUEST['select_pending'];
    $select_date = $_REQUEST['select_date'];

    if(!empty($select_date)){

    }

    if(empty($select_pending)){
        $sql = "SELECT * FROM  leave_form WHERE to_date <= '$select_date' AND lev_status='pending'";
        $pending_list = mysqli_query($conn,$sql);?>

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">S.NO</th>
            <th scope="col">Request Date</th>
            <th scope="col">From date</th>
            <th scope="col">To Date</th>
            <th scope="col">Total Days</th>
            <th scope="col">Reason</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($pending_list)) {
            foreach($pending_list as $data) { ?>
            <tr>
                <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
                <td><?php if(!empty($data['req_date'])) { echo $data['req_date']; } ?></td>
                <td><?php if(!empty($data['from_date'])) { echo $data['from_date']; } ?></td>
                <td><?php if(!empty($data['to_date'])) { echo $data['to_date']; } ?></td>
                <td><?php if(!empty($data['no_days'])) { echo $data['no_days']; } ?></td>
                <td><?php if(!empty($data['lev_reason'])) { echo $data['lev_reason']; } ?></td>
                <td><?php if(!empty($data['lev_status'])) { echo $data['lev_status']; } ?></td>
            </tr>
        <?php } }
        } else { ?>
        <td colspan="8">No record created</td>    
        <?php  } ?>
        </tbody> 
    </table>
        
    <?php }


if(isset($_REQUEST['select_approve'])){
    $select_approve = ""; $select_date="";
    $select_approve = $_REQUEST['select_approve'];
    $select_date = $_REQUEST['approve_date'];

    if(empty($select_approve)){
        $sql = "SELECT * FROM  leave_form WHERE to_date <= '$select_date' AND lev_status='approved'";
        $approve_list = mysqli_query($conn,$sql);?>

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">S.NO</th>
            <th scope="col">Request Date</th>
            <th scope="col">From date</th>
            <th scope="col">To Date</th>
            <th scope="col">Total Days</th>
            <th scope="col">Reason</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($approve_list)) {
            foreach($approve_list as $data) { ?>
            <tr>
                <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
                <td><?php if(!empty($data['req_date'])) { echo $data['req_date']; } ?></td>
                <td><?php if(!empty($data['from_date'])) { echo $data['from_date']; } ?></td>
                <td><?php if(!empty($data['to_date'])) { echo $data['to_date']; } ?></td>
                <td><?php if(!empty($data['no_days'])) { echo $data['no_days']; } ?></td>
                <td><?php if(!empty($data['lev_reason'])) { echo $data['lev_reason']; } ?></td>
                <td><?php if(!empty($data['lev_status'])) { echo $data['lev_status']; } ?></td>
            </tr>
        <?php } }
        } else { ?>
        <td colspan="8">No record created</td>    
        <?php  } ?>
        </tbody> 
    </table>
        
    <?php 
}

if(isset($_REQUEST['select_reject'])){
    $select_reject = ""; $select_date="";
    $select_reject = $_REQUEST['select_reject'];
    $select_date = $_REQUEST['reject_date'];
    if(empty($select_reject)){
        $sql = "SELECT * FROM  leave_form WHERE to_date <= '$select_date' AND lev_status='rejected'";
        $reject_list = mysqli_query($conn,$sql);?>

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">S.NO</th>
            <th scope="col">Request Date</th>
            <th scope="col">From date</th>
            <th scope="col">To Date</th>
            <th scope="col">Total Days</th>
            <th scope="col">Reason</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($reject_list)) {
            foreach($reject_list as $data) { ?>
            <tr>
                <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
                <td><?php if(!empty($data['req_date'])) { echo $data['req_date']; } ?></td>
                <td><?php if(!empty($data['from_date'])) { echo $data['from_date']; } ?></td>
                <td><?php if(!empty($data['to_date'])) { echo $data['to_date']; } ?></td>
                <td><?php if(!empty($data['no_days'])) { echo $data['no_days']; } ?></td>
                <td><?php if(!empty($data['lev_reason'])) { echo $data['lev_reason']; } ?></td>
                <td><?php if(!empty($data['lev_status'])) { echo $data['lev_status']; } ?></td>
            </tr>
        <?php } }
        } else { ?>
        <td colspan="8">No record created</td>    
        <?php  } ?>
        </tbody> 
    </table>
        
    <?php 
}

?>



