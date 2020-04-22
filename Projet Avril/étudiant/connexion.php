<?php
	session_start();

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
				//Redirige ensuite vers l'accueil
				header("location:./redirection.php");
				exit();
			}elseif ($i == sizeof(file("fichiers/comptes.csv"))-1){
				header("location:./redirection.php?error=2");
				exit();
			}
	
		}

	}else{
		//Si les éléments ne sont pas remplies: redirection avec une erreur
		header("location:./redirection.php?error=1");
		echo "Veuillez rentrez des champs !";
		exit();
	}

?>