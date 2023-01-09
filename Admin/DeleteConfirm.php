<?php
    session_start();
    if($_SESSION['type'] != 'admin'){
        header("Location:login.php");
    }

    function connectDB(){
      $servername="localhost";
      $username="root";
      $password="";
      $db="staff_db";

      //create connection
      $conn = mysqli_connect($servername, $username, $password, $db);

      //check connection
      if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
      }
      return $conn;
    }

    $conn = connectDB();
    $sql = "DELETE FROM staff_table WHERE staff_id = '$_SESSION[staff_id]';";
    $sql .= "DELETE FROM staff_kpi_table WHERE staff_id = '$_SESSION[staff_id]';";
    mysqli_multi_query($conn, $sql);
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Staff Profile</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
        <h1 class="border border-danger p-2 bd-highlight">Delete Staff Profile</h1>
        </div>

        <hr>

        <div class="text-center">
            <p class="text-danger">Record is deleted successfully...</p>
        </div>

        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="SearchStaffForm.php">Delete Another Profile</a>
        <a class="btn btn-primary mr-3" href="MainMenu.php">Home</a>
        </div>
        
    </body>
</html>