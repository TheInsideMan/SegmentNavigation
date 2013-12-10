<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
	window.onload = init;
	function init(){
		'use strict';
		document.getElementById('calcForm').onsubmit = formatNames;
	}
	function formatNames(){
		'use strict';
		var formatedName;
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		formatedName = lastName + ', ' + firstName;
		document.getElementById('result').value = formatedName;
		return false;
	}

</script>
</head>
<body>
<h1>Aaron was here</h1>
<h3>some bloody text</h3>
<p>this is a test for adding text</p>
	<form method="POST" action="name.php" id="calcForm">
		<input type="text" name="firstName" id="firstName" value="Firstname" required><br/>
		<input type="text" name="lastName" id="lastName" value="Lastname" required><br/>
		<input type="text" name="result" id="result" ><br/>
		<input type="submit" value="Submit" id="submit"> 
	</form>	
</body>
</html>