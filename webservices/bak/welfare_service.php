<?php

	function getWelfareEntry($empId){
		$conn = oci_connect("SDPERSON","PERSON","10.129.37.104/ORCL","AL32UTF8");
		$sql = "SELECT * FROM WELFARE_TAB WHERE EMP_ID = '$empId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		//echo $row['EMP_ID'];
		$xml_gen = '
		<?xml version="1.0" encoding="utf-8"?>
		<WELFARE>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<GPF>'.$row['GPF'].'</GPF>
			<GPEF>'.$row['GPEF'].'</GPEF>
			<PERSONAL_FUND>'.$row['PERSONAL_FUND'].'</PERSONAL_FUND>
			<COOPERATIVES>'.$row['COOPERATIVES'].'</COOPERATIVES>
			<WELFARE>'.$row['WELFARE'].'</WELFARE>
			<CLILDLOAN>'.$row['CLILDLOAN'].'</CLILDLOAN>
			<SPECIAL_REWARD>'.$row['SPECIAL_REWARD'].'</SPECIAL_REWARD>
			<SCHOLAR>'.$row['SCHOLAR'].'</SCHOLAR>
			<DEBT>'.$row['DEBT'].'</DEBT>
			<SSO>'.$row['SSO'].'</SSO>
			<HOSPITAL>'.$row['HOSPITAL'].'</HOSPITAL>
			<CPK>'.$row['CPK'].'</CPK>
			<CPS>'.$row['CPS'].'</CPS>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
		</WELFARE>
		';
		
		
		return $xml_gen;
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("welfare.wsdl");
	$server->addFunction("getWelfareEntry");
	$server->handle();
?>