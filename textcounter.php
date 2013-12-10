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
			

			var login = document.getElementById('loginForm');
			login.onsubmit = limitText;
		}
		function validateForm(){

			
		}

		function limitText(){
			'use strict';
			var limitText;

			var originalText = document.getElementById('comments').value;
			var lastSpace = originalText.lastIndexOf(' ',100);
			limitText = originalText.slice(0,lastSpace);

			document.getElementById('count').value = originalText.length;
			document.getElementById('result').value = limitText;
			return false;
		}//end of function
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
	<h1>Restrict the number of characters.</h1>
	
	<p id="error">Please enter an email address and a password!</p>

	<form id="loginForm" method="POST" action="http://www.google.com/" >
		<textarea name="comments" id="comments" maxlength="100" required></textarea>
		<p>Character Count</p>
		<input type="number" name="count" id="count"><br/>
		<textarea name="result" id="result"></textarea><br/>
		<input type="submit" value="Submit" id="submit">
	</form>
</div>
</body>
</html>