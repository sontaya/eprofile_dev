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
$sql = "SELECT * FROM  ".TB_WELFARE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
function open_welfare(){
	window.location = "medical_welfare.pdf";
}

function open_childloan(){
	//window.open("childloan_welfare.pdf","childloan");
	window.location = "childloan_welfare.pdf";
}

function check_data(){
		
		/*if($("#ca_house_no").val() == "" || $("#ca_tumbon").val() == "" || $("#ca_amphur").val() == "" || $("#ca_province").val() == "" || $("#ca_post_code").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}
		
		if(!Checkfiles($("input#ca_cen_file"))){
				$("input#ca_cen_file").val("");
				$("#Valid_cen_file").dialog('open');
				return false;
		}*/
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("welfare").submit();
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
<form id="welfare" name="welfare" action="welfare_save.php" method="post" target="upload_target">
<table cellpadding="3" cellspacing="3" align="center" width="680" border="0">
<tr><td width="20" align="left" valign="middle" > <input type="checkbox" name="sso" value="1" <? if($row['SSO'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td>
<td width="629" height="30" colspan="2" align="left" valign="middle"> ประกันสังคม ใช้สิทธ์โรงพยาบาล <input type="text" id="hospital" name="hospital" class="input_text" value="<?=$row['HOSPITAL']?>"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td></tr>

<tr><td width="20" align="left" valign="middle" > <input type="checkbox" name="cpk" value="1" <? if($row['CPK'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td><td width="629" height="30" colspan="2" align="left" valign="middle"> ชพค.</td></tr>

<tr><td width="20" align="left" valign="middle" > <input type="checkbox" name="cps" value="1" <? if($row['CPS'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td><td width="629" height="30" colspan="2" align="left" valign="middle"> ชพส.</td></tr>
   <tr><td width="20" align="left" valign="middle" > <input type="checkbox" name="gpf" value="1" <? if($row['GPF'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td><td width="629" height="30" colspan="2" align="left" valign="middle"> ทุน กบข.</td></tr>
    <tr><td align="left" valign="middle" > <input type="checkbox" name="gpef" value="1" <? if($row['GPEF'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/></td><td height="30" colspan="2" align="left" valign="middle"> ทุน กสจ. </td></tr>
    <tr><td align="left" valign="middle" ><input type="checkbox" name="personnel_fund" value="1" <? if($row['PERSONNEL_FUND'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td>
  <td height="30" colspan="2" align="left" valign="middle"> กองทุนสะสมเลี้ยงชีพสำหรับบุคลากร</td></tr>
   <tr><td align="left" valign="middle" > <input type="checkbox" name="cooperatives" value="1" <? if($row['COOPERATIVES'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/></td><td height="30" colspan="2" align="left" valign="middle"> <div style="top:0px">สหกรณ์ออมทรัพย์ <input type="radio" name="debt" value="1" <? if($row['DEBT'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/> มียอดหนี้สหกรณ์ <input type="radio" name="debt" value="2" <? if($row['DEBT'] == "2") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/> ไม่มียอดหนี้สหกรณ์ </td></tr>
   <tr><td align="left" valign="middle" > <input type="checkbox" name="welfare" value="1" <? if($row['WELFARE'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/></td><td height="30" align="left" valign="middle"> โครงการจ่ายตรงสวัสดิการรักษาพยาบาล 
     <a href="medical_welfare.pdf" target="_blank"><img src="../images/pdf-download-icon.gif"  border="0" height="25" align="middle" title="ดาวโหลดเอกสาร"/></a></td>
     <td align="left" valign="middle">&nbsp;</td>
    </tr>
   <tr><td align="left" valign="middle" > <input type="checkbox" name="childloan" value="1" <? if($row['CHILDLOAN'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td><td height="30" colspan="2" align="left" valign="middle"> สนับสนุนทุนเล่าเรียนบุตร 
     <a href="childloan_welfare.pdf" target="_blank"><img src="../images/pdf-download-icon.gif"  border="0" height="25" align="middle" title="ดาวโหลดเอกสาร"/></a></td>
    </tr>
<!--  <tr><td align="left" valign="middle" >  <input type="checkbox" name="special_reward" value="1" <? if($row['SPECIAL_REWARD'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /></td><td height="30" colspan="2" align="left" valign="middle"> เป็นผู้ได้รับค่าตอบแทนพิเศษ (ยกเว้นข้าราชการและลูกจ้างประจำ)</td></tr>-->
   <tr><td height="30" align="left" valign="middle" > <input type="checkbox" name="scholar" value="1" <? if($row['SCHOLAR'] == "1") echo "checked='checked'";?><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/></td>
  <td height="30" colspan="2" align="left" valign="middle" style="padding-top: 8px"> มีสิทธิ์ขอทุนของมหาวิทยาลัยไปศึกษาต่อได้ (สำหรับผู้ที่ทำงานครบสองปี และมีผลประเมินครั้งล่าสุด ระดับสี่ขึ้นไป)</td></tr>
<tr>
  <td colspan="3" >
  <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
  <table align="left">
 <tr>
        <td width="85" align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" onclick="check_data();" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        </td>
        <td width="386" align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('welfare').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
    </tr>
      <tr>
        <td height="43" colspan="2" align="left"  valign="top" style="padding-left:10px; color:#06C;">&nbsp;<span id="waiting"></span></td>
    </tr>
</table>
   <?php } ?> 
  </td></tr>
</table>

</form>
<? $db->closedb($conn);?>