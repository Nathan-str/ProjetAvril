<?php
session_start();

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



?>

<!DOCTYPE html>
<html>
<head>
	<title>Trombinoscope</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
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
<?php
if (isset($_SESSION['pseudo'])){
?>

<div id="formulaire-API">
	<p>Accédez à la mosaïque</p>
	<form action="traitement.php" method="get" class="formulaire-API1">

		<input type="radio" name="choix" onclick="change()" value="filiere" id="choice" checked="" />Filière
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L1-MIPI" checked="" value="L1-MIPI" />L1-MIPI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L2-MI" value="L2-MI" />L2-MI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L3-I" value="L3-I" />L3-I
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LP-RS" value="LP-RS" />LP-RS
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LPI-RIWS" value="LPI-RIWS" />LPI-RIWS

		<input type="radio" name="choix" onclick="change()" id="choice1" value="groupe" />Groupe
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

		<input type="text" name="cle" placeholder="Clé API" />
		<input class="form-cle-api" type="submit" value="Valider">

	</form>


</div>

<?php
if (isset($_COOKIE["recherche"])){
	$jasonRecherche = $_COOKIE["recherche"];
	$recherche = json_decode($jasonRecherche, True);
	echo "<a id=\"derniere_href\" href='traitement.php?filiere=" . $recherche["filiere"] . "&amp;" ."choix=groupe" . "&amp;" . "groupe=" . $recherche["groupe"] . "&amp;" . "cle=" . $recherche["cle"] ."'>Dernière recherche d'un groupe</a>";
	//http://nathan-str-prof.alwaysdata.net/traitement.php?filiere=LP-RS&choix=groupe&groupe=D1&cle=U0UWfUlUhxvmOg1HTZZQ
}else{
	echo"bonjour";
}

?>

<script src="app.js" meta="utf-8"></script>

<?php
}else{
	header("location: ./index.php");
}
?>
</body>
</html>

