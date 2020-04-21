<?php
	session_start();

	$nom = $_POST['nom'];

	//Vérifie si le formulaire a bien été rempli
	if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['mdp1']) && !empty($_POST["nom"]) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp1']) && $_POST['mdp'] == $_POST['mdp1']){
		$donnes = fopen('fichiers/comptes.csv', 'a+');

		//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie un ID
		fputs($donnes, $_POST['nom'] . ";" . $_POST["prenom"] . ";" . $_POST["mail"] . ";" . $_POST["numero"] . ";" . hash("sha256",$_POST['mdp']) . ";" . $_POST['filiere'] . ";" . $_POST['groupe'] . "\n");

		fclose($donnes);

		header("location:./redirection.php");

	}elseif($_POST["mdp"] != $_POST["mdp1"]){
		//Si il y a une erreur alors il est redirigé vers l'accueil
		header("location:./redirection.php?error=3");
	}elseif($_POST["mdp"]<5 || $_POST["mdp1"]<5){
		header("location:./redirection.php?error=4");
	}
?>
