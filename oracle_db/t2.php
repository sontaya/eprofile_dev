<h3>test</h3>
<?
echo  ">>".$_GET["sql"]."<br>";
include("./includes/config.inc.php");
include("./includes/conn.php");

$sql="UPDATE SDU_USER_TAB SET USERNAME='piriya_kim' WHERE EMP_ID='2037-041' ";

$stid = oci_parse($conn, $sql);
$r = oci_execute($stid);
/*
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	echo $row["USERNAME"].":".$row["USER_TYPE"]."<br>";
}
*/
?>