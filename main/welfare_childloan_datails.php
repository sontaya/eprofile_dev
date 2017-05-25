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
$sql = "SELECT * FROM  ".TB_WELFARE_CHILDLOAN_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สนับสนุนทุนเล่าเรียนบุตร</title>
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
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
<script language="javascript">
function check_data(){
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("welfare").submit();
}
</script>
</head>

</head>

<body>
<table width="789" border="0" cellspacing="3" cellpadding="3" >
  <tr>
    <td width="777">
    <form id="welfare" name="welfare" method="post" action="welfare_childloan_save.php" target="upload_target">
    <fieldset>
    <p align="left">ข้าพเจ้าได้จ่ายเงินสำหรับการศึกษาของบุตร ดังนี้</p>
    <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (1)&nbsp; เงินบำรุงการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2)&nbsp; เงินค่าเล่าเรียน</p>
    
    <table width="778" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="16" align="left" valign="top" style="padding-top:11px">1.</td>
    <td width="741" align="left" valign="top" style="" >
      <table width="700" border="0" cellspacing="2" cellpadding="3">
        <tr>
    <td colspan="2" align="left" valign="top">บุตรชื่อ
      <input type="text" id="child_name1" name="child_name1" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_NAME1']?>"/>
     &nbsp; เกิดเมื่อ
     <input type="text" id="child_birth1" name="child_birth1" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_BIRTH1']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">เป็นบุตรลำดับที่ (ของบิดา)
      <input type="text" id="child_f_order1" name="child_f_order1" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_F_ORDER1']?>"/>
     &nbsp; เป็นบุตรลำดับที่ (ของมารดา)
     <input type="text" id="child_m_order1" name="child_m_order1" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_M_ORDER1']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">(กรณีเป็นบุตรแทนที่บุตรซึ่งถึงแก่กรรมแล้ว)&nbsp; แทนบุตรลำดับที่
      <input type="text" id="child_d_order1" name="child_d_order1" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_D_ORDER1']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">ชื่อ
      <input type="text" id="child_d_name1" name="child_d_name1" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_D_NAME1']?>"/>
     &nbsp; เกิดเมื่อ 
      <input type="text" id="child_d_birth1" name="child_d_birth1" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_D_BIRTH1']?>"/>
      &nbsp; ถึงแก่กรรมเมื่อ
      <input type="text" id="child_d_dead1" name="child_d_dead1" class="filltextunderline" style="width:150px"  value="<?=$row['CHILD_D_DEAD1']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">สถานศึกษา
      <input type="text" id="child_school1" name="child_school1" class="filltextunderline" style="width:220px" value="<?=$row['CHILD_SCHOOL1']?>" />
     &nbsp; อำเภอ
     <input type="text" id="child_amphur1" name="child_amphur1" class="filltextunderline" style="width:130px"  value="<?=$row['CHILD_AMPHUR1']?>"/>
     &nbsp; จังหวัด
     <input type="text" id="child_province1" name="child_province1" class="filltextunderline" style="width:130px" value="<?=$row['CHILD_PROVINCE1']?>"/></td>
          </tr>
        <tr>
          <td width="264" align="left" valign="top">ชั้นที่ศึกษา
            <input type="text" id="edu_level1" name="edu_level1" class="filltextunderline" style="width:150px" value="<?=$row['EDU_LEVEL1']?>" />
&nbsp; </td>
          <td width="418" align="left" valign="top"><input type="radio" id="type1" name="type1" value="1" <? if($row['TYPE1'] == "1") echo "checked='checked'";?> /> (1)</td>
          </tr>
          <tr>
          <td width="264" align="left" valign="top">&nbsp;</td>
          <td width="418" align="left" valign="top"><input type="radio" id="type1" name="type1" value="2" <? if($row['TYPE1'] == "2") echo "checked='checked'";?>/> 
            (2)&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; จำนวนเงิน <input type="text" id="money1" name="money1" class="filltextunderline" style="width:110px" value="<? if($row['MONEY1'] == "0.00" or $row['MONEY1'] == "") echo ""; else echo number_format($row['MONEY1'],2); ?>"/> 
            บาท </td>
          </tr>
</table>

      </td>
  </tr>
</table><br />
<table width="778" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="16" align="left" valign="top" style="padding-top:11px">2.</td>
    <td width="741" align="left" valign="top" style="" >
      <table width="700" border="0" cellspacing="2" cellpadding="3">
        <tr>
    <td colspan="2" align="left" valign="top">บุตรชื่อ
      <input type="text" id="child_name2" name="child_name2" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_NAME2']?>"/>
     &nbsp; เกิดเมื่อ
     <input type="text" id="child_birth2" name="child_birth2" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_BIRTH2']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">เป็นบุตรลำดับที่ (ของบิดา)
      <input type="text" id="child_f_order2" name="child_f_order2" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_F_ORDER2']?>"/>
     &nbsp; เป็นบุตรลำดับที่ (ของมารดา)
     <input type="text" id="child_m_order2" name="child_m_order2" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_M_ORDER2']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">(กรณีเป็นบุตรแทนที่บุตรซึ่งถึงแก่กรรมแล้ว)&nbsp; แทนบุตรลำดับที่
      <input type="text" id="child_d_order2" name="child_d_order2" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_D_ORDER2']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">ชื่อ
      <input type="text" id="child_d_name2" name="child_d_name2" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_D_NAME2']?>"/>
     &nbsp; เกิดเมื่อ 
      <input type="text" id="child_d_birth2" name="child_d_birth2" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_D_BIRTH2']?>"/>
      &nbsp; ถึงแก่กรรมเมื่อ
      <input type="text" id="child_d_dead2" name="child_d_dead2" class="filltextunderline" style="width:150px"  value="<?=$row['CHILD_D_DEAD2']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">สถานศึกษา
      <input type="text" id="child_school2" name="child_school2" class="filltextunderline" style="width:220px" value="<?=$row['CHILD_SCHOOL2']?>" />
     &nbsp; อำเภอ
     <input type="text" id="child_amphur2" name="child_amphur2" class="filltextunderline" style="width:130px"  value="<?=$row['CHILD_AMPHUR2']?>"/>
     &nbsp; จังหวัด
     <input type="text" id="child_province2" name="child_province2" class="filltextunderline" style="width:130px" value="<?=$row['CHILD_PROVINCE2']?>"/></td>
          </tr>
        <tr>
          <td width="264" align="left" valign="top">ชั้นที่ศึกษา
            <input type="text" id="edu_level2" name="edu_level2" class="filltextunderline" style="width:150px" value="<?=$row['EDU_LEVEL2']?>" />
&nbsp; </td>
          <td width="418" align="left" valign="top"><input type="radio" id="type2" name="type2" value="1" <? if($row['TYPE2'] == "1") echo "checked='checked'";?> /> (1)</td>
          </tr>
          <tr>
          <td width="264" align="left" valign="top">&nbsp;</td>
          <td width="418" align="left" valign="top"><input type="radio" id="type2" name="type2" value="2" <? if($row['TYPE2'] == "2") echo "checked='checked'";?>/> 
            (2)&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; จำนวนเงิน <input type="text" id="money2" name="money2" class="filltextunderline" style="width:110px" value="<? if($row['MONEY2'] == "0.00" or $row['MONEY2'] == "") echo ""; else echo number_format($row['MONEY2'],2); ?>"/> 
            บาท </td>
          </tr>
</table>

      </td>
  </tr>
</table><br />
<table width="778" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="16" align="left" valign="top" style="padding-top:11px">3.</td>
    <td width="741" align="left" valign="top" style="" >
      <table width="700" border="0" cellspacing="2" cellpadding="3">
        <tr>
    <td colspan="2" align="left" valign="top">บุตรชื่อ
      <input type="text" id="child_name3" name="child_name3" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_NAME3']?>"/>
     &nbsp; เกิดเมื่อ
     <input type="text" id="child_birth3" name="child_birth3" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_BIRTH3']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">เป็นบุตรลำดับที่ (ของบิดา)
      <input type="text" id="child_f_order3" name="child_f_order3" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_F_ORDER3']?>"/>
     &nbsp; เป็นบุตรลำดับที่ (ของมารดา)
     <input type="text" id="child_m_order3" name="child_m_order3" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_M_ORDER3']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">(กรณีเป็นบุตรแทนที่บุตรซึ่งถึงแก่กรรมแล้ว)&nbsp; แทนบุตรลำดับที่
      <input type="text" id="child_d_order3" name="child_d_order3" class="filltextunderline" style="width:80px" value="<?=$row['CHILD_D_ORDER3']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">ชื่อ
      <input type="text" id="child_d_name3" name="child_d_name3" class="filltextunderline" style="width:200px" value="<?=$row['CHILD_D_NAME3']?>"/>
     &nbsp; เกิดเมื่อ 
      <input type="text" id="child_d_birth3" name="child_d_birth3" class="filltextunderline"  style="width:150px" value="<?=$row['CHILD_D_BIRTH3']?>"/>
      &nbsp; ถึงแก่กรรมเมื่อ
      <input type="text" id="child_d_dead3" name="child_d_dead3" class="filltextunderline" style="width:150px"  value="<?=$row['CHILD_D_DEAD3']?>"/></td>
          </tr>
        <tr>
    <td colspan="2" align="left" valign="top">สถานศึกษา
      <input type="text" id="child_school3" name="child_school3" class="filltextunderline" style="width:220px" value="<?=$row['CHILD_SCHOOL3']?>" />
     &nbsp; อำเภอ
     <input type="text" id="child_amphur3" name="child_amphur3" class="filltextunderline" style="width:130px"  value="<?=$row['CHILD_AMPHUR3']?>"/>
     &nbsp; จังหวัด
     <input type="text" id="child_province3" name="child_province3" class="filltextunderline" style="width:130px" value="<?=$row['CHILD_PROVINCE3']?>"/></td>
          </tr>
        <tr>
          <td width="264" align="left" valign="top">ชั้นที่ศึกษา
            <input type="text" id="edu_level3" name="edu_level3" class="filltextunderline" style="width:150px" value="<?=$row['EDU_LEVEL3']?>" />
&nbsp; </td>
          <td width="418" align="left" valign="top"><input type="radio" id="type3" name="type3" value="1" <? if($row['TYPE3'] == "1") echo "checked='checked'";?> /> (1)</td>
          </tr>
          <tr>
          <td width="264" align="left" valign="top">&nbsp;</td>
          <td width="418" align="left" valign="top"><input type="radio" id="type3" name="type3" value="2" <? if($row['TYPE3'] == "2") echo "checked='checked'";?>/> 
            (2)&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; จำนวนเงิน <input type="text" id="money3" name="money3" class="filltextunderline" style="width:110px" value="<? if($row['MONEY3'] == "0.00" or $row['MONEY3'] == "") echo ""; else echo number_format($row['MONEY3'],2); ?>"/> 
            บาท </td>
          </tr>
</table>

      </td>
  </tr>
</table>
</fieldset>
</form>
<br />
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