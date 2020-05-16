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

		<h1 class="h1-info">Informations du compte</h1>

			<?php
				//Fonction qui upload l'image avec des vérifs.
				upload();
				//Fonction qui affiche l'image pour la personne connectée.
			?>

			<div class="change-photo">
				<form method="post" enctype="multipart/form-data">
					<p class="modification-image-title">Modifier l'image(100x100): </p> 

					<div class="direction-photo">
						<input type="file" name="image" accept=".jpg, .jpeg, .png" id="file" class="modification-image" />
						<label for="file" class="modification-image-input">

							<div class="fa-direction">
								<i class="fa fa-upload"></i>
							</div>

							<div class="p-direction">
								Choisir une photo
							</div>

						</label>
						<div class="boxess">
							<input type="submit" name="upload" value="Changez la photo" id="input-image" class="buttonne" />
						</div>
					</div>

				</form>
			</div>

			<?php
				//Fonction affichant les informations de comptes pour la personne connectée.
				comptes();
			?>


			<div class="wrappersss">
				<div class="contact-form">

					<form action="changement.php" method="post">
						<div class="input-fields">
							<input id="chg-nom" type="text" name="new-nom" class="input" minlength="3" placeholder="Nouveau nom" />
							<input id="chg-prenom" type="text" name="new-prenom" class="input" minlength="3" placeholder="Nouveau prénom" />
							<input id="chg-mail" type="email" name="new-mail" class="input" placeholder="Nouvelle adresse mail" />
							<input id="chg-numero" type="text" name="new-numero" class="input" minlength="10" maxlength="10" placeholder="Nouveau numéro" />
							<input id="chg-mdp" type="password" name="new-mdp" class="input" minlength="6" placeholder="Nouveau mot de passe" />
						</div>
						<p>*Pour changer sa filiere, il faut aussi préciser le groupe</p>

						
						<?php
							filiereJSON("new-filiere", "new-groupe");
							$jsonText = jsonText();
						?>
						
						<div class="boxes-change">
							<input class="button" type="submit" value="Valider" />
						</div>

					</form>
				</div>
			</div>

			<?php
			erreur();
			?>



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