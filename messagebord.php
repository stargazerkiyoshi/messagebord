<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		欢迎您
		<?php
			session_start();
		 	echo $_SESSION['username']; 
			echo "<a href='destroy.php'>注销</a>"
		?>
	</body>
</html>
