<?php
session_start();

include 'fonction.php';


$fin = verification($_POST['new-mail'], $_POST['new-numero'] , 'fichiers/comptes.csv');
	
if ($fin == true){

	$donnes = fopen('fichiers/comptes.csv', 'r+');
	$informations = array();

	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
 		$ligne = fgets($donnes);
 		$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $lignes);

		$post_password = $_POST["new-mdp"];
		$lettre = $tableau[5];
		$strpassword = $lettre . $post_password;
		$password = hash("sha256", $strpassword); 

			if ($_SESSION['id'] == $tableau[0]){

				if (!empty($_POST['new-mail'])) {
					$mail = $_POST['new-mail'];
					$_SESSION['mail'] = $_POST['new-mail'];
				}else{
					$mail = $tableau[3];
				}

				if (!empty($_POST['new-nom'])) {
					$nom = $_POST['new-nom'];
				}else{
					$nom = $tableau[1];
				}

				if (!empty($_POST['new-prenom'])) {
					$prenom = $_POST['new-prenom'];
				}else{
					$prenom = $tableau[2];
				}

				if (!empty($_POST['new-numero'])) {
					$numero = $_POST['new-numero'];
				}else{
					$numero = $tableau[4];
				}

				if (!empty($_POST['new-mdp'])) {
					$mdp = $password;
				}else{
					$mdp = $tableau[6];
				}

				if (!empty($_POST['new-filiere'])) {
					$filiere = $_POST['new-filiere'];
				}else{
					$filiere = $tableau[7];
				}

				if (!empty($_POST['new-groupe'])) {
					$groupe = $_POST['new-groupe'];
				}else{
					$groupe = $tableau[8];
				}

			$strinformations = $tableau[0] . ";" . $nom . ";" . $prenom . ";" . $mail . ";" . $numero . ";" . $tableau[5] . ";" . $mdp . ";" . $filiere . ";" . $groupe . ";" . $tableau[9];
			array_push($informations, $strinformations);
		}else{
			$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4] . ";" . $tableau[5] . ";" . $tableau[6] . ";" . $tableau[7] . ";" . $tableau[8] . ";" . $tableau[9];
			array_push($informations, $strinformations);
		}

	}



	fclose($donnes);

	//Etape 2: Ecriture dans le fichier du nouveau comptes.csv

	$donnes = fopen('fichiers/comptes.csv', 'w');

		for ($i=0;$i<sizeof($informations);$i++){
			fputs($donnes, $informations[$i] . "\n");
		}
	fclose($donnes);
	header("location:./informations.php");

}else{
	header("location:./informations.php?error=2");
}


?>