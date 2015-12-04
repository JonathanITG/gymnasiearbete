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
		<ul>
		<?php
			$posts = $database->fetch_all("post");

			foreach($posts as $post) {
			?>
				<li>
					<?php
						$post = $database->fetch_from("post", "post_id", $post["post_id"], 1);
						$poster = $database->fetch_from("user", "user_id", $post["poster_user"], 1);
					?>
					<a href="post.php?postid=<?php echo $post["post_id"]; ?>"><?php echo $post["post_topic"] . " - " . $poster["user_name"]; ?></a>
				</li>
			<?php
			}
		?>
		</ul>
	</body>
</html5>