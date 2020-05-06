<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';
include 'include/fonctionCompte.inc.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>API</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	
	<?php
		headeer();
	?>

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

			<form method="post" enctype="multipart/form-data">
				<p class="modification-image-title">Modifier l'image(170x170): </p> <input type="file" name="image" accept=".jpg, .jpeg, .png" class="modification-image" /><br />
				<input type="submit" name="upload" value="Changez la photo" id="input-image" class="modification-image" />
			</form>


			<?php
				comptes();
			?>
		</div>

			<!--<div class="checkbox-info">
				<input id="oldnom" type="checkbox" onclick="changeNom()" name="change-nom" class="checkbox-style" />Modification du nom 
				<input id="oldprenom" type="checkbox" onclick="changePrenom()" name="change-prenom" class="checkbox-style" />Modification du prénom 
				<input id="oldmail" type="checkbox" onclick="changeMail()" name="change-mail" class="checkbox-style" />Modification du mail 
				<input id="oldnumero" type="checkbox" onclick="changeNumero()" name="change-numero" class="checkbox-style" />Modification du numéro 
				<input id="oldmdp" type="checkbox" onclick="changeMdp()" name="change-mdp" class="checkbox-style" />Modification du mot de passe
				<input id="oldfiliere" type="checkbox" onclick="changeFiliere()" name="change-filiere" class="checkbox-style" />Modification de la filière et du groupe


			</div>-->

			<div class="formulaire-changement">

				<h2 class="change-info">Changer ses informations:</h2>

				<form action="changement.php" method="post">
					<input id="chg-nom" type="text" name="new-nom" class="new-form" minlength="3" placeholder="Nouveau nom" />
					<input id="chg-prenom" type="text" name="new-prenom" class="new-form" minlength="3" placeholder="Nouveau prénom" />
					<input id="chg-mail" type="email" name="new-mail" class="new-form" placeholder="Nouvelle adresse mail" />
					<input id="chg-numero" type="text" name="new-numero" class="new-form" minlength="10" maxlength="10" placeholder="Nouveau numéro" />
					<input id="chg-mdp" type="password" name="new-mdp" class="new-form" minlength="6" placeholder="Nouveau mot de passe" />
					<p id="chg-picture"></p>
					<p>*Pour changer sa filiere, il faut aussi préciser le groupe</p>
					<?php
						filiereJSON("new-filiere", "new-groupe");
						$jsonText = jsonText();
					?>
					
					

					<input id="chg-submit" type="submit" value="Valider" />

				</form>

			</div>

			<?php
			erreur();
			?>


	</div>

	<script src="app.js"></script>
	<script>
	function liste_groupe(){
		affiche_Groupe(<?php  echo($jsonText);?>);
	}

	
	</script>


	<?php
		footeer();
	?>

</body>
</html>