<?php
session_start();

include 'fonction.php';

formulaireInscription();
echo(errorInscription());

formulaireConnexion();
echo(errorConnexion());

?>