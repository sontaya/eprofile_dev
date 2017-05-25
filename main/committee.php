<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
   ?>
   <script language="javascript">
      window.location = "../" ;
   </script>
<? }
?>
<style type="text/css">
   .thesis {
      display: none;
   }
   .showthesis {
      display: table-row
   }
</style>
<script type="text/javascript" language="javascript">
   function check_data(){
		
      var dateStart = getDateObject($("#com_start_date").val(),'/');
      var dateEnd = getDateObject($("#com_end_date").val(),'/');   
      if($("#com_order_no").val() == "" || $("#com_act_name").val() == "" || $("#com_type").val() == "" || $("#com_start_date").val() == "" || $("#com_end_date").val() == "" || $("#com_place").val() == ""){
         $("#Please_fill_in").dialog('open');
         return false;
      }

      if(dateStart > dateEnd){
         $("#End_Nmmore").dialog('open');
         return false;
      }
      $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      document.getElementById("consult").submit();
   }
		   
      function search_nation(txt){
         //alert(txt);
         var data = "";
         data += "txt="+txt;
         ajaxPostData("_find_nation6.php",data,"text","result_search_con_nation",result_search_con_nation,"","");
      }

      function result_search_con_nation(response){
         if(response == "0"){
            $('#result_search_con_nation').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
         }else{
            $('#result_search_con_nation').html(response);
         }
      }

      function pick_nation6(id){
         var id_nation = $('#id'+id).val();
         var name_nation = $('#name'+id).val();
	
         $("span#con_nation").html("<input type='text' id='com_country' name='com_country' value='"+name_nation+"' style='width:120px;' readonly='readonly'>");
	
         $("#search_con_nation").val("");
         $("div#result_search_con_nation").html("");
         $('#dialog_con_nation').dialog('close');
      }
   $(function() {

    
 
   
      $('#dialog_con_nation').dialog({
         autoOpen: false,
         modal: true,
         hide: 'slide',
         show: 'slide',
         width:'500',
         height: '400',
         buttons: {
            ปิด: function() {
               $(this).dialog('close');
               $("#search_con_nation").val("");
               $("div#result_search_con_nation").html("");
            }
         }
      });
      /*
            var dates = $('#com_start_date, #com_end_date').datepicker({
                  changeMonth: true,
                  changeYear: true,
                  duration: 'fast',
                  dateFormat: 'dd/mm/yy',
                  yearRange: '1960:2020',
                  onSelect: function(selectedDate) {
                        var option = this.id == "com_start_date" ? "minDate" : "maxDate";
                        var instance = $(this).data("datepicker");
                        var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                        dates.not(this).datepicker("option", option, date);
                  }
		
            });*/
      $( "#opener6" ).click(function() {
         $( "#dialog_con_nation" ).dialog( "open" );
         return false;
      });
      $('#End_Nmmore').dialog({
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
   });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
   <tr><td >
         <div id="consult_list" align="center" class="data_details_list">
            <? include "committee_data_table.php"; ?>
         </div>
         <div align="center"  id="toggle_form"><?php if ($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?><img src="../images/add.png" onclick="toggle_form('consult','com_id');" style="cursor:pointer"/><?php } ?></div>
         <div id="data_form" style="display:none;"> 
            <table  cellspacing="0" cellpadding="0" align="center" >

               <td><form id="consult" name="consult" method="post" action="committee_data_save.php" target="upload_target" enctype="multipart/form-data">
                     <img src="../images/bg_d.png" style="margin-left:10px;" />
                     <table width="758" border="0" cellspacing="4" cellpadding="4">
                        <tr>
                           <td width="188" align="right" class="form_text">* ประเภท :</td>
                           <td width="542" align="left"><input type="hidden" id="com_id" name="com_id" value="" />
                              <?
                              include("../includes/connect.php");
                              $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >11 AND ORDER_NO <15) ORDER BY ORDER_NO ASC ";
                              $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
                              oci_execute($stid_ref_traintype);
                              $option_ref_traintype = "<option value=''>เลือก</option>";
                              while (($row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH))) {
                                 $option_ref_traintype .= "<option value='" . $row_ref_traintype["CODE_TRAINTYPE"] . "' >" . $row_ref_traintype["NAME_TRAINTYPE"] . "</option>\n";
                              }
                              $db->closedb($conn);
                              ?>

                              <select name="com_type" id="com_type" >
                                 <?= $option_ref_traintype ?>
                              </select>

                           </td>
                        </tr>
                        <tr class="thesis">
                           <td align="right" class="form_text">* ชื่อ - สกุล นักศึกษา :</td>
                           <td align="left">
                              <input type="text" class="input_text" name="com_student_name" id="com_student_name" />
                           </td>
                        </tr>
                        <tr class="thesis">
                           <td align="right" class="form_text" valign="top">* ระดับการศึกษาของนักศึกษา :</td>
                           <td align="left">
                              <input type="radio" name="com_degree" value="1"  checked="checked" /> ปริญญาโท<br />
                              <input type="radio" name="com_degree" value="2" /> ปริญญาเอก
                           </td>
                        </tr>
                        <tr class="thesis">
                           <td align="right" class="form_text">* หลักสูตร/สาขาวิชา :</td>
                           <td align="left">
                              <input type="text" class="input_text" name="com_curriculum" id="com_curriculum" /> * ปีการศึกษา : <input type="text" value="" class="input_text" name="com_year" id="com_year" />
                           </td>
                        </tr>
                        <tr class="thesis">
                           <td align="right" class="form_text">* ชื่อหัวข้อวิทยานิพนธ์ :</td>
                           <td align="left">
                              <input type="text" class="input_text" name="com_topic" id="com_topic" />
                           </td>
                        </tr>
                        <tr><!--
                             <tr>
                               <td width="186" align="right" class="form_text">* เลขที่คำสั่ง :</td>
                               <td width="540" align="left"><input type="text" name="com_order_no" id="com_order_no" style="width: 100px;" class="input_text"/></td>
                             </tr>
                           -->
                        <tr>
                           <td align="right" class="form_text">* <span id="label_org">ชื่อหน่วยงานภายนอก</span> :</td>
                           <td align="left"><input type="text" name="com_org_name" id="com_org_name" style="width: 300px;" class="input_text"/></td>
                        </tr>     
                        <tr>
                           <td align="right" class="form_text">* วันที่เริ่ม :</td>
                           <td align="left" class="form_text"><input  type="text" name="com_start_date" id="com_start_date" style="width: 100px;" class="input_text"/>
                              <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('com_start_date','YYYY-MM-DD')"  style="cursor:pointer"/>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วันที่เสร็จสิ้น :
                              <input  type="text" name="com_end_date" id="com_end_date" style="width: 100px;" class="input_text"/>
                              <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('com_end_date','YYYY-MM-DD')"  style="cursor:pointer"/>
                           </td>
                        </tr>
                        <!--
                        <tr>
                          <td align="right" class="form_text">* สถานที่ :</td>
                          <td align="left"><input type="text" name="com_place" id="com_place" style="width: 100px;" class="input_text"/></td>
                        </tr>
                        -->
                        <tr>
                           <td align="right" class="form_text">ประเทศ :</td>
                           <td align="left">
                              <span id='con_nation'>
                                 <input type="text" id='com_country' name='com_country' style="width:120" readonly="readonly"  />
                              </span>
                              <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener6"  title="ค้นหา"/>


                           </td>
                        </tr>
                        <!--
                        <tr>
                          <td align="right"  class="form_text">ระดับความสำคัญ :</td>
                          <td align="left" class="form_text"><input type="radio" name="com_level" id="com_level" value="1" /> ระดับชาติ <input type="radio" name="com_level" id="com_level" value="2" /> ระดับนานาชาติ</td>
                        </tr>
                        -->
                        <tr>
                           <td align="right"  class="form_text" valign="top">* เอกสารประกอบ :</td>
                           <td align="left" class="form_text"><span id="combo_group">
                                 <input type="radio" name="document_type" value="1" checked="checked" /> คำสั่ง <input type="text" name="document_type_1" id="document_type_1" class="input_text" /><br />
                                 <input type="radio" name="document_type" value="2" /> บันทึกข้อความ <input type="text" name="document_type_2" id="document_type_2" class="input_text" /><br />
                                 <input type="radio" name="document_type" value="3" /> อื่น ๆ <input type="text" name="document_type_3" id="document_type_3" class="input_text" /></span>
                           </td>
                        </tr>
                        <tr>
                           <td align="right" >แนบไฟล์ :</td>
                           <td align="left"><span id="file_upp"><input type="file" name="consult_file" id="consult_file" /></span></td>
                        </tr>
                        <tr>
                           <td align="right" >&nbsp;</td>
                           <td align="left">&nbsp;</td>
                        </tr>

                        <tr>
                           <td height="44" align="right" valign="top" >
                              <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                              <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                           </td>
                           <td colspan="2" align="left" valign="top">
                              <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                              <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('committee.php','../images/head2/work_data2/commit.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
                        </tr>
                     </table>
                  </form></td>
               </tr>
               <tr>
                  <td width="758" align="center">&nbsp;</td>
               </tr>
            </table>
         </div>

      </td>
   </tr>  
</table>
<div id="dialog_con_nation" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_con_nation" name="search_con_nation" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation($('#search_con_nation').val())"/>
   </p>
   <div id="result_search_con_nation" align="center"></div>
</div>
<script type="text/javascript">
   $('document').ready(function() {
		
      // ปิด text ของ radio ที่ไม่ใช้
		
      // เมื่อคลิกให้เปิด text input และ ปิด text input ของตัวอื่น 
      $('input[name=document_type]').click(function() {
         var rad = this.value;
         $('#document_type_'+rad).css('display','');
      });
		
      $('#com_type').change(function() {
         if(this.value == 12 || this.value == 13) {
            $('.thesis').css({
               'display':'table-row'/*,
                              'border':'1px solid #F00'*/
            });
            $('#label_org').html('ชื่อสถาบันการศึกษา');
         }
         else {
            $('.thesis').css({
               'display':'none'
            });
            $('#label_org').html('ชื่อหน่วยงานภายนอก');
         }
      });
   });
</script>