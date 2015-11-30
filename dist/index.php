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
			include("included/login.php");
		?>
		<a href="addpost.php">Add a post</a>
	</body>
</html5>