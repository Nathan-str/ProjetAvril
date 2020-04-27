<?php
session_start();

include 'fonction.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title>Trombinoscope</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<header role="header" >	
			<nav class="menu" role="navigation">
				<div class="inner">
					<div class="gauche">
						<a class="logo" href="index.php">Trombinoscope</a>
					</div>

					<div class="droite">
						
						<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
						<?php
							if(!empty($_SESSION['pseudo'])){
						?>
								<a href="demande.php" class="lien"><i class='fa fa-book'></i> mosaique</a>
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

<p>Inscription</p>
<?php
formulaireInscription();
echo(errorInscription());
?>
<p>Connexion</p>
<?php
formulaireConnexion();
echo(errorConnexion());
?>

</body>
</html>