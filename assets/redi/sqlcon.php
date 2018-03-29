<?php
		// Configure connection settings
		$db = 'pic';
		$db_admin = 'root';
		$db_password = 'root';
		$sqlcon = mysqli_connect("localhost", "$db_admin", "$db_password", "$db");
		
		// show arabic result
		$arabicsql= 'SET CHARACTER SET utf8'; 
		if($sqlcon == false){
			exit;
		}
		mysqli_query($sqlcon,$arabicsql); 
		
?>

<style type="text/css">
	@font-face {
		font-family: "My Custom Font";
		src: url(fonts/2.otf) format("truetype");
	}
	div , h1 , h2 , h3 , h4 { 
		font-family: "My Custom Font", Verdana, Tahoma;
	}
</style>