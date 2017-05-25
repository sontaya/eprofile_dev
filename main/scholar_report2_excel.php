<?
@ini_set('max_execution_time', 300);
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=almost_graduation_s_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
include("../includes/connect.php");
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

$num1_all31 = 0;
$num2_all31 = 0;

$num1_all51 = 0;
$num2_all51 = 0;

$num1_all71 = 0;
$num2_all71 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '02' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person1++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp11 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp11 > 0 ) $num1_all11++;//เอก
			
			$num2_all_temp11 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp11 > 0 ) $num2_all11++;//โท
		}
		
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp31 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp31 > 0 ) $num1_all31++;//เอก
			
			$num2_all_temp31 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp31 > 0 ) $num2_all31++;//โท
		}
		
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp51 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp51 > 0 ) $num1_all51++;//เอก
			
			$num2_all_temp51 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp51 > 0 ) $num2_all51++;//โท
		}
		
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp71 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp71 > 0 ) $num1_all71++;//เอก
			
			$num2_all_temp71 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp71 > 0 ) $num2_all71++;//โท
		}
		

	}//if $all_person_temp1 > 0
	
	
}//while

	$total11 += $num1_all11 + $num2_all11;

	$total31 += $num1_all31 + $num1_all31;
	
	$total51 += $num1_all51 + $num1_all51;
	
	$total71 += $num1_all71 + $num1_all71;


$num1_all12 = 0;
$num2_all12 = 0;

$num1_all32 = 0;
$num2_all32 = 0;

$num1_all52 = 0;
$num2_all52 = 0;

$num1_all72 = 0;
$num2_all72 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '03' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person2++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp12 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp12 > 0 ) $num1_all12++;//เอก
			
			$num2_all_temp12 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp12 > 0 ) $num2_all12++;//โท
		}
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp32 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp32 > 0 ) $num1_all32++;//เอก
			
			$num2_all_temp32 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp32 > 0 ) $num2_all32++;//โท
		}
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp52 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp52 > 0 ) $num1_all52++;//เอก
			
			$num2_all_temp52 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp52 > 0 ) $num2_all52++;//โท
		}
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp72 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp72 > 0 ) $num1_all72++;//เอก
			
			$num2_all_temp72 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp72 > 0 ) $num2_all72++;//โท
		}

	}//if $all_person_temp1 > 0
	
	
}//while

	$total12 += $num1_all12 + $num2_all12;

	$total32 += $num1_all32 + $num1_all32;
	
	$total52 += $num1_all52 + $num1_all52;
	
	$total72 += $num1_all72 + $num1_all72;
	


$num1_all13 = 0;
$num2_all13 = 0;

$num1_all33 = 0;
$num2_all33 = 0;

$num1_all53 = 0;
$num2_all53 = 0;

$num1_all73 = 0;
$num2_all73 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '04' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person3++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp13 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp13 > 0 ) $num1_all13++;//เอก
			
			$num2_all_temp13 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp13 > 0 ) $num2_all13++;//โท
		}
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp33 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp33 > 0 ) $num1_all33++;//เอก
			
			$num2_all_temp33 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp33 > 0 ) $num2_all33++;//โท
		}
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp53 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp53 > 0 ) $num1_all53++;//เอก
			
			$num2_all_temp53 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp53 > 0 ) $num2_all53++;//โท
		}
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp73 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp73 > 0 ) $num1_all73++;//เอก
			
			$num2_all_temp73 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp73 > 0 ) $num2_all73++;//โท
		}
		
	}//if $all_person_temp1 > 0
	
	
}//while

	$total13 += $num1_all13 + $num2_all13;

	$total33 += $num1_all33 + $num1_all33;
	
	$total53 += $num1_all53 + $num1_all53;
	
	$total73 += $num1_all73 + $num1_all73;
	

$num1_all14 = 0;
$num2_all14 = 0;

$num1_all34 = 0;
$num2_all34 = 0;

$num1_all54 = 0;
$num2_all54 = 0;

$num1_all74 = 0;
$num2_all74 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '05' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person4++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp14 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp14 > 0 ) $num1_all14++;//เอก
			
			$num2_all_temp14 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp14 > 0 ) $num2_all14++;//โท
		}
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp34 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp34 > 0 ) $num1_all34++;//เอก
			
			$num2_all_temp34 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp34 > 0 ) $num2_all34++;//โท
		}
	
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp54 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp54 > 0 ) $num1_all54++;//เอก
			
			$num2_all_temp54 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp54 > 0 ) $num2_all54++;//โท
		}
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp74 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp74 > 0 ) $num1_all74++;//เอก
			
			$num2_all_temp74 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp74 > 0 ) $num2_all74++;//โท
		}
		
	}//if $all_person_temp1 > 0
	
	
}//while

	$total14 += $num1_all14 + $num2_all14;

	$total34 += $num1_all34 + $num1_all34;
	
	$total54 += $num1_all54 + $num1_all54;
	
	$total74 += $num1_all74 + $num1_all74;


$num1_all15 = 0;
$num2_all15 = 0;

$num1_all35 = 0;
$num2_all35 = 0;

$num1_all55 = 0;
$num2_all55 = 0;

$num1_all75 = 0;
$num2_all75 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '11' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person5++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp15 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp15 > 0 ) $num1_all15++;//เอก
			
			$num2_all_temp15 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp15 > 0 ) $num2_all15++;//โท
		}
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp35 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp35 > 0 ) $num1_all35++;//เอก
			
			$num2_all_temp35 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp35 > 0 ) $num2_all35++;//โท
		}
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp55 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp55 > 0 ) $num1_all55++;//เอก
			
			$num2_all_temp55 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp55 > 0 ) $num2_all55++;//โท
		}
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp75 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp75 > 0 ) $num1_all75++;//เอก
			
			$num2_all_temp75 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp75 > 0 ) $num2_all75++;//โท
		}
		

	}//if $all_person_temp1 > 0
	
	
}//while

	$total15 += $num1_all15 + $num2_all15;

	$total35 += $num1_all35 + $num1_all35;
	
	$total55 += $num1_all55 + $num1_all55;
	
	$total75 += $num1_all75 + $num1_all75;

$num1_all16 = 0;
$num2_all16 = 0;

$num1_all36 = 0;
$num2_all36 = 0;

$num1_all56 = 0;
$num2_all56 = 0;

$num1_all76 = 0;
$num2_all76 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '15' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person6++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp16 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp16 > 0 ) $num1_all16++;//เอก
			
			$num2_all_temp16 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp16 > 0 ) $num2_all16++;//โท
		}
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp36 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp36 > 0 ) $num1_all36++;//เอก
			
			$num2_all_temp36 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp36 > 0 ) $num2_all36++;//โท
		}
		
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp56 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp56 > 0 ) $num1_all56++;//เอก
			
			$num2_all_temp56 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp56 > 0 ) $num2_all56++;//โท
		}
		
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp76 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp76 > 0 ) $num1_all76++;//เอก
			
			$num2_all_temp76 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp76 > 0 ) $num2_all76++;//โท
		}
		
	}//if $all_person_temp1 > 0
	
	
}//while

	$total16 += $num1_all16 + $num2_all16;

	$total36 += $num1_all36 + $num1_all36;
	
	$total56 += $num1_all56 + $num1_all56;
	
	$total76 += $num1_all76 + $num1_all76;
	
	
$num1_all17 = 0;
$num2_all17 = 0;

$num1_all37 = 0;
$num2_all37 = 0;

$num1_all57 = 0;
$num2_all57 = 0;

$num1_all77 = 0;
$num2_all77 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '16' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person7++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp17 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp17 > 0 ) $num1_all17++;//เอก
			
			$num2_all_temp17 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp17 > 0 ) $num2_all17++;//โท
		}
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp37 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp37 > 0 ) $num1_all37++;//เอก
			
			$num2_all_temp37 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp37 > 0 ) $num2_all37++;//โท
		}
		
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp57 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp57 > 0 ) $num1_all57++;//เอก
			
			$num2_all_temp57 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp57 > 0 ) $num2_all57++;//โท
		}
		
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp77 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp77 > 0 ) $num1_all77++;//เอก
			
			$num2_all_temp77 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp77 > 0 ) $num2_all77++;//โท
		}
		

	}//if $all_person_temp1 > 0
	
	
}//while

	$total17 += $num1_all17 + $num2_all17;

	$total37 += $num1_all37 + $num1_all37;
	
	$total57 += $num1_all57 + $num1_all57;
	
	$total77 += $num1_all77 + $num1_all77;
	
	
$num1_all18 = 0;
$num2_all18 = 0;

$num1_all38 = 0;
$num2_all38 = 0;

$num1_all58 = 0;
$num2_all58 = 0;

$num1_all78 = 0;
$num2_all78 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '17' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person8++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp18 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp18 > 0 ) $num1_all18++;//เอก
			
			$num2_all_temp18 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp18 > 0 ) $num2_all18++;//โท
		}
		
	
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp38 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp38 > 0 ) $num1_all38++;//เอก
			
			$num2_all_temp38 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp38 > 0 ) $num2_all38++;//โท
		}
		
	
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp58 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp58 > 0 ) $num1_all58++;//เอก
			
			$num2_all_temp58 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp58 > 0 ) $num2_all58++;//โท
		}
		
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp78 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp78 > 0 ) $num1_all78++;//เอก
			
			$num2_all_temp78 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp78 > 0 ) $num2_all78++;//โท
		}

	}//if $all_person_temp1 > 0
	
	
}//while

	$total18 += $num1_all18 + $num2_all18;

	$total38 += $num1_all38 + $num1_all38;
	
	$total58 += $num1_all58 + $num1_all58;
	
	$total78 += $num1_all78 + $num1_all78;
	

$num1_all19 = 0;
$num2_all19 = 0;

$num1_all39 = 0;
$num2_all39 = 0;

$num1_all59 = 0;
$num2_all59 = 0;

$num1_all79 = 0;
$num2_all79 = 0;

$sql_all_person1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_END_DATE BETWEEN TO_DATE('$d1','YYYY-MM-DD') AND TO_DATE('$d2','YYYY-MM-DD')";
$stid_all_person1 = oci_parse($conn, $sql_all_person1 );
oci_execute($stid_all_person1);

while($row_all_person1 = oci_fetch_array($stid_all_person1, OCI_BOTH)){

	$all_person_temp1 =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE (CWK_MUA_EMP_TYPE > 0 AND CWK_MUA_EMP_TYPE < 5) AND EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_MAIN = '12' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2' ",$conn);
	
	if($all_person_temp1 > 0 ){
		 $all_person9++;
		
		$query1 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '1' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query1 = oci_parse($conn, $query1 );
		oci_execute($stid_query1);
		while($row_query1 = oci_fetch_array($stid_query1, OCI_BOTH)){
			$num1_all_temp19 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp19 > 0 ) $num1_all19++;//เอก
			
			$num2_all_temp19 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query1["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp19 > 0 ) $num2_all19++;//โท
		}
		
		
		$query2 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '4' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query2 = oci_parse($conn, $query2 );
		oci_execute($stid_query2);
		while($row_query2 = oci_fetch_array($stid_query2, OCI_BOTH)){
			$num1_all_temp39 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp39 > 0 ) $num1_all39++;//เอก
			
			$num2_all_temp39 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query2["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp39 > 0 ) $num2_all39++;//โท
		}
		
		
		$query3 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '3' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query3 = oci_parse($conn, $query3 );
		oci_execute($stid_query3);
		while($row_query3 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp59 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp59 > 0 ) $num1_all59++;//เอก
			
			$num2_all_temp59 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query3["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp59 > 0 ) $num2_all59++;//โท
		}
		
		$query4 = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row_all_person1["EMP_ID"]."' AND  CWK_MUA_EMP_TYPE = '2' AND CWK_STATUS <> '03' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_EMP_SUBTYPE = '2'";
		$stid_query4 = oci_parse($conn, $query4 );
		oci_execute($stid_query4);
		while($row_query4 = oci_fetch_array($stid_query3, OCI_BOTH)){
			$num1_all_temp79 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3')",$conn);
			if($num1_all_temp79 > 0 ) $num1_all79++;//เอก
			
			$num2_all_temp79 =  $db->count_row(TB_SCHOLAR_TAB," WHERE  EMP_ID = '".$row_query4["EMP_ID"]."' AND  SCH_EDU_LEVEL = '1' ",$conn);
			if($num2_all_temp79 > 0 ) $num2_all79++;//โท
		}
		

	}//if $all_person_temp1 > 0
	
	
}//while

	$total19 += $num1_all19 + $num2_all19;

	$total39 += $num1_all39 + $num1_all39;
	
	$total59 += $num1_all59 + $num1_all59;
	
	$total79 += $num1_all79 + $num1_all79;
	
	

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
<div align="center" style="font-size:14px">ข้อมูลบุคลากรสายสนับสนุนมหาวิทยาลัยราชภัฎสวนดุสิต <br /><br />
ข้อมูลระหว่าง วันที่ <? echo (int)$begin_day." ".get_month_full((int)$begin_month)." ".($begin_year);?> ถึงวันที่ <? echo (int)$end_day." ".get_month_full((int)$end_month)." ".($end_year);?><br /><br />
ประเภท ข้อมูล คาดว่าจะสำเร็จการศึกษา<br />
<br />
</div>
<table  cellspacing="0" cellpadding="2" class="all_table" align="center">
  <tr>
    <td width="120" rowspan="3" align="center" valign="middle" class="th">หน่วยงาน</td>
    <td width="45" rowspan="3" align="center" valign="middle" class="th">จำนวน<br />ทั้งหมด</td>
    <td height="33" colspan="3" align="center" valign="middle" class="th">ข้าราชการ</td>
    <td colspan="3" align="center" valign="middle" class="th">อาจารย์ประจำตามสัญญาจ้าง</td>
    <td colspan="3" align="center" valign="middle" class="th">พนักงานมหาวิทยาลัย</td>
    <td colspan="3" align="center" valign="middle" class="th">พนักงานราชการ</td>
    <td colspan="3" align="center" valign="middle" class="th2">รวมบุคลากรทั้งหมด</td>
  </tr>
    <tr>
    <td height="33" colspan="2" align="center" valign="middle" class="th" >วุฒิปริญญา</td>
    <td rowspan="2" align="center" valign="middle" class="th" width="45">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td rowspan="2" align="center" valign="middle" class="th"  width="45">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td rowspan="2" align="center" valign="middle" class="th"  width="45">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td rowspan="2" align="center" valign="middle" class="th"  width="45">รวม</td>
    <td height="33" colspan="2" align="center" valign="middle" class="th">วุฒิปริญญา</td>
    <td rowspan="2" align="center" valign="middle" class="th2"  width="45">รวม</td>
  </tr>
  <tr>
    <td width="45" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="45" align="center" valign="middle" class="th">โท</td>
    <td width="45" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="45" align="center" valign="middle" class="th">โท</td>
    <td width="45" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="45" align="center" valign="middle" class="th">โท</td>
    <td width="45" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="45" align="center" valign="middle" class="th">โท</td>
    <td width="45" height="32" align="center" valign="middle" class="th">เอก</td>
    <td width="45" align="center" valign="middle" class="th">โท</td>
  </tr>

  <tr >
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะครุศาสตร์</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person1)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all11)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all11)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total11)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all31)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all31)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total31)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all51)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all51)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total51)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all71)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all71)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total71)?></td>
    <td align="center" valign="bottom" class="data"><? $e11 = ($num1_all11+$num1_all31+$num1_all51+$num1_all71) ; echo re_hyphen($e11);?></td>
    <td align="center" valign="bottom" class="data"><? $e21 = ($num2_all11+$num2_all31+$num2_all51+$num2_all71) ; echo re_hyphen($e21);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all1 =  $e11+$e21+$e31;echo re_hyphen($e_all1);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะมนุษศาสตร์ฯ</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person2)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all12)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all12)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total12)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all32)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all32)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total32)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all52)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all52)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total52)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all72)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all72)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total72)?></td>
    <td align="center" valign="bottom" class="data"><? $e12 = ($num1_all12+$num1_all32+$num1_all52+$num1_all72) ; echo re_hyphen($e12);?></td>
    <td align="center" valign="bottom" class="data"><? $e22 = ($num2_all12+$num2_all32+$num2_all52+$num2_all72) ; echo re_hyphen($e22);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all2 =  $e12+$e22+$e32;echo re_hyphen($e_all2);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะวิทยาการจัดการ</td>
   <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person3)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all13)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all13)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total13)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all33)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all33)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total33)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all53)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all53)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total53)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all73)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all73)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total73)?></td>
    <td align="center" valign="bottom" class="data"><? $e13 = ($num1_all13+$num1_all33+$num1_all53+$num1_all73) ; echo re_hyphen($e13);?></td>
    <td align="center" valign="bottom" class="data"><? $e23 = ($num2_all13+$num2_all33+$num2_all53+$num2_all73) ; echo re_hyphen($e23);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all3 =  $e13+$e23+$e33;echo re_hyphen($e_all3);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะวิทยาศาสตร์</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person4)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all14)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all14)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total14)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all34)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all34)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total34)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all54)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all54)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total54)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all74)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all74)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total74)?></td>
    <td align="center" valign="bottom" class="data"><? $e14 = ($num1_all14+$num1_all34+$num1_all54+$num1_all74) ; echo re_hyphen($e14);?></td>
    <td align="center" valign="bottom" class="data"><? $e24 = ($num2_all14+$num2_all34+$num2_all54+$num2_all74) ; echo re_hyphen($e24);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all4 =  $e14+$e24+$e34;echo re_hyphen($e_all4);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">บัณฑิตวิทยาลัย</td>
    <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person5)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all15)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all15)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total15)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all35)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all35)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total35)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all55)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all55)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total55)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all75)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all75)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total75)?></td>
    <td align="center" valign="bottom" class="data"><? $e15 = ($num1_all15+$num1_all35+$num1_all55+$num1_all75) ; echo re_hyphen($e15);?></td>
    <td align="center" valign="bottom" class="data"><? $e25 = ($num2_all15+$num2_all35+$num2_all55+$num2_all75) ; echo re_hyphen($e25);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all5 =  $e15+$e25+$e35;echo re_hyphen($e_all5);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">คณะพยาบาลศาสตร์</td>
   <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person6)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all16)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all16)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total16)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all36)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all36)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total36)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all56)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all56)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total56)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all76)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all76)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total76)?></td>
    <td align="center" valign="bottom" class="data"><? $e16 = ($num1_all16+$num1_all36+$num1_all56+$num1_all76) ; echo re_hyphen($e16);?></td>
    <td align="center" valign="bottom" class="data"><? $e26 = ($num2_all16+$num2_all36+$num2_all56+$num2_all76) ; echo re_hyphen($e26);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all6 =  $e16+$e26+$e36;echo re_hyphen($e_all6);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">โรงเรียนการเรือน</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person7)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all17)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all17)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total17)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all37)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all37)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total37)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all57)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all57)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total57)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all77)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all77)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total77)?></td>
    <td align="center" valign="bottom" class="data"><? $e17 = ($num1_all17+$num1_all37+$num1_all57+$num1_all77) ; echo re_hyphen($e17);?></td>
    <td align="center" valign="bottom" class="data"><? $e27 = ($num2_all17+$num2_all37+$num2_all57+$num2_all77) ; echo re_hyphen($e27);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all7 =  $e17+$e27+$e37;echo re_hyphen($e_all7);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">โรงเรียนการท่องเที่ยว</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person8)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all18)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all18)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total18)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all38)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all38)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total38)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all58)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all58)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total58)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all78)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all78)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total78)?></td>
    <td align="center" valign="bottom" class="data"><? $e18 = ($num1_all18+$num1_all38+$num1_all58+$num1_all78) ; echo re_hyphen($e18);?></td>
    <td align="center" valign="bottom" class="data"><? $e28 = ($num2_all18+$num2_all38+$num2_all58+$num2_all78) ; echo re_hyphen($e28);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all8 =  $e18+$e28+$e38;echo re_hyphen($e_all8);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac">ศูนย์การศึกษา</td>
     <td align="center" valign="bottom" class="fac fac3"><?=re_hyphen($all_person9)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all19)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all19)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total19)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all39)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all39)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total39)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all59)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all59)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total59)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num1_all79)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($num2_all79)?></td>
    <td align="center" valign="bottom" class="data2"><?=re_hyphen($total79)?></td>
    <td align="center" valign="bottom" class="data"><? $e19 = ($num1_all19+$num1_all39+$num1_all59+$num1_all79) ; echo re_hyphen($e19);?></td>
    <td align="center" valign="bottom" class="data"><? $e29 = ($num2_all19+$num2_all39+$num2_all59+$num2_all79) ; echo re_hyphen($e29);?></td>
    <td align="center" valign="bottom" class="data"><? $e_all9 =  $e19+$e29+$e39;echo re_hyphen($e_all9);?></td>
  </tr>
  <tr>
    <td style="height:30px" align="right" valign="bottom" class="fac2">รวม</td>
    <td align="center" valign="bottom" class="fac2  fac3"><?=re_hyphen($all) ?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all11+$num1_all12+$num1_all13+$num1_all14+$num1_all15+$num1_all16+$num1_all17+$num1_all18+$num1_all19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all11+$num2_all12+$num2_all13+$num2_all14+$num2_all15+$num2_all16+$num2_all17+$num2_all18+$num2_all19)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total11+$total12+$total13+$total14+$total15+$total16+$total17+$total18+$total19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all31+$num1_all32+$num1_all33+$num1_all34+$num1_all35+$num1_all36+$num1_all37+$num1_all38+$num1_all39)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all31+$num2_all32+$num2_all33+$num2_all34+$num2_all35+$num2_all36+$num2_all37+$num2_all38+$num2_all39)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all51+$num1_all52+$num1_all53+$num1_all54+$num1_all55+$num1_all56+$num1_all57+$num1_all58+$num1_all59)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all51+$num2_all52+$num2_all53+$num2_all54+$num2_all55+$num2_all56+$num2_all57+$num2_all58+$num2_all59)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total51+$total52+$total53+$total54+$total55+$total56+$total57+$total58+$total59)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num1_all71+$num1_all72+$num1_all73+$num1_all74+$num1_all75+$num1_all76+$num1_all77+$num1_all78+$num1_all79)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($num2_all71+$num2_all72+$num2_all73+$num2_all74+$num2_all75+$num2_all76+$num2_all77+$num2_all78+$num2_all79)?></td>
    <td align="center" valign="bottom" class="data3"><?=re_hyphen($total71+$total72+$total73+$total74+$total75+$total76+$total77+$total78+$total79)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($e11+$e12+$e13+$e14+$e15+$e16+$e17+$e18+$e19)?></td>
    <td align="center" valign="bottom" class="data222"><?=re_hyphen($e21+$e22+$e23+$e24+$e25+$e26+$e27+$e28+$e29)?></td>
    <td align="center" valign="bottom" class="data"><?=re_hyphen($e_all1+$e_all2+$e_all3+$e_all4+$e_all5+$e_all6+$e_all7+$e_all8+$e_all9) ?></td>
  </tr>
</table>

</body>
</html>
<?
$db->closedb($conn);
?>