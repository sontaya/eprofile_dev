<?
include("../../includes/connect.php");

$sql_check = "SELECT count(*) as num_rows FROM SDU_CHECK_PROFILE WHERE EMP_ID = '".$_POST["personal_id"]."' ";
$stid = oci_parse($conn, $sql_check );
oci_execute($stid);
$row=oci_fetch_array($stid, OCI_BOTH);
if($row["NUM_ROWS"]==0){
	$sql_profile="INSERT INTO SDU_CHECK_PROFILE (EMP_ID, ".$_POST["page_name"]."_status) VALUES ('".$_POST["personal_id"]."', 'T')";
}else{
	$sql_profile="UPDATE SDU_CHECK_PROFILE SET ".$_POST["page_name"]."_status = 'T' WHERE EMP_ID = '".$_POST["personal_id"]."' ";
}
$stid = oci_parse($conn, $sql_profile );
oci_execute($stid);

echo $page;
?>