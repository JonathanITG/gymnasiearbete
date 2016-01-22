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
			if(isset($_SESSION["current_user"])) {
				echo "<a href='profile.php?user=" . $_SESSION["current_user"] . "'>Profile</a>";
			}
		?>
			<?php
				$posts = $database->fetch_all("post");

				$i = 0;
				foreach($posts as $post) {
					$post = $database->fetch_from("post", "post_id", $post["post_id"], 1);
					$poster = $database->fetch_from("user", "user_id", $post["poster_user"], 1);
					$i = $i + 1;
					if($i%2) {
						$class = "class='even'";
					}
					else {
						$class = "class='odd'";
					}
				?>
					<!--Note to self: make it easier to differentiate the posts-->
					<div class="postbox">
						<a id="post" <?php echo $class; ?> href="post.php?postid=<?php echo $post["post_id"]; ?>"><?php echo $post["post_topic"] ?>
						</a>
						<div id="postinfo" <?php echo $class; ?>>
							<a class="tag" id="timestamp">01/01-16</a>
							<a class="tag" id="commenttag">142</a>
							<a class="tag" href="profile.php?user=<?php echo $poster["user_name"]; ?>"><?php echo $poster["user_name"]; ?></a>
						</div>
					</div>
				<?php
				}
			?>
		</div>
	</body>
</html5>