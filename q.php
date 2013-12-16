<!DOCTYPE html>
<html>
<head>
	<title>Process Konami/ASCI</title>
<script type="text/javascript">
	window.onload = init;
	function init(){
		'use strict';
	}
	

</script>
</head>
<body>
	<h1>Query Pixel data</h1>
	<form action="q.php" method="POST">
		<label for="startdate">*Start Date</label>

		<input type="date" name="startdate" id="startdate" value="<?php if(!empty($_REQUEST['startdate'])) echo $_REQUEST['startdate']; ?>" required>
		<label for="enddate">*End Date</label>
		<input type="date" name="enddate" id="enddate" value="<?php if(!empty($_REQUEST['enddate'])) echo $_REQUEST['enddate']; ?>" required>
		<label for="pixel_id">Pixel ID #</label>
		<input type="text" name="pixel_id" id="pixel_id" value="<?php if(!empty($_REQUEST['pixel_id'])) echo $_REQUEST['pixel_id']; ?>">
		<label for="unique_users">Unique Users? </label>
		<input type="checkbox" name="unique_users" id="unique_users" <?php if(!empty($_REQUEST['unique_users'])) echo 'checked="checked"';?>>
		<input type="submit" value="Submit"  id="submit">

	</form>
	<?php
	
	$con=mysqli_connect("localhost","root","root","konami_asci_parse");

	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		//connection ok
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		  	if(!empty($_REQUEST['startdate']) && !empty($_REQUEST['enddate']) ){
		  		$sd = $_REQUEST['startdate'];
		  		$ed = $_REQUEST['enddate'];
		  		if(!empty($_REQUEST['pixel_id'])) $pixel = $_REQUEST['pixel_id'];



		  		if(!empty($_REQUEST['unique_users'])){
		  			$uu = $_REQUEST['unique_users'];
		  			$result = mysqli_query($con, "select 
														pixel_id, 
														format(count(distinct `id`)*256,0) as `unique_users` 
													from pixel 
													where 
														date between '$sd' AND '$ed'
													group by pixel_id order by pixel_id asc");
		  			$num_rows = mysqli_num_rows($result);
					echo '<h3>Total number of rows '.$num_rows.'</h3><table border="1">';
					$i=0;
					while($row = mysqli_fetch_array($result)){
						echo '<tr><td>'.$i.'</td><td>'.$row['pixel_id'].'</td><td>'.$row['unique_users'].'</td></tr>';
						$i++;
					}
					echo '</table>';

		  		} else {
		  			$result = mysqli_query($con,"SELECT * FROM `pixel` WHERE pixel_id = '$pixel' AND date BETWEEN '$sd' AND '$ed'");
		  			$num_rows = mysqli_num_rows($result);
					echo '<h3>Total number of rows '.$num_rows.'</h3><table border="1">';
					$i=0;
					while($row = mysqli_fetch_array($result)){
						echo '<tr><td>'.$i.'</td><td>'.$row['id'].'</td><td>'.$row['date'].'</td><td>'.$row['pixel_id'].'</td><td>'.$row['filename'].'</td></tr>';
						$i++;
					}
					echo '</table>';
		  		}
		  		
				

			} else {//check if query has been passed
				echo '<p>Please fill out all required fields.</p>';
			}
		}//if _POST
		
	}

	?>
</body>
</html>