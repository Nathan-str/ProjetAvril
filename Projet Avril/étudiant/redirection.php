<?php
session_start();

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
		alert("Inscription réussi!");
	</script>
	<?php
		}
	}
}

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
								if(!empty($_SESSION['pseudo'])){
							?>
									<a href="informations.php" class="lien"><i class="fa fa-drivers-license"></i> Compte</a>
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

		<script src="app.js" meta="utf-8"></script>

		<div class="page-wrapper">

			<h1 class="h1-redirection">Vous êtes étudiants ?</h1>
			<h2 class="h2-redirection">Inscrivez-vous pour transmettre et accèdez à vos informations</h2>

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
					<p>Filière:</p>
					<input class="radio" type="radio" name="filiere" value="L1-MIPI" checked=""/>L1-MIPI
					<input class="radio" type="radio" name="filiere" value="L2-MI" />L2-MI
					<input class="radio" type="radio" name="filiere" value="L3-I" />L3-I
					<input class="radio" type="radio" name="filiere" value="LP-RS" />LP-RS
					<input class="radio" type="radio" name="filiere" value="LPI-RIWS" />LPI-RIWS
					<p>Groupe:</p>
					<input type="radio" name="groupe" value="A1" checked=""/>A1
					<input type="radio" name="groupe" value="B2" />B2
					<input type="radio" name="groupe" value="LPI-1" />LPI-1
					<input type="radio" name="groupe" value="LPI-2" />LPI-2
					<input type="radio" name="groupe" value="LPI-3" />LPI-3
				</form>
				<?php
					errorInscription();
				?>
			</div>

			<div class="form_connexion">
				<p class="p_connexions">Connexion</p>
				<form action="connexion.php" method="post">
					<input class="input" type="mail" name="login" minlength="6" placeholder="Adresse Mail" required="required" />
					<input class="input" type="password" name="pwd" minlength="6" placeholder="Password" required="required" /><br />
					<input class="connexion-submit" type="submit" value="Valider" />
				</form>
				<?php
					errorConnexion();
				?>
			</div>

		</div>

	

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