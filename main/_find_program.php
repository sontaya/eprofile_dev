<?
$fpath = '';
require_once($fpath."../includes/connect.php");

$search = trim($_REQUEST["txt"]);
$n = 0;
$sql = "SELECT * FROM  ".TB_REF_PROGRAM."  WHERE PROGRAM_NAME LIKE '%$search%' ORDER BY PROGRAM_NAME ASC";
$numrow = $db->count_row(TB_REF_PROGRAM," WHERE PROGRAM_NAME LIKE '%$search%'  ",$conn);
if($numrow >0){
	
	?>
 <table border='0' cellpadding="5" align="center">   
    <?
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$bgcolor="#CCCCCC";
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	if($bgcolor=="#CCCCCC"){
		$bgcolor="#EBEBEB";
	}
	else{
		$bgcolor="#CCCCCC";
	}
	$n++;
echo "\n<tr bgcolor='".$bgcolor."'><td>$n.</td><td width='450' align='left' valign='top'><samp style='cursor:pointer' title='เลือก' onclick=\"pick_program('$n')\">".$row['PROGRAM_NAME']."</samp> <input type='hidden' id='id$n' value='".$row['PROGRAM_ID']."' ><input type='hidden' id='name$n' value='".$row['PROGRAM_NAME']."' >";
//echo "<br />";
echo " ";

}
?>
</table>
<?
}else echo "0";

   oci_free_statement($stid);
   $db->closedb($conn);
?>