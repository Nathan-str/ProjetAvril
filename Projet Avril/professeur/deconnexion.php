<?php
	session_start();

	include 'include/fonction.php';

	//Détruit la session déjà existante
	FichierLog("déconnexion",$_SESSION['pseudo']);
	session_destroy();

	setcookie('pseudo',"",1);
	
	header("location: ./index.php");
?>
