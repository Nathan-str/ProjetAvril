<?php

function inscription(){
	echo("<form action=\"inscription.php\" method=\"post\">");
		echo("<input class=\"input\" type=\"text\" name=\"nom\" minlength=\"3\" placeholder=\"Nom\" required=\"required\" />");
		echo("<input class=\"input\" type=\"text\" name=\"prenom\" minlength=\"3\" placeholder=\"Prénom\" required=\"required\" />") ;
		echo("<input class=\"input\" type=\"email\" name=\"mail\" minlength=\"6\" placeholder=\"****@****.fr\" required=\"required\" />");
		echo("<input class=\"input\" type=\"text\" name=\"numero\" minlength=\"10\" maxlength=\"10\" placeholder=\"Numéro de téléphone\" required=\"required\" />");
		echo("<input class=\"input\" type=\"password\" name=\"mdp\" minlength=\"6\" placeholder=\"Mot de passe\" required=\"required\" />");
		echo("<input class=\"input\" type=\"password\" name=\"mdp1\" minlength=\"6\" placeholder=\"Confirmation mot de passe\" required=\"required\" />");
		echo("<input class=\"submit\" type=\"submit\" value=\"Valider\" />");
	echo("</form>");
}

function connexion(){
	echo("<form action=\"connexion.php\" method=\"post\">");
		echo("<input class=\"input\" type=\"mail\" name=\"login\" minlength=\"6\" placeholder=\"Adresse Mail\" required=\"required\" />");
		echo("<input class=\"input\" type=\"password\" name=\"pwd\" minlength=\"6\" placeholder=\"Password\" required=\"required\" /><br />");
		echo("<input class=\"connexion-submit\" type=\"submit\" value=\"Valider\" />")
	echo("</form>");
}

function errorInscription(){

	if(isset($_GET['error'])){
	if($_GET['error'] == 3){ //2: GET définie dans la page vérifiant les identifiants 
	?>
	<script type="text/javascript">
		alert("Les mots de passes ne sont pas identiques !");
	</script>
	<?php
	}elseif($_GET['error'] == 4){
	?>
	<script type="text/javascript">
		alert("Les mots de passes doivent être de 6 caractères minimum!");
	</script>
	<?php
	}elseif($_GET['error'] == 5){
	?>
	<script type="text/javascript">
		alert("L'adresse mail ou le numéro est déjà utilisé!");
	</script>
	<?php
		}elseif ($_GET['error'] == 0) {
	?>
	<script type="text/javascript">
		alert("Inscription réussi!");
	</script>
	<?php
		}
	}
}

function errorConnexion(){

	if(isset($_GET['error'])){
		if($_GET['error'] == 2){ //2: GET définie dans la page vérifiant les identifiants 
		?>
		<script type="text/javascript">
			alert("Mauvais identifiants !")
		</script>
		<?php
		}elseif ($_GET['error'] == 1) { //1: GET définie dans la page vérifiant les identifiants
		?>
		<script type="text/javascript">
			alert("Veuillez entrer des champs !")
		</script>
		<?php 			
		}
	}

}


?>