<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<script type="text/javascript">	

	
	function check_data() {
		var contract_no = $('#contract_no').val();  // เลขที่สัญญา
		var contract_period = $('#contract_period').val(); // สัญญาระยะที่
		var contract_year = $('#contract_year').val(); // จำนวนปี
		var contract_position = $('#contract_position').val(); // ตำแหน่งปัจจุบัน
		var contract_start = $('#contract_start').val(); // วันเริ่มสัญญา
		var contract_finish = $('#contract_finish').val(); // วันสิ้นสุดสัญญา
		if(contract_no == "" || contract_period == "" || contract_year == "" || contract_position == "" || contract_start == "") {
			$('#Please_fill_in').dialog('open');
			return false;
		}
		else {
			$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
			document.getElementById("contract").submit();
			//change_data('contract_history.php','../images/head2/work_data2/contract_history.png'); // 2010-10-20
			reload_data_table();
		}
	}
	
	function reload_data_table() {
		$.ajax({
			url: 'contract_data_table.php?k='+Math.random(),
			success: function(data) {
				document.getElementById("contract").reset();
				$('#contract_list').html(data);
			},
			beforeSend: function() {
				$('#contract_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
			}
		});
	}
	
		$(function() {
	
				$('#Please_fill_in').dialog({
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
		
	});
</script>


    <div id="contract_list" align="center" class="data_details_list">
     <? include "contract_data_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('contract','');document.getElementById('contract_no').readOnly = false;" style="cursor:pointer"/><?php } ?></div>
      <div id="data_form" style="display:none;">
<table width="758" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <form id="contract" name="contract" method="post" action="contract_data_save.php" enctype="multipart/form-data" target="upload_target">
    	<input type="hidden" id="number_contact" name="number_contact" />
    <img src="../images/bg_d.png" style="margin-left:16px;" />
    <table width="781" border="0" cellspacing="4" cellpadding="4">
    
      <tr>
        <td align="right" class="form_text" width="200">* ตำแหน่งปัจจุบัน :</td>
        <td align="left">
        	<input type="radio" name="contract_position" value="1" checked="checked"> เจ้าหน้าที่  <input type="radio" name="contract_position" value="2"> อาจารย์  <input type="radio" name="contract_position" value="3"> ผศ. <input type="radio" name="contract_position" value="4"> รศ. <input type="radio" name="contract_position" value="5"> ศ. <input type="radio" name="contract_position" value="6"> ที่ปรึกษา <input type="radio" name="contract_position" value="7"> ครู <input type="radio" name="contract_position" value="8"> ผู้บริหาร
        </td>
      </tr> 
     <tr>
        <td width="200" align="right" class="form_text">* ตําเเหน่งประเภทบุคลากร<!--(สกอ.)--> :</td>
        <td width="600" align="left" colspan="3">
             <?
            $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC ";
            $stid_emp_type = oci_parse($conn, $sql_emp_type );
            oci_execute($stid_emp_type);
            $option_emp_type="<option value=''>เลือก</option>";
            while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
                if($row["CWK_MUA_EMP_TYPE"] == $row_emp_type["STAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
                    $option_emp_type .= "<option value='".$row_emp_type["STAFFTYPE_ID"]."' $select>".$row_emp_type["STAFFTYPE_NAME"]."</option>\n";
            }
            ?>
             <select name="ck_mua_emp_type" id="ck_mua_emp_type" class="widthFix2"  >
            <?=$option_emp_type?>
                    </select>
        </td>
    </tr>
      <tr>
        <td align="right" class="form_text">*สัญญาระยะที่</td>
        <td align="left" class="form_text">
            <input type="text" class="input_text" name="contract_period" id="contract_period" style="width:150px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนปี <input type="text" name="scorse_yer" id="scorse_yer" style="width:50px;"> ปี
         </td>
      </tr>
      <tr>
        <td align="right" class="form_text"> คำสั่ง</td>
        <td align="left" class="form_text">
            <input type="text" name="directive" id="directive" style="width:80px;">
            &nbsp;&nbsp;&nbsp;&nbsp;ที่ <input type="text" name="directive_no" id="directive_no" style="width:50px;">
            สั่ง ณ <input type="text" name="directive_date" id="directive_date" style="width:80px;" >&nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('directive_date','YYYY-MM-DD')" />
         </td>
      </tr>
     <tr>
        <td width="169" align="right" class="form_text"> บันทึกข้อความที่ : </td>
        <td colspan="2" align="left"><input type="text" name="sch_order_no" id="sch_order_no" style="width: 80px; " class="input_text" />
          ที่ <input type="text" id="sch_at" name="sch_at" style="width: 80px; " class="input_text"/>
          ลงวันที่ <input type="text"  name="sch_at_date" id="sch_at_date" style="width: 80px; " class="input_text" value=""> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_at_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ครั้งที่จ้าง</td>
        <td align="left" class="form_text">
            <input type="text" name="employ" id="employ" style="width:150px;" >
         </td>
      </tr>
       <tr>
        <td align="right" class="form_text">*เลขที่สัญญา</td>
        <td align="left" class="form_text">
            <input type="text" name="contract_no" id="contract_no" style="width:150px;" >
         </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* วันเริ่มสัญญา :</td>
        <td align="left" class="form_text"><input type="text" class="input_text" id="contract_start" name="contract_start" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_start','YYYY-MM-DD')" /> </td>
      </tr>
      <tr>
        <td align="right" class="form_text"> วันสิ้นสุดสัญญา :</td>
        <td align="left" class="form_text"><input  type="text" class="input_text" id="contract_finish" name="contract_finish" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_finish','YYYY-MM-DD')" /> </td>
      </tr>
        
      <tr>
        <td align="right" class="form_text">&nbsp;</td>
        <td align="left" class="form_text">
            <input type="checkbox" name="contract_document" id="contract_document" value="1">
            ติดต่อรับได้ ภายในวันที่ 
            <input type="text" name="contract_date" id="contract_date" style="width:80px;">&nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_date','YYYY-MM-DD')" />
         </td>
      </tr>
      <tr>
        <td align="right" class="form_text">&nbsp;</td>
        <td align="left" class="form_text">
            <input type="checkbox" name="secret_document" id="secret_document" value="1">
            รับแล้ว
            เมื่อวันที่ 
            <input type="text" name="document_date" id="document_date" style="width:80px;">&nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('document_date','YYYY-MM-DD')" />
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="secret_b" id="secret_b" value="1">
            รับรองเอง &nbsp;&nbsp;&nbsp;
            <input type="radio" name="secret_b" id="secret_b"value="2" >
            ผู้รับเเทน&nbsp;&nbsp;
            <input type="text" name="secret_name" id="secret_name" style="width:150px;" ></td>
      </tr>
      <tr>
        <td align="right" class="form_text">&nbsp;</td>
        <td align="left" class="form_text"><input type="checkbox" name="overtime_document" id="overtime_document" value="1">
พ้นกำหนดรับ ตั้งแต่วันที่
  <input type="text" name="overtime_date" id="overtime_date" style="width:80px;">
  &nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('overtime_date','YYYY-MM-DD')" /></td>
      </tr>
      
      <tr>
        <td align="right" class="form_text" valign="top">หมายเหตุ :</td>
        <td align="left"><textarea name="contract_comment" style="width: 250px"></textarea></td>
      </tr>
      <tr>
        <input name="one_files_h" type="hidden" id="one_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารคำสั่งจ้าง</td>
        <td width="" align="left">
            <input class="files" name="one_files" type="file" >
            <div class="contents"></div>
        </td>
    </tr>
    <tr>
        <input name="two_files_h" type="hidden" id="two_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารบันทึกข้อความ</td>
        <td width="" align="left">
            <input class="files" name="two_files" type="file" >
            <div class="contents"></div>
        </td>
    </tr>
    <tr>
        <input name="tree_files_h" type="hidden" id="tree_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารสัญญาจ้าง</td>
        <td width="" align="left">
            <input class="files" name="tree_files" type="file" >
            <div class="contents2"></div>
        </td>
    </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
          
       <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="javascript: return check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" onclick="change_data('contract_history.php','../images/head2/work_data2/contract_history.png');"/>
        </td>
      </tr>
             <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
</table>
</div>