<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
   ?>
   <script language="javascript">
      window.location = "/e_profile" ;
   </script>
<? } ?>
<script  type="text/javascript" language="javascript">
   function cen_address(){
      $("#chl_house_no").val($("#ca_house_no").html());
      $("#chl_moo").val($("#ca_moo").html());
      $("#chl_building").val($("#ca_building").html());
      $("#chl_village").val($("#ca_village").html());
      $("#chl_room").val($("#ca_room").html());
      $("#chl_soi").val($("#ca_soi").html());
      $("#chl_road").val($("#ca_road").html());
      /*$("#chl_tumbon").val($("#ca_tumbon").html());
$("#chl_amphur").val($("#ca_amphur").html());
$("select#chl_province").val($("#ca_province").html());*/

      $("span#tumbon2").html($("div#ca_tumbon").html());
      $("div#amphur2").html($("div#ca_amphur").html());
      $("div#province2").html($("div#ca_province").html());
      $("#chl_post_code").val($("#ca_post_code").html());
  
	  $("span#nation8").html($("div#ca_country").html());   
   
   }

   function swap_chl_title_th(){
      var value = $("select#chl_title_th").val();
      switch (value){
         case "0": $("select#chl_title_en").val("0"); 
            break;
         case "นาย": $("select#chl_title_en").val("Mr."); document.children_data.chl_sex[0].checked="checked";
            break;
         case "นาง": $("select#chl_title_en").val("Mrs.");document.children_data.chl_sex[1].checked="checked";
            break;
         case "น.ส.": $("select#chl_title_en").val("MISS");document.children_data.chl_sex[1].checked="checked";
            break;
         case "ด.ช.": $("select#chl_title_en").val("Mr.");document.children_data.chl_sex[0].checked="checked";
            break;
         case "ด.ญ.": $("select#chl_title_en").val("MISS");document.children_data.chl_sex[1].checked="checked";
            break;
      }

   }

   function swap_chl_title_en(){
      var value = $("select#chl_title_en").val();
      switch (value){
         case "0": $("select#chl_title_th").val("0"); 
            break;
         case "Mr.": $("select#chl_title_th").val("นาย"); document.children_data.chl_sex[0].checked="checked";
            break;
         case "Mrs.": $("select#chl_title_th").val("นาง");document.children_data.chl_sex[1].checked="checked";
            break;
         case "MISS": $("select#chl_title_th").val("น.ส.");document.children_data.chl_sex[1].checked="checked";
            break;
      }

   }


   function check_data(){

      if(chack_idcrad("chl_code_id")!=true){
         $('#user_idcard').dialog({
            autoOpen: false,
            modal: true,
            hide: 'slide',
            show: 'slide',
            width:'300',
            height: '150',
            buttons: {
               ปิด: function() {
                  $(this).dialog('close');
               }
            }
         });
				
         $('#user_idcard').dialog("open");
         return false;
      }
      else{
         if($("#chl_title_th").val() == "0" || $("#chl_fname_th").val() == "" || $("#chl_lname_th").val() == "" || $("#chl_fname_en").val() == "" || $("#chl_lname_en").val() == "" || $("#chl_sex").val() == "" || $("#chl_birthday").val() == "" || $("#chl_code_id").val() == ""){
            $("#Please_fill_in").dialog('open');
            return false;
         }
      }
	
      /*if(!Checkfiles($("input#chl_cen_file"))){
                        $("input#chl_cen_file").val("");
                        $("#Valid_cen_file").dialog('open');
                        return false;
            }*/
      $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      document.getElementById("children_data").submit();
   }

   function search_tumbon4(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_location4.php",data,"text","result_search_address4",result_search_tumbon4,"","");
      }
   }

   function result_search_tumbon4(response){
      if(response == "0"){
         $('#result_search_address4').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_address4').html(response);
      }
   }

   function pick_location4(id){
      var tumbon = $('#t'+id).val();
      var amphur = $('#a'+id).val();
      var province = $('#p'+id).val();
      var postcode = $('#c'+id).val();
      var n1 = $('#n1'+id).val();
      var n2 = $('#n2'+id).val();
      var n3 = $('#n3'+id).val();
	
      $("span#tumbon2").html("<input type='hidden' id='chl_tumbon' name='chl_tumbon' value='"+tumbon+"'><input style='width: 120px;' type='text' value='"+n1+"' readonly='readonly' >");
      $("div#amphur2").html("<input type='hidden' id='chl_amphur' name='chl_amphur' value='"+amphur+"'><input style='width: 120px;' type='text' value='"+n2+"' readonly='readonly' >");
      $("div#province2").html("<input type='hidden' id='chl_province' name='chl_province' value='"+province+"'><input style='width: 120px;' type='text' value='"+n3+"' readonly='readonly' >");
     $("#chl_post_code").val(postcode);
      $("#search_location4").val("");
      $("div#result_search_address4").html("");
      $('#dialog_address4').dialog('close');
   }


   function search_nation7(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation7.php",data,"text","result_search_nation7",result_search_nation7,"","");
      }
   }

   function result_search_nation7(response){
      if(response == "0"){
         $('#result_search_nation7').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation7').html(response);
      }
   }

   function pick_nation7(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      $("span#nation7").html("<input type='hidden' id='chl_nation2' name='chl_nation2' value='"+id_nation+"' ><input type='text' value='"+name_nation+"' style='width:130px;' readonly='readonly' >");
	
      $("#search_nation7").val("");
      $("div#result_search_nation7").html("");
      $('#dialog_nation7').dialog('close');
   }

   function search_nation8(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation8.php",data,"text","result_search_nation8",result_search_nation8,"","");
      }
   }

   function result_search_nation8(response){
      if(response == "0"){
         $('#result_search_nation8').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation8').html(response);
      }
   }

   function pick_nation8(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      $("span#nation8").html("<input type='hidden' id='chl_country' name='chl_country' value='"+id_nation+"' ><input type='text' value='"+name_nation+"' style='width:130px;' readonly='readonly' >");
	
      $("#search_nation8").val("");
      $("div#result_search_nation8").html("");
      $('#dialog_nation8').dialog('close');
   }


   function search_nation9(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
      ajaxPostData("_find_nation9.php",data,"text","result_search_nation9",result_search_nation9,"","");
      }
   }

   function result_search_nation9(response){
      if(response == "0"){
         $('#result_search_nation9').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
      }else{
         $('#result_search_nation9').html(response);
      }
   }
   function pick_nation9(id){
      var id_nation = $('#id'+id).val();
      var name_nation = $('#name'+id).val();
	
      $("span#nation9").html("<input type='hidden' id='chl_nation1' name='chl_nation1' value='"+id_nation+"' ><input type='text' value='"+name_nation+"' style='width:130px;' readonly='readonly'>");
	
      $("#search_nation9").val("");
      $("div#result_search_nation9").html("");
      $('#dialog_nation9').dialog('close');
   }

   $(function(){
      $('#dialog_address4').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '300',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_location4").val("");
               $("div#result_search_address4").html("");
            }
         }
      });

		
      $( "#opener_address4" ).click(function() {
         $( "#dialog_address4" ).dialog( "open" );
         return false;
      });
		
		
		
      $('#dialog_nation7').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation7").val("");
               $("div#result_search_nation7").html("");
            }
         }
      });
		
      $('#dialog_nation8').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation8").val("");
               $("div#result_search_nation8").html("");
            }
         }
      });
		
      $('#dialog_nation9').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_nation9").val("");
               $("div#result_search_nation9").html("");
            }
         }
      });
		
		
      $( "#opener7" ).click(function() {
         $( "#dialog_nation7" ).dialog( "open" );
         return false;
      });
		
      $( "#opener8" ).click(function() {
         $( "#dialog_nation8" ).dialog( "open" );
         return false;
      });
      $( "#opener9" ).click(function() {
         $( "#dialog_nation9" ).dialog( "open" );
         return false;
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
   });

</script>
<div style="display:none">

   <div id="dialog_address4" title="ระบบค้นหาที่อยู่">
      <p align="center">
         กรอกตำบล : <input type="text" id="search_location4" name="search_location4" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_tumbon4($('#search_location4').val())"/>
      </p>
      <div id="result_search_address4" align="center"></div>
   </div>

</div>
<table cellpadding="0" cellspacing="0" align="center" width="758">
   <tr><td >

         <div id="children_list" align="center" class="data_details_list">
            <? include "children_data_table.php"; ?>
         </div>
         <div align="center"  id="toggle_form"><?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('children_data','')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
         <div id="data_form" style="display:none;">   

            <img src="../images/bg_d.png" style="margin-left:10px;" />

            <table  cellspacing="0" cellpadding="0" align="center" >
               <tr>
                  <td>
                     <form id="children_data" name="children_data" enctype="multipart/form-data" method="post" action="children_data_save.php"  target="upload_target">
                        <table width="100%" border="0" cellspacing="4" cellpadding="4">
                           <tr>
                              <td width="167" align="right" class="form_text">* คำนำหน้า :</td>
                              <td colspan="2">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="14%">
                                          <select name="chl_title_th" id="chl_title_th" onchange="swap_chl_title_th();"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <option value="0">เลือก</option>
                                             <option value="นาย" <? if ($row["CHL_TITLE_TH"] == "นาย") { echo "selected='selected'"; } ?>>นาย</option>
                                             <option value="นาง" <? if ($row["CHL_TITLE_TH"] == "นาง") { echo "selected='selected'"; } ?>>นาง</option>
                                             <option value="น.ส." <? if ($row["CHL_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>นางสาว</option>
                                             <option value="ด.ช." <? if ($row["CHL_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>ด.ช.</option>
                                             <option value="ด.ญ." <? if ($row["CHL_TITLE_TH"] == "น.ส.") { echo "selected='selected'"; } ?>>ด.ญ.</option>
                                          </select>
                                       </td>
                                       <td width="8%" align="right" class="form_text">ชื่อ : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="chl_fname_th" id="chl_fname_th" style="width: 80px; " class="input_text" onkeyup="chkTh('chl_fname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="14%" align="right" class="form_text">ชื่อกลาง : &nbsp;</td>
                                       <td width="16%" align="left"><input type="text" name="chl_mname_th" id="chl_mname_th" style="width: 80px; " class="input_text" onkeyup="chkTh('chl_mname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="14%" align="right" class="form_text">นามสกุล : &nbsp;</td>
                                       <td width="19%"><input type="text" name="chl_lname_th" id="chl_lname_th" style="width: 80px; " class="input_text" onkeyup="chkTh('chl_lname_th','OnlyThai');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* Title :</td>
                              <td colspan="2">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="12%">
                                          <select name="chl_title_en" id="chl_title_en" onchange="swap_chl_title_en();"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <option value="0">เลือก</option>
                                             <option value="Mr." <? if ($row["CHL_TITLE_EN"] == "Mr.") { echo "selected='selected'"; } ?>>Mr.</option>
                                             <option value="Mrs." <? if ($row["CHL_TITLE_EN"] == "Mrs.") { echo "selected='selected'"; } ?>>Mrs.</option>
                                             <option value="MISS" <? if ($row["CHL_TITLE_EN"] == "MISS") { echo "selected='selected'"; } ?>>Miss</option>
                                          </select>
                                       </td>
                                       <td width="11%" align="right" class="form_text">Fname : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="chl_fname_en" id="chl_fname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('chl_fname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="13%" align="right" class="form_text">Mname : &nbsp;</td>
                                       <td width="15%" align="left"><input type="text" name="chl_mname_en" id="chl_mname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('chl_mname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="13%" align="right" class="form_text">Lname : &nbsp;</td>
                                       <td width="21%"><input type="text" name="chl_lname_en" id="chl_lname_en" style="width: 80px; " class="input_text" onkeyup="chkEn('chl_lname_en','OnlyEn');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* เพศ :</td>
                              <td colspan="2" align="left"><input name="chl_sex" type="radio" id="chl_sex"  value="male"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/>  ชาย <input type="radio" name="chl_sex" id="chl_sex" value="female"<?php if ($ $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />  หญิง</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">เชื้อชาติ :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="30%" align="left">
                                          <?
                                          /* $sql_chl_nation1 = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                            $stid_chl_nation1 = oci_parse($conn, $sql_chl_nation1);
                                            oci_execute($stid_chl_nation1); */
                                          $option_chl_nation1 = "";
                                          /* while(($row_chl_nation1 = oci_fetch_array($stid_chl_nation1, OCI_BOTH))){
                                            if($row_chl_nation1["NATION_NAME_TH"] == "" or $row_chl_nation1["NATION_NAME_TH"] == NULL) $name_country = $row_chl_nation1["NATION_NAME_ENG"];
                                            else $name_country = $row_chl_nation1["NATION_NAME_TH"];
                                            $option_chl_nation1 .= "<option value='".$row_chl_nation1["NATION_ID"]."' >".$name_country."</option>\n";
                                            } */
                                          ?>
                                <span id="nation9"><!--<select name="chl_nation1" id="chl_nation1" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <?= $option_chl_nation1 ?>
                                       </select>-->

                                             <input type="hidden" name="chl_nation1" id="chl_nation1" value="<?= $row_chl_nation1["NATION_ID"] ?>" />
                                             <input type="text" style="width:130px;" readonly='readonly' value="<?= $name_country ?>" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />

                                          </span> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener9"  title="ค้นหา"/><?php } ?>
                                       </td>
                                       <td width="13%" align="right" class="form_text">สัญชาติ : &nbsp;</td>
                                       <td width="33%" align="left">

                                          <?
                                          /* $sql_chl_nation2 = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                            $stid_chl_nation2 = oci_parse($conn, $sql_chl_nation2);
                                            oci_execute($stid_chl_nation2);
                                            $option_chl_nation2="<option value=''>เลือก</option>";
                                            while(($row_chl_nation2 = oci_fetch_array($stid_chl_nation2, OCI_BOTH))){
                                            if($row_chl_nation2["NATION_NAME_TH"] == "" or $row_chl_nation2["NATION_NAME_TH"] == NULL) $name_country = $row_chl_nation2["NATION_NAME_ENG"];
                                            else $name_country = $row_chl_nation2["NATION_NAME_TH"];
                                            $option_chl_nation2 .= "<option value='".$row_chl_nation2["NATION_ID"]."' >".$name_country."</option>\n";
                                            } */
                                          ?>

                                          <span id="nation7">
                                             <!--
                                              <select name="chl_nation2" id="chl_nation2" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <?= $option_chl_nation1 ?>
                                                     </select>
                                             -->     
                                             <input type="hidden" name="chl_nation2" id="chl_nation2" value="<?= $row_chl_nation2["NATION_ID"] ?>" />
                                             <input type="text" style="width:130px;" readonly='readonly' value="<?= $name_country ?>" <?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />

                                          </span> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener7"  title="ค้นหา"/><?php } ?>

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
                                 $sql_chl_religion = "SELECT * FROM  " . TB_REF_RELIGION . "  ORDER BY RELIGION_ID ASC ";
                                 $stid_chl_religion = oci_parse($conn, $sql_chl_religion);
                                 oci_execute($stid_chl_religion);
                                 $option_chl_religion = "<option value=''>เลือก</option>";
                                 while (($row_chl_religion = oci_fetch_array($stid_chl_religion, OCI_BOTH))) {
                                    $option_chl_religion .= "<option value='" . $row_chl_religion["RELIGION_ID"] . "' >" . $row_chl_religion["RELIGION_NAME_TH"] . "</option>\n";
                                 }
                                 ?>
                                 <select name="chl_religion" id="chl_religion" class="widthFix"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_chl_religion ?>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* ว/ด/ป เกิด :</td>
                              <td colspan="2" align="left"><input  name="chl_birthday" onblur="Age('chl_birthday','chl_s_year','chl_s_month')" type="text" class="input_text" id="chl_birthday" style="width: 80px; "<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('chl_birthday','YYYY-MM-DD');$('#chl_birthday').focus()"  style="cursor:pointer"/><?php } ?> ex. 15/10/2553
                                 &nbsp; &nbsp;สถานะ : <input name="chl_alive" type="radio" id="chl_alive" value="1" checked="checked"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>/> มีชีวิต <input type="radio" id="chl_alive" name="chl_alive" value="2"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /> ถึงแก่กรรม  <input type="radio" id="chl_alive" name="chl_alive" value="3"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> /> สาบสูญ</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ปัจจุบันอายุ :</td>
                              <td colspan="2" align="left"><input type="text"  style="width: 25px; border:none; " readonly name="chl_s_year" id="chl_s_year" onfocus="Age('chl_birthday','chl_s_year','chl_s_month')"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> ปี <input type="text"  style="width: 25px; border:none; " readonly name="chl_s_month" id="chl_s_month" onfocus="Age('chl_birthday','chl_s_year','chl_s_month')"<?php if ($_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> เดือน</td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">สถานศึกษา :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_school" id="chl_school" style="width: 150px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/>
                                 &nbsp;อำเภอ : <input type="text" name="chl_sch_amphur" id="chl_sch_amphur" style="width: 100px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/> 
                                 &nbsp;จังหวัด : <input type="text" name="chl_sch_province" id="chl_sch_province" style="width: 100px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ระดับการศึกษา :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_sch_level" id="chl_sch_level" style="width: 150px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* เลขประจำตัวประชาชน :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="22%" align="left"><input type="text" name="chl_code_id" id="chl_code_id" style="width: 120px; " maxlength="13" class="input_text" onkeyup="chkNum('chl_code_id','OnlyNm');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="20%" align="right" class="form_text">ความสัมพันธ์ : &nbsp;</td>
                                       <td width="20%"><select name="chl_relation" id="chl_relation"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                             <option value="0">เลือก</option>
                                             <option value="1">โดยสายเลือด</option>
                                             <option value="2">ทะเบียนสมรส</option>
                                             <option value="3">บุตรบุญธรรม</option>
                                          </select></td>
                                       <td width="10%" align="right" class="form_text">&nbsp;</td>
                                       <td width="28%">&nbsp;</td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">อาชีพ :</td>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="28%" align="left"><input type="text" name="chl_occupation" id="chl_occupation" style="width: 150px; "  class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                       <td width="21%" align="right" class="form_text">สถานที่ทำงาน :&nbsp; </td>
                                       <td width="51%" align="left"><input type="text" name="chl_work_place" id="chl_work_place" style="width: 250px; "  class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                                    </tr>
                                 </table></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์มือถือ :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_mobile" id="chl_mobile" style="width: 110px; "  class="input_text"  onkeyup="chkNum('chl_mobile','OnlyNm');" maxlength="30"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์ที่ทำงาน :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_work_phone" id="chl_work_phone" style="width: 110px; "  class="input_text" onkeyup="chkNum('chl_work_phone','OnlyNm');" maxlength="30"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรศัพท์บ้าน :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_phone" id="chl_phone" style="width: 110px; "  class="input_text" onkeyup="chkNum('chl_phone','OnlyNm');" maxlength="30"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">โทรสาร :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_fax" id="chl_fax" style="width: 110px; "  class="input_text" onkeyup="chkNum('chl_fax','OnlyNm');" maxlength="30"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">e-mail :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_email" id="chl_email" style="width: 100px; "  class="input_text" onblur="chkEml('chl_email','ValidEml');"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td height="35" colspan="3" align="left"  style="padding-left:30px">
                                 <div class="head2" align="left">ที่อยู่ปัจจุบัน</div>
                              </td>
                           </tr>
                           <tr>
                              <td width="167" align="right" class="form_text">บ้านเลขที่ :</td>
                              <td width="130" align="left"><input type="text" name="chl_house_no" id="chl_house_no" style="width: 100px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                              <td width="417" align="left"><div style="background-color:#6FF; cursor:pointer;width:140px; " onclick="cen_address()">ใช้ที่อยู่เดียวกับทะเบียนบ้าน</div></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">หมู่ :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_moo" id="chl_moo" style="width: 80px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ตึก/อาคาร :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_building" id="chl_building" style="width: 120px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">หมู่บ้าน :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_village" id="chl_village" style="width: 120px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ห้อง :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_room" id="chl_room" style="width: 120px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ซอย :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_soi" id="chl_soi" style="width: 120px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ถนน :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_road" id="chl_road" style="width: 120px; " class="input_text"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text"> ตำบล/แขวง :</td>
                              <td align="left" valign="middle"> 
                                 <span id='tumbon2'>
                                    <?
                                    echo "\n";
                                    $sql_chl_tumbon = "SELECT * FROM  " . TB_REF_TUMBON . "  WHERE  CODE_REF_TUMBON = '" . $row["CU_TUMBON"] . "' ";
                                    $stid_chl_tumbon = oci_parse($conn, $sql_chl_tumbon);
                                    oci_execute($stid_chl_tumbon);
                                    while (($row_chl_tumbon = oci_fetch_array($stid_chl_tumbon, OCI_BOTH))) {
                                       $option_chl_tumbon = "<option value='" . $row_chl_tumbon["CODE_REF_TUMBON"] . "'>" . $row_chl_tumbon["NAME_REF_TUMBON"] . "</option>\n";
                                    }
                                    ?>
                             <!--<select name="chl_tumbon" id="chl_tumbon" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_chl_tumbon ?>
                                    </select> -->

                                    <input type="hidden" name="chl_tumbon" id="chl_tumbon" value="<?= $row_chl_tumbon["CODE_REF_TUMBON"] ?>" />
                                    <input type="text" class="input_text" readonly='readonly' value="<?= $row_chl_tumbon["NAME_REF_TUMBON"] ?>" style="width: 120px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />

                                 </span></td>
                              <td align="left" valign="middle"><?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="middle" style="cursor:pointer" id="opener_address4"  title="ค้นหา"/><?php } ?></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text"> อำเภอ/เขต :</td>
                              <td colspan="2" align="left">
                                 <div id='amphur2'>
                                    <?
                                    echo "\n";
                                    $sql_chl_amphur = "SELECT * FROM  " . TB_REF_AMPHUR . "  WHERE  CODE_REF_AMPHUR = '" . $row["CU_AMPHUR"] . "'  ";
                                    $stid_chl_amphur = oci_parse($conn, $sql_chl_amphur);
                                    oci_execute($stid_chl_amphur);
                                    while (($row_chl_amphur = oci_fetch_array($stid_chl_amphur, OCI_BOTH))) {
                                       $option_chl_amphur = "<option value='" . $row_chl_amphur["CODE_REF_AMPHUR"] . "' >" . $row_chl_amphur["NAME_REF_AMPHUR"] . "</option>\n";
                                    }
                                    ?>
                                    <!--
                                     <select name="chl_amphur" id="chl_amphur" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_chl_amphur ?>
                                            </select>
                                    -->
                                    <input type="hidden" name="chl_amphur" id="chl_amphur" value="<?= $row_chl_amphur["CODE_REF_AMPHUR"] ?>" />
                                    <input type="text" readonly='readonly' class="input_text" value="<?= $row_chl_amphur["NAME_REF_AMPHUR"] ?>" style="width: 120px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text"> จังหวัด :</td>
                              <td colspan="2" align="left">
                                 <div id='province2'>
                                    <?
                                    echo "\n";
                                    $sql_chl_province = "SELECT * FROM  " . TB_REF_PROVINCE . " WHERE  CODE_REF_PROVINCE = '" . $row["CU_PROVINCE"] . "'   ";
                                    $stid_chl_province = oci_parse($conn, $sql_chl_province);
                                    oci_execute($stid_chl_province);
                                    while (($row_chl_province = oci_fetch_array($stid_chl_province, OCI_BOTH))) {
                                       $option_chl_province = "<option value='" . $row_chl_province["CODE_REF_PROVINCE"] . "' >" . $row_chl_province["NAME_REF_PROVINCE"] . "</option>\n";
                                    }
                                    ?>
                                    <!--
                                     <select name="chl_province" id="chl_province" style="width: 130px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_chl_province ?>
                                            </select>
                                    -->
                                    <input type="hidden" name="chl_province" id="chl_province"  value="<?= $row_chl_province["CODE_REF_PROVINCE"] ?>" />
                                    <input type="text" class="input_text" readonly='readonly' value="<?= $row_chl_province["NAME_REF_PROVINCE"] ?>" style="width: 120px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">รหัสไปรษณีย์ :</td>
                              <td colspan="2" align="left"><input type="text" name="chl_post_code" class="input_text" id="chl_post_code" style="width: 50px; " maxlength="5" class="input_text" onkeyup="chkNum('chl_post_code','OnlyNm');"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ประเทศ :</td>
                              <td colspan="2" align="left">
                                 <?
                                 /* $sql_chl_country = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC "; 
                                   $stid_chl_country = oci_parse($conn, $sql_chl_country);
                                   oci_execute($stid_chl_country);
                                   $option_chl_country="<option value=''>เลือก</option>";
                                   while(($row_chl_country = oci_fetch_array($stid_chl_country, OCI_BOTH))){
                                   if($row_chl_country["NATION_NAME_TH"] == "" or $row_chl_country["NATION_NAME_TH"] == NULL) $name_country = $row_chl_country["NATION_NAME_ENG"];
                                   else $name_country = $row_chl_country["NATION_NAME_TH"];
                                   $option_chl_country .= "<option value='".$row_chl_country["NATION_ID"]."' >".$name_country."</option>\n";
                                   } */
                                 ?>
                                 <span id="nation8">
                                    <!--
                                    <select name="chl_country" id="chl_country" style="width: 130px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                                    <?= $option_chl_nation1 ?> 
                                           </select>
                                    --> 
                                    <input type="hidden" name="chl_country" id="chl_country"  value="" />
                                    <input type="text" class="input_text" readonly='readonly' value="" style="width: 120px"<?php if ( $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> />   

                                 </span> <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener8"  title="ค้นหา"/><?php } ?>
                              </td>
                           </tr>
                     <!--      <tr>
                             <td height="20" align="right" class="form_text">ไฟล์ดิจิตอล ทะเบียนบ้าน :</td>
                             <td colspan="2" align="left" style="color:#663; font-size:11px"><input type="file" name="chl_cen_file" id="chl_cen_file" class="file_upload"/> เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx</td>
                           </tr>-->

                           <tr>
                              <td align="right" >&nbsp;<input type='text' id='hid_chl_cen_file' name='hid_chl_cen_file' style="display:none"<?php if (  $_SESSION['USER_TYPE'] == 'chief') { ?> disabled="disabled"<?php } ?>/></td>
                              <td colspan="2" align="left">&nbsp;</td>
                           </tr>
                           <?php if ( $_SESSION['USER_TYPE'] != 'chief') { ?>
                              <tr>
                                 <td align="right" >
                                    <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                                    <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none"  onclick="check_data();" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                                 </td>
                                 <td colspan="2" align="left">

                                    <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                                    <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('children_data.php','../images/head2/bio/children.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>

                                 </td>
                              </tr><?php } ?>
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

<div id="dialog_nation7" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation7" name="search_nation7" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation7($('#search_nation7').val())"/>
   </p>
   <div id="result_search_nation7" align="center"></div>
</div>

<div id="dialog_nation8" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation8" name="search_nation8" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation8($('#search_nation8').val())"/>
   </p>
   <div id="result_search_nation8" align="center"></div>
</div>

<div id="dialog_nation9" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_nation9" name="search_nation9" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation9($('#search_nation9').val())"/>
   </p>
   <div id="result_search_nation9" align="center"></div>
</div>
<div id="user_idcard" style="display:none;">
   <p>
    	รูปแบบหมายเลขบัตรประชาชนไม่ถูกต้อง
   </p>
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
   <div id="ca_tumbon"><input type="hidden" id="chl_tumbon" name="chl_tumbon" style='width: 130px' value="<?= $row["CA_TUMBON"] ?>"><input type="text"  value="<?= get_tumbon_name($row["CA_TUMBON"], TB_REF_TUMBON) ?>" readonly='readonly' style="width:120px;" /></div>
   <div id="ca_amphur"><input type="hidden" id="chl_amphur" name="chl_amphur" value="<?= $row["CA_AMPHUR"] ?>"><input type="text" style="width:120px;" value="<?= get_amphur_name($row["CA_AMPHUR"], TB_REF_AMPHUR) ?>" readonly='readonly' /></div>
   <div id="ca_province"><input type="hidden" id="chl_province" name="chl_province" value="<?= $row["CA_PROVINCE"] ?>"><input type="text" style="width:120px;" value="<?= get_province_name($row["CA_PROVINCE"], TB_REF_PROVINCE) ?>" readonly='readonly' /></div>
   <div id="ca_post_code"><?= $row["CA_POST_CODE"] ?></div>
   <div id="ca_post_code"><?= $row["CA_POST_CODE"] ?></div>
      <div id="ca_country"><input type="hidden" id="chl_country" name="chl_country" style='width: 130px' value="<?= $row["CA_COUNTRY"] ?>"><input type="text" id="chl_country_text" value="<?= get_nation_name($row["CA_COUNTRY"], TB_REF_NATION) ?>" style="width: 120px" readonly='readonly' /></div>
</div>

<?
$db->closedb($conn);
?>
<script src="../js/edit_by_user.js" type="text/javascript"></script>