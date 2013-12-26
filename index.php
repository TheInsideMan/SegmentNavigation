<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
=======
	<title>Insert Konami/ASCI</title>
>>>>>>> branchtest
<script type="text/javascript">
	window.onload = init;
	function init(){
		'use strict';
	}
	

</script>
</head>
<body>
<<<<<<< HEAD
=======
	<h1>Process Konami/ASCI</h1>
	<?php
	
	$con=mysqli_connect("localhost","root","root","konami_asci_parse");

	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
	  	echo "connected ok<br/>";
	}
	
	if(!empty($_REQUEST['file'])){
		$dup = $_REQUEST['dup'];
		$file = 'konami/'.$_REQUEST['file'];

		echo '<p>File: '.$file.'</p>';


		$data = csv_to_array($file,',');
		
		foreach ($data as $key => $value) {
			$i=0;
			foreach ($value as $key2 => $value2) {
				if($i==0) $date = $value2;
				if($i==1) $id = $value2;
				if($i==2) $user = $value2;
				$i++;
			}
			if($dup=1){
				mysqli_query($con, "INSERT INTO `pixel_with_dupl` SET `asi` = '$id', `date` = '$date', `konami` = $user,`filename` = '$file'");
			}  else {
				mysqli_query($con, "INSERT IGNORE INTO `pixel` SET `id` = '$id', `date` = '$date', `pixel_id` = $user,`filename` = '$file'");
			}
			
			//echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
		}

		if($dup=1){
			$result = mysqli_query($con,"SELECT * FROM `pixel_with_dupl` WHERE filename='$file' ");
		} else {
			$result = mysqli_query($con,"SELECT * FROM `pixel` WHERE filename='$file' ");
		}
		
		$num_rows = mysqli_num_rows($result);
		$t = ($num_rows * 256);
		echo 'Number of unique pixel\'s: '.$num_rows.' * 256 = <b>'.$t.'</b><br/><br/>';
		$i=0;
		echo '<table border="1">';
		while($row = mysqli_fetch_array($result)){
			echo '<tr><td>'.$i.'</td><td>'.$row['id'].'</td><td>'.$row['date'].'</td><td>'.$row['user_id'].'</td></tr>';
			$i++;
			}
			echo '</table>';

	} else {//check if query has been passed
		echo '<p>No file provided.</p>';
	}



		function csv_to_array($filename='', $delimiter=',')
		{
		    if(!file_exists($filename) || !is_readable($filename))
		        return FALSE;

		    $header = NULL;
		    $data = array();
		    $i=0;
		    if (($handle = fopen($filename, 'r')) !== FALSE)
		    {
		    	echo $i.'~~~';
		        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		        {
		            if(!$header)
		                $header = $row;
		            else
		                $data[] = array_combine($header, $row);

		        }
		        fclose($handle);

		        $i++;
		    }
		    echo $i;//does not get here
		    return $data;
		}

	?>
>>>>>>> branchtest
</body>
</html>