<?
@session_start();
//print_r($_SESSION);
//$_SESSION['USER_TYPE']="admin";
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
  <?
}
//header("location: /e_profile/index2.php");
$fpath = '../';
require_once($fpath . "includes/connect.php");
$sql = "SELECT * FROM  " . TB_BIODATA_TAB . "  WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'";
$row = $db->fetch($sql, $conn);
//$age = explode("-",$row["BIO_age"]);
/* $bio_h_phone = array("","");
  $bio_h_fax = array("","");
  $bio_mobile1 = array("","");
  $bio_mobile2 = array("","");
  if($row["BIO_H_PHONE"] != "") $bio_h_phone = explode("-",$row["BIO_H_PHONE"]);
  if($row["BIO_H_FAX"] != "") $bio_h_fax = explode("-",$row["BIO_H_FAX"]);
  if($row["BIO_MOBILE_1"] != "") $bio_mobile1 = explode("-",cut_first2num($row["BIO_MOBILE_1"]));
  if($row["BIO_MOBILE_2"] != "") $bio_mobile2 = explode("-",cut_first2num($row["BIO_MOBILE_2"])); */

if ($row["BIO_BIRTHDAY"] != "") {
  $bio_birthday = change_date_thai($row["BIO_BIRTHDAY"]);
} else {
  $bio_birthday = "";
}

if ($row["BIO_ID_DATE_BEGIN"] != "") {
  $bio_id_date_begin = change_date_thai($row["BIO_ID_DATE_BEGIN"]);
} else {
  $bio_id_date_begin = "";
}

if ($row["BIO_ID_DATE_EXP"] != "") {
  $bio_id_date_exp = change_date_thai($row["BIO_ID_DATE_EXP"]);
} else {
  $bio_id_date_exp = "";
}

if ($row["BIO_GOV_ID_DATE_BEGIN"] != "") {
  $bio_gov_id_date_begin = change_date_thai($row["BIO_GOV_ID_DATE_BEGIN"]);
} else {
  $bio_gov_id_date_begin = "";
}

if ($row["BIO_GOV_ID_DATE_EXP"] != "") {
  $bio_gov_id_date_exp = change_date_thai($row["BIO_GOV_ID_DATE_EXP"]);
} else {
  $bio_gov_id_date_exp = "";
}
?>
<script type="text/javascript" language="javascript">
  // JavaScript Document
  function swap_bio_title_th(){
    var value = $("select#bio_title_th").val();
    switch (value){
      case "0": $("select#bio_title_en").val("0"); 
        break;
      case "นาย": $("select#bio_title_en").val("Mr."); document.bio_data.bio_sex[0].checked="checked";
        break;
      case "นาง": $("select#bio_title_en").val("Mrs.");document.bio_data.bio_sex[1].checked="checked";
        break;
      case "น.ส.": $("select#bio_title_en").val("MISS");document.bio_data.bio_sex[1].checked="checked";
        break;
    }

  }

  function swap_bio_title_en(){
    var value = $("select#bio_title_en").val();
    switch (value){
      case "0": $("select#bio_title_th").val("0"); 
        break;
      case "Mr.": $("select#bio_title_th").val("นาย"); document.bio_data.bio_sex[0].checked="checked";
        break;
      case "Mrs.": $("select#bio_title_th").val("นาง");document.bio_data.bio_sex[1].checked="checked";
        break;
      case "MISS": $("select#bio_title_th").val("น.ส.");document.bio_data.bio_sex[1].checked="checked";
        break;
    }

  }

  function check_data(){
  	
    if($("#bio_title_th").val() == "0" || $("#bio_fname_th").val() == "" || $("#bio_lname_th").val() == "" || $("#bio_fname_en").val() == "" || $("#bio_lname_en").val() == "" || $("#bio_sex").val() == "" || $("#bio_birthday").val() == "" || $("#person_id").val() == "" || $("#emp_id").val() == "" ){
      $("#Please_fill_in").dialog('open');
      return false;
    }
		
    if($("#type_id").val() == "1"){
      if(!checkID($("#person_id").val())){
        $("#ValidPersonID").dialog('open');
        return false;
      }
    }
	
    /*if(!Checkfiles($("input#bio_id_card_file"))){
                        $("input#bio_id_card_file").val("");
                        $("#Valid_id_file").dialog('open');
                        return false;
            }
            if(!Checkfiles($("input#bio_acc_bank_file"))){
                        $("input#bio_acc_bank_file").val("");
                        $("#Valid_acc_file").dialog('open');
                        return false;
            }*/
    if(!CheckfilesPic($("input#bio_pic_file"))){
      $("input#bio_pic_file").val("");
      $("#Valid_pic_file").dialog('open');
      return false;
    }
	
	//alert(chk_card);
	var id_card_chk = 1;
	if(chk_card>id_card_chk){
		$("#Valid_chk_card").dialog('open');
		return false;
	}
	 
	 
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("bio_data").submit();
    //save_biodata();
		
  }

  function show_upload(id,target,file,pic,title,txt){
    $("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" class=\"file_upload\" /> <input type=\"button\" value=\"Cancel\" onclick=\"cancel_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"','"+txt+"')\"/>"+txt+"");
  }

  function cancel_upload(id,target,file,pic,title,txt){
    $("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" style=\"display:none\" class=\"file_upload\"/><span style='font-size: 14px'><img src=\"../images/"+pic+"\" height=\"20\" border=\"0\" onclick=\"window.open('files/bio_data_file/"+file+"','"+target+"','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\""+title+"\" /> &nbsp;&nbsp;&nbsp;<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"','"+txt+"')\"/>");
  }

  function search_nation1(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
    if(txt==""){
      alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
    }else{
      ajaxPostData("_find_nation1.php",data,"text","result_search_nation1",result_search_nation1,"","");
    }
  }

  function result_search_nation1(response){
    if(response == "0"){
      $('#result_search_nation1').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_nation1').html(response);
    }
  }

  function pick_nation1(id){
    var id_nation = $('#id'+id).val();
    var name_nation = $('#name'+id).val();
	
    //$("span#nation1").html("<select id='bio_nation1' name='bio_nation1' style='width: 130px' ><option value='"+id_nation+"' selected='selected'>"+name_nation+"</option></select>");
	
    $("span#nation1").html("<input type='hidden' value='"+id_nation+"' id='bio_nation1' name='bio_nation1' ><input type='text' value='"+name_nation+"' style='width: 130px;' name='bio_nation1_show' readonly='readonly' class='b_gray' id='bio_nation1_show' >");
	
    $("#search_nation1").val("");
    $("div#result_search_nation1").html("");
    $('#dialog1').dialog('close');
  }

  function search_nation2(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
    if(txt==""){
      alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
    }else{
      ajaxPostData("_find_nation2.php",data,"text","result_search_nation2",result_search_nation2,"","");
    }
  }

  function result_search_nation2(response){
    if(response == "0"){
      $('#result_search_nation2').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_nation2').html(response);
    }
  }

  function pick_nation2(id){
    var id_nation = $('#id'+id).val();
    var name_nation = $('#name'+id).val();
	
    $("span#nation2").html("<input type='hidden' id='bio_nation2' name='bio_nation2' value='"+id_nation+"' style='width: 130px' ><input type='text' id='bio_nation2_show' name='bio_nation2_show' readonly='readonly' value='"+name_nation+"' style='width: 130px' >");
	
    $("#search_nation2").val("");
    $("div#result_search_nation2").html("");
    $('#dialog2').dialog('close');
  }



  $(function() {
	
    $('#dialog1').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'500',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_nation1").val("");
          $("div#result_search_nation1").html("");
        }
      }
    });
		
    $('#dialog2').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'500',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_nation2").val("");
          $("div#result_search_nation2").html("");
        }
      }
    });
		
    $( "#opener1" ).click(function() {
      $( "#dialog1" ).dialog( "open" );
      return false;
    });
		
    $( "#opener2" ).click(function() {
      $( "#dialog2" ).dialog( "open" );
      return false;
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
    $("#bio_title2_th").autocomplete({
      source: titleTags
    });
		
    $('#ValidPersonID').dialog({
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
		
    $('#Retired').dialog({
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
  
  $('#Valid_chk_card').dialog({
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

  function pop_history_name() {
    //alert('pop_history_name2');
    window.open('name_history.php','nnn','width=550,heigth=300');
    return false;
  }
	var chk_card=1;
	
	function chack_idcard(){
		//alert(chk_card);
		//alert($("#chk_id_p_status").val());
		var idcard_old='<?=$_SESSION["PERSON_ID"]?>';
		var idcard=$("#person_id").val();
		var ran=Math.random();
		if(idcard!=idcard_old){
			$.post("ajax_chack_idcard.php?r="+ran, {idcard:idcard,type:$("#chk_id_p_status").val()}, 
				function(data){
					//alert(idcard+" : "+data);
					chk_card=data;
				}
			);
		}
	}
</script>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<style type="text/css">
  .w_100 {
    width: 100px;
  }
  .w_130 {
    width: 130px;
  }
  .b_gray {
    border: 1px solid #999999;
  }
</style>
<table cellpadding="0" cellspacing="0" align="center" width="758">
  <tr><td >
      <table  cellspacing="0" cellpadding="0" align="center" >
        <tr>
          <td>
            <form id="bio_data" name="bio_data" enctype="multipart/form-data" method="post" action="bio_data_save.php" target="upload_target">
              <table width="99%"  cellspacing="0" cellpadding="4"  align="center">
                <tr>
                  <td width="94" align="right" class="form_text" ><!--* คำนำหน้า :-->ยศ/ตำแหน่ง : &nbsp;</td>
                  <td width="602">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="17%">
                          <!--
                          <select name="bio_title_th" id="bio_title_th" onchange="swap_bio_title_th();"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> class="w_100 b_gray">
                          <option value="0">เลือก</option>
                          <option value="นาย" <? if ($row["BIO_TITLE_TH"] == "นาย") { echo "selected='selected'"; } ?>>นาย</option>
                          <option value="นาง" <? if ($row["BIO_TITLE_TH"] == "นาง") { echo "selected='selected'"; } ?>>นาง</option>
                          <option value="น.ส." <? if ($row["BIO_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>นางสาว</option>
                          </select>
                          -->
                          <input type="text" name="bio_title2_th" id="bio_title2_th" style="width: 80px; " class="input_text"  onkeyup="chkTh('bio_title2_th','OnlyThai');" value="<?= $row["BIO_TITLE2_TH"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> />
                        </td>
                        <td width="35%" align="right" class="form_text"><!--ยศ/ตำแหน่ง : &nbsp;-->ฐานันดร/บรรดาศักดิ์พระราชทาน : </td>
                        <td width="17%" align="left">&nbsp;<!--<input type="text" name="bio_title2_th" id="bio_title2_th" style="width: 80px; " class="input_text"  onkeyup="chkTh('bio_title2_th','OnlyThai');" value="<?= $row["BIO_TITLE2_TH"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?> />-->
                          <select name="bio_title3_th" class="b_gray" id="bio_title3_th"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>>
                            <option selected="selected" value="0">--เลือกข้อมูล--</option>
                            <option value="พระองค์เจ้า" <? if ($row["BIO_TITLE3_TH"] == "พระองค์เจ้า") { echo "selected='selected'"; } ?>>พระองค์เจ้า</option>
                            <option value="หม่อมเจ้า" <? if ($row["BIO_TITLE3_TH"] == "หม่อมเจ้า") { echo "selected='selected'"; } ?>>หม่อมเจ้า</option>
                            <option value="หม่อมราชวงศ์" <? if ($row["BIO_TITLE3_TH"] == "หม่อมราชวงศ์") { echo "selected='selected'"; } ?>>หม่อมราชวงศ์</option>
                            <option value="หม่อมหลวง" <? if ($row["BIO_TITLE3_TH"] == "หม่อมหลวง") { echo "selected='selected'"; } ?>>หม่อมหลวง</option>
                            <option value="ท่านผู้หญิง" <? if ($row["BIO_TITLE3_TH"] == "ท่านผู้หญิง") { echo "selected='selected'"; } ?>>ท่านผู้หญิง</option>
                            <option value="คุณหญิง" <? if ($row["BIO_TITLE3_TH"] == "คุณหญิง") { echo "selected='selected'"; } ?>>คุณหญิง</option>
                          </select>
                        </td>
                        <td width="40%" align="left" class="form_text"><!--&nbsp;ฐานันดร/บรรดาศักดิ์พระราชทาน :-->
                          <!--
                          <select name="bio_title3_th" class="b_gray" id="bio_title3_th"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>>
                                            <option selected="selected" value="0">--เลือกข้อมูล--</option>
                                            <option value="พระองค์เจ้า" <? if ($row["BIO_TITLE3_TH"] == "พระองค์เจ้า") { echo "selected='selected'"; } ?>>พระองค์เจ้า</option>
                                            <option value="หม่อมเจ้า" <? if ($row["BIO_TITLE3_TH"] == "หม่อมเจ้า") { echo "selected='selected'"; } ?>>หม่อมเจ้า</option>
                                            <option value="หม่อมราชวงศ์" <? if ($row["BIO_TITLE3_TH"] == "หม่อมราชวงศ์") { echo "selected='selected'"; } ?>>หม่อมราชวงศ์</option>
                                            <option value="หม่อมหลวง" <? if ($row["BIO_TITLE3_TH"] == "หม่อมหลวง") { echo "selected='selected'"; } ?>>หม่อมหลวง</option>
                                            <option value="ท่านผู้หญิง" <? if ($row["BIO_TITLE3_TH"] == "ท่านผู้หญิง") { echo "selected='selected'"; } ?>>ท่านผู้หญิง</option>
                                            <option value="คุณหญิง" <? if ($row["BIO_TITLE3_TH"] == "คุณหญิง") { echo "selected='selected'"; } ?>>คุณหญิง</option>
                                        </select>
                              !-->
                          &nbsp;&nbsp;&nbsp;<button onclick="pop_history_name(); return false;">ดูชื่อเดิม</button>
                        </td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td width="94" align="right" class="form_text" >* คำนำหน้า :</td>
                  <td width="602">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10%">

                          <select name="bio_title_th" id="bio_title_th" onchange="swap_bio_title_th();"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> class="w_100 b_gray">
                            <option value="0">เลือก</option>
                            <option value="นาย" <? if ($row["BIO_TITLE_TH"] == "นาย") { echo "selected='selected'"; } ?>>นาย</option>
                            <option value="นาง" <? if ($row["BIO_TITLE_TH"] == "นาง") { echo "selected='selected'"; } ?>>นาง</option>
                            <option value="น.ส." <? if ($row["BIO_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>นางสาว</option>
                          </select>
                        </td><td align="right" width="13%">ชื่อ :</td><td>
                          <input type="text" name="bio_fname_th" id="bio_fname_th" style="width: 99px; " class="input_text"   value="<?
if ($row["BIO_FNAME_TH"] == "")
  echo $_SESSION["FNAME_TH"]; else
  echo $row["BIO_FNAME_TH"];
?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /></td>
                        <td width="19%" align="right" class="form_text">ชื่อกลาง :&nbsp;&nbsp;</td>
                        <td width="18%" align="left"><input type="text" name="bio_mname_th" id="bio_mname_th" style="width: 80px; " class="input_text"   value="<?= $row["BIO_MNAME_TH"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /></td>
                        <td width="19%" align="right" class="form_text">&nbsp;นามสกุล : </td>
                        <td width="51%" align="left"><input type="text" name="bio_lname_th" id="bio_lname_th" style="width: 80px; " class="input_text"   value="<?
                                 if ($row["BIO_LNAME_TH"] == "")
                                   echo $_SESSION["LNAME_TH"]; else
                                   echo $row["BIO_LNAME_TH"];
?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">* Title :</td>
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%">
                          <select name="bio_title_en" class="w_100 b_gray" id="bio_title_en"  onchange="swap_bio_title_en();"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>>
                            <option value="0">เลือก</option>
                            <option value="Mr." <? if ($row["BIO_TITLE_EN"] == "Mr.") { echo "selected='selected'"; } ?>>Mr.</option>
                            <option value="Mrs." <? if ($row["BIO_TITLE_EN"] == "Mrs.") { echo "selected='selected'"; } ?>>Mrs.</option>
                            <option value="MISS" <? if ($row["BIO_TITLE_EN"] == "MISS") { echo "selected='selected'"; } ?>>Miss</option>
                          </select>
                        </td>
                        <td width="14%" align="right" class="form_text">Fname : &nbsp;</td>
                        <td width="16%" align="left">&nbsp;<input type="text" name="bio_fname_en" id="bio_fname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('bio_fname_en','OnlyEn');" value="<?
                                                            if ($row["BIO_FNAME_EN"] == "")
                                                              echo $_SESSION["FNAME_EN"]; else
                                                              echo $row["BIO_FNAME_EN"];
?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                        <td width="14%" align="right"  class="form_text">&nbsp;&nbsp;&nbsp;&nbsp;Mname :</td>
                        <td width="15%" align="left">&nbsp;<input type="text" name="bio_mname_en" id="bio_mname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('bio_mname_en','OnlyEn');" value="<?= $row["BIO_MNAME_EN"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                        <td width="13%" align="right" class="form_text">Lname :&nbsp;</td>
                        <td width="16%"><input type="text" name="bio_lname_en" id="bio_lname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('bio_lname_en','OnlyEn');" value="<?
                                                                  if ($row["BIO_LNAME_EN"] == "")
                                                                    echo $_SESSION["LNAME_EN"]; else
                                                                    echo $row["BIO_LNAME_EN"];
?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="right" class="form_text">* เพศ :</td>
                  <td align="left"><input name="bio_sex" type="radio" id="bio_sex"  value="1" <? if ($row["BIO_SEX"] == "1") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>/>  ชาย <input type="radio" name="bio_sex" id="bio_sex" value="2" <? if ($row["BIO_SEX"] == "2") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>/>  หญิง</td>
                </tr>
                <tr>
                  <td align="right" class="form_text">เชื้อชาติ :</td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%" align="left">
                          <?
                          $sql_bio_nation1 = "SELECT * FROM  " . TB_REF_NATION . "  WHERE  NATION_ID = '" . $row["BIO_NATION1"] . "'";
                          $stid_bio_nation1 = oci_parse($conn, $sql_bio_nation1);
                          oci_execute($stid_bio_nation1);
                          $option_bio_nation1 = "";
                          while (($row_bio_nation1 = oci_fetch_array($stid_bio_nation1, OCI_BOTH))) {
                            if ($row_bio_nation1["NATION_NAME_TH"] == "" or $row_bio_nation1["NATION_NAME_TH"] == NULL)
                              $name_country = $row_bio_nation1["NATION_NAME_ENG"];
                            else
                              $name_country = $row_bio_nation1["NATION_NAME_TH"];
                            //if($row["BIO_NATION1"] == $row_bio_nation1["NATION_ID"]){ $select="selected = 'selected'";}else{ $select="";}
                            $option_bio_nation1 .= "<option value='" . $row_bio_nation1["NATION_ID"] . "' selected='selected'>" . $name_country . "</option>\n";
                          }
                          ?>
                          <span id="nation1"> 
                          <!--<select name="bio_nation1" id="bio_nation1"  style="width: 130px" >-->
                            <!--
                            <select name="bio_nation1" class="b_gray" id="bio_nation1" style="width: 130px" <?php if ($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?> onfocus="myDisable(this)"<?php } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?><?php } ?>>
                            <?= $option_bio_nation1 ?>
                                    </select>
                            -->
                            <input type="hidden"  name="bio_nation1" class="b_gray" id="bio_nation1" value="<?= $row["BIO_NATION1"] ?>" />
                            <input type="text" class="input_text" readonly value="<?= $name_country ?>" style="width: 130px;"  <?php if ($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?> onfocus="myDisable(this)"<?php } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?><?php } ?>/>
                          </span> <?php if ($_SESSION['USER_TYPE'] != 'chief' && $_SESSION['USER_TYPE'] != 'user') { ?> <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener1"  title="ค้นหา"/><?php } ?>
                        </td>
                        <td width="11%" align="right" class="form_text">สัญชาติ : &nbsp;</td>
                        <td width="36%" align="left">
                          <?
                          $sql_bio_nation2 = "SELECT * FROM  " . TB_REF_NATION . "  WHERE  NATION_ID = '" . $row["BIO_NATION2"] . "' ";
                          $stid_bio_nation2 = oci_parse($conn, $sql_bio_nation2);
                          oci_execute($stid_bio_nation2);
                          $option_bio_nation2 = "";
                          while (($row_bio_nation2 = oci_fetch_array($stid_bio_nation2, OCI_BOTH))) {
                            if ($row_bio_nation2["NATION_NAME_TH"] == "" or $row_bio_nation2["NATION_NAME_TH"] == NULL)
                              $name_country = $row_bio_nation2["NATION_NAME_ENG"];
                            else
                              $name_country = $row_bio_nation2["NATION_NAME_TH"];
                            //if($row["BIO_NATION2"] == $row_bio_nation2["NATION_ID"]){ $select="selected = 'selected'";}else{ $select="";}
                            $option_bio_nation2 .= "<option value='" . $row_bio_nation2["NATION_ID"] . "' selected='selected'>" . $name_country . "</option>\n";
                          }
                          ?>
                          <span id="nation2">
                          <!--<select name="bio_nation2" id="bio_nation2" style="width: 130px">-->
                          <!--<select name="bio_nation2" class="b_gray" id="bio_nation2" style="width: 130px" <?php if ($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?>onfocus="myDisable(this)"<?php } ?><?php if (($_SESSION['USER_TYPE'] == 'user') || $_SESSION['USER_TYPE'] == 'chief') { ?><?php } ?>>
                            <?= $option_bio_nation2 ?>
                                 </select>-->
                            <input type="hidden" name="bio_nation2" id="bio_nation2" value="<?= $row["BIO_NATION2"] ?>" />   
                            <input type="text" class="input_text" readonly  value="<?= $name_country ?>" />  
                          </span><?php if ($_SESSION['USER_TYPE'] != 'chief' && $_SESSION['USER_TYPE'] != 'user') { ?> <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener2"  title="ค้นหา"/> <?php } ?>
                        </td>
                        <td width="3%" align="right" class="form_text">&nbsp;</td>
                        <td width="17%" align="left">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">ศาสนา :</td>
                  <td align="left">
                    <?
                    $sql_bio_religion = "SELECT * FROM  " . TB_REF_RELIGION . "  ORDER BY RELIGION_ID ASC ";
                    $stid_bio_religion = oci_parse($conn, $sql_bio_religion);
                    oci_execute($stid_bio_religion);
                    $option_bio_religion = "<option value='0'>เลือก</option>";
                    while (($row_bio_religion = oci_fetch_array($stid_bio_religion, OCI_BOTH))) {
                      if ($row["BIO_RELIGION"] == $row_bio_religion["RELIGION_ID"]) { $select = "selected = 'selected'"; } else { $select = ""; }
                      $option_bio_religion .= "<option value='" . $row_bio_religion["RELIGION_ID"] . "' $select>" . $row_bio_religion["RELIGION_NAME_TH"] . "</option>\n";
                    }
                    ?>
                    <select name="bio_religion" id="bio_religion" class="w_130 b_gray"<?php if (($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief')) { ?> onfocus="myDisable(this)"<?php } ?>>
                      <?= $option_bio_religion ?>
                    </select>

                  </td>
                </tr>

                <tr>
                  <td align="right" class="form_text">* ว/ด/ป เกิด :</td>
                  <td align="left"><input name="bio_birthday" type="text" class="input_text"  id="bio_birthday" style="width: 128px; " value="<?= $bio_birthday ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> />
                    <?php if ($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') { ?> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bio_birthday','YYYY-MM-DD')"  style="cursor:pointer"/>
                      ex. 15/10/2553 <?php } ?></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">ปัจจุบันอายุ :</td>
                  <?
                  $age = birthday($row["BIO_BIRTHDAY"]);
                  ?>
                  <td align="left" class="form_text"><input type="text"  style="width: 25px; border:none; text-align:right; " class="input_text" readonly name="bio_s_year" id="bio_s_year" value="<?= $age[0]; ?>" onfocus="Age('bio_birthday','bio_s_year','bio_s_month')"/> ปี <input type="text"  style="width: 25px; border:none; text-align:right; " class="input_text" readonly name="bio_s_month" id="bio_s_month" value="<?= $age[1]; ?>" onfocus="Age('bio_birthday','bio_s_year','bio_s_month')"/> เดือน</td>
                </tr>
              </table>
              <br />
              <table width="100%">
                <? if ($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['USER_EMP_ID'] == $_SESSION['EMP_ID']) { ?>
                  <tr>
                    <td align="right" class="form_text">*
                      <select name="type_id" class="b_gray" id="type_id"  style="width: 150px; text-align:center"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>><option value="1">เลขประจำตัวประชาชน</option>
                        <option value="2" <? if ($_SESSION["PERSON_ID"] != "") { if (strlen($_SESSION["PERSON_ID"]) != 13) { echo "selected = 'selected'"; } } ?>>Passport</option></select> :</td>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="22%" align="left"><input name="person_id" type="text" class="input_text" id="person_id" style="width: 128px; "  value="<?= $_SESSION["PERSON_ID"]; ?>" maxlength="20"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> onkeyup="chack_idcard();" /></td>
                          <td width="17%" align="right" class="form_text">ออกให้ ณ : &nbsp;</td>
                          <td width="18%"><input type="text"  name="bio_id_from" id="bio_id_from" style="width: 100px; " class="input_text" value="<?= $row["BIO_ID_FROM"]; ?>"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /></td>
                          <td width="13%" align="right" class="form_text" >จังหวัด : &nbsp;</td>
                          <td width="30%">
                            <?
                            $sql_bio_id_from_p = "SELECT * FROM  " . TB_REF_PROVINCE . "  ORDER BY NAME_REF_PROVINCE ASC ";
                            $stid_bio_id_from_p = oci_parse($conn, $sql_bio_id_from_p);
                            oci_execute($stid_bio_id_from_p);
                            $option_bio_id_from_p = "<option value='0'>เลือก</option>";
                            while (($row_bio_id_from_p = oci_fetch_array($stid_bio_id_from_p, OCI_BOTH))) {
                              if ($row["BIO_ID_FROM_P"] == $row_bio_id_from_p["CODE_REF_PROVINCE"]) { $select = "selected = 'selected'"; } else { $select = ""; }
                              $option_bio_id_from_p .= "<option value='" . $row_bio_id_from_p["CODE_REF_PROVINCE"] . "' $select>" . $row_bio_id_from_p["NAME_REF_PROVINCE"] . "</option>\n";
                            }
                            ?>
                            <select name="bio_id_from_p" id="bio_id_from_p" class="b_gray"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>>
                              <?= $option_bio_id_from_p ?>
                            </select>


                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">วันออกบัตร :</td>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="41%" align="left"><input  name="bio_id_date_begin" type="text"  class="input_text" id="bio_id_date_begin" style="width: 80px; " value="<?= $bio_id_date_begin ?>"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if (($_SESSION['USER_TYPE'] != 'user') && ($_SESSION['USER_TYPE'] != 'chief')) { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bio_id_date_begin','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>ex. 15/10/2553 </td>
                          <td width="19%" align="right" class="form_text">วันบัตรหมดอายุ :&nbsp; </td>
                          <td width="40%" align="left"><input name="bio_id_date_exp" type="text"  class="input_text" id="bio_id_date_exp" style="width: 80px; "  value="<?= $bio_id_date_exp ?>"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if (($_SESSION['USER_TYPE'] != 'user') && ($_SESSION['USER_TYPE'] != 'chief')) { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bio_id_date_exp','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>ex. 15/10/2553 </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
				  
                  <tr>
                    <td align="right" class="form_text">เลขประจำตัวผู้เสียภาษี :</td>
                    <td align="left"><input type="text" name="bio_tax_id" id="bio_tax_id" style="width: 120px; "  class="input_text" value="<?= $row["BIO_TAX_ID"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">เลขที่บัตรข้าราชการ :</td>
                    <td align="left"><input type="text" name="bio_gov_id" id="bio_gov_id" style="width: 100px; "  class="input_text" onkeyup="//chkNum('bio_gov_id','OnlyNm');" value="<?= $row["BIO_GOV_ID"]; ?>"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">วันออกบัตร :</td>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="41%" align="left"><input  name="bio_gov_id_date_begin" type="text"  class="input_text" id="bio_gov_id_date_begin" style="width: 80px; " value="<?= $bio_gov_id_date_begin ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if (($_SESSION['USER_TYPE'] != 'user') && ($_SESSION['USER_TYPE'] != 'chief')) { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bio_gov_id_date_begin','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>ex. 15/10/2553 </td>
                          <td width="19%" align="right" class="form_text">วันบัตรหมดอายุ :&nbsp; </td>
                          <td width="40%" align="left"><input name="bio_gov_id_date_exp" type="text"  class="input_text" id="bio_gov_id_date_exp" style="width: 80px; "  value="<?= $bio_gov_id_date_exp ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if (($_SESSION['USER_TYPE'] != 'user') && ($_SESSION['USER_TYPE'] != 'chief')) { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bio_gov_id_date_exp','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>ex. 15/10/2553 </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
				  
				   <tr>
				  	<td align="right" class="form_text">Work Permit :</td>
					<td><input name="bio_work_permit" type="text"  class="input_text" id="bio_work_permit" style="width: 100px; " value="<?= $row["BIO_WORK_PERMIT"]; ?>"<?php if ($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?> disabled="disabled"<?php } ?> /></td>
				  </tr>
				  
                  <tr>
                    <td align="right" class="form_text">* เลขบัตรบุคลากร :</td>
                    <td align="left"><input name="emp_id" type="text"  class="input_text" id="emp_id" style="width: 100px; " value="<?= $_SESSION["EMP_ID"]; ?>"<?php if ($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?> disabled="disabled"<?php } ?> /></td>
                  </tr>

                  <tr>
                    <td align="right" class="form_text">เลขที่บัญชีธนาคาร : &nbsp;</td>
                    <td align="left"><input type="text" name="bio_bank_acc_id" id="bio_bank_acc_id" style="width: 100px; "  class="input_text" onkeyup="chkNum('bio_bank_acc_id','OnlyNm');" value="<?= $row["BIO_BANK_ACC_ID"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                      &nbsp; &nbsp;&nbsp; <span class="form_text">ธนาคาร :
                        <input type="text" name="bio_bank" id="bio_bank" style="width: 190px; "  class="input_text" value="<?= $row["BIO_BANK"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                      </span></td>
                  </tr>
                <? } ?>
                <tr>
                  <td align="right" class="form_text">สถานภาพ :</td>
                  <td align="left" class="form_text"><input name="bio_status" type="radio" id="bio_status" value="1" <? if ($row["BIO_STATUS"] == "1") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> /> โสด <input type="radio" name="bio_status" id="bio_status" value="2" <? if ($row["BIO_STATUS"] == "2") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> /> สมรส <input type="radio" name="bio_status" id="bio_status" value="3"  <? if ($row["BIO_STATUS"] == "3") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>/>
                    หย่า <input type="radio" name="bio_status" id="bio_status" value="4"  <? if ($row["BIO_STATUS"] == "4") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>/>
                    หม้าย</td>
                </tr>
                <tr>
                  <td align="right" class="form_text">หมู่เลือด :</td>
                  <td align="left">
                    <select name="bio_blood_group" class="b_gray" id="bio_blood_group"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>>
                      <option value="0">เลือก</option>
                      <option value="1" <? if ($row["BIO_BLOOD_GROUP"] == "1") { echo "selected='selected'"; } ?>>A</option>
                      <option value="2" <? if ($row["BIO_BLOOD_GROUP"] == "2") { echo "selected='selected'"; } ?>>AB</option>
                      <option value="3" <? if ($row["BIO_BLOOD_GROUP"] == "3") { echo "selected='selected'"; } ?>>B</option>
                      <option value="4" <? if ($row["BIO_BLOOD_GROUP"] == "4") { echo "selected='selected'"; } ?>>O</option>
                    </select>
                    &nbsp;&nbsp;<input name="bio_blood_type" type="radio" id="bio_blood_type" value="plus" <? if ($row["BIO_BLOOD_TYPE"] == "plus") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> /> RH+ <input type="radio" name="bio_blood_type" id="bio_blood_type" value="minus" <? if ($row["BIO_BLOOD_TYPE"] == "minus") { echo "checked='checked'"; } ?><?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?>/> RH-
                  </td>
                </tr>
                <tr>
                  <td align="right" class="form_text">โทรศัพท์ที่บ้าน :</td>
                  <td align="left"><input type="text" name="bio_h_phone" id="bio_h_phone" maxlength="15" style="width: 100px; "  class="input_text" value="<?= $row["BIO_H_PHONE"] ?>"/></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">โทรสาร :</td>
                  <td align="left"><input type="text" name="bio_h_fax" id="bio_h_fax" maxlength="15" style="width: 100px; "  class="input_text" value="<?= $row["BIO_H_FAX"]; ?>"/></td>
                </tr>
                <?php
                //}
                ?>
                <tr>
                  <td align="right" class="form_text">โทรศัพท์มือถือ 1:</td>
                  <td align="left"><input type="text" name="bio_mobile_1" id="bio_mobile_1" maxlength="15" style="width: 100px; "  class="input_text" value="<?= $row["BIO_MOBILE_1"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'chief' && $_SESSION['EMP_ID'] != $_SESSION['USER_EMP_ID']) { ?> disabled="disabled" <?php } ?>/></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">โทรศัพท์มือถือ 2:</td>
                  <td align="left"><input type="text" name="bio_mobile_2" id="bio_mobile_2" maxlength="15" style="width: 100px; "  class="input_text" value="<?= $row["BIO_MOBILE_2"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'chief' && $_SESSION['EMP_ID'] != $_SESSION['USER_EMP_ID']) { ?> disabled="disabled" <?php } ?>/></td>
                </tr>
				
				<tr>
					<td align="right" class="form_text">ห้องพักอาจารย์ :</td>
					<td align="left"><input type="text" name="bio_room_teacher" id="bio_room_teacher" maxlength="300" style="width: 300px; "  class="input_text" value="<?= $row["BIO_ROOM_TEACHER"]; ?>"<?php if ($_SESSION['USER_TYPE'] == 'chief' && $_SESSION['EMP_ID'] != $_SESSION['USER_EMP_ID']) { ?> disabled="disabled" <?php } ?>/></td>
				</tr>
				
                <tr>
                  <td align="right" class="form_text">ผู้ติดต่อ(กรณีฉุกเฉิน):</td>
                  <td align="left">ชื่อ-สกุล          <input type="text" name="bio_name_emer" id="bio_name_emer"  style="width: 136px; "  class="input_text"  value="<?= $row["BIO_NAME_EMER"]; ?>"/>
                    โทรศัพท์  
                    <input type="text" name="bio_emer_phone" id="bio_emer_phone"  style="width: 100px; "  class="input_text"  value="<?= $row["BIO_EMER_PHONE"]; ?>"/></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">e-mail ชื่อที่ 1 :</td>
                  <td align="left"><input type="text" name="bio_email1" id="bio_email1" style="width: 180px; "  class="input_text" onblur="chkEml('bio_email1','ValidEml');" value="<?= $row["BIO_EMAIL1"]; ?>"/></td>
                </tr>
                <tr>
                  <td align="right" class="form_text">e-mail ชื่อที่ 2 :</td>
                  <td align="left"><input type="text" name="bio_email2" id="bio_email2" style="width: 180px; "   class="input_text" onblur="chkEml('bio_email2','ValidEml');" value="<?= $row["BIO_EMAIL2"]; ?>"/></td>
                </tr>
          <!--      <tr height="33">
                  <td  align="right" valign="middle" class="form_text">ไฟล์ดิจิตอล บัตรประชาชน :</td>
                  <td align="left" valign="middle" style="color:#663; font-size:11px">
                  <div id="show_upload1">
                <?
                //	if($row["BIO_ID_CARD_FILE"] == ""){
                ?>
                  <input type="file" name="bio_id_card_file" id="bio_id_card_file" class="file_upload" />
                  เฉพาะ .jpg, .gif, .bmp, .png, .pdf
                <?
                /* 	}else{
                  $file = $row["BIO_ID_CARD_FILE"];
                  echo "<input type=\"file\" name=\"bio_id_card_file\" id=\"bio_id_card_file\" style=\"display:none \" class=\"file_upload\"/>";
                  echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/bio_data_file/$file','bio_id_card_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"ID card\" alt=\"ID card\" /></span> &nbsp;&nbsp;&nbsp;";
                  echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('1','bio_id_card_file','$file','macosx100.png','ID card',' เฉพาะ .jpg, .gif, .bmp, .png, .pdf')\"/>";
                  } */
                ?>
                  </div>
                  </td>
                </tr>
                <tr height="33">
                  <td align="right" valign="middle" class="form_text">ไฟล์ดิจิตอล บัญชีเงิน :</td>
                  <td align="left" valign="middle" style="color: #663; font-size:11px">
                   <div id="show_upload2">
                <?
                //	if($row["BIO_ACC_BANK_FILE"] == ""){
                ?>
                  <input type="file" name="bio_acc_bank_file" id="bio_acc_bank_file" class="file_upload"/>
                    เฉพาะ .jpg, .gif, .bmp, .png, .pdf
                <?
                /* 		}else{
                  $file = $row["BIO_ACC_BANK_FILE"];
                  echo "<input type=\"file\" name=\"bio_acc_bank_file\" id=\"bio_acc_bank_file\" style=\"display:none\" class=\"file_upload\"/>";
                  echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/bio_data_file/$file','bio_acc_bank_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"Saving account\" alt=\"Saving account\"/></span> &nbsp;&nbsp;&nbsp;";
                  echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('2','bio_acc_bank_file','$file','macosx100.png','Saving account',' เฉพาะ .jpg, .gif, .bmp, .png, .pdf')\"/>";
                  } */
                ?>
                  </div>
                    </td>
                </tr>-->

                <?php
                if ($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['USER_EMP_ID'] == $_SESSION['EMP_ID']) {
                  ?>
                  <tr height="33">
                    <td  align="right" valign="middle" class="form_text">รูปถ่ายปัจจุบัน :</td>
                    <td align="left" valign="middle" style="color:#663; font-size:11px">
                      <div id="show_upload3">
                        <?
                        if ($row["BIO_PIC_FILE"] == "") {
                          ?>
                          <input type="file" name="bio_pic_file" id="bio_pic_file" class="b_gray"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this)"<?php } ?> />
                          เฉพาะ .jpg, .gif, .bmp, .png
                          <?
                        } else {
                          $file = $row["BIO_PIC_FILE"];
                          echo "<input type=\"file\" name=\"bio_pic_file\" id=\"bio_pic_file\" style=\"display:none\" class=\"file_upload\"/>";
                          echo "<span style='font-size: 14px'><img src=\"../images/person.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/bio_data_file/$file','bio_pic_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"Present Photo\" alt=\"Present Photo\"/></span> &nbsp;&nbsp;&nbsp;";
                          echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('3','bio_pic_file','$file','person.png','Present Photo',' เฉพาะ .jpg, .gif, .bmp, .png')\"/>";
                        }
                        ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" >&nbsp;</td>
                    <td align="left"  style="color:#663; font-size:11px">
                      <?
                      /* if($row["BIO_ID_CARD_FILE"] != ""){
                        echo "<input type='hidden' id='hid_bio_id_card_file' name='hid_bio_id_card_file' value='".$row["BIO_ID_CARD_FILE"]."' />";
                        }
                        if($row["BIO_ACC_BANK_FILE"] != ""){
                        echo "<input type='hidden' id='hid_bio_acc_bank_file' name='hid_bio_acc_bank_file' value='".$row["BIO_ACC_BANK_FILE"]."' />";
                        } */
                      if ($row["BIO_PIC_FILE"] != "") {
                        echo "<input type='hidden' id='hid_bio_pic_file' name='hid_bio_pic_file' value='" . $row["BIO_PIC_FILE"] . "' />";
                      }
                      ?>
                      * สามารถแก้ไขรูปภาพเดิมได้โดยอัพโหลดภาพใหม่เข้าไป<br />
                      ไฟล์จะอัพโหลดเสร็จสมบูรณ์หลังจากกดปุ่ม Save
                    </td>
                  </tr>
                  <?php if (($_SESSION['USER_TYPE'] != 'chief') || ($_SESSION['USER_EMP_ID'] == $_SESSION['EMP_ID'])) { ?>
                    <tr>
                      <td align="right" >
                        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png" onclick="o_input(); check_data(); chack_idcard();" border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                      </td>
                      <td align="left">
                        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0" onclick="document.getElementById('bio_data').reset()" style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('bio_data').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                      </td>
                    </tr>
                    <?php
                  }
                }
                ?>
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
<div id="dialog1" title="ระบบค้นหาประเทศ" style="display:none">
  <p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_nation1" name="search_nation1" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation1($('#search_nation1').val())"/>
  </p>
  <div id="result_search_nation1" align="center"></div>
</div>
<div id="dialog2" title="ระบบค้นหาประเทศ" style="display:none">
  <p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_nation2" name="search_nation2" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation2($('#search_nation2').val())"/>
  </p>
  <div id="result_search_nation2" align="center"></div>
</div>
<input type="hidden" id="chk_id_p_status" value="<? if($row["EMP"]!=""){ print "add"; }else{ print "edit";}?>"/>
<div id="Valid_chk_card">
หมายเลขบัตรประชาชนซ้ำ กรุณาเปลี่ยน
</div>

<?php
/* $db->closedb($conn);
  echo "</pre>";
  print_r($_SESSION); */
echo "</pre>";
?>