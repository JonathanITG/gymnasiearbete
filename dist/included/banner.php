<div id="banner">
    <?php
        if(isset($_POST["logindebug"])) {
            $bool = $_POST["logindebug"];
            if($bool == "true") {
                $_SESSION["current_user"] = "debug";
            }
            else if(isset($_SESSION["current_user"])) {
                session_destroy();
            }
        }
    ?>
    <div class="bannercont" id="header">
        <a href="index.php">Forum</a>
    </div>
    <!--<div style="border: 1px solid black; width: 30vw;">
        <p>debug options</p>
        <form method="post">
            <input type="radio" name="logindebug" value="false">logged off</input>
            <input type="radio" name="logindebug" value="true">logged in</input>
            <input type="submit" value="submit"></input>
        </form>
    </div>-->
    <div class="bannercont" id="login">
    <?php
        include("included/login.php");
    ?>
    </div>
    <div class="bannercont" id="searchbar">
        <form method="get" action="search.php">
            <input type="text" name="find" placeholder="Search" id="searchinput"></input>
            <input type="submit" value="Search" id="searchsubmit"></input>
        </form>
    </div>
</div>