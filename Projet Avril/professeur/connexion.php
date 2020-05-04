<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionConnexion.inc.php';

//connexion("fichiers/comptes.csv", "demande.php", "index.php");
connexion1($_POST['login'], $_POST['pwd'], 'fichiers/comptes.csv',"traitement.php", "index.php");

?>