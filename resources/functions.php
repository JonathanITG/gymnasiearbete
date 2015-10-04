<?php
	
	class database { //för att minska på att skriva samma kod om och om igen, har jag gjort en klass för allt som har med databashanteringen att göra
		public function fetch_all($table) {
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM " . $table);
			$query->execute();

			return $query->fetchAll();
		}
		public function fetch_from($table, $row, $selected) {
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM " . $table . " WHERE " . $row . " = " . $selected);
			$query->execute();

			return $query->fetch();
		}
		public function add_to($table, $add, $noOfValues) {
			global $pdo;

			$questionmarks = 


			$query = $pdo->prepare("INSERT INTO " $table . "(" . $add . ")" . "VALUES (" .  . ")");
			$query->execute();

			return $query->fetch();
		}
	}
?>