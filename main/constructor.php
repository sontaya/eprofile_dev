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
		
      var dateStart = getDateObject($("#con_start_date").val(),'/');
      var dateEnd = getDateObject($("#con_end_date").val(),'/');   
   
      if($("#con_order_no").val() == "" || $("#con_course_name").val() == "" || $("#con_type").val() == "" || $("#con_start_date").val() == "" || $("#con_end_date").val() == "" || $("#con_place").val() == ""){
         $("#Please_fill_in").dialog('open');
         return false;
      }
    
      if(dateStart > dateEnd){
         $("#End_Nmmore").dialog('open');
         return false;
      }

	
      $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      document.getElementById("constructor").submit();
   }
  

   function search_nation(txt){
      //alert(txt);
      var data = "";
      data += "txt="+txt;
      if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
         ajaxPostData("_find_nation6.php",data,"text","result_search_con_nation",result_search_con_nation,"","");
      }
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
	
      $("span#con_nation").html("<input type='text' id='con_country' name='con_country' value='"+name_nation+"' style='width:120px;' readonly='readonly'>");
	
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



      $( "#opener6" ).click(function() {
         $( "#dialog_con_nation" ).dialog( "open" );
         return false;
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
         <div id="constructor_list" align="center" class="data_details_list">
            <? include "constructor_data_table.php"; ?>
         </div>
         <div align="center"  id="toggle_form"><?php if ($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?><img src="../images/add.png" onclick="toggle_form('constructor','con_id');" style="cursor:pointer"/><?php } ?></div>
         <div id="data_form" style="display:none"> 
            <table  cellspacing="0" cellpadding="0" align="center" >

               <tr>
                  <td><form id="constructor" name="constructor" method="post" action="constructor_data_save.php" target="upload_target" enctype="multipart/form-data">
                        <img src="../images/bg_d.png" style="margin-left:10px;" />
                        <table width="758" border="0" cellspacing="4" cellpadding="4">
                           <tr>
                              <td align="right" class="form_text">* ประเภท :</td>
                              <td align="left"><input type="hidden" id="con_id" name="con_id" value="" />
                                 <?
                                 include("../includes/connect.php");
                                 $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >8 AND ORDER_NO <11) ORDER BY ORDER_NO ASC ";
                                 $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
                                 oci_execute($stid_ref_traintype);
                                 $option_ref_traintype = "<option value=''>เลือก</option>";
                                 while (($row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH))) {
                                    $option_ref_traintype .= "<option value='" . $row_ref_traintype["CODE_TRAINTYPE"] . "' >" . $row_ref_traintype["NAME_TRAINTYPE"] . "</option>\n";
                                 }

                                 $db->closedb($conn);
                                 ?>
                                 <select  name="con_type" id="con_type"  class="widthFix">
                                    <?= $option_ref_traintype ?>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <td width="115" align="right" class="form_text">* เลขที่คำสั่ง :</td>
                              <td width="615" align="left"><input type="text" name="con_order_no" id="con_order_no" style="width: 100px;" class="input_text"/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* ชื่อหลักสูตร :</td>
                              <td align="left"><input type="text" name="con_course_name" id="con_course_name" style="width: 300px;" class="input_text"/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* วันที่เริ่ม :</td>
                              <td align="left" class="form_text"><input type="text" name="con_start_date" id="con_start_date" style="width: 80px;" class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('con_start_date','YYYY-MM-DD')"  style="cursor:pointer"/>
                                 &nbsp;&nbsp;&nbsp; วันที่เสร็จสิ้น :
                                 <input type="text" name="con_end_date" id="con_end_date" style="width: 80px;" class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('con_end_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">* สถานที่ :</td>
                              <td align="left"><input type="text" name="con_place" id="con_place" style="width: 300px;" class="input_text"/></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text" valign="top"> รายละเอียด :</td>
                              <td align="left"><textarea  name="con_detail" id="con_detail" style="width: 300px; height: 100px" class="input_text"></textarea></td>
                           </tr>
                           <tr>
                              <td align="right" class="form_text">ประเทศ :</td>
                              <td align="left">
                                 <span id='con_nation'>
                                    <input type="text" class="input_text" id='con_country' name='con_country' style="width:120" readonly="readonly"  />
                                 </span>
                                 <img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener6"  title="ค้นหา"/>


                              </td>
                           </tr>
                           <tr>
                              <td align="right"  class="form_text">ระดับความสำคัญ :</td>
                              <td align="left" class="form_text"><input type="radio" name="con_level" id="con_level" value="1" /> ระดับชาติ <input type="radio" name="con_level" id="con_level" value="2" /> ระดับนานาชาติ</td>
                           </tr>
                           <tr>
                              <td align="right" >แนบไฟล์ :</td>
                              <td align="left"><span id="file_upp"><input type="file" name="constructor_file" id="constructor_file" /></span></td>
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
                                 <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('constructor.php','../images/head2/work_data2/constructor.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                              </td>
                           </tr>
                           <tr>
                              <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
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
<div id="dialog_con_nation" title="ระบบค้นหาประเทศ" style="display:none">
   <p align="center">
      กรอกคำที่ต้องการ : <input type="text" id="search_con_nation" name="search_con_nation" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation($('#search_con_nation').val())"/>
   </p>
   <div id="result_search_con_nation" align="center"></div>
</div>