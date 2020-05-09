<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionCle.inc.php';
include 'include/fonctionApi.inc.php';


//Vérifie si la clé existe dans le fichier des clés et regarde si le compteur ne dépasse pas 200 utilisations.
function verifCleApi(){
	$donne = fopen('fichiers/cle.csv', 'r+');

	while(!feof($donne)){
		$ligne = fgets($donne);
		if ($ligne != "") {
			$lignes = substr($ligne, 0,-1);
			$tableau = explode(";", $lignes);

			if ($_GET['cle'] == $tableau[1] && $tableau[4] <= 200){
					$validation = true;
					break;
			}else{
				$validation = false;
			}
		}
	}
	return $validation;
	fclose($donne);
}

compteurCle();
//$validation = verifCleApi();
$validation = double($_GET['cle'], "1", 'fichiers/cle.csv');
$inferieur = inferieur($_GET['cle'],"4", "1","200", 'fichiers/cle.csv');

if ($validation == false){

	if ($inferieur == true){
		FichierLog("API distribué",$_GET['cle']);
		if ($_GET["choix"] == "filiere"){
			$json = filiere();//API pour les filières.
			$json = json_encode($json);
			header('Content-type: application/json');
			echo($json);
		}elseif($_GET["choix"] == "groupe"){
			$json = groupe($_GET["filiere"], $_GET["groupe"]);//API pour les groupes.
			$json = json_encode($json);
			header('Content-type: application/json');
			echo($json);
		}
	}else{
		FichierLog("Echec API (clé épuisé)",$_GET['cle']);
		$jsonError["Error"] = "La clé est épuisé";//API si la clé à dépassé son nombre d'utilisation par heure.
		$jsonError = json_encode($jsonError);
		header('Content-type: application/json');
		echo($jsonError);
	}

}else{
	FichierLog("Echec API (mauvaise clé)",$_GET['cle']);
	$jsonError["Error"] = "Error API KEY";//API si la clé d'API n'est pas bonne.
	$jsonError = json_encode($jsonError);
	header('Content-type: application/json');
	echo($jsonError);
}



?>