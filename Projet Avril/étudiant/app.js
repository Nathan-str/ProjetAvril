//Effectue les modifications si les éléments indiqués sont ouverts
//Utiliser pour le menu burger.
$('.nav-toggle').click(function(e){
	e.preventDefault();
	$('.droite').toggleClass('is-open');
	$('.nav-toggle').toggleClass('is-open');
})

$('.toggle-connexion').click(function(e){
	e.preventDefault();
	$('.formulaire').toggleClass('is-open');
	$('.toggle-connexion').toggleClass('is-open');
})

$('.toggle-inscription').click(function(e){
	e.preventDefault();
	$('.formulaire_inscription').toggleClass('is-open');
	$('.toggle-inscription').toggleClass('is-open');
})

$('.toggle-traitement').click(function(e){
	e.preventDefault();
	$('.formulaire-traitement').toggleClass('is-open');
	$('.toggle-traitement').toggleClass('is-open');
})


//-------------------------------------------------------------------------------------------

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

	//-----------------------------------------------------

	//Ouvre le fichier JSON des filières (plus utile)
	function filiereJSON(){
		let request = new XMLHttpRequest();
		let fichier = "fichiers/filiere.json";
		request.open("GET", fichier, true);
		request.send();
		let filieres = JSON.parse(request.response);
	}


	//Fonction permettant de varier la liste des groupes du JSON des filières selon la filière sélectionnée.
	function affiche_Groupe(jsonText){
	    let filiere = document.getElementById("select-filiere").value;
	    let groupe =document.getElementById("select-groupe");

	    groupe.innerHTML = "<option value=''>Groupe</option>";
			
		for (var i = 0; i < jsonText["listeFilieres"].length; i++) {
			if (filiere == jsonText["listeFilieres"][i]["nomFiliere"]) {
				for (var j = 0; j < jsonText["listeFilieres"][i]["groupes"].length; j++) {
				
					groupe.innerHTML += "<option value=" + jsonText["listeFilieres"][i]["groupes"][j] + ">" + jsonText["listeFilieres"][i]["groupes"][j] + "</option>";

				}
			}
		}
	}

	

