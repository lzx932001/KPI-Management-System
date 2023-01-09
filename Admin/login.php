<?php
    $status = "";

    if(isset($_POST['login_button'])){
        if(isset($_POST['login_name']) && isset($_POST['password'])){
            $conn = connectDB();
            $login = mysqli_real_escape_string($conn, $_POST['login_name']);
            $pwd = mysqli_real_escape_string($conn, $_POST['password']);
            $hash = hash("sha256", $pwd);
            $sql = "SELECT * FROM account_table WHERE name='$login' OR password='$hash'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    if($row['name'] == $login){
                        if($row['password'] == $hash){
                            if($row['type']=="admin"){
                                session_start();
                                $_SESSION['name'] = $login;
                                $_SESSION['type'] = $row['type'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['email'] = $row['email'];
                                $status = "Login Successful!";
                                header("Location:MainMenu.php");
                            }
                            elseif($row['type']=="user"){
                                session_start();
                                $_SESSION['name'] = $login;
                                $_SESSION['type'] = $row['type'];
                                $_SESSION['email'] = $row['email'];
                                $status = "Login Successful!";
                                header("Location:../User/MainMenuUser.php?name=$_SESSION[name]");
                            }
                        }
                        else{
                            $status = "Invalid password";
                        }
                    }
                    else{
                        $status = "Invalid login name";
                    }
                }
            }
        }
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
        <title>Login Page</title>
        <link rel="stylesheet" href="../style/styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">    <!--This include the bootstrap file-->
    </head>

    <body class="bg-warning">

        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">KPI Management System</h1>
        </div>
        
        <br>
        <h2 class="text-center">Login</h2>
        
        
        
        <img src="../img/top_image.png" alt="Profile Image" class="rounded mx-auto d-block"><br>

        <div class="text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="login_name">Login Name: </label>
            <input type="text" name="login_name" value="<?php echo isset($_POST['login_name']) ? $_POST['login_name'] : '' ?>">
            <br>
            <label for="password" class="pl-3">Password: </label>
            <input type="text" name="password">
            <br><br>

            <input type="submit" value="Login" name="login_button">
            <input type="reset" value="Clear Form">
            <br><br>

            <?php
            if($status == "Invalid login name"){
                echo "<fieldset>";
                echo "<legend>ERROR</legend>";
                echo "<li style='color:red;'>$status</li>";
                echo "</fieldset>";
            }
            elseif($status == "Invalid password"){
                echo "<fieldset>";
                echo "<legend>ERROR</legend>";
                echo "<li style='color:red;'>$status</li>";
                echo "</fieldset>";
            }
            
            ?>
        </form>
        </div>
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="index.php">Main Page</a>
        
        </div>
        <br><br>
    </body>
</html>