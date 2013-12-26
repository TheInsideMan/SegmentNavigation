<!DOCTYPE html>
<html>
<head>
		<title>Display segments</title>
		<style type="text/css">

			body {
				font-family: arial;
			}
			a {
				text-decoration: none;
				color: #5a5959;
			}
			a:hover {
				color: #c2bebe;
			}

		</style>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
		<script type="text/javascript">
		$(document).ready(function(){

			//I need to get an array of all the parent categories
			var pids = [];
			$("#toplist li a").each(function() { pids.push( $(this).attr('class') ) });
			


			$(document).on('click', "a", function() {
			
				var href = $(this).attr('href');
				var btnClass = $(this).attr('class');
				

				//check if clicked btnClass exists in parent pids array
				if ($.inArray(btnClass, pids) !== -1){
					//if NO then add to sub category AND do not remove dynamicul
					$( "#dynamicul" ).fadeOut(30, function() { $(this).remove(); });
					
				} else if ($.inArray(btnClass, pids) == -1) {
					//if YES then replace the items
					
				}

				
				$.get(href,function(data) {
		   			$('.'+btnClass).append(data);
				})
				return false;
			});
		});




		</script>

</head>




<body>
	<h1>List of Segments</h1>
	<ul id="toplist">
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
		} 
	}

	foreach ($restful as $key => $value) {
		echo '<li><a href="getSubSegment.php?pid='.$key.'" class="'.$key.'" ">'.$value.'</a></li>';
	}	
?>
</ul>
</body>
</html>