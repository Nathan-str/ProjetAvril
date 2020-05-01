<?php
session_start();

include 'fonction.php';

//connexion("fichiers/comptes.csv", "demande.php", "index.php");
connexion1($_POST['login'], $_POST['pwd'], 'fichiers/comptes.csv',"demande.php", "index.php");

?>