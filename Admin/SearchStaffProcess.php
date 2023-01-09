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
        <title>Staff Information</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Staff Information</h1>
        </div>

        <fieldset>
            <legend class="pl-4">Search Results</legend>
            <?php
            
            $conn = connectDB();
            $sql = "SELECT * FROM staff_table";
            $result = mysqli_query($conn, $sql);
            
            ?>
            <ul> 
                <?php 
                    $index = 0;

                    if(isset($_GET["fname"])){  //check if the get variable receive an input
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){      //loop through the database, which contains all the Staff information
                                $name = $row['name'];
                                if(str_contains(strtolower($name), strtolower($_GET["fname"]))){    //if it matches with input, show the link to the staff info page
                                    echo "<li>";
                                    echo "<a href='DisplayStaffInfo.php?name=$name'>$name</a>";
                                    echo "</li>";
                                    $index++;
                                }
                            }
                        }
                    }
                    
                    echo "$index results found";
                ?>
            </ul>
        </fieldset>

        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
    </body>
</html>