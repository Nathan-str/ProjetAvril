<?php
session_start();

include 'fonction.php';
include 'include/fonctionInscription.inc.php';
/*$continue = verification($_POST['mail'], $_POST['numero'], "fichiers/comptes.csv");

if ($continue == true){
	inscription("fichiers/comptes.csv", "fichiers/id.txt");
}else{
	FichierLog("inscription échoué (mail ou numéro déjà utilisé)",$_POST["mail"]);
	header("location:./index.php?error=5");
}*/

inscription1($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["numero"], $_POST["mdp"] , $_POST["mdp1"], 'fichiers/comptes.csv', "fichiers/id.txt","demande.php", "index.php");



?>
