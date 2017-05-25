<?
include("./../includes/config.inc.php");
include("./../includes/conn.php");
include("./../includes/function.php");
@ini_set('display_errors', '0');
$table=$_POST["table"];
$constraint_name=$_POST["constraint_name"];
$column=$_POST["column"];

$sql="SELECT ".$column." FROM ".$table." GROUP BY ".$column." HAVING COUNT(".$column.") > 1 ";
$query = @oci_parse($conn, $sql );
@oci_execute($query);
$in=0;
while($dbarr = @oci_fetch_array($query, OCI_BOTH)){
			//print $dbarr[$column_name]."<br>";
		$in++;
}

print $in;

?>