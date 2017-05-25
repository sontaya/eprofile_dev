<?
include("../includes/connect.php");
ini_set('max_execution_time', 300);
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
list($begin_day,$begin_month,$begin_year) = explode("/",$_REQUEST["date1"]);
list($end_day,$end_month,$end_year) = explode("/",$_REQUEST["date2"]);
$d1 = date2_formatdb($_REQUEST["date1"]);
$d2 = date2_formatdb($_REQUEST["date2"]);

$all_person1 = 0;
$all_person2 = 0;
$all_person3 = 0;
$all_person4 = 0;
$all_person5 = 0;
$all_person6 = 0;
$all_person7 = 0;
$all_person8 = 0;

$num1_all11 = 0;
$num2_all11 = 0;

$num1_all21 = 0;
$num2_all21= 0;
$num3_all21 = 0;
$num4_all21 = 0;

$num1_all31 = 0;
$num2_all31 = 0;

$num1_all41 = 0;
$num2_all41= 0;
$num3_all41 = 0;
$num4_all41 = 0;

$num1_all51 = 0;
$num2_all51 = 0;

$num1_all61 = 0;
$num2_all61= 0;
$num3_all61 = 0;
$num4_all61 = 0;

$num1_all71 = 0;
$num2_all71 = 0;

$num1_all81 = 0;
$num2_all81= 0;
$num3_all81 = 0;
$num4_all81 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '02' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person1++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp11 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp11 > 0 ) $num1_all11++;//เอก
			
			$num2_all_temp11 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp11 > 0 ) $num2_all11++;//โท
		}
		
		$num1_all_temp21 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp21 > 0 ) $num1_all21++;
		
		$num2_all_temp21 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp21 > 0 ) $num2_all21++;
		
		$num3_all_temp21 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp21 > 0 ) $num3_all21++;
		
		$num4_all_temp21 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp21 > 0 ) $num4_all21++;
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp31 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp31 > 0 ) $num1_all31++;//เอก
			
			$num2_all_temp31 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp31 > 0 ) $num2_all31++;//โท
		}
		
		$num1_all_temp41 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp41 > 0 ) $num1_all41++;
		
		$num2_all_temp41 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp41 > 0 ) $num2_all41++;
		
		$num3_all_temp41 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp41 > 0 ) $num3_all41++;
		
		$num4_all_temp41 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp41 > 0 ) $num4_all41++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp51 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp51 > 0 ) $num1_all51++;//เอก
			
			$num2_all_temp51 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp51 > 0 ) $num2_all51++;//โท
		}
		
		$num1_all_temp61 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp61 > 0 ) $num1_all61++;
		
		$num2_all_temp61 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp61 > 0 ) $num2_all61++;
		
		$num3_all_temp61 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp61 > 0 ) $num3_all61++;
		
		$num4_all_temp61 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp61 > 0 ) $num4_all61++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp71 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp71 > 0 ) $num1_all71++;//เอก
			
			$num2_all_temp71 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp71 > 0 ) $num2_all71++;//โท
		}
		
		$num1_all_temp81 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp81 > 0 ) $num1_all81++;
		
		$num2_all_temp81 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp81 > 0 ) $num2_all81++;
		
		$num3_all_temp81 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp81 > 0 ) $num3_all81++;
		
		$num4_all_temp81 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '02'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp81 > 0 ) $num4_all81++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total11 += $num1_all11 + $num2_all11;

	$total21 += $num1_all21 + $num2_all21 + $num3_all21 + $num4_all21;

	$total31 += $num1_all31 + $num1_all31;

	$total41 += $num1_all41 + $num2_all41 + $num3_all41 + $num4_all41;
	
	$total51 += $num1_all51 + $num1_all51;
	
	$total61 += $num1_all61 + $num2_all61 + $num3_all61 + $num4_all61;
	
	$total71 += $num1_all71 + $num1_all71;
	
	$total81 += $num1_all81 + $num2_all81 + $num3_all81 + $num4_all81;


$num1_all12 = 0;
$num2_all12 = 0;

$num1_all22 = 0;
$num2_all22 = 0;
$num3_all22 = 0;
$num4_all22 = 0;

$num1_all32 = 0;
$num2_all32 = 0;

$num1_all42 = 0;
$num2_all42 = 0;
$num3_all42 = 0;
$num4_all42 = 0;

$num1_all52 = 0;
$num2_all52 = 0;

$num1_all62 = 0;
$num2_all62 = 0;
$num3_all62 = 0;
$num4_all62 = 0;

$num1_all72 = 0;
$num2_all72 = 0;

$num1_all82 = 0;
$num2_all82 = 0;
$num3_all82 = 0;
$num4_all82 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '03' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person2++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp12 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp12 > 0 ) $num1_all12++;//เอก
			
			$num2_all_temp12 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp12 > 0 ) $num2_all12++;//โท
		}
		
		$num1_all_temp22 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp22 > 0 ) $num1_all22++;
		
		$num2_all_temp22 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp22 > 0 ) $num2_all22++;
		
		$num3_all_temp22 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp22 > 0 ) $num3_all22++;
		
		$num4_all_temp22 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp22 > 0 ) $num4_all22++;
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp32 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp32 > 0 ) $num1_all32++;//เอก
			
			$num2_all_temp32 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp32 > 0 ) $num2_all32++;//โท
		}
		
		$num1_all_temp42 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp42 > 0 ) $num1_all42++;
		
		$num2_all_temp42 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp42 > 0 ) $num2_all42++;
		
		$num3_all_temp42 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp42 > 0 ) $num3_all42++;
		
		$num4_all_temp42 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp42 > 0 ) $num4_all42++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp52 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp52 > 0 ) $num1_all52++;//เอก
			
			$num2_all_temp52 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp52 > 0 ) $num2_all52++;//โท
		}
		
		$num1_all_temp62 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp62 > 0 ) $num1_all62++;
		
		$num2_all_temp62 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp62 > 0 ) $num2_all62++;
		
		$num3_all_temp62 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp62 > 0 ) $num3_all62++;
		
		$num4_all_temp62 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp62 > 0 ) $num4_all62++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp72 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp72 > 0 ) $num1_all72++;//เอก
			
			$num2_all_temp72 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp72 > 0 ) $num2_all72++;//โท
		}
		
		$num1_all_temp82 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp82 > 0 ) $num1_all82++;
		

		$num2_all_temp82 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp82 > 0 ) $num2_all82++;
		
		$num3_all_temp82 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp82 > 0 ) $num3_all82++;
		
		$num4_all_temp82 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '03'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp82 > 0 ) $num4_all82++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total12 += $num1_all12 + $num2_all12;

	$total22 += $num1_all22 + $num2_all22 + $num3_all22 + $num4_all22;

	$total32 += $num1_all32 + $num1_all32;

	$total42 += $num1_all42 + $num2_all42 + $num3_all42 + $num4_all42;
	
	$total52 += $num1_all52 + $num1_all52;
	
	$total62 += $num1_all62 + $num2_all62 + $num3_all62 + $num4_all62;
	
	$total72 += $num1_all72 + $num1_all72;
	
	$total82 += $num1_all82 + $num2_all82 + $num3_all82 + $num4_all82;
	


$num1_all13 = 0;
$num2_all13 = 0;

$num1_all23 = 0;
$num2_all23 = 0;
$num3_all23 = 0;
$num4_all23 = 0;

$num1_all33 = 0;
$num2_all33 = 0;

$num1_all43 = 0;
$num2_all43 = 0;
$num3_all43 = 0;
$num4_all43 = 0;

$num1_all53 = 0;
$num2_all53 = 0;

$num1_all63 = 0;
$num2_all63 = 0;
$num3_all63 = 0;
$num4_all63 = 0;

$num1_all73 = 0;
$num2_all73 = 0;

$num1_all83 = 0;
$num2_all83 = 0;
$num3_all83 = 0;
$num4_all83 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '04' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person3++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp13 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp13 > 0 ) $num1_all13++;//เอก
			
			$num2_all_temp13 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp13 > 0 ) $num2_all13++;//โท
		}
		
		$num1_all_temp23 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp23 > 0 ) $num1_all23++;
		
		$num2_all_temp23 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp23 > 0 ) $num2_all23++;
		
		$num3_all_temp23 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp23 > 0 ) $num3_all23++;
		
		$num4_all_temp23 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp23 > 0 ) $num4_all23++;
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp33 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp33 > 0 ) $num1_all33++;//เอก
			
			$num2_all_temp33 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp33 > 0 ) $num2_all33++;//โท
		}
		
		$num1_all_temp43 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp43 > 0 ) $num1_all43++;
		
		$num2_all_temp43 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp43 > 0 ) $num2_all43++;
		
		$num3_all_temp43 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp43 > 0 ) $num3_all43++;
		
		$num4_all_temp43 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp43 > 0 ) $num4_all43++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp53 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp53 > 0 ) $num1_all53++;//เอก
			
			$num2_all_temp53 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp53 > 0 ) $num2_all53++;//โท
		}
		
		$num1_all_temp63 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp63 > 0 ) $num1_all63++;
		
		$num2_all_temp63 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp63 > 0 ) $num2_all63++;
		
		$num3_all_temp63 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp63 > 0 ) $num3_all63++;
		
		$num4_all_temp63 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp63 > 0 ) $num4_all63++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp73 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp73 > 0 ) $num1_all73++;//เอก
			
			$num2_all_temp73 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp73 > 0 ) $num2_all73++;//โท
		}
		
		$num1_all_temp83 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp83 > 0 ) $num1_all83++;
		
		$num2_all_temp83 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp83 > 0 ) $num2_all83++;
		
		$num3_all_temp83 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp83 > 0 ) $num3_all83++;
		
		$num4_all_temp83 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '04'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp83 > 0 ) $num4_all83++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total13 += $num1_all13 + $num2_all13;

	$total23 += $num1_all23 + $num2_all23 + $num3_all23 + $num4_all23;

	$total33 += $num1_all33 + $num1_all33;

	$total43 += $num1_all43 + $num2_all43 + $num3_all43 + $num4_all43;
	
	$total53 += $num1_all53 + $num1_all53;
	
	$total63 += $num1_all63 + $num2_all63 + $num3_all63 + $num4_all63;
	
	$total73 += $num1_all73 + $num1_all73;
	
	$total83 += $num1_all83 + $num2_all83 + $num3_all83 + $num4_all83;
	


$num1_all14 = 0;
$num2_all14 = 0;

$num1_all24 = 0;
$num2_all24 = 0;
$num3_all24 = 0;
$num4_all24 = 0;

$num1_all34 = 0;
$num2_all34 = 0;

$num1_all44 = 0;
$num2_all44 = 0;
$num3_all44 = 0;
$num4_all44 = 0;

$num1_all54 = 0;
$num2_all54 = 0;

$num1_all64 = 0;
$num2_all64 = 0;
$num3_all64 = 0;
$num4_all64 = 0;

$num1_all74 = 0;
$num2_all74 = 0;

$num1_all84 = 0;
$num2_all84 = 0;
$num3_all84 = 0;
$num4_all84 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '05' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person4++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp14 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp14 > 0 ) $num1_all14++;//เอก
			
			$num2_all_temp14 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp14 > 0 ) $num2_all14++;//โท
		}
		
		$num1_all_temp24 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp24 > 0 ) $num1_all24++;
		
		$num2_all_temp24 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp24 > 0 ) $num2_all24++;
		
		$num3_all_temp24 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp24 > 0 ) $num3_all24++;
		
		$num4_all_temp24 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp24 > 0 ) $num4_all24++;
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp34 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp34 > 0 ) $num1_all34++;//เอก
			
			$num2_all_temp34 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp34 > 0 ) $num2_all34++;//โท
		}
		
		$num1_all_temp44 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp44 > 0 ) $num1_all44++;
		
		$num2_all_temp44 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp44 > 0 ) $num2_all44++;
		
		$num3_all_temp44 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp44 > 0 ) $num3_all44++;
		
		$num4_all_temp44 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp44 > 0 ) $num4_all44++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp54 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp54 > 0 ) $num1_all54++;//เอก
			
			$num2_all_temp54 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp54 > 0 ) $num2_all54++;//โท
		}
		
		$num1_all_temp64 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp64 > 0 ) $num1_all64++;
		
		$num2_all_temp64 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp64 > 0 ) $num2_all64++;
		
		$num3_all_temp64 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp64 > 0 ) $num3_all64++;
		
		$num4_all_temp64 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp64 > 0 ) $num4_all64++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp74 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp74 > 0 ) $num1_all74++;//เอก
			
			$num2_all_temp74 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp74 > 0 ) $num2_all74++;//โท
		}
		
		$num1_all_temp84 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp84 > 0 ) $num1_all84++;
		
		$num2_all_temp84 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp84 > 0 ) $num2_all84++;
		
		$num3_all_temp84 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp84 > 0 ) $num3_all84++;
		
		$num4_all_temp84 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '05'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp84 > 0 ) $num4_all84++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total14 += $num1_all14 + $num2_all14;

	$total24 += $num1_all24 + $num2_all24 + $num3_all24 + $num4_all24;

	$total34 += $num1_all34 + $num1_all34;

	$total44 += $num1_all44 + $num2_all44 + $num3_all44 + $num4_all44;
	
	$total54 += $num1_all54 + $num1_all54;
	
	$total64 += $num1_all64 + $num2_all64 + $num3_all64 + $num4_all64;
	
	$total74 += $num1_all74 + $num1_all74;
	
	$total84 += $num1_all84 + $num2_all84 + $num3_all84 + $num4_all84;


$num1_all15 = 0;
$num2_all15 = 0;

$num1_all25 = 0;
$num2_all25 = 0;
$num3_all25 = 0;
$num4_all25 = 0;

$num1_all35 = 0;
$num2_all35 = 0;

$num1_all45 = 0;
$num2_all45 = 0;
$num3_all45 = 0;
$num4_all45 = 0;

$num1_all55 = 0;
$num2_all55 = 0;

$num1_all65 = 0;
$num2_all65 = 0;
$num3_all65 = 0;
$num4_all65 = 0;

$num1_all75 = 0;
$num2_all75 = 0;

$num1_all85 = 0;
$num2_all85 = 0;
$num3_all85 = 0;
$num4_all85 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '11' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person5++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp15 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp15 > 0 ) $num1_all15++;//เอก
			
			$num2_all_temp15 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp15 > 0 ) $num2_all15++;//โท
		}
		
		$num1_all_temp25 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp25 > 0 ) $num1_all25++;
		
		$num2_all_temp25 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp25 > 0 ) $num2_all25++;
		
		$num3_all_temp25 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp25 > 0 ) $num3_all25++;
		
		$num4_all_temp25 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp25 > 0 ) $num4_all25++;
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp35 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp35 > 0 ) $num1_all35++;//เอก
			
			$num2_all_temp35 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp35 > 0 ) $num2_all35++;//โท
		}
		
		$num1_all_temp45 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp45 > 0 ) $num1_all45++;
		
		$num2_all_temp45 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp45 > 0 ) $num2_all45++;
		
		$num3_all_temp45 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp45 > 0 ) $num3_all45++;
		
		$num4_all_temp45 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp45 > 0 ) $num4_all45++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp55 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp55 > 0 ) $num1_all55++;//เอก
			
			$num2_all_temp55 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp55 > 0 ) $num2_all55++;//โท
		}
		
		$num1_all_temp65 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp65 > 0 ) $num1_all65++;
		
		$num2_all_temp65 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp65 > 0 ) $num2_all65++;
		
		$num3_all_temp65 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp65 > 0 ) $num3_all65++;
		
		$num4_all_temp65 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp65 > 0 ) $num4_all65++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp75 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp75 > 0 ) $num1_all75++;//เอก
			
			$num2_all_temp75 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp75 > 0 ) $num2_all75++;//โท
		}
		
		$num1_all_temp85 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp85 > 0 ) $num1_all85++;
		
		$num2_all_temp85 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp85 > 0 ) $num2_all85++;
		
		$num3_all_temp85 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp85 > 0 ) $num3_all85++;
		
		$num4_all_temp85 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '11'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp85 > 0 ) $num4_all85++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total15 += $num1_all15 + $num2_all15;

	$total25 += $num1_all25 + $num2_all25 + $num3_all25 + $num4_all25;

	$total35 += $num1_all35 + $num1_all35;

	$total45 += $num1_all45 + $num2_all45 + $num3_all45 + $num4_all45;
	
	$total55 += $num1_all55 + $num1_all55;
	
	$total65 += $num1_all65 + $num2_all65 + $num3_all65 + $num4_all65;
	
	$total75 += $num1_all75 + $num1_all75;
	
	$total85 += $num1_all85 + $num2_all85 + $num3_all85 + $num4_all85;



$num1_all16 = 0;
$num2_all16 = 0;

$num1_all26 = 0;
$num2_all26 = 0;
$num3_all26 = 0;
$num4_all26 = 0;

$num1_all36 = 0;
$num2_all36 = 0;

$num1_all46 = 0;
$num2_all46 = 0;
$num3_all46 = 0;
$num4_all46 = 0;

$num1_all56 = 0;
$num2_all56 = 0;

$num1_all66 = 0;
$num2_all66 = 0;
$num3_all66 = 0;
$num4_all66 = 0;

$num1_all76 = 0;
$num2_all76 = 0;

$num1_all86 = 0;
$num2_all86 = 0;
$num3_all86 = 0;
$num4_all86 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '15' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person6++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp16 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp16 > 0 ) $num1_all16++;//เอก
			
			$num2_all_temp16 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp16 > 0 ) $num2_all16++;//โท
		}
		
		$num1_all_temp26 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp26 > 0 ) $num1_all26++;
		
		$num2_all_temp26 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp26 > 0 ) $num2_all26++;
		
		$num3_all_temp26 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp26 > 0 ) $num3_all26++;
		
		$num4_all_temp26 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp26 > 0 ) $num4_all26++;
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp36 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp36 > 0 ) $num1_all36++;//เอก
			
			$num2_all_temp36 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp36 > 0 ) $num2_all36++;//โท
		}
		
		$num1_all_temp46 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp46 > 0 ) $num1_all46++;
		
		$num2_all_temp46 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp46 > 0 ) $num2_all46++;
		
		$num3_all_temp46 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp46 > 0 ) $num3_all46++;
		
		$num4_all_temp46 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp46 > 0 ) $num4_all46++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp56 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp56 > 0 ) $num1_all56++;//เอก
			
			$num2_all_temp56 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp56 > 0 ) $num2_all56++;//โท
		}
		
		$num1_all_temp66 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp66 > 0 ) $num1_all66++;
		
		$num2_all_temp66 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp66 > 0 ) $num2_all66++;
		
		$num3_all_temp66 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp66 > 0 ) $num3_all66++;
		
		$num4_all_temp66 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp66 > 0 ) $num4_all66++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp76 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp76 > 0 ) $num1_all76++;//เอก
			
			$num2_all_temp76 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp76 > 0 ) $num2_all76++;//โท
		}
		
		$num1_all_temp86 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp86 > 0 ) $num1_all86++;
		
		$num2_all_temp86 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp86 > 0 ) $num2_all86++;
		
		$num3_all_temp86 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp86 > 0 ) $num3_all86++;
		
		$num4_all_temp86 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '15'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp86 > 0 ) $num4_all86++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total16 += $num1_all16 + $num2_all16;

	$total26 += $num1_all26 + $num2_all26 + $num3_all26 + $num4_all26;

	$total36 += $num1_all36 + $num1_all36;

	$total46 += $num1_all46 + $num2_all46 + $num3_all46 + $num4_all46;
	
	$total56 += $num1_all56 + $num1_all56;
	
	$total66 += $num1_all66 + $num2_all66 + $num3_all66 + $num4_all66;
	
	$total76 += $num1_all76 + $num1_all76;
	
	$total86 += $num1_all86 + $num2_all86 + $num3_all86 + $num4_all86;
	
	
$num1_all17 = 0;
$num2_all17 = 0;

$num1_all27 = 0;
$num2_all27 = 0;
$num3_all27 = 0;
$num4_all27 = 0;

$num1_all37 = 0;
$num2_all37 = 0;

$num1_all47 = 0;
$num2_all47 = 0;
$num3_all47 = 0;
$num4_all47 = 0;

$num1_all57 = 0;
$num2_all57 = 0;

$num1_all67 = 0;
$num2_all67 = 0;
$num3_all67 = 0;
$num4_all67 = 0;

$num1_all77 = 0;
$num2_all77 = 0;

$num1_all87 = 0;
$num2_all87 = 0;
$num3_all87 = 0;
$num4_all87 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '16' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person7++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp17 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp17 > 0 ) $num1_all17++;//เอก
			
			$num2_all_temp17 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp17 > 0 ) $num2_all17++;//โท
		}
		
		$num1_all_temp27 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp27 > 0 ) $num1_all27++;
		
		$num2_all_temp27 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp27 > 0 ) $num2_all27++;
		
		$num3_all_temp27 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp27 > 0 ) $num3_all27++;
		
		$num4_all_temp27 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp27 > 0 ) $num4_all27++;
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp37 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp37 > 0 ) $num1_all37++;//เอก
			
			$num2_all_temp37 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp37 > 0 ) $num2_all37++;//โท
		}
		
		$num1_all_temp47 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp47 > 0 ) $num1_all47++;
		
		$num2_all_temp47 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp47 > 0 ) $num2_all47++;
		
		$num3_all_temp47 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp47 > 0 ) $num3_all47++;
		
		$num4_all_temp47 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp47 > 0 ) $num4_all47++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp57 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp57 > 0 ) $num1_all57++;//เอก
			
			$num2_all_temp57 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp57 > 0 ) $num2_all57++;//โท
		}
		
		$num1_all_temp67 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp67 > 0 ) $num1_all67++;
		
		$num2_all_temp67 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp67 > 0 ) $num2_all67++;
		
		$num3_all_temp67 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp67 > 0 ) $num3_all67++;
		
		$num4_all_temp67 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp67 > 0 ) $num4_all67++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp77 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp77 > 0 ) $num1_all77++;//เอก
			
			$num2_all_temp77 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp77 > 0 ) $num2_all77++;//โท
		}
		
		$num1_all_temp87 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp87 > 0 ) $num1_all87++;
		
		$num2_all_temp87 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp87 > 0 ) $num2_all87++;
		
		$num3_all_temp87 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp87 > 0 ) $num3_all87++;
		
		$num4_all_temp87 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '16'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp87 > 0 ) $num4_all87++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total17 += $num1_all17 + $num2_all17;

	$total27 += $num1_all27 + $num2_all27 + $num3_all27 + $num4_all27;

	$total37 += $num1_all37 + $num1_all37;

	$total47 += $num1_all47 + $num2_all47 + $num3_all47 + $num4_all47;
	
	$total57 += $num1_all57 + $num1_all57;
	
	$total67 += $num1_all67 + $num2_all67 + $num3_all67 + $num4_all67;
	
	$total77 += $num1_all77 + $num1_all77;
	
	$total87 += $num1_all87 + $num2_all87 + $num3_all87 + $num4_all87;
	
	
$num1_all18 = 0;
$num2_all18 = 0;

$num1_all28 = 0;
$num2_all28 = 0;
$num3_all28 = 0;
$num4_all28 = 0;

$num1_all38 = 0;
$num2_all38 = 0;

$num1_all48 = 0;
$num2_all48 = 0;
$num3_all48 = 0;
$num4_all48 = 0;

$num1_all58 = 0;
$num2_all58 = 0;

$num1_all68 = 0;
$num2_all68 = 0;
$num3_all68 = 0;
$num4_all68 = 0;

$num1_all78 = 0;
$num2_all78 = 0;

$num1_all88 = 0;
$num2_all88 = 0;
$num3_all88 = 0;
$num4_all88 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '17' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person8++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp18 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp18 > 0 ) $num1_all18++;//เอก
			
			$num2_all_temp18 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp18 > 0 ) $num2_all18++;//โท
		}
		
		$num1_all_temp28 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp28 > 0 ) $num1_all28++;
		
		$num2_all_temp28 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp28 > 0 ) $num2_all28++;
		
		$num3_all_temp28 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp28 > 0 ) $num3_all28++;
		
		$num4_all_temp28 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp28 > 0 ) $num4_all28++;
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp38 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp38 > 0 ) $num1_all38++;//เอก
			
			$num2_all_temp38 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp38 > 0 ) $num2_all38++;//โท
		}
		
		$num1_all_temp48 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp48 > 0 ) $num1_all48++;
		
		$num2_all_temp48 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp48 > 0 ) $num2_all48++;
		
		$num3_all_temp48 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp48 > 0 ) $num3_all48++;
		
		$num4_all_temp48 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp48 > 0 ) $num4_all48++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp58 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp58 > 0 ) $num1_all58++;//เอก
			
			$num2_all_temp58 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp58 > 0 ) $num2_all58++;//โท
		}
		
		$num1_all_temp68 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp68 > 0 ) $num1_all68++;
		
		$num2_all_temp68 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp68 > 0 ) $num2_all68++;
		
		$num3_all_temp68 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp68 > 0 ) $num3_all68++;
		
		$num4_all_temp68 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp68 > 0 ) $num4_all68++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp78 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp78 > 0 ) $num1_all78++;//เอก
			
			$num2_all_temp78 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp78 > 0 ) $num2_all78++;//โท
		}
		
		$num1_all_temp88 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp88 > 0 ) $num1_all88++;
		
		$num2_all_temp88 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp88 > 0 ) $num2_all88++;
		
		$num3_all_temp88 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp88 > 0 ) $num3_all88++;
		
		$num4_all_temp88 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '17'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp88 > 0 ) $num4_all88++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total18 += $num1_all18 + $num2_all18;

	$total28 += $num1_all28 + $num2_all28 + $num3_all28 + $num4_all28;

	$total38 += $num1_all38 + $num1_all38;

	$total48 += $num1_all48 + $num2_all48 + $num3_all48 + $num4_all48;
	
	$total58 += $num1_all58 + $num1_all58;
	
	$total68 += $num1_all68 + $num2_all68 + $num3_all68 + $num4_all68;
	
	$total78 += $num1_all78 + $num1_all78;
	
	$total88 += $num1_all88 + $num2_all88 + $num3_all88 + $num4_all88;
	

$num1_all19 = 0;
$num2_all19 = 0;

$num1_all29 = 0;
$num2_all29 = 0;
$num3_all29 = 0;
$num4_all29 = 0;

$num1_all39 = 0;
$num2_all39 = 0;

$num1_all49 = 0;
$num2_all49 = 0;
$num3_all49 = 0;
$num4_all49 = 0;

$num1_all59 = 0;
$num2_all59 = 0;

$num1_all69 = 0;
$num2_all69 = 0;
$num3_all69 = 0;
$num4_all69 = 0;

$num1_all79 = 0;
$num2_all79 = 0;

$num1_all89 = 0;
$num2_all89 = 0;
$num3_all89 = 0;
$num4_all89 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '12' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person9++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp19 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp19 > 0 ) $num1_all19++;//เอก
			
			$num2_all_temp19 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp19 > 0 ) $num2_all19++;//โท
		}
		
		$num1_all_temp29 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp29 > 0 ) $num1_all29++;
		
		$num2_all_temp29 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp29 > 0 ) $num2_all29++;
		
		$num3_all_temp29 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp29 > 0 ) $num3_all29++;
		
		$num4_all_temp29 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp29 > 0 ) $num4_all29++;
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp39 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp39 > 0 ) $num1_all39++;//เอก
			
			$num2_all_temp39 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp39 > 0 ) $num2_all39++;//โท
		}
		
		$num1_all_temp49 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp49 > 0 ) $num1_all49++;
		
		$num2_all_temp49 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp49 > 0 ) $num2_all49++;
		
		$num3_all_temp49 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp49 > 0 ) $num3_all49++;
		
		$num4_all_temp49 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp49 > 0 ) $num4_all49++;
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp59 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp59 > 0 ) $num1_all59++;//เอก
			
			$num2_all_temp59 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp59 > 0 ) $num2_all59++;//โท
		}
		
		$num1_all_temp69 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp69 > 0 ) $num1_all69++;
		
		$num2_all_temp69 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp69 > 0 ) $num2_all69++;
		
		$num3_all_temp69 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp69 > 0 ) $num3_all69++;
		
		$num4_all_temp69 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp69 > 0 ) $num4_all69++;
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '1'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp79 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp79 > 0 ) $num1_all79++;//เอก
			
			$num2_all_temp79 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp79 > 0 ) $num2_all79++;//โท
		}
		
		$num1_all_temp89 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num1_all_temp89 > 0 ) $num1_all89++;
		
		$num2_all_temp89 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num2_all_temp89 > 0 ) $num2_all89++;
		
		$num3_all_temp89 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num3_all_temp89 > 0 ) $num3_all89++;
		
		$num4_all_temp89 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE  EMP_ID = '".$row_all_person1["EMP_ID"]."' AND   CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_MAIN = '12'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '03'  AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ",$conn);
		if($num4_all_temp89 > 0 ) $num4_all89++;

	}//if $all_person_temp1 > 0
	
	
}//while

	$total19 += $num1_all19 + $num2_all19;

	$total29 += $num1_all29 + $num2_all29 + $num3_all29 + $num4_all29;

	$total39 += $num1_all39 + $num1_all39;

	$total49 += $num1_all49 + $num2_all49 + $num3_all49 + $num4_all49;
	
	$total59 += $num1_all59 + $num1_all59;
	
	$total69 += $num1_all69 + $num2_all69 + $num3_all69 + $num4_all69;
	
	$total79 += $num1_all79 + $num1_all79;
	
	$total89 += $num1_all89 + $num2_all89 + $num3_all89 + $num4_all89;
	
	

$all = ($all_person1+$all_person2+$all_person3+$all_person4+$all_person5+$all_person6+$all_person7+$all_person8+$all_person9);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลบุคลากรสายวิชาการมหาวิทยาลัยราชภัฎสวนดุสิต</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}

.all_table{
	border: #000 2px solid ;
}
.th{
	border-bottom: #000 2px solid ;
	border-right: #000 2px solid ;
}
.th2{
	border-bottom: #000 2px solid ;
}
.fac{
	border-bottom:  solid 1px #666 ;
	border-right: #000 2px solid ;
	padding-bottom: 5px;
}
.fac2{
	border-right: #000 2px solid ;
	padding-bottom: 5px;
}

.fac3{

	font-weight:bold;
}

.data{
	border-bottom:  solid 1px #666 ;
	border-right: #666 1px solid ;
	padding-bottom: 5px;
}
.data2{
	border-bottom:  solid 1px #666 ;
	border-right: #000 2px solid ;
	padding-bottom: 5px;
	font-weight:bold;
}
.data3{
	border-right: #000 2px solid ;
	padding-bottom: 5px;
}
.data4{
	border-right: #000 1px solid ;
	padding-bottom: 5px;
}
.data22{
	border-bottom:  solid 1px #666 ;
	padding-bottom: 5px;
	font-weight:bold;
}
.data222{
	border-right: #666 1px solid ;
	padding-bottom: 5px;
}
</style>
</head>

<body>
<div align="center" style="font-size:14px">ข้อมูลบุคลากรสายวิชาการมหาวิทยาลัยราชภัฎสวนดุสิต <br /><br />
ข้อมูลระหว่าง วันที่ <? echo (int)$begin_day." ".get_month_full((int)$begin_month)." ".($begin_year);?> ถึงวันที่ <? echo (int)$end_day." ".get_month_full((int)$end_month)." ".($end_year);?><br /><br />
ประเภท ข้อมูล คาดว่าจะสำเร็จการศึกษา<br />
<br />
</div>
<table  cellspacing="0" cellpadding="2" class="all_table" align="center">
  <tr>
    <td width="114" rowspan="3" align="center" valign="middle" class="th">หน่วยงาน</td>
    <td width="39" rowspan="3" align="center" valign="middle" class="th">จำนวน<br />ทั้งหมด</td>
    <td height="33" colspan="8" align="center" valign="middle" class="th">ข้าราชการ</td>
    <td colspan="8" align="center" valign="middle" class="th">อาจารย์ประจำตามสัญญาจ้าง</td>
    <td colspan="8" align="center" valign="middle" class="th">พนักงานมหาวิทยาลัย</td>
    <td colspan="8" align="center" valign="middle" class="th">พนักงานราชการ</td>
    <td colspan="8" align="center" valign="middle" class="th2">รวมบุคลากรทั้งหมด</td>
  </tr>
    <tr>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td width="20" rowspan="2" align="center" valign="middle" class="th">รวม</td>
    <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
    <td width="35" rowspan="2" align="center" valign="middle" class="th2">รวม</td>
  </tr>
  <tr>
    <td width="27" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="26" align="center" valign="middle" class="th">โท</td>
    <td width="22" align="center" valign="middle" class="th">ศ.</td>
    <td width="22" align="center" valign="middle" class="th">รศ.</td>
    <td width="24" align="center" valign="middle" class="th">ผศ.</td>
    <td width="22" align="center" valign="middle" class="th">อ.</td>
    <td width="32" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="28" align="center" valign="middle" class="th">โท</td>
    <td width="22" align="center" valign="middle" class="th">ศ.</td>
    <td width="22" align="center" valign="middle" class="th">รศ.</td>
    <td width="24" align="center" valign="middle" class="th">ผศ.</td>
    <td width="22" align="center" valign="middle" class="th">อ.</td>
    <td width="30" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="30" align="center" valign="middle" class="th">โท</td>
    <td width="22" align="center" valign="middle" class="th">ศ.</td>
    <td width="22" align="center" valign="middle" class="th">รศ.</td>
    <td width="24" align="center" valign="middle" class="th">ผศ.</td>
    <td width="22" align="center" valign="middle" class="th">อ.</td>
    <td width="32" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="28" align="center" valign="middle" class="th">โท</td>
    <td width="22" align="center" valign="middle" class="th">ศ.</td>
    <td width="22" align="center" valign="middle" class="th">รศ.</td>
    <td width="24" align="center" valign="middle" class="th">ผศ.</td>
    <td width="22" align="center" valign="middle" class="th">อ.</td>
    <td width="32" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="28" align="center" valign="middle" class="th">โท</td>
    <td width="22" align="center" valign="middle" class="th">ศ.</td>
    <td width="22" align="center" valign="middle" class="th">รศ.</td>
    <td width="24" align="center" valign="middle" class="th">ผศ.</td>
    <td width="22" align="center" valign="middle" class="th">อ.</td>
  </tr>

  <tr >
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะครุศาสตร์</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person1)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all11)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all11)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total11)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all21)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all21)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all21)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all21)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total21)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all31)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all31)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total31)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all41)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all41)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all41)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all41)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total41)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all51)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all51)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total51)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all61)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all61)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all61)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all61)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total61)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all71)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all71)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total71)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all81)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all81)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all81)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all81)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total81)?></td>
    <td align="center" valign="bottom" class="data"><? $e11 = ($num1_all11+$num1_all31+$num1_all51+$num1_all71) ; echo re_hyphen($e11);?></td>
    <td align="center" valign="bottom" class="data"><? $e21 = ($num2_all11+$num2_all31+$num2_all51+$num2_all71) ; echo re_hyphen($e21);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all1 =  $e11+$e21+$e31;echo re_hyphen($e_all1);?></td>
    <td align="center" valign="bottom" class="data"><? $sum11 = ($num1_all21+$num1_all41+$num1_all61+$num1_all81); echo re_hyphen($sum11)?></td>
    <td align="center" valign="bottom" class="data"><? $sum21 = ($num2_all21+$num2_all41+$num2_all61+$num2_all81); echo re_hyphen($sum21)?></td>
    <td align="center" valign="bottom" class="data"><? $sum31 = ($num3_all21+$num3_all41+$num3_all61+$num3_all81); echo re_hyphen($sum31)?></td>
    <td align="center" valign="bottom" class="data"><? $sum41 = ($num4_all21+$num4_all41+$num4_all61+$num4_all81); echo re_hyphen($sum41)?></td>
    <td align="center" valign="bottom" class="data22"><? $all1 = $sum11+$sum21+$sum31+$sum41; echo re_hyphen($all1)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะมนุษศาสตร์ฯ</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person2)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all12)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all12)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total12)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all22)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all22)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all22)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all22)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total22)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all32)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all32)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total32)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all42)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all42)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all42)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all42)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total42)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all52)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all52)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total52)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all62)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all62)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all62)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all62)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total62)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all72)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all72)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total72)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all82)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all82)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all82)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all82)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total82)?></td>
    <td align="center" valign="bottom" class="data"><? $e12 = ($num1_all12+$num1_all32+$num1_all52+$num1_all72) ; echo re_hyphen($e12);?></td>
    <td align="center" valign="bottom" class="data"><? $e22 = ($num2_all12+$num2_all32+$num2_all52+$num2_all72) ; echo re_hyphen($e22);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all2 =  $e12+$e22+$e32;echo re_hyphen($e_all2);?></td>
    <td align="center" valign="bottom" class="data"><? $sum12 = ($num1_all22+$num1_all42+$num1_all62+$num1_all82); echo re_hyphen($sum12)?></td>
    <td align="center" valign="bottom" class="data"><? $sum22 = ($num2_all22+$num2_all42+$num2_all62+$num2_all82); echo re_hyphen($sum22)?></td>
    <td align="center" valign="bottom" class="data"><? $sum32 = ($num3_all22+$num3_all42+$num3_all62+$num3_all82); echo re_hyphen($sum32)?></td>
    <td align="center" valign="bottom" class="data"><? $sum42 = ($num4_all22+$num4_all42+$num4_all62+$num4_all82); echo re_hyphen($sum42)?></td>
    <td align="center" valign="bottom" class="data22"><? $all2 = $sum12+$sum22+$sum32+$sum42; echo re_hyphen($all2)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะวิทยาการจัดการ</td>
   <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person3)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all13)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all13)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total13)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all23)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all23)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all23)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all23)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total23)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all33)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all33)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total33)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all43)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all43)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all43)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all43)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total43)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all53)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all53)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total53)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all63)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all63)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all63)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all63)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total63)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all73)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all73)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total73)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all83)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all83)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all83)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all83)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total83)?></td>
    <td align="center" valign="bottom" class="data"><? $e13 = ($num1_all13+$num1_all33+$num1_all53+$num1_all73) ; echo re_hyphen($e13);?></td>
    <td align="center" valign="bottom" class="data"><? $e23 = ($num2_all13+$num2_all33+$num2_all53+$num2_all73) ; echo re_hyphen($e23);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all3 =  $e13+$e23+$e33;echo re_hyphen($e_all3);?></td>
    <td align="center" valign="bottom" class="data"><? $sum13 = ($num1_all23+$num1_all43+$num1_all63+$num1_all83); echo re_hyphen($sum13)?></td>
    <td align="center" valign="bottom" class="data"><? $sum23 = ($num2_all23+$num2_all43+$num2_all63+$num2_all83); echo re_hyphen($sum23)?></td>
    <td align="center" valign="bottom" class="data"><? $sum33 = ($num3_all23+$num3_all43+$num3_all63+$num3_all83); echo re_hyphen($sum33)?></td>
    <td align="center" valign="bottom" class="data"><? $sum43 = ($num4_all23+$num4_all43+$num4_all63+$num4_all83); echo re_hyphen($sum43)?></td>
    <td align="center" valign="bottom" class="data22"><? $all3 = $sum13+$sum23+$sum33+$sum43; echo re_hyphen($all3)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะวิทยาศาสตร์</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person4)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all14)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all14)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total14)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all24)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all24)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all24)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all24)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total24)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all34)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all34)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total34)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all44)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all44)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all44)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all44)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total44)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all54)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all54)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total54)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all64)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all64)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all64)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all64)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total64)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all74)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all74)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total74)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all84)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all84)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all84)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all84)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total84)?></td>
    <td align="center" valign="bottom" class="data"><? $e14 = ($num1_all14+$num1_all34+$num1_all54+$num1_all74) ; echo re_hyphen($e14);?></td>
    <td align="center" valign="bottom" class="data"><? $e24 = ($num2_all14+$num2_all34+$num2_all54+$num2_all74) ; echo re_hyphen($e24);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all4 =  $e14+$e24+$e34;echo re_hyphen($e_all4);?></td>
    <td align="center" valign="bottom" class="data"><? $sum14 = ($num1_all24+$num1_all44+$num1_all64+$num1_all84); echo re_hyphen($sum14)?></td>
    <td align="center" valign="bottom" class="data"><? $sum24 = ($num2_all24+$num2_all44+$num2_all64+$num2_all84); echo re_hyphen($sum24)?></td>
    <td align="center" valign="bottom" class="data"><? $sum34 = ($num3_all24+$num3_all44+$num3_all64+$num3_all84); echo re_hyphen($sum34)?></td>
    <td align="center" valign="bottom" class="data"><? $sum44 = ($num4_all24+$num4_all44+$num4_all64+$num4_all84); echo re_hyphen($sum44)?></td>
    <td align="center" valign="bottom" class="data22"><? $all4 = $sum14+$sum24+$sum34+$sum44; echo re_hyphen($all4)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">บัณฑิตวิทยาลัย</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person5)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all15)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all15)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total15)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all25)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all25)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all25)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all25)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total25)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all35)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all35)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total35)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all45)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all45)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all45)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all45)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total45)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all55)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all55)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total55)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all65)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all65)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all65)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all65)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total65)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all75)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all75)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total75)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all85)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all85)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all85)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all85)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total85)?></td>
    <td align="center" valign="bottom" class="data"><? $e15 = ($num1_all15+$num1_all35+$num1_all55+$num1_all75) ; echo re_hyphen($e15);?></td>
    <td align="center" valign="bottom" class="data"><? $e25 = ($num2_all15+$num2_all35+$num2_all55+$num2_all75) ; echo re_hyphen($e25);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all5 =  $e15+$e25+$e35;echo re_hyphen($e_all5);?></td>
   <td align="center" valign="bottom" class="data"><? $sum15 = ($num1_all25+$num1_all45+$num1_all65+$num1_all85); echo re_hyphen($sum15)?></td>
    <td align="center" valign="bottom" class="data"><? $sum25 = ($num2_all25+$num2_all45+$num2_all65+$num2_all85); echo re_hyphen($sum25)?></td>
    <td align="center" valign="bottom" class="data"><? $sum35 = ($num3_all25+$num3_all45+$num3_all65+$num3_all85); echo re_hyphen($sum35)?></td>
    <td align="center" valign="bottom" class="data"><? $sum45 = ($num4_all25+$num4_all45+$num4_all65+$num4_all85); echo re_hyphen($sum45)?></td>
    <td align="center" valign="bottom" class="data22"><? $all5 = $sum15+$sum25+$sum35+$sum45; echo re_hyphen($all5)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะพยาบาลศาสตร์</td>
   <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person6)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all16)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all16)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total16)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all26)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all26)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all26)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all26)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total26)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all36)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all36)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total36)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all46)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all46)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all46)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all46)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total46)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all56)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all56)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total56)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all66)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all66)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all66)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all66)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total66)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all76)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all76)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total76)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all86)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all86)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all86)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all86)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total86)?></td>
    <td align="center" valign="bottom" class="data"><? $e16 = ($num1_all16+$num1_all36+$num1_all56+$num1_all76) ; echo re_hyphen($e16);?></td>
    <td align="center" valign="bottom" class="data"><? $e26 = ($num2_all16+$num2_all36+$num2_all56+$num2_all76) ; echo re_hyphen($e26);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all6 =  $e16+$e26+$e36;echo re_hyphen($e_all6);?></td>
    <td align="center" valign="bottom" class="data"><? $sum16 = ($num1_all26+$num1_all46+$num1_all66+$num1_all86); echo re_hyphen($sum16)?></td>
    <td align="center" valign="bottom" class="data"><? $sum26 = ($num2_all26+$num2_all46+$num2_all66+$num2_all86); echo re_hyphen($sum26)?></td>
    <td align="center" valign="bottom" class="data"><? $sum36 = ($num3_all26+$num3_all46+$num3_all66+$num3_all86); echo re_hyphen($sum36)?></td>
    <td align="center" valign="bottom" class="data"><? $sum46 = ($num4_all26+$num4_all46+$num4_all66+$num4_all86); echo re_hyphen($sum46)?></td>
    <td align="center" valign="bottom" class="data22"><? $all6 = $sum16+$sum26+$sum36+$sum46; echo re_hyphen($all6)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">โรงเรียนการเรือน</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person7)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all17)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all17)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total17)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all27)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all27)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all27)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all27)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total27)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all37)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all37)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total37)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all47)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all47)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all47)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all47)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total47)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all57)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all57)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total57)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all67)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all67)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all67)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all67)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total67)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all77)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all77)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total77)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all87)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all87)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all87)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all87)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total87)?></td>
    <td align="center" valign="bottom" class="data"><? $e17 = ($num1_all17+$num1_all37+$num1_all57+$num1_all77) ; echo re_hyphen($e17);?></td>
    <td align="center" valign="bottom" class="data"><? $e27 = ($num2_all17+$num2_all37+$num2_all57+$num2_all77) ; echo re_hyphen($e27);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all7 =  $e17+$e27+$e37;echo re_hyphen($e_all7);?></td>
    <td align="center" valign="bottom" class="data"><? $sum17 = ($num1_all27+$num1_all47+$num1_all67+$num1_all87); echo re_hyphen($sum17)?></td>
    <td align="center" valign="bottom" class="data"><? $sum27 = ($num2_all27+$num2_all47+$num2_all67+$num2_all87); echo re_hyphen($sum27)?></td>
    <td align="center" valign="bottom" class="data"><? $sum37 = ($num3_all27+$num3_all47+$num3_all67+$num3_all87); echo re_hyphen($sum37)?></td>
    <td align="center" valign="bottom" class="data"><? $sum47 = ($num4_all27+$num4_all47+$num4_all67+$num4_all87); echo re_hyphen($sum47)?></td>
    <td align="center" valign="bottom" class="data22"><? $all7 = $sum17+$sum27+$sum37+$sum47; echo re_hyphen($all7)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">โรงเรียนการท่องเที่ยว</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person8)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all18)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all18)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total18)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all28)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all28)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all28)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all28)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total28)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all38)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all38)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total38)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all48)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all48)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all48)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all48)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total48)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all58)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all58)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total58)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all68)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all68)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all68)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all68)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total68)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all78)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all78)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total78)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all88)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all88)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all88)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all88)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total88)?></td>
    <td align="center" valign="bottom" class="data"><? $e18 = ($num1_all18+$num1_all38+$num1_all58+$num1_all78) ; echo re_hyphen($e18);?></td>
    <td align="center" valign="bottom" class="data"><? $e28 = ($num2_all18+$num2_all38+$num2_all58+$num2_all78) ; echo re_hyphen($e28);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all8 =  $e18+$e28+$e38;echo re_hyphen($e_all8);?></td>
    <td align="center" valign="bottom" class="data"><? $sum18 = ($num1_all28+$num1_all48+$num1_all68+$num1_all88); echo re_hyphen($sum18)?></td>
    <td align="center" valign="bottom" class="data"><? $sum28 = ($num2_all28+$num2_all48+$num2_all68+$num2_all88); echo re_hyphen($sum28)?></td>
    <td align="center" valign="bottom" class="data"><? $sum38 = ($num3_all28+$num3_all48+$num3_all68+$num3_all88); echo re_hyphen($sum38)?></td>
    <td align="center" valign="bottom" class="data"><? $sum48 = ($num4_all28+$num4_all48+$num4_all68+$num4_all88); echo re_hyphen($sum48)?></td>
    <td align="center" valign="bottom" class="data22"><? $all8 = $sum18+$sum28+$sum38+$sum48; echo re_hyphen($all8)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">ศูนย์การศึกษา</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person9)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all19)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all19)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total19)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all29)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all29)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all29)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all29)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total29)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all39)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all39)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total39)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all49)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all49)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all49)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all49)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total49)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all59)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all59)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total59)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all69)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all69)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all69)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all69)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total69)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all79)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all79)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total79)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all89)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all89)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num3_all89)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num4_all89)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total89)?></td>
    <td align="center" valign="bottom" class="data"><? $e19 = ($num1_all19+$num1_all39+$num1_all59+$num1_all79) ; echo re_hyphen($e19);?></td>
    <td align="center" valign="bottom" class="data"><? $e29 = ($num2_all19+$num2_all39+$num2_all59+$num2_all79) ; echo re_hyphen($e29);?></td>
    <td align="center" valign="bottom" class="data2"><? $e_all9 =  $e19+$e29+$e39;echo re_hyphen($e_all9);?></td>
    <td align="center" valign="bottom" class="data"><? $sum19 = ($num1_all29+$num1_all49+$num1_all69+$num1_all89); echo re_hyphen($sum19)?></td>
    <td align="center" valign="bottom" class="data"><? $sum29 = ($num2_all29+$num2_all49+$num2_all69+$num2_all89); echo re_hyphen($sum29)?></td>
    <td align="center" valign="bottom" class="data"><? $sum39 = ($num3_all29+$num3_all49+$num3_all69+$num3_all89); echo re_hyphen($sum39)?></td>
    <td align="center" valign="bottom" class="data"><? $sum49 = ($num4_all29+$num4_all49+$num4_all69+$num4_all89); echo re_hyphen($sum49)?></td>
    <td align="center" valign="bottom" class="data22"><? $all9 = $sum19+$sum29+$sum39+$sum49; echo re_hyphen($all9)?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac2">รวม</td>
    <td align="center" valign="bottom" class="fac2  fac3"><?=re_hyphen($all) ?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all11+$num1_all12+$num1_all13+$num1_all14+$num1_all15+$num1_all16+$num1_all17+$num1_all18+$num1_all19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all11+$num2_all12+$num2_all13+$num2_all14+$num2_all15+$num2_all16+$num2_all17+$num2_all18+$num2_all19)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total11+$total12+$total13+$total14+$total15+$total16+$total17+$total18+$total19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all21+$num1_all22+$num1_all23+$num1_all24+$num1_all25+$num1_all26+$num1_all27+$num1_all28+$num1_all29)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all21+$num2_all22+$num2_all23+$num2_all24+$num2_all25+$num2_all26+$num2_all27+$num2_all28+$num2_all29)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num3_all21+$num3_all22+$num3_all23+$num3_all24+$num3_all25+$num3_all26+$num3_all27+$num3_all28+$num3_all29)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num4_all21+$num4_all22+$num4_all23+$num4_all24+$num4_all25+$num4_all26+$num4_all27+$num4_all28+$num4_all29)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total21+$total22+$total23+$total24+$total25+$total26+$total27+$total28+$total29)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all31+$num1_all32+$num1_all33+$num1_all34+$num1_all35+$num1_all36+$num1_all37+$num1_all38+$num1_all39)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all31+$num2_all32+$num2_all33+$num2_all34+$num2_all35+$num2_all36+$num2_all37+$num2_all38+$num2_all39)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all41+$num1_all42+$num1_all43+$num1_all44+$num1_all45+$num1_all46+$num1_all47+$num1_all48+$num1_all49)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all41+$num2_all42+$num2_all43+$num2_all44+$num2_all45+$num2_all46+$num2_all47+$num2_all48+$num2_all49)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num3_all41+$num3_all42+$num3_all43+$num3_all44+$num3_all45+$num3_all46+$num3_all47+$num3_all48+$num3_all49)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num4_all41+$num4_all42+$num4_all43+$num4_all44+$num4_all45+$num4_all46+$num4_all47+$num4_all48+$num4_all49)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total41+$total42+$total43+$total44+$total45+$total46+$total47+$total48+$total49)?></td>
     <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all51+$num1_all52+$num1_all53+$num1_all54+$num1_all55+$num1_all56+$num1_all57+$num1_all58+$num1_all59)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all51+$num2_all52+$num2_all53+$num2_all54+$num2_all55+$num2_all56+$num2_all57+$num2_all58+$num2_all59)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total51+$total52+$total53+$total54+$total55+$total56+$total57+$total58+$total59)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all61+$num1_all62+$num1_all63+$num1_all64+$num1_all65+$num1_all66+$num1_all67+$num1_all68+$num1_all69)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all61+$num2_all62+$num2_all63+$num2_all64+$num2_all65+$num2_all66+$num2_all67+$num2_all68+$num2_all69)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num3_all61+$num3_all62+$num3_all63+$num3_all64+$num3_all65+$num3_all66+$num3_all67+$num3_all68+$num3_all69)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num4_all61+$num4_all62+$num4_all63+$num4_all64+$num4_all65+$num4_all66+$num4_all67+$num4_all68+$num4_all69)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total61+$total62+$total63+$total64+$total65+$total66+$total67+$total68+$total69)?></td>
     <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all71+$num1_all72+$num1_all73+$num1_all74+$num1_all75+$num1_all76+$num1_all77+$num1_all78+$num1_all79)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all71+$num2_all72+$num2_all73+$num2_all74+$num2_all75+$num2_all76+$num2_all77+$num2_all78+$num2_all79)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total71+$total72+$total73+$total74+$total75+$total76+$total77+$total78+$total79)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all81+$num1_all82+$num1_all83+$num1_all84+$num1_all85+$num1_all86+$num1_all87+$num1_all88+$num1_all89)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all81+$num2_all82+$num2_all83+$num2_all84+$num2_all85+$num2_all86+$num2_all87+$num2_all88+$num2_all89)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num3_all81+$num3_all82+$num3_all83+$num3_all84+$num3_all85+$num3_all86+$num3_all87+$num3_all88+$num3_all89)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num4_all81+$num4_all82+$num4_all83+$num4_all84+$num4_all85+$num4_all86+$num4_all87+$num4_all88+$num4_all89)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total81+$total82+$total83+$total84+$total85+$total86+$total87+$total88+$total89)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($e11+$e12+$e13+$e14+$e15+$e16+$e17+$e18+$e19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($e21+$e22+$e23+$e24+$e25+$e26+$e27+$e28+$e29)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($e_all1+$e_all2+$e_all3+$e_all4+$e_all5+$e_all6+$e_all7+$e_all8+$e_all9) ?></td>
    <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?=re_hyphen($sum11+$sum12+$sum13+$sum14+$sum15+$sum16+$sum17+$sum18+$sum19) ?></td>
    <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?=re_hyphen($sum21+$sum22+$sum23+$sum24+$sum25+$sum26+$sum27+$sum28+$sum29) ?></td>
    <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?=re_hyphen($sum31+$sum32+$sum33+$sum34+$sum35+$sum36+$sum37+$sum38+$sum39) ?></td>
    <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?=re_hyphen($sum41+$sum42+$sum43+$sum44+$sum45+$sum46+$sum47+$sum48+$sum49) ?></td>
    <td align="center" valign="bottom" style="font-weight:bold; padding-bottom:5px"><?=re_hyphen($all1+$all2+$all3+$all4+$all5+$all6+$all7+$all8+$all9) ?></td>
  </tr>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'scholar_report1_excel.php?excel=1&date1=<?=$_REQUEST["date1"]?>&date2=<?=$_REQUEST["date2"]?>'"/></div>

</body>
</html>
<?
$db->closedb($conn);
?>