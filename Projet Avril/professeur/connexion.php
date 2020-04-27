<?php
session_start();

include 'fonction.php';

connexion("fichiers/comptes.csv", "index.php", "index.php");

?>