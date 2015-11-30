<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;

	if(isset($_GET["post_id"])) {
		$post = $_GET["post_id"];
	}
	else {
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1><?php echo  ?></h1>
	</body>
</html>