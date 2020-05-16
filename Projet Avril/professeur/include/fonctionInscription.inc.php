<?php
	
	 //Fonction permettant d'afficher un formulaire d'inscription
	function formulaireInscription(){

		echo("<p class=\"p-inscription\">Inscription</p>");
		echo("<div class=\"wrapper\">");
			echo("<div class=\"contact-form\">");
				echo("<form action=\"inscription.php\" method=\"post\">");
					echo("<div class=\"input-fields\">");
						echo("<input class=\"input\" type=\"text\" name=\"nom\" minlength=\"3\" placeholder=\"Nom\" required=\"required\" />");
						echo("<input class=\"input\" type=\"text\" name=\"prenom\" minlength=\"3\" placeholder=\"Prénom\" required=\"required\" />") ;
						echo("<input class=\"input\" type=\"email\" name=\"mail\" minlength=\"6\" placeholder=\"****@****.fr\" required=\"required\" />");
						echo("<input class=\"input\" type=\"text\" name=\"numero\" minlength=\"10\" maxlength=\"10\" placeholder=\"Numéro de téléphone\" required=\"required\" />");
						echo("<input class=\"input\" type=\"password\" name=\"mdp\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"required\" />");
						echo("<input class=\"input\" type=\"password\" name=\"mdp1\" minlength=\"6\" placeholder=\"Confirmation\" required=\"required\" />");

						echo("<div class=\"boxe\">");
							echo("<input class=\"button\" type=\"submit\" value=\"Valider\" />");
						echo("</div>");

					echo("</div>");
				echo("</form>");

			echo("</div>");
		echo("</div>");

	}

	//Fonction créant un caractère aléatoire pour l'ajouter  au mot de passe.
	function alea() {
	    $chn = '';
	    for ($i=1;$i<=6;$i++){
	        $chn .= chr(floor(rand(0, 25)+97));
	        return $chn;
	    }
    }


	//Fonction permettant de vérifier toutes les informations lors de l'inscription
	//Si tout est valide, alors écriture dans le fichier des comptes.

	function inscription1($nom, $prenom, $mail, $numero, $mdp , $mdp1, $fichier, $fichierID,$pageRenvoie, $pageErreur){

		verifSession($nom,"redirection.php?error=1");
		verifSession($prenom, "redirection.php?error=1");
		verifSession($mail, "redirection.php?error=1");
		verifSession($numero, "redirection.php?error=1");
		verifSession($mdp, "redirection.php?error=1");
		verifSession($mdp1, "redirection.php?error=1");

		$continue = double($mail, "3", $fichier);
		$suite = double($numero, "4", $fichier);
		$longueur = longueur($mdp);
		$longueur2 = longueur($mdp1);

		$regexNom = Regex('#[a-zA-Z]+[^;|]#',$nom);
		$regexPrenom = Regex('#[a-zA-Z]+[^;|]#', $prenom);
		$regexMail = Regex("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mail);
		$regexNumero = Regex("#[0-9]{10}#", $numero);
		$regexMdp = Regex('#[a-zA-Z0-9]+[^;|]#', $mdp);

		$regexNomPv= Regex("/^[^;]*$/", $nom);
		$regexPrenomPv = Regex("/^[^;]*$/", $prenom);
		$regexMdpPv = Regex("/^[^;]*$/", $mdp);
		$regexMailPv = Regex("/^[^;]*$/", $mail);

		if($continue == true && $suite == true){
			if($longueur == true && $longueur2 == true){
				if($mdp == $mdp1){
					if($regexNumero == true){
						if($regexNom == true && $regexPrenom == true && $regexNomPv == true && $regexPrenomPv == true){
							if($regexMail == true && $regexMailPv == true){
								if($regexMdp == true && $regexMdpPv == true){
									$car_alea = alea();
									$secure_mot_de_passe = $car_alea . $mdp;

									$donnes = fopen($fichier, 'a+');
									$monfichier = fopen($fichierID, 'r+');

									$id = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
									$id += 1; // On augmente de 1 ce nombre de pages vues
									fseek($monfichier, 0); // On remet le curseur au début du fichier
									fputs($monfichier, $id); // On écrit le nouveau nombre de pages vues

									fputs($donnes, $id . ";" . $nom . ";" . $prenom . ";" . $mail . ";" . $numero . ";" . $car_alea . ";" .hash("sha256",$secure_mot_de_passe) ."\n");

									fclose($monfichier);
									fclose($donnes);

									FichierLog("inscription réussi",$_POST["mail"]);
									header("location:./$page?error=0");
								}else{
									FichierLog("inscription échoué (mauvaise syntaxe mot de passe)",$mail);
									header("location:./$pageErreur?error=10");
								}
							}else{
								FichierLog("inscription échoué (mauvaise syntaxe mail)",$mail);
								header("location:./$pageErreur?error=9");
							}
						}else{
							FichierLog("inscription échoué (mauvaise syntaxe nom)",$mail);
							header("location:./$pageErreur?error=8");
						}
						
					}else{
						FichierLog("inscription échoué (mauvaise syntaxe numéro)",$mail);
						header("location:./$pageErreur?error=7");
					}

				}else{
					FichierLog("inscription échoué (mots de passe différents)",$mail);
					header("location:./$pageErreur?error=3");
				}
				
			}else{
				FichierLog("inscription échoué (mot de passe trop petit)",$mail);
				header("location:./$pageErreur?error=4");
			}
		}else{
			FichierLog("inscription échoué (mail ou numéro déjà utilisé)",$mail);
			header("location:./$pageErreur?error=5");
		}

	}

	//Fonction qui renvoie les différentes erreurs en cas de problèmes d'inscription sur la page "index.php"
	function errorInscription(){

		error("0", "Inscription réussi !");
		error("3", "Les mots de passes ne sont pas identiques !");
		error("4", "Les mots de passes doivent être de 6 caractères minimum !");
		error("5", "L'adresse mail ou le numéro est déjà utilisé !");
		error("6", "Filière ou groupe manquant !");
		error("7", "La syntaxe du numéro est incorrect !");
		error("8", "La syntaxe du nom est incorrect !");
		error("9", "La syntaxe du mail est incorrect !");
		error("10", "La syntaxe du mot de passe est incorrect !");
	}



?>