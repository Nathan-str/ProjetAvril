<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';
include 'include/fonctionInscription.inc.php';
include 'include/fonctionConnexion.inc.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
	<?php
		headeer();
	?>

<h1 class="index-h1">espace administration</h1>

<h2 class="index-h2">Accès à la mosaïque des élèves du département informatique.</h2>

<div class="div-inscription">
<?php
//Fonction affichant le formulaire d'inscription
formulaireInscription();
//Fonction permettant d'afficher les erreur lors de l'inscription.
echo(errorInscription());
?>
</div>

<div class="div-connexion">
<?php
//Fonction affichant le formulaire de la connexion.
formulaireConnexion();
//Fonction permettant d'afficher les erreur lors de la connexion.
echo(errorConnexion());
?>
</div>

<?php
	footeer();
?>

</body>
</html>