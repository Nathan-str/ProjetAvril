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

		<div class="position-info">
			<?php
				//Fonction qui upload l'image avec des vérifs.
				upload();
				//Fonction qui affiche l'image pour la personne connectée.
				Pphoto();
			?>

			<form method="post" enctype="multipart/form-data">
				<p class="modification-image-title">Modifier l'image(170x170): </p> <input type="file" name="image" accept=".jpg, .jpeg, .png" class="modification-image" /><br />
				<input type="submit" name="upload" value="Changez la photo" id="input-image" class="modification-image" />
			</form>


			<?php
				//Fonction affichant les informations de comptes pour la personne connectée.
				comptes();
			?>
		</div>


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