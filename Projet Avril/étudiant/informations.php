<?php
session_start();

include 'include/fonction.php';
include 'include/pageElement.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title>API</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
	
	<?php
		headeer();
	?>

	<div class="page-wrapper">
		<h1 class="h1-info">Informations du compte</h1>

		<!--<input type="file" name="input-image" id="input-image" accept=".jpg, .jpeg, .png"  multiple />
		<div class="image-pre" id="imagePre">
			<img src="" alt="Photo de profil" class="image-preview__image" />
			<span class="image-preview__texte">Photo de profil</span>
		</div>-->
		<div class="position-info">
			<?php
				upload();
				Pphoto();
			?>

			<form accept="test.php" method="post" enctype="multipart/form-data">
				<p class="modification-image">Modifier l'image(170x170): </p> <input type="file" name="image" accept=".jpg, .jpeg, .png" class="modification-image" multiple><br />
				<input type="submit" name="upload" value="Changez la photo" id="input-image" class="modification-image">
			</form>


			<?php
				comptes();
			?>


			<!--<div class="checkbox-info">
				<input id="oldnom" type="checkbox" onclick="changeNom()" name="change-nom" class="checkbox-style" />Modification du nom 
				<input id="oldprenom" type="checkbox" onclick="changePrenom()" name="change-prenom" class="checkbox-style" />Modification du prénom 
				<input id="oldmail" type="checkbox" onclick="changeMail()" name="change-mail" class="checkbox-style" />Modification du mail 
				<input id="oldnumero" type="checkbox" onclick="changeNumero()" name="change-numero" class="checkbox-style" />Modification du numéro 
				<input id="oldmdp" type="checkbox" onclick="changeMdp()" name="change-mdp" class="checkbox-style" />Modification du mot de passe
				<input id="oldfiliere" type="checkbox" onclick="changeFiliere()" name="change-filiere" class="checkbox-style" />Modification de la filière et du groupe


			</div>-->

			<div class="formulaire-changement">

				<h2>Changer ses informations:</h2>

				<form action="changement.php" method="post">
					<input id="chg-nom" type="text" name="new-nom" class="new-form" minlength="3" placeholder="Nouveau nom" />
					<input id="chg-prenom" type="text" name="new-prenom" class="new-form" minlength="3" placeholder="Nouveau prénom" />
					<input id="chg-mail" type="email" name="new-mail" class="new-form" placeholder="Nouvelle adresse mail" />
					<input id="chg-numero" type="text" name="new-numero" class="new-form" minlength="10" maxlength="10" placeholder="Nouveau numéro" />
					<input id="chg-mdp" type="password" name="new-mdp" class="new-form" minlength="6" placeholder="Nouveau mot de passe" />
					<p id="chg-picture"></p>
					<p>*Pour changer sa filiere, il faut aussi préciser le groupe</p>
					<?php
						filiereJSON("new-filiere", "new-groupe");
						$jsonText = jsonText();
					?>
					
					<!--<select id="chg-filiere" name="new-filiere" class="new-form" onchange="adaptationFilière()">
						<option id="L1-MIPI">L1-MIPI</option>
						<option id="L2-MI">L2-MI</option>
						<option id="L3-I">L3-I</option>
						<option id="LP-RS">LP-RS</option>
						<option id="LPI-RIWS">LPI-RIWS</option>
					</select>

					<select id="chg-groupe" name="new-groupe" class="new-form">
						<option id="A1" style="display: block;">A1</option>
						<option id="A2" style="display: block;">A2</option>
						<option id="A3" style="display: block;">A3</option>
						<option id="B1" style="display: none;">B1</option>
						<option id="B2" style="display: none;">B2</option>
						<option id="B3" style="display: none;">B3</option>
						<option id="C1" style="display: none;">C1</option>
						<option id="C2" style="display: none;">C2</option>
						<option id="C3" style="display: none;">C3</option>
						<option id="D1" style="display: none;">D1</option>
						<option id="D2" style="display: none;">D2</option>
						<option id="D3" style="display: none;">D3</option>
						<option id="E1" style="display: none;">E1</option>
						<option id="E2" style="display: none;">E2</option>
						<option id="E3" style="display: none;">E3</option>
					</select>-->

					<input id="chg-submit" type="submit" value="Valider" />

				</form>

			</div>

			<?php
			erreur();
			?>

		</div>

	</div>

	<script src="app.js" meta="utf-8"></script>
	<script type="text/javascript">
	function liste_groupe(){
		affiche_Groupe(<?php  echo($jsonText);?>);
	}

	function affiche_Groupe(jsonText){
	    let filiere = document.getElementById("select-filiere").value;
	    let groupe =document.getElementById("select-groupe");

	    groupe.innerHTML = "<option value=''>Groupe</option>";
	    //for (let groupe in jsonText["listeFilieres"]){
	    //    groupe.innerHTML += `<option value='${jsonText["listeFilieres"]["0"]}'>${jsonText["listeFilieres"]["0"]}</option>`;
	    //}
			
		for (var i = 0; i < jsonText["listeFilieres"].length; i++) {
			if (filiere == jsonText["listeFilieres"][i]["nomFiliere"]) {
				for (var j = 0; j < jsonText["listeFilieres"][i]["groupes"].length; j++) {
				
					groupe.innerHTML += "<option value=" + jsonText["listeFilieres"][i]["groupes"][j] + ">" + jsonText["listeFilieres"][i]["groupes"][j] + "</option>";

				}
			}
		}
	}
	</script>


	<?php
		footeer();
	?>

</body>
</html>