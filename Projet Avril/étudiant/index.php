<?php
session_start();
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
							<a class="logo" href="index.php">HAVE FLIGHT</a>
						</div>

						<div class="droite">
							<a href="api.php?name=paris-seoul" class="lien"><i class="fa fa-spinner fa-spin"></i> GET API</a>
							<a href="#" class="lien"><i class='fa fa-key'></i> GET A KEY</a>
							<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
							<a href="#" class="lien"><i class="fa fa-address-card-o"></i> Contact</a>	
						</div>

						<div class="nav-toggle">
							<span class="toggle-icons"></span>
						</div>

						<div class="toggle-connexion">
							<i class="fa fa-sign-in" style="font-size:36px"></i>
							<!--<span class="connexion-icon"></span>-->
						</div>

						<!--<div class="formulaire">
							<form action="connexion.php" method="post">
								<input class="inputt" type="text" name="login" placeholder="Login" required="required" />
								<input class="inputt" type="password" name="pwd" placeholder="Password" required="required" />
								<input class="inputt" type="submit" value="confirm" />
							</form>
							<?php
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
							?>
						</div>-->
					</div>
				</nav>
		</header>



		<div class="page-wrapper">
			<!--Ecrire que ici-->
			<h1 class="grand_h1">Le site offrant l'API qu'il vous faut</h1>

			<div class="toggle-inscription">
				<span class="inscription-icon"></span>
			</div>

			<div class="inscription_info">
				<p class="inscription_info_p">Inscription</p>
			</div>

			

			<div class="images1">
				<h1>Liste des vols</h1>
				<form class="form_images1" action="requete.php" method="post">
					<select class="vols_images1" name="vols">
						<option value="paris-seoul">Paris-Séoul</option>
						<option value="paris-madrid">Paris-Madrid</option>
						<option value="paris-marseille">Paris-Marseille</option>
					</select>
					<input class="submit_images1" type="submit" value="Valider" />
				</form>
			</div>

			<div class="images2">
				<h1>Réservation</h1>
			</div>

		</div>


	<script src="app.js" meta="utf-8"></script>

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