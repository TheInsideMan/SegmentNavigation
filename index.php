<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
	window.onload = init;
	function init(){
		'use strict';
	}
	

</script>
</head>
<body>
	<h1>This is a title test</h1>
	<h3>This is where our subtitles go.</h3>
	<?php
		if(!empty($_REQUEST['q'])){
			$q = $_REQUEST['q'];

			if($q > 4){
				echo '<p>Query is bigger than four!</p>';


				if($q == 7){
					echo '<p>This is number seven</p>';
				}
			} else {
				echo '<p>Query is less than four.</p>';
			}

		
		} else {//check if query has been passed
			echo '<p>No query provided.</p>';
		}
	?>
</body>
</html>