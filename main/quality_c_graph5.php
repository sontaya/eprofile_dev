<?
include('../graph/phpgraphlib.php');
include('../graph/phpgraphlib_pie.php');
//require_once("../includes/config.inc.php");

define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
define("TB_CURRENT_WORK_TAB","SDU_CURRENT_WORK_TAB ");

date_default_timezone_set("Asia/Bangkok");
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$num5_all = 0;
$num6_all = 0;
/*	$num1 = 0;// ศ. 04
	$num2 = 0;// รศ. 03
	$num3 = 0;// รศ.พิเศษ 06
	$num4 = 0;// ผศ. 02
	$num5 = 0;// ผศ.พิเศษ 05
	$num6 = 0;// อาจารย์ 01*/
/*	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$p5 = 0;
	$p6 = 0;*/
		$sql_all = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS <> '00'  AND CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_all = oci_parse($conn, $sql_all );
		oci_execute($stid_all);
		$num =  oci_fetch_array($stid_all, OCI_BOTH);
		 $all_person = $num[0];//จะนวนอาจารย์ทั้งหมดแต่ละแผนก
		
		if($all_person > 0){
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '04' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p1 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '03' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p2 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '06' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p3 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '02' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p4 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '05' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p5 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '01' AND  CWK_MUA_MAIN = '".$_REQUEST['type']."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'    ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$p6 = $num[0];
		
		
	$num1_all = $p1; 
	$num2_all = $p2;
	$num3_all = $p3;
	$num4_all = $p4;
	$num5_all = $p5;
	$num6_all =  $p6;
	
/*	echo $t1 = ($num1_all/$total)*100; echo "<br />";
	echo $t2 = ($num2_all/$total)*100; echo "<br />";
	echo $t3 = ($num3_all/$total)*100; echo "<br />";
	echo $t4 = ($num4_all/$total)*100; echo "<br />";
	echo $t5 = ($num5_all/$total)*100; echo "<br />";
	echo $t6 = ($num6_all/$total)*100;*/
	
	 /*$t1 = ($num1_all/$total)*100; 
	 $t2 = ($num2_all/$total)*100; 
	 $t3 = ($num3_all/$total)*100; 
	 $t4 = ($num4_all/$total)*100; 
	 $t5 = ($num5_all/$total)*100; 
	 $t6 = ($num6_all/$total)*100;*/

$data['A'] = $num1_all;
$data['B'] = $num2_all;
$data['C'] = $num3_all;
$data['D'] = $num4_all;
$data['E'] = $num5_all;
$data['F'] = $num6_all;

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