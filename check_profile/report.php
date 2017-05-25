<?
	include("../includes/connect.php");
	
	$sql = "SELECT EMP_ID, to_char(PROFILE_COMMENT) FROM SDU_CHECK_PROFILE ";
echo $sql;
$stid = oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_RETURN_LOBS)){
	echo $row["EMP_ID"];
	echo $row["PROFILE_COMMENT"]->load();
	echo "<br/>";
}
?>

