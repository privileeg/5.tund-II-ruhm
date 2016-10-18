<?php

	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
			//suunan sisselogimise lehele
			header("location: login.php");
			exit(); //headerist ainult ei piisa, sest kood k2ivitatakse edasi ikkagi, aga exit'iga mitte
	}
	
	//kui on ?logout URLis siis logi välja
	if (isset($_GET["logout"])){
		
		session_destroy();
		header("Location: login.php");
		
	}


	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		//n2idatakse yhekorra, kui lehele uuesti tulen, siis seda pole enam. hoitakse meeles kuni aken lahti
		unset($_SESSION["message"]);
	}

	$plateError="";
	$color="";
	$plate="";
	
	if(empty($_POST["plate"])){
			$plateError = "Sisesta number";
			
		}
	if ( isset($_POST["color"]) && 
		 isset($_POST["plate"]) && 
		 !empty($_POST["color"]) &&
		 !empty($_POST["plate"])
		)
		
		savecar(cleanInput($_POST["color"]), cleanInput($_POST["plate"]));
		
	//saan auto andmed
	
	/*$carData = getAllCars();
	echo "<pre>";
	var_dump($carData);	
	echo "</pre>";
	*/
	$soovError="";
	$asukohtError="";
	$telefonError="";
	$soov="";
	$asukoht="";
	$telefon="";
	
	if(empty($_POST["soov"])){
			$soovError = "Mida laenutada soovid?";	
		}

	if(empty($_POST["asukoht"])){
			$asukohtError = "Kus sa asud?";			
		}

	if(empty($_POST["telefon"])){
			$telefonError = "Palun lisa oma telefoni number";			
		}

	if ( isset($_POST["soov"]) && 
		 isset($_POST["asukoht"]) && 
		 isset($_POST["telefon"]) && 
		 !empty($_POST["soov"]) &&
		 !empty($_POST["asukoht"]) &&
		 !empty($_POST["telefon"])
		)
		
		laenutus(cleanInput($_POST["soov"]), cleanInput($_POST["asukoht"]), cleanInput($_POST["telefon"]));

	//saan andmed laenutatud asjade kohta
	
	$laenData = getLaenutus();
	echo "<pre>";
	var_dump($laenData);	
	echo "</pre>";		
		
?>



<h1>Data</h1>
<?=$msg;?>
<p>Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<br>
	<a href="?logout=1">Logi välja</a>
</p> 



<form method="POST">

<h2>Salvesta auto andmed</h2>

	<input name="plate" placeholder="123 ABC" type="text"> <br><br>
	<input name="color" type="color"> <br><br>
	<input type="submit" value="Salvesta">
	
</form>

<form method="POST">

<h2>Mida soovid laenutada?</h2>

	<input name="soov" placeholder="Kirjuta siia oma soov" type="text"> <br><br>
	<input name="asukoht" placeholder="Kus linnas sa asud?" type="text"> <br><br>
	<label>Telefoni number</label><br>
	<input name="telefon" type="text"> <br><br>
	<input type="submit" value="Laenuta">
	
</form>

<h3>Laenutatud asjad</h3>
<?php
	$html = "<table border='1'>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>soov</th>";
		$html .= "<th>asukoht</th>";
		$html .= "<th>telefon</th>";
	$html .="</tr>";
	
	//iga liikme kohta massiivis(laenData)
	foreach($laenData as $l){
		//iga laenutus on $l
		$html .= "<tr>";
			$html .= "<td>".$l->id."</td>";
			$html .= "<td>".$l->soov."</td>";
			$html .= "<td>".$l->asukoht."</td>";
			$html .= "<td>".$l->telefon."</td>";
		$html .="</tr>";
	}

	$html .= "</table>";
	echo $html;

	//ei soovi seda n2idata, sest see kole ning hetkel puuduvad oskused selle ilustamiseks
	/*
	$listHtml = "<br><br>";
	foreach($laenData as $l){
	
		$listHtml .= "<h1>".$l->soov."<h1>";
		
	}
	
	echo $listHtml
	*/
?>


<html>
<!--<h2>Salvestatud autod</h2>-->
</html>
<?php
	/*
	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>plate</th>";
		$html .= "<th>color</th>";
	$html .="</tr>";
	
	//iga liikme kohta massiivis(cardata)
	foreach($carData as $c){
		//iga auto on $c
		//echo $c->plate. "<br>";
		$html .= "<tr>";
			$html .= "<td>".$c->id."</td>";
			$html .= "<td>".$c->plate."</td>";
			$html .= "<td>".$c->carcolor."</td>"; // v6i style='background-color:"$c->carcolor."'
		$html .="</tr>";
	}

	$html .= "</table>";
	echo $html;

	
	$listHtml = "<br><br>";
	foreach($carData as $c){
	
		$listHtml .= "<h1 style='color:".$c->carcolor."'>".$c->plate."<h1>";
		
	}
	
	echo $listHtml
*/
?>

















