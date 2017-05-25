<?php
	require_once("includes/config.inc.php");
	require_once("includes/connect.inc.php");
	require_once("includes/function.inc.php");
	
	function getCurrentwork($empId){
		$conn = oci_connect("SDPERSON","PERSON","10.129.37.104/ORCL","AL32UTF8");
		$sql = "SELECT * FROM CURRENT_WORK_TAB WHERE EMP_ID = '$empId' ";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		//echo $row['EMP_ID'];
		$xml_gen = '
		<?xml version="1.0" encoding="utf-8"?>
		<CURRENTWORK>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<CWK_STATUS>'.$row['CWK_STATUS'].'</CWK_STATUS>
			<CWK_MUA_EMP_TYPE>'.$row['CWK_MUA_EMP_TYPE'].'</CWK_MUA_EMP_TYPE>
			<CWK_MUA_EMP_SUBTYPE>'.$row['CWK_MUA_EMP_SUBTYPE'].'</CWK_MUA_EMP_SUBTYPE>
			<CWK_MUA_MAIN>'.$row['CWK_MUA_MAIN'].'</CWK_MUA_MAIN>
			<CWK_MUA_SUBMAIN>'.$row['CWK_MUA_SUBMAIN'].'</CWK_MUA_SUBMAIN>
			<CWK_DSU_EDU_CENTER>'.$row['CWK_DSU_EDU_CENTER'].'</CWK_DSU_EDU_CENTER>
			<CWK_DSU_POS>'.$row['CWK_DSU_POS'].'</CWK_DSU_POS>
			<CWK_MUA_VPOS>'.$row['CWK_MUA_VPOS'].'</CWK_MUA_VPOS>
			<CWK_MUA_LEVEL>'.$row['CWK_MUA_LEVEL'].'</CWK_MUA_LEVEL>
			<CWK_MUA_MPOS>'.$row['CWK_MUA_MPOS'].'</CWK_MUA_MPOS>
			<CWK_MUA_WORK_GROUP>'.$row['CWK_MUA_WORK_GROUP'].'</CWK_MUA_WORK_GROUP>
			<CWK_START_WORK_DATE>'.$row['CWK_START_WORK_DATE'].'</CWK_START_WORK_DATE>
			<CWK_END_WORK_DATE>'.$row['CWK_END_WORK_DATE'].'</CWK_END_WORK_DATE>
			<CWK_START_WORK>'.$row['CWK_START_WORK'].'</CWK_START_WORK>
			<CWK_SAT>'.$row['CWK_SAT'].'</CWK_SAT>
			<CWK_SUN>'.$row['CWK_SUN'].'</CWK_SUN>
			<CWK_END_WORK>'.$row['CWK_END_WORK'].'</CWK_END_WORK>
			<CWK_START_TEACH_DATE>'.$row['CWK_START_TEACH_DATE'].'</CWK_START_TEACH_DATE>
			<CWK_ORDER1>'.$row['CWK_ORDER1'].'</CWK_ORDER1>
			<CWK_PROMOTE_DATE>'.$row['CWK_PROMOTE_DATE'].'</CWK_PROMOTE_DATE>
			<CWK_ORDER2>'.$row['CWK_ORDER2'].'</CWK_ORDER2>
			<CWK_SALARY_TIME_TYPE>'.$row['CWK_SALARY_TIME_TYPE'].'</CWK_SALARY_TIME_TYPE>
			<CWK_PHONE>'.$row['CWK_PHONE'].'</CWK_PHONE>
			<CWK_EDU_GROUP1>'.$row['CWK_EDU_GROUP1'].'</CWK_EDU_GROUP1>
			<CWK_EDU_GROUP2>'.$row['CWK_EDU_GROUP2'].'</CWK_EDU_GROUP2>
			<CWK_EDU_GROUP3>'.$row['CWK_EDU_GROUP3'].'</CWK_EDU_GROUP3>
			<CWK_TEACHER_FILE>'.$row['CWK_TEACHER_FILE'].'</CWK_TEACHER_FILE>
			<CWK_RETIRE>'.$row['CWK_RETIRE'].'</CWK_RETIRE>
			<CWK_RETIRE_DATE>'.$row['CWK_RETIRE_DATE'].'</CWK_RETIRE_DATE>
			<CWK_QUIT_DATE>'.$row['CWK_QUIT_DATE'].'</CWK_QUIT_DATE>
			<CWK_QUIT_REASON>'.$row['CWK_QUIT_REASON'].'</CWK_QUIT_REASON>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
			<CWK_CERT_FILE>'.$row['CWK_CERT_FILE'].'</CWK_CERT_FILE>
		</CURRENTWORK>
		';
		
		
		return $xml_gen;
	}
	
	function getCurrentworkEntry($perId) {
		$empID = getEmpId($perId);
		$xml_value = getCurrentwork($empID);
		return $xml_value;
	}
	
	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("currentwork.wsdl");
	$server->addFunction("getCurrentworkEntry");
	$server->handle();
?>