<?php

//$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=LPI-RIWS&cle=hbtKnCWKocRDeTDSkijK');
//$jsonArray = json_decode($jsonText,True);
//print_r($jsonArray['LPI-RIWS']['E3']['13']['prenom']);//Exemple: $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']

$filiere = $_GET['filiere'];
$groupe = $_GET['groupe'];
$cle = $_GET['cle'];

if ($_GET['choix'] == "filiere"){
	if (!empty($cle)){
		$jsonArray = array();
		$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere='.$filiere.'&cle=' .$cle);
		$jsonArray = json_decode($jsonText,True);
		$cpt = 0;

		for ($i=1; $i <= sizeof($jsonArray["$filiere"]); $i++){ //A mettre plus tard le sizeof du post voulu
		//<img src=$jsonArray['$_POST[filiere]']['$_POST[groupe]']['id']['image']
			$cpt += 1;
			echo("<div class=profil>");
			echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"][$i]['image'] . "width=170 height=170 style=border-radius:10px; alt=error class=image><br />");
			echo $jsonArray["$filiere"][$i]['prenom'] . " " . $jsonArray["$filiere"][$i]['nom'] . "<br />";
			//echo $jsonArray["$filiere"][$i]['mail'] . "<br />";
			//echo $jsonArray["$filiere"][$i]['numero'] . "<br />";
			echo("</div>");
			
		}
	}else{
		header("location:./demande.php?error=1");
	}
	
}else{

	if(!empty($groupe)){
		if (!empty($cle)){

			$recherche["filiere"] = $filiere;
			$recherche["groupe"] = $groupe;
			$recherche["cle"] = $cle;
			$jasonRecherche = json_encode($recherche);
			setcookie("recherche", $jasonRecherche);

			$jsonArray = array();
			$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
			$jsonArray = json_decode($jsonText,True);
			$cpt = 0;

			for ($i=1; $i <= sizeof($jsonArray["$filiere"]["$groupe"]); $i++){
				$cpt += 1;
				echo("<div class=profil>");
				echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"]["$groupe"][$i]['image'] . "width=170 height=170 style=border-radius:10px; alt=error ><br />");
				echo $jsonArray["$filiere"]["$groupe"][$i]['prenom'] . " " . $jsonArray["$filiere"]["$groupe"][$i]['nom'] . "<br />";
				echo $jsonArray["$filiere"]["$groupe"][$i]['mail'] . "<br />";
				echo $jsonArray["$filiere"]["$groupe"][$i]['numero'] . "<br />";
				echo("</div>");

				

			}
		}else{
			header("location:./demande.php?error=1");
		}
	}else{
		header("location:./demande.php?error=2");
	}
}
//}elseif(isset($_POST['groupe'])){
	//$jsonText = file_get_contents('URL pour le groupe');
		//$jsonArray = json_decode($jsonText,True);
		//Exemple: $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']
	//for  sizeof(taille du groupe){
	//<img src=$jsonArray['$_POST[filiere]']['$_POST[groupe]']['id']['image']
	//echo $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']
	//}	
//}
?>

<!DOCTYPE html>
<html>
<head>
	<title>trombinoscope</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

</body>
</html>