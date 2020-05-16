<?php

//Page concernant le header et le footer des pages:

//Fonction afin d'initialiser le header pour les pages affichables.
function headeer(){
	?>
	<header>	
				<nav class="menu">
					<div class="inner">
						<div class="gauche">
							<a class="logo" href="index.php">API etudiant</a>
						</div>

						<div class="droite">
							<a href="documentation.php" class="lien"><i class='fa fa-book'></i> API service</a>
							<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
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

	<?php
}

//Fonction permettant d'afficher le footer pour toutes les pages affichables.

function footeer(){
	?>
	<footer class="le_footer">
			<div class="contenue">
				<div class="footer-section about">
					<p class="p-footer-element">Date</p>
					<ul><li><p class="p-footer-sous-element">Projet du 20/04 au 10/05</p></li></ul>
				</div>
				<div class="footer-section links">
					<p class="p-footer-element">Liens</p>
					<ul><li><a class="p-footer-sous-element" href="index.php" style="color: white;">Accueil</a></li></ul>
				</div>
				<div class="footer-section contact">
					<p class="p-footer-element"><i class="fa fa-address-card-o"></i> Contacts</p>
					<ul><li><a class="p-footer-sous-element" href="mailto:sestre.nathan@orange.fr" style="color: white;">sestre.nathan@orange.fr</a></li></ul>
				</div>
			</div>

			<div class="fond">
				<p>Site réalisé par Nathan Sestre</p>
			</div>	
		</footer>
		<?php
}
?>