<script language="javascript">
function show_report(type){
	if(type == ""){
		alert("กรุณาเลือกประเภทรายงาน");
		return false;
	}
	$("div#report_result").html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 200px' />");
	var data = "type="+type;
	ajaxPostData("quality_report_result.php",data,"text","",show_report_res,"","");
}

function show_report_res(response){
		$("div#report_result").html(response);
}

function show_c_graph1(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph1.php",data,"text","",show_graph1,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph1(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><div align='left' style='padding-left: 40px; color:#333'><b>A</b>=ศ. &nbsp; <b>B</b>=รศ. &nbsp; <b>C</b>=รศ.พิเศษ &nbsp; <b>D</b>=ผศ. &nbsp; <b>E</b>=ผศ.พิเศษ &nbsp; <b>F</b>=อาจารย์</div><img src='quality_c_graph1.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph2(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph2.php",data,"text","",show_graph2,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph2(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><div align='left' style='padding-left: 40px; color:#333'><b>A</b>=ศ. &nbsp; <b>B</b>=รศ. &nbsp; <b>C</b>=รศ.พิเศษ &nbsp; <b>D</b>=ผศ. &nbsp; <b>E</b>=ผศ.พิเศษ &nbsp; <b>F</b>=อาจารย์</div><img src='quality_c_graph2.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph3(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph3.php",data,"text","",show_graph3,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph3(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><img src='quality_c_graph3.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph4(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph4.php",data,"text","",show_graph4,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph4(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><img src='quality_c_graph4.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph5(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph5.php",data,"text","",show_graph5,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph5(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><div align='left' style='padding-left: 40px; color:#333'><b>A</b>=ศ. &nbsp; <b>B</b>=รศ. &nbsp; <b>C</b>=รศ.พิเศษ &nbsp; <b>D</b>=ผศ. &nbsp; <b>E</b>=ผศ.พิเศษ &nbsp; <b>F</b>=อาจารย์</div><img src='quality_c_graph5.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph6(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph6.php",data,"text","",show_graph6,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph6(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><div align='left' style='padding-left: 40px; color:#333'><b>A</b>=ศ. &nbsp; <b>B</b>=รศ. &nbsp; <b>C</b>=รศ.พิเศษ &nbsp; <b>D</b>=ผศ. &nbsp; <b>E</b>=ผศ.พิเศษ &nbsp; <b>F</b>=อาจารย์</div><img src='quality_c_graph6.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph7(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph7.php",data,"text","",show_graph7,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph7(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><img src='quality_c_graph7.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function show_c_graph8(type){
	if(type != '0'){
	$("div#circle_graph").html("<br /><br /><img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 100px' />");
	var data = "type="+type;
	ajaxPostData("_c_graph8.php",data,"text","",show_graph8,type,"");
	}else{
		$("div#circle_graph").html("");
	}
}

function show_graph8(response,type){
	if(response != 0){
		$("div#circle_graph").html("<br /><br /><img src='quality_c_graph8.php?type="+type+"&t=<?=time()?>'  />");
	}else{
		$("div#circle_graph").html("<h2 style='padding-top: 100px; padding-left:120px; color:red' align='left'>ไม่มีข้อมูล</h2>");
	}
	
}

function expandSELECT(sel) {
sel.style.width = '';
}

function contractSELECT(sel) {
sel.style.width = '100px';
}
</script>
<style>
select.limited-width {
    width: 200px;
    position: relative;
}

select.expanded-width {
    width: auto;
    position: relative;

}
</style>
<br />
<div align="center" >ประเภทรายงาน : 
<select id="type" name="type" class="limited-width"  onMouseDown="if(document.all) this.className='expanded-width';" onBlur="if(document.all) this.className='limited-width';" onChange="if(document.all) this.className='limited-width';" onclick="document.getElementById('report_result').innerHTML = '';">
<option value="" >---------- เลือก ----------</option>
<option value="1">สัดส่วนอาจารย์จำแนกตามตำแหน่ง แยกตามหน่วยงาน</option>
<option value="2">สัดส่วนอาจารย์จำแนกตามตำแหน่ง แยกตามประเภท</option>
<option value="3">สัดส่วนอาจารย์จำแนกตามวุฒิการศึกษา แยกตามหน่วยงาน</option>
<option value="4">สัดส่วนอาจารย์จำแนกตามวุฒิการศึกษา แยกตามประเภท</option>
<option value="5">สัดส่วนอาจารย์ต่างชาติ</option>
<option value="6">กราฟวงกลมจำแนกตามตำแหน่ง แยกตามหน่วยงาน </option>
<option value="7">กราฟวงกลมจำแนกตามตำแหน่ง แยกตามประเภท </option>
<option value="8">กราฟวงกลมจำแนกตามวุฒิการศึกษา แยกตามหน่วยงาน</option>
<option value="9">กราฟวงกลมจำแนกตามวุฒิการศึกษา แยกตามประเภท</option>
<option value="10">กราฟแท่งจำแนกตามตำแหน่ง แยกตามหน่วยงาน </option>
<option value="11">กราฟแท่งจำแนกตามตำแหน่ง แยกตามประเภท </option>
<option value="12">กราฟแท่งจำแนกตามวุฒิการศึกษา แยกตามหน่วยงาน</option>
<option value="13">กราฟแท่งจำแนกตามวุฒิการศึกษา แยกตามประเภท</option>
</select>
&nbsp; 

<input type="button" value="แสดงรายงาน" onclick="show_report(document.getElementById('type').value)"/>
</div><br />
<div id="report_result" align="center"></div>