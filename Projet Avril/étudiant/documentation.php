<?php
session_start();

function errorConnexion(){

	if(isset($_GET['error'])){
		if($_GET['error'] == 0){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("Mauvais identifiants!")
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
		}elseif ($_GET['error'] == 3) {
		?>
		<script type="text/javascript">
			alert("Les mots de passes sont différents !");
		</script>
		<?php
		}elseif ($_GET['error'] == 6) {
		?>
		<script type="text/javascript">
			alert("Clé créée !");
		</script>
		<?php
		}elseif ($_GET['error'] == 5) {
		?>
		<script type="text/javascript">
			alert("L'adresse mail existe déjà !");
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

<div class="inscription-cle-api">
	<label>Demandé sa clé API</label>
	<form action="cle.php" method="get">
		<input type="email" name="mail" placeholder="Adresse mail" class="form-cle-api" />
		<input type="password" name="pwd" placeholder="Mot de passe" class="form-cle-api" />
		<input type="password" name="pwd1" placeholder="Confirmation mot de passe" class="form-cle-api" />
		<input type="submit" value="Inscription" class="form-cle-api" />
	</form>
</div>

<div class="demande-cle-api">
	<label>Voir sa clé API</label>
	<form action="cle.php" method="get">
		<input type="email" name="key-mail" placeholder="Adresse mail" class="form-cle-api" />
		<input type="password" name="key-pwd" placeholder="Mot de passe" class="form-cle-api" />
		<input type="submit" value="GET KEY" class="form-cle-api" />
	</form>

	<?php
	errorConnexion();
	?>
</div>




<div id="formulaire-API">
	<p>Accédez à l'API</p>
	<form action="apiEtu.php" method="get" class="formulaire-API1">

		<input type="radio" name="choix" value="filiere" checked="" />Filière
		<input class="filiere" type="radio" name="filiere" checked="" value="L1-MIPI" />L1-MIPI
		<input class="filiere" type="radio" name="filiere" value="L2-MI" />L2-MI
		<input class="filiere" type="radio" name="filiere" value="L3-I" />L3-I
		<input class="filiere" type="radio" name="filiere" value="LP RS" />LP-RS
		<input class="filiere" type="radio" name="filiere" value="LPI-RIWS" />LPI-RIWS
		<input type="text" name="cle" placeholder="Clé API" />
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