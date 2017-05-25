<?
ini_set('display_errors', TRUE);
/*
$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
$sql = "SELECT * FROM SDU_BIODATA_TAB WHERE EMP_ID = '1001-151'";
$stid = oci_parse($conn,$sql);
oci_execute($stid);
$row = oci_fetch_array($stid,OCI_BOTH);$stid = oci_parse($conn,$sql);
oci_execute($stid);
$row = oci_fetch_array($stid,OCI_BOTH);
print ">>>".$row["EMP_ID"]
*/
//phpinfo();

include("bioDataWebService.php");

$arr = array("IDCODE"=>"2020-052");
print_r(bioData($arr));

?>