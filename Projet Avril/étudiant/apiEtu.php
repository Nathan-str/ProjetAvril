<?php
session_start();

include 'fonction.php';



function compteurCle(){
	$donnes = fopen('fichiers/cle.csv', 'r+');
	$informations = array();

	for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
	 		$ligne = fgets($donnes);
	 		$lignes = substr($ligne, 0,-1);
			$tableau = explode(";", $lignes);
			$timestamp = time();
			$temps = date('h',$timestamp);

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

			if ($_GET['cle'] == $tableau[1]){
				if ($tableau[4] <= 20){
					$validation = true;
					break;
				}
			}else{
				$validation = false;
			}
		}
	}
	return $validation;
	fclose($donne);
}

compteurCle();
$validation = verifCleApi();

if ($validation == true){
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
	FichierLog("Echec API",$_GET['cle']);
	$jsonError = $jsonError["Error"] = "Error API";
	$jsonError = json_encode($jsonError);
	header('Content-type: application/json');
	echo($jsonError);
}



?>