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
	$('.cube-choix').toggleClass('is-open');
})
//----------------------------------------------


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


	//Fonction permettant d'afficher les infos ou non si on clique sur une image d'un étudiant.
	function clickImage(id){
		
		var informations = document.getElementById(id);

		if(informations.style.display == "none"){
			informations.style.display ="block";
		}else{
			informations.style.display ="none";
		}		
		
	}

	//Fonction permettant d'afficher toutes les infos ou non si on clique sur la checkbox.
	function clickInfo(){
		var infos = document.getElementsByClassName("info");

		for (i=0;i<infos.length;i++){
			if (infos[i].style.display == "none"){
				infos[i].style.display = "block";
			}else{
				infos[i].style.display = "none";
			}
			
		}
	}


	//-----------------------------------------------------

	$Bfiliere = document.getElementById("choice");
	$Bgroupe = document.getElementById("choice1");

	$L1MIPI = document.getElementById("L1-MIPI");
	$L2MI = document.getElementById("L2-MI");
	$L3I = document.getElementById("L3-I");
	$LPRS = document.getElementById("LP-RS");
	$LPIRIWS = document.getElementById("LPI-RIWS");

	$groupes = document.getElementById("groupe");
	$A1 = document.getElementById("A1");
	$A2 = document.getElementById("A2");
	$A3 = document.getElementById("A3");
	$B1 = document.getElementById("B1");
	$B2 = document.getElementById("B2");
	$B3 = document.getElementById("B3");
	$C1 = document.getElementById("C1");
	$C2 = document.getElementById("C2");
	$C3 = document.getElementById("C3");
	$D1 = document.getElementById("D1");
	$D2 = document.getElementById("D2");
	$D3 = document.getElementById("D3");
	$E1 = document.getElementById("E1");
	$E2 = document.getElementById("E2");
	$E3 = document.getElementById("E3");

	function change(){
		if ($Bfiliere.checked){
			$groupes.style.display = "none";
		}else if ($Bgroupe.checked) {
			$groupes.style.display = "block";
		}
	}

	//Fonction permettant de varier la liste des groupes du JSON des filières selon la filière sélectionnée.
	function affiche_Groupe(jsonText){
	    let filiere = document.getElementById("select-filiere").value;
	    let groupe =document.getElementById("select-groupe");

	    groupe.innerHTML = "<option value='Groupe'>Groupe</option>";
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

