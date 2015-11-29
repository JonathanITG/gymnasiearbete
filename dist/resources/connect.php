<?php
	
	//Loggar in på databasen
	try{
		//Skapar en varialbel för PDO som är inloggad på "social_website"-databasen som finns på servern som PDO kopplar upp hemsidan mot
		$pdo = new PDO('mysql:host=localhost;dbname=social_website', 'root','');
	}
	//Bestämmer vad som ska hända när hemsidan inte kan koppla upp sig mot databasen 
	catch(PDOException $e) {
		echo "the connection to the database doesn't work.. </br> Try again later!";
	}
?>