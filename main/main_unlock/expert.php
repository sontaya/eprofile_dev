<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT * FROM  ".TB_EXPERT_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<script type="text/javascript" language="javascript">
function check_data(){
		
		if($("#exp_expert1").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}
	
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("expert").submit();
}

$(function() {
		  $("#exp_expert1").autocomplete({
			source: expertTags
		});
		$("#exp_expert2").autocomplete({
			source: expertTags
		});
		$("#exp_expert3").autocomplete({
			source: expertTags
		});
		$("#exp_expert4").autocomplete({
			source: expertTags
		});
		$("#exp_expert5").autocomplete({
			source: expertTags
		});
		$("#exp_expert6").autocomplete({
			source: expertTags
		});
		$("#exp_expert7").autocomplete({
			source: expertTags
		});
		$("#exp_expert8").autocomplete({
			source: expertTags
		});
		$("#exp_expert9").autocomplete({
			source: expertTags
		});
		$("#exp_expert10").autocomplete({
			source: expertTags
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
		
 });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td valign="top">
    <form id="expert" name="expert" method="post" action="expert_data_save.php"  target="upload_target" >
   
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="186" align="right" class="form_text">* ความเชี่ยวชาญที่ 1 : </td>
        <td width="540" align="left"><input type="text" name="exp_expert1" id="exp_expert1" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT1"]?>"<?php if($_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php if(!($row['EXP_EXPERT2'] == '' && ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 2 :</td>
        <td align="left"><input type="text" name="exp_expert2" id="exp_expert2" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT2"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT3'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 3 :</td>
        <td align="left"><input type="text" name="exp_expert3" id="exp_expert3" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT3"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
	<?php if(!($row['EXP_EXPERT4'] == '' && ($_SESSION['USER_TYPE'] == 'chief'))) { ?>      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 4 :</td>
        <td align="left"><input type="text" name="exp_expert4" id="exp_expert4" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT4"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT5'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 5 :</td>
        <td align="left"><input type="text" name="exp_expert5" id="exp_expert5" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT5"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT6'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 6 :</td>
        <td align="left"><input type="text" name="exp_expert6" id="exp_expert6" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT6"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT7'] == '' && ($_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 7 :</td>
        <td align="left"><input type="text" name="exp_expert7" id="exp_expert7" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT7"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT8'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 8 :</td>
        <td align="left"><input type="text" name="exp_expert8" id="exp_expert8" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT8"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT9'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 9 :</td>
        <td align="left"><input type="text" name="exp_expert9" id="exp_expert9" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT9"]?>"<?php if($_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPERT10'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">ความเชี่ยวชาญที่ 10 :</td>
        <td align="left"><input type="text" name="exp_expert10" id="exp_expert10" style="width: 300px; " class="input_text" value="<?=$row["EXP_EXPERT10"]?>"<?php if($_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <?php if(!($row['EXP_EXPER_OTH'] == '' && ( $_SESSION['USER_TYPE'] == 'chief'))) { ?>
      <tr>
        <td align="right" class="form_text">อื่นๆ :</td>
        <td align="left"><input type="text" name="exp_expert_oth" id="exp_expert_oth" style="width: 300px; " class="input_text"   value="<?=$row["EXP_EXPERT_OTH"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
      </tr>
      <?php } ?>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <?php if( $_SESSION['USER_TYPE'] != 'chief') { ?>
       <tr>
        <td align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('expert').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
      <?php } ?>
       <tr>
        <td colspan="2" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  
</table>
  </td>
  </tr>  
</table>
<?
$db->closedb($conn);
?>