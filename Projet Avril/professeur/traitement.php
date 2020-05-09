<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';
include 'include/fonctionMosaique.inc.php';

//Vérifie l'exsitance de la session et affiche la page si elle existe, sinon on renvoie vers l'accueil.
$verifPseudo = verifElement($_SESSION['pseudo']);

//Vérifie tous les éléments tapables.
$verifFiliere = verifElement($_GET["filiere"]);
$verifGroupe = verifElement($_GET["groupe"]);
$verifCookie = verifElement($_COOKIE["recherche"]);

if ($verifPseudo == false){
	header("location:./index.php");
}else{
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="print.css" media="print" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
		<p class="cube-choix-p">Choix</p>
	</div>
	

	<!--<div class="traitement_info">
		<p class="traitement_info_p">Traitement</p>
	</div>-->

	<div class="formulaire-traitement">
		<form action="traitement.php" method="get" class="formulaire-traitement-form">
			<?php
				//Menu déroulant des filières et des groupes.
				filiereJSON("filiere", "groupe");
				$jsonText = jsonText();
			?>
			<input type="submit" class="select-submit" value="Valider" />
		</form>
		<input type="checkbox" name="all_infos" class="all_infos" onclick="clickInfo();" /><p class="all_infos-p">Tout afficher</p>
	</div>



<?php
//Renvoie la mosaïque pour les filières
if ($verifFiliere == true && $_GET["filiere"] != "Filière"){
	if ($_GET["groupe"] == "Groupe" || $verifGroupe == false){
		//Créer un cookie de recherche pour les filières.
		cookieRecherche($_GET["filiere"],$_GET["groupe"],"filiere");
		//Affiche la mosaïque pour les filières.
		choixMosaïque($_GET["filiere"], $_GET["groupe"], "dzsWVDlC1wgTgxC4BquZ", "filiere");	
	}else{
		//Créer un cookie de recherche pour les groupes.
		cookieRecherche($_GET["filiere"],$_GET["groupe"],$_GET["choix"]);
		//Affiche la mosaïque pour les filières.
		choixMosaïque($_GET["filiere"], $_GET["groupe"], "dzsWVDlC1wgTgxC4BquZ", $_GET["choix"]);	
	}
}else{
	if($verifCookie == true){
		$jasonRecherche = $_COOKIE["recherche"];
		$recherche = json_decode($jasonRecherche, True);
		//Si aucun élément est taper, affiche la mosaïque avec les paramètres du cookies.
		choixMosaïque($recherche["filiere"], $recherche["groupe"], "dzsWVDlC1wgTgxC4BquZ", $recherche["choix"]);
	}else{
		//Affiche un message d'erreur si aucun paramètre n'est traitable.
		echo"<img src='images/fleche.png' width='300' height='300' class=\"fleche\"/>";
		echo("<p class=p-mosaique>Aucune donnée n'est traitable pour le moment, faites une premiere recherche pour accédez à la mosaïque des étudiants.</p>");
	}
}
?>

<script src="app.js" meta="utf-8"></script>
<script type="text/javascript">
	//Utilise la fonction pour la liste déroulante en l'appelant.
	//Permet de passer la vérification XML.
	function liste_groupe(){
		affiche_Groupe(<?php  echo($jsonText);?>);
	}

	
</script>
<?php
}
?>
</body>
</html>
