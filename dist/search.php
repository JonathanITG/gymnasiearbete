<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;

    htmlspecialchars($_GET['find']);

    if(isset($_GET["find"])) {
        $find = $_GET["find"];
    }
    else {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html5>
<head>
	<title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
    <link type="text/css" rel="stylesheet" href="assets/css/reset.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="jquery.bpopup.min.js"></script>
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <?php
        include("included/banner.php");
    ?>
    <div class="contentspace">
        <h2>Search results</h2>
        <div>
            <?php

            ?>
        </div>
    </div>
</body>
</html5>