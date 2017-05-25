<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
function check_data(){
	
		if($("#hon_year").val() == "" || $("#hon_name").val() == ""  ){
			$("#Please_fill_in").dialog('open');
				return false;
		}

	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("honor").submit();
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
    <div id="honor_list" align="center" class="data_details_list">
      <? include "honor_data_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('honor','hon_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
      <div id="data_form" style="display:none;"> 
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="honor" name="honor" method="post" action="honor_data_save.php" target="upload_target" enctype="multipart/form-data">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="182" align="right" class="form_text">* ปี พ.ศ. ที่ได้รับ :</td>
        <td width="548" align="left">
          <select id="hon_year" name="hon_year"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {?> onfocus="myDisable(this);"<?php } ?>>
            <option value="">เลือก</option>
            <?
        $year = date("Y")+543;
			for($i=0;$i<70;$i++){
			$y= $year-$i;
			if($_POST["press_year"] == $y){
				$txt = "selected = 'selected'";
			}else{$txt = "";}
			echo "<option value='$y' $txt>$y</option>\n";	
		}
		?>
            </select>
          </td>
      </tr>
     
      <tr>
        <td align="right" class="form_text">* ชื่อรางวัลประกาศเกียรติคุณ  :</td>
        <td align="left">
        <input type="text" name="hon_name" id="hon_name" style="width: 300px;" class="input_text"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {?> onfocus="myDisable(this);"<?php } ?>/>
        <input type="hidden" id="hon_id" name="hon_id" value=""/></td>
      </tr>
      <tr>
        <td align="right" >ได้รับมอบจาก : </td>
        <td align="left"><input type="text" name="hon_from" id="hon_from" style="width: 300px;" class="input_text"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {?> onfocus="myDisable(this);"<?php } ?>/></td>
      </tr>
     <tr>
        <td align="right" >แนบไฟล์  : </td>
        <td align="left"><input type="file" name="hon_file" id="hon_file" class="file_upload"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {?> onfocus="myDisable(this);"<?php } ?>/><input type='text' id='hid_hon_file' name='hid_hon_file' style="display:none" /></td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
      <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('honor.php','../images/head2/work_data/honor.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
        </td>
      </tr>
      <?php } ?>
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