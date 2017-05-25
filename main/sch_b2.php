<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");


$sql = "SELECT * FROM  ".TB_SCHOLAR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
$sch_money = (float)$row["SCH_MONEY"]+(float)$row["SCH_MONEY1"]+(float)$row["SCH_MONEY2"]+(float)$row["SCH_MONEY3"];

$sql_pay_back = "SELECT * FROM  ".TB_SCH_PAY_BACK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row_pay_back = $db->fetch($sql_pay_back,$conn);


?>
<div style="padding-left:15px; padding-top:15px; padding-bottom:15px;">
    <input type="radio" name="scholar2" value="1"  onclick="ch2(2)" <? if($row_pay_back["SCHOLAR2"] == "1") echo "checked='checked' ";?> /> ทุนมหาวิทยาลัย  
    <input type="radio" name="scholar2" value="2" onclick="ch2(1)" <? if($row_pay_back["SCHOLAR2"] == "2") echo "checked='checked' ";?> /> ทุนอื่น ๆ<br />
    <table border="0" cellspacing="4">
        <tr><td width="967" align="left">
	จำนวนเงินทุนที่ขอไปศึกษา มูลค่า <input type="text" name="money2" id="money2" value="<?=$row_pay_back["MONEY2"]?>" style="text-align:right; width: 100px;" class="res input_text"  /> 
	บาท (ระบุหน่วยสตางค์ด้วยถ้ามี และไม่ต้องใส่ ,) 
	<input type="button" value="คำนวณ"  onclick="calc_money()" />
    </td></tr>
    <tr><td align="left">
    จำนวนเงินต้นที่ต้องชำระคืน <input type="text" id="mp" name="mp" class="res input_text" value="<?=$row_pay_back["MP"]?>" style="text-align:right;width: 80px; "> บาท
    </td></tr>
    <tr><td align="left">
    ค่าปรับจากเงินต้น <input type="text" id="multiply2" name="multiply2" value="<?=$row_pay_back["MULTIPLY2"]?>"  style="text-align:right;width:20px;"> เท่า  
    คิดเป็น <input type="text" id="tw" class="res input_text" name="tw" value="<?=$row_pay_back["TW"]?>" style="text-align:right;width: 80px; "> บาท
    </td></tr>
    <tr><td align="left">
    คิดเป็นจำนวนเงินต้องชดใช้ <input type="text" id="result2" name="result2" class="res input_text" value="<?=$row_pay_back["RESULT2"]?>" style="text-align:right;width: 80px; "> บาท
    </td></tr></table>
</div>