<?php
    session_start();
    if($_SESSION['type'] != 'user'){
        header("Location:../Admin/login.php");
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
        <title>Add KPI</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Add KPI</h1>
        </div>

        <hr>
        <form action="" method="post">
            <fieldset class="text-center">
                <legend><?php echo $_SESSION['name'];?></legend>
                <label for="KPI">KPI:</label>
                <?php
                echo "<select name='KPI' id='KPI'>";
                     
                    
                    $conn = connectDB();
                    $sql = "SELECT kpi_table.*
                            FROM kpi_table
                            LEFT JOIN staff_kpi_table ON staff_kpi_table.kpi_num=kpi_table.kpi_num
                            WHERE NOT EXISTS (SELECT staff_kpi_table.* FROM staff_kpi_table WHERE kpi_table.kpi_num = staff_kpi_table.kpi_num)
                            ;";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='$row[kpi_num]'>$row[kpi_num] - $row[description]</option>";
                        }
                    }
                    
                echo "</select>";
                echo "<br><br>";
                if(mysqli_num_rows($result)==0){
                    echo "Error: Ran out of KPI";
                }
                ?>
                <br><br>
                
                <?php 
                    if(!mysqli_num_rows($result)==0){
                        echo "<button type='submit' class='btn btn-success' name='add'>Add KPI</button>"; 
                    }
                    
                    
                    if(isset($_POST['add'])){
                        $sql = "INSERT INTO staff_kpi_table (staff_id, kpi_num, status)
                                VALUES ('$_SESSION[staff_id]', $_POST[KPI], 'Pending');
                                ";
                        mysqli_query($conn, $sql);
                        header("Location:ManageKPIPage.php");
                    }
                    
                ?>
            </fieldset>
        </form>
        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenuUser.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="../Admin/index.php">Logout</a>
        </div>
    </body>
</html>