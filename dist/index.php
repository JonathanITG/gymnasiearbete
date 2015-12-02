<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;
?>
<!DOCTYPE html>
<html5>
	<head>
		<title>Social hemsida</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
	</head>
	<body>
		<?php
			include("included/banner.php");
		?>

		<a href="addpost.php">Add post</a>
		<?php
			if(isset($_SESSION["current_user"])) {
				echo "<a href='profile.php?user=" . $_SESSION["current_user"] . "'>Profile</a>";
			}
		?>
	</body>
</html5>