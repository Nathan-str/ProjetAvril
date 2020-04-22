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

$('.toggle-information').click(function(e){
	e.preventDefault();
	$('.formulaire_inscription').toggleClass('is-open');
	$('.toggle-inscription').toggleClass('is-open');
})