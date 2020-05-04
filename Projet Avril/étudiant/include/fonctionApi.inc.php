<?php
//Fonction permettant d'afficher l'API pour la filière choisi pour tous les comptes étudiants 
	//Fonction utilisé pour la page "apiEtu.php"
	function filiere(){

		$donnes = fopen('fichiers/comptes.csv', 'r+');
		$jsonTableau = array();
		$jsonArray = array();
		$cpt = 0;
		
		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
	 		$lignes = substr($ligne, 0,-2);
			$tableau = explode(";", $ligne);
			$filiere = $tableau[7];
			$groupe = $tableau[8];
			
			if ($_GET["filiere"] == $filiere){
				$cpt +=1;
				$jsonArray["groupe"] = $groupe;
				$jsonArray["nom"] = $tableau[1];
				$jsonArray["prenom"] = $tableau[2];
				$jsonArray["mail"] = $tableau[3];
				$jsonArray["numero"] = $tableau[4];
				$jsonArray["image"] = $tableau[9];
				$jsonArray["id"] = $tableau[0];
				$jsonTableau["$filiere"][$cpt] = $jsonArray;

			}
		}
		fclose($donnes);
		return $jsonTableau;
	}

	//Fonction permettant d'afficher l'API pour la filière et le groupe choisi pour tous les comptes étudiants 
	//Fonction utilisé pour la page "apiEtu.php"
	function groupe($filiere, $groupe){

	    $donnes = fopen('fichiers/comptes.csv', 'r+');
	    $jsonTableau = array();
	    $cpt = 0;
		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
	 		$lignes = substr($ligne, 0,-1);
			$tableau = explode(";", $ligne);

			if($filiere == $tableau[7] && $groupe == $tableau[8]){
				$cpt += 1;
				$jsonArray["nom"] = $tableau[1];
				$jsonArray["prenom"] = $tableau[2];
				$jsonArray["mail"] = $tableau[3];
				$jsonArray["numero"] = $tableau[4];
				$jsonArray["image"] = $tableau[9];
				$jsonArray["id"] = $tableau[0];
				$jsonTableau["$filiere"]["$groupe"][$cpt] = $jsonArray;

			}

		}
		fclose($donnes);
		return $jsonTableau;
	}


?>