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
		
		if($("#wrk_work_place").val() == "" || $("#wrk_position").val() == "" || $("#wrk_depart").val() == "" || $("textarea#wrk_responsibility").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("work_history").submit();
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
        <div id="work_history_list" align="center" class="data_details_list">
      <? include "workh_data_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?><img src="../images/add.png" onclick="toggle_form('work_history','wrk_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
      <div id="data_form"  style="display:none;"> 
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="work_history" name="work_history"  method="post" action="workh_data_save.php" target="upload_target">
    <img src="../images/bg_d.png" style="margin-left:10px;" />
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="140" align="right" class="form_text">* สถานที่ทำงาน :</td>
        <td width="590" align="left"><input type="text" name="wrk_work_place" id="wrk_work_place" style="width: 300px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ตำแหน่ง :</td>
        <td align="left"><input type="text" name="wrk_position" id="wrk_position" style="width: 200px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* หน่วยงาน/ฝ่าย/แผนก :</td>
        <td align="left"><input type="text" name="wrk_depart" id="wrk_depart" style="width: 200px; " class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" class="form_text">* หน้าที่รับผิดชอบ :</td>
        <td align="left" valign="top"><textarea name="wrk_responsibility" id="wrk_responsibility" style="width: 320px; height:100px" class="input_text"></textarea></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ระยะเวลา :</td>
        <td align="left" class="form_text">
        <input type="text" name="wrk_long" id="wrk_long" style="width: 130px; " class="input_text" />
        </td>
      </tr>
      <tr>
        <td align="right" valign="top" class="form_text">ที่ตั้งที่ทำงาน :</td>
        <td align="left" valign="top"><textarea name="wrk_loc" id="wrk_loc" style="width: 320px; height:100px" class="input_text"></textarea>
     
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรศัพท์ :</td>
        <td align="left">
  <input name="wrk_phone" type="text"  class="input_text" id="wrk_phone" style="width: 140px; " maxlength="50"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรสาร :</td>
        <td align="left">
  <input name="wrk_fax" type="text"  class="input_text" id="wrk_fax" style="width: 140px; " maxlength="50"/></td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left"><input type="hidden" id="wrk_id" name="wrk_id"  value="" /></td>
      </tr>
   
       <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('work_history.php','../images/head2/work_data/workhistory.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
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