<?php
	session_start();

	include 'include/fonction.php';
	include 'include/fonctionInscription.inc.php';


	function inscription2($nom, $prenom, $mail, $numero, $mdp , $mdp1, $fichier, $fichierID,$pageRenvoie, $pageErreur){

		//Vérifie si les éléments sont bien rentrés par le formulaire.
		verifSession($nom,"redirection.php?error=1");
		verifSession($prenom, "redirection.php?error=1");
		verifSession($mail, "redirection.php?error=1");
		verifSession($numero, "redirection.php?error=1");
		verifSession($mdp, "redirection.php?error=1");
		verifSession($mdp1, "redirection.php?error=1");

		//Vérification des doublons et des longueurs de mot de passes.
		$continue = double($mail, "3", $fichier);
		$suite = double($numero, "4", $fichier);
		$longueur = longueur($mdp);
		$longueur2 = longueur($mdp1);

		//Toutes les vérification pour le Regex
		$regexNom = Regex('#[a-zA-Z]#',$nom);
		$regexPrenom = Regex('#[a-zA-Z]#', $prenom);
		$regexMail = Regex("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mail);
		$regexNumero = Regex("#[0-9]{10}#", $numero);
		$regexMdp = Regex('#[a-zA-Z0-9]#', $mdp);

		$regexNomPv= Regex("/^[^;]*$/", $nom);
		$regexPrenomPv = Regex("/^[^;]*$/", $prenom);
		$regexMdpPv = Regex("/^[^;]*$/", $mdp);
		$regexMailPv = Regex("/^[^;]*$/", $mail);

		//Multiple vérification.
		if($continue == true && $suite == true){
			if($longueur == true && $longueur2 == true){
				if($mdp == $mdp1){
					if($_POST['groupe'] != "Groupe" && $_POST['filiere'] != "Filière" && $_POST['groupe'] != ""){
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

										fputs($donnes, $id . ";" . $nom . ";" . $prenom . ";" . $mail . ";" . $numero . ";" . $car_alea . ";" .hash("sha256",$secure_mot_de_passe) . ";" . $_POST['filiere'] . ";" . $_POST['groupe'] . ";" . "profil_defaut.png" ."\n");

										fclose($monfichier);
										fclose($donnes);

										FichierLog("inscription réussi",$_POST["mail"]);
										header("location:./$pageErreur?error=0");

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
						FichierLog("inscription échoué (echec choix filiere/groupe)",$mail);
						header("location:./$pageErreur?error=6");
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


	inscription2($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["numero"], $_POST["mdp"] , $_POST["mdp1"], 'fichiers/comptes.csv', "fichiers/id.txt","informations.php", "redirection.php");
?>
