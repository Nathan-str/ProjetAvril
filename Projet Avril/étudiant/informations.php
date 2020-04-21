<?php
session_start();

function comptes(){
	$donnes = fopen('fichiers/comptes.csv', 'r+');

	for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 	$ligne = fgets($donnes);
		$tableau = explode(";", $ligne);

		if ($_SESSION['pseudo'] == $tableau[2]){
			
			echo("<p>Prénom: " . $tableau[1]."</p>");
			echo("<p>Nom: " . $tableau[0]."</p>");
			echo("<p>Adresse mail: " . $tableau[2]."</p>");
			echo("<p>Filière: " . $tableau[5] . "</p>");
			echo("<p>Groupe: " . $tableau[6] . "</p>");
		}
		
	}
}

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
	<header role="header" >	
			<nav class="menu" role="navigation">
				<div class="inner">
					<div class="gauche">
						<a class="logo" href="redirection.php">API etudiant</a>
					</div>

					<div class="droite">
						<a href="#" class="lien"><i class='fa fa-key'></i> GET A KEY</a>
						<!--<a href="#" class="lien"><i class="fa fa-globe"></i> A propos</a>-->
						<a href="#" class="lien"><i class="fa fa-address-card-o"></i> Contact</a>
						<?php
							if(isset($_SESSION['pseudo'])){
						?>
								<a href="#" class="lien"><i class="fa fa-drivers-license"></i> Compte</a>
								<a href="deconnexion.php" class="lien"><i class="fa fa-sign-out"></i> Déconnexion</a>
						<?php
							}
						?>
					</div>

					<div class="nav-toggle">
						<span class="toggle-icons"></span>
					</div>

					<!--<div class="toggle-connexion">
						<i class="fa fa-sign-in" style="font-size:36px"></i>
						<span class="connexion-icon"></span>
					</div>

					<div class="formulaire">
						<form action="connexion.php" method="post">
							<input class="inputt" type="text" name="login" placeholder="Login" required="required" />
							<input class="inputt" type="password" name="pwd" placeholder="Password" required="required" />
							<input class="inputt" type="submit" value="confirm" />
						</form>
						<?php
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
						?>
					</div>-->
				</div>
			</nav>
	</header>

	<div class="page-wrapper">
		<h1 class="h1-info">Informations du compte</h1>
		<?php
			comptes();
		?>

		<div class="checkbox-info">
			<input id="oldnom" type="checkbox" onclick="changeNom()" name="change-nom" />Modification du nom 
			<input id="oldprenom" type="checkbox" onclick="changePrenom()" name="change-prenom" />Modification du prénom 
			<input id="oldmail" type="checkbox" onclick="changeMail()" name="change-mail" />Modification du mail 
			<input id="oldnumero" type="checkbox" onclick="changeNumero()" name="change-numero" />Modification du numéro 
			<input id="oldmdp" type="checkbox" onclick="changeMdp()" name="change-mdp" />Modification du mot de passe
			<input id="oldphoto" type="checkbox" name="change-photo" />Modification de la photo de profil
		</div>

		<form action="#" method="post">
			<input id="chg-nom" type="text" name="new-nom" placeholder="Nouveau nom" style='display:none;' />
			<input id="chg-prenom" type="text" name="new-prenom" placeholder="Nouveau prénom" style='display:none;' />
			<input id="chg-mail" type="text" name="new-mail" placeholder="Nouvelle adresse mail" style='display:none;' />
			<input id="chg-numero" type="text" name="new-numero" placeholder="Nouveau numéro" style='display:none;' />
			<input id="chg-mdp" type="text" name="new-mdp" placeholder="Nouveau mot de passe" style='display:none;' />
			<p id="chg-picture"></p>
		</form>

		


	</div>

	<script>

		var oldnom = document.getElementById("oldnom");
		var oldprenom = document.getElementById("oldprenom");
		var oldmail = document.getElementById("oldmail");
		var oldnumero = document.getElementById("oldnumero");
		var oldmdp = document.getElementById("oldmdp");
		var oldphoto = document.getElementById("oldphoto");

		var nom = document.getElementById("chg-nom");
		var prenom = document.getElementById("chg-prenom");
		var mail = document.getElementById("chg-mail");
		var numero = document.getElementById("chg-numero");
		var mdp = document.getElementById("chg-mdp");
		var photo = document.getElementById("chg-picture");

		function changeNom(){
			if (oldnom.checked){
				nom.style.display = "block";
			}else{
				nom.style.display = "none";
			}	
		}	

		function changePrenom(){
			if (oldprenom.checked) {
				prenom.style.display = "block";
			}else{
				prenom.style.display = "none";
			}	
		}

		function changeMail(){
			if (oldmail.checked) {
				mail.style.display = "block";
			}else{
				mail.style.display = "none";
			}	
		}

		function changeNumero(){
			if (oldnumero.checked) {
				numero.style.display = "block";
			}else{
				numero.style.display = "none";
			}
		}	

		function changeMdp(){
			if (oldmdp.checked) {
				mdp.style.display = "block";
			}else{
				mdp.style.display = "none";
			}
		}

	</script>

	<footer class="le_footer">
		<div class="contenue">
			<div class="footer-section about">
				<h1>Projet</h1>
				<p>Bonjour</p>
			</div>
			<div class="footer-section links">
				<p>Liens</p>
			</div>
			<div class="footer-section contact-form">
				<p><i class="fa fa-address-card-o"></i> Contacts</p>
			</div>
		</div>

		<div class="fond">
			<p>Site réalisé par Nathan Sestre</p>
		</div>	
	</footer>

</body>
</html>