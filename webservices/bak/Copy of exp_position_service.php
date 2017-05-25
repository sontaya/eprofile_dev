<?
@ini_set('display_errors', '1');
function exp_position($empId){
	$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
	$sql = "SELECT * FROM SDU_VCHARKARN_POSITION_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	$row = oci_fetch_array($stid,OCI_BOTH);
	
	$xml_gen = '
		<?xml version="1.0" encoding="utf-8"?>
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
		
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH1_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH1>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<COURSE_NAME>'.$row['COURSE_NAME'].'</COURSE_NAME>
					<COURSE_YEAR>'.$row['COURSE_YEAR'].'</COURSE_YEAR>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<COOP>'.$row['COOP'].'</COOP>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH1>';	
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH2_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH2>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<TBOOK_NAME_TH>'.$row['TBOOK_NAME_TH'].'</TBOOK_NAME_TH>
					<TBOOK_NAME_EN>'.$row['TBOOK_NAME_EN'].'</TBOOK_NAME_EN>
					<TBOOK_NAME_OTH>'.$row['TBOOK_NAME_OTH'].'</TBOOK_NAME_OTH>
					<TBOOK_NAME_OTH2>'.$row['TBOOK_NAME_OTH2'].'</TBOOK_NAME_OTH2>
					<COURSE_NAME>'.$row['COURSE_NAME'].'</COURSE_NAME>
					<EDITION>'.$row['EDITION'].'</EDITION>
					<VOLUME>'.$row['VOLUME'].'</VOLUME>
					<PRESS_NAME>'.$row['PRESS_NAME'].'</PRESS_NAME>
					<PRESS_COUNTRY>'.$row['PRESS_COUNTRY'].'</PRESS_COUNTRY>
					<PRESS_YEAR>'.$row['PRESS_YEAR'].'</PRESS_YEAR>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<COOP>'.$row['COOP'].'</COOP>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH2>';	
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH3_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH3>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<TBOOK_NAME_TH>'.$row['TBOOK_NAME_TH'].'</TBOOK_NAME_TH>
					<TBOOK_NAME_EN>'.$row['TBOOK_NAME_EN'].'</TBOOK_NAME_EN>
					<TBOOK_NAME_OTH>'.$row['TBOOK_NAME_OTH'].'</TBOOK_NAME_OTH>
					<TBOOK_NAME_OTH2>'.$row['TBOOK_NAME_OTH2'].'</TBOOK_NAME_OTH2>
					<COURSE_NAME>'.$row['COURSE_NAME'].'</COURSE_NAME>
					<EDITION>'.$row['EDITION'].'</EDITION>
					<VOLUME>'.$row['VOLUME'].'</VOLUME>
					<PRESS_NAME>'.$row['PRESS_NAME'].'</PRESS_NAME>
					<PRESS_COUNTRY>'.$row['PRESS_COUNTRY'].'</PRESS_COUNTRY>
					<PRESS_YEAR>'.$row['PRESS_YEAR'].'</PRESS_YEAR>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<COOP>'.$row['COOP'].'</COOP>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH3>';	
	
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH4_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH4>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<RESEARCH_NAME_TH>'.$row['TBOOK_NAME_TH'].'</TBOOK_NAME_TH>
					<RESEARCH_NAME_EN>'.$row['TBOOK_NAME_EN'].'</TBOOK_NAME_EN>
					<RESEARCH_NAME_OTH>'.$row['TBOOK_NAME_OTH'].'</TBOOK_NAME_OTH>
					<RESEARCH_NAME_OTH2>'.$row['TBOOK_NAME_OTH2'].'</TBOOK_NAME_OTH2>
					<RESEARCH_NAME2_TH>'.$row['RESEARCH_NAME2_TH'].'</RESEARCH_NAME2_TH>
					<RESEARCH_NAME2_EN>'.$row['RESEARCH_NAME2_EN'].'</RESEARCH_NAME2_EN>
					<RESEARCH_NAME2_OTH>'.$row['RESEARCH_NAME2_OTH'].'</RESEARCH_NAME2_OTH>
					<RESEARCH_NAME2_OTH2>'.$row['RESEARCH_NAME2_OTH2'].'</RESEARCH_NAME2_OTH2>
					<WRITER>'.$row['WRITER'].'</WRITER>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<COOP>'.$row['COOP'].'</COOP>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<DISTRIBUTE_LEVEL>'.$row['DISTRIBUTE_LEVEL'].'</DISTRIBUTE_LEVEL>
					<JOURNAL_NAME>'.$row['JOURNAL_NAME'].'</JOURNAL_NAME>
					<V_I_N_P>'.$row['V_I_N_P'].'</V_I_N_P>
					<PRESS_YEAR>'.$row['PRESS_YEAR'].'</PRESS_YEAR>
					<UPDATE_BYMEETING_DISTRIBUTE_LEVEL>'.$row['UPDATE_BYMEETING_DISTRIBUTE_LEVEL'].'</UPDATE_BYMEETING_DISTRIBUTE_LEVEL>
					<MEETING_NAME>'.$row['MEETING_NAME'].'</MEETING_NAME>
					<MEETING_COUNTRY>'.$row['MEETING_COUNTRY'].'</MEETING_COUNTRY>
					<MEETING_MONTH>'.$row['MEETING_MONTH'].'</MEETING_MONTH>
					<MEETING_YEAR>'.$row['MEETING_YEAR'].'</MEETING_YEAR>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH4>';	
	
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH5_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH5>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<ARTICLE_NAME_TH>'.$row['ARTICLE_NAME_TH'].'</ARTICLE_NAME_TH>
					<ARTICLE_NAME_EN>'.$row['ARTICLE_NAME_EN'].'</ARTICLE_NAME_EN>
					<ARTICLE_NAME_OTH>'.$row['ARTICLE_NAME_OTH'].'</ARTICLE_NAME_OTH>
					<ARTICLE_NAME_OTH2>'.$row['ARTICLE_NAME_OTH2'].'</ARTICLE_NAME_OTH2>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<COOP>'.$row['COOP'].'</COOP>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<DISTRIBUTE_JOURNAL_LEVEL>'.$row['DISTRIBUTE_JOURNAL_LEVEL'].'</DISTRIBUTE_JOURNAL_LEVEL>
					<JOURNAL_NAME>'.$row['JOURNAL_NAME'].'</JOURNAL_NAME>
					<WRITER>'.$row['WRITER'].'</WRITER>
					<V_I_N_P>'.$row['V_I_N_P'].'</V_I_N_P>
					<PRESS_YEAR>'.$row['PRESS_YEAR'].'</PRESS_YEAR>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH5>';	
	$sql = "SELECT * FROM SDU_VCHARKARN_ACH6_TAB WHERE EMP_ID = '$empId' ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	//$row = oci_fetch_array($stid,OCI_BOTH);
	$xml_gen .= '<VCH6>';
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$xml_gen .= '
				<DATA>
					<ID>'.$row['ID'].'</ID>
					<EMP_ID>'.$row['EMP_ID'].'</EMP_ID>
					<POSITION_TYPE>'.$row['POSITION_TYPE'].'</POSITION_TYPE>
					<ACHEIVE_TYPE>'.$row['ACHEIVE_TYPE'].'</ACHEIVE_TYPE>
					<ACHEIVE_NAME_TH>'.$row['ACHEIVE_NAME_TH'].'</ACHEIVE_NAME_TH>
					<ACHEIVE_NAME_EN>'.$row['ACHEIVE_NAME_EN'].'</ACHEIVE_NAME_EN>
					<ACHEIVE_NAME_OTH>'.$row['ACHEIVE_NAME_OTH'].'</ACHEIVE_NAME_OTH>
					<ACHEIVE_NAME_OTH2>'.$row['ACHEIVE_NAME_OTH2'].'</ACHEIVE_NAME_OTH2>
					<ACHEIVE_YEAR>'.$row['ACHEIVE_YEAR'].'</ACHEIVE_YEAR>
					<TYPE>'.$row['TYPE'].'</TYPE>
					<COOP>'.$row['COOP'].'</COOP>
					<PROPORTION>'.$row['PROPORTION'].'</PROPORTION>
					<LAST_UPDATE>'.$row['LAST_UPDATE'].'</LAST_UPDATE>
					<UPDATE_BY>'.$row['UPDATE_BY'].'</UPDATE_BY>
				</DATA>';
	}		
	$xml_gen .= '</VCH6>';	
	return $xml_gen;
}

	ini_set("soap.wsdl_cache_enabled","0");
	$server = new SoapServer("exp_position.wsdl");
	$server->addFunction("exp_position");
	$server->handle();

?>