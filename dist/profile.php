<!DOCTYPE html>
<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;

    $username = $_GET["user"];
?>
<html5>
    <head>
        <title><?php echo $username; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/reset.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="jquery.bpopup.min.js"></script>
        <!--<meta name="viewport" content="width=device-width">-->
    </head>
    <body>
        <?php
            include("included/banner.php");

            if(!isset($_GET["user"])) {
                header("location: index.php");
            }
            //Vad som ska hända om användaren inte finns i databasen
            $userexist = $database->fetch_from("user", "user_name", $username, 2);
            if($userexist == 0) {
                  header("location: index.php");
            }
        ?>
        <div class="contentspace">
            <h2><?php echo $_GET["user"]; ?></h2>
            <?php
                $profile = $database->fetch_from("user", "user_name", $username, 1);
            ?>
            <p>Registered: <?php echo $profile["user_datetime"]; ?></p>
            <!--Lista med inlägg från användaren-->
            <div>
                <h1>Activity<h1>
                <div class="">
                    <h4>Posts</h4>
                    <?php
                        $set = 2;
                        include("included/postlist.php");
                    ?>
                </div>
                <div>
                    <h4>Comments</h4>
                </div>
            </div>
        </div>
    </body>
</html5>