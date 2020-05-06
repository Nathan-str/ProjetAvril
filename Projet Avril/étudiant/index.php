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
						filiereJSON("filiere", "groupe");
						$jsonText = jsonText();
					?>
					</div>

					<!--<input class="radio" type="radio" onclick="selection()" name="filiere" id="L1-MIPI" value="L1-MIPI" checked=""/>L1-MIPI
					<input class="radio" type="radio" onclick="selection()" name="filiere" id="L2-MI" value="L2-MI" />L2-MI
					<input class="radio" type="radio" onclick="selection()" name="filiere" id="L3-I" value="L3-I" />L3-I
					<input class="radio" type="radio" onclick="selection()" name="filiere" id="LP-RS" value="LP-RS" />LP-RS
					<input class="radio" type="radio" onclick="selection()" name="filiere" id="LPI-RIWS" value="LPI-RIWS" />LPI-RIWS
					<p id="groupe-p">Groupe</p>
					<select name="groupe" id="groupe">
						<option id="A1" style='display:none;'>A1</option>
						<option id="A2" style='display:none;'>A2</option>
						<option id="A3" style='display:none;'>A3</option>
						<option id="B1" style='display:none;'>B1</option>
						<option id="B2" style='display:none;'>B2</option>
						<option id="B3" style='display:none;'>B3</option>
						<option id="C1" style='display:none;'>C1</option>
						<option id="C2" style='display:none;'>C2</option>
						<option id="C3" style='display:none;'>C3</option>
						<option id="D1" style='display:none;'>D1</option>
						<option id="D2" style='display:none;'>D2</option>
						<option id="D3" style='display:none;'>D3</option>
						<option id="E1" style='display:none;'>E1</option>
						<option id="E2" style='display:none;'>E2</option>
						<option id="E3" style='display:none;'>E3</option>
					</select>-->
				</form>
				<?php
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