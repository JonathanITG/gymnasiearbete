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
		<link type="text/css" rel="stylesheet" href="assets/css/reset.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    	<!--<meta name="viewport" content="width=device-width">-->
	</head>
	<body>
		<?php
			include("included/banner.php");
		?>
		<div id="postlist" class="contentspace">
			<a href="addpost.php">Add post</a>
			<div id="catlist">
				<div class="infolist">
					<p>Uploaded</p>
				</div>
				<div class="infolist">
					<p>Comments</p>
				</div>
				<div class="infolist">
					<p>User</p>
				</div>
			</div>
		<?php
			$set = 1;
			include("included/postlist.php");
		?>
		</div>
	</body>
</html5>