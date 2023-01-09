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
        <title>Reporting Module</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Reporting Module</h1>
        </div>

        <hr>
        <?php
            echo "<div class='col-md-12'>";
            echo "<table class='table table-striped table-bordered table-sm bg-white'>";
            echo "<caption style='caption-side:top' class='text-center'>KPI Overview</caption>";
            echo "<thead>";
            echo "<tr class='bg-danger'>";
            echo "<th scope='col' class='text-center'>KPI List</th>";
            echo "<th scope='col' class='text-center'>List of Staff</th>";
            echo "<th scope='col' class='text-center'>Total Staff</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $conn = connectDB();
            $sql = "SELECT kpi_table.kpi_num, kpi_table.description, staff_table.name FROM kpi_table
                LEFT JOIN staff_kpi_table ON kpi_table.kpi_num = staff_kpi_table.kpi_num
                LEFT JOIN staff_table ON staff_kpi_table.staff_id = staff_table.staff_id";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                $arrayName = array();
                $index = 0;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>$row[kpi_num] - $row[description]</td>";
                    echo "<td>$row[name]</td>";
                    if(isset($row['name'])){
                        echo "<td>1</td>";
                    }
                    else{
                        echo "<td>0</td>";
                    }
                    
                    echo "</tr>";
                    $index++;
                }
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        ?>
        <br><br><br><br><br>
      
        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
    </body>
</html>