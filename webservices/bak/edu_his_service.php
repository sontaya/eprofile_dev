<?

function edu_his($empId){
	$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
	//$conn = oci_connect("EPROFILE","EPROFILE","localhost/xe","AL32UTF8");
	$sql = "SELECT * FROM SDU_EDUCATION_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen = '<?xml version="1.0" encoding="utf-8"?>';
	$xml_gen .= "
	<EDU_MAIN>
	";
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen.='
			<EDU>
				<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
				<EDU_ID>'.$row['EDU_ID'].'</EDU_ID>
				<EDU_LEVEL>'.$row['EDU_LEVEL'].'</EDU_LEVEL>
				<EDU_COUNTRY>'.$row['EDU_COUNTRY'].'</EDU_COUNTRY>
				<EDU_NAME>'.$row['EDU_NAME'].'</EDU_NAME>
				<EDU_NAME_SHORT>'.$row['EDU_NAME_SHORT'].'</EDU_NAME_SHORT>
				<EDU_GPA>'.$row['EDU_GPA'].'</EDU_GPA>
				<EDU_PROGRAM>'.$row['EDU_PROGRAM'].'</EDU_PROGRAM>
				<EDU_YEAR>'.$row['EDU_YEAR'].'</EDU_YEAR>
				<EDU_MAJOR>'.$row['EDU_MAJOR'].'</EDU_MAJOR>
				<EDU_DISCIPLINE>'.$row['EDU_DISCIPLINE'].'</EDU_DISCIPLINE>
				<EDU_FROM>'.$row['EDU_FROM'].'</EDU_FROM>
				<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
				<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
			</EDU>
		';
	}
	$xml_gen .= "
	</EDU_MAIN>";
	return $xml_gen;
}

	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("edu_his.wsdl");
	$server->addFunction("edu_his");
	$server->handle();
?>