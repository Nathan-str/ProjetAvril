<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';
include 'include/fonctionInscription.inc.php';
include 'include/fonctionConnexion.inc.php';


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

			<div class="titre-redirection">
			<h1 class="h1-redirection">Vous êtes étudiants ?</h1>
			<h2 class="h2-redirection">Inscrivez-vous pour transmettre et accèdez à vos informations</h2>
			</div>

			<div class="form_inscription">
				<p class="p_inscriptions">Inscription</p>
				<form action="inscription.php" method="post">
					<input class="input" type="text" name="nom" minlength="3" placeholder="Nom" required="required" />
					<input class="input" type="text" name="prenom" minlength="3" placeholder="Prénom" required="required" />
					<input class="input" type="email" name="mail" minlength="6" placeholder="****@****.fr" required="required" />
					<input class="input" type="text" name="numero" minlength="10" maxlength="10" placeholder="Numéro de téléphone" required="required" />
					<input class="input" type="password" name="mdp" minlength="6" placeholder="Mot de passe" required="required" />
					<input class="input" type="password" name="mdp1" minlength="6" placeholder="Confirmation mot de passe" required="required" />
					<input class="submit" type="submit" value="Valider" />
					<p id="filiere-p">Filiere/groupe</p>

					<div class="selected-fg">
					<?php
						//Liste déroulante pour les filières et les groupes.
						filiereJSON("filiere", "groupe");
						$jsonText = jsonText();
					?>
					</div>

				</form>
				<?php
					//Message pour les erreurs pour l'inscription.
					errorInscription();
				?>
			</div>


			<div class="form_connexion">
				<p class="p_connexions">Connexion</p>
				<form action="connexion.php" method="post">
					<input class="input" type="email" name="login" minlength="6" placeholder="Adresse Mail" required="" />
					<input class="input" type="password" name="pwd" minlength="6" placeholder="Password" required="" /><br />
					<input class="connexion-submit" type="submit" value="Valider" />
				</form>
				<?php
				//Message pour les erreurs pour la connexion.
					errorConnexion();
				?>
			</div>

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