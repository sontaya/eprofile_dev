<?php
session_start();
//print_r($_SESSION);
?>
<style type="text/css">
	table.pg td {
		border: 1px solid #999;
	}
	table.pg {
		border: 1px solid #000;
	}
	table.pg tr.hd {
		font-weight:bold;
		background-color:#F39;
	}
	table.pg tr.ld:hover {
		background-color:#FF9;
	}
</style>
<script type="text/javascript">
	/*function jj(trans_id) {
		window.open('_pop_salary.php?trans_id='+trans_id+'&rnd='+ Math.floor(Math.random()*10000000),'_blank','menubar=0,location=0,width=500,height=400');
	}*/

	
	function p() {
		var from1 = $('#from1').val();
		var from2 = $('#from2').val();
		var from3 = $('#from3').val();
		
		var bg1 = $('#bg1').val();
		var bg2 = $('#bg2').val();
		var bg3 = $('#bg3').val();
		
		var ud = $('#ud').val();
		var bg1_unit = $('#bg1_unit').val();
		var bg2_unit = $('#bg2_unit').val();
		var bg3_unit = $('#bg3_unit').val();
		
		var txtAlert = "";
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
			aj(from1,from2,from3,bg1,bg2,bg3,bg1_unit,bg2_unit,bg3_unit,ud);
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


function aj(from1,from2,from3,bg1,bg2,bg3,bg1_unit,bg2_unit,bg3_unit,ud) {
	//alert(bg1+'\n'+bg2+'\n'+bg3+'\n'+bg1_unit+'\n'+bg2_unit+'\n'+bg3_unit+'\n'+ud);
	$.ajax({
				type: 'POST',
				url: 'salary2.php',
				data: {	
				from1: from1,
				from2: from2,
				from3: from3,
				bg1: bg1,
				bg2: bg2,
				bg3: bg3,
				bg1_unit: bg1_unit,
				bg2_unit: bg2_unit,
				bg3_unit: bg3_unit,
				ud: ud
				},
				success: function(data) {
					//alert('เสร็จแล้วเด้อ');
					change_data('salary1.php','../images/head2/work_data/salary.png');
					
				},
				beforeSend: function() {
					$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
				}
			});
}

function di(id) {
	
	window.open("salary_popup.php?id="+id,"salary","width=550,height=300,resizable=1");

}


</script>

<div style="margin-left: 28px;" align="left">
  <?php
 	$emp_id = $_SESSION['EMP_ID'];
	include("../includes/connect.php");
	/*
	$sql = "SELECT EMP_ID, BIO_FNAME_TH, BIO_LNAME_TH, EMP_ID ";
	$sql .= "FROM biodata_tab ";
	$sql .= "ORDER BY BIO_ID_DATE_BEGIN ";
	$result = mysql_query($sql);
	while($rc = mysql_fetch_assoc($result)) {*/
	
	$sql = "SELECT REF, EMP_ID, ROUND(SALARY1,2) AS SALARY1, ROUND(SALARY2,2) SALARY2, ROUND(SALARY3,2) AS SALARY3, LAST_UPDATE,ROUND((SALARY1+SALARY2+SALARY3),2) AS TOTAL ";
	$sql .= "FROM ".TB_REF_SALARY_STEP." ";
	$sql .= "WHERE EMP_ID = '{$emp_id}' ORDER BY REF ASC";
	echo $sql;
	
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$nrow = $db->count_row(TB_REF_SALARY_STEP," WHERE   EMP_ID = '{$emp_id}' ",$conn);
	//$nrow = mysql_num_rows($result);
	
?>
<!--  <h3>ข้อมูลเงินเดือน</h3>-->
  <table width="600" border="0" bgcolor="#e9e9e9">
    <tr class="text_th">
      <td width="46" align="center">ลำดับ</td>
      <td width="93" align="center" class="text_tr">งบ 1</td>
      <td width="91" align="center" class="text_tr">งบ 2</td>
      <td width="87" align="center" class="text_tr">งบ 3</td>
      <td width="89" align="center" class="text_tr">รวม</td>
      <td width="122" align="center" class="text_tr">วันที่ </td>
      <td width="42" align="center" class="text_tr">แก้ไข</td>
    </tr>
    <?php
  	if($nrow == 0) {
  ?>
    <tr>
      <td align="center" colspan="7"> - ยังไม่มีข้อมูลเงินเดือน - </td>
    </tr>
    <?php
	}
	else {
		$rn = 1;
		while($rc = oci_fetch_array($stid, OCI_BOTH)) {
  ?>
    <tr class="ld">
      <td align="center" class="text_td" style="padding-right:5px"><?php echo $rn; $rn++;?><span id="edref_<?php echo $rc['REF'];?>" style="display:none;"><?php echo $rc['REF'];?></span></td>
      <td align="right" class="text_td" style="padding-right:5px"><span id="b1_<?php echo $rc['REF'];?>"><?php echo number_format($rc['SALARY1'],2);?></span></td>
      <td align="right" class="text_td" style="padding-right:5px"><span id="b2_<?php echo $rc['REF'];?>"><?php echo number_format($rc['SALARY2'],2);?></span></td>
      <td align="right" class="text_td" style="padding-right:5px"><span id="b3_<?php echo $rc['REF'];?>"><?php echo number_format($rc['SALARY3'],2);?></span></td>
      <td align="right" class="text_td" style="padding-right:5px"><?php echo number_format($rc['TOTAL'],2);?></td>
      <td align="center" class="text_td" style="padding-right:5px"><span id="u_<?php echo $rc['REF'];?>"><?php echo thDateFormat($rc['LAST_UPDATE']);?></span></td>
      <td align="center" class="text_td" style="padding-right:5px"><img src="../images/b_edit.png" width="15" height="15" style="cursor: pointer;" onclick="di(<?php echo $rc['REF'];?>)" /></td>
    </tr>
    <?php
		} // while
	} // else
	
$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
//$res_budget = $db->select_query($sql_budget);
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
  </table>
  <h3>การปรับเงินเดือน</h3>
  <table width="559" border="0" align="left">
    <tr>
      <td width="153" align="right">ส่วนแรก :ใช้งบประมาณ </td>
      <td width="130" align="left"><select id="from1" name="from1" style="width: 130px">
        <?=$option[1]?>
      </select></td>
      <td width="144"><input type="text" name="bg1" id="bg1" class="input_text" /></td>
      <td width="114" align="left"><select name="bg1_unit" id="bg1_unit">
          <?php if($nrow != 0) { ?><option value="1">เปอร์เซ็นต์ (%)</option> <?php } ?>
          <option value="2">บาท</option>
        </select></td>
    </tr>
    <tr>
      <td align="right">ส่วนที่สอง :ใช้งบประมาณ</td>
      <td align="left"><select id="from2" name="from2" style="width: 130px">
        <?=$option[2]?>
      </select></td>
      <td><input type="text" name="bg2" id="bg2" class="input_text"/></td>
      <td align="left"><select name="bg2_unit" id="bg2_unit">
          <?php if($nrow != 0) { ?><option value="1">เปอร์เซ็นต์ (%)</option> <?php } ?>
          <option value="2">บาท</option>
        </select></td>
    </tr>
    <tr>
      <td align="right"><span class="form_text">ส่วนที่สาม :ใช้งบประมาณ</span></td>
      <td align="left"><select id="from3" name="from3" style="width: 130px">
        <?=$option[3]?>
      </select></td>
      <td><input type="text" name="bg3" id="bg3" class="input_text"/></td>
      <td align="left"><select name="bg3_unit" id="bg3_unit">
          <?php if($nrow != 0) { ?><option value="1">เปอร์เซ็นต์ (%)</option> <?php } ?>
          <option value="2">บาท</option>
        </select></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input type="text" name="ud" id="ud" class="input_text" /></td>
      <td align="left"><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ud','YYYY-MM-DD')"  style="cursor:pointer"/></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><button name="bg_add" id="bg_add" onclick="p()">ตกลง</button></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="53" colspan="2">&nbsp;</td>
      <td align="left" valign="middle"><span id="waiting"></span></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="ed" style="display:none;">
<input type="hidden" name="ref" id="ref" />
	<table width="322" border="0" class="pg">
  <tr>
    <td width="59">งบ 1</td>
    <td width="531"><input type="text" name="ed_bg1" id="ed_bg1" /> บาท</td>
  </tr>
  <tr>
    <td>งบ 2</td>
    <td><input type="text" name="ed_bg2" id="ed_bg2" /> บาท</td>
  </tr>
  <tr>
    <td>งบ 3</td>
    <td><input type="text" name="ed_bg3" id="ed_bg3" /> บาท</td>
  </tr>
  <tr>
    <td>วันที่ </td>
    <td><input type="text" name="ed_ud" id="ed_ud" /> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ed_ud','YYYY-MM-DD')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><button onclick="edit_bg()">แก้ไข</button> <button onclick="delete_bg()">ลบข้อมูลรายการนี้</button></td>
  </tr>
</table>

</div>
<?php
	function thDateFormat($dbFormat) {
		// 2010-05-23
		$d = explode("-",$dbFormat);
		$year = $d[0] + 543;
		$thFormat = $d[2] . "/" . $d[1] . "/" . $year;
		return $thFormat;
	}
	$db->closedb($conn);
?>