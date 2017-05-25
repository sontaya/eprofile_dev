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
function check_data(){
		
		if($("#cer_name").val() == "" || $("#cer_from").val() == "" || $("#cer_expire").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("certification").submit();
}

$(function() {
		   
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
 });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
        <div id="certification_list" align="center" class="data_details_list">
      <? include "certification_data_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><img src="../images/add.png" onclick="toggle_form('certification','cer_id')" style="cursor:pointer"/></div>
      <div id="data_form" style="display:none"> 
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="certification" name="certification"  method="post" action="certification_data_save.php" target="upload_target">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="304" align="right" class="form_text">* ชื่อใบรับรอง   : <input type="hidden" id="cer_id" name="cer_id" value="" /></td>
        <td width="426" align="left"><input type="text" name="cer_name" id="cer_name" style="width: 300px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* หน่วยงานที่ออกให้ :</td>
        <td align="left"><input type="text" name="cer_from" id="cer_from" style="width: 200px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* วันที่หมดอายุ :</td>
        <td align="left"><input type="text" name="cer_expire" id="cer_expire" style="width: 70px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cer_expire','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>

      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
   
       <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('certification.php','../images/head2/work_data/certification.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
             <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    
    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>
</div>
    
  </td>
  </tr>  
</table>