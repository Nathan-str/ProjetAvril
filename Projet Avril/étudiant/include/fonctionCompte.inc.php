<?php
	
	//Fonction permettant de récupérer les infos du fichier comptes
	//Affiche tous les éléments du fichier pour le compte connecté.	
	function comptes(){
		$donnes = fopen('fichiers/comptes.csv', 'r+');

		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 			$ligne = fgets($donnes);
				$tableau = explode(";", $ligne);

			if ($_SESSION['id'] == $tableau[0]){
				$prenom = $tableau[2];
				$nom = $tableau[1];
				$mail = $tableau[3];
				$numero = $tableau[4];
				$filiere = $tableau[7];
				$groupe = $tableau[8];	
			}
			
		}

		echo("<div class=\"wrapper\">");
			echo("<div class=\"left\">");
				Pphoto();
				echo("<h4>" . $prenom . " " . $nom ."</h4>");
				echo("<p>Universitaire</p>");
			echo("</div>");

			echo("<div class=\"right\">");
				echo("<div class=\"info\">");
					echo("<h3>Information</h3>");
					echo("<div class=\"info_data\">");
						echo("<div class=\"data\">");
							echo("<h4>Email</h4>");
							echo("<p>".$mail."</p>");
						echo("</div>");
						echo("<div class=\"data\">");
							echo("<h4>Phone</h4>");
							echo("<p>".$numero."</p>");
						echo("</div>");
					echo("</div>");
				echo("</div");

				echo("<div class=\"projects\">");
					echo("<h3>Classe</h3>");
					echo("<div class=\"projects_data\">");
						echo("<div class=\"data\">");
							echo("<h4>Filière</h4>");
							echo("<p>".$filiere."</p>");
						echo("</div>");
						echo("<div class=\"data\">");
							echo("<h4>Groupe</h4>");
							echo("<p>".$groupe."</p>");
						echo("</div>");
					echo("</div>");
				echo("</div>");

			echo("</div>");

		echo("</div>");
	}


	//Fonction permettant de télécharger une image choisi dans le dossier d'images indiqué (ici celui du site)
	//Les images correspondant aux comptes ayant le même nom, écrase l'ancienne image
	//Fonction utilisé sur la page "informations.php"
	function upload(){
		if(isset($_POST['upload'])){

			$poids = filesize($_FILES['image']['tmp_name']);
			$nom_image = $_SESSION['id'] . ".png";
			if($_FILES['image']['error'] == 4 ){
				$nom_image = "profil_defaut.png";
			}
			$type_image = $_FILES['image']['type'];
			$taille_image = $_FILES['image']['size'];
			$image_tmp_name=$_FILES['image']['tmp_name'];
			$description = $_POST['desc'];


			if ($poids > (300 * 1024) ) {
				header("location:./informations.php?error=1");
			}else{
				move_uploaded_file($image_tmp_name, "images/$nom_image");	
				header("location:./informations.php");
			}
			


			$donnes = fopen('fichiers/comptes.csv', 'r+');
			$informations = array();
			for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
		 		$ligne = fgets($donnes);
		 		$lignes = substr($ligne, 0,-1);
				$tableau = explode(";", $lignes);
				if ($tableau[0] == $_SESSION['id']){
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4] . ";" . $tableau[5] . ";" . $tableau[6] . ";" . $tableau[7] . ";" . $tableau[8] . ";" . $nom_image;
					array_push($informations, $strinformations);
				}else{
					$strinformations = $tableau[0] . ";" . $tableau[1] . ";" . $tableau[2] . ";" . $tableau[3] . ";" . $tableau[4] . ";" . $tableau[5] . ";" . $tableau[6] . ";" . $tableau[7] . ";" . $tableau[8] . ";" . $tableau[9];
					array_push($informations, $strinformations);
				}
			}
			fclose($donnes);

			$donnes = fopen('fichiers/comptes.csv', 'w');

			for ($i=0;$i<sizeof($informations);$i++){
				fputs($donnes, $informations[$i] . "\n");
			}
			fclose($donnes);
		}
	}

	//Fonction affichant l'image correspondant à l'utilisateur (par le nom de l'image étant l'ID)
	//Fonction utilisé pour la page "informations.php"
	function Pphoto(){
		
		$erreur = $_FILES['image']['error'];
		$donnes = fopen('fichiers/comptes.csv', 'r+');

		for ($i=0;$i<sizeof(file("fichiers/comptes.csv"));$i++){
	 		$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);

			if ($tableau[0] == $_SESSION["id"]){
				$nom_image = $tableau[9];
			}
		}

		echo"<img src='images/$nom_image' width='120' alt=\"error\" />";
		
	}

	//Fonction permettant d'afficher un message d'erreur si le nouveau email indiqué ou le nouveau numéro indiqué existe déjà
	//Fonction permettant d'afficher si la photo est trop lourde
	//Fonction utilisé sur la page "informations.php"
	function erreur(){
		error("1", "L'image est trop lourde (+300ko) !");
		error("2", "L'email ou le numero existe déjà' !");
		error("3", "Le numéro existe déjà' !");
	}

?>