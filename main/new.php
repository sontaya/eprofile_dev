<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลเบื้องต้น</title>
<link rel="stylesheet" type="text/css" href="css/main1.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/style_menu.css" />
<link rel="stylesheet" type="text/css" href="jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
<!--<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.button.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.resizable.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.6.custom/development-bundle/ui/jquery.ui.dialog.js"></script>-->
<script src="js/main.js" type="text/javascript"></script>
<script src="js/bio_data.js" type="text/javascript"></script>
<script src="js/menu-collapsed.js" type="text/javascript"></script>
<script src="js/autoComplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('#bio_birthday').datepicker({
		    changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			yearRange: '1930:2030'
		});

		var dates = $('#bio_id_date_begin, #bio_id_date_exp').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			yearRange: '1930:2030',
			onSelect: function(selectedDate) {
				var option = this.id == "bio_id_date_begin" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
		
		$("#bio_nation1").autocomplete({
			source: contryTags
		});
		$("#bio_nation2").autocomplete({
			source: contryTags
		});
		$("#bio_religion").autocomplete({
			source: religionTags
		});
		$("#bio_id_from_p").autocomplete({
			source: provinceTags
		});
		$("#bio_id_from").autocomplete({
			source: amphurTags
		});
		$("#bio_bank").autocomplete({
			source: banksTags
		});		
		
		$('#OnlyThai').dialog({
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
		
		$('#OnlyEn').dialog({
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
		
		$('#OnlyNm').dialog({
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
		
		$('#ValidEml').dialog({
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
		
		$('#Valid_id_file').dialog({
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
		
		$('#Valid_acc_file').dialog({
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
		
		$('#Valid_pic_file').dialog({
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
		
		$('#Save_success').dialog({
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
</head>

<body>
<table width="990" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" ><img src="images/e_profile/images/main_01.png" width="981" height="152" border="0"/></td>
  </tr>
  <tr>
    <td align="center" background="images/e_profile/images/bg_07.png"   >
    <table width="990" border="0" cellspacing="0" cellpadding="0" >
    <tr>
    <td width="211" height="500" valign="top"  style="padding-left: 5px"><img src="images/e_profile/images/e_profile_example_04.png"  align="left"/><br />
    <table align="center" border="0" cellspacing="0" cellpadding="0" >
    <tr><td>
    <? include "menu.php";?>
    </td></tr>
    </table>
    </td>
    <td width="779"  align="left" valign="top">
    <table cellpadding="0" cellspacing="0" align="center" width="760">
    <tr>
      <td align="center" >&nbsp;</td></tr>
    <tr><td >
    <div class="head" ><img src="images/head/bio_data.png" /><br />
      <br />
    </div>

    <table  cellspacing="0" cellpadding="0" align="center" >
  
  <tr>
    <td>
    <form id="bio_data" name="bio_data" enctype="multipart/form-data" method="post" action="bio_data_save.php" target="upload_target">
    <table width="99%"  cellspacing="0" cellpadding="4"  align="center">
      <tr>
        <td width="164" align="right" class="form_text" >คำนำหน้า :</td>
        <td width="566">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13%">
            <select name="bio_title_th" id="bio_title_th" onchange="swap_bio_title_th();">
            <option value="0">เลือก</option>
            <option value="mr_th">นาย</option>
            <option value="mrs_th">นาง</option>
            <option value="ms_th">นางสาว</option>
            </select>
            </td>
            <td width="10%" align="right" class="form_text">ชื่อ : &nbsp;</td>
            <td width="16%" align="left"><input type="text" name="bio_fname_th" id="bio_fname_th" style="width: 90px; height:13px" class="input_text"  onkeyup="chkTh('bio_fname_th','OnlyThai');"/></td>
            <td width="13%" align="right" class="form_text">นามสกุล : &nbsp;</td>
            <td width="16%" align="left"><input type="text" name="bio_lname_th" id="bio_lname_th" style="width: 90px; height:13px" class="input_text"  onkeyup="chkTh('bio_lname_th','OnlyThai');"/></td>
            <td width="13%" align="right" class="form_text">ชื่อกลาง : &nbsp;</td>
            <td width="19%">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="form_text">Title :</td>
        <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="10%">
            <select name="bio_title_en" id="bio_title_en" onchange="swap_bio_title_en();">
            <option value="0">เลือก</option>
            <option value="mr_en">Mr.</option>
            <option value="mrs_en">Mrs.</option>
            <option value="ms_en">Miss</option>
            </select>
            </td>
            <td width="14%" align="right" class="form_text">Firstname : &nbsp;</td>
            <td width="16%" align="left"><input type="text" name="bio_fname_en" id="bio_fname_en" style="width: 90px; height:13px" class="input_text" onkeyup="chkEn('bio_fname_en','OnlyEn');"/></td>
            <td width="13%" align="right" class="form_text">Lastname : &nbsp;</td>
            <td width="16%" align="left"><input type="text" name="bio_lname_en" id="bio_lname_en" style="width: 90px; height:13px" class="input_text" onkeyup="chkEn('bio_lname_en','OnlyEn');"/></td>
            <td width="16%" align="right" class="form_text">Middlename : &nbsp;</td>
            <td width="15%">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">เพศ :</td>
        <td align="left"><input name="bio_sex" type="radio" id="bio_sex"  value="male" checked="checked"/>  ชาย <input type="radio" name="bio_sex" id="bio_sex" value="female" />  หญิง</td>
      </tr>
      <tr>
        <td align="right" class="form_text">เชื้อชาติ :</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="26%" align="left"><input name="bio_nation1" class="input_text" id="bio_nation1" style="width: 150px; height:13px" /></td>
            <td width="13%" align="right" class="form_text">สัญชาติ : &nbsp;</td>
            <td width="27%" align="left">
            <input name="bio_nation2" class="input_text" id="bio_nation2" style="width: 150px; height:13px" />
            </td>
            <td width="11%" align="right" class="form_text">ศาสนา : &nbsp;</td>
            <td width="23%" align="left"><input type="text" name="bio_religion" id="bio_religion" style="width: 100px; height:13px" class="input_text"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="form_text">วันเกิด :</td>
        <td align="left"><input name="bio_birthday" type="text" class="input_text" id="bio_birthday" style="width: 70px; height:13px" readonly="readonly" /></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ปัจจุบันอายุ :</td>
        <td align="left" class="form_text"><input type="text"  style="width: 20px; height:13px" readonly="readonly" name="bio_s_year" id="bio_s_year" onfocus="Age()"/> ปี <input type="text"  style="width: 20px; height:13px" readonly="readonly" name="bio_s_month" id="bio_s_month" onfocus="Age()"/> เดือน</td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมายเลขบัตรประชาชน :</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="19%" align="left"><input type="text" name="bio_code_id" id="bio_code_id" style="width: 120px; height:13px" maxlength="13" class="input_text" onkeyup="chkNum('bio_code_id','OnlyNm');" /></td>
            <td width="15%" align="right" class="form_text">ออกให้ ณ : &nbsp;</td>
            <td width="16%"><input type="text" name="bio_id_from" id="bio_id_from" style="width: 100px; height:13px" class="input_text"/></td>
            <td width="12%" align="right" class="form_text">จังหวัด : &nbsp;</td>
            <td width="38%"><input type="text" name="bio_id_from_p" id="bio_id_from_p" style="width: 100px; height:13px" class="input_text"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="form_text">วันที่ทำบัตร :</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11%" align="left"><input name="bio_id_date_begin" type="text"  class="input_text" id="bio_id_date_begin" style="width: 70px; height:13px" readonly="readonly"/></td>
            <td width="16%" align="right" class="form_text">วันที่หมดอายุ :&nbsp; </td>
            <td width="73%" align="left"><input name="bio_id_date_exp" type="text"  class="input_text" id="bio_id_date_exp" style="width: 70px; height:13px" readonly="readonly"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมายเลขประจำตัวผู้เสียภาษี :</td>
        <td align="left"><input type="text" name="bio_tax_id" id="bio_tax_id" style="width: 120px; height:13px"  class="input_text" onkeyup="chkNum('bio_tax_id','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมายเลขบัตรข้าราชการ :</td>
        <td align="left"><input type="text" name="bio_gov_id" id="bio_gov_id" style="width: 100px; height:13px"  class="input_text" onkeyup="chkNum('bio_gov_id','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมายเลขบัตรบุคลากร :</td>
        <td align="left"><input type="text" name="emp_id" id="emp_id" style="width: 100px; height:13px"  class="input_text" onkeyup="chkNum('emp_id','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมายเลขหนังสือเดินทาง :</td>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="16%"><input type="text" name="bio_passport_id" id="bio_passport_id" style="width: 100px; height:13px"  class="input_text" onkeyup="chkNum('bio_passport_id','OnlyNm');"/></td>
              <td width="24%" align="right" class="form_text">&nbsp;</td>
              <td width="16%">&nbsp;</td>
              <td width="13%" align="right" class="form_text">&nbsp;</td>
              <td width="31%">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
       <tr>
        <td align="right" class="form_text">หมายเลขบัญชีธนาคาร : &nbsp;</td>
        <td align="left"><input type="text" name="bio_bank_acc_id" id="bio_bank_acc_id" style="width: 100px; height:13px"  class="input_text" onkeyup="chkNum('bio_bank_acc_id','OnlyNm');"/>
          &nbsp; &nbsp;&nbsp; <span class="form_text">ธนาคาร :
          <input type="text" name="bio_bank" id="bio_bank" style="width: 190px; height:13px"  class="input_text" />
          </span></td>
      </tr>
      <tr>
        <td align="right" class="form_text">สถานะการแต่งงาน :</td>
        <td align="left" class="form_text"><input name="bio_status" type="radio" id="bio_status" value="1" checked="checked" /> โสด <input type="radio" name="bio_status" id="bio_status" value="2" /> สมรส <input type="radio" name="bio_status" id="bio_status" value="3" />
        หม้าย</td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่เลือด :</td>
        <td align="left">
          <select name="bio_blood_group" id="bio_blood_group">
            <option value="0">เลือก</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="ab">AB</option>
            <option value="o">O</option>
            </select>
            &nbsp;&nbsp;<input name="bio_blood_type" type="radio" id="bio_blood_type" value="plus" checked="checked" /> RH+ <input type="radio" name="bio_blood_type" id="bio_blood_type" value="minus" /> RH-
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรศัพท์ที่บ้าน :</td>
        <td align="left"><input type="text" name="bio_h_phone_area" id="bio_h_phone_area" maxlength="3" style="width: 20px; height:13px"  class="input_text" onkeyup="chkNum('bio_h_phone_area','OnlyNm');"/> - <input type="text" name="bio_h_phone" id="bio_h_phone" maxlength="7" style="width: 80px; height:13px"  class="input_text" onkeyup="chkNum('bio_h_phone','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรสาร :</td>
        <td align="left"><input type="text" name="bio_h_fax_area" id="bio_h_fax_area"  maxlength="3" style="width: 20px; height:13px"  class="input_text" onkeyup="chkNum('bio_h_fax_area','OnlyNm');"/> - <input type="text" name="bio_h_fax" id="bio_h_fax" maxlength="7" style="width: 80px; height:13px"  class="input_text" onkeyup="chkNum('bio_h_fax','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรศัพท์มือถือ เบอร์ที่ 1:</td>
        <td align="left">08<input type="text" name="bio_mobile_area1" id="bio_mobile_area1"  maxlength="1" style="width: 15px; height:13px"  class="input_text" onkeyup="chkNum('bio_mobile_area1','OnlyNm');"/> - <input type="text" name="bio_mobile1" id="bio_mobile1" maxlength="7" style="width: 80px; height:13px"  class="input_text" onkeyup="chkNum('bio_mobile1','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เบอร์โทรศัพท์มือถือ เบอร์ที่ 2:</td>
        <td align="left">08<input type="text" name="bio_mobile_area2" id="bio_mobile_area2" style="width: 15px; height:13px"  class="input_text" onkeyup="chkNum('bio_mobile_area2','OnlyNm');" maxlength="1"/> - <input type="text" name="bio_mobile2" id="bio_mobile2" maxlength="7" style="width: 80px; height:13px"  class="input_text" onkeyup="chkNum('bio_mobile2','OnlyNm');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">e-mail ชื่อที่ 1 :</td>
        <td align="left"><input type="text" name="bio_email1" id="bio_email1" style="width: 120px; height:13px"  class="input_text" onblur="chkEml('bio_email1','ValidEml');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">e-mail ชื่อที่ 2 :</td>
        <td align="left"><input type="text" name="bio_email2" id="bio_email2" style="width: 120px; height:13px"   class="input_text" onblur="chkEml('bio_email2','ValidEml');"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">เอกสารดิจิตอล บัตรประชาชน :</td>
        <td style="color:#663; font-size:11px"><input type="file" name="bio_id_card_file" id="bio_id_card_file" style=" height:19px" />
        เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx</td>
      </tr>
      <tr>
        <td align="right" class="form_text">เอกสารดิจิตอล บัญชีเงิน :</td>
        <td style="color: #663; font-size:11px"><input type="file" name="bio_acc_bank_file" id="bio_acc_bank_file" style=" height:19px"/>
          เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx</td>
      </tr>
      <tr>
        <td height="20" align="right" class="form_text">รูปถ่ายปัจจุบัน :</td>
        <td style="color:#663; font-size:11px"><input type="file" name="bio_pic_file" id="bio_pic_file" style=" height:19px"/>
          เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx</td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
       <tr>
        <td align="right" >
         <img name="pic_save" id="pic_save" src="images/default_button/save_default_buttons_01.png" onclick="check_data();" border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="images/active_default/save_active_buttons_01.png" onclick="check_data();" border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        </td>
        <td align="left">
        <img name="pic_cancel" id="pic_cancel" src="images/default_button/cancel_default_buttons_03.png" border="0" onclick="document.getElementById('bio_data').reset()" style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('bio_data').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td width="760" align="center"><img src="images/bg_white_03.png" width="99%" /></td>
  </tr>
</table>

    
  </td>
  </tr>  
</table>
    </td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="center"><img src="images/e_profile/images/main_03.png" width="990" height="126"  border="0"/></td>
  </tr>
</table>
<? include "dialog.php";?>
<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe> 
</body>
</html>