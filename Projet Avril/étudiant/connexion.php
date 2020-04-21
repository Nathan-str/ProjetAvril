<?php
	session_start();

	//Vérifie le remplissage du formulaire
	if (isset($_POST["login"]) && isset($_POST['pwd']) && !empty($_POST["login"]) && !empty($_POST["pwd"])){

		$donnes = fopen('fichiers/comptes.csv', 'r+');


		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 			$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);

			if ($_POST["login"] == $tableau[2] && hash("sha256", $_POST['pwd']) == $tableau[4]) {
				//Création des sessions "noms"
				$_SESSION['pseudo'] = $_POST['login'];
				
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