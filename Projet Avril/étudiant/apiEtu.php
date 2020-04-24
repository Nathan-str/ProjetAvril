<?php
session_start();

function api(){
	header('Content-type: application/json');
	$donnes = fopen('fichiers/comptes.csv', 'r+');

	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 		$ligne = fgets($donnes);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $ligne);

		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["nom"] = $tableau[1];
		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["prenom"] = $tableau[2];
		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["mail"] = $tableau[3];
		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["numero"] = $tableau[4];
		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["image"] = "none";
		$jsonArray["$tableau[7]"]["$tableau[8]"]["$tableau[0]"]["id"] = $tableau[0];

	}

	fclose($donnes);
	//array_multisort($jsonArray["$tableau[7]"]["$tableau[8]"]);
	//asort($jsonArray["$tableau[7]"]["$tableau[8]"]);
	
	ksort($jsonArray);

	/*$fichierJson = fopen("api/api_etudiant.json", "w");
        $jsonArray = json_encode($jsonArray);
        fwrite($fichierJson, $jsonArray);*/

    $jsonArray = json_encode($jsonArray);
    echo($jsonArray);

}


function filiere(){

	$donnes = fopen('fichiers/comptes.csv', 'r+');
	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 		$ligne = fgets($donnes);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $ligne);
		$filiere = $tableau[7];
		
		if ($_GET["filiere"] == $filiere){
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["nom"] = $tableau[1];
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["prenom"] = $tableau[2];
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["mail"] = $tableau[3];
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["numero"] = $tableau[4];
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["image"] = $tableau[9];
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["id"] = $tableau[0];
		}
	}
	fclose($donnes);
	return $jsonArray;
}



$donne = fopen('fichiers/cle.csv', 'r+');

while(!feof($donne)){
	$ligne = fgets($donne);
	if ($ligne != "") {
		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $lignes);

		if ($_GET['cle'] == $tableau[1]){
			$validation = true;
			break;
		}else{
			$continue = false;
		}
	}
}
fclose($donne);

if ($validation == true){
	if ($_GET["choix"] == "filiere"){
		$json = filiere();
		$json = json_encode($json);
		header('Content-type: application/json');
		echo($json);
	}elseif($_GET["choix"] == "groupe"){
		$json = groupe();
		$json = json_encode($json);
		header('Content-type: application/json');
		echo($json);
	}
}else{
	$jsonError = $jsonError["Error"] = "API KEY invalide";
	$jsonError = json_encode($jsonError);
	header('Content-type: application/json');
	echo($jsonError);
}



?>