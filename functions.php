<?php
	
	require("../../config.php");
	
	session_start();

	function signUp ($email, $password, $name, $family){
	
		$database = "if16_andralla";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
	
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample1 (email, password, name, family) VALUES (?, ?, ?, ?)");
		
		echo $mysqli->error;

		$stmt->bind_param("ssss", $email, $password, $name, $family);
		
	
		if($stmt->execute()) {
			echo "salvestamine õnnestus";			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	
	}
	
	function login ($email, $password){
	
		$error = "";
		
		$database = "if16_andralla";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample1 WHERE email = ?");
		
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		//on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo "kasutaja logis sisse".$id;
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//määran sessiooni muutujad millele saan ligi teistelt lehtedelt
				header("Location: data.php");
			
			}else{
				$error = "vale parool";
			}
			
						
		} else {
			//ei leidnud kasutajat selle meiliga
			$error = "ei ole sellist emaili";
		}
		
		return $error;
		
	}

	function savecar ($color, $plate){
	
		$database = "if16_andralla";
		//yhendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		
		$stmt = $mysqli->prepare("INSERT INTO cars_color (color, plate) VALUES (?, ?)");
		
		echo $mysqli->error;

		$stmt->bind_param("ss", $color, $plate);
		
	
		if($stmt->execute()) {
			echo "salvestamine õnnestus";			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	
	}
	
	/*function getAllCars() {
		
		$database = "if16_andralla";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, plate, color FROM cars_color");
		$stmt->bind_result($id, $plate, $color);
		$stmt->execute();
		echo $mysqli->error;
		
		//tekitan massiivi
		$result = array();
		// tee seda seni kuni on rida andmeid
		// mis vastab select lausele
		// fetch annab andmeid yhe rea kaupa
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$car = new StdClass();
			
			$car -> id = $id;
			$car -> plate =$plate;
			$car -> carcolor =$color;
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr m2rgi
			array_push($result, $car);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
		
	}
	*/
	function laenutus ($soov, $asukoht, $telefon){
	
		$database = "if16_andralla";
		//yhendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		
		$stmt = $mysqli->prepare("INSERT INTO laenutus (soov, asukoht, telefon) VALUES (?, ?, ?)");
		
		echo $mysqli->error;

		$stmt->bind_param("sss", $soov, $asukoht, $telefon);
		
	
		if($stmt->execute()) {
			echo "salvestamine õnnestus, laenutuse soov on teele pandud";			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	
	}
	
	function getLaenutus() {
		
		$database = "if16_andralla";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, soov, asukoht, telefon FROM laenutus");
		$stmt->bind_result($id, $soov, $asukoht, $telefon);
		$stmt->execute();
		echo $mysqli->error;
		
		//tekitan massiivi
		$result = array();
		// tee seda seni kuni on rida andmeid
		// mis vastab select lausele
		// fetch annab andmeid yhe rea kaupa
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$laen = new StdClass();
			
			$laen -> id = $id;
			$laen -> soov =$soov;
			$laen -> asukoht =$asukoht;
			$laen -> telefon =$telefon;
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr m2rgi
			array_push($result, $laen);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
		
	}
	
	
?>