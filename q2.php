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
	<h1>UU Pixel Crossover Rate Report</h1>
	<form action="q2.php" method="POST">
		<label for="startdate">*Start Date</label>

		<input type="date" name="startdate" id="startdate" value="<?php if(!empty($_REQUEST['startdate'])) echo $_REQUEST['startdate']; ?>" >
		<label for="enddate">*End Date</label>
		<input type="date" name="enddate" id="enddate" value="<?php if(!empty($_REQUEST['enddate'])) echo $_REQUEST['enddate']; ?>" >
		<label for="konami">Konami #</label>
		<!--<input type="text" name="konami" id="konami" value="<?php if(!empty($_REQUEST['konami'])) echo $_REQUEST['konami']; ?>">-->
		<select name="konami">
			<option value="361084">361084</option>
			<option value="361085">361085</option>
			<option value="361086">361086</option>
		</select>
		<label for="pixel">Pixel #</label>
		<select name="pixel">
			<?php

			$con=mysqli_connect("localhost","root","root","konami_asci_parse");
			$r= mysqli_query($con,"select konami from pixel_with_dupl GROUP BY konami");
			while($row = mysqli_fetch_array($r)){
				echo '<option value="'.$row['konami'].'"';

				if( !empty($_REQUEST['pixel']) && $row['konami']==$_REQUEST['pixel'] ) echo ' selected';
				echo '>'.$row['konami'].'</option>';
			}
			?>


			
		</select>
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
		  		
		  		//set the POST variables
		  		if(!empty($_REQUEST['startdate'])) $sd = mysql_real_escape_string($_REQUEST['startdate']);
		  		if(!empty($_REQUEST['enddate'])) $ed = mysql_real_escape_string($_REQUEST['enddate']);
		  		if(!empty($_REQUEST['konami'])) $konami = mysql_real_escape_string($_REQUEST['konami']);
		  		if(!empty($_REQUEST['pixel'])) $pixel = mysql_real_escape_string($_REQUEST['pixel']);

	  			//First get all the users for the Konami and assign to $konami_user_list
	  			$q = mysqli_query($con, "SELECT DISTINCT asi,konami  FROM `pixel_with_dupl`  WHERE konami='$konami' AND date BETWEEN '$sd' AND '$ed'");
	  			$konami_user_list = array();
	  			while($row = mysqli_fetch_array($q)){
	  				$konami_user_list[] = $row['asi'];
	  			}
	  			
	  			//next get the Pixel users and assign to $pixel_user_list
	  			$pixel_user_list = array();
	  			$q = mysqli_query($con, "SELECT DISTINCT asi,konami  FROM `pixel_with_dupl`  WHERE konami='$pixel' AND date BETWEEN '$sd' AND '$ed' ");
	  			while($row = mysqli_fetch_array($q)){
	  				$pixel_user_list[] = $row['asi'];
	  			}

	  			//get the number of users - multiplying by 256 to inflate sample data
	  			$pixel_num_rows = (count($pixel_user_list)*256);
	  			$konami_num_rows = (count($konami_user_list)*256);
	  			//if($konami_num_rows==0) $konami_num_rows = 256;

	  			//get the crossover of users
	  			$result = array_intersect($konami_user_list,$pixel_user_list);
	  			$crossover = count($result)*256;

	  			//get the crossover as a percentage
	  			//$pc = number_format(($konami_num_rows/$pixel_num_rows)*100,4);
	  			$pc = number_format(($crossover/$pixel_num_rows)*100,4);

	  			echo '<p>There are '.$crossover.' users that have seen both Konami pixel "'.$konami.'" <i>(total no. of users '.
	  				number_format($konami_num_rows).')</i> and pixel "'.$pixel.'" <i>(total no. of users '.number_format($pixel_num_rows).')</i> with a <b>'.$pc.'% </b>crossover.</p>';
	  			echo '<p>Sample crossover users:</p><p>';
	  			foreach ($result as $key => $value) {
	  				echo $value.'<br/>';
	  			}
	  			echo '</p>';




		  			//var_dump($pixel_user_list);



		  			/*$r= mysqli_query($con,"SELECT id FROM `pixel_with_dupl` WHERE konami='$konami' AND date BETWEEN '$sd' AND '$ed' ");
		  			$num_rows = mysqli_num_rows($r);
		  			$result = mysqli_query($con,"SELECT date,konami,asi, COUNT(*) c FROM `pixel_with_dupl` WHERE konami='$konami' AND date BETWEEN '$sd' AND '$ed' GROUP BY asi HAVING c > 1 ORDER BY c DESC");
		  			
					echo '<h3>Total number of rows '.$num_rows.'</h3><table border="1">';
					$i=0;

					echo "<tr><th> Konami </th><th> ASI </th><th> %</th></tr>";
					while($row = mysqli_fetch_array($result)){
						$pc = (($row['c']/$num_rows) *100);
						$pc = number_format($pc,4);
						echo '<tr><td> '.$row['konami'].' </td><td> '.$row['asi'].' </td><td> '.$pc.'% </td></tr>';
						$i++;
					}
					echo '</table>';*/
		  		
		  		
				
			} else {//check if query has been passed
				echo '<p>Please fill out all required fields.</p>';
			}
		}//if _POST
		
	}

	?>
</body>
</html>