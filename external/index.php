<? 
//	error_reporting(E_ALL);
//	ini_set("display_errors",1);
	require_once("config.inc.php");
	
	
	function SwapRowColor($ColorSet,$irow){
		
		if($ColorSet == '1'){
			$config["row_bg"] = "#EBEBEB";
			$config["row_over_bg"] = "#FFFFCC";
			$config["row_bg2"] = "#FFFFFF";
			$config["row_over_bg2"] = "#FFFFCC";				
		}
		
		if(($irow%2)==0){
			$tstyle = "bgcolor='".$config["row_bg"]."' onMouseOver=this.style.backgroundColor='".$config["row_over_bg"]."' onMouseOut=this.style.backgroundColor=''";
		}else{
			$tstyle = "bgcolor='".$config["row_bg2"]."' onMouseOver=this.style.backgroundColor='".$config["row_over_bg2"]."' onMouseOut=this.style.backgroundColor=''";			
		}
		return $tstyle;
	}
	
	
	if($_POST["chkVal"] == "1"){
			$s = trim($_POST["keyword"]);
			$keyword = " AND (FIRST_NAME_THA LIKE '%".$s."%' OR LAST_NAME_THA LIKE '%".$s."%' 
								OR FIRST_NAME_ENG LIKE '%".$s."%' OR LAST_NAME_ENG LIKE '%".$s."%' OR CODE_PERSON LIKE '%".$s."%' )";
			
			if($_POST["emp_faculty"] <> "00"){
				$keyfac = " AND CODE_FACULTY = '".$_POST["emp_faculty"]."'";
			}else{
				$keyfac = "";	
			}
			if($_POST["emp_type"] <> "00"){
				$keytype = " AND STAFF_TYPE = '".$_POST["emp_type"]."'";
			}else{ 
				$keytype = "";
			}
			
			if($_POST["staff_status"] <> "00"){
				$keystatus = " AND CODE_STATUS = '".$_POST["staff_status"]."'";
			}else{ 
				$keystatus = "";
			}
			
			$sql_search = "SELECT CODE_PERSON,CITIZEN_CODE, 
								NAME_PRENAME_THA||FIRST_NAME_THA||'  '||LAST_NAME_THA AS FULLNAME_THA,
								NAME_PRENAME_ENG||FIRST_NAME_ENG||'  '||LAST_NAME_ENG AS FULLNAME_ENG,
								STAFF_TYPE, STAFF_TYPE_NAME, CODE_FACULTY, NAME_FACULTY,
								CODE_DEPARTMENT, NAME_DEPARTMENT, CODE_SITE, NAME_SITE, 
								BIRTH_DATE, TO_CHAR(BIRTH_DATE,'dd/mm/')||TO_CHAR(TO_NUMBER(TO_CHAR(BIRTH_DATE,'yyyy'))+543) AS BIRTH_DATE_THA, 
								START_WORK_DATE, TO_CHAR(START_WORK_DATE,'dd/mm/')||TO_CHAR(TO_NUMBER(TO_CHAR(START_WORK_DATE,'yyyy'))+543) AS START_WORK_DATE_THA,
								CODE_STATUS, NAME_STATUS
							FROM SDU_GENERAL_PROFILE 
							WHERE 1=1 $keyword $keyfac $keytype $keystatus";
							
			
					
			$res = oci_parse($conn,$sql_search);
			oci_execute($res);			
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>External Search</title>
<style type="text/css">
	table {
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 11px;
		color: #4F4F4F;
	}

.TableHeader{
	line-height: 25px;
	font-weight: bold;
	color: #333;
	background-color: #B2B2B2;		
}

.Box_Gray_Dash{
	border: 1px dashed #CCC;
	padding: 1px;
}

</style>
</head>

<body>
<form id="search" name="search" method="post"   >
  <table width="95%" align="center" cellpadding="0" class="Box_Gray_Dash">
    <tr>
      <td colspan="2" align="left" class="TableHeader">เงื่อนไขในการค้นหา ::</td>
    </tr>
    <tr>
      <td width="169" align="right" class="form_text">รหัส / ชื่อ / นามสกุล : </td>
      <td width="807" align="left"><input type="text" name="keyword" id="keyword" style="width: 250px; " value="<?= $_POST["keyword"] ?>" /></td>
    </tr>
    <tr>
      <td align="right" class="form_text">ประเภทบุคลากร  :</td>
      <td align="left"><select name="emp_type" id="emp_type">
        <option value="00" <? if($_POST["emp_type"] == "00"){echo "selected='selected'";} ?>  >ทุกประเภท</option>
        <?php
			$sql = "SELECT STAFFTYPE_ID, STAFFTYPE_NAME ";
			$sql .= "FROM SDU_REF_STAFFTYPE";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rc = oci_fetch_array($stdt)) {
		?>
        <option value="<?php echo $rc['STAFFTYPE_ID']; ?>" <? if($_POST["emp_type"] == $rc['STAFFTYPE_ID']){echo "selected='selected'";} ?>><?php echo $rc['STAFFTYPE_NAME']; ?></option>
        <?php
			}
		?>
      </select></td>
    </tr>
    <!--  <tr>
        <td align="right" class="form_text">สังกัด/หน่วยงาน :</td>
        <td align="left"><input type="text" name="jnc_depart" id="jnc_depart" style="width: 300px; " class="input_text" /></td>
      </tr>-->
    <tr>
      <td align="right" >สังกัดคณะ :</td>
      <td align="left">
      <select name="emp_faculty" id="emp_faculty" <? if($_POST["emp_faculty"] == "00"){echo "selected='selected'";} ?>>
        <option value="00">ทุกประเภท</option>
        <?php
			$sql = "SELECT * FROM SDU_REF_DEPARTMENT";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
		?>
        <option value="<?php echo $rdep['CODE_FACULTY']; ?>" <? if($_POST["emp_faculty"] == $rdep['CODE_FACULTY']){echo "selected='selected'";} ?>><?php echo $rdep['NAME_FACULTY']; ?></option>
        <?php
			}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" >สถานะบุคลากร :</td>
      <td align="left">
      <select name="staff_status" id="staff_status" <? if($_POST["staff_status"] == "00"){echo "selected='selected'";} ?>>
        <option value="00">ทุกประเภท</option>
        <?php
			$sql = "SELECT * FROM SDU_REF_STATUS_EXT";
			$ss = oci_parse($conn,$sql);
			oci_execute($ss);
			while($arr_ss = oci_fetch_array($ss)) {
		?>
        <option value="<?php echo $arr_ss['STATUS_ID']; ?>" <? if($_POST["staff_status"] == $arr_ss['STATUS_ID']){echo "selected='selected'";} ?>><?php echo $arr_ss['STATUS_NAME']; ?></option>
        <?php
			}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="right" >&nbsp;</td>
      <td align="left"><input name="Submit" type="submit" value="  ค้นหา  "/>
      <input name="chkVal" type="hidden" id="chkVal" value="1" /></td>
    </tr>
    <tr>
      <td colspan="2" align="left"  valign="top" style="padding-left:10px; color:#06C;"></td>
    </tr>
  </table>
</form>
<br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="TableHeader">
        <td width="88" height="25" align="center">รหัสบุคลากร</td>
        <td width="198" align="center">ชื่อ-นามสกุล</td>
        <td width="145" align="center">ประเภทบุคลากร</td>
        <td width="246" align="center">สังกัดคณะ/สำนัก</td>
        <td width="219" align="center">สังกัดย่อย/หน่วยงาน</td>
        <td width="126" align="center">สังกัดศูนย์</td>
        <td width="89" align="center">สถานะ</td>
        <td width="46" align="center">&nbsp;</td>
  </tr>
  <? 	$irow == 1;
  	while($arr = oci_fetch_array($res)) {
		$irow++;
  ?>
  <tr <?= SwapRowColor('1',$irow) ?>>
            <td height="25" align="center">&nbsp;<?= $arr["CODE_PERSON"] ?></td>
            <td><?= $arr["FULLNAME_THA"] ?></td>
            <td><?= $arr["STAFF_TYPE_NAME"] ?></td>
            <td><?= $arr["NAME_FACULTY"] ?></td>
            <td><?= $arr["NAME_DEPARTMENT"] ?></td>
            <td><?= $arr["NAME_SITE"] ?></td>
            <td><?= $arr["NAME_STATUS"] ?></td>
            <td align="center"><a href="view.php?id=<?= $arr["CODE_PERSON"] ?>" target="_blank"><img src="zoom_icon.png" width="25" height="17" /></a></td>
  </tr>
  <? } ?>
</table>
<br />
</body>
</html>