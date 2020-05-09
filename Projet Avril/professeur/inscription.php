<?php
session_start();

include 'include/fonction.php';
include 'include/fonctionInscription.inc.php';


inscription1($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["numero"], $_POST["mdp"] , $_POST["mdp1"], 'fichiers/comptes.csv', "fichiers/id.txt","demande.php", "index.php");



?>
