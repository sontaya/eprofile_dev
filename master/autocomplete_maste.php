<?
include("./../includes/config.inc.php");

$tb=$_POST["table"];
$find=$_POST["find_data"];

$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$sql = "SELECT *  FROM ".$tb;
$st = oci_parse($conn, $sql);
oci_execute($st);
while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
	$data.='"'.$rc[0].'",';
}
print substr($data,0,strlen($data)-1);
?>