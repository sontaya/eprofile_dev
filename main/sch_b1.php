<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");

$sql = "SELECT * FROM  ".TB_SCHOLAR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
$sch_edu_start_date = change_date_thai($row["SCH_EDU_START_DATE"]);
$sch_edu_end_date = change_date_thai($row["SCH_EDU_END_DATE"]);
$sch_start_date = change_date_thai($row["SCH_START_DATE"]);
$sch_end_date = change_date_thai($row["SCH_END_DATE"]);

$sql_pay_back = "SELECT * FROM  ".TB_SCH_PAY_BACK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row_pay_back = $db->fetch($sql_pay_back,$conn);
$sch_start_pay = change_date_thai($row_pay_back["DATE_START_PAY1"]);

$sch_pay_date2 = change_date_thai($row_pay_back["DATE2"]);

$sch_date_present = change_date_thai($row_pay_back["DATE_PRESENT"]);

if($row_pay_back["DATE1"] != "" or $row_pay_back["DATE1"] != NULL){
	$sch_pay_date1 = change_date_thai($row_pay_back["DATE1"]);
}else{
	$sch_pay_date1 = $sch_edu_start_date;
}
if($row_pay_back["COUNTDATE1"] > 0) $sch_pay_count = $row_pay_back["COUNTDATE1"];
else $sch_pay_count = 0;

if($row_pay_back["MULTIPLY1"] > 0) $sch_pay_mul = $row_pay_back["MULTIPLY1"];
else $sch_pay_mul = 0;

if($row_pay_back["DAYS1"] > 0) $sch_pay_days1 = $row_pay_back["DAYS1"];
else $sch_pay_days1 = 0;

?>
<div style="padding-left:15px; padding-top:15px; padding-bottom:15px;">
    	<input type="radio" name="scholar1" value="1"  onclick="ch1(2)" <? if($row_pay_back["SCHOLAR1"] == "1") echo "checked='checked' ";?>/> ทุนมหาวิทยาลัย  
        <input type="radio" name="scholar1" value="2" onclick="ch1(1)" <? if($row_pay_back["SCHOLAR1"] == "2") echo "checked='checked' ";?> /> ทุนอื่น ๆ<br />
        <table border="0" cellspacing="4">
        <tr><td width="973" align="left">
        วันที่เริ่มขอไปศึกษา <input type="text" name="datepicker1" id="datepicker1" style="width: 80px; " class="input_text" value="<?=$sch_pay_date1?>" />
         <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker1','YYYY-MM-DD')"  style="cursor:pointer" />
        วันที่สำเร็จการศึกษา <input type="text" name="datepicker2" id="datepicker2" style="width: 80px; " class="input_text" value="<?=$sch_edu_end_date?>" /> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker2','YYYY-MM-DD')"  style="cursor:pointer" /> 
         </td></tr>
		 <tr>
		 	<td>
				วันที่รายงานเข้าปฏิบัติงาน  <input type="text" name="date_present" id="date_present" style="width: 80px; " class="input_text" value="<?=$sch_date_present?>" />
         <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_present','YYYY-MM-DD')"  style="cursor:pointer" /> 
			</td>
		 </tr>
         <tr><td align="left">
        คิดเป็นจำนวนวัน <input type="text" id="countdate1" name="countdate1" class="res input_text" value="<?=$sch_pay_count?>" style="text-align:right;width: 70px"> 
         </td></tr>
         <tr><td align="left">
        ต้องทำงานชดใช้ทุนเป็นจำนวน <input type="text" id="multiply1" name="multiply1" class="res input_text" value="<?=$sch_pay_mul?>" style="text-align:right;width: 20px"> เท่า  <input type="button" value="คำนวณ"  onclick="send_date()" /></td></tr>
         <tr><td align="left">
        คิดเป็นจำนวนวันที่ชดใช้ <input type="text" id="days1" name="days1" class="res input_text" value="<?=$sch_pay_days1?>" style="text-align:right;width: 70px"> 
        วัน
         &nbsp;</td></tr>
         <tr>
           <td align="left">
        วันที่เริ่มปฏิบัติงานชดใช้หนี้ทุน 
          <input type="text" name="date_start_pay1" id="date_start_pay1" style="width: 80px; " class="input_text" value="<?=$sch_start_pay?>" />
         <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_start_pay1','YYYY-MM-DD')"  style="cursor:pointer" /></td></tr>
         <tr>
           <td align="left">
        วันที่สิ้นสุดปฏิบัติงานชดใช้หนี้ทุน <b><?=count_day($row_pay_back["DATE_START_PAY1"],$sch_pay_days1);?></b></td></tr>
         </table>
</div>