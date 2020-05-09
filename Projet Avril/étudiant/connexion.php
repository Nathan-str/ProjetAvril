<?php
	session_start();

	include 'include/fonction.php';
	include 'include/fonctionConnexion.inc.php';

	//Utilisation de la fonction de connexion, avec les vérifications, etc...
	connexion1($_POST['login'], $_POST['pwd'], 'fichiers/comptes.csv',"informations.php", "redirection.php");

?>