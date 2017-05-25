<?
include("../../includes/connect.php");

$sql_profile="UPDATE SDU_CHECK_PROFILE SET check_status = 'T', DATE_UPDATE=SYSDATE WHERE EMP_ID = '".$_POST["personal_id"]."' ";
$stid = oci_parse($conn, $sql_profile );
oci_execute($stid);

echo $page;
?>