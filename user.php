<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["interest"]) && 
		!empty($_POST["interest"])
	  ) {
		  
		saveInterest(cleanInput($_POST["interest"]));
		
	}
	
	if ( isset($_POST["userInterest"]) && 
		!empty($_POST["userInterest"])
	  ) {
		  
		saveUserInterest(cleanInput($_POST["userInterest"]));
		
	}
	
	
    $interests = getAllInterests();
	$Userinterests = getAllUserInterests();
?>
<h1><a href="data.php"> < back</a>User page</h1>
<?=$msg;?>
<p>
	Welcome <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Log out</a>
</p>


<h2>Save your hobby</h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($Userinterests as $i){
		
		
		$listHtml .= "<li>".$i->interest."</li>";

	}
    
    $listHtml .= "</ul>";

	
	echo $listHtml;
    
?>
<form method="POST">
	
	<label>Hobby/interest</label><br>
	<input name="interest" type="text">
	
	<input type="submit" value="Save">
	
</form>



<h2>User hobbies</h2>
<form method="POST">
	
	<label>Hobby/interest name</label><br>
	<select name="userInterest" type="text">
        <?php
            
            $listHtml = "";
        	
        	foreach($interests as $i){
        		
        		
        		$listHtml .= "<option value='".$i->id."'>".$i->interest."</option>";
        
        	}
        	
        	echo $listHtml;
            
        ?>
    </select>
    	
	
	<input type="submit" value="Add">
	
</form> 