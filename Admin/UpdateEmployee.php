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
        <title>Update Staff Profile</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
      <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
        <h1 class="border border-danger p-2 bd-highlight">Update Staff Profile</h1>
      </div>

        <?php
          
            $fname = $staffID = $email = $gender = $schoolFaculty ="";
            $fnameErr = $staffIDErr = $emailErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["fname"])) {
                    $fnameErr = "Name is required";
                  } else {
                    $fname = test_input($_POST["fname"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                      $fnameErr = "Only letters and white space allowed";
                    }
                  }
                
                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                  } else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!preg_match("/^.+@swinburne\.edu\.my*$/",$email)) {
                      $emailErr = "Invalid email format";
                    }
                  }
                  
                $gender = test_input($_POST["gender"]);
                $schoolFaculty = test_input($_POST["schoolFaculty"]);
                
            }
              
            function test_input($data) {  //trim the input
                $data = trim($data);
                return $data;
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  <!--Let php call the page itself-->
            <fieldset>
                <legend class="pl-5">Personal Information</legend>
                <p class="pl-5 text-danger">* required field</p>
                <label for="fname" class="pl-5">Full name:</label>
                <input type="text" id="fname" name="fname" maxlength="50" 
                value="<?php echo $_SESSION['name'] ?>" class="ml-2"><span class="text-danger">*<?php echo $fnameErr;?></span>
                <!--After submit the form, this does not clear the input field-->
                <br><br>
                <label for="staffID" class="pl-5">Staff ID:</label>
                <input type="text" id="staffID" name="staffID"
                value="<?php echo $_SESSION['staff_id'] ?>" class="ml-4" disabled><span class="text-danger">*<?php echo $staffIDErr;?></span>
                <br><br>
                <label for="email" class="pl-5">Email:</label>
                <input type="text" id="email" name="email"
                value="<?php echo $_SESSION['email'] ?>" class="ml-4"><span class="text-danger">*<?php echo $emailErr;?></span>
                <br><br>
                <label for="gender" class="pl-5">Gender:</label>
                <select name="gender" id="gender" class="ml-4">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br><br>
                <label for="schoolFaculty" class="pl-5">School/Faculty:</label>
                <select name="schoolFaculty" id="schoolFaculty">
                    <option value="SFS">SFS</option>
                    <option value="FBDA">FBDA</option>
                    <option value="FECS">FECS</option>
                </select><br><br>
                <input type="submit" name="submit" value="Update Staff" class="ml-5"> 
                <?php 
                
                
                ?>
            </fieldset>
            <?php
             
              $update = false;  //set the $record to false
              if (!empty($_POST["fname"])&& preg_match("/^[a-zA-Z-' ]*$/",$_POST["fname"]) &&
              !empty($_POST["email"])&& preg_match("/^.+@swinburne\.edu\.my*$/",$_POST["email"]) &&
              !empty($_POST["gender"])&& !empty($_POST["schoolFaculty"])) {
                $conn = connectDB();
                $sql = "UPDATE staff_table
                SET name='$fname', email='$email', gender='$gender', school='$schoolFaculty'
                WHERE staff_id='$_SESSION[staff_id]';";
                $sql .= "UPDATE account_table
                SET name='$fname', email='$email'
                WHERE staff_id='$_SESSION[staff_id]';";

                $result = mysqli_multi_query($conn, $sql);
                $update = true;
                

                if($update){ 
                  header("Location:DisplayStaffInfo.php?name=$fname");
                }
              }
            ?>
        </form>
        <br>
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        
        </div>
    </body>
</html>