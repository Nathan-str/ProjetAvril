<?php
session_start();

include 'fonction.php';

if ($_GET['choose'] == "inscription"){
	inserCle();
}elseif ($_GET['choose'] == "connexion") {
	verifCle();
}else{
	echo"error";
}
//inserCle();
//verifCle();





?>

