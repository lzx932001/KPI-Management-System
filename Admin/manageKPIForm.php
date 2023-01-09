<!DOCTYPE html>
<html>
	<head>
		
		<title>Manage Key Performance Indicator</title>
		<link rel="stylesheet" href="../css\style.css">
		<link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css">
	</head>
	<body class="bg-warning">
		<?php include("processKPIList.php"); ?>
		<div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
            <h1 class="border border-danger p-2 bd-highlight">Manage Key Performance Indicator</h1>
        </div>
		

		<div class="item">
	        <div class="content">
  				<table>  				
				  <tr>
					  <th>KPI List</th>	
					  <th>Click to edit KPI</th>
					  <th>Click to delete KPI</th>					  				  										  				  					
				  </tr>
				  
				  <?php  
				  		while ($row = mysqli_fetch_assoc($result)){ 
					    	echo '<tr><td class="content_left">'.$row['kpi_num'] ." - ".$row['description'] ."</td>";
					    	echo '<td> <form method="POST" id="myForm" action="">
			                      	<input  name="id" type="hidden" value=' .$row["id"].'>   
			                      	<input type="submit" name="submit" value="Edit KPI" >
			                    </form>
			                    </td>';
					    	echo '<td> <form method="POST" id="myForm" action="">
			                      	<input  name="id" type="hidden" value=' .$row["id"].'>   
			                      	<input type="submit" name="submit" value="Delete KPI" >
			                    </form>
			                    </td></tr>';
						}						
					?>
										  			  				 
				</table>
				

  			</div>
  		</div>

		<div class="card-footer bg-secondary d-flex justify-content-center mt-5">
        <a class="btn btn-primary mr-3" href="MainMenu.php">Main Menu</a>
        <a class="btn btn-primary mr-3" href="index.php">Logout</a>
        </div>
	</body>
</html>