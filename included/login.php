<div>
	<?php
		session_start();

		include_once("../resources/connect.php");
		include_once("../resources/functions.php");

		$database = new database;


		class check_error {
			function checkNewUsername($name) {
				//Kollar om användarnamnet är ok, 1 är ok, 0 är fel
				if(!empty($name)) {
					if(preg_match("/^[a-zåäöA-ZÅÄÖ0-9]+$/", $name)) {
						$exist = $database->fetch_from("user", "user_name", $name, 2);
						if($exist == 0){
							return 1;
						}
						else {
							return 0;
						}
					}
					else {
						return 0;
					}
				}
				else {
					return 0;
				}
			}
			function checkNewEmail($email) {
				//Kollar om epost-adressen är ok, 1 är ok, 0 är fel
				if(!empty($email)) {
					if(preg_match("", $email)) {
						$exist = $database->fetch_from("user", "user_email", $email, 2);
						if($exist == 0) {
							return 1;
						}
						else {
							return 0;
						}
					}
					else {
						return 0;
					}
				}
				else {
					return 0;
				}
			}
			function checkNewPassw() {
				if(!empty($pass)) {
					if(strlen($pass) >= 8) {
						return 1;
					}
					else {
						return 0;
					}
				}
				else {
					return 0;
				}
			}
			//Kollar vad funktionerna gav ut för värde och matar ut en "nyckel" för vilka värden som blev fel
			function errPass($val1, $val2, $val3) {
				$check = "";
				$val = array($val1, $val2, $val3);
				for($i = 0; $i <= 2; $i++) {
					if($val[$i] == 1) {
						//Kollar vilka värden som är felaktiga
						$check = $check . " checked" . $i;
					}
					else {
						$check = $check . " err" . $i;
					}
				}
				return $check;
			}
		}

		$error = new check_error;

		//Adding a new user
		if(isset($_POST["newUserName"])) {
			$newUserName = $_POST["newUserName"];
			$newEmail = $_POST["newEmail"];
			$newPassword1 = $_POST["newPassword1"];
			$newPassword2 = $_POST["newPassword2"];
			$date = 1;

			//Kolla	newUserName
			$newUserNameErr = $error->checkNewUsername($newUserName);

			//debug
			if($newUserNameErr == 0) {
				echo "Skit också";
			}
			else{
				echo "Yass";
			}

			//Kolla Email
			$newEmailErr = $error->checkNewEmail($newEmail);

			//Kolla Password
			$checkNewPassw = $error->checkNewPassw($newPassword1);

			if($checkNewPassw == 1) {
				//Krypterar lösenorden med hmac_md5
				$hashed_pass = md5($newPassword1);
				$compare = md5($newPassword2);

				//Jämför lösenorden för att se till att de är lika
				if(hash_compare($hashed_pass, $compare)) {
					$pass = $hashed_pass;
				}
				else {
					$checkNewPassw = 0;
				}
			}
			$errcheck = $error->errPass($checkNewPassw, $newEmailErr, $newUserNameErr);


			if(!preg_match("/err/",$errcheck)) {
				$database->add_to("user", "user_name, user_email, user_password, user_datetime", $newUserName . ", " . $newEmail . ", " . $newPassword1 . ", " . $date);
			}
			else {
				//felhantering
			}
		}
		//log-in
		if(isset($_POST["userName"])) {
			$userName = $_POST["userName"];
			$userPassword = $_POST["password"];

			$num = $database->fetch_from("user", "user_name", $userName, 2);
			echo $num;
			if($num == 1) {
				echo "hej!";
			}
			else {
				echo "This username does not exist in our database!";
			}
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