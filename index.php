<?php
	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;
	$users = $database->fetch_all("user");
?>
<!DOCTYPE html>
<html5>
	<head>
		<title>Social hemsida</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
	</head>
	<body>
		<?php
			foreach($users as $user) {
				echo $user["user_name"] . "</br>";
			}
		?>
	</body>
</html5>