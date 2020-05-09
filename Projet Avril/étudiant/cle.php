<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionCle.inc.php';
include 'include/fonctionApi.inc.php';

function compteurCleAffichage(){
		$donnes = fopen('fichiers/cle.csv', 'r+');
		$informations = array();

		for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
		 		$ligne = fgets($donnes);
		 		$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				$temps_actuel = time();
				$temps = date('h',$temps_actuel);
				if ($tableau[0] == $_GET['key-mail']){
					if ($temps == $tableau[3]) {
					$cpt = $tableau[4];
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

if ($_GET['choose'] == "inscription"){
	//Si on choisit l'inscription, fais les étapes pour la demande de la clé.
	inserCle();
}elseif ($_GET['choose'] == "connexion") {
	//Si on demande de voir sa clé, vérifie le compteur et le réinitialise si besoin
	//Renvoie un message d'erreur selon la situation.
	compteurCleAffichage();
	verifCle();
}else{
	echo"error";
}





?>

