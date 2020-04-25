<?php





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