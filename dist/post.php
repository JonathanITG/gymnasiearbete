<?php
	session_start();

	include_once("resources/connect.php");
	include_once("resources/functions.php");

	$database = new database;

	htmlspecialchars($_GET['postid']);

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
<html5>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
		<link type="text/css" rel="stylesheet" href="assets/css/reset.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    	<script src="jquery.bpopup.min.js"></script>
    	<!--<meta name="viewport" content="width=device-width">-->
	</head>
	<body>
		<?php include("included/banner.php") ?>
		<div class="contentspace">
			<div id="postcont">
				<h2><?php echo $content["post_topic"]; ?></h2>
				<?php
					//Kollar om nuvarande användaren är samma som skaparen av inlägget
					$user = $database->fetch_from("user", "user_id", $content["poster_user"], 1);
					if(isset($_SESSION["current_user"])) {
						if($_SESSION["current_user"] == $user["user_name"]) {
							echo "<small><a href='delete.php?postid=" . $content["post_id"] . "'>delete post</a></small>";
						}
					}
					//Gör inlägg mer läsvänliga
					$processed = preg_replace("/\r|\n/", "<br/>", $content["post_content"] );
				?>
				<p><?php echo $processed;?></p>
			</div>
			<?php include("included/comment.php"); ?>
		</div>
	</body>
</html5>