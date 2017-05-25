<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<? }
?>
<script type="text/javascript" language="javascript">
  function check_data(){
		
    if($("#edu_level").val() == "" || $("#edu_name").val() == ""  ||  $("#edu_name_short").val() == "" || $("#edu_gpa").val() == "" || $("#edu_country").val() == "" || $("#edu_year").val() == "" || $("#edu_major_name").val() == "" || $("#edu_from").val() == ""){
      $("#Please_fill_in").dialog('open');
      return false;
    }
		
    var count = document.getElementsByName("edu_file[]").length;
    var edu_file = document.education.elements["edu_file[]"];
    var i=0;
    while(i<count){
      if(edu_file[i].value != ""){
        if(!Checkfiles2(edu_file[i].value)){
          edu_file[i].value = "";
          $("#Valid_upl_file").dialog('open');
          return false;
        }

      }
      i++
    }
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("education").submit();
  }

  function get_short_name(name){
    var count = educationName.length;
    var shortname = "";
    for(var i = 0;i<count;i++){
      if(educationName[i] == name){
        shortname = educationShortName[i];
        break;
      }
    }
    $("#edu_name_short").val(shortname);
  }

  function search_nation10(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
    if(txt==""){
      alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
    }else{
      ajaxPostData("_find_nation10.php",data,"text","result_search_nation10",result_search_nation10,"","");
    }
  }

  function result_search_nation10(response){
    if(response == "0"){
      $('#result_search_nation10').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_nation10').html(response);
    }
  }

  function pick_nation10(id){
    var id_nation = $('#id'+id).val();
    var name_nation = $('#name'+id).val();
	
    $("span#nation10").html("<input type='hidden' id='edu_country' name='edu_country' value='"+id_nation+"' ><input type='text' value='"+name_nation+"' readonly='readonly' >");
	
    $("#search_nation10").val("");
    $("div#result_search_nation10").html("");
    $('#dialog_nation10').dialog('close');
  }

  function search_major1(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
    if(txt==""){
      alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
    }else{
      ajaxPostData("_find_major1.php",data,"text","result_search_major1",result_search_major1,"","");
    }
  }

  function result_search_major1(response){
    if(response == "0"){
      $('#result_search_major1').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_major1').html(response);
    }
  }

  function pick_major1(id){
    var id_major = $('#id'+id).val();
    var name_major = $('#name'+id).val();
	
    $("span#major1").html("<input type='hidden' id='edu_program' name='edu_program' value='"+id_major+"' ><input type='text' value='"+name_major+"' style='width: 200px;' readonly='readonly' >");
	
    $("#search_major1").val("");
    $("div#result_search_major1").html("");
    $('#dialog_major1').dialog('close');
  }

  function search_program(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
    if(txt==""){
      alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
    }else{
      ajaxPostData("_find_program.php",data,"text","result_search_program",result_search_program,"","");
    }
  }

  function result_search_program(response){
    if(response == "0"){
      $('#result_search_program').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_program').html(response);
    }
  }

  function pick_program(id){
    var id_program = $('#id'+id).val();
    var name_program = $('#name'+id).val();

    $("span#program").html("<input type='hidden' id='edu_major'  value='"+id_program+"' ><input type='text' id='edu_major_name' name='edu_major' value='"+name_program+"' style='width: 200px;' readonly='readonly' >");
	
    $("#search_program").val("");
    $("div#result_search_program").html("");
    $('#dialog_program').dialog('close');
  }

  $(function() {
    $('#dialog_nation10').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'500',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_nation10").val("");
          $("div#result_search_nation10").html("");
        }
      }
    });
		   
    $( "#opener10" ).click(function() {
      $( "#dialog_nation10" ).dialog( "open" );
      return false;
    });
		
    $('#dialog_major1').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'600',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_major1").val("");
          $("div#result_search_major1").html("");
        }
      }
    });
    
    $( "#major_opener1" ).click(function() {
      $( "#dialog_major1" ).dialog( "open" );
      return false;
    });


    $('#dialog_program').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'600',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_program").val("");
          $("div#result_search_program").html("");
        }
      }
    });

    $( "#program_opener" ).click(function() {
      $( "#dialog_program" ).dialog( "open" );
      return false;
    });
      
    
    $.post("ajax_get_data_ref.php", { task: "educationlist" },
    function(data) {
      course = $.parseJSON(data);
      $("#edu_name").autocomplete({
        source: course
      });
    });
   
    $.post("ajax_get_data_ref.php", { task: "universitylist" },
    function(data) {
      university = $.parseJSON(data);
      $("#edu_from").autocomplete({
        source: university
      });
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
		
    $('#Valid_upl_file').dialog({
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
		
    $("#addfile").click(function(){
      $("#morefile").after("<input type='file' name='edu_file[]'  class='file_upload'  /><br />");
      //var edu_file = document.getElementsByName("edu_file[]").length;
    });
  });
</script>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<table cellpadding="0" cellspacing="0" align="left" width="770">
  <tr><td width="768" >
      <div id="education_list" align="center" class="data_details_list">
        <? include "education_data_table.php"; ?>
      </div>
      <div align="center"  id="toggle_form"><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form2('education','edu_id')" style="cursor:pointer"/><?php } ?> &nbsp;</div>
      <div id="data_form"  style="display:none;"> 

        <img src="../images/bg_d.png" style="margin-left:16px;" />
        <table  cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td width="746" valign="top">
              <form id="education" name="education" enctype="multipart/form-data" method="post" action="education_data_save.php"  target="upload_target" >
                <table width="748" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="158" align="right" class="form_text"> </td>
                    <td width="386" align="left">
                      <input type="hidden" id="edu_id" name="edu_id" value=""/>
                    </td>
                    <td width="164" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">&nbsp;* ระดับการศึกษา :</td>
                    <td align="left">
                      <?
                      include "../includes/connect.php";
                      $sql_edu_level = "SELECT * FROM  " . TB_REF_LEV . "  ORDER BY LEV_NAME_TH ASC ";
                      $stid_edu_level = oci_parse($conn, $sql_edu_level);
                      oci_execute($stid_edu_level);
                      $option_edu_level = "<option value=''>เลือก</option>";
                      while (($row_edu_level = oci_fetch_array($stid_edu_level, OCI_BOTH))) {
                        $option_edu_level .= "<option value='" . $row_edu_level["LEV_ID"] . "' >" . $row_edu_level["LEV_NAME_TH"] . " (".$row_edu_level["LEV_NAME_ENG"].")</option>\n";
                      }
                      ?>
                      <select name="edu_level" id="edu_level" style="width:150px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                        <?= $option_edu_level ?>
                      </select>
                    </td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ประเทศ : </td>
                    <td align="left">
                      <?
                      /* 	$sql_edu_country = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC ";
                        $stid_edu_country = oci_parse($conn, $sql_edu_country);
                        oci_execute($stid_edu_country); */
                      $option_edu_country = "";
                      /* while(($row_edu_country = oci_fetch_array($stid_edu_country, OCI_BOTH))){
                        if($row_edu_country["NATION_NAME_TH"] == "" or $row_edu_country["NATION_NAME_TH"] == NULL) $name_country = $row_edu_country["NATION_NAME_ENG"];
                        else $name_country = $row_edu_country["NATION_NAME_TH"];
                        if($row_edu_country["NATION_ID"] == "TH") $selected = "selected='selected'"; else $selected="";
                        $option_edu_country .= "<option value='".$row_edu_country["NATION_ID"]."' $selected>".$name_country."</option>\n";
                        } */
                      ?>
                      <span id="nation10">
                      <!--<select name="edu_country" id="edu_country" style="width:140px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                        <?= $option_edu_country ?>
                         </select>-->
                        <input type="hidden" name="edu_country" id="edu_country" />
                        <input class="input_text" type="text" readonly='readonly' style="width:140px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />
                      </span> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener10"  title="ค้นหา"/><?php } ?>

                    </td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">&nbsp;* ชื่อเต็มของหลักสูตร :</td>
                    <td align="left"><input type="text" name="edu_name" id="edu_name" style="width: 210px; " class="input_text" onblur="get_short_name(this.value)" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">&nbsp;* ชื่อย่อของวุฒิ :</td>
                    <td align="left"><input type="text" name="edu_name_short" id="edu_name_short" style="width: 70px; " class="input_text" onfocus="get_short_name($('#edu_name').val())"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">&nbsp;* เกรดเฉลี่ย (GPA) :</td>
                    <td align="left"><input type="text" name="edu_gpa" id="edu_gpa" style="width: 50px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /></td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ปีที่สำเร็จการศึกษา :</td>
                    <td align="left"><!--<input type="text" name="edu_year" id="edu_year" style="width: 40px; "  maxlength="4" class="input_text"/>-->
                      <select id="edu_year" name="edu_year"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                        <option value="">เลือก</option>
                        <?
                        $year = date("Y") + 543;
                        for ($i = 0; $i < 70; $i++) {
                          $y = $year - $i;
                          echo "<option value='$y'>$y</option>\n";
                        }
                        ?>
                      </select>
                    </td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ชื่อเต็ม สาขา/วิชาเอก :</td>
                    <td align="left">
                      <span id="program">
                        <input type="hidden"  id="edu_major" />
                        <input onclick = "chk_th('edu_major_name')" type="text" value="" id='edu_major_name' name="edu_major" class="input_text" readonly='readonly' style="width: 200px;" />
                      </span>
                      <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                        <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="program_opener"  title="ค้นหา"/>
                      <?php } ?>
                    </td>
                    <td align="left">&nbsp;</td>
                  </tr>

                  <tr>
                    <td align="right" class="form_text">&nbsp;* กลุ่มสาขาวิชา :</td>
                    <td align="left">
                      <?
                      /* $sql_edu_program = "SELECT * FROM  ".TB_REF_ISCED."  ORDER BY ISCED_NAME_TH ASC "; ///isced
                        $stid_edu_program = oci_parse($conn, $sql_edu_program);
                        oci_execute($stid_edu_program); */
                      $option_edu_program = "";
                      /* while(($row_edu_program = oci_fetch_array($stid_edu_program, OCI_BOTH))){
                        $option_edu_program .= "<option value='".$row_edu_program["ISCED_ID"]."' >".$row_edu_program["ISCED_NAME_TH"]."</option>\n";
                        } */
                      ?>
                      <span id="major1">
                      <!--<select name="edu_program" id="edu_program" style="width: 200px" >
                        <?= $option_edu_program ?>
                          </select>-->
                        <input type="hidden" name="edu_program" id="edu_program" />
                        <input type="text" onclick = "chk_th('edu_program999')" class="input_text" value="" readonly='readonly' style="width: 200px;" id='edu_program999' />
                      </span><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?> <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="major_opener1"  title="ค้นหา"/><?php } ?>
                    </td>
                    <td align="left">&nbsp;</td>
                  </tr>

                  <tr>
                    <td align="right" class="form_text">* มหาวิทยาลัย/สถาบัน :</td>
                    <td colspan="2" align="left"><input type="text" name="edu_from" id="edu_from" style="width: 370px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                  </tr>
                  <tr id="up_row">
                    <td align="right" class="form_text" valign="top">แนบไฟล์เอกสาร : </td>
                    <td colspan="2" align="left" style="color:#663; font-size:11px" valign="top">
                      <input type="file" name="edu_file[]"  class="file_upload"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/><br />
                      <input type="file" name="edu_file[]"  class="file_upload"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/><br />
                      <input type="file" name="edu_file[]"  class="file_upload"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/><br />
                      <span  id="morefile"></span>
                      <input type="button" id="addfile"  value="เพิ่มไฟล์แนบ" style="height: 23px;"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/>
                      <br />
                      เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx</td>
                  </tr>
                  <tr>
                    <td align="right" >&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                    <tr>
                      <td height="44" align="right" valign="top" >
                        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                      </td>
                      <td colspan="2" align="left" valign="top">

                        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('education.php','../images/head2/work_data/education.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>

                      </td>
                    </tr> <?php } ?>
                  <tr>
                    <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
                  </tr>
                </table>
              </form>

            </td>
          </tr>

        </table>
      </div>
    </td>
  </tr>  
</table>


<table>
</table>
<div id="dialog_major1" title="ระบบค้นหาสาขาวิชา" style="display:none">
  <p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_major1" name="search_major1" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_major1($('#search_major1').val())"/>
  </p>
  <div id="result_search_major1" align="center"></div>
</div>

<div id="dialog_program" title="ระบบค้นหาสาขา/วิชาเอก" style="display:none">
  <p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_program" name="search_program" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_program($('#search_program').val())"/>
  </p>
  <div id="result_search_program" align="center"></div>
</div>

<div id="dialog_nation10" title="ระบบค้นหาประเทศ" style="display:none">
  <p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_nation10" name="search_nation10" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation10($('#search_nation10').val())"/>
  </p>
  <div id="result_search_nation10" align="center"></div>
</div>
<?
$db->closedb($conn);
?>
<script>
function chk_th(id){
	//alert($("#edu_country").val());
	if($("#edu_country").val()!="TH" && $("#edu_country").val()!=""){
		//alert(id);
		$("#"+id).attr('readonly', false);
	}else{
		$("#"+id).attr('readonly', 'readonly');
	}
}
</script>