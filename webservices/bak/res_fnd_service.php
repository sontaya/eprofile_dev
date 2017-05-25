<?

function res_fnd($empId){
	$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
	//$conn = oci_connect("EPROFILE","EPROFILE","localhost/xe","AL32UTF8");
	$sql = "SELECT * FROM SDU_RESEARCH_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen = '<?xml version="1.0" encoding="utf-8"?>';
	$xml_gen .= '
	<REC_MAIN>
	';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen.='
			<REC>
				<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
				<REC_ID>'.$row['REC_ID'].'</REC_ID>
				<REC_AT>'.$row['REC_AT'].'</REC_AT>
				<REC_AT_DATE>'.$row['REC_AT_DATE'].'</REC_AT_DATE>
				<REC_ORDER_NO>'.$row['REC_ORDER_NO'].'</REC_ORDER_NO>
				<REC_TYPE>'.$row['REC_TYPE'].'</REC_TYPE>
				<REC_YEAR>'.$row['REC_YEAR'].'</REC_YEAR>
				<REC_PRICES>'.$row['REC_PRICES'].'</REC_PRICES>
				<REC_SOURCE>'.$row['REC_SOURCE'].'</REC_SOURCE>
				<REC_START_DATE>'.$row['REC_START_DATE'].'</REC_START_DATE>
				<REC_END_DATE>'.$row['REC_END_DATE'].'</REC_END_DATE>
				<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
				<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
			</REC>
		';
	}
	
	$xml_gen .= '
	</REC_MAIN>';
	return $xml_gen;
}

	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("res_fnd.wsdl");
	$server->addFunction("res_fnd");
	$server->handle();
?>