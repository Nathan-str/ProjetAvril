<?php

function headeer(){
	?>
	<header role="header" >	
			<nav class="menu" role="navigation">
				<div class="inner">
					<div class="gauche">
						<a class="logo" href="index.php">Administration</a>
					</div>

					<div class="droite">
						
						<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
						<?php
							if(!empty($_SESSION['pseudo'])){
						?>
								<a href="traitement.php" class="lien"><i class='fa fa-book'></i> mosaique</a>
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

function footeer(){
	?>
	<footer class="le_footer">
			<div class="contenue">
				<div class="footer-section about">
					<p>Projet</p>
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
		<?php
}
?>