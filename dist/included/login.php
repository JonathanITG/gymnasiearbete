<div>
	<?php
		if(isset($_SESSION["current_user"])) {
			echo "<p>You're already logged in</p>";
		}
		else {
			class check_error {
				function checkNewUsername($name) {
					$database = new database;
					//Kollar om användarnamnet är ok, 1 är ok, 0 är fel
					if(!empty($name)) {
						if(preg_match("/^[a-zåäö0-9]+$/i", $name)) {
							echo "hej";
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
					$database = new database;
					//Kollar om epost-adressen är ok, 1 är ok, 0 är fel
					if(!empty($email)) {
						if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
				function checkNewPassw($pass) {
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
							$check = $check . "c" . $i;
						}
						else {
							$check = $check . "e" . $i;
						}
					}
					return $check;
				}
			}

			$error = new check_error;
			$errortype = array("", "", "");

			//Adding a new user
			if(isset($_POST["newUserName"])) {
				$newUserName = $_POST["newUserName"];
				$newEmail = $_POST["newEmail"];
				$newPassword1 = $_POST["newPassword1"];
				$newPassword2 = $_POST["newPassword2"];
				$date = date("Y-m-d h:i:s");

				//Kolla	newUserName
				$newUserNameErr = $error->checkNewUsername($newUserName);

				//Kolla Email
				$newEmailErr = $error->checkNewEmail($newEmail);

				//Kolla Password
				$checkNewPassw = $error->checkNewPassw($newPassword1);

				if($checkNewPassw == 1) {
					//Krypterar lösenorden med hmac_md5
					$hashed_pass = md5($newPassword1); //Note to self: lägg in salt

					//Jämför lösenorden för att se till att de är lika
					if($newPassword1 === $newPassword2) {
						$pass = md5($newPassword1);
						$database->add_to("user", "user_name, user_email, user_password, user_datetime", $newUserName . ", " . $newEmail . ", " . $pass . ", " . $date);
					}
					else {
						$checkNewPassw = 0;
					}
				}
				$errcheck = $error->errPass($checkNewPassw, $newEmailErr, $newUserNameErr);
				echo $errcheck;


				if(!preg_match("/e+/", $errcheck)) {
					$database->add_to("user", "user_name, user_email, user_password, user_datetime", $newUserName . ", " . $newEmail . ", " . $pass . ", " . $date);
				}
				else {
					//Läsa av error-nyckeln för att avgöra vilka fel det finns
					for($i = 0; $i <= 2; $i++) {
						if(preg_match("/e". $i ."/", $errcheck)) {
							$errortype[$i] = true;
						}
						else {
							$errortype[$i] = false;
						}
					}
					//matar in värden för error
					do {
						$checked = false;
						if($errortype[0] === true) {
							$errortype[0] = "<small>a</small>"; //lösenordserror
						}
						else if($errortype[1] === true) {
							$errortype[1] = "<small>a</small>"; //E-posterror
						}
						else if($errortype[2] === true) {
							$errortype[2] = "<small>a</small>"; //användarnamnserror
						}
						else {
							$checked = true;
						}
					}
					while($checked == false);
				}
			}
			//log-in
			if(isset($_POST["userName"])) {
				$userName = $_POST["userName"];
				md5($userPassword) = $_POST["password"];

				$num = $database->fetch_from("user", "user_name", $userName, 2);

				echo $num;
				if($num == 1) {
					echo "hej!";
					$_SESSION["current_user"] = $userName;
				}
				else {
					echo "This username does not exist in our database!";
				}
			}
	?>
	<form action="index.php" method="post" autocomplete="off">
		<input type="text" name="userName" placeholder="Username"></input>
		<input type="password" name="password" placeholder="Password"></input>
		<input type="submit" value="Submit"></input>
	</form>
	<form action="index.php" method="post" autocomplete="off">
		<input type="text" name="newUserName" placeholder="Username"></input>
		<?php echo $errortype[2];?>
		<input type="text" name="newEmail" placeholder="Email-adress"></input>
		<?php echo $errortype[1];?>
		<input type="password" name="newPassword1" placeholder="Password"></input>
		<?php echo $errortype[0];?>
		<input type="password" name="newPassword2" placeholder="Password"></input>
		<input type="submit" value="Submit"></input>
	</form>
	<div>
		<button>Sign up</button> <!--Ska göra så att "logga in"-formuläret byts ut mot "Skapa konto"-fomuläret-->
		<button>Sign in</button> <!--Ska göra så att "skapa konto"-formuläret byts ut mot "logga in"-fomuläret-->
	</div>
	<?php
		}
	?>
</div>