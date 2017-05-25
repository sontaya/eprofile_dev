<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<script type="text/javascript" language="javascript">

function checkAll()
{
	var form = document.getElementById('person_salary');
	if(document.person_salary.CheckAll.checked){
		for (i = 0; i < form.elements.length; i++){
			form.elements[i].checked = true ;
		}
	}else{
		for (i = 0; i < form.elements.length; i++){
			form.elements[i].checked = false ;
		}
	}
}


	function p() {
		
	var aa= document.getElementById('person_salary');
	var checks = "0";
	var emp_id = new Array();
	var n = 0;
	for (var i =0; i < aa.elements.length; i++) 
	{
		if(aa.elements[i].checked){  
		checks = "1";
		emp_id[n] = aa.elements[i].value;
		n++;
		}
	}
/*	
	for(var j=0;j<emp_id.length;j++){
		alert(emp_id[j]);
	}*/
	
	//alert(checks);
	if(checks == "0"){
		alert("ท่านยังไม่ได้เลือกบุคคลที่จะปรับขึ้นเงินเดือน");
		return false;
	}
		
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
			aj(from1,from2,from3,bg1,bg2,bg3,bg1_unit,bg2_unit,bg3_unit,ud,emp_id);
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


function aj(from1,from2,from3,bg1,bg2,bg3,bg1_unit,bg2_unit,bg3_unit,ud,emp_id) {
	
	$.ajax({
				type: 'POST',
				url: 'salary2.php',
				data: {	
				emp_id:emp_id,
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
					//alert(data);
					//change_data('salary1.php','../images/head2/work_data/salary.png');
					check_data();
				},
				beforeSend: function() {
					$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
				}
			});
}

function di(id) {
	
	window.open("salary_popup.php?id="+id,"salary","width=550,height=300,resizable=1");

}
function salary_history(emp_id){
	window.open("salary_history.php?emp_id="+emp_id,"salary","width=1150,height=400,resizable=1,scrollbars=1");
}

function check_data(){
	document.getElementById("search_res").innerHTML = "";
	var myform = document.getElementById("search");
	if(myform.search_type.value == "1"){
		if(myform.name.value == "" && myform.lastname.value == "" && myform.emp_id.value == "" && myform.person_id.value == ""){
			alert("กรุณากรอกข้อมูลอย่างใดอย่างหนึ่ง");	
			return false;
		}
	}else if(myform.search_type.value == "2"){
		if(myform.depart.value == "0" ){
			alert("กรุณาเลือกสังกัด/หน่วยงาน");
			return false;
		}
	}
	
	var data = "";
	data += "name="+myform.name.value;
	data += "&lastname="+myform.lastname.value;
	data += "&emp_id="+myform.emp_id.value;
	data += "&person_id="+myform.person_id.value;
	data += "&depart="+myform.depart.value;
	ajaxPostData("search_salary_return.php",data,"text","search_res",result_search,"","");
}

function result_search(response){
	if(response == "0"){
		document.getElementById("search_res").innerHTML = "<div style='color:red;'><h2>- ไม่มีข้อมูล -</h2></div>";
	}else{
		document.getElementById("search_res").innerHTML = response;
	}
}

$(function() {
	$('#search_type').change(function() {
			document.getElementById("search_res").innerHTML = "";
			var myform = document.getElementById("search");
			myform.name.value = "";
			myform.lastname.value = "";
			myform.emp_id.value = "";
			myform.person_id.value = "";
			myform.depart.value = "0";
			if(this.value == "1"){	
				$('#departs').hide();
				$('#person').show();
			}else{
				 $('#person').hide();
				  $('#departs').show();
			}
			
	});
});


</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td valign="top">
    <form id="search" name="search" method="post"   >
    <table width="762" border="0" cellspacing="4" cellpadding="4" >
      <tr>
        <td width="318" align="right" class="form_text">ค้นหาจาก : </td>
        <td width="416" align="left"><select id="search_type" name="search_type">
    <option value="1">รายบุคคล</option>
    <option value="2">สังกัด/หน่วยงาน</option>
    </select></td>
      </tr>
      </table>
      <table width="762" border="0" cellspacing="4" cellpadding="4" id="person" >
      <tr>
        <td  align="right" class="form_text" width="318">ชื่อ : </td>
        <td  align="left"><input type="text" name="name" id="name" style="width: 150px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">นามสกุล :</td>
        <td align="left"><input type="text" name="lastname" id="lastname" style="width: 150px; " class="input_text" /></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เลขบัตรบุคลากร  :</td>
        <td align="left"><input type="text" name="emp_id" id="emp_id" style="width: 150px; " class="input_text" /></td>
      </tr>
       <tr>
        <td align="right" class="form_text">เลขประจำตัวประชาชน  :</td>
        <td align="left"><input type="text" name="person_id" id="person_id" style="width: 150px; " class="input_text" maxlength="13" /></td>
      </tr>
      </table>
      <table width="762" border="0" cellspacing="4" cellpadding="4"  id="departs" style="display:none">
       <tr >
        <td  align="right" class="form_text" width="318">สังกัด/หน่วยงาน : </td>
        <td  align="left">
        <?
require_once("../includes/connect.php");
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
echo "<select id='depart' name='depart' >\n";
echo "<option value='0'>---เลือก---</option>\n";
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	echo "<option value='".$row["CODE_FACULTY"]."'>".$row["NAME_FACULTY"]."</option>\n";
}
echo "</select>\n";
$db->closedb($conn);	
        ?>
        </td>
      </tr>
      </table>
      <table width="762" border="0" cellspacing="4" cellpadding="4" >
      <tr>
        <td align="right" width="318">&nbsp;</td>
        <td align="left" ><input type="button" value="&nbsp;&nbsp;ค้นหา&nbsp;&nbsp;" onClick="check_data()"/></td>
      </tr>
       
       <tr>
        <td colspan="2" align="left"  valign="top" style="padding-left:10px; color:#06C;"></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  
</table>
<div id="search_res" align="center"></div>
  </td>
  </tr>  
</table>