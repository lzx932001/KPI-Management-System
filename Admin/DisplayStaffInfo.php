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

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staff Profile</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
        <h1 class="border border-danger p-2 bd-highlight">Staff Profile</h1>
        </div>

        <img src="../img/avatar_female.jpg" alt="Avatar female" class="rounded mx-auto d-block"><br>

        <fieldset>
            <legend class="pl-3 font-weight-bold">Staff Information</legend>
            <?php

            $name = $_GET['name'];
            
            $conn = connectDB();
            $sql = "SELECT * FROM staff_table WHERE name='$name'";
            $result = mysqli_query($conn, $sql);


            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<strong class='pl-3'>Name</strong>: $row[name]<br>";
                    echo "<strong class='pl-3'>Staff ID</strong>: $row[staff_id]<br>";
                    echo "<strong class='pl-3'>Email</strong>: $row[email]<br>";
                    echo "<strong class='pl-3'>Gender</strong>: $row[gender]<br>";
                    echo "<strong class='pl-3'>School</strong>: $row[school]";
                    $_SESSION['name']=$row['name'];
                    $_SESSION['staff_id']=$row['staff_id'];
                    $_SESSION['email']=$row['email'];
                }
            }

            echo "<br><br>";
            echo "<div class='text-center'>";
            echo '<a class="btn btn-primary mr-3" href="UpdateEmployee.php">Update</a>';
            echo '<a class="btn btn-primary mr-3" href="DeleteConfirm.php">Delete</a>';
            echo "</div>";
            ?>
        </fieldset>

        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
        
    </body>
</html>