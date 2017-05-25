<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");


$sql = "SELECT * FROM  ".TB_SCHOLAR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
$sch_money = (float)$row["SCH_MONEY"]+(float)$row["SCH_MONEY1"]+(float)$row["SCH_MONEY2"]+(float)$row["SCH_MONEY3"];
$sch_edu_start_date = change_date_thai($row["SCH_EDU_START_DATE"]);
$sch_edu_end_date = change_date_thai($row["SCH_EDU_END_DATE"]);

$sql_pay_back = "SELECT * FROM  ".TB_SCH_PAY_BACK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 

$row_pay_back = $db->fetch($sql_pay_back,$conn);
$sch_pay_date2 = change_date_thai($row_pay_back["DATE6"]);
$sch_start_pay = change_date_thai($row_pay_back["DATE_START_PAY3"]);

$sch_date_present2 = change_date_thai($row_pay_back["DATE_PRESENT2"]);
?>
<div style="padding-left:15px; padding-top:15px; padding-bottom:15px;">
        <input type="radio" name="scholar3" value="1" checked="checked" onclick="change_m3(2)" /> ทุนมหาวิทยาลัย  
        <input type="radio" name="scholar3" value="2" onclick="change_m3(1)" /> ทุนอื่น ๆ<br />
        <table border="0" cellspacing="4">
        <tr><td width="19" align="left">
        <b>ก.</b></td><td width="878"> จำนวนเงินทุนที่ขอไปศึกษา มูลค่า <input type="text" value="<?=$row_pay_back["MONEY3"]?>" style="width:100px; text-align: right;" name="money3" id="money3" class="res input_text" /> บาท (ระบุหน่วยสตางค์ด้วย ถ้ามี) </td></tr>
        <tr><td width="19" align="left" valign="top">
        <b>ข.</b></td><td> วันที่่เริ่มขอไปศึกษา <input type="text" name="datepicker3" id="datepicker3" style="width: 80px; " class="input_text" value="<?=$sch_edu_start_date?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker3','YYYY-MM-DD')"  style="cursor:pointer"/> 
        วันที่สำเร็จการศึกษา<input type="text" name="datepicker4" id="datepicker4" style="width: 80px; " class="input_text" value="<?=$sch_edu_end_date?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker4','YYYY-MM-DD')"  style="cursor:pointer"/>
		</td></tr>
		
		<tr>
			<td></td>
			<td>
				วันที่รายงานเข้าปฏิบัติงาน  <input type="text" name="date_present2" id="date_present2" style="width: 80px; " class="input_text" value="<?=$sch_date_present2?>" />
         <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_present2','YYYY-MM-DD')"  style="cursor:pointer" />
			</td>
		</tr>
			
        <tr><td width="19" align="left">&nbsp;
       </td><td> วันที่เริ่มปฏิบัติงานชดใช้หนี้ทุน 
         <input type="text" name="date_start_pay3" id="date_start_pay3" style="width: 80px; " class="input_text" value="<?=$sch_start_pay?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_start_pay3','YYYY-MM-DD')"  style="cursor:pointer"/>
         <input type="button" value="คำนวณ" onclick="calc_days2()" /></td></tr>
       <tr><td width="19" align="left">&nbsp;
       </td><td>คิดเป็นจำนวนวัน <input type="text"  id="count_days_2"  name="count_days_2" class="res input_text" value="<?=$row_pay_back["COUNT_DAYS_2"]?>" style="text-align:right;width: 60px"> วัน 
        ต้องชดใช้ คิดเป็นวันทำงานคือ <input type="text" id="mch3" name="mch3" value="<?=$row_pay_back["MCH3"]?>" style="text-align:right;width: 20px;" onchange="calc_ddays()" /> เท่า
        </td></tr>
        <tr><td width="19" align="left">&nbsp;
       </td><td>คิดเป็นจำนวนวันที่ชดใช้ <input type="text"  id="ddays" name="ddays"  class="res input_text" value="<?=$row_pay_back["DDAYS"]?>"  style="text-align:right;width: 60px"> วัน 
       </td></tr>
       <tr><td width="19" align="left">
       <b>ค.</b></td><td> คิดเป็นมูลค่าต่อวัน <input type="text"  id="bpd"  name="bpd" class="res input_text" value="<?=$row_pay_back["BPD"]?>"  style="text-align:right;width: 90px"> บาท/วัน 
       </td></tr>
       <tr><td width="19" align="left">
       <b>ง.</b></td><td> ปัจจุบันทำงานชดใช้ไปแล้ว ตั้งแต่วันที่ <input type="text" name="datepicker5" id="datepicker5" style="width: 80px; " class="input_text" value="<?=change_date_thai($row_pay_back["DATE5"])?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker5','YYYY-MM-DD')"  style="cursor:pointer"/>
         ถึงวันที่ <input type="text" name="datepicker6" id="datepicker6" style="width: 80px; " class="input_text" value="<?=change_date_thai($row_pay_back["DATE6"])?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('datepicker6','YYYY-MM-DD')"  style="cursor:pointer"/> <input type="button" value="คำนวณ" onclick="calc_days3()" />
         </td></tr>
         <tr><td width="19" align="left">&nbsp;
       </td><td>คิดเป็นจำนวนวัน <input type="text"  id="count_days_3" name="count_days_3"  class="res input_text" value="<?=$row_pay_back["COUNT_DAYS_3"]?>"  style="text-align:right;width: 60px"> วัน 
       </td></tr>
        <tr><td width="19" align="left">&nbsp;
       </td><td>เหลือวันที่ต้องชดใช้ <input type="text"  id="remain_days"  name="remain_days" class="res input_text" value="<?=$row_pay_back["REMAIN_DAYS"]?>" style="text-align:right;width: 60px"> วัน 
       </td></tr>
       <tr><td width="19" align="left">
       <b>จ.</b> </td><td>คิดเป็นจำนวนเงินที่ต้องชดใช้ <input type="text"  id="remain_money"  name="remain_money" class="res input_text" value="<?=$row_pay_back["REMAIN_MONEY"]?>"  style="text-align:right;width: 90px"> บาท 
       </td></tr>
       <tr><td width="19" align="left">
      <b>ฉ.</b> </td><td>ค่าปรับ <input type="text" name="mch4"  id="mch4" value="<?=$row_pay_back["MCH4"]?>" style="width: 20px" onchange="calc_ddays()" class="res input_text"/> เท่า 
        เป็นจำนวนเงินที่ต้องจ่ายค่าปรับ <input type="text"  id="ttfee" name="ttfee"  class="res input_text" value="<?=$row_pay_back["TTFEE"]?>"  style="text-align:right;width: 90px"> บาท 
        </td></tr>
        <tr><td width="19" align="left">
       <b>ช.</b></td><td> คิดเป็นจำนวนเงินที่ต้องชดใช้ทั้งหมด <input type="text"  id="grand_total"  name="grand_total" class="res input_text" value="<?=$row_pay_back["GRAND_TOTAL"]?>"  style="text-align:right;width: 90px"> บาท
       </td></tr></table>
</div>