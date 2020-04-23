<?php
session_start();

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

function upload(){
	if(isset($_POST['upload'])){
		$nom_image = $_FILES['image']['name'];
		if($_FILES['image']['error'] == 4 ){
			$nom_image = "profil_defaut.png";
		}
		$type_image = $_FILES['image']['type'];
		$taille_image = $_FILES['image']['size'];
		$image_tmp_name=$_FILES['image']['tmp_name'];
		$description = $_POST['desc'];
		move_uploaded_file($image_tmp_name, "images/$nom_image");

		$donnes = fopen('fichiers/images.csv', 'a+');
		fputs($donnes, $_SESSION['id'] . ";" . $nom_image . "\n");
		fclose($donnes);
	}
}

function Pphoto(){
	
	$erreur = $_FILES['image']['error'];
	$donnes = fopen('fichiers/images.csv', 'r+');

	for ($i=0;$i<sizeof(file("fichiers/images.csv"));$i++){
 		$ligne = fgets($donnes);
		$tableau = explode(";", $ligne);

		if ($tableau[0] == $_SESSION["id"]){
			$nom_image = $tableau[1];
		}
	}

	echo"<img src='images/$nom_image' width='170' height='170' class=\"pp\"><br>$description";
	
}

function erreur(){
	if(isset($_GET['error'])){
		if($_GET['error'] == 2){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("L'email ou le numero existe déjà' !");
		</script>
		<?php
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>API</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
	<header role="header" >	
			<nav class="menu" role="navigation">
				<div class="inner">
					<div class="gauche">
						<a class="logo" href="redirection.php">API etudiant</a>
					</div>

					<div class="droite">
						<a href="documentation.php" class="lien"><i class='fa fa-key'></i> GET A KEY</a>
						<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
						<a href="#" class="lien"><i class="fa fa-address-card-o"></i> Contact</a>
						<?php
							if(isset($_SESSION['pseudo'])){
						?>
								<a href="#" class="lien"><i class="fa fa-drivers-license"></i> Compte</a>
								<a href="deconnexion.php" class="lien"><i class="fa fa-sign-out"></i> Déconnexion</a>
						<?php
							}
						?>
					</div>

					<div class="nav-toggle">
						<span class="toggle-icons"></span>
					</div>
				</div>
			</nav>
	</header>

	<div class="page-wrapper">
		<h1 class="h1-info">Informations du compte</h1>

		<!--<input type="file" name="input-image" id="input-image" accept=".jpg, .jpeg, .png"  multiple />
		<div class="image-pre" id="imagePre">
			<img src="" alt="Photo de profil" class="image-preview__image" />
			<span class="image-preview__texte">Photo de profil</span>
		</div>-->
		<div class="position-info">
			<?php
				upload();
				Pphoto();
			?>

			<form accept="test.php" method="post" enctype="multipart/form-data">
				<p class="modification-image">Modifier l'image(170x170): </p> <input type="file" name="image" accept=".jpg, .jpeg, .png" class="modification-image" multiple><br />
				<input type="submit" name="upload" value="Changez la photo" id="input-image" class="modification-image">
			</form>


			<?php
				comptes();
			?>


			<div class="checkbox-info">
				<input id="oldnom" type="checkbox" onclick="changeNom()" name="change-nom" class="checkbox-style" />Modification du nom 
				<input id="oldprenom" type="checkbox" onclick="changePrenom()" name="change-prenom" class="checkbox-style" />Modification du prénom 
				<input id="oldmail" type="checkbox" onclick="changeMail()" name="change-mail" class="checkbox-style" />Modification du mail 
				<input id="oldnumero" type="checkbox" onclick="changeNumero()" name="change-numero" class="checkbox-style" />Modification du numéro 
				<input id="oldmdp" type="checkbox" onclick="changeMdp()" name="change-mdp" class="checkbox-style" />Modification du mot de passe
				<input id="oldfiliere" type="checkbox" onclick="changeFiliere()" name="change-filiere" class="checkbox-style" />Modification de la filière et du groupe


			</div>

			<div class="formulaire-changement">

			<form action="changement.php" method="post">
				<input id="chg-nom" type="text" name="new-nom" placeholder="Nouveau nom" style='display:none;' />
				<input id="chg-prenom" type="text" name="new-prenom" placeholder="Nouveau prénom" style='display:none;' />
				<input id="chg-mail" type="email" name="new-mail" placeholder="Nouvelle adresse mail" style='display:none;' />
				<input id="chg-numero" type="text" name="new-numero" placeholder="Nouveau numéro" style='display:none;' />
				<input id="chg-mdp" type="password" name="new-mdp" placeholder="Nouveau mot de passe" style='display:none;' />
				<p id="chg-picture"></p>
				
				<select id="chg-filiere" name="new-filiere" style='display:none;'>
					<option>L1-MIPI</option>
					<option>L2-MI</option>
					<option>L3-I</option>
					<option>LP-RS</option>
					<option>LPI-RIWS</option>
				</select>

				<select id="chg-groupe" name="new-groupe" style='display:none;'>
					<option>A1</option>
					<option>B2</option>
					<option>LPI-1</option>
					<option>LPI-2</option>
					<option>LPI-3</option>
				</select>

				<input id="chg-submit" type="submit" value="Valider" style='display:none;' />

			</form>

			</div>

			<?php
			erreur();
			?>

		</div>

	</div>

	<script>

		var oldnom = document.getElementById("oldnom");
		var oldprenom = document.getElementById("oldprenom");
		var oldmail = document.getElementById("oldmail");
		var oldnumero = document.getElementById("oldnumero");
		var oldmdp = document.getElementById("oldmdp");
		var oldfiliere = document.getElementById("oldfiliere");
		var oldgroupe = document.getElementById("oldgroupe");

		var nom = document.getElementById("chg-nom");
		var prenom = document.getElementById("chg-prenom");
		var mail = document.getElementById("chg-mail");
		var numero = document.getElementById("chg-numero");
		var mdp = document.getElementById("chg-mdp");
		var filiere = document.getElementById("chg-filiere");
		var groupe = document.getElementById("chg-groupe");
		var submit = document.getElementById("chg-submit");

		function changeNom(){
			if (oldnom.checked){
				nom.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				nom.style.display = "none";
			}else{
				nom.style.display = "none";
			}	
		}	

		function changePrenom(){
			if (oldprenom.checked) {
				prenom.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				prenom.style.display = "none";
			}else{
				prenom.style.display = "none";
			}	
		}

		function changeMail(){
			if (oldmail.checked) {
				mail.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				mail.style.display = "none";
			}else{
				mail.style.display = "none";
			}	
		}

		function changeNumero(){
			if (oldnumero.checked) {
				numero.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				numero.style.display = "none";
			}else{
				numero.style.display = "none";
			}
		}	

		function changeMdp(){
			if (oldmdp.checked) {
				mdp.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				mdp.style.display = "none";
			}else{
				mdp.style.display = "none";
			}
		}

		function changeFiliere(){
			if (oldfiliere.checked) {
				filiere.style.display = "block";
				groupe.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				filiere.style.display = "none";
				groupe.style.display = "none";
			}else{
				filiere.style.display = "none";
				groupe.style.display = "none";
			}
		}



		//--------------------------------------------------------------------------------------------------------------

		const inputImage = document.getElementById("input-image");
		const preContenu = document.getElementById("imagePre");
		const preImage = preContenu.querySelector(".image-preview__image");
		const preTexte = preContenu.querySelector(".image-preview__texte");

		inputImage.addEventListener("change", function(){
			const fichier = this.files[0];

			if (fichier){
				const reader = new FileReader();
				
				preTexte.style.display = "none";
				preImage.style.display = "block";

				reader.addEventListener("load", function(){
					console.log(this);
					preImage.setAttribute("src", this.result);
				});

				reader.readAsDataURL(fichier);
			}
		});

	</script>

	<footer class="le_footer">
		<div class="contenue">
			<div class="footer-section about">
				<h1>Projet</h1>
				<p>Bonjour</p>
			</div>
			<div class="footer-section links">
				<p>Liens</p>
			</div>
			<div class="footer-section contact-form">
				<p><i class="fa fa-address-card-o"></i> Contacts</p>
			</div>
		</div>

		<div class="fond">
			<p>Site réalisé par Nathan Sestre</p>
		</div>	
	</footer>

</body>
</html>