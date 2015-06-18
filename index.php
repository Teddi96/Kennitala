<?php require_once 'kennitala.php' ?>

<html>
	<head> 
		<title>Kennitala</title> 
	</head>

	<body>
		<form action="index.php" method="get">
			Kennitala: <input type="text" name="kennitala">
			<input type="submit" value="Athuga">
		</form>
	
	<?php 
		if(isset($_GET['kennitala'])) {
			echo kennitala($_GET['kennitala']);
		} 
	?>

	</body>
</html>
