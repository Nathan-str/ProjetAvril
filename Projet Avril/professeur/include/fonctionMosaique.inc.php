<?php

	function choix($get){
		if($get == "filiere"){
			$choix = true;
		}else{
			$choix = false;
		}
		return $choix;
		
	}

	function cookieRecherche($filiere,$groupe,$choix){
		$recherche["filiere"] = $filiere;
		$recherche["groupe"] = $groupe;
		$recherche["choix"] = $choix;
		$jasonRecherche = json_encode($recherche);
		setcookie("recherche", $jasonRecherche);
	}

	function ChoixMosaïque($filiere,$groupe,$cle,$choix){

		$choose = choix($choix);
		$jsonArray = array();
		$cpt = 0;

		//if ($continue == true){

			

			if ($choose == true){

				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?choix=filiere&filiere='.$filiere.'&cle=' .$cle);
				$jsonArray = json_decode($jsonText,True);

				echo("<h1 class=\"en-tete-filiere>Elèves de la filière\" " . $filiere . ":</h1>");

				echo("<form>");
					echo("<input type=\"button\" class=\"impression-filiere\" value=\"Imprimer la page\" onClick=\"window.print()\" />");
				echo("</form>");

				for ($i=1; $i <= sizeof($jsonArray["$filiere"]); $i++){

					$cpt += 1;


					echo("<div class=\"profil\">");
					echo("<img src=\"http://nathan-str-etudiant.alwaysdata.net/images/" . $jsonArray["$filiere"][$i]['image'] . "\" width=\"200\" height=\"200\" style=\"border-radius:10px;\" alt=\"error\" class=\"image\" onclick=\"clickImage($i);\" /><br />");
					echo "<p>".$jsonArray["$filiere"][$i]['prenom'] . " " . $jsonArray["$filiere"][$i]['nom'] . "</p><br />";
					echo "<p class=info id=$i style=\"display: none;\">".$jsonArray["$filiere"][$i]['mail'] . "<br />". $jsonArray["$filiere"][$i]['numero'] . "</p><br />";
					echo("</div>");	

				}

			}else{

				

				$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/apiEtu.php?filiere='. $filiere .'&choix=groupe&groupe='.$groupe .'&cle='.$cle);
				$jsonArray = json_decode($jsonText,True);

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

			}
	}

?>