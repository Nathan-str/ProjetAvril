<?php
session_start();
//header('location: ./api.php?name=' . $_GET['name']);

$names = $_POST['vols'];
//$url = "http://localhost/api.php?name=$names";
//$jsonText = file_get_contents("http://localhost/api.php?name=$names");
$jsonText = file_get_contents('http://localhost/api.php?name=' . $names);

$jsonArray = json_decode($jsonText,True);

echo("Vol pour $names");
echo($jsonArray["status"]);
echo($jsonArray["prix"]);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<input name="bouton_terminer" type="button" value="VOIR API" onclick="document.location.href='http://localhost/api.php?name=<?php echo($names); ?>'">

</body>
</html>