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
		if(contract_no == "" || contract_period == "" || contract_year == "" || contract_position == "" || contract_start == "" || contract_finish == "") {
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
    <form id="contract" name="contract" method="post" action="contract_data_save.php" target="upload_target">
    <img src="../images/bg_d.png" style="margin-left:16px;" />
    <table width="781" border="0" cellspacing="4" cellpadding="4">
    <tr>
        <td align="right" class="form_text">* เลขที่สัญญา :</td>
        <td align="left"><input type="text" class="input_text" name="contract_no" id="contract_no"/></td>
      </tr>
    <tr>
        <td width="170" align="right" class="form_text">* สัญญาระยะที่ :</td>
        <td width="583" align="left"><input type="text" class="input_text" name="contract_period" />  จำนวนปี : <input type="text" class="input_text" name="contract_year" /></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ตำแหน่งปัจจุบัน :</td>
        <td align="left">
        	<input type="radio" name="contract_position" value="1" checked="checked"> เจ้าหน้าที่  <input type="radio" name="contract_position" value="2"> อาจารย์  <input type="radio" name="contract_position" value="3"> ผศ. <input type="radio" name="contract_position" value="4"> รศ. <input type="radio" name="contract_position" value="5"> ศ. <input type="radio" name="contract_position" value="6"> ที่ปรึกษา <input type="radio" name="contract_position" value="7"> ครู
        </td>
      </tr>     
      <tr>
        <td align="right" class="form_text">* วันเริ่มสัญญา :</td>
        <td align="left" class="form_text"><input type="text" class="input_text" id="contract_start" name="contract_start" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_start','YYYY-MM-DD')" /> </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* วันสิ้นสุดสัญญา :</td>
        <td align="left" class="form_text"><input  type="text" class="input_text" id="contract_finish" name="contract_finish" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_finish','YYYY-MM-DD')" /> </td>
      </tr>
      <tr>
        <td align="right" class="form_text">เซ็นสัญญากับมหาวิทยาลัย<br />
          เมื่ออายุมากกว่า 60 ปี : </td>
        <td align="left" class="form_text"><input name="contract_m60" type="radio" value="0" checked="checked"> ไม่ใช่ <input type="radio" name="contract_m60" value="1"> ใช่</td>
      </tr>
      <tr>
        <td align="right" class="form_text" valign="top">หมายเหตุ :</td>
        <td align="left"><textarea name="contract_comment" style="width: 250px"></textarea></td>
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