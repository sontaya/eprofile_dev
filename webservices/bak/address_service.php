<?php
	function getTumbon($tumbon){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_REF_TUMBON WHERE CODE_REF_TUMBON ='$tumbon' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		return $row["NAME_REF_TUMBON"];
	}
	
	function getAmphur($amphur){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_REF_AMPHUR WHERE CODE_REF_AMPHUR ='$amphur' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		return $row["NAME_REF_AMPHUR"];
	}
	
	function getProvince($province){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_REF_PROVINCE WHERE CODE_REF_PROVINCE ='$province' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		return $row["NAME_REF_PROVINCE"];
	}
	
	function usradd($empId){
		$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
		$sql = "SELECT * FROM SDU_CEN_ADDRESS_TAB WHERE EMP_ID = '$empId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		//echo $row['EMP_ID'];


		$xml_gen = '<?xml version="1.0" encoding="utf-8"?>';
		$xml_gen .= '
		<ADDERSS_MAIN>'
		;
		$xml_gen .= '
		';
		$xml_gen .= '
		<ADDRESS_CEN>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<CA_HOUSE_NO>'.$row['CA_HOUSE_NO'].'</CA_HOUSE_NO>
			<CA_MOO>'.$row['CA_MOO'].'</CA_MOO>
			<CA_BUILDING>'.$row['CA_BUILDING'].'</CA_BUILDING>
			<CA_VILLAGE>'.$row['CA_VILLAGE'].'</CA_VILLAGE>
			<CA_ROOM>'.$row['CA_ROOM'].'</CA_ROOM>
			<CA_SOI>'.$row['CA_SOI'].'</CA_SOI>
			<CA_ROAD>'.$row['CA_ROAD'].'</CA_ROAD>
			<CA_TUMBON>'.$row['CA_TUMBON'].'</CA_TUMBON>
			<CA_AMPHUR>'.$row['CA_AMPHUR'].'</CA_AMPHUR>
			<CA_PROVINCE>'.$row['CA_PROVINCE'].'</CA_PROVINCE>
			<CA_TUMBON_TEXT>'.getTumbon($row['CA_TUMBON']).'</CA_TUMBON_TEXT>
			<CA_AMPHUR_TEXT>'.getAmphur($row['CA_AMPHUR']).'</CA_AMPHUR_TEXT>
			<CA_PROVINCE_TEXT>'.getProvince($row['CA_PROVINCE']).'</CA_PROVINCE_TEXT>
			<CA_POST_CODE>'.$row['CA_POST_CODE'].'</CA_POST_CODE>
			<CA_CEN_FILE>'.$row['CA_CEN_FILE'].'</CA_CEN_FILE>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
		</ADDRESS_CEN>
		';
		
		$sql = "SELECT * FROM SDU_CURRENT_ADDRESS_TAB WHERE EMP_ID = '$empId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		$xml_gen .= '
		<ADDRESS_CURRENT>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<CU_HOUSE_NO>'.$row['CU_HOUSE_NO'].'</CU_HOUSE_NO>
			<CU_MOO>'.$row['CU_MOO'].'</CU_MOO>
			<CU_BUILDING>'.$row['CU_BUILDING'].'</CU_BUILDING>
			<CU_VILLAGE>'.$row['CU_VILLAGE'].'</CU_VILLAGE>
			<CU_ROOM>'.$row['CU_ROOM'].'</CU_ROOM>
			<CU_SOI>'.$row['CU_SOI'].'</CU_SOI>
			<CU_ROAD>'.$row['CU_ROAD'].'</CU_ROAD>
			<CU_TUMBON>'.$row['CU_TUMBON'].'</CU_TUMBON>
			<CU_AMPHUR>'.$row['CU_AMPHUR'].'</CU_AMPHUR>
			<CU_PROVINCE>'.$row['CU_PROVINCE'].'</CU_PROVINCE>
			<CU_TUMBON_TEXT>'.getTumbon($row['CU_TUMBON']).'</CU_TUMBON_TEXT>
			<CU_AMPHUR_TEXT>'.getAmphur($row['CU_AMPHUR']).'</CU_AMPHUR_TEXT>
			<CU_PROVINCE_TEXT>'.getProvince($row['CU_PROVINCE']).'</CU_PROVINCE_TEXT>
			<CU_POST_CODE>'.$row['CU_POST_CODE'].'</CU_POST_CODE>
			<CU_CEN_FILE>'.$row['CU_CEN_FILE'].'</CU_CEN_FILE>
			<CU_COUNTRY>'.$row['CU_COUNTRY'].'</CU_COUNTRY>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
		</ADDRESS_CURRENT>';
		$xml_gen .= '';
		$xml_gen .= '
		
		</ADDERSS_MAIN>';
		return $xml_gen;
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("address.wsdl");
	$server->addFunction("usradd");
	$server->handle();
?>