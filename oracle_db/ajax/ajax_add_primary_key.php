<?
include("./../includes/config.inc.php");
include("./../includes/conn.php");
include("./../includes/function.php");
@ini_set('display_errors', '0');
$table=$_POST["table"];
$constraint_name=$_POST["constraint_name"];
$column=$_POST["column"];

$sql="ALTER TABLE ".$table." add CONSTRAINT ".$constraint_name." PRIMARY KEY (".$column.")";
//print $sql;
$query = oci_parse($conn, $sql);
$result = oci_execute($query);
if($result){
	print "OK";
}
else{
	$err = oci_error($query);
    print "<br><font color='red'>".$err['message']."</font><br>";
}

?>