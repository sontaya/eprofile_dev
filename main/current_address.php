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
$sql = "SELECT * FROM  ".TB_CURRENT_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<script type="text/javascript" language="javascript">
function cen_address(){
$("#cu_house_no").val($("#ca_house_no").html());
$("#cu_moo").val($("#ca_moo").html());
$("#cu_building").val($("#ca_building").html());
$("#cu_village").val($("#ca_village").html());
$("#cu_room").val($("#ca_room").html());
$("#cu_soi").val($("#ca_soi").html());
$("#cu_road").val($("#ca_road").html());
$("#cu_tumbon").val($("#ca_tumbon").html());
$("#cu_amphur").val($("#ca_amphur").html());
$("#cu_province").val($("#ca_province").html());
$("#cu_post_code").val($("#ca_post_code").html());
}


function check_data(){
		
		if($("#cu_house_no").val() == "" || $("#cu_tumbon").val() == "" || $("#cu_amphur").val() == "" || $("#cu_province").val() == "" || $("#cu_post_code").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("current_address").submit();
}

$(function() {
		  $("#cu_province").autocomplete({
			source: provinceTags
		});
		$("#cu_amphur").autocomplete({
			source: amphurTags
		});
		$("#cu_country").autocomplete({
			source: contryTags
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
 });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">

    <tr><td >

<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td>
    <form id="current_address" name="current_address" enctype="multipart/form-data" method="post"  target="upload_target" action="current_address_save.php">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="184" align="right" class="form_text">* บ้านเลขที่ :</td>
        <td width="137" align="left"><input type="text" name="cu_house_no" id="cu_house_no" style="width: 100px;" class="input_text" value="<?=$row["CU_HOUSE_NO"]?>"/>
        &nbsp; &nbsp;</td>
        <td width="397" align="left"><div style="background-color:#6FF; cursor:pointer;width:140px; " onclick="cen_address()">ใช้ที่อยู่เดียวกับทะเบียนบ้าน</div></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่ :</td>
        <td colspan="2" align="left"><input type="text" name="cu_moo" id="cu_moo" style="width: 80px;" class="input_text" value="<?=$row["CU_MOO"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ตึก/อาคาร :</td>
        <td colspan="2" align="left"><input type="text" name="cu_building" id="cu_building" style="width: 120px;" class="input_text" value="<?=$row["CU_BUILDING"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่บ้าน :</td>
        <td colspan="2" align="left"><input type="text" name="cu_village" id="cu_village" style="width: 120px;" class="input_text" value="<?=$row["CU_VILLAGE"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ห้อง :</td>
        <td colspan="2" align="left"><input type="text" name="cu_room" id="cu_room" style="width: 120px;" class="input_text" value="<?=$row["CU_ROOM"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ซอย :</td>
        <td colspan="2" align="left"><input type="text" name="cu_soi" id="cu_soi" style="width: 120px;" class="input_text" value="<?=$row["CU_SOI"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ถนน :</td>
        <td colspan="2" align="left"><input type="text" name="cu_road" id="cu_road" style="width: 120px;" class="input_text" value="<?=$row["CU_ROAD"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ตำบล/แขวง :</td>
        <td colspan="2" align="left"><input type="text" name="cu_tumbon" id="cu_tumbon" style="width: 120px;" class="input_text" value="<?=$row["CU_TUMBON"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* อำเภอ/เขต :</td>
        <td colspan="2" align="left"><input type="text" name="cu_amphur" id="cu_amphur" style="width: 120px;" class="input_text" value="<?=$row["CU_AMPHUR"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* จังหวัด :</td>
        <td colspan="2" align="left"><input type="text" name="cu_province" id="cu_province" style="width: 120px;" class="input_text" value="<?=$row["CU_PROVINCE"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* รหัสไปรษณีย์ :</td>
        <td colspan="2" align="left"><input type="text" name="cu_post_code" id="cu_post_code" style="width: 50px;" maxlength="5" class="input_text" value="<?=$row["CU_POST_CODE"]?>"/></td>
      </tr>
        <tr>
        <td align="right" class="form_text">ประเทศ :</td>
        <td colspan="2" align="left"><input type="text" name="cu_country" id="cu_country" style="width: 120px;" class="input_text" value="<?=$row["CU_COUNTRY"]?>"/></td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
       <tr>
        <td align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('current_address').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
        <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>

    
  </td>
  </tr>  
</table>

<?
$sql = "SELECT * FROM  ".TB_CEN_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<div style="display:none">
<div id="ca_house_no"><?=$row["CA_HOUSE_NO"]?></div>
<div id="ca_moo"><?=$row["CA_MOO"]?></div>
<div id="ca_building"><?=$row["CA_BUILDING"]?></div>
<div id="ca_village"><?=$row["CA_VILLAGE"]?></div>
<div id="ca_room"><?=$row["CA_ROOM"]?></div>
<div id="ca_soi"><?=$row["CA_SOI"]?></div>
<div id="ca_road"><?=$row["CA_ROAD"]?></div>
<div id="ca_tumbon"><?=$row["CA_TUMBON"]?></div>
<div id="ca_amphur"><?=$row["CA_AMPHUR"]?></div>
<div id="ca_province"><?=$row["CA_PROVINCE"]?></div>
<div id="ca_post_code"><?=$row["CA_POST_CODE"]?></div>
</div>

<?
$db->closedb($conn);
?>