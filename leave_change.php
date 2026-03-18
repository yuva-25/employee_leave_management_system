<?php

require('db.php');


if(isset($_REQUEST['selected_from_date'])){
    $selected_from_date = ""; $selected_to_date = ""; $where = "";
    $selected_from_date = $_REQUEST['selected_from_date'];
    $selected_to_date = $_REQUEST['selected_to_date'];
    $selected_mobile = $_REQUEST['selected_mobile'];

    
    if(!empty($selected_mobile)){
        $where .= "mobile_number = '$selected_mobile'";
    }
    if(!empty($selected_from_date)) {
        if(!empty($where)) {
            $where .= " AND from_date >= '$selected_from_date'";
        } else {
            $where .= " from_date >= '$selected_from_date'";
        }
    }

    if(!empty($selected_to_date)) {
        if(!empty($selected_to_date)) {
            $where .= " AND to_date <= '$selected_to_date'";
        } else {
            $where .= " to_date <= '$selected_to_date'";
        }
    }        

    if(!empty($where)) {
           $leave_query = "SELECT * FROM leave_form  WHERE $where";
    } 
    
    if(!empty($where)){
        $leave_list = $conn->query($leave_query);
    }
?>

    
<?php }

if(!empty($leave_list)) {
    foreach($leave_list as $data) { ?>
        <tr>
            <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
            <td><?php if(!empty($data['from_date'])) { echo $data['from_date']; } ?></td>
            <td><?php if(!empty($data['to_date'])) { echo $data['to_date']; } ?></td>
            <td><?php if(!empty($data['no_days'])) { echo $data['no_days']; } ?></td>
            <td><?php if(!empty($data['lev_reason'])) { echo $data['lev_reason']; } ?></td>
            <td><?php if(!empty($data['lev_status'])) { echo $data['lev_status']; } ?></td>
        </tr>
<?php  }
}
?>