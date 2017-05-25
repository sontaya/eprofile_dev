<?php

	function getBiodataEntry($empId){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_BIODATA_TAB WHERE EMP_ID = '$empId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		//echo $row['EMP_ID'];

		$n1 =$row['BIO_NATION1'];
		$sql2 = "SELECT NATION_NAME_TH FROM REF_NATION WHERE NATION_ID = '$n1' ";
		$stid2 = oci_parse($conn,$sql2);
		oci_execute($stid2);
		$row2 = oci_fetch_array($stid2,OCI_BOTH);
		$row['BIO_NATION1'] = $row2['NATION_NAME_TH'];

		$n2 = $row['BIO_NATION2'];
		$sql2 = "SELECT NATION_NAME_TH FROM REF_NATION WHERE NATION_ID = '$n2' ";
		$stid2 = oci_parse($conn,$sql2);
		oci_execute($stid2);
		$row2 = oci_fetch_array($stid2,OCI_BOTH);
		$row['BIO_NATION2'] = $row2['NATION_NAME_TH'];


		$xml_gen = '
		<?xml version="1.0" encoding="utf-8"?>
		<BIODATA>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<BIO_TITLE_TH>'.$row['BIO_TITLE_TH'].'</BIO_TITLE_TH>
			<BIO_TITLE2_TH>'.$row['BIO_TITLE2_TH'].'</BIO_TITLE2_TH>
			<BIO_TITLE3_TH>'.$row['BIO_TITLE3_TH'].'</BIO_TITLE3_TH>
			<BIO_FNAME_TH>'.$row['BIO_FNAME_TH'].'</BIO_FNAME_TH>
			<BIO_MNAME_TH>'.$row['BIO_MNAME_TH'].'</BIO_MNAME_TH>
			<BIO_LNAME_TH>'.$row['BIO_LNAME_TH'].'</BIO_LNAME_TH>
			<BIO_TITLE_EN>'.$row['BIO_TITLE_EN'].'</BIO_TITLE_EN>
			<BIO_FNAME_EN>'.$row['BIO_FNAME_EN'].'</BIO_FNAME_EN>
			<BIO_MNAME_EN>'.$row['BIO_MNAME_EN'].'</BIO_MNAME_EN>
			<BIO_LNAME_EN>'.$row['BIO_LNAME_EN'].'</BIO_LNAME_EN>
			<BIO_SEX>'.$row['BIO_SEX'].'</BIO_SEX>
			<BIO_NATION1>'.$row['BIO_NATION1'].'</BIO_NATION1>
			<BIO_NATION2>'.$row['BIO_NATION2'].'</BIO_NATION2>
			<BIO_RELOGION>'.$row['BIO_RELOGION'].'</BIO_RELOGION>
			<BIO_BIRTHDAY>'.$row['BIO_BIRTHDAY'].'</BIO_BIRTHDAY>
			<PERSON_ID>'.$row['PERSON_ID'].'</PERSON_ID>
			<BIO_ID_FROM>'.$row['BIO_ID_FROM'].'</BIO_ID_FROM>
			<BIO_ID_FROM_P>'.$row['BIO_ID_FROM_P'].'</BIO_ID_FROM_P>
			<BIO_ID_DATE_BEGIN>'.$row['BIO_ID_DATE_BEGIN'].'</BIO_ID_DATE_BEGIN>
			<BIO_ID_DATE_EXP>'.$row['BIO_ID_DATE_EXP'].'</BIO_ID_DATE_EXP>
			<BIO_TAX_ID>'.$row['BIO_TAX_ID'].'</BIO_TAX_ID>
			<BIO_GOV_ID>'.$row['BIO_GOV_ID'].'</BIO_GOV_ID>
			<BIO_BANK_ACC_ID>'.$row['BIO_BANK_ACC_ID'].'</BIO_BANK_ACC_ID>
			<BIO_BANK>'.$row['BIO_BANK'].'</BIO_BANK>
			<BIO_STATUS>'.$row['BIO_STATUS'].'</BIO_STATUS>
			<BIO_BLOOD_GROUP>'.$row['BIO_BLOOD_GROUP'].'</BIO_BLOOD_GROUP>
			<BIO_H_PHONE>'.$row['BIO_H_PHONE'].'</BIO_H_PHONE>
			<BIO_H_FAX>'.$row['BIO_H_FAX'].'</BIO_H_FAX>
			<BIO_MOBILE_1>'.$row['BIO_MOBILE_1'].'</BIO_MOBILE_1>
			<BIO_MOBILE_2>'.$row['BIO_MOBILE_2'].'</BIO_MOBILE_2>
			<BIO_EMAIL1>'.$row['BIO_EMAIL1'].'</BIO_EMAIL1>
			<BIO_EMAIL2>'.$row['BIO_EMAIL2'].'</BIO_EMAIL2>
			<BIO_ID_CARD_FILE>'.$row['BIO_ID_CARD_FILE'].'</BIO_ID_CARD_FILE>
			<BIO_ACC_BANK_FILE>'.$row['BIO_ACC_BANK_FILE'].'</BIO_ACC_BANK_FILE>
			<BIO_PIC_FILE>'.$row['BIO_PIC_FILE'].'</BIO_PIC_FILE>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
			<BIO_NAME_EMER>'.$row['BIO_NAME_EMER'].'</BIO_NAME_EMER>
			<BIO_EMER_PHONE>'.$row['BIO_EMER_PHONE'].'</BIO_EMER_PHONE>
		</BIODATA>
		';
		
		
		return $xml_gen;
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("biodata.wsdl");
	$server->addFunction("getBiodataEntry");
	$server->handle();
?>