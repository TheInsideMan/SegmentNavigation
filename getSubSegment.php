<?php


	class getSubSegment {

		function __construct(){

		}//end of constructor








	}//end of class

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
			if($c > 0){
				$arrow = '&#10095;';
			} else {
				$arrow = '&times;';
			}

			echo '<li><a href="getSubSegment.php?pid='.$key.'" class="'.$key.'">'.$value.' '.$arrow.' </a></li>';
		}
		echo '</ul>';

	
	}

	

?>