<!DOCTYPE html>
<html>
<head>
		<title>Display segments</title>
</head>

<script type="text/javascript">







</script>



<body>
	<h1>List of Segments</h1>
<?php

	//
	$seg = array();
	$con=mysqli_connect("localhost","root","root","segments");
	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		$result = mysqli_query($con, "select * from segs");
		while($row = mysqli_fetch_array($result)){
			$seg[] = $row;
		}
	}//end of if connection

	$restful = array();
	foreach ($seg as $k => $v ) {
		if($v['parent'] <1) {
			$id =$v['id'];
			$restful[$id] = $v['name'];
		} else {
			//need to add to $restful[] again but this time back up the tree with parents
			$id = $v['id'];
			$pid = $v['parent'];
			if(array_key_exists($pid,$restful)){
				$tmp = $restful[$pid].'/'.$v['name'];
				$restful[$id] = $tmp;
			} 
		}
	}

	foreach ($restful as $key => $value) {
		echo '<p>'.$key.': '.$value.'</p>';
	}	
?>

</body>
</html>