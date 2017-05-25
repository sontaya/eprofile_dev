<?
$fpath = '';
require_once($fpath."../includes/connect.php");

$search = trim($_REQUEST["txt"]);
$n = 0;
 $sql = "SELECT * FROM  ".TB_REF_NATION." WHERE NATION_NAME_TH LIKE '%$search%'  OR NATION_NAME_ENG LIKE '%$search%' ORDER BY NATION_NAME_TH ASC";	
$numrow = $db->count_row(TB_REF_NATION," WHERE NATION_NAME_TH LIKE '%$search%' OR NATION_NAME_ENG LIKE '%$search%' ",$conn);
if($numrow >0){
	
	?>
  <samp style="color:#FF0000;">*คลิ๊กที่รายชื่อประเทศ</samp>
 <table border='0' cellpadding="5" align="center" class="all_table">   
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
echo "\n<tr bgcolor='".$bgcolor."'><td>$n.</td><td width='400' align='left'><samp style='cursor:pointer' onclick=\"pick_nation1('$n')\" title='เลือก'>".$row['NATION_NAME_TH']."(".$row['NATION_NAME_ENG'].") </samp><input type='hidden' id='id$n' value='".$row['NATION_ID']."' ><input type='hidden' id='name$n' value='".$row['NATION_NAME_TH']."' >";
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