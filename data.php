<?php

	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
			//suunan sisselogimise lehele
			header("location: harjutus.php");
			
	
	}
	
	//kui on ?logout URLis siis logi välja
	if (isset($_GET["logout"])){
		
		session_destroy();
		header("Location: harjutus.php");
		
	}


	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		//n2idatakse yhekorra, kui lehele uuesti tulen, siis seda pole enam. hoitakse meeles kuni aken lahti
		unset($_SESSION["message"]);
	}

	$plateError="";
	$color="";
	$plate=$_POST["plate"];
	if(empty($_POST["plate"])){
			$plateError = "Sisesta number";
			
		}
	if ( isset($_POST["color"]) && 
		 isset($_POST["plate"]) && 
		 !empty($_POST["color"]) &&
		 !empty($_POST["plate"])
		)
		
		savecar($_POST["color"], $_POST["plate"]);
		
	//saan auto andmed
	
	$carData = getAllCars();
	echo "<pre>";
	var_dump($carData);	
	echo "</pre>";
		
?>



<h1>Data</h1>
<?=$msg;?>
<p>Tere tulemas <?=$_SESSION["userEmail"];?>!
	<br>
	<a href="?logout=1">Logi välja</a>
	<br>
	<p><a href="https://www.postimees.ee">Klikka siia</a> et lugeda Postimeest</p>
</p> 



<form method="POST">

<h2>Salvesta auto andmed</h2>

	<input name="plate" placeholder="123 ABC" type="text"> <br><br>
	<input name="color" type="color"> <br><br>
	<input type="submit" value="Salvesta">
	
</form>

<h2>Autod</h2>

<?php
	
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
			$html .= "<td style='background-color:#640b33'>".$c->carcolor."</td>"; // v6i style='background-color:"$c->carcolor."'
		$html .="</tr>";
	}

	$html .= "</table>";
	echo $html;


	$listHtml = "<br><br>";
	foreach($carData as $c){
	
		$listHtml .= "<h1 style='color:".$c->carcolor."'>".$c->plate."<h1>";
		
	}
	
	echo $listHtml
	
	
	
	
?>

















