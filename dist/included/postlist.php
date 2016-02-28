<?php
    //Notis: Flyttade inläggslistan till en egen fil för att öka möjligheterna att återanvända koden
        $posts = $database->fetch_all("post");

    $i = 0;
    foreach(array_reverse($posts) as $post) {

        if($set == 1) {
            $post = $database->fetch_from("post", "post_id", $post["post_id"], 1);
            $poster = $database->fetch_from("user", "user_id", $post["poster_user"], 1);
        }
        else if($set == 2) {
            do {
                $post = $database->fetch_from("post", "post_id", $post["post_id"], 1);
                $poster = $database->fetch_from("user", "user_id", $post["poster_user"], 1);
            }
            while($poster["user_name"] == $_GET["user"]);
        }

        $i = $i + 1;

        if($i%2) {
            $class = "class='even'";
        }
        else {
            $class = "class='odd'";
        }
        //Skapa kod för att räkna antal kommentarer i inlägg
        ?>
        <div class="postbox">
            <a id="post" <?php echo $class; ?> href="post.php?postid=<?php echo $post["post_id"]; ?>"><?php echo $post["post_topic"] ?>
            </a>
        <div id="postinfo" <?php echo $class; ?>>
        <?php
            //Calculates amount of comments

            //$commentCount =
        ?>
        <a class="tag" id="timestamp"><?php echo $post["post_date"]; ?></a>
        <a class="tag" id="commenttag">142</a>
        <a class="tag" id="usertag" href="profile.php?user=<?php echo $poster["user_name"]; ?>"><?php echo $poster["user_name"]; ?></a>
            </div>
        </div>
<?php
}
?>