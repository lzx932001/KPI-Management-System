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

    $newPassword = $conPassword = "";
    $newPasswordErr = $conPasswordErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["newPassword"])) {
                    $newPasswordErr = "New Password is required";
                } else {
                    $newPassword = test_input($_POST["newPassword"]);

                    if (strlen($_POST["newPassword"])<6) {
                      $newPasswordErr = "Minimum 6 characters";
                    }
                }
                
                if (empty($_POST["conPassword"])) {
                    $conPasswordErr = "Confirm Password is required";
                } else {
                    $conPassword = test_input($_POST["conPassword"]);

                    if (strcmp($_POST["newPassword"],$_POST["conPassword"])!=0) {
                      $conPasswordErr = "Confirm Password does not match New Password";
                    }
                }
            }
              
            function test_input($data) {  //trim the input
                $data = trim($data);
                return $data;
            }

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reset Information</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Reset Password</h1>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <fieldset class="text-center">
            <legend class="pl-4">Personal Information</legend>
            <label for="newPassword" class="pl-4">New Password: </label>
            <input type="text" name="newPassword" >
            <br>
            <span class="text-danger pl-5"><?php echo $newPasswordErr;?></span>
            <br>
            <label for="conPassword">Confirm Password: </label>
            <input type="text" name="conPassword" >
            <br>
            <span class="text-danger pl-5"><?php echo $conPasswordErr;?></span>
            <br><br>

            <button type="submit" class="btn btn-light">Reset Password</button>
            <?php 
                if(!empty($_POST["newPassword"]) && strlen($_POST["newPassword"])>=6 
                && !empty($_POST["conPassword"]) && strcmp($_POST["newPassword"],$_POST["conPassword"])==0){
                    $hash = hash('sha256', $_POST["conPassword"]); 
                    $conn = connectDB();
                    $sql = "UPDATE account_table
                            SET password = '$hash'
                            WHERE name = '$_SESSION[name]'";
                    mysqli_query($conn, $sql);
                    $_SESSION['type']="";
                    echo "<br><br>";
                    echo "<strong>Password has been changed. Please log in with your new password</strong>";
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