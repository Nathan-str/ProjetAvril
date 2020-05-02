<?php


	//Fonction pour la page "redirection.php"

	//Fonction qui renvoie les différentes erreurs en cas de problèmes d'inscription sur la page "redirection.php"
	function errorInscription(){

		if(isset($_GET['error'])){
		if($_GET['error'] == 3){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("Les mots de passes ne sont pas identiques !");
		</script>
		<?php
		}elseif($_GET['error'] == 4){
		?>
		<script type="text/javascript">
			alert("Les mots de passes doivent être de 6 caractères minimum!");
		</script>
		<?php
		}elseif($_GET['error'] == 5){
		?>
		<script type="text/javascript">
			alert("L'adresse mail ou le numéro est déjà utilisé!");
		</script>
		<?php
			}elseif ($_GET['error'] == 0) {
		?>
		<script type="text/javascript">
			alert("Inscription réussie!");
		</script>
		<?php
			}
		}
	}

	//Fonction qui renvoie les messages d'erreurs en cas de problème de connexion sur la page  "redirection.php"

	function errorConnexion(){

		if(isset($_GET['error'])){
			if($_GET['error'] == 2){ //2: GET définie dans la page vérifiant les identifiants 
			?>
			<script type="text/javascript">
				alert("Mauvais identifiants !")
			</script>
			<?php
			}elseif ($_GET['error'] == 1) { //1: GET définie dans la page vérifiant les identifiants
			?>
			<script type="text/javascript">
				alert("Veuillez entrer des champs !")
			</script>
			<?php 			
			}
		}

	}




	//------------------------------------------------------------------
	//Fonction pour la page "inscription.php"

	//Fonction créant un caractère aléatoire, utile pour avoir un renforcement de sécurité de mot de passe lors de l'inscription.
	//Utilisé sur la page "inscription.php"

	function alea() {
	    $chn = '';
	    for ($i=1;$i<=6;$i++){
	        $chn .= chr(floor(rand(0, 25)+97));
	        return $chn;
	    }
    }

    //Fonction écrivant dans le fichier des logs, toutes les incriptions réussi
    function FichierLog($message,$evenement){
		$fichier = 'fichiers/log.csv';
		$time = date("D, d M Y H:i:s");
	    $time = "[".$time."]";
	    $evenement = $time. ";" .$message.";".$evenement."\n";

	    file_put_contents($fichier, $evenement, FILE_APPEND);
	}

	function formulaireInscription(){
		echo("<form action=\"inscription.php\" method=\"post\">");
			echo("<input class=\"input\" type=\"text\" name=\"nom\" minlength=\"3\" placeholder=\"Nom\" required=\"required\" />");
			echo("<input class=\"input\" type=\"text\" name=\"prenom\" minlength=\"3\" placeholder=\"Prénom\" required=\"required\" />") ;
			echo("<input class=\"input\" type=\"email\" name=\"mail\" minlength=\"6\" placeholder=\"****@****.fr\" required=\"required\" />");
			echo("<input class=\"input\" type=\"text\" name=\"numero\" minlength=\"10\" maxlength=\"10\" placeholder=\"Numéro de téléphone\" required=\"required\" />");
			echo("<input class=\"input\" type=\"password\" name=\"mdp\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"required\" />");
			echo("<input class=\"input\" type=\"password\" name=\"mdp1\" minlength=\"6\" placeholder=\"Confirmation mot de passe\" required=\"required\" />");
			echo("<input class=\"submit\" type=\"submit\" value=\"Valider\" />");
		echo("</form>");
	}

	/*function inscription($fichier, $fichierID){
		$nom = $_POST['nom'];
		$mot_de_passe = $_POST['mdp'];
		$car_alea = alea();
		$secure_mot_de_passe = $car_alea . $mot_de_passe;

		//Vérifie si le formulaire a bien été rempli
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['mdp1']) && !empty($_POST["nom"]) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp1']) && $_POST['mdp'] == $_POST['mdp1']){

			$donnes = fopen($fichier, 'a+');
			$monfichier = fopen($fichierID, 'r+');
		 	//Ouverture du fichier contenant le nombre de visiteurs
			$id = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
			$id += 1; // On augmente de 1 ce nombre de pages vues
			fseek($monfichier, 0); // On remet le curseur au début du fichier
			fputs($monfichier, $id); // On écrit le nouveau nombre de pages vues
			

			//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie un ID
			fputs($donnes, $id . ";" . $_POST['nom'] . ";" . $_POST["prenom"] . ";" . $_POST["mail"] . ";" . $_POST["numero"] . ";" . $car_alea . ";" .hash("sha256",$secure_mot_de_passe) ."\n");

			fclose($monfichier);
			fclose($donnes);

			FichierLog("inscription réussi",$_POST["mail"]);
			header("location:./index.php?error=0");

		}elseif($_POST["mdp"] != $_POST["mdp1"]){
			//Si il y a une erreur alors il est redirigé vers l'accueil
			FichierLog("inscription échoué (mot de passe différent)",$_POST["mail"]);
			header("location:./index.php?error=3");
		}elseif($_POST["mdp"]<5 || $_POST["mdp1"]<5){
			FichierLog("inscription échoué (mot de passe trop petit)",$_POST["mail"]);
			header("location:./index.php?error=4");
		}
	}*/

	function longueur($mdp){
		if(strlen($mdp) >= 0){
			$continue = true;
		}else{
			$continue = false;
		}
		return $continue;
	}

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

		if($continue == true && $suite == true){
			if($longueur == true && $longueur2 == true){
				if($mdp == $mdp1){

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

	/*function verification($mail, $numero, $fichier){
		$donne = fopen($fichier, 'r+');

		while(!feof($donne)){
			$ligne = fgets($donne);
			if ($ligne != "") {
				$lignes = substr($ligne, 0,-2);
				$tableau = explode(";", $ligne);

				if($mail == $tableau[3] || $numero == $tableau[4]){
				  $fin = False;
				  break;
				}else{
				   $fin = True;
				}
			}		
		}
		return $fin;
		
	}*/


	//--------------------------------------------------------------------
	//Fonction pour la page "connexion.php"


	//Fonction écrivant toutes les connexions par heure (pas utilisé finalement)
	function stastitiques(){
		$dossier = fopen("fichiers/stats.log", "r");
		//Même processus mais pour chaque jour de la semaine
		$statistiques = array();

		while ($elements = fgets($dossier)) {
			$elements = explode(';', $elements);

			if ($elements[0] == strftime("%H", time())) { //%H correspond au heures de 00 à 23
				$valeur_element = $elements[1];
				$valeur_element +=1;
				$put_element = $elements[0] . ";" . $valeur_element . "\n";
			}else{
				$put_element = $elements[0] . ";" . $elements[1];
			}

			array_push($statistiques, $put_element);
		}

		$dossier = fopen("fichiers/stats.log", "w");

		for($i = 0; $i < sizeof($statistiques);$i++){
			fputs($dossier, $statistiques[$i]);
		}

		fclose($dossier);
	}


	function formulaireConnexion(){
		echo("<form action=\"connexion.php\" method=\"post\">");
			echo("<input class=\"input\" type=\"mail\" name=\"login\" minlength=\"6\" placeholder=\"Adresse Mail\" required=\"required\" />");
			echo("<input class=\"input\" type=\"password\" name=\"pwd\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"required\" />");
			echo("<input class=\"connexion-submit\" type=\"submit\" value=\"Valider\" />");
		echo("</form>");
	}

	/*function connexion($fichier, $pageRenvoie, $pageErreur){
		//Vérifie le remplissage du formulaire
		if (isset($_POST["login"]) && isset($_POST['pwd']) && !empty($_POST["login"]) && !empty($_POST["pwd"])){

			$donnes = fopen($fichier, 'r+');


			for ($i=0;$i<sizeof(file($fichier));$i++){
	 			$ligne = fgets($donnes);
	 			$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				$car_alea = $tableau[5];
				$mot_de_passe = $_POST['pwd'];
				$secure_mot_de_passe = $car_alea . $mot_de_passe;

				if ($_POST["login"] == $tableau[3] && hash("sha256", $secure_mot_de_passe) == $tableau[6]) {
					//Création des sessions "noms"
					$_SESSION['pseudo'] = $_POST['login'];
					$_SESSION['id'] = $tableau[0];
					stastitiques();
					//Redirige ensuite vers l'accueil
					FichierLog("connexion réussi",$tableau[3]);
					header("location:./$pageRenvoie");
					exit();
				}elseif ($i == sizeof(file("fichiers/comptes.csv"))-1){
					FichierLog("Connexion échoué (mauvais identifiants)",$tableau[3]);
					header("location:./$pageErreur?error=2");
					exit();
				}
		
			}

		}else{
			//Si les éléments ne sont pas remplies: redirection avec une erreur
			FichierLog("Connexion échoué","vide");
			header("location:./redirection.php?error=1");
			echo "Veuillez rentrez des champs !";
			exit();
		}
	}*/

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
				}else{
					header("location:./$pageErreur?error=2");
				}
					
			}else{
				header("location:./$pageErreur?error=2");
			}
		}
	}
	//----------------------------------------------------------

	function verifSession($session, $page){
		if(isset($session) && !empty($session)){
			$continue = true;
		}else{
			header("location:./" . $page);
		}
	}

	function verifElement($session){
		if(isset($session) && !empty($session)){
			$continue = true;
		}else{
			$continue = false;
		}
		return $continue;
	}

	//-----------------------------------------------------------
	//Fonction pour la page "informations.php"

	//Fonction écrivant toutes les infos de comptes pour le compte connecté, depuis le fichier "comptes.csv"
	//Fonction utilisé sur la page "informations.php"
	function comptes(){
		$donnes = fopen('fichiers/comptes.csv', 'r+');

		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 			$ligne = fgets($donnes);
				$tableau = explode(";", $ligne);

			if ($_SESSION['id'] == $tableau[0]){
				$prenom = $tableau[2];
				$nom = $tableau[1];
				$mail = $tableau[3];
				$numero = $tableau[4];
				$filiere = $tableau[7];
				$groupe = $tableau[8];	
			}
			
		}
		echo("<p class=\"p-info-prenom\">Prénom: " . $prenom."</p>");
		echo("<p class=\"p-info-nom\">Nom: " . $nom."</p>");
		echo("<p class=\"p-info-mail\">Adresse mail: " . $mail."</p>");
		echo("<p class=\"p-info-numero\">Numéro de téléphone: " . $numero . "</p>");
		echo("<p class=\"p-info-filiere\">Filière: " . $filiere . "</p>");
		echo("<p class=\"p-info-groupe\">Groupe: " . $groupe . "</p>");
	}


	//Fonction permettant de télécharger une image choisi dans le dossier d'images indiqué (ici celui du site)
	//Les images correspondant aux comptes ayant le même nom, écrase l'ancienne image
	//Fonction utilisé sur la page "informations.php"
	function upload(){
		if(isset($_POST['upload'])){

			$poids = filesize($_FILES['image']['tmp_name']);
			$nom_image = $_SESSION['id'] . ".png";
			if($_FILES['image']['error'] == 4 ){
				$nom_image = "profil_defaut.png";
			}
			$type_image = $_FILES['image']['type'];
			$taille_image = $_FILES['image']['size'];
			$image_tmp_name=$_FILES['image']['tmp_name'];
			$description = $_POST['desc'];


			if ($poids > (300 * 1024) ) {
				header("location:./informations.php?error=1");
			}else{
				move_uploaded_file($image_tmp_name, "images/$nom_image");
			}
			

			//$donnes = fopen('fichiers/images.csv', 'a+');

			$donnes = fopen('fichiers/comptes.csv', 'r+');
			$informations = array();
			for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
		 		$ligne = fgets($donnes);
		 		$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				if ($tableau[0] == $_SESSION['id']){
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4] . ";" . $tableau[5] . ";" . $tableau[6] . ";" . $tableau[7] . ";" . $tableau[8] . ";" . $nom_image;
					array_push($informations, $strinformations);
				}else{
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4] . ";" . $tableau[5] . ";" . $tableau[6] . ";" . $tableau[7] . ";" . $tableau[8] . ";" . $tableau[9];
					array_push($informations, $strinformations);
				}
			}
			fclose($donnes);

			$donnes = fopen('fichiers/comptes.csv', 'w');

			for ($i=0;$i<sizeof($informations);$i++){
				fputs($donnes, $informations[$i] . "\n");
			}
			fclose($donnes);
		}
	}

	//Fonction affichant l'image correspondant à l'utilisateur (par le nom de l'image étant l'ID)
	//Fonction utilisé pour la page "informations.php"
	function Pphoto(){
		
		$erreur = $_FILES['image']['error'];
		$donnes = fopen('fichiers/comptes.csv', 'r+');

		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);

			if ($tableau[0] == $_SESSION["id"]){
				$nom_image = $tableau[9];
			}
		}

		echo"<img src='images/$nom_image' width='170' height='170' class=\"pp\"><br>$description";
		
	}

	//Fonction permettant d'afficher un message d'erreur si le nouveau email indiqué ou le nouveau numéro indiqué existe déjà
	//Fonction utilisé sur la page "informations.php"
	function erreur(){
		if(isset($_GET['error'])){
			if($_GET['error'] == 2){ //2: GET définie dans la page vérifiant les identifiants 
			?>
			<script type="text/javascript">
				alert("L'email ou le numero existe déjà' !");
			</script>
			<?php
			}elseif ($_GET['error'] == 3) {
			?>
			<script type="text/javascript">
				alert("Le numéro existe déjà' !");
			</script>	
			<?php
			}
		}
	}



	//----------------------------------------
	//Fonction pour la page "apiEtu.php"



	//Fonction permettant d'afficher l'API pour la filière choisi pour tous les comptes étudiants 
	//Fonction utilisé pour la page "apiEtu.php"
	function filiere(){

		$donnes = fopen('fichiers/comptes.csv', 'r+');
		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
	 		$lignes = substr($ligne, 0,-1);
			$tableau = explode(";", $ligne);
			$filiere = $tableau[7];
			
			if ($_GET["filiere"] == $filiere){
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["nom"] = $tableau[1];
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["prenom"] = $tableau[2];
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["mail"] = $tableau[3];
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["numero"] = $tableau[4];
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["image"] = $tableau[9];
				$jsonArray["$filiere"]["$tableau[8]"]["$tableau[0]"]["id"] = $tableau[0];
			}
		}
		fclose($donnes);
		return $jsonArray;
	}


	//Fonction permettant d'afficher l'API pour la filière et le groupe choisi pour tous les comptes étudiants 
	//Fonction utilisé pour la page "apiEtu.php"
	function groupe($filiere, $groupe){

	    $donnes = fopen('fichiers/comptes.csv', 'r+');
		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
	 		$lignes = substr($ligne, 0,-1);
			$tableau = explode(";", $ligne);

			if($filiere == $tableau[7] && $groupe == $tableau[8]){
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["nom"] = $tableau[1];
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["prenom"] = $tableau[2];
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["mail"] = $tableau[3];
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["numero"] = $tableau[4];
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["image"] = $tableau[9];
				$jsonArray["$filiere"]["$groupe"]["$tableau[0]"]["id"] = $tableau[0];
			}

		}
		fclose($donnes);
		return $jsonArray;
	}



	//------------------------------------
	//Fonction pour la page "cle.php"


	//Fonction permettant d'afficher des messages d'erreurs si il y a eu un problème avec l'authentification de la clé d'API
	//Fonction utilisé sur la page "documentation.php"
	function errorConnexionCle(){

		if(isset($_GET['error'])){
			if($_GET['error'] == 0){ //2: GET définie dans la page vérifiant les identifiants 
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
		

					if ($_SESSION['mail'] == $tableau[0]){
						echo("<p>Votre clé API: " . $tableau[1] ."</p>");
						
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

	
	function verifSolo($parametre, $numero, $fichier){
			$donne = fopen($fichier, 'r+');

			for ($i=0;$i<sizeof(file($fichier));$i++){
				$ligne = fgets($donne);
				if ($ligne != "") {
					$lignes = substr($ligne, 0,-1);
					$tableau = explode(";", $lignes);

					if ($parametre == $tableau[$numero]){
						$continue = true;
						break;
					}else{
						$continue = false;
					}
				}
			}

			fclose($donne);
			return $continue;
	}

	
	//Fonction qui vérifie le formulaire et ses informations avec le fichier "cle.csv" contenant les adresses mails et les clés et renvoie la clé si tout est vérifié et que l'adresse mail et le mot de passe existent
	//Fonction utilisé sur la page "cle.php"
	function verifCle(){

		$continue = verifSolo($_GET['key-mail'], "0", 'fichiers/cle.csv');
		$suite = verifSolo(hash("sha256",$_GET['key-pwd']), "2", 'fichiers/cle.csv');

		if ($continue == true && $suite == true){
			$_SESSION['mail'] = $_GET['key-mail'];
			header("location:./documentation.php?error=1");
		}else{
			header("location:./documentation.php?error=0");
		}
		/*}else{
			header("location:./documentation.php?error=2");
		}*/
	}

	function double($parametre, $numero, $fichier){
		$donne = fopen($fichier, 'r+');

		while(!feof($donne)){
			$ligne = fgets($donne);
			if ($ligne != "") {
				$lignes = substr($ligne, 0,-2);
				$tableau = explode(";", $lignes);

				if ($parametre == $tableau[$numero]){
					$continue = false;
					break;
				}else{
					$continue = true;
				}
			}
		}

			fclose($donne);
			return $continue;
	}


	//Fonction permettant d'insérer dans le fichier "cle.csv" l'adresse mail et le mot de passe taper. Si ils n'existent psa déjà, alors écrit dans le fichier l'adresse mail, le mot de passe, la clé créer, l'heure de création et un compteur
	//Fonction utlisé sur la page "cle.php"
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
			if (!empty($mail) && !empty($password) && !empty($_GET['pwd1']) && $_GET['pwd1'] == $_GET['pwd']){

				$donnes = fopen('fichiers/cle.csv', 'a+');
				
				//Met les éléments du formulaire dans le fichier et hache le mot de passe et définie une date et un compteur
				$strinfos = $_GET['mail'] . ";" . $cle . ";" .hash("sha256",$password) . ";" . date(h) . ";" . "0" ."\n";
				fputs($donnes, $strinfos);

				fclose($donnes);
				FichierLog("Clé distribué", $mail);

				header("location:./documentation.php?error=6");

			}elseif($_GET['pwd'] != $_GET['pwd1']){
				//Si il y a une erreur alors il est redirigé vers l'accueil
				FichierLog("Echec clé", $mail);
				header("location:./documentation.php?error=3");
			}elseif($_POST["pwd"]<5 || $_POST["pwd1"]<5){
				FichierLog("Echec clé", $mail);
				header("location:./documentation.php?error=4");
			}
		}else{
			FichierLog("Echec clé", $mail);
			header("location:./documentation.php?error=5");
		}
	}

	function choix($get){
		if($get == "filiere"){
			$choix = true;
		}else{
			$choix = false;
		}
		return $choix;
		
	}

	//function affichageMosaique($json,$jsonNom,$jsonPrenom,$jsonMail,$jsonNumero,$jsonImage){		

	//}

	function cookieRecherche($filiere,$groupe,$choix){
		$recherche["filiere"] = $filiere;
		$recherche["groupe"] = $groupe;
		$recherche["choix"] = $choix;
		$jasonRecherche = json_encode($recherche);
		setcookie("recherche", $jasonRecherche);
	}


	function ChoixMosaïque($filiere,$groupe,$cle,$choix){

		$choose = choix($choix);
		$jsonArray = array();
		$cpt = 0;

		//if ($continue == true){

			

			if ($choose == true){

				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere='.$filiere.'&cle=' .$cle);
				$jsonArray = json_decode($jsonText,True);

				echo("<h1 class=en-tete-filiere>Elèves de la filière " . $filiere . ":</h1>");

				echo("<form>");
					echo("<input type=\"button\" class=\"impression-filiere\" value=\"Imprimer la page\" onClick=\"window.print()\">");
				echo("</form>");

				for ($i=1; $i <= sizeof($jsonArray["$filiere"]); $i++){

					$cpt += 1;

					echo("<div class=profil>");
					echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"][$i]['image'] . "width=200 height=200 style=border-radius:10px; alt=error class=image onclick=\"clickImage($i)\";><br />");
					echo "<p>".$jsonArray["$filiere"][$i]['prenom'] . " " . $jsonArray["$filiere"][$i]['nom'] . "</p><br />";
					echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"][$i]['mail'] . "<br />". $jsonArray["$filiere"][$i]['numero'] . "</p><br />";
					echo("</div>");	

				}

			}else{

				

				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
				$jsonArray = json_decode($jsonText,True);

				echo("<h1 class=en-tete-groupe>Elèves du groupe " . $groupe . " de la filière " . $filiere . ":</h1>");

				echo("<form>");
					echo("<input type=\"button\" class=\"impression-groupe\" value=\"Imprimer la page\" onClick=\"window.print()\">");
				echo("</form>");

				for ($i=1; $i <= sizeof($jsonArray["$filiere"]["$groupe"]); $i++){

					$cpt += 1;

					echo("<div class=profil>");
					echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"]["$groupe"][$i]['image'] . "width=200 height=200 style=border-radius:10px; alt=error class=image onclick=\"clickImage($i)\";><br />");
					echo "<p>".$jsonArray["$filiere"]["$groupe"][$i]['prenom'] . " " . $jsonArray["$filiere"]["$groupe"][$i]['nom'] . "</p><br />";
					echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"]["$groupe"][$i]['mail'] . "<br />". $jsonArray["$filiere"]["$groupe"][$i]['numero'] . "</p><br />";
					echo("</div>");	

				}

			}
	}

	function jsonText(){
		$jsonText = file_get_contents('fichiers/filiere.json');
		return $jsonText;
	}

	function filiereJSON($nameFiliere, $nameGroupe){
		$jsonText = file_get_contents('fichiers/filiere.json');
		$jsonArray = json_decode($jsonText,True);

		echo("<select name=$nameFiliere id=select-filiere class=select-filiere onchange=\"liste_groupe();\">");
		echo"<option>Filière</option>";
		for ($i=0; $i <= sizeof($jsonArray["listeFilieres"]) -1; $i++){
			echo"<option>".$jsonArray["listeFilieres"][$i]["nomFiliere"]."</option>";
		}
		echo("</select>");

		echo("<select name=$nameGroupe id=select-groupe class=select-groupe>");
			echo("<option value=Groupe>Groupe</option>");
		echo("</select>");
	}







?>