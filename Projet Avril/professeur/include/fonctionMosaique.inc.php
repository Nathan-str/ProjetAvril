<?php
	
	//Renvoie d'un booléen selon le choix indiquer.
	function choix($get){
		if($get == "filiere"){
			$choix = true;
		}else{
			$choix = false;
		}
		return $choix;
		
	}

	//Fonction permettant de créer un cookie avec les paramètres de recherches.
	function cookieRecherche($filiere,$groupe,$choix){
		$recherche["filiere"] = $filiere;
		$recherche["groupe"] = $groupe;
		$recherche["choix"] = $choix;
		$jasonRecherche = json_encode($recherche);
		setcookie("recherche", $jasonRecherche);
	}

	//Fonction permettant de renvoyer des affichages de la mosaïque selon les conditions.
	function ChoixMosaïque($filiere,$groupe,$cle,$choix){

		$choose = choix($choix);
		$jsonArray = array();
		$cpt = 0;
		

			//Si la filière est sélectionnée.
			if ($choose == true){

				//Récupère l'URL de l'API pour les filières.
				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere='.$filiere.'&cle=' .$cle);
				//Decode le JSON pour les manipuler comme des tableaux.
				$jsonArray = json_decode($jsonText,True);

				//Si la clé n'est pas épuisé, c-à-dire que le message d'erreur correspondant n'existe pas.
				if (!isset($jsonArray["Error"])){

					echo("<h1 class=\"en-tete-filiere\">Elèves de la filière " . $filiere . ":</h1>");

					echo("<form>");
						//Bouton permettant d'imprimer la page.
						echo("<input type=\"button\" class=\"impression-filiere\" value=\"Imprimer la page\" onClick=\"window.print()\" />");
					echo("</form>");

					for ($i=1; $i <= sizeof($jsonArray["$filiere"]); $i++){

						$cpt += 1;

						//Les différentes informations de l'élèves.
						echo("<div class=\"profil\">");
						echo("<img src=\"http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"][$i]['image'] . "\" width=\"200\" height=\"200\" style=\"border-radius:10px;\" alt=\"error\" class=\"image\" onclick=\"clickImage($i);\" /><br />");
						echo "<p>".$jsonArray["$filiere"][$i]['prenom'] . " " . $jsonArray["$filiere"][$i]['nom'] . "</p><br />";
						echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"][$i]['mail'] . "<br />". $jsonArray["$filiere"][$i]['numero'] . "</p><br />";
						echo("</div>");	

					}
				}else{
					//Fonction affichant un message si la clé est épuisé.
					messageErreurCle();
				}

				

			}else{

				
				//URL correspondant à l'API pour les groupes.
				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
				$jsonArray = json_decode($jsonText,True);

				//Si la clé n'est pas épuisé, c-à-dire que le message d'erreur correspondant n'existe pas.
				if (!isset($jsonArray["Error"])){

					echo("<h1 class=\"en-tete-groupe\">Elèves du groupe " . $groupe . " de la filière " . $filiere . ":</h1>");

					echo("<form>");
						echo("<input type=\"button\" class=\"impression-groupe\" value=\"Imprimer la page\" onClick=\"window.print()\" />");
					echo("</form>");

					for ($i=1; $i <= sizeof($jsonArray["$filiere"]["$groupe"]); $i++){

						$cpt += 1;


						echo("<div class=\"profil\">");
						echo("<img src=\"http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"]["$groupe"][$i]['image'] . "\" width=\"200\" height=\"200\" style=\"border-radius:10px;\" alt=\"error\" class=\"image\" onclick=\"clickImage($i);\" /><br />");
						echo "<p>".$jsonArray["$filiere"]["$groupe"][$i]['prenom'] . " " . $jsonArray["$filiere"]["$groupe"][$i]['nom'] . "</p><br />";
						echo "<p class=\"info\" id=\"$i\" style=\"display: none;\">".$jsonArray["$filiere"]["$groupe"][$i]['mail'] . "<br />". $jsonArray["$filiere"]["$groupe"][$i]['numero'] . "</p><br />";
						echo("</div>");	

					}
				}else{
					messageErreurCle();
				}

				

			}
	}

	//Fonction permettant d'afficher un message si la clé est épuisé pour l'heure.
	function messageErreurCle(){
		echo("<div class=\"cle-epuise\">");
		echo("<h1 class=\"h1-cle-epuise\">Erreur</h1>");
		echo("<p class=\"p-cle-epuise\">La mosaïque a trop été utilisée !</p>");
		echo("<p class=\"p-cle-epuise\">Réessayez l'heure suivante !</p>");
		echo("</div>");
	}


	

?>