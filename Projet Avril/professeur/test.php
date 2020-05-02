<?php

$filiere = "LPI-RIWS";
$groupe = "E1";
$cle = "U0UWfUlUhxvmOg1HTZZQ";


$jsonArray = array();
$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
$jsonArray = json_decode($jsonText,True);



for ($i=1; $i <= sizeof($jsonArray["$filiere"]["$groupe"]); $i++){
	$cpt += 1;
	echo("<div class=profil>");
	echo("<img src=http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"]["$groupe"][$i]['image'] . "width=200 height=200 style=border-radius:10px; alt=error class=image onclick=\"clickImage($i)\";><br />");
	echo "<p>".$jsonArray["$filiere"]["$groupe"][$i]['prenom'] . " " . $jsonArray["$filiere"]["$groupe"][$i]['nom'] . "</p><br />";
	echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"]["$groupe"][$i]['mail'] . "<br />". $jsonArray["$filiere"]["$groupe"][$i]['numero'] . "</p><br />";
	echo("</div>");

					

}


?>