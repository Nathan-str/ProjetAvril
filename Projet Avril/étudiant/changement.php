<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionInscription.inc.php';


//$fin = verification($_POST['new-mail'], $_POST['new-numero'] , 'fichiers/comptes.csv');

$continue = double($_POST['new-mail'], "3", 'fichiers/comptes.csv');
$suite = double($_POST['new-numero'], "4", 'fichiers/comptes.csv');

	
if ($continue == true && $suite == true){

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

		$longueurMdp = longueur($post_password);

		$regexNom = Regex('#[a-zA-Z]+[^;|]#',$_POST['new-nom']);
		$regexPrenom = Regex('#[a-zA-Z]+[^;|]#', $_POST['new-prenom']);
		$regexNumero = Regex("#[0-9]{10}#", $_POST['new-numero']);
		$regexMail = Regex("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $_POST['new-mail']);

		$regexNomPv = Regex("/^[^;]*$/", $_POST['new-nom']);
		$regexPrenomPv = Regex("/^[^;]*$/", $_POST['new-prenom']);
		$regexMailPv = Regex("/^[^;]*$/", $_POST['new-mail']);


			if ($_SESSION['id'] == $tableau[0]){

				if (!empty($_POST['new-mail']) && $regexMail == true && $regexMailPv == true) {
					$mail = $_POST['new-mail'];
					$_SESSION['pseudo'] = $_POST['new-mail'];
				}elseif ($regexMailPv == false || $regexMail == false) {
					$mail = $tableau[3];
					header("location:./informations.php?error=rmail");
				}else{
					$mail = $tableau[3];
				}

				if (!empty($_POST['new-nom']) && $regexNom == true && $regexNomPv == true) {
					$nom = $_POST['new-nom'];
				}elseif ($regexNom == false || $regexNomPv == false) {
					$nom = $tableau[1];
					header("location:./informations.php?error=rnom");
				}else{
					$nom = $tableau[1];
				}

				if (!empty($_POST['new-prenom']) && $regexPrenom == true && $regexPrenomPv == true) {
					$prenom = $_POST['new-prenom'];
				}elseif ($regexPrenom == false || $regexPrenomPv == false) {
					$prenom = $tableau[2];
					header("location:./informations.php?error=rprenom");
				}else{
					$prenom = $tableau[2];
				}

				if (!empty($_POST['new-numero']) && $regexNumero == true) {
					$numero = $_POST['new-numero'];
				}elseif ($regexNumero == false) {
					$numero = $tableau[4];
					header("location:./informations.php?error=rnumero");
				}else{
					$numero = $tableau[4];
				}

				if (!empty($_POST['new-mdp']) && $longueurMdp == true) {
					$mdp = $password;
				}elseif ($longueurMdp == false){
					$mdp = $tableau[6];
					header("location:./informations.php?error=lmdp");
				}else{
					$mdp = $tableau[6];
				}

				if (!empty($_POST['new-filiere']) && $_POST['new-filiere'] != "Filière" && $_POST['new-groupe'] != "Groupe" && $_POST['new-groupe'] != "") {
					$filiere = $_POST['new-filiere'];
				}else{
					$filiere = $tableau[7];
				}

				if (!empty($_POST['new-groupe']) && $_POST['new-groupe'] != "Groupe" && $_POST['new-groupe'] != "") {
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