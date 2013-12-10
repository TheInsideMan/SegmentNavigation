<!DOCTYPE html>
<html>
<head>
	<title>Some title</title>
	 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
		$(function() {
			$( "#slider" ).slider();
		});
	

		window.onload = init;
		function init(){
			//var pc = document.getElementByClassName('ui-slider-handle ui-state-default ui-corner-all').style;
			var pc = document.getElementById('slider').style;
			if(pc.length > 0){
				document.getElementById('metre').value = pc;
			} else {
				document.getElementById('metre').value = 'An error has occoured!';
			}
			


			var login = document.getElementById('loginForm');
			login.onsubmit = validateForm;
		}
		function validateForm(){

			var email = document.getElementById('email');
			var password = document.getElementById('password');
			var error = document.getElementById('error');
			if((email.value.length > 0) && (password.value.length >0)){
				return true;
			} else {
				error.style.display = "block";
				return false;

			}
		}
	</script>
	<style type="text/css">
		body {
			color: #000;
			font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
			font-size: 62.5%;
		}


		.container {
			width:960px;
			margin: 0 auto;
			background-color: #EBE7E6;
			padding: 10px;
		}

		nav {
			margin: 0 0 10px 0;
		}

		nav ul {
			padding: 0;
			margin: 0;
		}

		#error {
			color: #F86C6C;
			display: none;
		}

	</style>
</head>
<body>
	<div class="container">
		<div id="slider"></div>
	<h1>This is a test</h1>
	<nav>
		<ul>
			</li><a href="#">Link 1</a></li>
			</li><a href="#">Link 2</a></li>
			</li><a href="#">Link 3</a></li>
			</li><a href="#">Link 4</a></li>
			
		</ul>

	</nav>
	<?php
	if($_REQUEST['toast']){
		$a = $_REQUEST['toast'];
		echo '<p>I would like some toast with '.$a;
	} else if(empty($_REQUEST['toast'])){
		echo  'I dont want toast.';
	}
	?>
	<p id="metre">Metre: </p>
	<p id="error">Please enter an email address and a password!</p>
	<form id="loginForm" method="POST" action="http://www.google.com/" >
		<input type="text" id="email">
		<input type="text" id="password">
		<input type="submit" value="submit" id="submit">
	</form>
</div>
</body>
</html>