<!DOCTYPE html>
<html>
	<head>
		<?php include_once ("processKPI.php"); ?>
		<title>Add KPI</title>
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
		<div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Add KPI</h1>
        </div>	
		
		<hr/>
		<form action="<?php echo $_SERVER["PHP_SELF"];?>"  method="post" >
			<fieldset>
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
				  			<input type="text" id="numbering" name="numbering" maxlength="4" style="height:25px;" size="2"> <span class="error">* <?php echo $numErr;?></span>
						</td>
					</tr>
					<tr>
						<td>
				  			<label for="description">Description:</label>
				  		</td>
				  		<td>
				  			<textarea id="description" name="description" rows="3" cols="70"></textarea> <span class="error">* <?php echo $descErr;?></span>
						</td>
				  	</tr>
				  	<tr>
				  		<td colspan="2">
				  			<input type="submit" value="Add KPI" class="button" name="submit" >
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