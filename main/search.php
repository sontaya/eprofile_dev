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
    var jnc_depart = myform.jnc_depart.value;
    var jnc_depart_sub = myform.jnc_depart_sub.value;
    var cwk_status = myform.cwk_status.value;
	
	name = name.replace(/ /g, "");
	lastname = lastname.replace(/ /g, "");
	emp_id = emp_id.replace(/ /g, "");
	person_id = person_id.replace(/ /g, "");
    jnc_depart = jnc_depart.replace(/ /g, "");
    jnc_depart_sub = jnc_depart_sub.replace(/ /g, "");
    cwk_status = cwk_status.replace(/ /g, "");

	//if(name == "" && lastname == "" && emp_id == "" && person_id == "" && emp_type == "" && jnc_depart == "" && jnc_depart_sub ==""){
		//alert("กรุณากรอกข้อมูลอย่างใดอย่างหนึ่ง");	
		//myform.reset();
		//return false;
	//}
	
	var data = "";
	data += "name="+myform.name.value;
	data += "&lastname="+myform.lastname.value;
	data += "&emp_id="+myform.emp_id.value;
	data += "&person_id="+myform.person_id.value;
	data += "&emp_type="+myform.emp_type.value;
    data += "&jnc_depart="+myform.jnc_depart.value;
    data += "&jnc_depart_sub="+myform.jnc_depart_sub.value;
    data += "&cwk_status="+myform.cwk_status.value;
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
      <tr>
        <td align="right" class="form_text">หน่วยงานหลัก :</td>
        <td align="left">
            <select name="jnc_depart" id="jnc_depart">
                <option value="">-----------เลือก---------------</option>
            <?
            $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." ";
            $stid_ref_department = oci_parse($conn, $sql_ref_department);
            oci_execute($stid_ref_department);
            while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){ ?>
                <option value="<?=$row_ref_department["CODE_FACULTY"]  ?>"><?= $row_ref_department["NAME_FACULTY"] ?></option>
           <? } ?>
            </select>
      </tr>
        <tr>
        <td align="right" class="form_text">หน่วยงานย่อย :</td>
        <td align="left">
            <select name="jnc_depart_sub" id="jnc_depart_sub">
                 <option value="">-----------เลือก---------------</option>
            <?
            $sql_ref_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." ";
            $stid_ref_sub = oci_parse($conn, $sql_ref_sub);
            oci_execute($stid_ref_sub);
            while(($row_ref_sub = oci_fetch_array($stid_ref_sub, OCI_BOTH))){ ?>
                <option value="<?=$row_ref_sub["CODE_DEPARTMENT_SECTION"]  ?>"><?= $row_ref_sub["NAME_DEPARTMENT_SECTION"] ?></option>
           <? } ?>
            </select>
      </tr>
        <tr>
        <td height="30" align="right" class="form_text">สถานะปัจจุบัน :</td>
        <td align="left">
        <select  id="cwk_status" name="cwk_status" class="widthFix2" onchange="quit(this.value);">
        <option value="">-- เลือกทั้งหมด --</option>
        <option value="01" <? if($row["CWK_STATUS"] == "01"){echo "selected='selected'";}?>>ปฏิบัติการ</option>
        <option value="02" <? if($row["CWK_STATUS"] == "02"){echo "selected='selected'";}?>>ลาออก</option>
        <option value="03" <? if($row["CWK_STATUS"] == "03"){echo "selected='selected'";}?>>ลาศึกษาต่อ</option>
        <option value="04" <? if($row["CWK_STATUS"] == "04"){echo "selected='selected'";}?>>เกษียนอายุ</option>
        <option value="05" <? if($row["CWK_STATUS"] == "05"){echo "selected='selected'";}?>>ปฏิบัติการตามวาระ</option>
        <option value="07" <? if($row["CWK_STATUS"] == "07"){echo "selected='selected'";}?>>เสียชีวิต</option>
        <option value="08" <? if($row["CWK_STATUS"] == "08"){echo "selected='selected'";}?>>ไม่ใช้งานแล้ว</option>
        </select>
        </td>
      </tr>
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