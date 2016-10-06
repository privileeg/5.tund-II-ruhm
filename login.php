<?php

	require("functions.php");
	

	
	//kui on juba sisse loginud, siis suunan DATA lehele
	if (isset($_SESSION["userId"])){
	
		//suunan sisselogimise lehele
		header("location: data.php");
		
	
	}
	
	
	$signupEmailError="";
	$signupPasswordError="";
	$signupEmail = "";
	
	
	if(isset($_POST["signupEmail"])){
		
		if(empty($_POST["signupEmail"])){
			
			$signupEmailError = "E-post on kohustuslik";
		
		}else{
			
			$signupEmail = $_POST["signupEmail"];
		}	
	}

	
	if(isset($_POST["signupPassword"])){
		
		if(empty($_POST["signupPassword"])){
			
			$signupPasswordError = "Parool on kohustuslik";
		}else{
			
			if(strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki";
				
			}
			
		}
	
	}
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		// KASUTAN FUNKTSIOONI
		signup($signupEmail, $password);
		
		
		/*ÜHENDUS
		$database = "if16_andralla";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		// meie serveris nagunii 
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysqli->error;
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		// küsimärgid asendada muutujaga
		$stmt->bind_param("ss", $signupEmail, $password);
		
		//täida käsku
		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
		*/
	}
	
	$error ="";
	if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) &&
		
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])	
		){
			//notice või error vahet pole
			$error = login($_POST["loginEmail"], $_POST["loginPassword"]);	
		}

?>


<html>
<head>
	<title>Logi sisse voi registreeru</title>
</head>

<body>
	<h2>Logi sisse</h2>
	
	<form method="POST"> <!--POST ei kuva paroole ega asi URL'is-->
		
		<p style="color:red;"><?=$error;?></p>
		
		<input name="loginEmail" placeholder="E-post" type="text"><br><br>
		
		<input name="loginPassword" placeholder="Parool" type="password"><br><br>

		<input type="submit" value="Logi sisse">
		
	</form>

	
	<h2>Registreeru</h2>
	
	<form method="POST">
		
		<input name="signupEmail" placeholder="E-post" type="text"> <?php echo $signupEmailError; ?> <br><br>
		
		<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?> <br><br>
		
		<input name="signupName" placeholder="Eesnimi" type="text"> <br><br>
		
		<input name="signupFamily" placeholder="Perekonnanimi" type="text"> <br><br>
		
		<h4>Vali sugu</h4>
		
		<input type="radio" name="Sugu" value="Mees" checked> Mees <br>
		
		<input type="radio" name="Sugu" value="Naine"> Naine <br>
		
		<input type="radio" name="Sugu" value="Muu"> Muu <br><br>
		
		<input type="submit" value="Registreeru">
		
	</form>
	
</body>
</html>