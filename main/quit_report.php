<script language="javascript">
function show_report(type){
	//alert(document.getElementById("edu_year").value);
	if(type == ""){
		alert("กรุณาเลือกประเภทรายงาน");
		return false;
	}
	

	var path = "quit_report"+type+".php";
	window.open(path,"new"+type,"width=1400,height=700,scrollbars=1,resizable=1");
	
	
		
		
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
<tr><td width="164" align="right"> ประเภทรายงาน : </td>
<td width="299" align="left">
<select id="type" name="type" >
<option value="">---------- เลือก ----------</option>
<option value="1">สรุปคนลาออก</option>
<option value="2">สถิติคนลาออก</option>
</select>
</td></tr>


<tr><td align="right">&nbsp;</td>
<td align="left">
<input type="button" value="แสดงรายงาน" onclick="show_report(document.getElementById('type').value)"/></td>
</tr>

</table>
</div>

<div id="report_result" align="center"></div>