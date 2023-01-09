<!DOCTYPE html>
<html>
	<head>		
		<title>Edit KPI</title>
		<style type="text/css">
			body{
				font-family: Arial, Helvetica, sans-serif;
			 }

			fieldset {
  				margin: auto;
  				width:40%; 
  				text-align: center;
			}

		
			td{
				height: 40px; 				
				text-align: left;
			}

			.button {
				 font-size: 18px;
				 padding: 6px 20px;
				 margin-top: 10px;
				 margin:auto;
				display:block;				 
			}

			.error {color: #FF0000;}			

		</style>
		<link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
	</head>

	<body class="bg-warning">

	<?php

		$num=$desc ="";
		$numErr = $descErr ="";
		$result = "";
		$num=$desc=$id="";

		if (isset($_GET['id'])){
		  $id=$_GET['id'];
		  $row=RetrieveKPI($id); // retrieve KPI from the table
		  $num=$row['kpi_num'];
		  $desc=$row['description'];
		}

		if(isset($_POST["submit"]) ){
		  if ($_POST["submit"]=="Save Update") { //input validation
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
		  		$id=$_POST['id'];
		  		$result=editKPI($num,$desc,$id);
		  		header("Location:manageKPIForm.php");
		  	}
		  }

		}

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		function editKPI($num,$desc,$id){
		 $result="";
		 $link = mysqli_connect("localhost", "root", "", "staff_db");

		  if($link === false){
		    $result="ERROR: Could not connect.";
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		  }

		  $sql = "UPDATE kpi_table SET kpi_num='$num', description='$desc' WHERE id='$id'";
		  
		  if (mysqli_query($link, $sql))
		        $result="Records updated successfully.";
		  mysqli_close($link);
		  return $result;
		}

		function RetrieveKPI($id){
			$link = mysqli_connect("localhost", "root", "", "staff_db");
			$result="";

			  if($link === false){
			    $result="ERROR: Could not connect.";
			    die("ERROR: Could not connect. " . mysqli_connect_error());
			  }

		  	$sql = "SELECT * FROM kpi_table WHERE id='$id'";
		  	if (mysqli_query($link, $sql)){
		  		$result=mysqli_query($link,$sql);
  				$row = mysqli_fetch_assoc($result);  				
		  	}
		  	return $row;
		}

	?>		
	<h1 style="text-align: center;">Edit KPI</h1>
	<hr/>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>"  method="post" >
		<fieldset  >
			<legend><strong>KPI Details </strong></legend>

			<table>
				<tr>
			  		<td colspan="2"><span class="error">* required field</span></td>
			  	</tr>
			  	<tr>
			  		<td>
			  			<label for="numbering">KPI No.:</label>
			  		</td>
			  		<td>
			  			<input type="text" id="numbering" name="numbering" maxlength="4" style="height:25px;" size="2" value=<?php echo $num;?>> 
			  			<span class="error">* <?php echo $numErr;?></span>
						</td>
				</tr>
				<tr>
					<td>
			  			<label for="description">Description:</label>
			  		</td>
			  		<td>
			  			<textarea id="description" name="description" rows="3" cols="70" ><?php echo $desc;?></textarea> <span class="error">* <?php echo $descErr;?></span>
					</td>
			  	</tr>
			  	<tr>
			  		<td colspan="2">
			  			<input type="hidden" id="id" name="id" value=<?php echo $id; ?>/>
			  			<input type="submit" value="Save Update" class="button" name="submit" >
			  		</td>
			  	</tr>

			</table>
		</fieldset>
	</form>



	<p style="text-align:center; font-weight: bold;"> <?php echo $result;?> </p>

	<div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
    </div>
</body>
</html>