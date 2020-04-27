<?php

$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=LPI-RIWS&cle=hbtKnCWKocRDeTDSkijK');
$jsonArray = json_decode($jsonText,True);
print_r($jsonArray['LPI-RIWS']['E3']['13']['prenom']);//Exemple: $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']

//if (isset($_POST['filiere'])){
	//$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=LPI-RIWS&cle=hbtKnCWKocRDeTDSkijK');
	//$jsonArray = json_decode($jsonText,True);
	//print_r($jsonArray['LPI-RIWS']['E3']['13']['prenom']);//Exemple: $jsonArray['$_POST[filiere]']['$_POST[groupe]']['id(pas sur)']['prenom']
	//for  sizeof(taille du groupe){
	//<img src=$jsonArray['$_POST[filiere]']['$_POST[groupe]']['id']['image']
	//echo $jsonArray['$_POST[filiere]']['groupe']['id(pas sur)']['prenom']
	//}
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