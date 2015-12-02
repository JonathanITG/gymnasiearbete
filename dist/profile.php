<!DOCTYPE html>
<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;
?>
<html5>
    <head>
        <title></title>
    </head>
    <body>
        <?php
            include("included/banner.php");

            if(!isset($_GET["user"])) {
                header("location: index.php");
            }
            $username = $_GET["user"];
            //Vad som ska hända om användaren inte finns i databasen
            $userexist = $database->fetch_from("user", "user_name", $username, 2);
            if($userexist == 0) {
                  header("location: index.php");
            }
        ?>
        <h2><?php echo $_GET["user"]; ?></h2>
        <?php
            $profile = $database->fetch_from("user", "user_name", $username, 1);
        ?>
        <p>Registered: <?php echo $profile["user_datetime"]; ?></p>
    </body>
</html5>