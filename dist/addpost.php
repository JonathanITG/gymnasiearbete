<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	htmlspecialchars($_GET['postid']);

	$database = new database;
?>
<!DOCTYPE html>
<html5>
	<head>
		<title>Add post</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
		<link type="text/css" rel="stylesheet" href="assets/css/reset.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    	<script src="jquery.bpopup.min.js"></script>
    	<!--<meta name="viewport" content="width=device-width">-->
	</head>
	<body>
		<?php

		//Kollar så att användaren är inloggad
			if(isset($_SESSION["current_user"])) {
				//Skickar inlägget till databasen
				if(isset($_POST["postTopic"])) {
					//Definierar variabler
					echo $_POST["postContent"];

					$postTopic = $_POST["postTopic"];
					$postContent = $_POST["postContent"];
					$postUser = $database->fetch_from("user", "user_name", $_SESSION["current_user"], 1);

					//1. kolla om det finns några felaktigheter i inlägget (Tomt inlägg exempelvis)
					if(empty($_POST["postTopic"]) OR empty($_POST["postContent"])) {
						//1.1 Be användaren rätta till felaktigheterna
						echo "You can't upload empty posts!!";
					}
					else {
						//2. Skicka inlägget till databasen om inlägget är legitimt
						$database->add_to("post", "poster_user, post_topic, post_content, post_date", $postUser["user_id"] . "<> " . $postTopic . "<> " . $postContent . "<> " . date("Y-m-d"));
						header("Refresh:0; url=index.php");
					}
				}

			include("included/banner.php");
					?>
		<div class="contentspace">
			<h2>Add post</h2>
			<div id="addpost">
				<form action="addpost.php" method="post" autocomplete="off">
					<input type="text" name="postTopic" placeholder="Topic.." class="postinput"></input>
					<textarea name="postContent" rows="15" cols="100" placeholder="Content.." class="postinput"></textarea>
					<input type="submit" value="upload" class="postinput"></input>
				</form>
			<div>
		</div>
		<?php
			}
		//Vad som ska ske ifall anvädaren inte är inloggad
			else {
				//skickar användaren till start-sidan.
				header("location: index.php");
			}
		?>
	</body>
</html5>