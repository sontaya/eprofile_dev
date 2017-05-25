<?php

	function getSalaryallEntry($empId){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_SALARY_STEP
INNER JOIN
(SELECT MAX(REF)as id
FROM SDU_SALARY_STEP GROUP BY EMP_ID)maxref
ON maxref.id = SDU_SALARY_STEP.REF ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
				$xml_gen = '
		<?xml version="1.0" encoding="utf-8"?>
		<SALARYALL>';
		while($row = oci_fetch_array($stid,OCI_BOTH)){
			// Read PERSON_ID From BIODATA_TAB
			//$sql2 = "SELECT PERSON_ID FROM SDU_BIODATA_TAB ";
			//$sql2 .= "WHERE EMP_ID = '". $row['EMP_ID'] . "' ";
			//$stie = oci_parse($conn,$sql2);
			//oci_execute($stie);
			//$row2 = oci_fetch_array($stie,OCI_BOTH);
		//echo $row['EMP_ID'];
			$xml_gen .= '<EMP EMP_ID="'.$row['EMP_ID'].'" REF="'.$row['REF'].'">
				<SOURCE1>'.$row['SOURCE1'].'</SOURCE1>
				<SOURCE2>'.$row['SOURCE2'].'</SOURCE2>
				<SOURCE3>'.$row['SOURCE3'].'</SOURCE3>
				<SALARY1>'.$row['SALARY1'].'</SALARY1>
				<SALARY2>'.$row['SALARY2'].'</SALARY2>
				<SALARY3>'.$row['SALARY3'].'</SALARY3>
				<AFFECTIVE_DATE>'.$row['AFFECTIVE_DATE'].'</AFFECTIVE_DATE>
				<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
				<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</EMP>
				';
		
		} // close while
		$xml_gen .= '</SALARYALL>
		';
		return $xml_gen;
		//return "ssdspod";
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("salaryall.wsdl");
	$server->addFunction("getSalaryallEntry");
	$server->handle();
?>