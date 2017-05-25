<?
$fpath = '../';
require_once($fpath . "includes/connect.php");

$f_code = $_POST["f_code"];

if($_POST["code"]!=""){
	$in = " OR POSITION_CODE ='".$_POST["code"]."'";
}

$sql = "SELECT *  FROM SDU_REF_POSITION_CODE WHERE (CODE_FACULTY='".$f_code."' AND EMP_ID='') OR (CODE_FACULTY='".$f_code."' AND EMP_ID IS NULL) ".$in." ORDER BY CODE_FACULTY ";
//print  $sql;
$st = oci_parse($conn, $sql);
if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
}

print "<option value=''>--------- เลือก -------</option>";
while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
	$s="";
	if($_POST["code"]==$rc["POSITION_CODE"]){
		$s = "selected='true'";
	}
 	print "<option value='".$rc["POSITION_CODE"]."' ".$s.">".$rc["POSITION_CODE"]."</option>";
 }
?>