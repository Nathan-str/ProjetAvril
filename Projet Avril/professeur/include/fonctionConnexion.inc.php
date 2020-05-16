<?php
	//Fonction permettant d'afficher le formulaire de connexion (utilisable sur les deux sites).
	function formulaireConnexion(){
		echo("<p class=\"p-connexion\">Connexion</p>");
		echo("<div class=\"wrappers\">");
			echo("<div class=\"contact-form\">");
				echo("<form action=\"connexion.php\" method=\"post\">");
					echo("<div class=\"input-fields\">");
						echo("<input class=\"input\" type=\"email\" name=\"login\" minlength=\"6\" placeholder=\"Adresse Mail\" required=\"\" />");
						echo("<input class=\"input\" type=\"password\" name=\"pwd\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"\" />");

						echo("<div class=\"boxes\">");
							echo("<input class=\"button\" type=\"submit\" value=\"Valider\" />");
						echo("</div>");

					echo("</div>");
				echo("</form>");
			echo("</div>");
		echo("</div>");
	}

	//Fonction permettant de vérifier les informations pour la connexion
	//Renvoie sur la page des comptes si tout est valide.
	function connexion1($mail, $mdp, $fichier,$pageRenvoie, $pageErreur){
		verifSession($mail,"$pageErreur?error=1");//Vérifie l'existance du premier paramètre, si = false, redirection.
		verifSession($mdp, "$pageErreur?error=1");//Vérifie l'existance du premier paramètre, si = false, redirection.

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

	//Message d'erreur pour les redirections indiquées
	function errorConnexion(){

		error("2", "Mauvais identifiants!");
		error("1", "Veuillez entrez des champs !");

	}

?>