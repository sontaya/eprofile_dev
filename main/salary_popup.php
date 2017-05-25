<?
include("../includes/connect.php");
$sql = "SELECT REF,SOURCE1,SOURCE2,SOURCE3, EMP_ID, ROUND(SALARY1,2) AS SALARY1, ROUND(SALARY2,2) SALARY2, ROUND(SALARY3,2) AS SALARY3, LAST_UPDATE,ROUND((SALARY1+SALARY2+SALARY3),2) AS TOTAL ";
$sql .= "FROM ".TB_REF_SALARY_STEP." ";
$sql .= "WHERE REF='".$_GET['id']."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_BOTH);

$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
$res_budget = oci_parse($conn, $sql_budget );
oci_execute($res_budget);
$option = array();
for($i=1;$i<4;$i++){
	$option[$i]="<option value=''>เลือก</option>";
}
while($row_budget =  oci_fetch_array($res_budget, OCI_BOTH) ){
	for($i=1;$i<4;$i++){
		if($row["SOURCE{$i}"] == $row_budget["CODE_SALARY_SOURCE"]){ $select="selected = 'selected'";}else{ $select="";}
			$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' $select>".$row_budget["NAME_SALARY_SOURCE"]."</option>\n";

		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขการปรับเงินเดือน</title>
<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<link href="../css/calendar-mos.css" rel="stylesheet" type="text/css"> 
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/calendar.js" type="text/javascript"></script>
<script src="../js/myAjax.js" type="text/javascript"></script>
<script language="javascript">
function edit_bg() {
	var id = <?=$_GET['id']?>;
	var from1 = $('#from1').val();
	var from2 = $('#from2').val();
	var from3 = $('#from3').val();
	
	var bg1 = $('#bg1').val();
	var bg2 = $('#bg2').val();
	var bg3 = $('#bg3').val();
	
	var ud = $('#ud').val();
	var txtAlert = '';
	
		if(bg1 != "" && from1 == "" ){
			txtAlert += "ป้อนข้อมูลงบส่วนแรก\n";
		}
		if(IsNumeric(bg1) == false) {
			txtAlert += "งบ ส่วนแรก ต้องป้อนข้อมูลเป็นตัวเลข\n";
		}
		if(bg2 != "" && from2 == "" ){
			txtAlert += "ป้อนข้อมูลงบส่วนที่สอง\n";
		}
		if(IsNumeric(bg2) == false) {
			txtAlert += "งบ ส่วนที่สอง ต้องป้อนข้อมูลเป้นตัวเลข\n";
		}
		if(bg3 != "" && from3 == "" ){
			txtAlert += "ป้อนข้อมูลงบส่วนที่สาม\n";
		}
		if(IsNumeric(bg3) == false) {
			txtAlert += "งบ ส่วนที่สาม ต้องป้อนข้อมูลเป็นตัวเลข\n";
		}
		if(ud == "") {
			txtAlert += "จำเป็นต้องป้อนข้อมูลวันที่\n";
		}
		if(bg1 == "" && bg2 == "" && bg3 == "") {
			txtAlert += "จำเป็นต้องป้อนตัวเลขในช่องของงบประมาณอย่างน้อย 1 ช่อง\n";
		}
	
	if(txtAlert != "") {
		alert(txtAlert);
	}
	else {			
		edit_b(from1,from2,from3,bg1,bg2,bg3,ud,id);
	}
	
	
}

function edit_b(from1,from2,from3,bg1,bg2,bg3,u,ref) {
	$.ajax({
		type: 'POST',
		url: 'salary_edit.php',
		data: { from1: from1, from2: from2, from3:from3, bg1: bg1, bg2: bg2, bg3:bg3, u: u, ref: ref},
		success: function(data) {
			
			alert("แก้ไขเรียบร้อยแล้ว");
			self.opener.change_data('salary1.php','../images/head2/work_data/salary.png');
			window.close();
			
		},
		brforeSend: function() {
		}
	});
}

function delete_bg() {
	var id = <?=$_GET['id']?>;
	var yn = confirm("ต้องการลบรายการนี้จริงหรือไม่ ?");
	if(yn == true) {
		$.ajax({
			type: 'POST',
			url: 'salary_delete.php',
			data: {ref: id},
			success: function(data) {
			alert("ลบเรียบร้อยแล้ว");
			self.opener.change_data('salary1.php','../images/head2/work_data/salary.png');
			window.close();
			
			},
			beforeSend: function() {
			}
		});
	}
}

	function IsNumeric(sText) {
    	var ValidChars = "0123456789.,";
   		var IsNumber=true;
   		var Char; 
   		for (i = 0; i < sText.length && IsNumber == true; i++)  { 
      		Char = sText.charAt(i); 
      		if (ValidChars.indexOf(Char) == -1) {
         		IsNumber = false;
         	}
      	}
   		return IsNumber;
   }
</script>
</head>

<body>
<h3>ข้อมูลเงินเดือน</h3>
<table width="559" border="0" align="left">
    <tr>
      <td width="153" align="right">ส่วนแรก :ใช้งบประมาณ </td>
      <td width="130" align="left"><select id="from1" name="from1" style="width: 130px">
        <?=$option[1]?>
      </select></td>
      <td width="144"><input type="text" name="bg1" id="bg1" class="input_text" value="<?=number_format($row['SALARY1'],2)?>" /></td>
      <td width="114" align="left">บาท</td>
    </tr>
    <tr>
      <td align="right">ส่วนที่สอง :ใช้งบประมาณ</td>
      <td align="left"><select id="from2" name="from2" style="width: 130px">
        <?=$option[2]?>
      </select></td>
      <td><input type="text" name="bg2" id="bg2" class="input_text" value="<?=number_format($row['SALARY2'],2)?>"/></td>
      <td align="left">บาท</td>
    </tr>
    <tr>
      <td align="right"><span class="form_text">ส่วนที่สาม :ใช้งบประมาณ</span></td>
      <td align="left"><select id="from3" name="from3" style="width: 130px">
        <?=$option[3]?>
      </select></td>
      <td><input type="text" name="bg3" id="bg3" class="input_text" value="<?=number_format($row['SALARY3'],2)?>"/></td>
      <td align="left">บาท</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input type="text" name="ud" id="ud" class="input_text" value="<?=change_date_thai($row['LAST_UPDATE'])?>"/></td>
      <td align="left"><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ud','YYYY-MM-DD')"  style="cursor:pointer"/></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><button name="bg_add" id="bg_add" onclick="edit_bg()">ตกลง</button>&nbsp;<button name="bg_add" id="bg_add" onclick="delete_bg()">ลบ</button></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</body>
</html>
<?
	$db->closedb($conn);
?>