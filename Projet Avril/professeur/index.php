<?php
session_start();

include 'fonction.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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

<h1 class="index-h1">espace administration</h1>

<h2 class="index-h2">Accès à la mosaïque des élèves du département informatique.</h2>

<div class="div-inscription">
<p class="p-inscription">Inscription</p>
<?php
formulaireInscription();
echo(errorInscription());
?>
</div>

<div class="div-connexion">
<p class="p-connexion">Connexion</p>
<?php
formulaireConnexion();
echo(errorConnexion());
?>
</div>

</body>
</html>