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
		<p><?php echo $content["post_content"];?></p>
		<?php include("included/comment.php"); ?>
	</body>
</html>