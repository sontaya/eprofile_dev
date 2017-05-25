<script language="javascript">
function show_report(date1,date2,train_type){
	if(date1 == "" || date2 == ""){
		alert("กรุณากรอกวันที่");
		return false;
	}
	var path = "dev_report_result.php";
		window.open(path+"?date1="+date1+"&date2="+date2+"&train_type="+train_type,"dev","width=1600,height=700,scrollbars=1,resizable=1");
		
		/*$("div#report_result").html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 200px' />");
		var data = "type="+type;
		ajaxPostData("scholar_report_result.php",data,"text","",show_report_res,"","");*/
}

function show_report_res(response){
		$("div#report_result").html(response);
}
</script>
<br />
<div align="center">
<table width="627" border="0" cellpadding="3">
<tr><td width="227" align="right"><div>ประเภท : </div></td>
<td width="382" align="left"><div>
<select id="train_type" name="train_type" >
<option value="1">อบรม สัมมนา</option>
<option value="2">วิทยากร อาจารย์พิเศษ</option>
<option value="3">ที่ปรึกษา</option>
<option value="4">กรรมการภายนอก</option>
</select>

</div></td></tr>
<tr>
<tr><td width="227" align="right"><div>ข้อมูลระหว่างวันที่ : </div></td>
<td width="382" align="left"><div><input type="text" id="begin_date" name="begin_date"  style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('begin_date','YYYY-MM-DD')"  style="cursor:pointer"/> ถึง <input type="text" id="end_date" name="end_date"  style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_date','YYYY-MM-DD')"  style="cursor:pointer"/></div></td></tr>
<tr><td align="right">&nbsp;</td>
<td align="left">
<input type="button" value="แสดงรายงาน" onclick="show_report(document.getElementById('begin_date').value,document.getElementById('end_date').value,document.getElementById('train_type').value)"/></td>
</tr>
</table>
</div>

<div id="report_result" align="center"></div>