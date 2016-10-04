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






?>
<h1>Data</h1>

<p>Tere tulemas <?=$_SESSION["userEmail"];?>!
	<br>
	<a href="?logout=1">Logi välja</a>
	<br>
	<p><a href="https://www.postimees.ee">Klikka siia</a> et lugeda Postimeest</p>
</p> 




