<?php
session_start();

function genererChaineAleatoire($longueur = 10){
	 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 $longueurMax = strlen($caracteres);
	 $chaineAleatoire = '';
	 for ($i = 0; $i < $longueur; $i++)
	 {
	 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
	 }
	 return $chaineAleatoire;
}


$donne = fopen('fichiers/cle.csv', 'r+');
	$_SESSION["mail"] = $_GET['key'];

	while(!feof($donne)){
		$ligne = fgets($donne);
		if ($ligne != "") {
			$lignes = substr($ligne, 0,-2);
			$tableau = explode(";", $lignes);

			if ($_GET['key'] == $tableau[0]){
				$continue = false;
				break;
			}else{
				$continue = true;
			}
		}
	}

fclose($donne);

if ($continue == true){

	$fichier = fopen('fichiers/cle.csv', 'a');

	//Generation de la clé
	$cle = genererChaineAleatoire(20);
	$_SESSION["cle"] = $cle;
	$strinfos = $_GET['key'] . ";" . $cle . "\n";
	fputs($fichier, $strinfos);
	//Ecriture de la clé dans le fichier
	//redirection avec la clé en GET
	fclose($fichier);
	header("location:./documentation.php?error=0");
}else{
	header("location:./documentation.php?error=1");
}




?>

