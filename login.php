<?php

	require("functions.php");
	

	
	//kui on juba sisse loginud, siis suunan DATA lehele
	if (isset($_SESSION["userId"])){
	
		//suunan sisselogimise lehele
		header("location: data.php");
		
	
	}
	
	$loginEmail="";
	$loginEmailError="";
	$loginPasswordError="";	
	
	$signupEmailError="";
	$signupPasswordError="";
	$signupNameError="";
	$signupFamilyError="";
	
	$signupName="";
	$signupFamily="";
	$signupEmail = "";
	
	if(isset($_POST["loginEmail"])){
		
		if(empty($_POST["loginEmail"])){
			
			$loginEmailError="E-mail on sisestamata";
			
		}else{
			
			$loginEmail=$_POST["loginEmail"];
		}
	}
	
	if(isset($_POST["loginPassword"])){
		
		if(empty($_POST["loginPassword"])){
			
			$loginPasswordError="Parool on sisestamata";
			
		}else{
			
			$loginPassword=$_POST["loginPassword"];
		}
	}
	
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
	
	if(isset($_POST["signupName"])){
		
		if(empty($_POST["signupName"])){
			
			$signupNameError="Eesnime sisestamine on kohustuslik";
			
		}else{
			
			$signupName=$_POST["signupName"];
		}
	}
	
	if(isset($_POST["signupFamily"])){
		
		if(empty($_POST["signupFamily"])){
			
			$signupFamilyError="Perenime sisestamine on kohustuslik";
			
		}else{
			
			$signupFamily=$_POST["signupFamily"];
		}
	}
	
	
	

	
	if ( isset($_POST["signupEmail"]) && isset($_POST["signupName"]) && isset($_POST["signupFamily"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "eesnimi: ".$signupName."<br>";
		echo "perekonnanimi: ".$signupFamily."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		// KASUTAN FUNKTSIOONI
		signup($signupEmail, $password, $signupName, $signupFamily);
		
		/*
		ÜHENDUS
		$database = "if16_andralla";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		// meie serveris nagunii 
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, firstname, familyname) VALUES (?, ?, ?, ?)");
		
		echo $mysqli->error;
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		// küsimärgid asendada muutujaga
		$stmt->bind_param("ssss", $signupEmail, $signupPassword, $signupName, $signupFamily);
		
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
		
		<input name="signupName" placeholder="Eesnimi" type="text"> <?php echo $signupNameError; ?> <br><br>
		
		<input name="signupFamily" placeholder="Perekonnanimi" type="text"> <?php echo $signupFamilyError; ?> <br><br>
		
		<h4>Vali sugu</h4>
		
		<input type="radio" name="Sugu" value="Mees" checked> Mees <br>
		
		<input type="radio" name="Sugu" value="Naine"> Naine <br>
		
		<input type="radio" name="Sugu" value="Muu"> Muu <br><br>
		
		<input type="checkbox" name="newsLetter" checked> Soovin ohtralt reklaami oma E-posti <br><br>
		
		<input type="submit" value="Registreeru">
		
	</form>
	
</body>
</html>