<?
require_once("../includes/config.inc.php");
date_default_timezone_set("Asia/Bangkok");
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$sql_count = "SELECT COUNT(EMP_ID) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_EMP_TYPE = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'     ";
$stid_count = oci_parse($conn, $sql_count );
oci_execute($stid_count);
$all_person =  oci_fetch_array($stid_count, OCI_BOTH);
echo $all_person[0];
oci_close($conn);
?>