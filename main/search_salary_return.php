<?
$fpath = '../';
require_once($fpath."includes/connect.php");
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastname"]);
$emp_id = trim($_POST["emp_id"]);
$person_id = trim($_POST["person_id"]);
$depart = trim($_POST["depart"]);

if($depart == "0"){
	
	if($name != ""){
		$where[] = " BIO_FNAME_TH LIKE '%$name%' "; 
	}
	if($lastname != ""){
		$where[] = " BIO_LNAME_TH LIKE '%$lastname%' "; 
	}
	if($emp_id != ""){
		$where[] = " EMP_ID LIKE '%$emp_id%' "; 
	}
	if($person_id != ""){
		$where[] = " PERSON_ID LIKE '%$person_id%' "; 
	}
	
	$where_size = count($where);
	$q_where = "";
	for ($i = 0;$i < $where_size; $i++){
			$q_where .= "$where[$i] AND ";
			
			if($where_size == ($i+1)){
				$q_where = substr($q_where,0,-4); // remove the last " OR AND";
				//$q_where .= " WHERE CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' "; 
			}
		
	}
	
	$num = $db->count_row(TB_BIODATA_TAB," WHERE $q_where  ",$conn); 
}else{
	 $q_where = "  CWK_MUA_MAIN = '$depart' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ";
	$num = $db->count_row(TB_CURRENT_WORK_TAB," WHERE $q_where  ",$conn); 
}
//echo $q_where;
$n = 0;

if($num == 0){
	echo "0";
}else{
	//echo "Found $num record(s)";
 if($depart == "0"){
$sql = "SELECT * FROM ".TB_BIODATA_TAB." WHERE $q_where  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	
$num2 = $db->count_row(TB_CURRENT_WORK_TAB," WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ",$conn);

if($num2 > 0){
++$n;
if($n == 1){
?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<div style="padding-left:35px; font-weight:bold" align="left">*** เลือกบุคคลที่ต้องการปรับขึ้นเงินเดือน ***</div>
<form name="person_salary" id="person_salary">
<table  border="0" align="center"  bgcolor="#e9e9e9" >
  <tr align="center" class="text_th">
    <td width="28" class="text_tr"><input type='checkbox' name='CheckAll' id="CheckAll" onclick="checkAll();"></td>
    <td width="160" class="text_tr">ขื่อ - นามสกุล</td>
    <td width="200" class="text_tr">สังกัด/หน่วยงาน</td>
    <td width="138" class="text_tr">เงินเดือนปัจจุบัน </td>
    <td width="138" class="text_tr">วันที่มีผลบังคับใช้ </td>
    <td width="15" class="text_tr">ประวัติ</td>
  </tr>
<?	
} //$n == 1

$sql2 = "SELECT CWK_MUA_MAIN FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ";
$stid2 = oci_parse($conn, $sql2 );
oci_execute($stid2);
$row2 = oci_fetch_array($stid2, OCI_BOTH);

$salary = "ไม่มีข้อมูล";
$affective_date = "ไม่มีข้อมูล";
$nrow = $db->count_row(TB_REF_SALARY_STEP," WHERE EMP_ID = '".$row["EMP_ID"]."' ORDER BY REF DESC",$conn);

if($nrow > 0){
$sql3 =  "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '".$row["EMP_ID"]."' ORDER BY REF DESC ";
$stid3 = oci_parse($conn, $sql3 );
oci_execute($stid3);
$row3 = oci_fetch_array($stid3, OCI_BOTH);

	$salary = ($row3['SALARY1']+$row3['SALARY2']+$row3['SALARY3']);
	$mod = 10 - ($salary%10);
	if($mod < 10 )
	//$salary += $mod; ปิดเพื่อไม่ให้เลขหลักหน่วยปัดเป็น 0
	$salary = number_format($salary,0);
	$affective_date = change_date_thai($row3["AFFECTIVE_DATE"]);
}

?>
<tr align="center" height="22" valign="top">
<td align="center" class="text_td"><input type="checkbox" name="emp_id" value="<?=$row["EMP_ID"]?>" /></td>
<td align="left" class="text_td text_data"><?=$row["BIO_FNAME_TH"]?> <?=$row["BIO_LNAME_TH"]?></td>
<td align="center" class="text_td"><?=get_department($row2["CWK_MUA_MAIN"],TB_REF_DEPARTMENT)?></td>
<td  align="right" style="padding-right:10px;"  class="text_td"><?=$salary?></td>
<td align="center"   class="text_td"><?=$affective_date?></td>
<td align="center" class="text_td" ><img src="../images/b_edit.png" width="15" height="15" style="cursor: pointer;" onclick="salary_history('<?=$row["EMP_ID"]?>')" /></td>

</tr>

<? 
}//$num2 > 0

}// while

}// $depart != "0"
else{
$sql = "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE $q_where ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	$num2 = $db->count_row(TB_CURRENT_WORK_TAB," WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ",$conn);
	if($num2 > 0){
++$n;
if($n == 1){
?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<div style="padding-left:35px; font-weight:bold" align="left">*** เลือกบุคคลที่ต้องการปรับขึ้นเงินเดือน ***</div>
<form name="person_salary" id="person_salary">
<table   border="0" align="center"  bgcolor="#e9e9e9" >
  <tr align="center" class="text_th">
    <td width="28" class="text_tr"><input type='checkbox' name='CheckAll' id="CheckAll" onclick="checkAll();"></td>
    <td width="160" class="text_tr">ขื่อ - นามสกุล</td>
    <td width="200" class="text_tr">สังกัด/หน่วยงาน</td>
    <td width="138" class="text_tr">เงินเดือนปัจจุบัน </td>
    <td width="138" class="text_tr">วันที่มีผลบังคับใช้ </td>
    <td width="15" class="text_tr">ประวัติ</td>
  </tr>
<?	
} //$n == 1

$sql2 = "SELECT BIO_FNAME_TH,BIO_LNAME_TH,EMP_ID FROM ".TB_BIODATA_TAB." WHERE EMP_ID = '".$row["EMP_ID"]."'  ";
$stid2 = oci_parse($conn, $sql2 );
oci_execute($stid2);
$row2 = oci_fetch_array($stid2, OCI_BOTH);

$salary = "ไม่มีข้อมูล";
$affective_date = "ไม่มีข้อมูล";
$nrow = $db->count_row(TB_REF_SALARY_STEP," WHERE EMP_ID = '".$row["EMP_ID"]."' ORDER BY REF DESC",$conn);
if($nrow > 0){
$sql3 =  "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '".$row["EMP_ID"]."' ORDER BY REF DESC ";
$stid3 = oci_parse($conn, $sql3 );
oci_execute($stid3);
$row3 = oci_fetch_array($stid3, OCI_BOTH);

	$salary = ($row3['SALARY1']+$row3['SALARY2']+$row3['SALARY3']);
	$mod = 10 - ($salary%10);
	if($mod < 10 )
	$salary += $mod;
	$salary = number_format($salary,0);
	$affective_date = change_date_thai($row3["AFFECTIVE_DATE"]);
}
?>
<tr align="center" height="22" valign="top">
<td align="center" class="text_td"><input type="checkbox" name="emp_id" value="<?=$row["EMP_ID"]?>" /></td>
<td align="left" class="text_td text_data"><?=$row2["BIO_FNAME_TH"]?> <?=$row2["BIO_LNAME_TH"]?></td>
<td align="center" class="text_td"><?=get_department($row["CWK_MUA_MAIN"],TB_REF_DEPARTMENT)?></td>
<td align="right" style="padding-right:10px;"  class="text_td"><?=$salary?></td>
<td align="center"   class="text_td"><?=$affective_date?></td>
<td align="center" class="text_td" ><img src="../images/b_edit.png" width="15" height="15" style="cursor: pointer;" onclick="salary_history('<?=$row["EMP_ID"]?>')" /></td>
</tr>

<? 
}//$num2 > 0

	
}// while
	
	
}
if($n > 0 ){
$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
$stid_budget = oci_parse($conn, $sql_budget );
oci_execute($stid_budget);
$option = array();
for($i=1;$i<4;$i++){
	$option[$i]="<option value=''>เลือก</option>";
}
while($row_budget = oci_fetch_array($stid_budget, OCI_BOTH)){
	for($i=1;$i<4;$i++){
		
			$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' >".$row_budget["NAME_SALARY_SOURCE"]."</option>\n";

		}
}
?>
    </table><br /><br />
 </form>   
<table width="642" border="0" align="left">
    <tr>
      <td width="236" align="right">ส่วนแรก :ใช้งบประมาณ </td>
      <td width="130" align="left"><select id="from1" name="from1" style="width: 130px">
        <?=$option[1]?>
      </select></td>
      <td width="144"><input type="text" name="bg1" id="bg1" class="input_text" /></td>
      <td width="114" align="left"><select name="bg1_unit" id="bg1_unit">
		 <option value="2">บาท</option>
         <option value="1">เปอร์เซ็นต์ (%)</option> 
        </select></td>
    </tr>
    <tr>
      <td align="right">ส่วนที่สอง :ใช้งบประมาณ</td>
      <td align="left"><select id="from2" name="from2" style="width: 130px">
        <?=$option[2]?>
      </select></td>
      <td><input type="text" name="bg2" id="bg2" class="input_text"/></td>
      <td align="left"><select name="bg2_unit" id="bg2_unit">
          <option value="2">บาท</option>
          <option value="1">เปอร์เซ็นต์ (%)</option> 
        </select></td>
    </tr>
    <tr>
      <td align="right"><span class="form_text">ส่วนที่สาม :ใช้งบประมาณ</span></td>
      <td align="left"><select id="from3" name="from3" style="width: 130px">
        <?=$option[3]?>
      </select></td>
      <td><input type="text" name="bg3" id="bg3" class="input_text"/></td>
      <td align="left"><select name="bg3_unit" id="bg3_unit">
		  <option value="2">บาท</option>
          <option value="1">เปอร์เซ็นต์ (%)</option> 
        </select></td>
    </tr>
    <tr>
      <td colspan="2" align="right">วันที่มีผลบังคับใช้ : </td>
      <td><input type="text" name="ud" id="ud" class="input_text" /></td>
      <td align="left"><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ud','YYYY-MM-DD')"  style="cursor:pointer"/></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td align="left"><button name="bg_add" id="bg_add" onclick="p()">ตกลง</button></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="53" colspan="2">&nbsp;</td>
      <td align="left" valign="middle"><span id="waiting"></span></td>
      <td>&nbsp;</td>
    </tr>
  </table>
    
    
    
    
    
    
    
    
    
    
<? 
}else echo "0";


}//else $num == 0

$db->closedb($conn);	
?>