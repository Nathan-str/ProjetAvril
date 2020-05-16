<?php
	
	//Fonction renvoyant les différents messages en fonctions des erreurs.
	function errorConnexionCle(){

		if(isset($_GET['error'])){
			if($_GET['error'] == 0){ //0: GET définie dans la page vérifiant les identifiants 
			?>
			<script type="text/javascript">
				alert("Mauvais identifiants!")
			</script>
			<?php
			}elseif ($_GET['error'] == 1) { //1: GET définie dans la page vérifiant les identifiants
				$donnes = fopen('fichiers/cle.csv', 'r+');

				for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
	 				$ligne = fgets($donnes);
					$tableau = explode(";", $ligne);
		
					//Renvoie un message contenant la clé.
					if ($_SESSION['mail'] == $tableau[0]){
						echo("<p>Votre clé API: " . $tableau[1] ."</p>");
						echo("<p>Utilisation: ". $tableau[4] . "/200<br />");
						if ($tableau[4] > 200) {
							echo("La clé n'est plus utilisable</p>");
						}else{
							echo("La clé est utilisable</p>");
						}
						
					}
				}
				fclose($donnes);
			}elseif ($_GET['error'] == 3) {
			?>
			<script type="text/javascript">
				alert("Les mots de passes sont différents !");
			</script>
			<?php
			}elseif ($_GET['error'] == 6) {
			?>
			<script type="text/javascript">
				alert("Clé créée !");
			</script>
			<?php
			}elseif ($_GET['error'] == 5) {
			?>
			<script type="text/javascript">
				alert("L'adresse mail existe déjà !");
			</script>
			<?php
			}else if ($_GET['error'] == 4) {
			?>
			<script type="text/javascript">
				alert("Il manque des champs !");
			</script>
			<?php
			}
		}
	}


	//Fonction permettant de créer une chaine de caractères aléatoire qui sera la clé d'API
	//Fonction utilisé sur la page "cle.php"
	function genererChaineAleatoire($longueur){
		 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		 $longueurMax = strlen($caracteres);
		 $chaineAleatoire = '';
		 for ($i = 0; $i < $longueur; $i++)
		 {
		 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
		 }
		 return $chaineAleatoire;
	}


	//Fonction permettant de vérifier si la mail existe et est lié à une clé
	//Si oui, alors fais une redirection pour afficher la clé.
	function verifCle(){

		$mdp = $_GET['key-pwd'];
		$mail = $_GET['key-mail'];

		verifSession($mail,"documentation.php?error=0");
		verifSession($mdp, "documentation.php?error=0");
		$longueur = longueur($mdp);

		$donnes = fopen("./fichiers/cle.csv", 'r+');
			
		for ($i=0;$i<sizeof(file("./fichiers/cle.csv"));$i++){
		 	$ligne = fgets($donnes);
		 	$ligne = str_replace("\n", "", $ligne);
			$tableau = explode(";", $ligne);


			if($mail == $tableau[0]){

				$hash = hash("sha256", $mdp);


				$valider_mail = verifSolo($mail, 0, "./fichiers/cle.csv");
				$valider_mdp = verifMdp($mail,0,$hash, 2, "./fichiers/cle.csv");

				//tester avec la fonction
				if ($valider_mdp == true){

					if($longueur == true){
				
						$_SESSION['mail'] = $_GET['key-mail'];
						//echo("ça marche");
						header("location:./documentation.php?error=1");
						exit();
					}else{
						//echo("trop court");
						header("location:./documentation.php?error=0");
					}
				}else{
					//echo("mdp error");
					header("location:./documentation.php?error=0");
				}
					
			}elseif ($i == sizeof(file("./fichiers/cle.csv"))-1){
				//echo("error mail");
				header("location:./documentation.php?error=0");
				exit();
			}
		}

	}


	//Fonction permettant de vérifier si le mail n'est pas en double
	//Si tout est valide, alors écrit une chaine de caractère pour la clé.
	function inserCle(){
		
		$fin = double($_GET['mail'], "0", 'fichiers/cle.csv');

		if ($fin == true){

			$mail = $_GET['mail'];
			$password = $_GET['pwd'];
			$password1 = $_GET['pwd1'];
			$cleAPI = genererChaineAleatoire(20);

			$longueur = longueur($password);

			$regexMail = Regex("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mail);
			$regexMailPv = Regex("/^[^;]*$/", $mail);

			verifSession($mail, "documentation.php?error=5");
			$valideMdp = verifSession($password, "documentation.php?error=5");

			//Vérifie si le formulaire a bien été rempli
			if ($password == $password1 && !empty($password) && $regexMail == true && $regexMailPv == true){

				$donnes = fopen('fichiers/cle.csv', 'a+');
				
				//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie une date et un compteur
				$strinfos = $_GET['mail'] . ";" . $cleAPI . ";" .hash("sha256",$password) . ";" . date(h) . ";" . "0" ."\n";
				fputs($donnes, $strinfos);

				fclose($donnes);
				FichierLog("Clé distribué", $mail);

				header("location:./documentation.php?error=6");

			}elseif($_GET['pwd'] != $_GET['pwd1']){
				//Si il y a une erreur alors il est redirigé vers l'accueil
				FichierLog("Echec clé", $mail);
				header("location:./documentation.php?error=3");
			}elseif(strlen($password)<5 || strlen($password1)<5){
				FichierLog("Echec clé", $mail);
				header("location:./documentation.php?error=4");
			}
		}else{
			FichierLog("Echec clé", $mail);
			header("location:./documentation.php?error=5");
		}
	}

	//Regarde les conditions dans le fichier CSV des clé
	//Reprend le compteur à 0, si c'est une nouvelle heure.
	function compteurCle(){
		$donnes = fopen('fichiers/cle.csv', 'r+');
		$informations = array();

		for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
		 		$ligne = fgets($donnes);
		 		$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				$temps_actuel = time();
				$temps = date('h',$temps_actuel);

				if ($_GET['cle'] == $tableau[1]){
					if ($temps == $tableau[3]) {//Compare l'heure actuelle avec l'heure dans le fichier
						$cpt = $tableau[4] + 1;//Ajoute plus 1 au compteur si les heures sont identiques.
						$time = $tableau[3];
					}else{
						$time = $temps;
						$cpt = 1;
					}	
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $time . ";" . $cpt;
					array_push($informations, $strinformations);
				}else{
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4];
					array_push($informations, $strinformations);
				}
		}

		fclose($donnes);
		$donnes = fopen('fichiers/cle.csv', 'w');

		for ($i=0;$i<sizeof($informations);$i++){
			fputs($donnes, $informations[$i] . "\n");
		}
		fclose($donnes);
	}





?>