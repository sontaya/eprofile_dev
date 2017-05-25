<?
//@ini_set('display_errors', '1');

function exp_position($empId){
	//$conn = oci_connect("EPROFILE","EPROFILE","localhost/xe","AL32UTF8");
	$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
	$sql = "SELECT * FROM SDU_VCHARKARN_POSITION_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	
	$xml_gen = '<?xml version="1.0" encoding="utf-8"?>';
	$xml_gen .= "
	<VCHPOS_MAIN>
	";
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
		<VCHPOS>
			<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
			<VP_TYPE>'.$row['VP_TYPE'].'</VP_TYPE>
			<VP_SUB_TYPE>'.$row['VP_SUB_TYPE'].'</VP_SUB_TYPE>
			<VP_METHOD>'.$row['VP_METHOD'].'</VP_METHOD>
			<VP_BY>'.$row['VP_BY'].'</VP_BY>
			<VP_UNIVERSITY>'.$row['VP_UNIVERSITY'].'</VP_UNIVERSITY>
			<VP_PROFESSIONAL_MAJOR>'.$row['VP_PROFESSIONAL_MAJOR'].'</VP_PROFESSIONAL_MAJOR>
			<VP_DATE>'.$row['VP_DATE'].'</VP_DATE>
			<VP_MATI_1>'.$row['VP_MATI_1'].'</VP_MATI_1>
			<VP_MATI_2>'.$row['VP_MATI_2'].'</VP_MATI_2>
			<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
			<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
			<VP_ORDER>'.$row['VP_ORDER'].'</VP_ORDER>
			<VP_ORDER_DATE>'.$row['VP_ORDER_DATE'].'</VP_ORDER_DATE>
		</VCHPOS>
		';
	}
	$xml_gen .= "
	</VCHPOS_MAIN>";	
	return $xml_gen;
}

	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("exp_position.wsdl");
	$server->addFunction("exp_position");
	$server->handle();

?>