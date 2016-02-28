<div id="banner">
    <div class="bannercont" id="header">
        <a href="index.php">Forum</a>
    </div>
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