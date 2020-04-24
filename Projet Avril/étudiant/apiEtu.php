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

function ApiLogReussi($evenement){
	$fichier = 'fichiers/log.csv';
	$time = date("D, d M Y H:i:s");
	$time = "[".$time."]";
	$evenement = $time. ";" ."api_distribué".";". $evenement."\n";

	file_put_contents($fichier, $evenement, FILE_APPEND);
}

function ApiLogEchec($evenement){
	$fichier = 'fichiers/log.csv';
	$time = date("D, d M Y H:i:s");
	$time = "[".$time."]";
	$evenement = $time. ";" ."echec_api".";". $evenement ."\n";

	file_put_contents($fichier, $evenement, FILE_APPEND);
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

function groupe($filiere, $groupe){

    $donnes = fopen('fichiers/comptes.csv', 'r+');
	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 		$ligne = fgets($donnes);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $ligne);

		if($filiere == $tableau[7] && $groupe == $tableau[8]){
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["nom"] = $tableau[1];
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["prenom"] = $tableau[2];
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["mail"] = $tableau[3];
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["numero"] = $tableau[4];
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["image"] = $tableau[9];
			$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["id"] = $tableau[0];
		}

	}
	fclose($donnes);
	return $jsonArray;
    // ouvre le fichier CSV des etudiants

    // parcourt chaque ligne 

        // on "explode" la ligne
        // on compare l'element 4 du tableau de la ligne avec la $filiere ET l'element 5 avec le $group
        // si ok
            



    // Retourne un tableau contenant pour chaque entrée : un tableau avec toutes les infos de l'etudiant

/*function transformArrayToJSON( $tab ){
    return json_encode($tab);
}


$info = getAllStudentInfo( "LPI", "LPI-1" );

$json = transformArrayToJSON($info);


// print_r($info);
echo($json);*/
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
	ApiLogReussi($_GET['cle']);
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
	ApiLogEchec($_GET['cle']);
	$jsonError = $jsonError["Error"] = "API KEY invalide";
	$jsonError = json_encode($jsonError);
	header('Content-type: application/json');
	echo($jsonError);
}



?>