<?php
	session_start();

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

	function connexionLogReussi($evenement){
		$fichier = 'fichiers/log.csv';
		$time = date("D, d M Y H:i:s");
	    $time = "[".$time."]";
	    $evenement = $time. ";" ."connexion_réussi".";".$evenement."\n";

	    file_put_contents($fichier, $evenement, FILE_APPEND);
	}

	function connexionLogEchec($evenement){
		$fichier = 'fichiers/log.csv';
		$time = date("D, d M Y H:i:s");
	    $time = "[".$time."]";
	    $evenement = $time. ";" ."connexion_echec".";".$evenement."\n";

	    file_put_contents($fichier, $evenement, FILE_APPEND);
	}


	//Vérifie le remplissage du formulaire
	if (isset($_POST["login"]) && isset($_POST['pwd']) && !empty($_POST["login"]) && !empty($_POST["pwd"])){

		$donnes = fopen('fichiers/comptes.csv', 'r+');


		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 			$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);
			$car_alea = $tableau[5];
			$mot_de_passe = $_POST['pwd'];
			$secure_mot_de_passe = $car_alea . $mot_de_passe;

			if ($_POST["login"] == $tableau[3] && hash("sha256", $secure_mot_de_passe) == $tableau[6]) {
				//Création des sessions "noms"
				$_SESSION['pseudo'] = $_POST['login'];
				$_SESSION['id'] = $tableau[0];
				stastitiques();
				//Redirige ensuite vers l'accueil
				connexionLogReussi($tableau[3]);
				header("location:./informations.php");
				exit();
			}elseif ($i == sizeof(file("fichiers/comptes.csv"))-1){
				connexionLogEchec($tableau[3]);
				header("location:./redirection.php?error=2");
				exit();
			}
	
		}

	}else{
		//Si les éléments ne sont pas remplies: redirection avec une erreur
		connexionLogEchec("vide");
		header("location:./redirection.php?error=1");
		echo "Veuillez rentrez des champs !";
		exit();
	}

?>