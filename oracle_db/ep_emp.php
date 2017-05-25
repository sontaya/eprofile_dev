<?
include("./includes/config.inc.php");
include("./includes/conn.php");
$sql="SELECT * FROM SDU_BIODATA_TAB WHERE EMP_ID='2035-042'";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
//$row = @oci_fetch_array($stid, OCI_BOTH);
while($dbarr=oci_fetch_array($stid, OCI_BOTH)){
	print $dbarr["EMP_ID"].":".$dbarr["PERSON_ID"].":".$dbarr["BIO_STATUS"]."<br>";
}
	

?>