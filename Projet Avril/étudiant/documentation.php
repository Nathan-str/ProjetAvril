<?php
session_start();

function errorConnexion(){

	if(isset($_GET['error'])){
		if($_GET['error'] == 0){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("Clé récupéré !")
		</script>
		<?php
		}elseif ($_GET['error'] == 1) { //1: GET définie dans la page vérifiant les identifiants
			$donnes = fopen('fichiers/cle.csv', 'r+');

			for ($i=0;$i<sizeof(file("fichiers/cle.csv"));$i++){
 				$ligne = fgets($donnes);
				$tableau = explode(";", $ligne);
	

				if ($_SESSION['mail'] == $tableau[0]){
					echo("<p>Votre clé API: " . $tableau[1] ."</p>");
					
				}
			}
			fclose($donnes);
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
						<a href="#" class="lien"><i class='fa fa-key'></i> GET A KEY</a>
						<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
						<a href="#" class="lien"><i class="fa fa-address-card-o"></i> Contact</a>
						<?php
							if(isset($_SESSION['pseudo'])){
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

<h1 class="h1-key">Utilisation de l'API</h1>

<div class="demande-cle-api">
	<label>Demander une clé API</label>
	<form action="cle.php" method="get">
		<input type="email" name="key" placeholder="Adresse mail" class="form-cle-api" />
		<input type="submit" value="GET KEY" class="form-cle-api">
	</form>

	<?php
	errorConnexion();
	?>
</div>




<div id="formulaire-API">
	<p>Accédez à l'API</p>
	<form action="apiEtu.php" method="get" class="formulaire-API1">

		<input type="radio" name="choix" value="filiere" checked="" />Filière
		<input class="filiere" type="radio" name="filiere" value="L1-MIPI" />L1-MIPI
		<input class="filiere" type="radio" name="filiere" value="L2-MI" />L2-MI
		<input class="filiere" type="radio" name="filiere" value="L3-I" />L3-I
		<input class="filiere" type="radio" name="filiere" value="LP RS" />LP-RS
		<input class="filiere" type="radio" name="filiere" value="LPI-RIWS" />LPI-RIWS
		<input class="form-cle-api" type="submit" value="Valider">

		<!--<input type="radio" name="choix" value="groupe" />Groupe
		<input class="groupe" type="radio" name="filiere" value="A1" />
		<input class="groupe" type="radio" name="filiere" value="A2" />
		<input class="groupe" type="radio" name="filiere" value="A3" />
		<input class="groupe" type="radio" name="filiere" value="B1" />
		<input class="groupe" type="radio" name="filiere" value="B2" />
		<input class="groupe" type="radio" name="filiere" value="B3" />
		<input class="groupe" type="radio" name="filiere" value="C1" />
		<input class="groupe" type="radio" name="filiere" value="C2" />
		<input class="groupe" type="radio" name="filiere" value="C3" />
		<input class="groupe" type="radio" name="filiere" value="D1" />
		<input class="groupe" type="radio" name="filiere" value="D2" />
		<input class="groupe" type="radio" name="filiere" value="D3" />
		<input class="groupe" type="radio" name="filiere" value="E1" />
		<input class="groupe" type="radio" name="filiere" value="E2" />
		<input class="groupe" type="radio" name="filiere" value="E3" />-->
	</form>
</div>

<h2>Documentation</h2>

</body>
</html>