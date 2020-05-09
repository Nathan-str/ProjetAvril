<?php

	//Fonction permettant d'afficher le message souhaité pour le numéro d'erreur indiqué
	//Fonction utilisé sur les pages de redirection.
	function error($numero, $message){
		if(isset($_GET['error'])){
			if($_GET['error'] == $numero){
			?>
			<script type="text/javascript">
				alert("<?php echo($message);?>");
			</script>
			<?php
			}
		}
	}

	//Fonction permettant de vérifier un pattern désigner pour une chaine de caractère souhaité.
    function Regex($pattern, $pseudo){
    	if(preg_match($pattern, $pseudo)){
    		$continue = true;
    	}else{
    		$continue = false;
    	}
    	return $continue;
    }

    //Fonction écrivant dans le fichier des logs, le message souhaité pour la personne souhaité.
    function FichierLog($message,$evenement){
		$fichier = 'fichiers/log.csv';
		$time = date("D, d M Y H:i:s");
	    $time = "[".$time."]";
	    $evenement = $time. ";" .$message.";".$evenement."\n";

	    file_put_contents($fichier, $evenement, FILE_APPEND);
	}

	
	//Fonction permettant de vérifier la longueur d'un mot de passe
	//Utiliser pour l'inscription et la connexion.
	function longueur($mdp){
		if(strlen($mdp) >= 0){
			$continue = true;
		}else{
			$continue = false;
		}
		return $continue;
	}


	//Fonction écrivant toutes les connexions par heure (pas utilisé finalement, mais peut servir)
	function stastitiques(){
		$dossier = fopen("fichiers/stats.log", "r");
		//Même processus mais pour chaque jour de la semaine
		$statistiques = array();

		while ($elements = fgets($dossier)) {
			$elements = explode(';', $elements);

			if ($elements[0] == strftime("%H", time())) { //%H correspond au heures de 00 à 23
				$valeur_element = $elements[1];
				$valeur_element +=1;
				$put_element = $elements[0] . ";" . $valeur_element . "\n";
			}else{
				$put_element = $elements[0] . ";" . $elements[1];
			}

			array_push($statistiques, $put_element);
		}

		$dossier = fopen("fichiers/stats.log", "w");

		for($i = 0; $i < sizeof($statistiques);$i++){
			fputs($dossier, $statistiques[$i]);
		}

		fclose($dossier);
	}

	
	//----------------------------------------------------------

	//Fonction permettant de vérifier l'existance d'un paramètre, si il n'exsite pas, indication de la page de redirection.
	function verifSession($session, $page){
		if(isset($session) && !empty($session)){
			$continue = true;
		}else{
			header("location:./" . $page);
		}
	}

	//Fonction permettant de vérifier l'existance d'un paramètre, si il n'exsite pas renvoie false sans redirection.
	function verifElement($session){
		if(isset($session) && !empty($session)){
			$continue = true;
		}else{
			$continue = false;
		}
		return $continue;
	}

	//-----------------------------------------------------------
	

	//Fonction permettant de vérifier si pour le fichier indiqué, l'élément existe bien.
	function verifSolo($parametre, $numero, $fichier){
			$donne = fopen($fichier, 'r+');

			for ($i=0;$i<sizeof(file($fichier));$i++){
				$ligne = fgets($donne);
				if ($ligne != "") {
					$lignes = substr($ligne, 0,-1);
					$tableau = explode(";", $lignes);

					if ($parametre == $tableau[$numero]){
						$continue = true;
						break;
					}else{
						$continue = false;
					}
				}
			}

			fclose($donne);
			return $continue;
	}

	
	//Fonction permettant de vérifier si deux éléments ne sont pas en double
	//On compare un paramètre (en POST par exemple) avec l'élément voulu dans le fichier.
	function double($parametre, $numero, $fichier){
		$donne = fopen($fichier, 'r+');

		while(!feof($donne)){
			$ligne = fgets($donne);
			if ($ligne != "") {
				$lignes = substr($ligne, 0,-2);
				$tableau = explode(";", $lignes);

				if ($parametre == $tableau[$numero]){
					$continue = false;
					break;
				}else{
					$continue = true;
				}
			}
		}

			fclose($donne);
			return $continue;
	}


	//Fonction permettant de renvoyer le fichier JSON concernant les filières
	//Utilisé pour les pages utilisant la liste de menu déroulante pour les filières et les groupes.
	function jsonText(){
		$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/fichiers/filiere.json');
		return $jsonText;
	}

	//Fonction permettant d'initialiser une liste de menu déroulant pour toutes les filières du fichier JSON des filières.
	function filiereJSON($nameFiliere, $nameGroupe){
		$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/fichiers/filiere.json');
		$jsonArray = json_decode($jsonText,True);

		echo("<select name=\"$nameFiliere\" id=\"select-filiere\" class=\"select-filiere\" onchange=\"liste_groupe();\">");
		echo"<option>Filière</option>";
		for ($i=0; $i <= sizeof($jsonArray["listeFilieres"]) -1; $i++){
			echo"<option>".$jsonArray["listeFilieres"][$i]["nomFiliere"]."</option>";
		}
		echo("</select>");

		echo("<select name=\"$nameGroupe\" id=\"select-groupe\" class=\"select-groupe\">");
			echo("<option value=\"Groupe\">Groupe</option>");
		echo("</select>");
	}


?>