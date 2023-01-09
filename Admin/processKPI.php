<?php

$num=$desc ="";
$numErr = $descErr ="";
$result = "";

if(isset($_POST["submit"]) ){
  if ($_POST["submit"]=="Add KPI") {
	if (empty($_POST["numbering"])){
		$numErr = "This field is required";
	}else {
      $num = test_input($_POST["numbering"]);
      if (!is_numeric($num) ) {
    	$numErr = "Invalid input. Please enter a number.";
      }
  	}

  	if (empty($_POST["description"])){
		$descErr = "This field is required";
	}else {
      $desc = test_input($_POST["description"]);    
  	}

  	if (($numErr =="") && ($descErr =="")) {
  		$result=addKPI($num,$desc);
  	}
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function addKPI($num,$desc){
 $result="";
  $link = mysqli_connect("localhost", "root", "", "staff_db");

  if($link === false){
    $result="ERROR: Could not connect.";
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

 // sql statement that ensures that there is no existing KPI number before inserting into the table
 $sql = "INSERT INTO kpi_table (kpi_num, description) 
         SELECT * FROM (SELECT '$num', '$desc') AS tmp
         WHERE NOT EXISTS(  
              SELECT kpi_num FROM kpi_table WHERE kpi_num = '$num') LIMIT 1";  
 
  mysqli_query($link, $sql);  
  if ( mysqli_affected_rows($link)>0)
      $result="Records inserted successfully.";
  else
      $result="There is an existing KPI number. Please use a different number";
  return $result;
}

?>