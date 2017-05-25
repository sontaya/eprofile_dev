<?
echo  ">>".$_GET["sql"]."<br>";
include("./includes/config.inc.php");
include("./includes/conn.php");
$stid = oci_parse($conn, $_GET["sql"]);
$r = oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	echo $row["USERNAME"].":".$row["USER_TYPE"]."<br>";
}
?>