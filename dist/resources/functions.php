<?php

	class database { //för att minska på att skriva samma kod om och om igen, har jag gjort en klass för allt som har med databashanteringen att göra
		public function fetch_all($table) { //Bara tabellnamnet som behöver matas in
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM " . $table);
			$query->execute();

			return $query->fetchAll();
		}
		public function fetch_from($table, $row, $selected, $num) { //mata in tabell, vilken rad man vill söka i och vilket värde man vill söka efter. $num bestämmer vad man vill ska hända; 1 är fetch, 2 är count
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM " . $table . " WHERE " . $row . " = ?");
			$query->bindValue(1, $selected);
			$query->execute();
			$count = $num;

			if($count == 1) {
				return $query->fetch();
			}
			else if($count == 2) {
				return $query->rowCount();
			}
		}
		public function add_to($table, $addto, $addval) { //vilken tabell man vill lägga till uppgifter i och vad det är man vill lägga till. OBS, separera värden i $add med ", "
			global $pdo;

			$exploded = explode(", ", $addto);
			//delimiter changed to "<> " due to problem not being able to type commas
			$explodedval = explode("<> ", $addval);

			$NooObj = count($exploded); //Number of objects
			for($i = 1; $i<=$NooObj; $i++) {
				if($i == $NooObj) {
					$quMa = $quMa . "?";
				}
				else if($i == 1) {
					$quMa = "?, ";
				}
				else {
					$quMa = $quMa . "?, ";
				}
			}

			$query = $pdo->prepare("INSERT INTO " . $table . " (" . $addto . ")" . " VALUES (" . $quMa . ")");

			for($i = 0; $i < $NooObj; $i++) {
				$query->bindValue($i+1, $explodedval[$i]);
			}

			$query->execute();
		}
		public function fetch_all_where($table, $row, $value) {
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM " . $table . " WHERE " . $row . " = ?");
			$query->bindValue(1, $value);
			$query->execute();

			return $query->fetchAll();
		}
	}
?>