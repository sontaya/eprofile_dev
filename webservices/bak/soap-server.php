<?php

	function getCatalogEntry($catalogId){
		$conn = oci_connect("SDPERSON","PERSON","10.129.37.104/ORCL","AL32UTF8");
		$sql = "SELECT * FROM BIODATA_TAB WHERE EMP_ID = '$catalogId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		//echo $row['EMP_ID'];
		$xml_gen = '
		<?xml version="1.0"?>
		<BIODATA>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<BIO_TITLE_TH>'.$row['BIO_TITLE_TH'].'</BIO_TITLE_TH>
			<BIO_FNAME_TH>'.$row['BIO_FNAME_TH'].'</BIO_FNAME_TH>
			<BIO_LNAME_TH>'.$row['BIO_LNAME_TH'].'</BIO_LNAME_TH>
			<BIO_TITLE_EN>'.$row['BIO_TITLE_EN'].'</BIO_TITLE_EN>
			<BIO_FNAME_EN>'.$row['BIO_FNAME_EN'].'</BIO_FNAME_EN>
			<BIO_LNAME_EN>'.$row['BIO_LNAME_EN'].'</BIO_LNAME_EN>
			<BIO_SEX>'.$row['BIO_SEX'].'</BIO_SEX>
			<BIO_NATION1>'.$row['BIO_NATION1'].'</BIO_NATION1>
			<BIO_NATION2>'.$row['BIO_NATION2'].'</BIO_NATION2>
			<BIO_RELOGION>'.$row['BIO_RELOGION'].'</BIO_RELOGION>
			<BIO_BIRTHDAY>'.$row['BIO_BIRTHDAY'].'</BIO_BIRTHDAY>
			<PERSON_ID>'.$row['PERSON_ID'].'</PERSON_ID>
			<BIO_STATUS>'.$row['BIO_STATUS'].'</BIO_STATUS>
			<BIO_BLOOD_GROUP>'.$row['BIO_BLOOD_GROUP'].'</BIO_BLOOD_GROUP>
			<BIO_H_PHONE>'.$row['BIO_H_PHONE'].'</BIO_H_PHONE>
			<BIO_MOBILE_1>'.$row['BIO_MOBILE_1'].'</BIO_MOBILE_1>
			<BIO_EMAIL1>'.$row['BIO_EMAIL1'].'</BIO_EMAIL1>
			<BIO_EMAIL2>'.$row['BIO_EMAIL2'].'</BIO_EMAIL2>
		</BIODATA>
		';
		
		
		return $xml_gen;
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("catalog4.wsdl");
	$server->addFunction("getCatalogEntry");
	$server->handle();
?>