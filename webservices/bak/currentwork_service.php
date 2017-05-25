<?php

require_once("includes/config.inc.php");
require_once("includes/connect.inc.php");
require_once("includes/function.inc.php");

function getCurrentwork($empId) {
  //$conn = oci_connect("SDPERSON","PERSON","10.129.37.104/ORCL","AL32UTF8");
  global $conn;
  $sql = "SELECT * FROM SDU_CURRENT_WORK_TAB 
                WHERE EMP_ID = '$empId' ";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $cwt = oci_fetch_array($stid, OCI_BOTH);

  $sql = "SELECT * FROM SDU_SALARY_STEP 
                WHERE EMP_ID = '$empId' ";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $ss = oci_fetch_array($stid, OCI_BOTH);

  $sql = "SELECT * FROM SDU_EX_SALARY 
                WHERE EMP_ID = '$empId' ";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $ex_salary = "";
  while ($es = oci_fetch_array($stid, OCI_BOTH)) {
    $value = "
         <EX_SALARY>    
            <EX_SALARY_REF>{$es['EX_SALARY_REF']}</EX_SALARY_REF>
            <EX_SALARY>{$es['EX_SALARY']}</EX_SALARY>
            <EX_SOURCE>{$es['EX_SOURCE']}</EX_SOURCE>
            <LAST_UPDATE>{$es['LAST_UPDATE']}</LAST_UPDATE>
            <UPDATE_BY>{$es['UPDATE_BY']}</UPDATE_BY>
          </EX_SALARY>  
          ";
    $ex_salary .= $value;
  }


  //$es['LAST_UPDATE'] = change_date_thai($es['LAST_UPDATE']);
  //echo $row['EMP_ID'];
  $xml_gen = <<<XML
<?xml version="1.0" encoding="utf-8"?>
  <DATA>
     <PERSON id='{$empId}' >
		<CURRENTWORK>
			<EMP_ID>{$cwt['EMP_ID']}</EMP_ID>
			<CWK_STATUS>{$cwt['CWK_STATUS']}</CWK_STATUS>
			<CWK_MUA_EMP_TYPE>1</CWK_MUA_EMP_TYPE>
			<CWK_MUA_EMP_SUBTYPE>{$cwt['CWK_MUA_EMP_SUBTYPE']}</CWK_MUA_EMP_SUBTYPE>
			<CWK_MUA_MAIN>{$cwt['CWK_MUA_MAIN']}</CWK_MUA_MAIN>
			<CWK_MUA_SUBMAIN>{$cwt['CWK_MUA_SUBMAIN']}</CWK_MUA_SUBMAIN>
			<CWK_DSU_EDU_CENTER>{$cwt['CWK_DSU_EDU_CENTER']}</CWK_DSU_EDU_CENTER>
			<CWK_DSU_POS>{$cwt['CWK_DSU_POS']}</CWK_DSU_POS>
			<CWK_MUA_VPOS>{$cwt['CWK_MUA_VPOS']}</CWK_MUA_VPOS>
			<CWK_MUA_LEVEL>{$cwt['CWK_MUA_LEVEL']}</CWK_MUA_LEVEL>
			<CWK_MUA_MPOS>{$cwt['CWK_MUA_MPOS']}</CWK_MUA_MPOS>
			<CWK_MUA_WORK_GROUP>{$cwt['CWK_MUA_WORK_GROUP']}</CWK_MUA_WORK_GROUP>
			<CWK_START_WORK_DATE>{$cwt['CWK_START_WORK_DATE']}</CWK_START_WORK_DATE>
			<CWK_END_WORK_DATE>{$cwt['CWK_END_WORK_DATE']}</CWK_END_WORK_DATE>
			<CWK_START_WORK>{$cwt['CWK_START_WORK']}</CWK_START_WORK>
			<CWK_SAT>{$cwt['CWK_SAT']}</CWK_SAT>
			<CWK_SUN>{$cwt['CWK_SUN']}</CWK_SUN>
			<CWK_END_WORK>{$cwt['CWK_END_WORK']}</CWK_END_WORK>
			<CWK_START_TEACH_DATE>{$cwt['CWK_START_TEACH_DATE']}</CWK_START_TEACH_DATE>
			<CWK_ORDER1>{$cwt['CWK_ORDER1']}</CWK_ORDER1>
			<CWK_PROMOTE_DATE>{$cwt['CWK_PROMOTE_DATE']}</CWK_PROMOTE_DATE>
			<CWK_ORDER2>{$cwt['CWK_ORDER2']}</CWK_ORDER2>
			<CWK_SALARY_TIME_TYPE>{$cwt['CWK_SALARY_TIME_TYPE']}</CWK_SALARY_TIME_TYPE>
			<CWK_PHONE>{$cwt['CWK_PHONE']}</CWK_PHONE>
			<CWK_EDU_GROUP1>{$cwt['CWK_EDU_GROUP1']}</CWK_EDU_GROUP1>
			<CWK_EDU_GROUP2>{$cwt['CWK_EDU_GROUP2']}</CWK_EDU_GROUP2>
			<CWK_EDU_GROUP3>{$cwt['CWK_EDU_GROUP3']}</CWK_EDU_GROUP3>
			<CWK_TEACHER_FILE>{$cwt['CWK_TEACHER_FILE']}</CWK_TEACHER_FILE>
			<CWK_RETIRE>{$cwt['CWK_RETIRE']}</CWK_RETIRE>
			<CWK_RETIRE_DATE>{$cwt['CWK_RETIRE_DATE']}</CWK_RETIRE_DATE>
			<CWK_QUIT_DATE>{$cwt['CWK_QUIT_DATE']}</CWK_QUIT_DATE>
			<CWK_QUIT_REASON>{$cwt['CWK_QUIT_REASON']}</CWK_QUIT_REASON>
			<LAST_UPDATE>{$cwt['LAST_UPDATE']}</LAST_UPDATE>
			<UPDATE_BY>{$cwt['UPDATE_BY']}</UPDATE_BY>
			<CWK_CERT_FILE>{$cwt['CWK_CERT_FILE']}</CWK_CERT_FILE>
		</CURRENTWORK>
        <SALARY_STEP>
            <SOURCE1>{$ss['SOURCE1']}</SOURCE1>
            <SOURCE2>{$ss['SOURCE2']}</SOURCE2>
            <SOURCE3>{$ss['SOURCE3']}</SOURCE3>
            <SALARY1>{$ss['SALARY1']}</SALARY1>
            <SALARY2>{$ss['SALARY2']}</SALARY2>
            <SALARY3>{$ss['SALARY3']}</SALARY3>
            <AFFECTIVE_DATE>{$ss['AFFECTIVE_DATE']}</AFFECTIVE_DATE>
            <LAST_UPDATE>{$ss['LAST_UPDATE']}</LAST_UPDATE>
            <UPDATE_BY>{$ss['UPDATE_BY']}</UPDATE_BY>
        </SALARY_STEP>  
  {$ex_salary}
        </PERSON>
     </DATA>
XML;


  return $xml_gen;
}

function getCurrentworkEntry($perId) {
  $empID = getEmpId($perId);
  $xml_value = getCurrentwork($empID);
  return $xml_value;
}

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("currentwork.wsdl");
$server->addFunction("getCurrentworkEntry");
$server->handle();
?>