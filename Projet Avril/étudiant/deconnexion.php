<?php
	session_start();

	//Détruit la session déjà existante
	session_destroy();

	setcookie('pseudo',"",1);
	
	header("location: ./redirection.php");
?>
