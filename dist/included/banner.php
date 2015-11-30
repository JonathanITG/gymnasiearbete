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
    <div style="border: 1px solid black; width: 30vw;">
        <p>debug options</p>
        <form action="index.php" method="post">
            <input type="radio" name="logindebug" value="false">logged off</input>
            <input type="radio" name="logindebug" value="true">logged in</input>
            <input type="submit" value="submit"></input>
        </form>
    </div>
    <?php
        include("included/login.php");
    ?>
</div>