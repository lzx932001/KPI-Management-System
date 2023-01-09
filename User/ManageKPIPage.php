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
        <title>Update Key Performance Indicator</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Update Key Performance Indicator</h1>
        </div>

        <img src="../img/avatar_male.jpg" alt="Avatar Male" class="rounded mx-auto d-block"><br>

        <?php 
        echo "<div class='text-center'>";
                
                $conn = connectDB();
                $sql = "SELECT * FROM staff_table";  
                $result = mysqli_query($conn, $sql);              

                if(isset($_SESSION['name'])){  //check if the variable receive an input
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){ 
                            if(str_contains(strtolower($row['name']), strtolower($_SESSION['name']))){     //loop through the database, which contains all the Staff information
                                echo "<h2>$row[name]</h2><br>";
                                echo "$row[staff_id]<br>";
                                echo "$row[email]";

                                $_SESSION['staff_id'] = $row['staff_id'];
                            }
                        }
                    }
                }
            
        echo "</div>";
        echo "<div class='container text-center'>";
        echo "<div class='row'>";
        echo "<div class='col-md-12'>";
        echo "<table class='table table-striped table-bordered table-sm bg-white'>";
        echo "<caption style='caption-side:top' class='text-center'>List of users</caption>";
        echo "<thead>";
            echo "<tr class='bg-danger'>";
            echo "<th scope='col' class='text-center'>KPI List</th>";
            echo "<th scope='col' class='text-center'>Approval Status</th>";
            echo "<th scope='col' class='text-center'>Remove</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<form action='$_SERVER[PHP_SELF]' method='POST'>";
        $sql = "SELECT * FROM staff_kpi_table WHERE staff_id = '$_SESSION[staff_id]'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>$row[kpi_num]</td>";
               if($row['status'] == "Pending"){
                    echo "<td>$row[status]</td>";
                    if(isset($_POST[$row['id']])){
                        $row['status']="Approved";
                        $sql = "UPDATE staff_kpi_table
                        SET status = 'Approved' WHERE staff_id = '$_SESSION[staff_id]' AND kpi_num = $row[kpi_num]";
                        mysqli_query($conn, $sql);
                        echo "<script>location.reload();</script>";
                    }
                }
                else{
                    echo "<td>$row[status]</td>";
                }
                if(isset($_SESSION['status'])){
                    if($row['status']=="Approved" || $_SESSION['status'] == "OFF"){
                        echo "<td><button type='submit' class='btn btn-light' name='$row[kpi_num]' disabled>Remove</button></td>";
                    }
                    else{
                        echo "<td><button type='submit' class='btn btn-light' name='$row[kpi_num]'>Remove</button></td>";
                    }
                }
                else{
                    if($row['status']=="Approved"){
                        echo "<td><button type='submit' class='btn btn-light' name='$row[kpi_num]' disabled>Remove</button></td>";
                    }
                    else{
                        echo "<td><button type='submit' class='btn btn-light' name='$row[kpi_num]'>Remove</button></td>";
                    }
                }
                
                
                
                if(isset($_POST[$row['kpi_num']])){
                    $sql = "DELETE FROM staff_kpi_table WHERE staff_id = '$_SESSION[staff_id]' AND kpi_num = $row[kpi_num];";
                    mysqli_query($conn, $sql);
                    echo "<script>location.reload();</script>";
                }
                echo "</tr>";
            }
        }
        echo "<tr><td></td>";
        if(isset($_SESSION['status'])){
            if($_SESSION['status'] == "OFF"){
                echo "<td><button type='submit' class='btn btn-light btn-bordered' name='assign' disabled>Add KPI</button></td>";
            }
            else{
                echo "<td><button type='submit' class='btn btn-light btn-bordered' name='assign'>Add KPI</button></td>";
            }
        }
        else{
            echo "<td><button type='submit' class='btn btn-light btn-bordered' name='assign'>Add KPI</button></td>";
        }
        
        
        if(isset($_POST['assign'])){
            header("Location:AddKPI.php");
        }
        echo "<td></td></tr>";
        echo "</form>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        ?>

        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenuUser.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="../Admin/index.php">Logout</a>
        </div>
    </body>
</html>