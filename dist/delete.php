<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;

    if(isset($_GET["postid"])) {
        $post = $database->fetch_from("post", "post_id", $_GET["postid"], 1);
        $user = $database->fetch_from("user", "user_id", $post["poster_user"], 1);

        if($user["user_name"] == $_SESSION["current_user"]) {
            echo "Are you sure you want to delete '<i>". $post["post_topic"] ."</i>'?";
        ?>
            <form action="delete.php?postid=<?php echo $_GET["postid"]; ?>" method="post">
                <input type="submit" name="true" value="yes"></input>
                <input type="submit" autofocus name="false" value="no"></input>
            </form>
        <?php
            if(isset($_POST["true"])) {
                //delete post
                $query = $pdo->prepare("DELETE FROM post WHERE post_id = ? AND comment WHERE post_id = ?");

                $query->bindValue(1, $_GET["postid"]);
                $query->bindValue(2, $_GET["postid"]);
                header("location: index.php");
            }
            else if(isset($_POST["false"])) {
                header("location: post.php?postid=" . $_GET["postid"]);
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