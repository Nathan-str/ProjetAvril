<?php
session_start();

include 'fonction.php';
include 'pageElement.php';
include 'include/fonctionMosaique.inc.php';

$verifPseudo = verifElement($_SESSION['pseudo']);

$verifFiliere = verifElement($_GET["filiere"]);
$verifGroupe = verifElement($_GET["groupe"]);
$verifCookie = verifElement($_COOKIE["recherche"]);

if ($verifPseudo == false){
	header("location:./index.php");
}else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css" media="screen">
	<link rel="stylesheet" type="text/css" href="print.css" media="print">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
	<?php
		headeer();
	?>
	<div class="cube">
		<div class="toggle-traitement">
			<span class="traitement-icon"></span>
		</div>
	</div>
	<div class="cube-choix">
		<p class="cube-choix-p"> <-- Choix</p>
	</div>
	

	<!--<div class="traitement_info">
		<p class="traitement_info_p">Traitement</p>
	</div>-->

	<div class="formulaire-traitement">
		<form action="traitement.php" method="get" class="formulaire-traitement-form">
			<?php
				filiereJSON("filiere", "groupe");
				$jsonText = jsonText();
			?>
			<input type="submit" class="select-submit" value="Valider" />
		</form>
		<input type="checkbox" name="all_infos" class="all_infos" onclick="clickInfo();" /><p class="all_infos-p">Tout afficher</p>
	</div>



<?php
//mosaique();
if ($verifFiliere == true && $_GET["filiere"] != "Filière"){
	if ($_GET["groupe"] == "Groupe" || $verifGroupe == false){
		cookieRecherche($_GET["filiere"],$_GET["groupe"],"filiere");
		choixMosaïque($_GET["filiere"], $_GET["groupe"], "dzsWVDlC1wgTgxC4BquZ", "filiere");	
	}else{
		cookieRecherche($_GET["filiere"],$_GET["groupe"],$_GET["choix"]);
		choixMosaïque($_GET["filiere"], $_GET["groupe"], "dzsWVDlC1wgTgxC4BquZ", $_GET["choix"]);	
	}
}else{
	if($verifCookie == true){
		$jasonRecherche = $_COOKIE["recherche"];
		$recherche = json_decode($jasonRecherche, True);
		choixMosaïque($recherche["filiere"], $recherche["groupe"], "dzsWVDlC1wgTgxC4BquZ", $recherche["choix"]);
	}else{
		echo"<img src='images/fleche.png' width='300' height='300' class=\"fleche\"/>";
		echo("<p class=p-mosaique>Aucune donnée n'est traitable pour le moment, faites une premiere recherche pour accédez à la mosaïque des étudiants.</p>");
	}
}
?>

<script src="app.js" meta="utf-8"></script>
<script type="text/javascript">
	function liste_groupe(){
		affiche_Groupe(<?php  echo($jsonText);?>);
	}

	function affiche_Groupe(jsonText){
	    let filiere = document.getElementById("select-filiere").value;
	    let groupe =document.getElementById("select-groupe");

	    groupe.innerHTML = "<option value='Groupe'>Groupe</option>";
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
<?php
}
?>
</body>
</html>
