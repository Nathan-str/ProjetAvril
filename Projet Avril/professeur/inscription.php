<?php
session_start();

include 'fonction.php';
$continue = verification($_POST['mail'], $_POST['numero'], "fichiers/comptes.csv");

if ($continue == true){
	inscription("fichiers/comptes.csv", "fichiers/id.txt");
}else{
	FichierLog("inscription échoué (mail ou numéro déjà utilisé)",$_POST["mail"]);
	header("location:./index.php?error=5");
}



?>
