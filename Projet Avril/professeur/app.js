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
//Fonction pour les checkboxs pour changer les informations:

var oldnom = document.getElementById("oldnom");
		var oldprenom = document.getElementById("oldprenom");
		var oldmail = document.getElementById("oldmail");
		var oldnumero = document.getElementById("oldnumero");
		var oldmdp = document.getElementById("oldmdp");
		var oldfiliere = document.getElementById("oldfiliere");
		var oldgroupe = document.getElementById("oldgroupe");

		var nom = document.getElementById("chg-nom");
		var prenom = document.getElementById("chg-prenom");
		var mail = document.getElementById("chg-mail");
		var numero = document.getElementById("chg-numero");
		var mdp = document.getElementById("chg-mdp");
		var filiere = document.getElementById("chg-filiere");
		var groupe = document.getElementById("chg-groupe");
		var submit = document.getElementById("chg-submit");

		function changeNom(){
			if (oldnom.checked){
				nom.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				nom.style.display = "none";
			}else{
				nom.style.display = "none";
			}	
		}	

		function changePrenom(){
			if (oldprenom.checked) {
				prenom.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				prenom.style.display = "none";
			}else{
				prenom.style.display = "none";
			}	
		}

		function changeMail(){
			if (oldmail.checked) {
				mail.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				mail.style.display = "none";
			}else{
				mail.style.display = "none";
			}	
		}

		function changeNumero(){
			if (oldnumero.checked) {
				numero.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				numero.style.display = "none";
			}else{
				numero.style.display = "none";
			}
		}	

		function changeMdp(){
			if (oldmdp.checked) {
				mdp.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				mdp.style.display = "none";
			}else{
				mdp.style.display = "none";
			}
		}

		function changeFiliere(){
			if (oldfiliere.checked) {
				filiere.style.display = "block";
				groupe.style.display = "block";
				submit.style.display = "block";
			}else if (oldnom.checked == false && oldprenom.checked == false && oldmail.checked == false && oldnumero.checked == false && oldmdp.checked == false && oldfiliere.checked == false) {
				submit.style.display = "none";
				filiere.style.display = "none";
				groupe.style.display = "none";
			}else{
				filiere.style.display = "none";
				groupe.style.display = "none";
			}
		}
//--------------------------------------------------

	function adaptationFilière(){
		$L1MIPI = document.getElementById("L1-MIPI").value;
		$L2MI = document.getElementById("L2-MI").value;
		$L3I = document.getElementById("L3-I").value;
		$LPRS = document.getElementById("LP-RS").value;
		$LPIRIWS = document.getElementById("LPI-RIWS").value;
		$listeFiliere = document.getElementById("chg-filiere").value;
		$listeGroupe = document.getElementById("chg-groupe");

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

		if ($listeFiliere === $L1MIPI){

			$listeGroupe.innerHTML = "<option>A1</option><option>A2</option><option>A3</option>";
		}else if ($listeFiliere === $L2MI) {

			$listeGroupe.innerHTML = "<option>B1</option><option>B2</option><option>B3</option>";
		}else if ($listeFiliere === $L3I) {
			$listeGroupe.innerHTML = "<option>C1</option><option>C2</option><option>C3</option>";
		
		}else if ($listeFiliere === $LPRS) {

			$listeGroupe.innerHTML = "<option>D1</option><option>D2</option><option>D3</option>";
		}else if ($listeFiliere === $LPIRIWS) {

			$listeGroupe.innerHTML = "<option>E1</option><option>E2</option><option>E3</option>";
		}
	}




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

	function clickImage(id){
		
		var informations = document.getElementById(id);

		if(informations.style.display == "none"){
			informations.style.display ="block";
		}else{
			informations.style.display ="none";
		}		
		
	}

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

	function selection(){
		if ($L1MIPI.checked && $Bgroupe.checked) {
			$groupes.innerHTML = "<option>A1</option><option>A2</option><option>A3</option>";
		}else if ($L2MI.checked && $Bgroupe.checked) {
			$groupes.innerHTML = "<option>B1</option><option>B2</option><option>B3</option>";
		}else if ($L3I.checked && $Bgroupe.checked) {
			$groupes.innerHTML = "<option>C1</option><option>C2</option><option>C3</option>";
		}else if ($LPRS.checked && $Bgroupe.checked) {
			$groupes.innerHTML = "<option>D1</option><option>D2</option><option>D3</option>";
		}else if ($LPIRIWS.checked && $Bgroupe.checked) {
			$groupes.innerHTML = "<option>E1</option><option>E2</option><option>E3</option>";
		}
	}

