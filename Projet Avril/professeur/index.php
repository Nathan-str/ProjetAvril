<?php
session_start();

include 'fonction.php';
include 'pageElement.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
		headeer();
	?>

<h1 class="index-h1">espace administration</h1>

<h2 class="index-h2">Accès à la mosaïque des élèves du département informatique.</h2>

<div class="div-inscription">
<p class="p-inscription">Inscription</p>
<?php
formulaireInscription();
echo(errorInscription());
?>
</div>

<div class="div-connexion">
<p class="p-connexion">Connexion</p>
<?php
formulaireConnexion();
echo(errorConnexion());
?>
</div>

<?php
	footeer();
?>

</body>
</html>