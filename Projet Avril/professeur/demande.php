<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>


<div id="formulaire-API">
	<p>Accédez à l'API</p>
	<form action="traitement.php" method="post" class="formulaire-API1">

		<input type="radio" name="choix" onclick="change()" value="filiere" id="choice" checked="" />Filière
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L1-MIPI" checked="" value="L1-MIPI" />L1-MIPI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L2-MI" value="L2-MI" />L2-MI
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="L3-I" value="L3-I" />L3-I
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LP-RS" value="LP RS" />LP-RS
		<input class="filiere" type="radio" onclick="selection()" name="filiere" id="LPI-RIWS" value="LPI-RIWS" />LPI-RIWS

		<input type="radio" name="choix" onclick="change()" id="choice1" value="groupe" />Groupe
		<select name="groupe" id="groupe" style='display:none;'>
			<option id="A1" style='display:none;'>A1</option>
			<option id="A2" style='display:none;'>A2</option>
			<option id="A3" style='display:none;'>A3</option>
			<option id="B1" style='display:none;'>B1</option>
			<option id="B2" style='display:none;'>B2</option>
			<option id="B3" style='display:none;'>B3</option>
			<option id="C1" style='display:none;'>C1</option>
			<option id="C2" style='display:none;'>C2</option>
			<option id="C3" style='display:none;'>C3</option>
			<option id="D1" style='display:none;'>D1</option>
			<option id="D2" style='display:none;'>D2</option>
			<option id="D3" style='display:none;'>D3</option>
			<option id="E1" style='display:none;'>E1</option>
			<option id="E2" style='display:none;'>E2</option>
			<option id="E3" style='display:none;'>E3</option>
		</select>

		<input type="text" name="cle" placeholder="Clé API" />
		<input class="form-cle-api" type="submit" value="Valider">
	</form>


</div>
<script src="app.js" meta="utf-8"></script>


<p>Bonjour</p>


</body>
</html>

