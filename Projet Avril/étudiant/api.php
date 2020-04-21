<?php
session_start();
header("Access-Control-Allow-Origin: *"); //Autorisation d'entrée
header('Content-type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function get_price($find){
	$books=array(
		"paris-seoul"=>599,
		"paris-madrid"=>400,
		"paris-marseille"=>387
	)
	;

	foreach ($books as $book => $price) {
		if($book==$find){
			return $price;
			break;
		}
	}
}

function deliver_response($status,$status_message,$data){
	header("HTTP/1.1 $status $status_message");

	$reponse['nom_vol']=$status;
	$reponse['status']=$status_message;
	$reponse['prix']=$data;

	$json_reponse = json_encode($reponse);
	echo $json_reponse;
}

//la raquête du client par l'URL:
if(!empty($_GET['name'])){
	$name=$_GET['name'];
	$price= get_price($name);

	if(empty($price)){
		deliver_response(200,"Le vol n'a pas été trouvé",NULL);

	}else{
		deliver_response($name,"Le vol est disponible",$price);
	}

}else{
	deliver_response(400,"Requête invalide",NULL);
}

/*if(isset($_GET['submit'])){
	$names = $_GET['name'];
	$url = "http://localhost/api.php?name=$names";

	//Envoie la réponse
	$client= curl_init($url);

	curl_setopt($client, CURLOPT_RETURNTRANFER, 1);
	//Reçoit la réponse
	$response = curl_exec($client);
	//Decode
	$resultat = json_decode($response);
	print_r($resultat);
}*/




//On vérifie que la méthode utilisée est standart
/*if($_SERVER['REQUEST_METHOD'] = 'GET'){

}else{
	http_response_code(405);
	echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}*/


/*try{
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=api','root',  '');
	$retour["success"] = true;
	$retour["message"] = "Connexion réussi";
} catch(Exception $e){
	$retour["success"] = false;
	$retour["message"] = "Connexion impossible";
}

$requete = $pdo->prepare("SELECT * FROM `vols`");
$requete->execute();

$resultats = $requete->fetchAll();
$retour["success"] = true;
$retour["message"] = "Voici les vols";
$retour["results"]["nb"] = count($resultats);
$retour["results"]["vols"] = $resultats;

echo json_encode($retour);*/

?>