<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';
include 'include/fonctionCle.inc.php';
include 'include/fonctionApi.inc.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>API</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="app.js"></script>
</head>
<body>
	<?php
		headeer();
	?>

<h1 class="h1-key">Utilisation de l'API</h1>

<div class="inscription-cle-api">
	<form action="cle.php" method="get">
		<label class="demande-cle-label">Demande de clé</label>
		<input type="radio" name="choose" onclick="changement();" id="choix1" value="inscription" checked="" />
		<label class="demande-cle-label">Voir clé</label>
		<input type="radio" name="choose" onclick="changement();" id="choix2" value="connexion"/>

		<input type="email" name="mail" placeholder="Adresse mail" id="Imail" class="form-cle-api" style='display:block;'/>
		<input type="password" name="pwd" placeholder="Mot de passe" id="Ipwd" class="form-cle-api" minlength="6" style='display:block;'/>
		<input type="password" name="pwd1" placeholder="Confirmation mot de passe" id="Ipwd1" minlength="6" class="form-cle-api" style='display:block;'/>
		<input type="submit" value="Demander clé" id="Isubmit" class="form-cle-api-submit-demande" style='display:block;'/>

		<input type="email" name="key-mail" placeholder="Adresse mail" id="Cmail" class="form-cle-api" style='display:none;'/>
		<input type="password" name="key-pwd" placeholder="Mot de passe" id="Cpwd" minlength="6" class="form-cle-api" style='display:none;'/>
		<input type="submit" value="Voir clé" id="Csubmit" class="form-cle-api-submit-voir" style='display:none;'/>
	</form>

	<?php
	errorConnexionCle();
	?>
</div>


<div class="documentation">
	<h2 class="h2-documentation">Documentation de l'API</h2>

	<h3 class="h3-documentation">Les informations dans l'API</h3>

	<p class="p-documentation">L'API possède diverses informations qui servent à être traitées, les informations sont les suivantes:</p>
	<table>
		<tr>
			<td>Filière</td>
			<td>Groupe</td>
			<td>Nom</td>
			<td>Prénom</td>
			<td>Mail</td>
			<td>Numéro</td>
			<td>Image de profil</td>
			<td>ID</td>
		</tr>
	</table>

	<h3 class="h3-documentation">La requête en JSON</h3>
	<p class="p-documentation">La requête de l'API est renvoyé un JSON afin d'avoir une meilleur utilisation</p>
	<p class="p-documentation">Pour l'utiliser par exemple (en PHP): </p>
	<ul>
		<li class="p-documentation"><p>file_get_contents(URL);</p></li>
		<li class="p-documentation"><p>json_decode();</p></li>
	</ul>
	
	<p class="p-documentation">Pour avoir accès à l'API, il existe différentes manière d'y accéder.</p>

	<h3 class="h3-documentation">Par Filière:</h3>
	<p class="p-documentation">Pour accéder à l'API de toutes une filière, il faut suivre le chemin suivant:</p>
	<ul><li class="p-documentation"><a href="http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=/nom_filiere/&cle=/cleAPI/">http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere=/nom_filiere/&cle=/cleAPI/</a></li></ul>
	<p class="p-documentation">Il faut donc indiquer, notre choix, la filière souhaité, la clé d'API fournie</p>
	<p class="p-documentation">Exemple: </p>
	<ul>
		<li class="p-documentation"><p>/nom_filiere/ = LPI-RIWS</p></li>
		<li class="p-documentation"><p>/cleAPI/ = fdsds65fsd65fsdfdsf</p></li>
	</ul>

	<h3 class="h3-documentation">Par Groupe:</h3>
	<p class="p-documentation">Pour accéder à l'API d'un groupe spécifique, il faut suivre le chemin suivant:</p>
	<ul><li class="p-documentation"><a href="http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere=/nom_filiere/&choix=groupe&groupe=/nom_groupe/&cle=/cleAPI/">http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere=/nom_filiere/&choix=groupe&groupe=/nom_groupe/&cle=/cleAPI/</a></li></ul>
	<p class="p-documentation">Il faut donc indiquer, notre choix, la filière souhaité, le groupe correspondant à la filière et la clé d'API fournie</p>
	<p class="p-documentation">Exemple: </p>
	<ul>
		<li class="p-documentation"><p>/nom_filiere/ = L1-MIPI</p></li>
		<li class="p-documentation"><p>/nom_groupe/ = A1</p></li>
		<li class="p-documentation"><p>/cleAPI/ = fdsds65fsd65fsdfdsf</p></li>
	</ul>

	<h3 class="h3-documentation">Construction de l'API</h3>

	<ul>
		<li class="p-documentation"><p>Filière:</p></li>
		 <ul><li class="p-documentation"><p>Groupe:</p></li>
		 	<ul><li class="p-documentation"><p>NBR</p></li>
		 		<ul><li class="p-documentation"><p>Nom</p></li>
		 			<li class="p-documentation"><p>Prénom</p></li>
		 			<li class="p-documentation"><p>Mail</p></li>
		 			<li class="p-documentation"><p>Numéro</p></li>
		 			<li class="p-documentation"><p>ID</p></li>
		 			<li class="p-documentation-end"><p>Image</p></li>
		 		</ul>
		 	</ul>
		 </ul>
	</ul>
	<p class="p-documentation">*L'API est limitée à 20 utilisations par heure pour chaque clé.</p>
</div>

<?php
footeer();
?>

<script>
	function changement(){

		$choix1 = document.getElementById("choix1");
		$choix2 = document.getElementById("choix2");
		
		$Imail = document.getElementById("Imail");
		$Ipwd = document.getElementById("Ipwd");
		$Ipwd1 = document.getElementById("Ipwd1");
		$Isubmit = document.getElementById("Isubmit");

		$Cmail = document.getElementById("Cmail");
		$Cpwd = document.getElementById("Cpwd");
		$Csubmit = document.getElementById("Csubmit");

		if (choix1.checked){

			$Imail.style.display = "block";
			$Ipwd.style.display = "block";
			$Ipwd1.style.display = "block";
			$Isubmit.style.display = "block";
			$Cmail.style.display = "none";
			$Cpwd.style.display = "none";
			$Csubmit.style.display = "none";

		}else if (choix2.checked) {

			$Imail.style.display = "none";
			$Ipwd.style.display = "none";
			$Ipwd1.style.display = "none";
			$Isubmit.style.display = "none";
			$Cmail.style.display = "block";
			$Cpwd.style.display = "block";
			$Csubmit.style.display = "block";

		}	
	}
	
</script>

</body>
</html>