<?php
session_start();

function genererChaineAleatoire($longueur = 10){
	 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 $longueurMax = strlen($caracteres);
	 $chaineAleatoire = '';
	 for ($i = 0; $i < $longueur; $i++)
	 {
	 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
	 }
	 return $chaineAleatoire;
}

function CleLogReussi($evenement, $evenement1){
	$fichier = 'fichiers/log.csv';
	$time = date("D, d M Y H:i:s");
	$time = "[".$time."]";
	$evenement = $time. ";" ."clé_obtenue".";". $evenement .";" .$evenement1."\n";

	file_put_contents($fichier, $evenement, FILE_APPEND);
}

function verifCle(){
	/*$donnes = fopen('fichiers/cle.csv', 'r+');

	for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
	 	$ligne = fgets($donnes);
	 	$lignes = substr($ligne, 0,-1);
		$tableau = explode(";", $lignes);

		if ($_GET['key-mail'] == $tableau[0] && $_GET['key-pwd'] == $tableau[2]) {
			$do = true;
		}else{
			$do = false;
		}
	}
	fclose($donnes);*/

	//if ($do == true) {
		$donne = fopen('fichiers/cle.csv', 'r+');
		$_SESSION["mail"] = $_GET['key-mail'];
		$mot_de_passe = $_GET['key-pwd'];

		while(!feof($donne)){
			$ligne = fgets($donne);
			if ($ligne != "") {
				$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);

				if ($_GET['key-mail'] == $tableau[0] && hash("sha256",$mot_de_passe) == $tableau[2]){
					$continue = true;
					break;
				}else{
					$continue = false;
				}
			}
		}

		fclose($donne);

		if ($continue == false){
			header("location:./documentation.php?error=0");
		}else{
			header("location:./documentation.php?error=1");
		}
	/*}else{
		header("location:./documentation.php?error=2");
	}*/
}

function inserCle(){
	$donne = fopen('fichiers/cle.csv', 'r+');

	while(!feof($donne)){
		$ligne = fgets($donne);
		if ($ligne != "") {
			$lignes = substr($ligne, 0,-2);
			$tableau = explode(";", $lignes);

			if ($_GET['mail'] == $tableau[0]){
				$fin = false;
				break;
			}else{
				$fin = true;
			}
		}
	}

	if ($fin == true){

		$mail = $_GET['mail'];
		$password = $_GET['pwd'];
		$cle = genererChaineAleatoire(20);

		//Vérifie si le formulaire a bien été rempli
		if (isset($mail) && isset($password)){

			$donnes = fopen('fichiers/cle.csv', 'a+');
			
			//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie un ID
			$strinfos = $_GET['mail'] . ";" . $cle . ";" .hash("sha256",$password) ."\n";
			fputs($donnes, $strinfos);

			fclose($donnes);
			CleLogReussi($mail, $cle);

			header("location:./documentation.php?error=6");

		}elseif($_GET['pwd'] != $_GET['pwd1']){
			//Si il y a une erreur alors il est redirigé vers l'accueil
			header("location:./documentation.php?error=3");
		}elseif($_POST["pwd"]<5 || $_POST["pwd1"]<5){
			header("location:./documentation.php?error=4");
		}
	}else{
		header("location:./documentation.php?error=5");
	}
}

if ($_GET['choose'] == "inscription"){
	inserCle();
}elseif ($_GET['choose'] == "connexion") {
	verifCle();
}else{
	echo"error";
}
//inserCle();
//verifCle();





?>

