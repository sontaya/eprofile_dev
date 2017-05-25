<?
include('../graph/phpgraphlib.php');
//require_once("../includes/config.inc.php");

define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
define("TB_CURRENT_WORK_TAB","SDU_CURRENT_WORK_TAB ");
define("TB_EDUCATION_TAB","SDU_EDUCATION_TAB");

date_default_timezone_set("Asia/Bangkok");
function count_row($tbl,$where,$conn){
	$sql = "SELECT COUNT(*)  FROM ".$tbl." ".$where;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	oci_free_statement($stid);
	return $row['COUNT(*)'];
}
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$t1 = 0;
$t2 = 0;
$t3 = 0;
$t4 = 0;
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
	$sql_count = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_EMP_TYPE = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$num1 = 0;// ปริญญาเอก
	$num2 = 0;// ปริญญาโท
	$num3 = 0;// ปริญญาตรี
	$num4 = 0;
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$all_person =  count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_EMP_TYPE = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn); 
	if($all_person > 0){
	while (($row_count = oci_fetch_array($stid_count, OCI_BOTH))) {
		$sql_count1 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '80' AND EMP_ID = '".$row_count['EMP_ID']."'   ";
		$stid_count1 = oci_parse($conn, $sql_count1 );
		oci_execute($stid_count1);
		while($row_count1 = oci_fetch_array($stid_count1, OCI_BOTH)){
			$num1++ ;
			$c1++;
			break;
		}
		
		if($c1 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count2 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '60'  AND EMP_ID = '".$row_count['EMP_ID']."'   ";
			$stid_count2 = oci_parse($conn, $sql_count2 );
			oci_execute($stid_count2);
			while($row_count2 = oci_fetch_array($stid_count2, OCI_BOTH)){
				$num2++ ;
				$c2++;
				break;
			}
			
		if($c2 > 0 ){
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count3 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '40'  AND EMP_ID = '".$row_count['EMP_ID']."'  ";
			$stid_count3 = oci_parse($conn, $sql_count3 );
			oci_execute($stid_count3);
			while($row_count3 = oci_fetch_array($stid_count3, OCI_BOTH)){
				$num3++ ;
				$c3++;
				break;
			}
			
		if($c3 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
			$num4++;
			
	}	// end while all EMP_ID
	
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;

 $data['Doctor'] = $num1_all;
 $data['Master'] = $num2_all;
 $data['Bachelor'] =$num3_all;
 $data['Other'] = $num4_all;

$graph = new PHPGraphLib(500,350);
$graph->setXValuesHorizontal(true);
$graph->addData($data);
$graph->setDataValues(true); // ใส่ตัวเลขไว้บนแท่งกราฟ
$graph->setBarColor('purple');
$graph->setBackgroundColor("#fff");
$graph->createGraph();
} // end if $num>0

oci_close($conn);
?>