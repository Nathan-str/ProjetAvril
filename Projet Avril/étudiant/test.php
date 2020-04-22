<?php
	session_start();

	function alea() {
	    $chn = '';
	    for ($i=1;$i<=6;$i++){
	        $chn = chr(floor(rand(0, 25)+97));
	        return $chn;
	    }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Uploading images</title>
</head>
<body>



	<form accept="test.php" method="post" enctype="multipart/form-data">
		Select Image:<input type="file" name="image"><br />
		Description:<input type="text" name="desc"><br />
		<input type="submit" name="upload" value="Upload Now">
	</form>

	<?php
			$mot_de_passe = "bonjour";
			$car_alea = alea();
			$R = $car_alea . $mot_de_passe;
			echo($R);

		/*if(isset($_POST['upload'])){
			$nom_image = $_FILES['image']['name'];
			$type_image = $_FILES['image']['type'];
			$taille_image = $_FILES['image']['size'];
			$image_tmp_name=$_FILES['image']['tmp_name'];
			$description = $_POST['desc'];
			setcookie ("image", $nom_image, time() + $temps);

			move_uploaded_file($image_tmp_name, "images/$nom_image");
			echo"<img src='images/$nom_image' width='400' height='250'><br>$description";

			$donnes = fopen('fichiers/images.csv', 'a+');
			fputs($donnes, $_SESSION['pseudo'] . ";" . $nom_image . "\n");
			fclose($donnes);
		}

		$donnes = fopen('fichiers/images.csv', 'r+');


		for ($i=0;$i<sizeof(file("fichiers/images.csv"));$i++){
 			$ligne = fgets($donnes);
			$tableau = explode(";", $ligne);

			if ($tableau[0] == $_SESSION["pseudo"]){
				$nom_image = $tableau[1];
				echo"<img src='images/$nom_image' width='400' height='250'><br>$description";
			}
		}*/


	?>


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
</body>
</html>