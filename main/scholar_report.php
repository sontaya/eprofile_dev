<script language="javascript">
function show_report(type,date1,date2,department,edu_level,edu_year){
	//alert(document.getElementById("edu_year").value);
	if(type == ""){
		alert("กรุณาเลือกประเภทรายงาน");
		return false;
	}
	
	if(type == "1" || type == "2" || type == "3" || type == "4" ){
		
		if(date1 == "" || date2 == ""){
			alert("กรุณากรอกวันที่");
			return false;
		}
	var path = "scholar_report_result"+type+".php";
	window.open(path+"?date1="+date1+"&date2="+date2,"scholar"+type,"width=1400,height=700,scrollbars=1,resizable=1");
	}else{
		var path = "scholar_report_result"+type+".php";
	window.open(path+"?department="+department+"&edu_level="+edu_level+"&year="+edu_year,"scholar"+type,"width=1400,height=700,scrollbars=1,resizable=1");
		
	}
	
		
		
		/*$("div#report_result").html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 200px' />");
		var data = "type="+type;
		ajaxPostData("scholar_report_result.php",data,"text","",show_report_res,"","");*/
	
}

function other(type){
	if(type == "5"){
		document.getElementById("other").style.display = "block";
		document.getElementById("year").style.display = "none";
		document.getElementById("begin_date").value = "";
		document.getElementById("begin_date").disabled = true;
		document.getElementById("end_date").value = "";
		document.getElementById("end_date").disabled = true;
	}else if(type == "6"){
		document.getElementById("other").style.display = "block";
		document.getElementById("year").style.display = "block";
		document.getElementById("begin_date").value = "";
		document.getElementById("begin_date").disabled = true;
		document.getElementById("end_date").value = "";
		document.getElementById("end_date").disabled = true;
		
	}else{
		document.getElementById("other").style.display = "none";
		document.getElementById("year").style.display = "none";
		document.getElementById("begin_date").disabled = false;
		document.getElementById("end_date").disabled= false;
	}
}

function show_report_res(response){
		$("div#report_result").html(response);
}
</script>
<br />
<div align="center">
<table width="627" border="0" cellpadding="3">
<tr><td width="164" align="right"> ประเภทรายงาน : </td>
<td width="299" align="left">
<select id="type" name="type" onchange="other(this.value)">
<option value="">---------- เลือก ----------</option>
<option value="1">สายวิชาการ คาดว่าจะสำเร็จการศึกษา</option>
<option value="2">สายสนับสนุน  คาดว่าจะสำเร็จการศึกษา</option>
<option value="3">สายวิชาการ สำเร็จการศึกษา</option>
<option value="4">สายสนับสนุน  สำเร็จการศึกษา</option>
<option value="5">บุคลากรศึกษาต่อ</option>
<option value="6">ผู้สำเร็จการศึกษา </option>
</select>
</td></tr>
<tr><td align="right"><div>ระหว่างวันที่ : </div></td>
<td align="left"><div><input type="text" id="begin_date" name="begin_date"  style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('begin_date','YYYY-MM-DD')"  style="cursor:pointer"/> ถึง <input type="text" id="end_date" name="end_date"  style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_date','YYYY-MM-DD')"  style="cursor:pointer"/></div></td></tr>
<tr>
  <td colspan="2" align="left" >
  <div id="other" style="display:none">
  <table align="left" border="0" cellpadding="3" cellspacing="0">
  <tr>
  <td width="214" align="right">คณะ/หน่วยงาน : </td>
<td width="302" align="left">
<?
include("../includes/connect.php");
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC "; 
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value='all'>ทั้งหมด</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
		if($row["CWK_MUA_MAIN"] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
	$db->closedb($conn);
?>
<select name="department" id="department" class="widthFix2" onchange="load_depsub(this.value)">
<?=$option_ref_department?>
</select>    
</td>
</tr>
 <td width="214" align="right">ระดับการศึกษา : </td>
<td width="302" align="left">
<select name="edu_level" id="edu_level">
          <option value="1">ปริญญาโท</option>
          <option value="2">ปริญญาเอก</option>
          <option value="3">ปริญญาโท - ปริญญาเอก</option>
        </select>
</td>
  </table>
  </div>
    <div id="year" style="display:none">
  <table align="left" border="0" cellpadding="3" cellspacing="0">
  <tr>
  <td width="214" align="right">ปีการศึกษา : </td>
<td width="302" align="left">
 <select id="edu_year" name="edu_year">
        <?
        $year = date("Y")+543;
			for($i=0;$i<10;$i++){
			$y= $year-$i;
			echo "<option value='$y'>$y</option>\n";	
		}
		?>
        </select>
</td>
</tr>
</table>
</div>
  </td>
</tr>
<tr><td align="right">&nbsp;</td>
<td align="left">
<input type="button" value="แสดงรายงาน" onclick="show_report(document.getElementById('type').value,document.getElementById('begin_date').value,document.getElementById('end_date').value,document.getElementById('department').value,document.getElementById('edu_level').value,document.getElementById('edu_year').value)"/></td>
</tr>

</table>
</div>

<div id="report_result" align="center"></div>