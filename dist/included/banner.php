<div>
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
    <a href="index.php"><h1>Name of this website</h1></a>
    <div style="border: 1px solid black; width: 30vw;">
        <p>debug options</p>
        <form method="post">
            <input type="radio" name="logindebug" value="false">logged off</input>
            <input type="radio" name="logindebug" value="true">logged in</input>
            <input type="submit" value="submit"></input>
        </form>
    </div>
    <?php
        include("included/login.php");
    ?>
    <div>
        <p>search</p>
        <form method="get" action="search.php">
            <input type="text" name="find" placeholder="Search"></input>
            <input type="submit" value="Search"></input>
        </form>
    </div>
</div>