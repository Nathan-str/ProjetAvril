<?php
	session_start();

	include 'fonction.php';

	function addLogEvent($event)
	{
		$fp = 'fichiers/log.txt';
	    $time = date("D, d M Y H:i:s");
	    $time = "[".$time."] ";
	 
	    $event = $time.$event."\n";
	 
	    file_put_contents($fp, $event, FILE_APPEND);
	}

	
	//function FiliereJson(){

		$jsonArray = array();
		$jsonTableau = array();

		$jsonArray["A1"] = "A1";
		$jsonArray["A2"] = "A2";
		$jsonArray["A3"] = "A3";
		$jsonTableau["L1-MIPI"] = $jsonArray;


		$jsonArray1["B1"] = "B1";
		$jsonArray1["B2"] = "B2";
		$jsonArray1["B3"] = "B3";
		$jsonTableau["L2-MI"] = $jsonArray1;

		$jsonArray2["C1"] = "C1";
		$jsonArray2["C2"] = "C2";
		$jsonArray2["C3"] = "C3";
		$jsonTableau["L3-I"] = $jsonArray2;

		$jsonArray3["D1"] = "D1";
		$jsonArray3["D2"] = "D2";
		$jsonArray3["D3"] = "D3";
		$jsonTableau["LP-RS"] = $jsonArray3;

		$jsonArray4["E1"] = "E1";
		$jsonArray4["E2"] = "E2";
		$jsonArray4["E3"] = "E3";
		$jsonTableau["LPI-RIWS"] = $jsonArray4;
		$jsonBig["All"] = $jsonTableau;

		$json = $jsonBig;
		$json = json_encode($json);
		header('Content-type: application/json');
		echo($json);
	//}

?>
