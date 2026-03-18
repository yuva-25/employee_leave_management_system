<?php
require('db.php');
$delete_id = ""; $delete_details = array();

$sql = "SELECT * FROM department";
$dep_list = mysqli_query($conn, $sql);

if(isset($_REQUEST['delete_id'])) {
    $delete_id = $_REQUEST['delete_id'];
  
    if(!empty($delete_id)) {
      $delete_sql = "DELETE FROM department  WHERE dep_id='$delete_id' ";
  
      if(!empty($delete_sql)) {
        $delete_details = $conn->query($delete_sql);
        echo "Record Deleted Successfuly";
        header("Location: departmentlist.php");
      }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  
    }
}
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
    <title>Department List</title>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <?php include('dashboard.php');?>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center">Department list</h3>
                <form action="departmentlist.php" method="POST">
                    <a href="department.php" class="btn btn-outline-primary my-3">ADD</a>
                    <table class = "table table-hover" id="tab"> 
                        <thead>
                            <tr>
                                <th scope = "col">S.No</th>
                                <th scope = "col">Department Name</th>
                                <th scope = "col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($dep_list)) {
                                    foreach($dep_list as $data) { ?>
                                        <tr>
                                            <td><?php if(!empty($data['dep_id'])) { echo $data['dep_id']; } ?></td>
                                            <td><?php if(!empty($data['dep_name'])) { echo $data['dep_name']; } ?></td>
                                            <td>
                                                <a href ="department.php?update_id=<?php echo $data['dep_id']; ?>"class = "btn btn-primary">UPDATE</a>
                                                <a href="departmentlist.php?delete_id=<?php echo $data['dep_id'] ?>" class = "btn btn-primary">DELETE</a>
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
<!-- <script>
    $(document).ready(function(){
        $('#tab').fadeIn();
    });
</script> -->