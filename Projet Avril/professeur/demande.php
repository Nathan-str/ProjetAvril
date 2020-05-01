<?php
session_start();

include 'fonction.php';

verifSession($_SESSION['pseudo'], "index.php");

function errorMosaique(){
	if(isset($_GET['error'])){
		if($_GET['error'] == 1){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("Aucune clé n'est renseigné !")
		</script>
		<?php
		}elseif($_GET['error'] == 2)	{
		?>
		<script type="text/javascript">
			alert("Aucun groupe n'est indiqué !")
		</script>
		<?php	
		}		
	}
}

errorMosaique();



?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<meta charset="utf-8" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
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
								<a href="#" class="lien"><i class='fa fa-book'></i> mosaique</a>
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


<h1 class="h1-demande">Accès à la mosaïque</h1>


<div id="formulaire-API">
		<form action="traitement.php" method="get" class="formulaire-API1">

			<div class="div-radio-demande">
				<input type="radio" name="choix" onclick="change()" value="filiere" id="choice" class="radio-demande" checked="" /><label class="label-demande">Filière:</label>
			</div>

			<div class="div-radio-demande">
				<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L1-MIPI" class="radio-demande" checked="" value="L1-MIPI" /><label class="label-demande">L1-MIPI</label>
			</div>

			<div class="div-radio-demande">
				<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L2-MI" class="radio-demande" value="L2-MI" /><label class="label-demande">L2-MI</label>
			</div>
			
			<div class="div-radio-demande">
				<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L3-I" class="radio-demande" value="L3-I" /><label class="label-demande">L3-I</label>
			</div>
			
			<div class="div-radio-demande">
				<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LP-RS" class="radio-demande" value="LP-RS" /><label class="label-demande">LP-RS</label>
			</div>
			
			<div class="div-radio-demande">
				<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LPI-RIWS" class="radio-demande" value="LPI-RIWS" /><label class="label-demande">LPI-RIWS</label>
			</div>
			
			<div class="div-radio-demande">
				<input type="radio" name="choix" onclick="change()" id="choice1" class="radio-demande" value="groupe" /><label class="label-demande">Groupe:</label>
			</div>

			<div class="div-radio-demande-liste">
				<select name="groupe" id="groupe" style='display:none;'>
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
			</div>

			<div class="div-radio-demande-submit">
				<input class="form-cle-api" type="submit" value="Valider">
			</div>
			

		</form>


</div>

<?php
if (isset($_COOKIE["recherche"])){
	$jasonRecherche = $_COOKIE["recherche"];
	$recherche = json_decode($jasonRecherche, True);
	echo "<a id=\"derniere_href\" href='traitement.php?filiere=" . $recherche["filiere"] . "&amp;" ."choix=groupe" . "&amp;" . "groupe=" . $recherche["groupe"] ."'>Dernière recherche d'un groupe</a>";
	echo "<a id=\"derniere_href\" href='traitement.php?choix=filiere" . "&amp;" . "filiere=" . $recherche["filiere"] . "&amp;" . "groupe=" . $recherche["groupe"] ."'>Dernière recherche d'une filière</a>";
	
}else{
	echo"Pour avoir accès à sa dernière recherche, il vous faut faire une première recherche. 'Albert Einstein'";
}

?>

<h2>Informations pour la mosaïque</h2>
	<p>Pour avoir des informations précises sur la personne, il vous faut cliquer sur la photo correspondante et recliquez dessus pour les masquer.</p>


<script src="app.js" meta="utf-8"></script>


</body>
</html>

