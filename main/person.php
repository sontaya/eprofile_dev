<?
$fpath = '';
require_once($fpath."../includes/connect.php");

/*function return_date($date){//07-MAY-73
	list($d,$m,$y) = explode("-",$date);
	switch($m){
		case "JAN": $m2  = "01";break;
		case "FEB": $m2  = "02";break;
		case "MAR": $m2  = "03";break;
		case "APR": $m2  = "04";break;
		case "MAY": $m2  = "05";break;
		case "JUN": $m2  = "06";break;
		case "JUL": $m2  = "07";break;
		case "AUG": $m2  = "08";break;
		case "SEP": $m2  = "09";break;
		case "OCT": $m2  = "10";break;
		case "NOV": $m2  = "11";break;
		case "DEC": $m2  = "12";break;
	}
	
	return ($y+1900)."-".$m2."-".$d;
}
$sql = "SELECT * FROM BIOGRAPHY_PERSON ";
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//echo ++$n." ".$row['CODE_PERSON']."<br />";
	$emp_id = $row['CODE_PERSON'];
	$person_id = $row['CITIZEN_CODE'];
	$bio_title_th = $row['NAME_PRENAME_THA'];
	$bio_fname_th = $row['FIRST_NAME_THA'];
	$bio_mname_th = $row['MIDDLE_NAME_THA'];
	$bio_lname_th = $row['LAST_NAME_THA'];
	$bio_title_en = $row['NAME_PRENAME_ENG'];
	$bio_fname_en = $row['FIRST_NAME_ENG'];
	$bio_mname_en = $row['MIDDLE_NAME_ENG'];
	$bio_lname_en = $row['LAST_NAME_ENG'];
	$bio_sex  = $row['CODE_GENDER'];
	$bio_status  = $row['MSTATUS'];
	$bio_birthday  = $row['BIRTH_DATE'];
	$bio_blood_group  = $row['CODE_BLOOD'];
	$bio_nation1  = $row['CODE_RACE'];
	$bio_nation2  = $row['CODE_NATIONALITY'];
	$bio_religion  = $row['CODE_RELIGION'];
	$bio_email1 = pea_substr(trim($row['EMAIL']),80);
	$bio_email2 =  pea_substr(trim($row['DUSIT_EMAIL']),80);
	$bio_mobile_1 = pea_substr(trim($row['MOBILE_PHONE']),25);
	$bio_h_phone = pea_substr(trim($row['TELEPHONE_1']),25);
	
	
	$res = $db->add_db(TB_BIODATA_TAB,array(
												"EMP_ID"=>"$emp_id",
											  "BIO_TITLE_TH"=>"$bio_title_th",
											  "BIO_FNAME_TH"=>"$bio_fname_th",
											  "BIO_MNAME_TH"=>"$bio_mname_th",
											  "BIO_LNAME_TH"=>"$bio_lname_th",
											  "BIO_TITLE_EN"=>"$bio_title_en",
											  "BIO_FNAME_EN"=>"$bio_fname_en",
											  "BIO_MNAME_EN"=>"$bio_mname_en",
											  "BIO_LNAME_EN"=>"$bio_lname_en",
											  "BIO_SEX"=>"$bio_sex",
											  "BIO_NATION1"=>"$bio_nation1",
											  "BIO_NATION2"=>"$bio_nation2",
											  "BIO_RELIGION"=>"$bio_religion",
											  "BIO_BIRTHDAY"=>"TO_DATE('$bio_birthday','YYYY-MM-DD')",
											  "PERSON_ID"=>"$person_id",
											  "BIO_STATUS"=>"$bio_status",
											  "BIO_BLOOD_GROUP"=>"$bio_blood_group",
											  "BIO_H_PHONE"=>"$bio_h_phone",
											  "BIO_MOBILE_1"=>"$bio_mobile_1",
											  "BIO_EMAIL1"=>"$bio_email1",
											  "BIO_EMAIL2"=>"$bio_email2",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
	
	),$conn); 
	
	$emp_id = $row['CODE_PERSON'];
	$ca_house_no = $row['HOMEADD_2'];
	$ca_moo = $row['MOO_2'];
	$ca_soi = $row['SOI_2'];
	$ca_road = $row['STREET_2'];
	$ca_tumbon = $row['CODE_TUMBON_2'];
	$ca_amphur  = $row['CODE_AMPHUR_2'];
	$ca_province  = $row['CODE_PROVINCE_2'];
	$ca_post_code  = $row['ZIPCODE_2'];
	
	$res = $db->add_db(TB_CURRENT_ADDRESS_TAB,array(
												"EMP_ID"=>"$emp_id",
											  "CU_HOUSE_NO"=>"$ca_house_no",
											  "CU_MOO"=>"$ca_moo",
											  "CU_SOI"=>"$ca_soi",
											  "CU_ROAD"=>"$ca_road",
											  "CU_TUMBON"=>"$ca_tumbon",
											  "CU_AMPHUR"=>"$ca_amphur",
											  "CU_PROVINCE"=>"$ca_province",
											  "CU_POST_CODE"=>"$ca_post_code",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
	),$conn); 
	

$sql = "SELECT * FROM FAMILY_PARENT WHERE FIRST_NAME_THA_SPOUSE <> '' OR FIRST_NAME_THA_SPOUSE <> 'Null' OR FIRST_NAME_THA_SPOUSE <> 'null' ";
$sql = "SELECT * FROM FAMILY_CHILD  ";
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//echo ++$n." ".$row['CODE_PERSON']."<br />";
	$emp_id = $row['CODE_PERSON'];
	$fam_title_th = $row['CODE_PRENAME_SPOUSE'];
	$fam_fname_th = $row['FIRST_NAME_THA_SPOUSE'];
	$fam_lname_th = $row['LAST_NAME_THA_SPOUSE'];
	$fam_code_id = $row['CITIZEN_CODE_SPOUSE'];
	$fam_birthday = $row['BIRTH_DATE_SPOUSE'];
	$fam_alive = $row['CURRENT_STATUS_CODE_SPOUSE'];
	$fam_occupation = $row['OCCUPATION_REMARK_SPOUSE'];
	$fam_work_place  = $row['OFFICE_SPOUSE'];
	$fam_phone  = $row['PHONE_SPOUSE'];
	
	$fam_title_th = $row['CODE_PRENAME_SPOUSE'];
	if($fam_title_th == "นาย" ) $gender = "male";
	elseif($fam_title_th == "นาง" or $fam_title_th == "น.ส." ) $gender = "female";
	else  $gender = "";
	
	
$result=$db->add_db(TB_FAMILY_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "FAM_RELATION"=>"3",
											  "FAM_SEX"=>"$gender",
											  "FAM_TITLE_TH"=>"$fam_title_th",
											  "FAM_FNAME_TH"=>"$fam_fname_th",
											  "FAM_LNAME_TH"=>"$fam_lname_th",
											  "FAM_CODE_ID"=>"$fam_code_id",
											  "FAM_BIRTHDAY"=>"TO_DATE('$fam_birthday','YYYY-MM-DD')",
											  "FAM_ALIVE"=>"$fam_alive",
											  "FAM_OCCUPATION"=>"$fam_occupation",
											  "FAM_WORK_PLACE"=>"$fam_work_place",
											  "FAM_MOBILE"=>"$fam_phone",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
					  ),$conn); 
					  
	$emp_id = $row['CODE_PERSON'];
	$chl_fname_th = $row['FIRST_NAME_THA'];
	$chl_lname_th = $row['LAST_NAME_THA'];
	$chl_code_id = $row['CITIZEN_CODE'];
	$chl_birthday = $row['BIRTH_DATE'];
	$chl_alive = $row['CURRENT_STATUS_CODE'];
	$chl_occupation = $row['OCCUPATION_REMARK'];
	$chl_work_place  = $row['OFFICE'];
	$chl_phone  = $row['PHONE'];
	
		$result=$db->add_db(TB_CHILDREN_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CHL_FNAME_TH"=>"$chl_fname_th",
											  "CHL_LNAME_TH"=>"$chl_lname_th",
											  "CHL_BIRTHDAY"=>"TO_DATE('$chl_birthday','YYYY-MM-DD')",
											  "CHL_ALIVE"=>"$chl_alive",
											  "CHL_CODE_ID"=>"$chl_code_id",
											  "CHL_OCCUPATION"=>"$chl_occupation",
											  "CHL_WORK_PLACE"=>"$chl_work_place",
											  "CHL_MOBILE"=>"$chl_phone",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
					  ),$conn); 				  
					  
					  
	
	$n++;
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";

}
}else{
echo "fail";	
}
	
$sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);

$db->add_db("ADD_DATE",array( 
"DATE_NOW"=>"TO_DATE('".date("Y-m-d")."','YYYY-MM-DD')"
,"RAN"=>"".randpass(5).""
),$conn); 

echo oci_error();
$sql = "INSERT INTO ADD_DATE values(TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS'),'".randpass(5)."')";
$stid = oci_parse($conn, $sql );
oci_execute($stid);

$sql = "SELECT * FROM ADD_DATE ";	
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	echo $row['DATE_NOW'];
	echo "<br />";
	echo $row['RAN'];
	echo "<br />";
}*/


/*$sql = "SELECT * FROM CURRENTWORK  ";
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$CWK_MUA_EMP_TYPE = $row['CUR_STAFFTYPE'];
	$CWK_MUA_EMP_SUBTYPE = $row['CUR_SUBSTAFFTYPE'];
	$CWK_MUA_MAIN = $row['CUR_FACULTY'];
	$CWK_MUA_SUBMAIN = $row['CUR_DEPARTMENT_SECTION'];
	$CWK_MUA_WORK_GROUP = $row['CUR_DEPARTMENT_GROUP'];
	$CWK_DSU_EDU_CENTER = $row['CUR_SITE'];
	$CWK_MUA_VPOS  = $row['CUR_KNOWPOSITION'];
	$CWK_MUA_LEVEL  = $row['CUR_KNOWPOSITIONLEVEL'];
	
	$CWK_START_WORK_DATE = $row['CUR_DATEIN'];
	$CWK_EDU_GROUP1 = $row['CUR_TEACHSUBJECT'];
	$CWK_MUA_MPOS  = $row['ADMIN_POSITION_ID'];
	$CWK_SALARY_TIME_TYPE  = $row['TIME_CONTACT_ID'];
	$CWK_PHONE  = $row['CUR_INPHONE'];
	
	$CWK_DSU_POS = trim($row['CUR_POSITION']);
	$sql2 = "SELECT CODE FROM POSITION  WHERE POSITION = '$CWK_DSU_POS'  ";
	$stid2 = oci_parse($conn, $sql2 );
	oci_execute($stid2);
	$row2 = oci_fetch_array($stid2, OCI_BOTH);
	$CWK_DSU_POS_CODE = $row2['CODE'];
	
	
		$result=$db->add_db(TB_CURRENT_WORK_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CWK_MUA_EMP_TYPE"=>"$CWK_MUA_EMP_TYPE",
											  "CWK_MUA_EMP_SUBTYPE"=>"$CWK_MUA_EMP_SUBTYPE",
											  "CWK_MUA_MAIN"=>"$CWK_MUA_MAIN",
											  "CWK_MUA_SUBMAIN"=>"$CWK_MUA_SUBMAIN",
											  "CWK_MUA_WORK_GROUP"=>"$CWK_MUA_WORK_GROUP",
											  "CWK_DSU_EDU_CENTER"=>"$CWK_DSU_EDU_CENTER",
											  "CWK_MUA_VPOS"=>"$CWK_MUA_VPOS",
											  "CWK_MUA_LEVEL"=>"$CWK_MUA_LEVEL",
											  "CWK_START_WORK_DATE"=>"$CWK_START_WORK_DATE",
											  "CWK_EDU_GROUP1"=>"$CWK_EDU_GROUP1",
											  "CWK_MUA_MPOS"=>"$CWK_MUA_MPOS",
											  "CWK_SALARY_TIME_TYPE"=>"$CWK_SALARY_TIME_TYPE",
											  "CWK_DSU_POS"=>"$CWK_DSU_POS_CODE",
											  "CWK_PHONE"=>"$CWK_PHONE",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
					  ),$conn); 				  
					  
					  
	
	$n++;
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM CURRENTWORK  ";
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$SALARY1 = $row['CUR_SALARY'];
	$SOURCE1 = $row['CUR_SALARY_SOURCE'];
$n++;
	

	
		$result=$db->add_db(TB_REF_SALARY_STEP,array(
												"REF"=>"$n",
 											  "EMP_ID"=>"$emp_id",
											  "SALARY1"=>"$SALARY1",
											  "SOURCE1"=>"$SOURCE1",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"
					  ),$conn); 				  
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM PERSONNEL_STATUS" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$STA_CODE = $row['STA_CODE'];
$n++;
	

	
		$result=$db->update_db(TB_CURRENT_WORK_TAB,array(
 											  "CWK_STATUS"=>"$STA_CODE"
					  ),"EMP_ID='$emp_id'",$conn);   
					  
					  
	
	
	if($result) echo "row $n update successful <br >";
	else echo "row $n update fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM SALARY_MASTER WHERE SALARY_TYPE_ID <> '10' " ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$EX_SALARY_REF = $row['SALARY_TYPE_ID'];
	$EX_SALARY = $row['SALARY_AMOUNT'];
	$EX_SOURCE = $row['SALARY_SOURCE'];
$n++;
	

	
		$result=$db->add_db(TB_EXTRA_SALARY_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "EX_ID"=>"$n",
											  "EX_SALARY_REF"=>"$EX_SALARY_REF",
											  "EX_SALARY"=>"$EX_SALARY",
											  "EX_SOURCE"=>"$EX_SOURCE"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM ROYAL_DECORATE_DETAIL  ";
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
		$RDD_DEC_TYPE = $row['RDD_DEC_TYPE'];
	$ROY_YEAR = substr($row['RDD_DATE_PROMOTE'],0,4) + 543;
	list($ROY_NO1,$ROY_NO2) = explode("/",$row['RDD_TITLE']);

	
	$CWK_DSU_POS = trim($row['CUR_POSITION']);
	$sql2 = "SELECT RD_FULL_NAME,RD_SHORT_NAME FROM ROYAL_DECORATE  WHERE RD_ID = '$RDD_DEC_TYPE'  ";
	$stid2 = oci_parse($conn, $sql2 );
	oci_execute($stid2);
	$row2 = oci_fetch_array($stid2, OCI_BOTH);
	$ROY_NAME = $row2['RD_FULL_NAME']." (".$row2['RD_SHORT_NAME'].")";
	$n++;
	
		$result=$db->add_db(TB_ROYAL_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "ROY_ID"=>"$n",
											  "ROY_NAME"=>"$ROY_NAME",
											  "ROY_YEAR"=>"$ROY_YEAR",
											  "ROY_NO1"=>"$ROY_NO1",
											  "ROY_NO2"=>"$ROY_NO2",
											  "ROY_OWN"=>"1"
											 
					  ),$conn); 				  
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM PASTWORK ORDER BY CODE_PASTWORK ASC" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$WRK_WORK_PLACE = $row['OLD_WORKPLACE'];
	$WRK_POSITION = $row['OLD_POSITION'];
	$WRK_DEPART = $row['OLD_DIVISION'];
	$WRK_RESPONSIBILITY = $row['OLD_JOBDESCRIPTION'];
	$WRK_LONG = $row['OLD_PERIOD'];
	$WRK_LOC = $row['OLD_WORKADDRESS'];
	$WRK_PHONE = $row['OLD_WORKTEL'];
$n++;
	

	
		$result=$db->add_db(TB_WORK_HISTORY_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "WRK_ID"=>"$n",
											  "WRK_WORK_PLACE"=>"$WRK_WORK_PLACE",
											  "WRK_POSITION"=>"$WRK_POSITION",
											  "WRK_DEPART"=>"$WRK_DEPART",
											  "WRK_RESPONSIBILITY"=>"$WRK_RESPONSIBILITY",
											  "WRK_LONG"=>"$WRK_LONG",
											  "WRK_LOC"=>"$WRK_LOC",
											  "WRK_PHONE"=>"$WRK_PHONE"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM QUALIFICATION ORDER BY CODE_QUA ASC" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$EDU_LEVEL = $row['QUA_EDU_LEV'];
	$EDU_COUNTRY = $row['QUA_NATION'];
	$EDU_NAME = $row['QUA_NAME'];
	$EDU_NAME_SHORT = $row['QUA_QUA'];
	$EDU_GPA = $row['QUA_GPA'];
	$EDU_DISCIPLINE = $row['QUA_DISCIPLINE'];
	$EDU_YEAR = $row['QUA_YEAR'];
	$EDU_MAJOR = $row['QUA_MAJOR'];
	$EDU_PROGRAM = $row['QUA_PROG_ID'];
	$EDU_FROM = $row['QUA_SCHOOL'];
$n++;
	

	
		$result=$db->add_db(TB_EDUCATION_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "EDU_ID"=>"$n",
											  "EDU_LEVEL"=>"$EDU_LEVEL",
											  "EDU_COUNTRY"=>"$EDU_COUNTRY",
											  "EDU_NAME"=>"$EDU_NAME",
											  "EDU_NAME_SHORT"=>"$EDU_NAME_SHORT",
											  "EDU_GPA"=>"$EDU_GPA",
											  "EDU_DISCIPLINE"=>"$EDU_DISCIPLINE",
											  "EDU_YEAR"=>"$EDU_YEAR",
											  "EDU_MAJOR"=>"$EDU_MAJOR",
											  "EDU_PROGRAM"=>"$EDU_PROGRAM",
											  "EDU_FROM"=>"$EDU_FROM"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM EXPERT_EXTEND  ORDER BY CODE_PERSON ASC" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$EXP_EXPERT1 = $row['EXPERT_EXTEND'];
	$EXP_EXPERT2 = $row['EXPERT_OTHER'];
	
$n++;
	

	
		$result=$db->add_db(TB_EXPERT_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "EXP_EXPERT1"=>"$EXP_EXPERT1",
											  "EXP_EXPERT2"=>"$EXP_EXPERT2"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM COMMITTEE  WHERE CMT_TYPE = '07' OR  CMT_TYPE = '08' OR  CMT_TYPE = '02' OR  CMT_TYPE = '03' OR  CMT_TYPE = '01' OR  CMT_TYPE = '04' OR  CMT_TYPE = '09' OR  CMT_TYPE = '14' ORDER BY CMT_ID ASC" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		$emp_id = $row['CODE_PERSON'];
	$SEM_TYPE = $row['CMT_TYPE'];
	$SEM_COURSE_NAME = $row['CMT_COURSE'];
	$SEM_START_DATE = $row['CMT_DATE_START'];
	$SEM_END_DATE = $row['CMT_DATE_END'];
	$SEM_PLACE = $row['CMT_PLACE'];
	$SEM_BENEFIT = $row['CMT_DETAIL'];
	
	$sql2 = "SELECT * FROM CURRENT_WORK_TAB  WHERE EMP_ID = '$emp_id' " ;
	$stid2 = oci_parse($conn, $sql2 );
	oci_execute($stid2);
	$row2 = oci_fetch_array($stid2, OCI_BOTH);
	
	$SEM_WHO_NAME = get_name($emp_id,TB_BIODATA_TAB);
	$SEM_WHO_POSITION = get_position($row2['CWK_MUA_VPOS'],$row2['CWK_MUA_LEVEL']);
	$SEM_DEPART = $row2['CWK_MUA_MAIN'];
	
$n++;
	

	
		$result=$db->add_db(TB_SEMINAR_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "ID"=>"$n",
											  "SEM_WHO_NAME"=>"$SEM_WHO_NAME",
											  "SEM_WHO_POSITION"=>"$SEM_WHO_POSITION",
											  "SEM_DEPART"=>"$SEM_DEPART",
											  "SEM_TYPE"=>"$SEM_TYPE",
											  "SEM_COURSE_NAME"=>"$SEM_COURSE_NAME",
											  "SEM_START_DATE"=>"$SEM_START_DATE",
											  "SEM_END_DATE"=>"$SEM_END_DATE",
											  "SEM_PLACE"=>"$SEM_PLACE",
											  "SEM_BENEFIT"=>"$SEM_BENEFIT"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/

/*$sql = "SELECT * FROM COMMITTEE  WHERE  CMT_TYPE = '10'   ORDER BY CMT_ID ASC" ;
$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
$n = 0;

while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	$emp_id = $row['CODE_PERSON'];
	$COM_ORDER_NO = $row['CMT_CODE_COMMAND'];
	$COM_COURSE = $row['CMT_COURSE'];
	$COM_TYPE = $row['CMT_TYPE'];
	$COM_START_DATE = $row['CMT_DATE_START'];
	$COM_END_DATE = $row['CMT_DATE_END'];
	$COM_ORG_NAME = $row['CMT_PLACE'];
	$COM_DETAIL = $row['CMT_DETAIL'];

	
$n++;

		$result=$db->add_db(TB_CONSULT_COMMIT_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "COM_ID"=>"$n",
											  "COM_ORDER_NO"=>"$COM_ORDER_NO",
											  "COM_ORG_NAME"=>"$COM_ORG_NAME",
											  "COM_COURSE"=>"$COM_COURSE",
											  "COM_DETAIL"=>"$COM_DETAIL",
											  "COM_TYPE"=>"$COM_TYPE",
											  "COM_START_DATE"=>"$COM_START_DATE",
											  "COM_END_DATE"=>"$COM_END_DATE"
											  
					  ),$conn);   
					  
					  
	
	
	if($result) echo "row $n insert successful <br >";
	else echo "row $n insert fail <br >";
	
	
	
}
}else{
echo "fail";	
}*/
oci_free_statement($stid);
$db->closedb($conn);
?>