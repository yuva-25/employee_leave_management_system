<?php 
session_start();
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
    <style>
        .b1{background-image: linear-gradient(#adb7ff,#eceeff); color:black; border-radius: 20px 0px 20px 0px; padding: 30px 15px; box-shadow: 0 5px 15px rgba(41, 41, 59, 0.49); font-size: 16;}
        .b2{background-image: linear-gradient(#eceeff,#a9aabc); color:black; border-radius: 0px 20px 0px 20px; padding: 30px 15px; box-shadow: 0 5px 15px rgba(41, 41, 59, 0.49); font-size: 16;}
        .b3{background-image: linear-gradient(#adb7ff,#eceeff); color:black; border-radius: 20px 0px 20px 0px; padding: 30px 15px; box-shadow: 0 5px 15px rgba(41, 41, 59, 0.49); font-size: 16;}
        .bo{padding :0; margin:0;}
        .btn-primary:hover {background-color: #7682cd; border-color: #7682cd;}
        .btn-primary {background-color: #7682cd; border-color: #7682cd;}
        .btn-outline-primary:hover {color: #fff;background-color: #7682cd; border-color: #7682cd;}
        .btn-outline-primary{color: #7682cd; border-color: #7682cd;}
        .tre{
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;  
        }
        .seo{font-family: cursive;}

        .wrapper {
            display: flex;
        }

        .sidebar {
            width: 350px;
            background-color: #7682cd;
            color: #fffffe;
            padding: 20px;
            height: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
            opacity: 0; font-size: 20px;
        }

        .sidebar ul li a {
            padding: 10px;
            color: #fff;
            text-decoration: none;
            display: block;
            font-weight: 500;
        }

        /* .sidebar ul li a:active {
            background-color: white ;
            color: #eebbc3;
            transform: translateX(100px);
        } */

        .sidebar ul li.animated {
            opacity: 0.9;
        }

        .sidebar ul li a:hover {
            color: black;
            padding: 10px 10px;
            transform: translateX(2px);
            background-color: white;
            border-radius: 20px;
        }

        #status{border: 2px dashed #7682cd; border-radius: 20px;}
        #status h4 i{background-color: #7682cd; color:white;border-radius: 50%; padding: 10px;}

    </style>
    <title>Admin/User</title>
</head>
<body>
    
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <ul class="list-unstyled">
                <?php
                if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {?>
                <h2 class=" pt-3" style="color: black;">Admin Dashboard</h2><br>
                <hr>
                <li class="animated tre"><a href="total.php">Dashboard</a></li>
                <hr>
                <li class="animated tre"><a href="departmentlist.php">Department</a></li>
                <hr>
                <li class="animated tre"><a href="creation.php">Employee Creation</a></li>
                <hr>
                <li class="animated tre"><a href="employelist.php">Employee List</a></li>
                <hr>
                <li class="animated tre"><a href="leaverequest.php">Leave Request</a></li>
                <hr>
                <?php } elseif ($_SESSION['role'] == 'user') { 
                    $username = $_SESSION['username']
                    ?>

                    <h2  class=" pt-3" style="color: black;">User Dashboard<br><br><span style="color: white;"> <i class="bi bi-person-circle"></i> <?php if(!empty($username)){echo $username;} ?> </span></h2>
                    <h5> </h3>
                    <hr>
                    <li class="animated tre"><a href="status.php">Dashboard</a></li>
                     <hr>
                    <li class="animated tre"><a href="userleave.php">Leave Request</a></li>
                    <hr>
                    <li class="animated tre"><a href="leavehistory.php">Leave History</a></li>
                    <hr>
                    <li class="animated tre"><a href="profile.php">Employee Profile</a></li>
                    <hr>  
                <?php }  } ?>
                <li class="animated tre">
                        <a href="login.php"> Logout </a>
                </li>
                <hr>
            </ul>  
        </nav>
    </div>
</body>
</html>