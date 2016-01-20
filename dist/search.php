<?php
    session_start();

    include_once("resources/connect.php");
    include_once("resources/functions.php");

    $database = new database;

    if(isset($_GET["find"])) {
        $find = $_GET["find"];
    }
    else {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
</head>
<body>
    <?php
        include("included/banner.php");
    ?>
    <h1>Search results</h1>
    <div>
        <?php

        ?>
    </div>
</body>
</html>