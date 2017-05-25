<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
   ?>
   <script language="javascript">
      window.location = "/e_profile" ;
   </script>
<? } ?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<script  type="text/javascript" language="javascript">
   function cen_address(){
      $("#fam_house_no").val($("#ca_house_no").html());
      $("#fam_moo").val($("#ca_moo").html());
      $("#fam_building").val($("#ca_building").html());
      $("#fam_village").val($("#ca_village").html());
      $("#fam_room").val($("#ca_room").html());
      $("#fam_soi").val($("#ca_soi").html());
      $("#fam_road").val($("#ca_road").html());
      /*$("#fam_tumbon").val($("#ca_tumbon").html());
$("#fam_amphur").val($("#ca_amphur").html());
$("select#fam_province").val($("#ca_province").html());*/ 


      $("span#tumbon2").html($("div#ca_tumbon").html());
      $("div#amphur2").html($("div#ca_amphur").html());
      $("div#province2").html($("div#ca_province").html());
      $("#fam_post_code").val($("#ca_post_code").html());
		$("span#nation5").html($("div#ca_country").html());



   }


   function swap_fam_title_th(){
      var value = $("select#fam_title_th").val();
      switch (value){
         case "0": $("select#fam_title_en").val("0"); 
            break;
         case "นาย": $("select#fam_title_en").val("Mr."); document.fam_data.fam_sex[0].checked="checked";
            break;
         case "นาง": $("select#fam_title_en").val("Mrs.");document.fam_data.fam_sex[1].checked="checked";
            break;
         case "น.ส.": $("select#fam_title_en").val("MISS");document.fam_data.fam_sex[1].checked="checked";
            break;
      }

   }

   function swap_fam_title_en(){
      var value = $("select#fam_title_en").val();
      switch (value){
         case "0": $("select#fam_title_th").val("0"); 
            break;
         case "Mr.": $("select#fam_title_th").val("นาย"); document.fam_data.fam_sex[0].checked="checked";
            break;
         case "Mrs.": $("select#fam_title_th").val("นาง");document.fam_data.fam_sex[1].checked="checked";
            break;
         case "MISS": $("select#fam_title_th").val("น.ส.");document.fam_data.fam_sex[1].checked="checked";
            break;
      }

   }

   function check_data(){
      if($("#fam_relation").val() == "0" || $("#fam_title_th").val() == "0" || $("#fam_fname_th").val() == "" || $("#fam_lname_th").val() == "" || $("#fam_fname_en").val() == "" || $("#fam_lname_en").val() == "" || $("#fam_sex").val() == "" || $("#fam_birthday").val() == ""){
         $("#Please_fill_in").dialog('open');
         return false;
      }
	
      /*if(!Checkfiles($("input#fam_cen_file"))){
                        $("input#fam_cen_file").val("");
                        $("#Valid_cen_file").dialog('open');
                        return false;
            }*/
      $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      document.getElementById("family_data").submit();
	
		
   }

   function search_tumbon3(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_location3.php",data,"text","result_search_address3",result_search_tumbon3,"","");
      }
   }

   function result_search_tumbon3(response){
      if(response == "0"){
         $('#result_search_address3').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_address3').html(response);
      }
   }

   function pick_location3(id){
      var tumbon = $('#t'+id).val();
      var amphur = $('#a'+id).val();
      var province = $('#p'+id).val();
      var postcode = $('#c'+id).val();
      var n1 = $('#n1'+id).val();
      var n2 = $('#n2'+id).val();
      var n3 = $('#n3'+id).val();
	
      $("span#tumbon2").html("<input type='hidden' id='fam_tumbon' name='fam_tumbon' style='width: 130px' value='"+tumbon+"'><input readonly='readonly' type='text' value='"+n1+"'>");
      $("div#amphur2").html("<input type='hidden' id='fam_amphur' name='fam_amphur' style='width: 130px' value='"+amphur+"'><input readonly='readonly' type='text' value='"+n2+"'>");
      $("div#province2").html("<input type='hidden' id='fam_province' name='fam_province' style='width: 130px' value='"+province+"'><input  readonly='readonly' type='text' value='"+n3+"'>");
     $("#fam_post_code").val(postcode);
      $("#search_location3").val("");
      $("div#result_search_address3").html("");
      $('#dialog_address3').dialog('close');
   }

   function search_nation3(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation3.php",data,"text","result_search_nation3",result_search_nation3,"","");
      }
   }

   function result_search_nation3(response){
      if(response == "0"){
         $('#result_search_nation3').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation3').html(response);
      }
   }

   function pick_nation3(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      //$("span#nation3").html("<select id='fam_nation1' name='fam_nation1' style='width: 130px' ><option value='"+id_nation+"' selected='selected'>"+name_nation+"</option></select>");
	
      $("span#nation3").html("<input type='hidden' id='fam_nation1' name='fam_nation1' value='"+id_nation+"' style='width: 130px' ><input readonly='readonly' type='text' value='"+name_nation+"' style='width: 130px' >");
	
      $("#search_nation3").val("");
      $("div#result_search_nation3").html("");
      $('#dialog_nation3').dialog('close');
   }

   function search_nation4(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation4.php",data,"text","result_search_nation4",result_search_nation4,"","");
      }
   }

   function result_search_nation4(response){
      if(response == "0"){
         $('#result_search_nation4').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation4').html(response);
      }
   }

   function pick_nation4(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      $("span#nation4").html("<input type='hidden' id='fam_nation2' name='fam_nation2' value='"+id_nation+"' style='width: 130px' ><input type='text' value='"+name_nation+"' readonly='readonly' style='width: 130px' >");
	
      $("#search_nation4").val("");
      $("div#result_search_nation4").html("");
      $('#dialog_nation4').dialog('close');
   }

   function search_nation5(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation5.php",data,"text","result_search_nation5",result_search_nation5,"","");
      }
   }

   function result_search_nation5(response){
      if(response == "0"){
         $('#result_search_nation5').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation5').html(response);
      }
   }

   function pick_nation5(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      $("span#nation5").html("<input type='hidden' value='"+id_nation+"' id='fam_country' name='fam_country' style='width: 130px' ><input type='text' id='fam_country_text' value='"+name_nation+"' readonly='readonly'>");
	
      $("#search_nation5").val("");
      $("div#result_search_nation5").html("");
      $('#dialog_nation5').dialog('close');
   }

   $(function(){
      $('#dialog_address3').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '300',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_location3").val("");
               $("div#result_search_address3").html("");
            }
         }
      });

		
      $( "#opener_address3" ).click(function() {
         $( "#dialog_address3" ).dialog( "open" );
         return false;
      });
		
      $('#dialog_nation3').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation3").val("");
               $("div#result_search_nation3").html("");
            }
         }
      });
		
      $('#dialog_nation4').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation4").val("");
               $("div#result_search_nation4").html("");
            }
         }
      });
		
      $('#dialog_nation5').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation5").val("");
               $("div#result_search_nation5").html("");
            }
         }
      });
		
      $( "#opener3" ).click(function() {
         $( "#dialog_nation3" ).dialog( "open" );
         return false;
      });
		
      $( "#opener4" ).click(function() {
         $( "#dialog_nation4" ).dialog( "open" );
         return false;
      });
		
      $( "#opener5" ).click(function() {
         $( "#dialog_nation5" ).dialog( "open" );
         return false;
      });
		
      $("#fam_id_from").autocomplete({
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
            
            
            
      // ความสัมพันธ์
      if($('#fam_relation').val()==3){
         $('#marriage_cer').show();
      }else {
         $('#marriage_cer').hide();
      }
     
      $('#fam_relation').change(function() {
         if($('#fam_relation').val()==3){
            $('#marriage_cer').show();
         }else {
            $('#marriage_cer').hide();
            $('#FAM_MARRIAGE_CER').removeAttr('checked'); 
         }
      });
			
      // End จบความสัมพันธ์
   });

</script>
<div style="display:none">

   <div id="dialog_address3" title="ระบบค้นหาที่อยู่">
      <p align="center">
         กรอกตำบล : <input type="text" id="search_location3" name="search_location3" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_tumbon3($('#search_location3').val())"/>
      </p>
      <div id="result_search_address3" align="center"></div>
   </div>

</div>

<table cellpadding="0" cellspacing="0" align="center" width="758" >
   <tr><td >
         <div id="family_list" align="center" class="data_details_list">
            <? include "family_data_table.php"; ?>
         </div>
         <div align="center"  id="toggle_form"><?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('family_data','')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
         <div id="data_form" style="display:none;">    
            <table  cellspacing="0" cellpadding="0" align="center" border="0"> 
               <tr>
                  <td>

                     <img src="../images/bg_d.png" style="margin-left:10px;" />

                     <form id="family_data" name="family_data" enctype="multipart/form-data" method="post" action="family_data_save.php" target="upload_target">
                        <table width="100%" border="0" cellspacing="4" cellpadding="4">
                           <tr>
                              <td align="right" class="form_text" width="176">* ความสัมพันธ์ : </td>
                              <td colspan="2" align="left" class="form_text">
                                 <select name="fam_relation" id="fam_relation"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <option value="0">เลือก</option>
                                    <option value="1">บิดา</option>
                                    <option value="2">มารดา</option>
                                    <option value="3">คู่สมรส</option>
                                 </select>
                                 <span id="marriage_cer"><input type="checkbox" value="Y" id="FAM_MARRIAGE_CER" name="FAM_MARRIAGE_CER" /> จดทะเบียนสมรสตามกฏหมาย</span>
                              </td>
                           </tr>
                           <tr>
                              <td  align="right" class="form_text">* คำนำหน้า :</td>
                              <td colspan="2" >
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="14%">
                                          <select name="fam_title_th" id="fam_title_th" onchange="swap_fam_title_th()"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <option value="0">เลือก</option>
                                             <option value="นาย" <? if ($row["FAM_TITLE_TH"] == "นาย") { echo "selected='selected'"; } ?>>นาย</option>
                                             <option value="นาง" <? if ($row["FAM_TITLE_TH"] == "นาง") { echo "selected='selected'"; } ?>>นาง</option>
                                             <option value="น.ส." <? if ($row["FAM_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>นางสาว</option>
                                          </select>
                                       </td>
                                       <td width="7%" align="right" class="form_text">ชื่อ : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="fam_fname_th" id="fam_fname_th" style="width: 80px;" class="input_text" onkeyup="chkTh('fam_fname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="14%" align="right" class="form_text">ชื่อกลาง : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="fam_mname_th" id="fam_mname_th" style="width: 80px;" class="input_text" onkeyup="chkTh('fam_mname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /></td>
                                       <td width="13%" align="right" class="form_text">นามสกุล : &nbsp;</td>
                                       <td width="22%" class="form_text"><input type="text" name="fam_lname_th" id="fam_lname_th" style="width: 80px;" class="input_text" onkeyup="chkTh('fam_lname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /></td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* Title :</td>
                              <td colspan="2">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="12%">
                                          <select name="fam_title_en" id="fam_title_en" onchange="swap_fam_title_en()"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <option value="0">เลือก</option>
                                             <option value="Mr." <? if ($row["FAM_TITLE_EN"] == "Mr.") { echo "selected='selected'"; } ?>>Mr.</option>
                                             <option value="Mrs." <? if ($row["FAM_TITLE_EN"] == "Mrs.") { echo "selected='selected'"; } ?>>Mrs.</option>
                                             <option value="MISS" <? if ($row["FAM_TITLE_EN"] == "MISS") { echo "selected='selected'"; } ?>>Miss</option>
                                          </select>
                                       </td>
                                       <td width="11%" align="right" class="form_text">Fname : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="fam_fname_en" id="fam_fname_en" style="width: 80px;" class="input_text" onkeyup="chkEn('fam_fname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /></td>
                                       <td width="13%" align="right" class="form_text">Mname : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="fam_mname_en" id="fam_mname_en" style="width: 80px;" class="input_text" onkeyup="chkEn('fam_mname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /></td>
                                       <td width="13%" align="right" class="form_text">Lname : &nbsp;</td>
                                       <td width="21%"><input type="text" name="fam_lname_en" id="fam_lname_en" style="width: 80px;" class="input_text" onkeyup="chkEn('fam_lname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* เพศ :</td>
                              <td colspan="2" align="left" class="form_text"><input name="fam_sex" type="radio" id="fam_sex"  value="male"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/>  ชาย <input type="radio" name="fam_sex" id="fam_sex" value="female"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> />  หญิง</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">เชื้อชาติ :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="30%" align="left">
                                          <?
                                          /* $sql_fam_nation1 = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                            $stid_fam_nation1 = oci_parse($conn, $sql_fam_nation1);
                                            oci_execute($stid_fam_nation1); */
                                          $option_fam_nation1 = "";
                                          /* while(($row_fam_nation1 = oci_fetch_array($stid_fam_nation1, OCI_BOTH))){
                                            if($row_fam_nation1["NATION_NAME_TH"] == "" or $row_fam_nation1["NATION_NAME_TH"] == NULL) $name_country = $row_fam_nation1["NATION_NAME_ENG"];
                                            else $name_country = $row_fam_nation1["NATION_NAME_TH"];
                                            $option_fam_nation1 .= "<option value='".$row_fam_nation1["NATION_ID"]."' >".$name_country."</option>\n";
                                            } */
                                          ?>
                                <span id="nation3"><!--<select name="fam_nation1" id="fam_nation1" style="width: 130px" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <?= $option_fam_nation1 ?>
                                       </select>-->
                                             <input type="hidden" name="fam_nation1" id="fam_nation1" value="<?= $row_fam_nation1["NATION_ID"] ?>" style="width: 130px" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />
                                             <input type="text" name="fam_nation1" id="fam_nation1" readonly='readonly' style="width: 130px" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> value="<?= $name_country ?>" />
                                          </span><?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?> <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener3"  title="ค้นหา"/><?php } ?>
                                       </td>
                                       <td width="13%" align="right" class="form_text">สัญชาติ : &nbsp;</td>
                                       <td width="33%" align="left">
                                          <?
                                          /*  $sql_fam_nation2 = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                            $stid_fam_nation2 = oci_parse($conn, $sql_fam_nation2);
                                            oci_execute($stid_fam_nation2);
                                            $option_fam_nation2="<option value=''>เลือก</option>";
                                            while(($row_fam_nation2 = oci_fetch_array($stid_fam_nation2, OCI_BOTH))){
                                            if($row_fam_nation2["NATION_NAME_TH"] == "" or $row_fam_nation2["NATION_NAME_TH"] == NULL) $name_country = $row_fam_nation2["NATION_NAME_ENG"];
                                            else $name_country = $row_fam_nation2["NATION_NAME_TH"];
                                            $option_fam_nation2 .= "<option value='".$row_fam_nation2["NATION_ID"]."' >".$name_country."</option>\n";
                                            } */
                                          ?>
                                <span id="nation4"><!--<select name="fam_nation2" id="fam_nation2" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <?= $option_fam_nation1 ?>
                                       </select>-->
                                             <input type="hidden" name="fam_nation2" value="<?= $row_fam_nation2["NATION_ID"] ?>" id="fam_nation2" style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />
                                             <input type="text" readonly='readonly' style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> value="<?= $name_country ?>" />

                                          </span><?php if (  $_SESSION['USER_TYPE'] != 'chief') { ?> <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener4"  title="ค้นหา"/><?php } ?>

                                       </td>
                                       <td width="1%" align="right" class="form_text">&nbsp;</td>
                                       <td width="23%" align="left">&nbsp;</td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ศาสนา :</td>
                              <td colspan="2" align="left">
                                 <?
                                 $sql_fam_religion = "SELECT * FROM  " . TB_REF_RELIGION . "  ORDER BY RELIGION_ID ASC ";
                                 $stid_fam_religion = oci_parse($conn, $sql_fam_religion);
                                 oci_execute($stid_fam_religion);
                                 $option_fam_religion = "<option value=''>เลือก</option>";
                                 while (($row_fam_religion = oci_fetch_array($stid_fam_religion, OCI_BOTH))) {
                                    $option_fam_religion .= "<option value='" . $row_fam_religion["RELIGION_ID"] . "' >" . $row_fam_religion["RELIGION_NAME_TH"] . "</option>\n";
                                 }
                                 ?>
                                 <select name="fam_religion" id="fam_religion" class="widthFix"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_fam_religion ?>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* ว/ด/ป เกิด :</td>
                              <td colspan="2" align="left"><input name="fam_birthday" onblur="Age('fam_birthday','fam_s_year','fam_s_month')" type="text" class="input_text" id="fam_birthday" style="width: 80px;"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('fam_birthday','YYYY-MM-DD');$('#fam_birthday').focus()"  style="cursor:pointer"/><?php } ?> ex. 15/10/2553 
                                 &nbsp; &nbsp;สถานะ : <input name="fam_alive" type="radio" id="fam_alive" value="1" checked="checked"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /> มีชีวิต <input type="radio" id="fam_alive" name="fam_alive" value="2"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /> ถึงแก่กรรม  <input type="radio" id="fam_alive" name="fam_alive" value="3"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /> สาบสูญ</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ปัจจุบันอายุ :</td>
                              <td colspan="2" align="left" class="form_text"><input type="text"  style="width: 25px; border:none;" readonly class="input_text" name="fam_s_year" id="fam_s_year" onfocus="Age('fam_birthday','fam_s_year','fam_s_month')"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> ปี <input type="text"  style="width: 25px; border:none;" class="input_text" readonly name="fam_s_month" id="fam_s_month" onfocus="Age('fam_birthday','fam_s_year','fam_s_month')"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> เดือน</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">สถานภาพ : </td>
                              <td colspan="2" align="left"><select name="fam_status" id="fam_status"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <option value="0">เลือก</option>
                                    <option value="1">โสด</option>
                                    <option value="2">สมรส</option>
                                    <option value="3">หย่า</option>
                                    <option value="4">หม้าย</option>
                                 </select></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text"> เลขประจำตัวประชาชน :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="22%" align="left"><input name="fam_code_id" type="text" class="input_text" id="fam_code_id" style="width: 120px;" onkeyup="chkNum('fam_code_id','OnlyNm');" maxlength="13"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="16%" align="right" class="form_text">ออกให้ ณ : &nbsp;</td>
                                       <td width="18%"><input type="text" name="fam_id_from" id="fam_id_from" style="width: 100px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>></td>
                                       <td width="12%" align="right" class="form_text">จังหวัด : &nbsp;</td>
                                       <td width="32%">
                                          <?
                                          $sql_fam_id_from_p = "SELECT * FROM  " . TB_REF_PROVINCE . "  ORDER BY NAME_REF_PROVINCE ASC ";
                                          $stid_fam_id_from_p = oci_parse($conn, $sql_fam_id_from_p);
                                          oci_execute($stid_fam_id_from_p);
                                          $option_fam_id_from_p = "<option value='0'>เลือก</option>";
                                          while (($row_fam_id_from_p = oci_fetch_array($stid_fam_id_from_p, OCI_BOTH))) {
                                             $option_fam_id_from_p .= "<option value='" . $row_fam_id_from_p["CODE_REF_PROVINCE"] . "' >" . $row_fam_id_from_p["NAME_REF_PROVINCE"] . "</option>\n";
                                          }
                                          ?>
                                          <select name="fam_id_from_p" id="fam_id_from_p" class="widthFix"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <?= $option_fam_id_from_p ?>
                                          </select>
                                       </td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">วันออกบัตร :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="22%" align="left"><input name="fam_id_date_begin" type="text"  class="input_text" id="fam_id_date_begin" style="width: 80px;"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('fam_id_date_begin','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                                       <td width="25%" align="right" class="form_text">วันบัตรหมดอายุ :&nbsp; </td>
                                       <td width="53%" align="left"><input name="fam_id_date_exp" type="text"  class="input_text" id="fam_id_date_exp" style="width: 80px;"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('fam_id_date_exp','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">อาชีพ :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="27%" align="left"><input type="text" name="fam_occupation" id="fam_occupation" style="width: 150px;"  class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="19%" align="right" class="form_text">สถานที่ทำงาน :&nbsp; </td>
                                       <td width="54%" align="left"><input type="text" name="fam_work_place" id="fam_work_place" style="width: 250px;"  class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์มือถือ :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_mobile" id="fam_mobile" style="width: 110px;"  class="input_text" onkeyup="chkNum('fam_mobile','OnlyNm');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์ที่ทำงาน :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_work_phone" id="fam_work_phone" style="width: 110px;"  class="input_text" onkeyup="chkNum('fam_work_phone','OnlyNm');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์บ้าน :</td>
                              <td colspan="2" align="left"><input name="fam_phone" type="text"  class="input_text" id="fam_phone" style="width: 110px;" onkeyup="chkNum('fam_phone','OnlyNm');" maxlength="7"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรสาร :</td>
                              <td colspan="2" align="left"><input name="fam_fax" type="text"  class="input_text" id="fam_fax" style="width: 110px;" onkeyup="chkNum('fam_fax','OnlyNm');" maxlength="7"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">e-mail :</td>
                              <td colspan="2" align="left" class="form_text"><input type="text" name="fam_email" id="fam_email" style="width: 100px;"  class="input_text" onblur="chkEml('fam_email','ValidEml');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td height="35" colspan="3" align="left"  style="padding-left:30px">
                                 <div class="head2" align="left">ที่อยู่ปัจจุบัน</div>
                              </td>
                           </tr>
                           <tr>
                              <td width="176" align="right" class="form_text">บ้านเลขที่ :</td>
                              <td width="130" align="left"><input type="text" name="fam_house_no" id="fam_house_no" style="width: 100px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                              <td width="410" align="left"><div style="background-color:#6FF; cursor:pointer;width:140px; " onclick="cen_address()">ใช้ที่อยู่เดียวกับทะเบียนบ้าน</div></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">หมู่ :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_moo" id="fam_moo" style="width: 80px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ตึก/อาคาร :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_building" id="fam_building" style="width: 120px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">หมู่บ้าน :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_village" id="fam_village" style="width: 120px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ห้อง :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_room" id="fam_room" style="width: 120px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ซอย :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_soi" id="fam_soi" style="width: 120px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ถนน :</td>
                              <td colspan="2" align="left"><input type="text" name="fam_road" id="fam_road" style="width: 120px;" class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ตำบล/แขวง :</td>
                              <td align="left" valign="middle">
                                 <span id='tumbon2'>
                                    <!--
                                    <select name="fam_tumbon" id="fam_tumbon" style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <option value="" ></option>
                                      </select>-->
                                    <input type="hidden" name="fam_tumbon" id="fam_tumbon" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> <?php } ?>>
                                    <input type="text" class="input_text" readonly='readonly'  style="width: 120px"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                 </span></td>
                              <td align="left" valign="middle"><?php if ($_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="middle" style="cursor:pointer" id="opener_address3" title="ค้นหา"/><?php } ?></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">อำเภอ/เขต :</td>
                              <td colspan="2" align="left">
                                 <div id="amphur2">
                                    <!--
                                    <select name="fam_amphur" id="fam_amphur" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
	<option value="" ></option>
                                        </select>
                                    -->
                                    <input type="hidden" name="fam_amphur" id="fam_amphur" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> <?php } ?>>
                                    <input type="text" class="input_text" readonly='readonly' style="width: 120px" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">จังหวัด :</td>
                              <td colspan="2" align="left">
                                 <div id="province2">
                                    <!--
                                   <select name="fam_province" id="fam_province" style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
	<option value="" ></option>
                                       </select>
                                    -->
                                    <input type="hidden" name="fam_province" id="fam_province" style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> <? } ?>>
                                    <input type="text" readonly='readonly' class="input_text" style="width: 120px" <?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">รหัสไปรษณีย์ :</td>
                              <td colspan="2" align="left"><input class="input_text" type="text" name="fam_post_code" id="fam_post_code" style="width: 50px;" maxlength="5" class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ประเทศ :</td>
                              <td colspan="2" align="left" >
                                 <?
                                 /*  $sql_fam_country = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                   $stid_fam_country = oci_parse($conn, $sql_fam_country);
                                   oci_execute($stid_fam_country);
                                   $option_fam_country="<option value=''>เลือก</option>";
                                   while(($row_fam_country = oci_fetch_array($stid_fam_country, OCI_BOTH))){
                                   if($row_fam_country["NATION_NAME_TH"] == "" or $row_fam_country["NATION_NAME_TH"] == NULL) $name_country = $row_fam_country["NATION_NAME_ENG"];
                                   else $name_country = $row_fam_country["NATION_NAME_TH"];
                                   $option_fam_country .= "<option value='".$row_fam_country["NATION_ID"]."'>".$name_country ."</option>\n";
                                   } */
                                 ?>
                           <span id="nation5"><!--<select name="fam_country" id="fam_country" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_fam_nation1 ?>
                                  </select>-->
                                    <input type="hidden"  name="fam_country" id="fam_country"  style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> <? } ?>>
                                    <input type="text" class="input_text" id="fam_country_text" readonly='readonly' style="width: 120px" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                 </span> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener5"  title="ค้นหา"/><?php } ?>

                              </td>
                           </tr>
                          <!-- <tr>
                             <td height="20" align="right" class="form_text">ไฟล์ดิจิตอล ทะเบียนบ้าน :</td>
                             <td colspan="2" align="left" style="color:#663; font-size:11px"><input type="file" name="fam_cen_file" id="fam_cen_file" class="file_upload"/> เฉพาะ .jpg, .gif, .bmp, .png, .pdf</td>
                           </tr>-->

                           <tr>
                              <td align="right" >&nbsp;<input type='text' id='hid_fam_cen_file' name='hid_fam_cen_file' style="display:none"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?> /></td>
                              <td colspan="2" align="left">
                                 <?
                                 /*  if($row["fam_cen_file"] != ""){
                                   echo "<input type='hidden' id='hid_fam_cen_file' name='hid_fam_cen_file' value='".$row["fam_cen_file"]."' />";
                                   } */
                                 ?>
                              </td>
                           </tr>
                           <?php if ($_SESSION['USER_TYPE'] != '') { ?>
                              <tr>
                                 <td align="right" >
                                    <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                                    <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none"  onclick="check_data();" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                                 </td>
                                 <td colspan="2" align="left">
                                    <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                                    <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('family_data.php','../images/head2/bio/family.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>





                                 </td>
                              </tr><?php } ?> &nbsp;
                           <tr>
                              <td colspan="3" align="left" style="padding-left:50px; color:#06C">&nbsp;<span id="waiting"></span></td>
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
<div id="dialog_nation3" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation3" name="search_nation3" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation3($('#search_nation3').val())"/>
   </p>
   <div id="result_search_nation3" align="center"></div>
</div>

<div id="dialog_nation4" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation4" name="search_nation4" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation4($('#search_nation4').val())"/>
   </p>
   <div id="result_search_nation4" align="center"></div>
</div>

<div id="dialog_nation5" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation5" name="search_nation5" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation5($('#search_nation5').val())"/>
   </p>
   <div id="result_search_nation5" align="center"></div>
</div>

<?
$sql = "SELECT * FROM  " . TB_CEN_ADDRESS_TAB . "  WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'";

$row = $db->fetch($sql, $conn);
?>
<div style="display:none">
   <div id="ca_house_no"><?= $row["CA_HOUSE_NO"] ?></div>
   <div id="ca_moo"><?= $row["CA_MOO"] ?></div>
   <div id="ca_building"><?= $row["CA_BUILDING"] ?></div>
   <div id="ca_village"><?= $row["CA_VILLAGE"] ?></div>
   <div id="ca_room"><?= $row["CA_ROOM"] ?></div>
   <div id="ca_soi"><?= $row["CA_SOI"] ?></div>
   <div id="ca_road"><?= $row["CA_ROAD"] ?></div>
   <div id="ca_tumbon"><input type="hidden"   value="<?= $row["CA_TUMBON"] ?>" id="fam_tumbon" name="fam_tumbon" style='width: 110px'><input type="text" value="<?= get_tumbon_name($row["CA_TUMBON"], TB_REF_TUMBON) ?>" style="width: 120px" readonly='readonly' /></div>
   <div id="ca_amphur"><input type="hidden" id="fam_amphur" name="fam_amphur" style='width: 110px' value="<?= $row["CA_AMPHUR"] ?>"><input type="text" value="<?= get_amphur_name($row["CA_AMPHUR"], TB_REF_AMPHUR) ?>" style="width: 120px" readonly='readonly' /></div>
   <div id="ca_province"><input type="hidden" id="fam_province" name="fam_province" style='width: 130px' value="<?= $row["CA_PROVINCE"] ?>"><input type="text" value="<?= get_province_name($row["CA_PROVINCE"], TB_REF_PROVINCE) ?>" style="width: 120px" readonly='readonly' /></div>
   <div id="ca_post_code"><?= $row["CA_POST_CODE"] ?></div>
   
   <div id="ca_country"><input type="hidden" id="fam_country" name="fam_country" style='width: 130px' value="<?= $row["CA_COUNTRY"] ?>"><input type="text" id="fam_country_text" value="<?= get_nation_name($row["CA_COUNTRY"], TB_REF_NATION) ?>" style="width: 120px" readonly='readonly' /></div>

</div>

<?
$db->closedb($conn);
?>