<?php
    session_start();
    if($_SESSION['type'] != 'user'){
        header("Location:../Admin/login.php");
    }

?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Main Menu</title>
        <link rel="stylesheet" href="../style/slider.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">    <!--This include the bootstrap file-->
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Welcome <?php echo $_SESSION['name']?></h1>
        </div>
        
        <div class="text-center">
            <img src="../img/red_main.png" alt="Staff Module">
            <ul>
                <li class="pr-5"><a href="ManageKPIPage.php">Manage KPI</a></li>
                <li class="pr-5"><a href="UpdateProfile.php">Update Profile</a></li>
            </ul>
            <br><br><br><br><br>
        </div>
        
        
        
        
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="../Admin/index.php">Logout</a>
        </div>
        <br><br>
    </body>
</html>