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
	<form action="cle.php" method="get">
		<label>Demande de clé</label>
		<input type="radio" name="choose" onclick="changement()" id="choix1" value="inscription" checked="" />
		<label>Voir clé</label>
		<input type="radio" name="choose" onclick="changement()" id="choix2" value="connexion"/>

		<input type="email" name="mail" placeholder="Adresse mail" id="Imail" class="form-cle-api" style='display:block;'/>
		<input type="password" name="pwd" placeholder="Mot de passe" id="Ipwd" class="form-cle-api" style='display:block;'/>
		<input type="password" name="pwd1" placeholder="Confirmation mot de passe" id="Ipwd1" class="form-cle-api" style='display:block;'/>
		<input type="submit" value="Inscription" id="Isubmit" class="form-cle-api" style='display:block;'/>

		<input type="email" name="key-mail" placeholder="Adresse mail" id="Cmail" class="form-cle-api" style='display:none;'/>
		<input type="password" name="key-pwd" placeholder="Mot de passe" id="Cpwd" class="form-cle-api" style='display:none;'/>
		<input type="submit" value="GET KEY" id="Csubmit" class="form-cle-api" style='display:none;'/>
	</form>

	<?php
	errorConnexion();
	?>
</div>




<div id="formulaire-API">
	<p>Accédez à l'API</p>
	<form action="apiEtu.php" method="get" class="formulaire-API1">

		<input type="radio" name="choix" onclick="change()" value="filiere" id="choice" checked="" />Filière
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L1-MIPI" checked="" value="L1-MIPI" />L1-MIPI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L2-MI" value="L2-MI" />L2-MI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L3-I" value="L3-I" />L3-I
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LP-RS" value="LP RS" />LP-RS
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LPI-RIWS" value="LPI-RIWS" />LPI-RIWS

		<input type="radio" name="choix" onclick="change()" id="choice1" value="groupe" />Groupe
		<select name="groupe" id="groupe" style='display:none;'>
			<option>Choisissez la filière puis le groupe</option>
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
		</select>

		<input type="text" name="cle" placeholder="Clé API" />
		<input class="form-cle-api" type="submit" value="Valider">
	</form>
</div>



<script>
	$choix1 = document.getElementById("choix1");
	$choix2 = document.getElementById("choix2");
	
	$Imail = document.getElementById("Imail");
	$Ipwd = document.getElementById("Ipwd");
	$Ipwd1 = document.getElementById("Ipwd1");
	$Isubmit = document.getElementById("Isubmit");

	$Cmail = document.getElementById("Cmail");
	$Cpwd = document.getElementById("Cpwd");
	$Csubmit = document.getElementById("Csubmit");

	function changement(){
		if (choix1.checked){

			$Imail.style.display = "block";
			$Ipwd.style.display = "block";
			$Ipwd1.style.display = "block";
			$Isubmit.style.display = "block";
			$Cmail.style.display = "none";
			$Cpwd.style.display = "none";
			$Csubmit.style.display = "none";

		}else if (choix2.checked) {

			$Imail.style.display = "none";
			$Ipwd.style.display = "none";
			$Ipwd1.style.display = "none";
			$Isubmit.style.display = "none";
			$Cmail.style.display = "block";
			$Cpwd.style.display = "block";
			$Csubmit.style.display = "block";

		}	
	}

	//-----------------------------------------------------

	$Bfiliere = document.getElementById("choice");
	$Bgroupe = document.getElementById("choice1");

	$L1MIPI = document.getElementById("L1-MIPI");
	$L2MI = document.getElementById("L2-MI");
	$L3I = document.getElementById("L3-I");
	$LPRS = document.getElementById("LP-RS");
	$LPIRIWS = document.getElementById("LPI-RIWS");

	$groupe = document.getElementById("groupe");
	$A1 = document.getElementById("A1");
	$A2 = document.getElementById("A2");
	$A3 = document.getElementById("A3");
	$B1 = document.getElementById("B1");
	$B2 = document.getElementById("B2");
	$B3 = document.getElementById("B3");
	$C1 = document.getElementById("C1");
	$C2 = document.getElementById("C2");
	$C3 = document.getElementById("C3");
	$D1 = document.getElementById("D1");
	$D2 = document.getElementById("D2");
	$D3 = document.getElementById("D3");
	$E1 = document.getElementById("E1");
	$E2 = document.getElementById("E2");
	$E3 = document.getElementById("E3");

	function change(){
		if ($Bfiliere.checked){
			$groupe.style.display = "none";
		}else if ($Bgroupe.checked) {
			$groupe.style.display = "block";
		}
	}

	function selection(){
		if ($L1MIPI.checked) {
			$A1.style.display = "block";
			$A2.style.display = "block";
			$A3.style.display = "block";

			$B1.style.display = "none";
			$B2.style.display = "none";
			$B3.style.display = "none";

			$C1.style.display = "none";
			$C2.style.display = "none";
			$C3.style.display = "none";

			$D1.style.display = "none";
			$D2.style.display = "none";
			$D3.style.display = "none";

			$E1.style.display = "none";
			$E2.style.display = "none";
			$E3.style.display = "none";
		}else if ($L2MI.checked) {
			$B1.style.display = "block";
			$B2.style.display = "block";
			$B3.style.display = "block";

			$A1.style.display = "none";
			$A2.style.display = "none";
			$A3.style.display = "none";

			$C1.style.display = "none";
			$C2.style.display = "none";
			$C3.style.display = "none";

			$D1.style.display = "none";
			$D2.style.display = "none";
			$D3.style.display = "none";

			$E1.style.display = "none";
			$E2.style.display = "none";
			$E3.style.display = "none";
		}else if ($L3I.checked) {
			$C1.style.display = "block";
			$C2.style.display = "block";
			$C3.style.display = "block";

			$B1.style.display = "none";
			$B2.style.display = "none";
			$B3.style.display = "none";

			$A1.style.display = "none";
			$A2.style.display = "none";
			$A3.style.display = "none";

			$D1.style.display = "none";
			$D2.style.display = "none";
			$D3.style.display = "none";

			$E1.style.display = "none";
			$E2.style.display = "none";
			$E3.style.display = "none";
		}else if ($LPRS.checked) {
			$D1.style.display = "block";
			$D2.style.display = "block";
			$D3.style.display = "block";

			$B1.style.display = "none";
			$B2.style.display = "none";
			$B3.style.display = "none";

			$C1.style.display = "none";
			$C2.style.display = "none";
			$C3.style.display = "none";

			$A1.style.display = "none";
			$A2.style.display = "none";
			$A3.style.display = "none";

			$E1.style.display = "none";
			$E2.style.display = "none";
			$E3.style.display = "none";
		}else if ($LPIRIWS.checked) {
			$E1.style.display = "block";
			$E2.style.display = "block";
			$E3.style.display = "block";

			$B1.style.display = "none";
			$B2.style.display = "none";
			$B3.style.display = "none";

			$C1.style.display = "none";
			$C2.style.display = "none";
			$C3.style.display = "none";

			$D1.style.display = "none";
			$D2.style.display = "none";
			$D3.style.display = "none";

			$A1.style.display = "none";
			$A2.style.display = "none";
			$A3.style.display = "none";
		}
	}

	


</script>

</body>
</html>