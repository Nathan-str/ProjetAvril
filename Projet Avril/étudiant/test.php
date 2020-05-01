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

		//$jsonArray["A1"] = "A1";
		//$jsonArray["A2"] = "A2";
		//$jsonArray["A3"] = "A3";
		$jsonTableau["L1-MIPI"]["groupes"] = ["A1","A2","A3"];


		//$jsonArray1["B1"] = "B1";
		//$jsonArray1["B2"] = "B2";
		//$jsonArray1["B3"] = "B3";
		$jsonTableau["L2-MI"]["groupes"] = ["B1","B2","B3"];

		//$jsonArray2["C1"] = "C1";
		//$jsonArray2["C2"] = "C2";
		//$jsonArray2["C3"] = "C3";
		$jsonTableau["L3-I"]["groupes"] = ["C1","C2","C3"];

		//$jsonArray3["D1"] = "D1";
		//$jsonArray3["D2"] = "D2";
		//$jsonArray3["D3"] = "D3";
		$jsonTableau["LP-RS"]["groupes"] = ["D1","D2","D3"];

		//$jsonArray4["groupe"] = "E1";
		//$jsonArray4["groupe"] = "E2";
		//$jsonArray4["groupe"] = "E3";
		$jsonTableau["LPI-RIWS"]["groupes"] = ["E1","E2","E3"];
		$jsonBig["listeFilieres"] = $jsonTableau;

		$json = $jsonBig;
		$json = json_encode($json);
		header('Content-type: application/json');
		$file = fopen("fichiers/filiere.json", "w");
		fwrite($file, $json);
	//}

?>
