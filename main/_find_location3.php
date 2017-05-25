<?
$fpath = '';
require_once($fpath."../includes/connect.php");

$search = $_REQUEST["txt"];
$n = 0;
 $sql = "SELECT * FROM SDU_REF_TUMBON WHERE NAME_REF_TUMBON LIKE '%$search%' ";	
$numrow = $db->count_row("SDU_REF_TUMBON"," WHERE NAME_REF_TUMBON LIKE '%$search%' ",$conn);
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
echo "\n<tr bgcolor='".$bgcolor."'><td>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"pick_location3('$n')\"> ตำบล".$row['NAME_REF_TUMBON']."<input type='hidden' id='t$n' value='".$row['CODE_REF_TUMBON']."' ><input type='hidden' id='n1$n' value='".$row['NAME_REF_TUMBON']."' >";
//echo "<br />";
echo " ";

$tumbon = $row['CODE_REF_TUMBON'];
$ref_amphur = substr($tumbon,2,2);
$ref_province = substr($tumbon,0,2);
$ref_tumbon = substr($tumbon,4,4);

$sql2 = "SELECT * FROM SDU_REF_AMPHUR WHERE CODE_REF_AMPHUR LIKE '$ref_province$ref_amphur%' ";	
//echo "<br />";
$stid2 = oci_parse($conn, $sql2 );
oci_execute($stid2);
while (($row2 = oci_fetch_array($stid2, OCI_BOTH))) {
	
echo " อำเภอ",$row2['NAME_REF_AMPHUR']." <input type='hidden' id='a$n' value='".$row2['CODE_REF_AMPHUR']."' ><input type='hidden' id='n2$n' value='".$row2['NAME_REF_AMPHUR']."' >";
	//echo "<br />";
echo " ";
}


$sql3 = "SELECT * FROM SDU_REF_PROVINCE WHERE CODE_REF_PROVINCE LIKE '$ref_province%'  ";	
//echo "<br />";
$stid3 = oci_parse($conn, $sql3 );
oci_execute($stid3);
while (($row3 = oci_fetch_array($stid3, OCI_BOTH))) {
echo " จังหวัด",$row3['NAME_REF_PROVINCE']."<input type='hidden' id='p$n' value='".$row3['CODE_REF_PROVINCE']."' ><input type='hidden' id='n3$n' value='".$row3['NAME_REF_PROVINCE']."' >";
	//echo "<br />";
echo " ";
}

       $sql4 = "SELECT * FROM SDU_REF_AMPHUR WHERE CODE_REF_AMPHUR LIKE '$ref_province$ref_amphur%' ";
//echo "<br />";
      $stid4 = oci_parse($conn, $sql4);
      oci_execute($stid4);
      while (($row4 = oci_fetch_array($stid4, OCI_BOTH))) {

      $sql5 = "SELECT * FROM SDU_REF_POST_CODE WHERE PC_AMPHUR LIKE '{$row4['NAME_REF_AMPHUR']}%'  ";
//echo "<br />";
      $stid5 = oci_parse($conn, $sql5);
      oci_execute($stid5);
      $row5 = oci_fetch_array($stid5, OCI_BOTH); 
        //echo "รหัสไปรษณีย์", $row4['PC_ID'] . "<input type='hidden' id='n4$n' value='" . $row4['PC_ID'] . "' >";
        echo " ", $row5['PC_ID'] . "<input type='hidden' id='c$n' value='" . $row5['PC_ID'] . "' >";
        //echo "<br />";
        echo " </samp></td></tr>\n";
      
      }


}
?>
</table>
<?
}else echo "0";

   oci_free_statement($stid);
   $db->closedb($conn);
?>