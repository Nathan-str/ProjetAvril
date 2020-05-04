<?php
	function formulaireConnexion(){
		echo("<form action=\"connexion.php\" method=\"post\">");
			echo("<input class=\"input\" type=\"email\" name=\"login\" minlength=\"6\" placeholder=\"Adresse Mail\" required=\"\" />");
			echo("<input class=\"input\" type=\"password\" name=\"pwd\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"\" />");
			echo("<input class=\"connexion-submit\" type=\"submit\" value=\"Valider\" />");
		echo("</form>");
	}

	function connexion1($mail, $mdp, $fichier,$pageRenvoie, $pageErreur){
		verifSession($mail,"$pageErreur?error=1");
		verifSession($mdp, "$pageErreur?error=1");

		$donnes = fopen($fichier, 'r+');
			
		for ($i=0;$i<sizeof(file($fichier));$i++){
		 	$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);

			if($mail == $tableau[3]){

				$car_alea = $tableau[5];
				$mot_de_passe = $mdp;
				$secure_mot_de_passe = $car_alea . $mot_de_passe;
				$hash = hash("sha256", $secure_mot_de_passe);

				$valider_mail = verifSolo($mail, "3", $fichier);
				$valider_mdp = verifSolo($hash, "6", $fichier);

				if ($valider_mail == true && $valider_mdp == true){

					$_SESSION['pseudo'] = $mail;
					$_SESSION['id'] = $tableau[0];
					stastitiques();
					//Redirige ensuite vers l'accueil
					FichierLog("connexion réussi",$mail);
					header("location:./$pageRenvoie");
					exit();
				}else{
					header("location:./$pageErreur?error=2");
				}
					
			}elseif ($i == sizeof(file("$fichier"))-1){
				header("location:./$pageErreur?error=2");
				exit();
			}
		}
	}

	function errorConnexion(){

		error("2", "Mauvais identifiants!");
		error("1", "Veuillez entrez des champs !");

	}

?>