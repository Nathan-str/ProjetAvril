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

			<p class="p-titre-inscription">Inscription :</p>
			<div class="wrapperss">
				<div class="contact-form">	
					<form action="inscription.php" method="post">
						<div class="input-fields">
							<input class="input" type="text" name="nom" minlength="3" placeholder="Nom" required="required" />
							<input class="input" type="text" name="prenom" minlength="3" placeholder="Prénom" required="required" />
							<input class="input" type="email" name="mail" minlength="6" placeholder="****@****.fr" required="required" />
							<input class="input" type="text" name="numero" minlength="10" maxlength="10" placeholder="Numéro de téléphone" required="required" />
							<input class="input" type="password" name="mdp" minlength="6" placeholder="Mot de passe" required="required" />
							<input class="input" type="password" name="mdp1" minlength="6" placeholder="Confirmation" required="required" />
							
						</div>
						<p id="filiere-p">Filiere/groupe</p>

						<div class="selected-fg">
						<?php
							//Liste déroulante pour les filières et les groupes.
							filiereJSON("filiere", "groupe");
							$jsonText = jsonText();
						?>
						</div>

						<div class="boxes">
							<input class="button" type="submit" value="Valider" />
						</div>

					</form>
					<?php
						//Message pour les erreurs pour l'inscription.
						errorInscription();
					?>
				</div>
			</div>


			<p class="p-titre-connexion">Connexion :</p>
			<div class="wrappers">
				<div class="contact-form">
						<form action="connexion.php" method="post">
							<div class="input-fields">
								<input class="input" type="email" name="login" minlength="6" placeholder="Adresse Mail" required="" />
								<input class="input" type="password" name="pwd" minlength="6" placeholder="Password" required="" /><br />

								<div class="box">
									<input class="button" type="submit" value="Valider" />
								</div>

							</div>
						</form>
					
				</div>
				<?php
				//Message pour les erreurs pour la connexion.
					errorConnexion();
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