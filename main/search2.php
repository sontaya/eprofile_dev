<?php
@session_start();
require_once("../includes/connect2.php");
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<script type="text/javascript" language="javascript">
function check_data(){
	document.getElementById("search_res").innerHTML = "";
	var myform = document.getElementById("search");
	var name =  myform.name.value;
	var lastname =  myform.lastname.value;
	var emp_id =  myform.emp_id.value;
	var person_id =  myform.person_id.value;
	var emp_type = myform.emp_type.value;
	
	name = name.replace(/ /g, "");
	lastname = lastname.replace(/ /g, "");
	emp_id = emp_id.replace(/ /g, "");
	person_id = person_id.replace(/ /g, "");

	if(name == "" && lastname == "" && emp_id == "" && person_id == ""){
		alert("กรุณากรอกข้อมูลอย่างใดอย่างหนึ่ง");	
		myform.reset();
		return false;
	}
	
	var data = "";
	data += "name="+myform.name.value;
	data += "&lastname="+myform.lastname.value;
	data += "&emp_id="+myform.emp_id.value;
	data += "&person_id="+myform.person_id.value;
	data += "&emp_type="+myform.emp_type.value;
	ajaxPostData("search_return.php",data,"text","search_res",result_search,"","");
}

function result_search(response){
	if(response == "0"){
		document.getElementById("search_res").innerHTML = "<div style='color:red;'><h2>- ไม่มีข้อมูล -</h2></div>";
	}else{
		document.getElementById("search_res").innerHTML = response;
	}
}

function edit_(emp_id){
	var data = "emp_id="+emp_id;
	ajaxPostData("change_session.php",data,"text","",result_edit,"","");
}

function result_edit(response){
	if(response == 1){
		window.location ="../main/";
	}
}

/*$(function() {
		  $("#ca_province").autocomplete({
			source: provinceTags
		});
		$("#ca_amphur").autocomplete({
			source: amphurTags
		});
		   
		   
		   $('#Save_success').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#Save_error').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#Error_upload').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
 });*/
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td valign="top">
    <form id="search" name="search" method="post"   >
    <table width="762" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="256" align="right" class="form_text">ชื่อ : </td>
        <td width="478" align="left"><input type="text" name="name" id="name" style="width: 150px; " class="input_text"/></td>
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
       <tr>
        <td align="right" class="form_text">ประเภทบุคลากร  :</td>
        <td align="left">
        <select name="emp_type" id="emp_type">
        <option value="">ทุกประเภท</option>
        <?php
			$sql = "SELECT STAFFTYPE_ID, STAFFTYPE_NAME ";
			$sql .= "FROM ".TB_REF_STAFFTYPE." ";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rc = oci_fetch_array($stdt)) {
		?>
        <option value="<?php echo $rc['STAFFTYPE_ID']; ?>"><?php echo $rc['STAFFTYPE_NAME']; ?></option>
        <?php
			}
		?>
        </select>
        
        </td>
      </tr>
    <!--  <tr>
        <td align="right" class="form_text">สังกัด/หน่วยงาน :</td>
        <td align="left"><input type="text" name="jnc_depart" id="jnc_depart" style="width: 300px; " class="input_text" /></td>
      </tr>-->
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left"><input type="button" value="&nbsp;&nbsp;ค้นหา&nbsp;&nbsp;" onClick="check_data()"/></td>
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