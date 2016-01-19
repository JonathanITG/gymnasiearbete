<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;

	if(isset($_GET["postid"])) {
		$post = $_GET["postid"];
		$contentexist = $database->fetch_from("post", "post_id", $post, 2);
		if($contentexist == 1) {
			$content = $database->fetch_from("post", "post_id", $post, 1);
		}
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
		<?php include("included/banner.php") ?>
		<h1><?php echo $content["post_topic"]; ?></h1>
		<?php
			//Kollar om nuvarande användaren är samma som skaparen av inlägget
			$user = $database->fetch_from("user", "user_id", $content["poster_user"], 1);
			if($_SESSION["current_user"] == $user["user_name"]) {
				echo "<small><a href='delete.php?postid=" . $content["post_id"] . "'>delete post</a></small>";
			}
			//Gör inlägg mer läsvänliga
			$processed = preg_replace("/\r|\n/", "<br/>", $content["post_content"] );
		?>
		<p><?php echo $processed;?></p>
		<?php include("included/comment.php"); ?>
	</body>
</html>