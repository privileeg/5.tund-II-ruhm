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
			$plateError = "Enter number";
			
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
	$wishError="";
	$locationError="";
	$telephoneError="";
	$wish="";
	$location="";
	$telephone="";
	
	if(empty($_POST["wish"])){
			$wishError = "Mida laenutada soovid?";	
		}

	if(empty($_POST["location"])){
			$locationError = "What is your location?";			
		}

	if(empty($_POST["telephone"])){
			$telephoneError = "Please add your telephone number";			
		}

	if ( isset($_POST["wish"]) && 
		 isset($_POST["location"]) && 
		 isset($_POST["telephone"]) && 
		 !empty($_POST["wish"]) &&
		 !empty($_POST["location"]) &&
		 !empty($_POST["telephone"])
		)
		
		renting(cleanInput($_POST["wish"]), cleanInput($_POST["location"]), cleanInput($_POST["telephone"]));

	//saan andmed laenutatud asjade kohta
	
	$loanData = getRenting();
	echo "<pre>";
	var_dump($loanData);	
	echo "</pre>";		
		
?>



<h1>Data</h1>
<?=$msg;?>
<p>Welcome <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<br>
	<a href="?logout=1">Log out</a>
</p> 



<form method="POST">

<h2>Save car data</h2>

	<input name="plate" placeholder="123 ABC" type="text"> <br><br>
	<input name="color" type="color"> <br><br>
	<input type="submit" value="Salvesta">
	
</form>

<form method="POST">

<h2>What would you like to borrow ?</h2>

	<input name="wish" placeholder="Enter your wish" type="text"> <br><br>
	<input name="location" placeholder="In which city you are located at" type="text"> <br><br>
	<label>Telephone number</label><br>
	<input name="telephone" type="text"> <br><br>
	<input type="submit" value="Submit">
	
</form>

<h3>Borrowed things</h3>
<?php
	$html = "<table border='1'>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>wish</th>";
		$html .= "<th>location</th>";
		$html .= "<th>telephone</th>";
	$html .="</tr>";
	
	//iga liikme kohta massiivis(laenData)
	foreach($loanData as $l){
		//iga laenutus on $l
		$html .= "<tr>";
			$html .= "<td>".$l->id."</td>";
			$html .= "<td>".$l->wish."</td>";
			$html .= "<td>".$l->location."</td>";
			$html .= "<td>".$l->telephone."</td>";
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

















