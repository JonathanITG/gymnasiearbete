<div>
	<?php
		include_once("../resources/connect.php");
		include_once("../resources/functions.php");

		$database = new database;

		//Adding a new user
		if(isset($_POST["newUserName"])) {
			$newUserName = $_POST["newUserName"];
			$newEmail = $_POST["newEmail"];
			$newPassword1 = $_POST["newPassword1"];
			$newPassword2 = $_POST["newPassword2"];
			$date = 1;

			/*if() {

			}
			else { */
			global $pdo;

			$query = $pdo->prepare("INSERT INTO user (user_name, user_email, user_password, user_datetime) VALUES (?, ?, ?, ?)");

			$query->bindValue(1,$newUserName );
			$query->bindValue(2,$newEmail );
			$query->bindValue(3,$newPassword1);
			$query->bindValue(4,$date);

			$query->execute();
			//}
		}
		//log-in
		if(isset($_POST["userName"])) {
			/*if() {
				
			}
			else {
				
			}*/
		}
		
	?>
	<form action="login.php" method="post" autocomplete="off">
		<input type="text" name="userName" placeholder="Username"></input>
		<input type="password" name="password" placeholder="Password"></input>
		<input type="submit" value="Submit"></input>
	</form>
	<form action="login.php" method="post" autocomplete="off">
		<input type="text" name="newUserName" placeholder="Username"></input>
		<input type="text" name="newEmail" placeholder="Email-adress"></input>
		<input type="password" name="newPassword1" placeholder="Password"></input>
		<input type="password" name="newPassword2" placeholder="Password"></input>
		<input type="submit" value="Submit"></input>
	</form>
	<div>
		<button>Sign up</button> <!--Ska göra så att "logga in"-formuläret byts ut mot "Skapa konto"-fomuläret-->
		<button>Sign in</button> <!--Ska göra så att "skapa konto"-formuläret byts ut mot "logga in"-fomuläret-->
	</div>
</div>