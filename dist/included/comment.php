<div id="comment">
    <div><!--Add comment-->
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
                    }
                    else {
                        echo "Your comment is empty";
                    }
                }
        ?>
        <form method="post">
            <textarea name="postComment" rows="5" cols="40" Placeholder="Post a comment here.."></textarea>
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
    <div><!--messageboard-->
        <div>
            <?php
                $comments = $database->fetch_all_where("comment", "post_id", $post);
                $i = 0;

                foreach($comments as $commentCont) {
                    $i = $i + 1;
                    if($i%2) {
                        $class = "class='even'";
                    }
                    else {
                        $class = "class='odd'";
                    }

                    $poster = $database->fetch_from("user", "user_id", $commentCont["comment_user"], 1);
                    echo "<div id='commentpost' $class>
                    <h3>" . $poster["user_name"] . "</h3>
                    <p>" . $commentCont["comment_content"] . "</p>
                    </div>";
                }
            ?>
        </div>
    </div>
</div>