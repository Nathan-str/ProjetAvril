<?php
	session_start();

	include 'fonction.php';



	$fin = verification($_POST['mail'], $_POST['numero'] , 'fichiers/comptes.csv');

	if ($fin == true){

		$nom = $_POST['nom'];
		$mot_de_passe = $_POST['mdp'];
		$car_alea = alea();
		$secure_mot_de_passe = $car_alea . $mot_de_passe;

		//Vérifie si le formulaire a bien été rempli
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['mdp1']) && isset($_POST['filiere']) && !empty($_POST["nom"]) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp1']) && $_POST['mdp'] == $_POST['mdp1'] && !empty($_POST['filiere'])){

			$donnes = fopen('fichiers/comptes.csv', 'a+');
			$monfichier = fopen('fichiers/id.txt', 'r+');
		 	//Ouverture du fichier contenant le nombre de visiteurs
			$id = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
			$id += 1; // On augmente de 1 ce nombre de pages vues
			fseek($monfichier, 0); // On remet le curseur au début du fichier
			fputs($monfichier, $id); // On écrit le nouveau nombre de pages vues
			

			//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie un ID
			fputs($donnes, $id . ";" . $_POST['nom'] . ";" . $_POST["prenom"] . ";" . $_POST["mail"] . ";" . $_POST["numero"] . ";" . $car_alea . ";" .hash("sha256",$secure_mot_de_passe) . ";" . $_POST['filiere'] . ";" . $_POST['groupe'] . ";" . "profil_defaut.png" ."\n");

			fclose($monfichier);
			fclose($donnes);

			FichierLog("inscription réussi",$_POST["mail"]);
			header("location:./redirection.php?error=0");

		}elseif($_POST["mdp"] != $_POST["mdp1"]){
			//Si il y a une erreur alors il est redirigé vers l'accueil
			FichierLog("inscription échoué",$_POST["mail"]);
			header("location:./redirection.php?error=3");
		}elseif($_POST["mdp"]<5 || $_POST["mdp1"]<5){
			FichierLog("inscription échoué",$_POST["mail"]);
			header("location:./redirection.php?error=4");
		}
	}elseif ($continue == false){
		FichierLog("inscription échoué",$_POST["mail"]);
		header("location:./redirection.php?error=5");
	}
?>
