<?php

	$pid = mysql_real_escape_string($_REQUEST['pid']);

	if(!empty($pid)){
		//

		$seg = array();
		$con=mysqli_connect("localhost","root","root","segments");
		// Check connection
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		} else {
			$result = mysqli_query($con, "select * from segs where parent=$pid");
			while($row = mysqli_fetch_array($result)){
				$seg[] = $row;
			}
		}//end of if connection

		$restful = array();
		foreach ($seg as $k => $v ) {
			if($v['parent'] >=1) {
				$id =$v['id'];
				$restful[$id] = $v['name'];
			}
		}

		


		echo '<ul id="dynamicul">';
		foreach ($restful as $key => $value) {

			$q = mysqli_query($con,"select id from segs where parent='$key' ");
			$c = mysqli_num_rows($q);


			echo '<li><a href="getSubSegment.php?pid='.$key.'" class="'.$key.'">'.$value.' ('.$c.')</a></li>';
		}
		echo '</ul>';

	
	}

	

?>