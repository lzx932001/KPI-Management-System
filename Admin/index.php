<?php

    $conn = createDB();
    $sql = "CREATE DATABASE IF NOT EXISTS staff_db;";
    $result = mysqli_query($conn, $sql);

    function createDB(){
        $servername="localhost";
        $username="root";
        $password="";

        //create connection
        $conn = new mysqli($servername, $username, $password);

        //check connection
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    $conn = connectDB();
    $sql = "CREATE TABLE IF NOT EXISTS staff_table(
        id int(4) NOT NULL AUTO_INCREMENT,
        staff_id varchar(6) NOT NULL,
        email varchar(50) NOT NULL,
        name varchar(50) NOT NULL,
        gender varchar(6) NOT NULL,
        school varchar(5) NOT NULL,
        PRIMARY KEY(id)
    );";
    
    $sql .="CREATE TABLE IF NOT EXISTS kpi_table(
        id int(4) NOT NULL AUTO_INCREMENT,
        kpi_num int NOT NULL,
        description varchar(150) NOT NULL,
        PRIMARY KEY(id)
    );";
    
    $sql .="CREATE TABLE IF NOT EXISTS staff_kpi_table(
        id int(4) NOT NULL AUTO_INCREMENT,
        staff_id varchar(6) NOT NULL,
        kpi_num int NOT NULL,
        status varchar(12) NOT NULL,
        PRIMARY KEY(id)
    );";
    
    $sql .="CREATE TABLE IF NOT EXISTS account_table(
        id int(4) NOT NULL AUTO_INCREMENT,
        staff_id varchar(6) NOT NULL,
        name varchar(50) NOT NULL,
        password varchar(255) NOT NULL,
        type varchar(5) NOT NULL,
        email varchar(50) NOT NULL,
        PRIMARY KEY(id)
    );";

    
    $result = mysqli_multi_query($conn, $sql);

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
        <title>Main Page</title>
        <link rel="stylesheet" href="../style/styles.css">
        <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">    <!--This include the bootstrap file-->
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">KPI Assignemnt System</h1>
        </div>

        <img src="../img/image1.jpg" alt="Profile Image" class="rounded mx-auto d-block"><br>
        <p class="text-center">
            <strong>Name: </strong>ZongXin Lim <br>
            <strong>Student ID: </strong>101232574 <br>
            <strong>Email: </strong><a href="mailto:101232574@students.swinburne.edu.my">101232574@students.swinburne.edu.my</a><br><br>
            
            I declare that this assignment is my individual work. I have not work collaboratively nor have I copied from any other
            student's work or from any other source. I have not engaged another party to complete this assignment. I am aware of the
            University's policy with regards to plagiarism. I have not allowed, and will not allow anyone to copy my work with the
            intention of passing it off as his or her own work.
        </p>
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="login.php">Login</a>
        <a class="btn btn-primary" href="../about.php">About This Assignment</a>
        </div>
        <br><br>
    </body>
</html>