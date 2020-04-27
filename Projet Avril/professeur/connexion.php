<?php
session_start();

include 'fonction.php';

connexion("fichiers/comptes.csv", "demande.php", "index.php");

?>