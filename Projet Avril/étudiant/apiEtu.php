<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionCle.inc.php';

	function compteurCle(){
		$donnes = fopen('fichiers/cle.csv', 'r+');
		$informations = array();

		for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
		 		$ligne = fgets($donnes);
		 		$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				$temps_actuel = time();
				$temps = date('h',$temps_actuel);

				if ($_GET['cle'] == $tableau[1]){
					if ($temps == $tableau[3]) {
						$cpt = $tableau[4] + 1;
						$time = $tableau[3];
					}else{
						$time = $temps;
						$cpt = 1;
					}	
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $time . ";" . $cpt;
					array_push($informations, $strinformations);
				}else{
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4];
					array_push($informations, $strinformations);
				}
		}

		fclose($donnes);
		$donnes = fopen('fichiers/cle.csv', 'w');

		for ($i=0;$i<sizeof($informations);$i++){
			fputs($donnes, $informations[$i] . "\n");
		}
		fclose($donnes);
	}

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