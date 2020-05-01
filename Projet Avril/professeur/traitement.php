<?php
session_start();

include 'fonction.php';

verifSession($_SESSION['pseudo'], "index.php");

verifSession($_GET["filiere"], "demande.php");
verifSession($_GET["groupe"], "demande.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css" media="screen">
	<link rel="stylesheet" type="text/css" href="print.css" media="print">
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
						<!--<?php
							//if(!empty($_SESSION['pseudo'])){
						?>-->
								<a href="demande.php" class="lien"><i class='fa fa-book'></i> mosaique</a>
								<a href="deconnexion.php" class="lien"><i class="fa fa-sign-out"></i> Déconnexion</a>
						<!--<?php
							//}
						?>-->

					</div>

					<div class="nav-toggle">
						<span class="toggle-icons"></span>
					</div>

				</div>
			</nav>
	</header>

	<div class="formulaire-traitement">
		<form action="traitement.php" method="get">
			<?php
				filiereJSON("filiere", "groupe");
				$jsonText = jsonText();
			?>
			<input type="submit" class="select-submit" value="Valider" />
		</form>
	</div>

<?php
//mosaique();
choixMosaïque($_GET["filiere"], $_GET["groupe"], "dzsWVDlC1wgTgxC4BquZ", $_GET["choix"]);
?>

<script src="app.js" meta="utf-8"></script>
<script type="text/javascript">
	function liste_groupe(){
		affiche_Groupe(<?php  echo($jsonText);?>);
	}

	function affiche_Groupe(jsonText){
	    let filiere = document.getElementById("select-filiere").value;
	    let groupe =document.getElementById("select-groupe");

	    groupe.innerHTML = "<option value=''>Groupe</option>";
	    //for (let groupe in jsonText["listeFilieres"]){
	    //    groupe.innerHTML += `<option value='${jsonText["listeFilieres"]["0"]}'>${jsonText["listeFilieres"]["0"]}</option>`;
	    //}
			
		for (var i = 0; i < jsonText["listeFilieres"].length; i++) {
			if (filiere == jsonText["listeFilieres"][i]["nomFiliere"]) {
				for (var j = 0; j < jsonText["listeFilieres"][i]["groupes"].length; j++) {
				
					groupe.innerHTML += "<option value=" + jsonText["listeFilieres"][i]["groupes"][j] + ">" + jsonText["listeFilieres"][i]["groupes"][j] + "</option>";

				}
			}
		}
	}
</script>
</body>
</html>
