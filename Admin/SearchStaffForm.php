<?php
    session_start();
    if($_SESSION['type'] != 'admin'){
        header("Location:login.php");
    }

    if(isset($_SESSION['name'])||isset($_SESSION['staff_id'])){
        $_SESSION['name'] = "";
        $_SESSION['staff_id'] = "";
    }

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search Staff Information</title>
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Search Staff Information</h1>
        </div>

        <?php
            $fname = $fnameErr = "";
            
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if(empty($_GET["fname"]) && isset($_GET["fname"])){
                    $fnameErr = " Staff Name is required";
                }
                if(isset($_GET["fname"])){
                    $fname = test_input($_GET["fname"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                        $fnameErr = " Only letters and white space allowed";
                    }
                }
            }

            function test_input($data) {
                $data = trim($data);
                return $data;
            }

            if(!empty($_GET["fname"])){ //if the get variable is not empty, do the validation and go to the process php page
                if(preg_match("/^[a-zA-Z-' ]*$/",$_GET["fname"])){
                    header("Location: SearchStaffProcess.php?fname=$fname");
                    
                }
            }
            
            
        ?>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <label for="fname" class="font-weight-bold pl-5"> Staff Name:</label><br>
            <input type="text" name="fname" class="ml-5"><span class="text-danger"><?php echo $fnameErr;?></span><br><br>
            <input type="submit" value="Search" class="ml-5">
        </form>
        <br><br><br><br><br>
      
        <div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
    </body>
</html>