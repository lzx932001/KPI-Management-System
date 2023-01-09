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
        <title>Settings</title>
        <link rel="stylesheet" href="../style/slider.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
        
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Settings</h1>
        </div>
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="text-center">
                <p>Availability: 
                <label class="switch"> 
                    <input type="checkbox" name="check">
                    <span class="slider round"></span>
                </label>
                </p>
                <?php 
                    if(isset($_POST['submit'])){
                        if(empty($_POST['check'])){
                            $_SESSION['status'] = "OFF";
                        }
                        else{
                            $_SESSION['status'] = "ON";
                        }
                    }
                    
                    if(isset($_SESSION['status'])){
                        if($_SESSION['status'] == "OFF"){
                            echo "The availability is set to $_SESSION[status]";
                        }
                        elseif($_SESSION['status'] == "ON"){
                            echo "The availability is set to $_SESSION[status]";
                        }
                    }
                    else{
                        echo "The availability is set to OFF";
                    }
                    
                ?>
                <br><br>
                <button type="submit" class="btn btn-light" name="submit">Apply Changes</button>
            </div>
        </form>
        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
    </body>
</html>