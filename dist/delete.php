<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;

    if(isset($_GET["postid"])) {
        echo $_GET["postid"];
        $post = $database->fetch_from("post", "post_id", $_GET["postid"], 1);
        $user = $database->fetch_from("user", "user_id", $post["poster_user"], 1);

        if($user["user_name"] == $_SESSION["current_user"]) {
            echo "Are you sure you want to delete '<i>". $post["post_topic"] ."</i>'?";
        ?>
            <form method="post">
                <button type="submit" name="delete" value="true">Yes</button>
                <button type="submit" name="delete" value="false" autofocus>No</button>
            </form>
        <?php
            if(isset($_POST["delete"])) {
                if($_POST["delete"] == "true") {
                    //delete post and comments to post
                    $query = $pdo->prepare('DELETE FROM post WHERE post_id = ?/*AND `comment` WHERE post_id = ?*/');

                    $query->bindValue(1, $_GET['postid']);
                    //$query->bindValue(2, $_GET['postid']);
                    $query->execute();

                    $query = $pdo->prepare('DELETE FROM `comment` WHERE post_id = ?');
                    $query->bindValue(1, $_GET['postid']);
                    $query->execute();

                    header("location: index.php");
                }
                else if($_POST["delete"] == "false") {
                    header("location: post.php?postid=" . $_GET["postid"]);
                }
            }
        }
        else {
            header("location: index.php");
        }
    }
    else {
        header("location: index.php");
    }

?>