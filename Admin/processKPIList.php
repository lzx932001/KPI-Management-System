<?php
  $result="";
  $link=false;
  if (!$link){
  	$link = mysqli_connect("localhost", "root", "", "staff_db");

  	if($link === false){
    	$result="ERROR: Could not connect.";
    	die("ERROR: Could not connect. " . mysqli_connect_error());
  	}
  }

  if(isset($_POST["submit"]) ){
  	if ($_POST["submit"]=="Delete KPI") {
  		 $id=$_POST['id'];
  		 $sql="DELETE FROM kpi_table WHERE id='$id'";
		 mysqli_query($link,$sql);
  	}

	 if ($_POST["submit"]=="Edit KPI") {
      $id=$_POST['id'];
       header("Location: UpdateKPI.php?id=$id");
	 }

  }

  $sql="select * from kpi_table ORDER BY kpi_num";
  $result=mysqli_query($link,$sql);

 
    

?>