<?php
    session_start();
    if($_SESSION['type'] != 'admin'){
        header("Location:login.php");
    }
    
?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Main Menu</title>
        <link rel="stylesheet" href="../style/styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">    <!--This include the bootstrap file-->
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">KPI Assignemnt System</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="../img/red.png" alt="Staff Module">
                    <ul>
                        <li><a href="AddStaffForm.php">Add Staff Profile</a></li>
                        <li><a href="SearchStaffForm.php">Manage Staff Profile</a></li>
                        <li><a href="UpdateStaffKPIForm.php">Update Staff KPI</a></li>
                    </ul>
                    <br><br>
                </div>
                <div class="col-md-6">
                    <img src="../img/kpi_blue.png" alt="KPI Module">
                    <ul>
                        <li><a href="addKPIForm.php">Add KPI</a></li>
                        <li><a href="manageKPIForm.php">Manage KPI</a></li>
                    </ul>
                    <br><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <img src="../img/report_green.png" alt="Reporting Module">
                    <ul>
                        <li><a href="KPIReport.php">KPI Overview</a></li>
                    </ul>
                    <br><br>
                </div>
                <div class="col-md-6">
                <img src="../img/setting_orange.png" alt="KPI Module">
                <ul>
                    <li><a href="Settings.php">Availability</a></li>
                </ul>
                <br><br>
                </div>
            </div>
        </div>
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
        <br><br>
    </body>
</html>