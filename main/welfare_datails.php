<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT * FROM  ".TB_WELFARE_DATAILS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สวัสดิการเกี่ยวกับการรักษาพยาบาล</title>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script language="javascript">
function check_data(){
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("welfare").submit();
}
</script>
<style type="text/css">
body,td,th {
	font-family: Tahoma, "Microsoft Sans Serif", Verdana;
	font-size:14px;
}
input.filltextunderline {
	border: 0;
	border-bottom: 1px dashed #999;
	font-family: Tahoma, "Microsoft Sans Serif", Verdana;
	font-size:15px;
	text-align:center;
}
</style>
</head>

<body>
<table width="900" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>
    <fieldset>
  <form id="welfare" name="welfare" method="post" action="welfare_datails_save.php" target="upload_target">
    <p>ข้าพเจ้ามีสิทธิ์รับเงินสวัสดิการเกี่ยวกับการรักษาพยาบาล ตามพระราชกฤษฎีกาเงินสวัสดิการเกี่ยวกับการรักษาพยาบาล</p>
    <div>
      <input type="radio" name="privilege" value="1" <? if($row['PRIVILEGE'] == "1") echo "checked='checked'";?>/>
      ตามสิทธิ
      <input type="radio" name="privilege" value="2" <? if($row['PRIVILEGE'] == "2") echo "checked='checked'";?> />
      เฉพาะส่วนที่ยังขาดจากสิทธิ <br />
      เป็นเงิน
      <input name="money" type="text" class="filltextunderline" id="bth_money" value="<? if($row['MONEY'] == "0.00" or $row['MONEY'] == "") echo ""; else echo number_format($row['MONEY'],2); ?>" /> บาท 
      <span class="moneytext"></span> และ<br />
      <label>(1) ข้าพเจ้า</label><br />
      <span class="kor1">
      <input name="me" type="radio" class="r" value="1" <? if($row['ME'] == "1") echo "checked='checked'";?>/>
          ไม่มีสิทธิได้รับเงินค่ารักษาพยาบาลจากรัฐวิสาหกิจหรือหน่วยงานของส่วนราชการ หรือราชการส่วนท้องถิ่น หรือหน่วยงานอื่นที่มิใช่ส่วนราชการ<br />
          <input name="me" type="radio" class="r" value="2" <? if($row['ME'] == "2") echo "checked='checked'";?>/>
          มีสิทธิ แต่สิทธิที่ได้รับต่ำกว่า<br />
          <input name="me" type="radio" class="r" value="3" <? if($row['ME'] == "3") echo "checked='checked'";?> />
          เป็นผู้ใช้สิทธิเบิกค่ารักษาพยาบาลสำหรับบุตรแต่เพียงฝ่ายเดียว<br />
      </span><br />
      <label>(2) คู่สมรสของข้าพเจ้า</label><br />
          <span class="kor2">
          <input name="mar" type="radio" class="filltextunderline" value="1" <? if($row['MAR'] == "1") echo "checked='checked'";?>/>
          ไม่เป็นข้าราชการ หรือลูกจ้างประจำ <br />
          <input name="mar" type="radio" class="filltextunderline" value="2" <? if($row['MAR'] == "2") echo "checked='checked'";?>/>
          เป็นข้าราชการหรือลูกจ้างประจำ ตำแหน่ง
          <input name="position" type="text" class="filltextunderline" value="<?=$row['POSITION']?>"/>
          สังกัด
          <input name="depart" type="text" class="filltextunderline" value="<?=$row['DEPART']?>" />
          <br />
          <input name="mar" type="radio" class="filltextunderline" value="3" <? if($row['MAR'] == "3") echo "checked='checked'";?>/>
          เป็นพนักงานหรือลูกจ้างในรัฐวิสาหกิจ
          </span><br />
      <label>(3)
        <input name="who" type="text" class="filltextunderline" value="<?=$row['WHO']?>"/>
        ข้าพเจ้า</label>
      <input type="radio" name="who_p" value="1" <? if($row['WHO_P'] == "1") echo "checked='checked'";?>/>
      ไม่มีสิทธิได้รับค่ารักษาพยาบาลจากรัฐวิสาหกิจ หรือหน่วยงานของส่วนราชการ หรือราชการส่วนท้องถิ่น หรือหน่วยงานอื่นที่มิใช่ส่วนราชการ </div>
      <p>&nbsp;</p>
    <div> ข้าพเจ้าขอรับรองว่า ข้อความข้างต้นเป็นจริงทุกประการ </div>
    <div>
      <label for="sign">ลงชื่อ</label>
      <input name="sign" type="text" class="filltextunderline" value="<?=$row['SIGN']?>"/>
      ผู้ขอรับเงินสวัสดิการ </div>
  </form>
</fieldset>

    <table width="259" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="81" height="45" valign="middle"><input type="button" value="บันทึกข้อมูล" onClick="check_data()" /></td>
    <td width="164" align="left" valign="middle"><span id="waiting"></span></td>
  </tr>
</table>

    </td>
  </tr>
</table>
<iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;border:0px solid #fff;display:none;" ></iframe> 

</body>
</html>
<? $db->closedb($conn);?>