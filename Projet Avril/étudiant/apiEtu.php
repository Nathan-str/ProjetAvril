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

	$fichier = fopen('fichiers/images.csv', 'r+');
	for ($i=0;$i<sizeof(file("fichiers/images.csv"));$i++){
 		$ligne = fgets($fichier);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $ligne);

		$nom_image = $tableau[1];
	}


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
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["image"] = $nom_image;
			$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["id"] = $tableau[0];
		}
	}
	return $jsonArray;
}

function groupe(){

	$donnes = fopen('fichiers/comptes.csv', 'r+');
	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 		$ligne = fgets($donnes);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $ligne);
		$groupe = $tableau[8];

			if ($_GET["filiere"] == $groupe){
				$jsonArray["$groupe"]["$tableau[0]"]["nom"] = $tableau[1];
				$jsonArray["$groupe"]["$tableau[0]"]["prenom"] = $tableau[2];
				$jsonArray["$groupe"]["$tableau[0]"]["mail"] = $tableau[3];
				$jsonArray["$groupe"]["$tableau[0]"]["numero"] = $tableau[4];
				$jsonArray["$groupe"]["$tableau[0]"]["image"] = "none";
				$jsonArray["$groupe"]["$tableau[0]"]["id"] = $tableau[0];
			}
	}
	return $jsonArray;
}

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
}else{
	echo "bonjour";
}



?>
