<? 
//	error_reporting(E_ALL);
//	ini_set("display_errors",1);
	require_once("config.inc.php");
	
	
	$id = $_REQUEST["id"];
			
	$sql_search = "SELECT CODE_PERSON,CITIZEN_CODE, 
						NAME_PRENAME_THA||FIRST_NAME_THA||'  '||LAST_NAME_THA AS FULLNAME_THA,
						NAME_PRENAME_ENG||FIRST_NAME_ENG||'  '||LAST_NAME_ENG AS FULLNAME_ENG,
						CU_HOUSE_NO, CU_MOO, CU_BUILDING, CU_VILLAGE, CU_ROOM, CU_SOI, CU_ROAD, 
						CU_NAME_TUMBON, CU_NAME_AMPHUR, CU_NAME_PROVINCE, CU_POST_CODE, 
    					CA_HOUSE_NO, CA_MOO, CA_BUILDING, CA_VILLAGE, CA_ROOM, CA_SOI, CA_ROAD, 
						CA_NAME_TUMBON, CA_NAME_AMPHUR, CA_NAME_PROVINCE, CA_POST_CODE,
						STAFF_TYPE, STAFF_TYPE_NAME, SUBSTAFF_TYPE_NAME, CODE_FACULTY, NAME_FACULTY,
						CODE_DEPARTMENT, NAME_DEPARTMENT, CODE_SITE, NAME_SITE, NAME_MPOSITION, 
						PHONE, MOBILE1,
						BIRTH_DATE, TO_CHAR(BIRTH_DATE,'dd/mm/')||TO_CHAR(TO_NUMBER(TO_CHAR(BIRTH_DATE,'yyyy'))+543) AS BIRTH_DATE_THA, 
						START_WORK_DATE, TO_CHAR(START_WORK_DATE,'dd/mm/')||TO_CHAR(TO_NUMBER(TO_CHAR(START_WORK_DATE,'yyyy'))+543) AS START_WORK_DATE_THA,
						PHONE_OFFICE, CODE_STATUS, NAME_STATUS
					FROM SDU_GENERAL_PROFILE 
					WHERE 1=1  AND CODE_PERSON = '$id' ";
							
			
					
			$res = oci_parse($conn,$sql_search);
			oci_execute($res);		
			$arr = oci_fetch_array($res);	
			

			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>External Profile : <?= $arr["CODE_PERSON"] ?></title>
<link rel="stylesheet" type="text/css" href="external.css"/>
</head>

<body>
<br />
<br />

<table width="95%" align="center" cellpadding="4" cellspacing="0" class="BorderDash">
  <tr class="TableHeader">
    <td height="25" colspan="4" align="left" bgcolor="#006600" class="TitleCaption">ข้อมูลเบื้องต้น</td>
  </tr>
  <tr class="TableHeader">
        <td width="188" height="25" align="right" class="TitleCaption">รหัสบุคลากร</td>
        <td width="403" align="left"><?= $arr["CODE_PERSON"] ?></td>
        <td width="122" align="right" class="TitleCaption">รหัสประจำตัวประชาชน</td>
        <td width="466"><?= $arr["CITIZEN_CODE"] ?></td>
  </tr>

  <tr bgcolor="#E9E9E9" >
            <td height="25" align="right" class="TitleCaption">&nbsp;ชื่อ-นามสกุล</td>
            <td><?= $arr["FULLNAME_THA"] ?></td>
            <td align="right">&nbsp;</td>
            <td><?= $arr["FULLNAME_ENG"] ?></td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">ว/ด/ป เกิด</td>
    <td><?= $arr["BIRTH_DATE_THA"] ?></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#E9E9E9" >
    <td height="25" align="right" class="TitleCaption">ที่อยู่ปัจจุบัน</td>
    <td colspan="3"><?= $arr["CU_HOUSE_NO"] ?>&nbsp;&nbsp;หมู่&nbsp;
    <?= $arr["CU_MOO"] ?>
    &nbsp;ถนน&nbsp;<?= $arr["CU_ROAD"] ?></td>
  </tr>
  <tr bgcolor="#E9E9E9" >
    <td height="25" align="right" class="TitleCaption">&nbsp;</td>
    <td colspan="3">ตำบล&nbsp;
    <?= $arr["CU_NAME_TUMBON"] ?>      &nbsp;อำเภอ&nbsp;
    <?= $arr["CU_NAME_AMPHUR"] ?>    &nbsp;จังหวัด 
    <?= $arr["CU_NAME_PROVINCE"] ?>    &nbsp;&nbsp;รหัสไปรษณีย์&nbsp;
    <?= $arr["CU_POST_CODE"] ?></td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">ที่อยู่ตามทะเบียนบ้าน</td>
    <td colspan="3"><?= $arr["CA_HOUSE_NO"] ?>
      &nbsp;หมู่&nbsp;
      <?= $arr["CA_MOO"] ?>
&nbsp;ถนน&nbsp;
<?= $arr["CA_ROAD"] ?></td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">&nbsp;</td>
    <td colspan="3">ตำบล&nbsp;
      <?= $arr["CA_NAME_TUMBON"] ?>
&nbsp;อำเภอ&nbsp;
<?= $arr["CA_NAME_AMPHUR"] ?>
&nbsp;จังหวัด
<?= $arr["CA_NAME_PROVINCE"] ?>
&nbsp;&nbsp;รหัสไปรษณีย์&nbsp;
<?= $arr["CA_POST_CODE"] ?></td>
  </tr>
  <tr bgcolor="#E9E9E9" >
    <td height="25" align="right" class="TitleCaption">โทรศัพท์ที่บ้าน </td>
    <td bgcolor="#E9E9E9"><?= $arr["PHONE"] ?></td>
    <td align="right" class="TitleCaption">โทรศัพท์มือถือ</td>
    <td><?= $arr["MOBILE1"] ?></td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">เบอร์ติดต่อภายใน</td>
    <td><?= $arr["PHONE_OFFICE"] ?></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td height="25" colspan="4" align="left" bgcolor="#006600" class="TitleCaption">ข้อมูลการทำงาน</td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">ประเภทบุคลากร</td>
    <td><?= $arr["STAFF_TYPE_NAME"] ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?= $arr["SUBSTAFF_TYPE_NAME"] ?></td>
    <td align="right" class="TitleCaption">วันเริ่มงาน</td>
    <td><?= $arr["START_WORK_DATE_THA"] ?></td>
  </tr>
  <tr bgcolor="#E9E9E9" >
    <td height="25" align="right" class="TitleCaption">สังกัดคณะ/สำนัก</td>
    <td><?= $arr["NAME_FACULTY"] ?></td>
    <td align="right"><span class="TitleCaption">สังกัดย่อย</span></td>
    <td><?= $arr["NAME_DEPARTMENT"] ?></td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">ตำแหน่งทางวิชาการ</td>
    <td><?= $arr["NAME_MPOSITION"] ?></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#E9E9E9" >
    <td height="25" align="right" class="TitleCaption">ศูนย์การศึกษา </td>
    <td><?= $arr["NAME_SITE"] ?></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td height="25" align="right" class="TitleCaption">สถานะบุคลากร</td>
    <td><?= $arr["NAME_STATUS"] ?></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td height="25" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
</table>
<br />
</body>
</html>