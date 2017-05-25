<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
//header("location: /e_profile/index2.php");
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT * FROM  ".TB_BIODATA_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row1 = $db->fetch($sql,$conn);

$sql = "SELECT * FROM  ".TB_GUARANTEE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
//$age = explode("-",$row["BIO_age"]);
$grt_contract_no1 = "";
$grt_contract_no2 = "";
$title = "";
$fname = "";
$lname = "";
if($row["GRT_CONTRACT_NO"] != ""){
list($grt_contract_no1,$grt_contract_no2) = explode("/",$row["GRT_CONTRACT_NO"]);
list($title,$fname,$lname) = explode(" ",$row["GRT_BY"]);
}

if($row["GRT_BIRTHDAY"] != ""){
	$grt_birthday = change_date_thai($row["GRT_BIRTHDAY"]);
}else{
	$grt_birthday = "";
}

if($row["GRT_ID_DATE_BEGIN"] != ""){
	$grt_id_date_begin = change_date_thai($row["GRT_ID_DATE_BEGIN"]);
}else{
	$grt_id_date_begin = "";
}

if($row["GRT_ID_DATE_EXP"] != ""){
	$grt_id_date_exp = change_date_thai($row["GRT_ID_DATE_EXP"]);
}else{
	$grt_id_date_exp = "";
}

if($row1["BIO_TITLE_TH"] == "1") $BIO_TITLE_TH = "นาย";
elseif($row1["BIO_TITLE_TH"] == "2") $BIO_TITLE_TH = "นาง";
elseif($row1["BIO_TITLE_TH"] == "3") $BIO_TITLE_TH = "นางสาว";
?>
<script type="text/javascript" language="javascript">

function check_data(){
	if($("#grt_contract_no1").val() == "" || $("#grt_contract_no2").val() == "" || $("#grt_at").val() == "" || $("#grt_name").val() == "" || $("#grt_university").val() == "" || $("#grt_country").val() == "" || $("#grt_university").val() == "" || $("#grt_country").val() == "" || $("#grt_by_title_name").val() == "" || $("#grt_by_fname").val() == "" || $("#grt_by_lname").val() == "" || $("#grt_birthday").val() == "" || $("#grt_occupation").val() == "" || $("#grt_salary").val() == ""  || $("#grt_id_type").val() == "" || $("#grt_id_no").val() == "" || $("#grt_id_from").val() == "" || $("#grt_id_date_begin").val() == ""  || $("#grt_id_date_exp").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}
	
		if(!Checkfiles($("input#grt_id_card_file"))){
				$("input#grt_id_card_file").val("");
				$("#Valid_id_file").dialog('open');
				return false;
		}
		if(!Checkfiles($("input#grt_cen_file"))){
				$("input#grt_cen_file").val("");
				$("#Valid_cen_file").dialog('open');
				return false;
		}
		if(!Checkfiles($("input#grt_file"))){
				$("input#grt_file").val("");
				$("#Valid_grt_file").dialog('open');
				return false;
		}
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("guarantee_data").submit();
		
}

function show_upload(id,target,file,pic,title,txt){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" class=\"file_upload\" /> <input type=\"button\" value=\"Cancel\" onclick=\"cancel_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"','"+txt+"')\"/>"+txt+"");
}

function cancel_upload(id,target,file,pic,title,txt){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" style=\"display:none\" class=\"file_upload\"/><span style='font-size: 14px'><img src=\"../images/"+pic+"\" height=\"20\" border=\"0\" onclick=\"window.open('files/guarantee_data_file/"+file+"','"+target+"','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\""+title+"\" /> &nbsp;&nbsp;&nbsp;<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"','"+txt+"')\"/>");
}

$(function() {
	
/*		$('#grt_birthday').datepicker({
		    changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1945:2000'
		});

		var dates = $('#grt_id_date_begin, #grt_id_date_exp').datepicker({
			changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1992:2015',
			onSelect: function(selectedDate) {
				var option = this.id == "grt_id_date_begin" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		
		});*/
		$("#grt_university").autocomplete({
			source: universityTags
		});
		$("#grt_country").autocomplete({
			source: contryTags
		});
		$("#grt_province").autocomplete({
			source: provinceTags
		});
		$("#grt_amphur").autocomplete({
			source: amphurTags
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
		$('#Valid_cen_file').dialog({
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
		$('#Valid_grt_file').dialog({
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
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
<table  cellspacing="0" cellpadding="0" align="center" >
<tr>
    <td>
    <form id="guarantee_data" name="guarantee_data" enctype="multipart/form-data" method="post" action="guarantee_data_save.php"  target="upload_target">
    <table width="99%"  cellspacing="0" cellpadding="4"  align="center">
    <tr>
        <td height="35" colspan="3" align="left"  style="padding-left:30px">
         <div class="head2" align="left">ผู้ให้สัญญา</div>
        </td>
        </tr>
                <tr>
        	<td align="right"> * ประเภทสัญญา : </td>
        	<td>
              <input type="radio" name="grt_contract_type"  class="input_text" <? if($row["GRT_CONTRACT_TYPE"]==0){?>checked="checked"<?}?>  value="0"/> ค้ำประกันการเข้าทำงาน
              <input type="radio" name="grt_contract_type"  class="input_text" <? if($row["GRT_CONTRACT_TYPE"]==1){?>checked="checked"<?}?> value="1"/> ค้ำประกันการศึกษาต่อ
            </td>
          </tr>
        <tr>
        	<td align="right"> * สัญญาเลขที่ : </td>
        	<td><input type="text" id="grt_contract_no1" name="grt_contract_no1" style="width:60px" class="input_text"  value="<?=$grt_contract_no1?>"/>/<input type="text" id="grt_contract_no2" name="grt_contract_no2" style="width:60px" class="input_text" value="<?=$grt_contract_no2?>"/></td>
          </tr>
           <tr>
        	<td align="right"> * ทำที่ : </td>
        	<td><input name="grt_at" type="text" class="input_text" id="grt_at" style="width:200px" value="<?=$row["GRT_AT"];?>" /></td>
          </tr>
           <tr>
        	<td align="right"> * ชื่อผู้ให้สัญญา : </td>
        	<td><input name="grt_name" type="text" class="input_text" id="grt_name" style="width:200px"  value="<? echo $row["GRT_NAME"];//$BIO_TITLE_TH." ".$row1["BIO_FNAME_TH"]." ".$row1["BIO_LNAME_TH"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> * สถานศึกษา/มหาวิทยาลัย : </td>
        	<td><input type="text" id="grt_university" name="grt_university" style="width:250px" class="input_text" value="<?=$row["GRT_UNIVERSITY"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> * ประเทศ : </td>
        	<td><input type="text" id="grt_country" name="grt_country" style="width:200px" class="input_text" value="<?=$row["GRT_COUNTRY"];?>"/></td>
          </tr>
           <tr>
        <td height="35" colspan="3" align="left"  style="padding-left:30px"><br /><br />
         <div class="head2" align="left">ผู้ค้ำประกัน</div>
        </td>
        </tr>
        <tr>
        	<td align="right"> * ผู้ค้ำประกันชื่อ : </td>
        	<td><select name="grt_by_title_name" id="grt_by_title_name" >
            <option value="">เลือก</option>
            <option value="นาย" <? if($title == "นาย") echo "selected='selected'";?>>นาย</option>
            <option value="นาง" <? if($title == "นาง") echo "selected='selected'";?>>นาง</option>
            <option value="นางสาว" <? if($title == "นางสาว") echo "selected='selected'";?>>นางสาว</option>
            </select>
             <input type="text" name="grt_by_fname" id="grt_by_fname" style="width: 80px; " class="input_text" value="<?=$fname;?>"/>
             &nbsp;  นามสกุล : <input type="text" name="grt_by_lname" id="grt_by_lname" style="width: 80px; " class="input_text" value="<?=$lname;?>"/></td>
          </tr>
          <tr>
        	<td align="right"> * วันเกิด : </td>
        	<td><input name="grt_birthday" type="text" class="input_text" id="grt_birthday" style="width: 80px; " value="<?=$grt_birthday;?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('grt_birthday','YYYY-MM-DD')"  style="cursor:pointer"/>
        	&nbsp; &nbsp;อาชีพ : <input name="grt_occupation" type="text" class="input_text" id="grt_occupation" style="width: 150px; " value="<?=$row["GRT_OCCUPATION"];?>"/></td>
          </tr>
           <tr>
        	<td align="right"> * สถานที่ทำงาน : </td>
        	<td><input name="grt_work_place" type="text" class="input_text" id="grt_work_place" style="width: 200px; " value="<?=$row["GRT_WORK_PLACE"];?>"/>
        	&nbsp; &nbsp;ตำแหน่ง : 
        	<input name="grt_position" type="text" class="input_text" id="grt_position" style="width: 180px; "  value="<?=$row["GRT_POSITION"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> ระดับ : </td>
        	<td><input name="grt_level" type="text" class="input_text" id="grt_level" style="width: 50px; "  value="<?=$row["GRT_LEVEL"];?>" />
        	&nbsp; &nbsp;สังกัดหน่วยงาน : 
        	<input name="grt_in" type="text" class="input_text" id="grt_in" style="width: 180px; "  value="<?=$row["GRT_IN"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> * อัตราเงินเดือน : </td>
        	<td><input name="grt_salary" type="text" class="input_text" id="grt_salary" style="width: 100px; " value="<?=$row["GRT_SALARY"];?>" />
        	&nbsp;</td>
          </tr>
          <tr>
        	<td align="right"> * หมายเลขบัตร : </td>
        	<td><select name="grt_id_type" id="grt_id_type" >
            <option value="">เลือก</option>
            <option value="ข้าราชการ" <? if($row["GRT_ID_TYPE"] == "ข้าราชการ") echo "selected='selected'";?>>ข้าราชการ</option>
            <option value="รัฐวิสาหกิจ" <? if($row["GRT_ID_TYPE"]  == "รัฐวิสาหกิจ") echo "selected='selected'";?>>รัฐวิสาหกิจ</option>
            <option value="ประชาชน" <? if($row["GRT_ID_TYPE"]  == "ประชาชน") echo "selected='selected'";?>>ประชาชน</option>
            </select>
             <input type="text" name="grt_id_no" id="grt_id_no" style="width:120px; " class="input_text"  value="<?=$row["GRT_ID_NO"];?>"/>
             &nbsp;  ออก ณ : 
             <input type="text" name="grt_id_from" id="grt_id_from" style="width: 120px; " class="input_text"  value="<?=$row["GRT_ID_FROM"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> * ออกบัตรวันที่ : </td>
        	<td><input name="grt_id_date_begin" type="text" class="input_text" id="grt_id_date_begin" style="width: 80px; " value="<?=$grt_id_date_begin;?>" /> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('grt_id_date_begin','YYYY-MM-DD')"  style="cursor:pointer"/>
        	&nbsp; &nbsp;บัตรหมดอายุวันที่ : 
        	<input name="grt_id_date_exp" type="text" class="input_text" id="grt_id_date_exp" style="width: 80px; " value="<?=$grt_id_date_exp;?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('grt_id_date_exp','YYYY-MM-DD')"  style="cursor:pointer"/></td>
          </tr>
           <tr>
        <td width="214" align="right" class="form_text">บ้านเลขที่ :</td>
        <td width="514" align="left"><input type="text" name="grt_house_no" id="grt_house_no" style="width: 100px; " class="input_text" value="<?=$row["GRT_HOUSE_NO"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ซอย :</td>
        <td  align="left"><input type="text" name="grt_soi" id="grt_soi" style="width: 120px; " class="input_text" value="<?=$row["GRT_SOI"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ถนน :</td>
        <td  align="left"><input type="text" name="grt_road" id="grt_road" style="width: 120px; " class="input_text" value="<?=$row["GRT_ROAD"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ตำบล/แขวง :</td>
        <td  align="left"><input type="text" name="grt_tumbon" id="grt_tumbon" style="width: 120px; " class="input_text" value="<?=$row["GRT_TUMBON"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">อำเภอ/เขต :</td>
        <td  align="left"><input type="text" name="grt_amphur" id="grt_amphur" style="width: 120px; " class="input_text" value="<?=$row["GRT_AMPHUR"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">จังหวัด :</td>
        <td  align="left"><input type="text" name="grt_province" id="grt_province" style="width: 120px; " class="input_text" value="<?=$row["GRT_PROVINCE"];?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">รหัสไปรษณีย์ :</td>
        <td  align="left"><input type="text" name="grt_post_code" id="grt_post_code" style="width: 50px; " maxlength="5" class="input_text" onkeyup="chkNum('grt_post_code','OnlyNm');" value="<?=$row["GRT_POST_CODE"];?>"/></td>
      </tr>
      <tr>
        	<td align="right"> เบอร์โทรศัพท์บ้าน : </td>
        	<td><input name="grt_phone" type="text" class="input_text" id="grt_phone" style="width: 100px; " value="<?=$row["GRT_PHONE"];?>"/>
        	&nbsp; &nbsp;มือถือ : 
        	<input name="grt_mobile" type="text" class="input_text" id="grt_mobile" style="width: 100px; " value="<?=$row["GRT_MOBILE"];?>" /></td>
          </tr>
           <tr>
        	<td align="right"> E-Mail : </td>
        	<td><input name="grt_email" type="text" class="input_text" id="grt_email" style="width: 150px; " onblur="chkEml('grt_email','ValidEml');" value="<?=$row["GRT_EMAIL"];?>"/>
        	&nbsp; &nbsp;คู่สมรสชื่อ : 
        	<input name="grt_couple_name" type="text" class="input_text" id="grt_couple_name" style="width: 150px; "  value="<?=$row["GRT_COUPLE_NAME"];?>"/></td>
          </tr>
          <tr>
        	<td align="right"> เกี่ยวพันกับผู้ให้สัญญาโดยเป็น : </td>
        	<td><input name="grt_relation" type="text" class="input_text" id="grt_relation" style="width: 150px; " value="<?=$row["GRT_RELATION"];?>"/>
</td>
          </tr>
      <tr height="33">
        <td width="214"  align="right" valign="middle" class="form_text">ไฟล์ดิจิตอล บัตรประชาชน :</td>
        <td width="514" align="left" valign="middle" style="color:#663; font-size:11px">
          <div id="show_upload1">
            <?
		if($row["GRT_ID_CARD_FILE"] == ""){
		?>
            <input type="file" name="grt_id_card_file" id="grt_id_card_file" class="file_upload" />
            เฉพาะ .jpg, .gif, .bmp, .png, .pdf
            <?
		}else{
			$file = $row["GRT_ID_CARD_FILE"];
			echo "<input type=\"file\" name=\"grt_id_card_file\" id=\"grt_id_card_file\" style=\"display:none \" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/guarantee_data_file/$file','grt_id_card_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"ID card\" alt=\"ID card\" /></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('1','grt_id_card_file','$file','macosx100.png','ID card',' เฉพาะ .jpg, .gif, .bmp, .png, .pdf')\"/>";
		}
        ?>
            </div>
          </td>
      </tr>
      <tr height="33">
        <td align="right" valign="middle" class="form_text">ไฟล์ดิจิตอล ทะเบียนบ้าน :</td>
        <td align="left" valign="middle" style="color: #663; font-size:11px">
         <div id="show_upload2">
        <?
		if($row["GRT_CEN_FILE"] == ""){
		?>
        <input type="file" name="grt_cen_file" id="grt_cen_file" class="file_upload"/>
          เฉพาะ .jpg, .gif, .bmp, .png, .pdf
            <?
		}else{
			$file = $row["GRT_CEN_FILE"];
			echo "<input type=\"file\" name=\"grt_cen_file\" id=\"grt_cen_file\" style=\"display:none\" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/guarantee_data_file/$file','grt_cen_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"ทะเบียนบ้าน\" alt=\"ทะเบียนบ้าน\"/></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('2','grt_cen_file','$file','macosx100.png','ทะเบียนบ้าน',' เฉพาะ .jpg, .gif, .bmp, .png, .pdf')\"/>";
		}
        ?>
        </div>
          </td>
      </tr>
      <tr height="33">
        <td  align="right" valign="middle" class="form_text">ไฟล์ดิจิตอล สัญญาค้ำประกัน :</td>
        <td align="left" valign="middle" style="color:#663; font-size:11px">
          <div id="show_upload3">
        <?
		if($row["GRT_FILE"] == ""){
		?>
        <input type="file" name="grt_file" id="grt_file" class="file_upload"/>
          เฉพาะ .jpg, .gif, .bmp, .png, .pdf
           <?
		}else{
			$file = $row["GRT_FILE"];
			echo "<input type=\"file\" name=\"grt_file\" id=\"grt_file\" style=\"display:none\" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/guarantee_data_file/$file','grt_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"สัญญาค้ำประกัน\" alt=\"สัญญาค้ำประกัน\"/></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('3','grt_file','$file','macosx100.png','สัญญาค้ำประกัน',' เฉพาะ .jpg, .gif, .bmp, .png, .pdf')\"/>";
		}
        ?>
        </div>
          </td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">
        <?
        if($row["GRT_ID_CARD_FILE"] != ""){
			echo "<input type='hidden' id='hid_grt_id_card_file' name='hid_grt_id_card_file' value='".$row["GRT_ID_CARD_FILE"]."' />";
		}
		 if($row["GRT_CEN_FILE"] != ""){
			echo "<input type='hidden' id='hid_grt_cen_file' name='hid_grt_cen_file' value='".$row["GRT_CEN_FILE"]."' />";
		}
		 if($row["GRT_FILE"] != ""){
			echo "<input type='hidden' id='hid_grt_file' name='hid_grt_file' value='".$row["GRT_FILE"]."' />";
		}
		?>
        </td>
      </tr>
       <tr>
        <td align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" onclick="check_data();" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        </td>
        <td align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('guarantee_data').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
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