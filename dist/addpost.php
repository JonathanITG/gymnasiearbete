<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add post</title>
	</head>
	<body>
		<?php
			include("included/banner.php");
		//Kollar så att användaren är inloggad
			if(isset($_SESSION["current_user"])) {
				//Skickar inlägget till databasen
				if(isset($_POST["postTopic"])) {
					//Definierar variabler
					$postTopic = $_POST["postTopic"];
					$postContent = $_POST["postContent"];
					$postUser = $database->fetch_from("user", "user_name", $_SESSION["current_user"], 1);

					//1. kolla om det finns några felaktigheter i inlägget (Tomt inlägg exempelvis)
					/*if() {
						//1.1 Be användaren rätta till felaktigheterna
					}
					else { */
						//2. Skicka inlägget till databasen om inlägget är legitimt
						$database->add_to("post", "poster_user, post_topic, post_content, post_date", $postUser["user_id"] . ", " . $postTopic . ", " . $postContent . ", " . 1);
					//}
				}
					?>
		<div>
			<form action="addpost.php" method="post" autocomplete="off">
				<input type="text" name="postTopic" placeholder="Topic.."></input>
				<textarea name="postContent" rows="15" cols="100" placeholder="Content.."></textarea>
				<input type="submit" value="postSubmit"></input>
			</form>
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
</html>