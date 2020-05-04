<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionCle.inc.php';
include 'include/fonctionApi.inc.php';


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
			$json = filiere();
			$json = json_encode($json);
			header('Content-type: application/json');
			echo($json);
		}elseif($_GET["choix"] == "groupe"){
			$json = groupe($_GET["filiere"], $_GET["groupe"]);
			$json = json_encode($json);
			header('Content-type: application/json');
			echo($json);
		}
	}else{
		FichierLog("Echec API (clé épuisé)",$_GET['cle']);
		$jsonError["Error"] = "La clé est épuisé";
		$jsonError = json_encode($jsonError);
		header('Content-type: application/json');
		echo($jsonError);
	}

}else{
	FichierLog("Echec API (mauvaise clé)",$_GET['cle']);
	$jsonError["Error"] = "Error API KEY";
	$jsonError = json_encode($jsonError);
	header('Content-type: application/json');
	echo($jsonError);
}



?>