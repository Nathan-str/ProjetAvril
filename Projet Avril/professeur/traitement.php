<?php
session_start();
//$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=LPI-RIWS&cle=hbtKnCWKocRDeTDSkijK');
//$jsonArray = json_decode($jsonText,True);
//print_r($jsonArray['LPI-RIWS']['E3']['13']['prenom']);//Exemple: $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']

//function genereEleve(){

//}

include 'fonction.php';

verifSession($_SESSION['pseudo']);

function mosaique(){
	$filiere = $_GET['filiere'];
	$groupe = $_GET['groupe'];
	$cle = "dzsWVDlC1wgTgxC4BquZ";

	if ($_GET['choix'] == "filiere"){
		if (!empty($cle)){
			$jsonArray = array();
			$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere='.$filiere.'&cle=' .$cle);
			$jsonArray = json_decode($jsonText,True);
			$cpt = 0;

			echo("<h1 class=en-tete-filiere>Elèves de la filière " . $filiere . ":</h1>");

			echo("<form>");
				echo("<input type=\"button\" class=\"impression-filiere\" value=\"Imprimer la page\" onClick=\"window.print()\">");
			echo("</form>");

			for ($i=1; $i <= sizeof($jsonArray["$filiere"]); $i++){ //A mettre plus tard le sizeof du post voulu
			//<img src=$jsonArray['$_POST[filiere]']['$_POST[groupe]']['id']['image']
				$cpt += 1;
				echo("<div class=profil>");
				echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"][$i]['image'] . "width=170 height=170 style=border-radius:10px; alt=error class=image onclick=\"clickImage($i)\";><br />");
				echo "<p>" . $jsonArray["$filiere"][$i]['prenom'] . " " . $jsonArray["$filiere"][$i]['nom'] . "</p><br />";
				echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"][$i]['mail'] . "<br />". $jsonArray["$filiere"][$i]['numero'] . "</p><br />";
				echo("</div>");
				
			}
		}else{
			header("location:./demande.php?error=1");
		}
		
	}else{

		if(!empty($groupe)){
			if (isset($cle)){

				$recherche["filiere"] = $filiere;
				$recherche["groupe"] = $groupe;
				$recherche["cle"] = $cle;
				$jasonRecherche = json_encode($recherche);
				setcookie("recherche", $jasonRecherche);

				$jsonArray = array();
				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
				$jsonArray = json_decode($jsonText,True);
				$cpt = 0;

				echo("<h1 class=en-tete-groupe>Elèves du groupe " . $groupe . " de la filière " . $filiere . ":</h1>");

				echo("<form>");
					echo("<input type=\"button\" class=\"impression-groupe\" value=\"Imprimer la page\" onClick=\"window.print()\">");
				echo("</form>");

				for ($i=1; $i <= sizeof($jsonArray["$filiere"]["$groupe"]); $i++){
					$cpt += 1;
					echo("<div class=profil>");
					echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"]["$groupe"][$i]['image'] . "width=200 height=200 style=border-radius:10px; alt=error class=image onclick=\"clickImage($i)\";><br />");
					echo "<p>".$jsonArray["$filiere"]["$groupe"][$i]['prenom'] . " " . $jsonArray["$filiere"]["$groupe"][$i]['nom'] . "</p><br />";
					echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"]["$groupe"][$i]['mail'] . "<br />". $jsonArray["$filiere"]["$groupe"][$i]['numero'] . "</p><br />";
					echo("</div>");

					

				}
			}else{
				header("location:./demande.php?error=1");
			}
		}else{
			header("location:./demande.php?error=2");
		}
	}
}




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

<?php
mosaique();
?>

<script src="app.js" meta="utf-8"></script>
</body>
</html>
