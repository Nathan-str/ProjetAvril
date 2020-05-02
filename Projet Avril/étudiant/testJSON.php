<?php
	$jsonText = file_get_contents('http://nathan-str-etudiant.alwaysdata.net/test.php');
	$jsonArray = json_decode($jsonText,True);
	echo($jsonArray["LPI-RIWS"]["E1"]);

	for ($i=0;$i<sizeof($jsonArray["All"]);$i++){
		echo($jsonArray["All"]["LPI-RIWS"]["E1"]);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>
	
<script type="text/javascript">
	
</script>

</body>
</html>