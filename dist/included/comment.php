<div id="commentsection">
    <div id="msgboard"><!--messageboard-->
        <?php
            $comments = $database->fetch_all_where("comment", "post_id", $post);
            $i = 0;

            foreach($comments as $commentCont) {
                //Changes color of comments, to seperate them
                $i = $i + 1;
                if($i%2) {
                    $class = "class='even'";
                }
                else {
                    $class = "class='odd'";
                }
                $poster = $database->fetch_from("user", "user_id", $commentCont["comment_user"], 1);
                $procComment = preg_replace("/\r|\n/", "<br/>", $commentCont["comment_content"] );
                ?>
                <div id="comment" <?php echo $class; ?>>
                    <div id="commentinfo">
                        <div id="avatar"></div>
                        <h3>name: <?php echo $poster["user_name"]; ?></h3>
                    </div>
                    <div id='commentpost' <?php echo $class; ?>>
                        <p><?php echo $procComment; ?></p>
                        <p><?php echo $commentCont["comment_date"]; ?><p>
                        <?php
                            if(isset($_SESSION["current_user"])) {
                                if($poster["user_name"] == $_SESSION["current_user"]) {
                                    echo "<a href='delete.php'>delete</a>";
                                }
                            }
                        ?>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
    <div id="addComment">
        <?php
            if(isset($_SESSION["current_user"])) {
                if(isset($_POST["postComment"])) {
                    $comment = $_POST["postComment"];
                    $post = $_GET["postid"];
                    $currentUser = $database->fetch_from("user", "user_name",$_SESSION["current_user"], 1);
                    $userid = $currentUser["user_id"];
                    $date = date("Y-m-d h:i:s");

                    if(!empty($comment)) {
                        $database->add_to("comment", "post_id, comment_user, comment_content, comment_date", $post . ", " . $userid . ", " . $comment . ", " . $date);
                        header("Location: post.php?postid=" . $post . "#addComment");
                    }
                    else {
                        echo "Your comment is empty";
                    }
                }
        ?>
        <form method="post">
            <textarea name="postComment" rows="5" cols="60" Placeholder="Post a comment here.."></textarea>
            <input type="submit" value="Upload"></input>
        </form>
        <?php
            }
            else {
        ?>
        <p>Join the conversation and sign up to this awsome forum!!</p>
        <?php
            }
        ?>
    </div>
</div>