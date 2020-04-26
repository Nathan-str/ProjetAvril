<?php
	session_start();

	//Détruit la session déjà existante
	FichierLog("déconnexion",$_SESSION['pseudo'];
	session_destroy();

	setcookie('pseudo',"",1);
	
	header("location: ./redirection.php");
?>
