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
   function sub_(name){
      var target = name.value;
      var n1 = "c"+target;
      if(document.getElementById(n1).checked){
         document.getElementById(target).disabled=true;
         document.getElementById(target).value="";
      }else{
         document.getElementById(target).disabled=false;
      }
   }

   function reset_false(){
      document.getElementById("jnc_responsibility").disabled=false;
      document.getElementById("jnc_depart").disabled=false;
      document.getElementById("jnc_salary").disabled=false;
      document.getElementById("jnc_qualification_ps").disabled=false;
      document.getElementById("jnc_spec_qualification").disabled=false;
      document.getElementById("jnc_attach_file").disabled=false;
   }

   function check_data(){
		
      if($("#jnc_order_no").val() == "" || $("#jnc_pos_name").val() == "" || $("#jnc_quantity").val() == "" || $("#jnc_description").val() == "" || $("#jnc_date_place").val() == ""){
         $("#Please_fill_in").dialog('open');
         return false;
      }
	
	
      $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      document.getElementById("job_announcement").submit();
   }

   $(function() {
      $("#exp_expert1").autocomplete({
         source: expertTags
      });
      $("#exp_expert2").autocomplete({
         source: expertTags
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
   <tr><td ><div style="padding-left:20px"><input type="button" value="ประวัติการรับสมัคร" onclick="window.open('job_announcement_search.php','search','scrollbars=yes,resizable=yes,location=no,width=940,height=500')" /></div>
         <table  cellspacing="0" cellpadding="0" align="center" >
            <tr>
               <td valign="top">
                  <form id="job_announcement" name="job_announcement" method="post" action="job_announcement_data_save.php"  target="upload_target" >
                     <table width="758" border="0" cellspacing="4" cellpadding="4">
                        <tr>
                           <td width="244" align="right" class="form_text">* เรื่อง : </td>
                           <td colspan="2" align="left"><input type="text" name="jnc_topic" id="jnc_topic" style="width: 200px; " class="input_text"/></td>
                        </tr>
                        <tr>
                           <td width="244" align="right" class="form_text">* สั่ง ณ วันที่ : </td>
                           <td colspan="2" align="left">
                              <input type="text" name="jnc_date" id="jnc_date" style="width: 80px; " class="input_text"/>
                              <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('jnc_date','YYYY-MM-DD')"  style="cursor:pointer"/>Ex. 15/10/2553 
                           </td>
                        </tr>
                        <tr>
                           <td width="244" align="right" class="form_text">* เลขที่คำสั่ง : </td>
                           <td colspan="2" align="left"><input type="text" name="jnc_order_no" id="jnc_order_no" style="width: 200px; " class="input_text"/></td>
                        </tr>
                        <tr>
                           <td align="right" class="form_text">* ชื่อตำแหน่ง :</td>
                           <td colspan="2" align="left"><input type="text" name="jnc_pos_name" id="jnc_pos_name" style="width: 200px; " class="input_text" /></td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" class="form_text">หน้าที่ความรับผิดชอบ :</td>
                           <td width="250" align="left" valign="top"><textarea id="jnc_responsibility" name="jnc_responsibility" style="width: 250px; height:100px "></textarea>
                           </td>
                           <td width="224" align="left" valign="top"><input type="checkbox" id="cjnc_responsibility"  onclick="sub_(this);" value="jnc_responsibility"/> ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" class="form_text">สังกัด/หน่วยงาน :</td>
                           <td colspan="2" align="left"><input type="text" name="jnc_depart" id="jnc_depart" style="width: 300px; " class="input_text" /> 
                              &nbsp; <input type="checkbox"  id="cjnc_depart" onclick="sub_(this);" value="jnc_depart" /> 
                              ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" class="form_text">ค่าตอบแทน/ค่าจ้าง :</td>
                           <td colspan="2" align="left"><input type="text" name="jnc_salary" id="jnc_salary" style="width: 200px; " class="input_text" /> 
                              &nbsp; <input type="checkbox" id="cjnc_salary" onclick="sub_(this);" value="jnc_salary" /> 
                              ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" class="form_text">* อัตราว่าง :</td>
                           <td colspan="2" align="left"><input type="text" name="jnc_quantity" id="jnc_quantity" style="width: 100px; " class="input_text"/></td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" class="form_text">คุณสมบัติทั่วไป :</td>
                           <td align="left"><textarea id="jnc_qualification" name="jnc_qualification" style="width: 250px; height:100px "></textarea></td>
                           <td align="left" valign="top"></td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" class="form_text">หมายเหตุ(คุณสมบัติทั่วไป) :</td>
                           <td align="left"><textarea id="jnc_qualification_ps" name="jnc_qualification_ps" style="width: 250px; height:100px "></textarea></td>
                           <td align="left" valign="top"><input type="checkbox" id="cjnc_qualification_ps" onclick="sub_(this);" value="jnc_qualification_ps" /> ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" class="form_text">คุณสมบัติเฉพาะ :</td>
                           <td align="left"><textarea id="jnc_spec_qualification" name="jnc_spec_qualification" style="width: 250px; height:100px "></textarea></td>
                           <td align="left" valign="top"><input type="checkbox" id="cjnc_spec_qualification" onclick="sub_(this);" value="jnc_spec_qualification" /> ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" class="form_text">* รายละเอียดการจ้างงาน :</td>
                           <td colspan="2" align="left">
                              <?
                              $fpath = '../';
                              require_once($fpath . "includes/connect.php");
                              $sql_emp_type = "SELECT * FROM  " . TB_REF_STAFFTYPE . "  ORDER BY STAFFTYPE_ID ASC ";
                              $stid_emp_type = oci_parse($conn, $sql_emp_type);
                              oci_execute($stid_emp_type);
                              $option_emp_type = "<option value=''>เลือก</option>";
                              while (($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))) {
                                 $option_emp_type .= "<option value='" . $row_emp_type["STAFFTYPE_ID"] . "' >" . $row_emp_type["STAFFTYPE_NAME"] . "</option>\n";
                              }
                              ?>
                              <select name="jnc_description" id="jnc_description" class="widthFix" >
                                 <?= $option_emp_type ?>
                              </select>
                           </td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" class="form_text">* วัน เวลา และสถานที่รับสมัคร :</td>
                           <td colspan="2" align="left"><textarea id="jnc_date_place" name="jnc_date_place" style="width: 250px; height:100px "></textarea></td>
                        </tr>
                        <tr>
                           <td align="right" valign="top" >หลักฐานที่ต้องใช้ในการสมัคร : </td>
                           <td align="left"><textarea id="jnc_attach_file" name="jnc_attach_file" style="width: 250px; height:100px "></textarea></td>
                           <td align="left" valign="top"><input type="checkbox" id="cjnc_attach_file" onclick="sub_(this);" value="jnc_attach_file" /> ไม่ระบุ</td>
                        </tr>
                        <tr>
                           <td align="right" >สถานะ : </td>
                           <td colspan="2" align="left"> <input name="jnc_status" type="radio" id="jnc_status" value="1" checked="checked"  />แสดง  <input type="radio" id="jnc_status" name="jnc_status" value="2"  />ซ่อน</td>
                        </tr>
                        <tr>
                           <td align="right" >&nbsp;</td>
                           <td colspan="2" align="left"><input type="hidden" id="jnc_id" name="jnc_id" value="" /></td>
                        </tr>
                        <tr>
                           <td align="right" >
                              <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                              <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                           </td>
                           <td colspan="2" align="left">
                              <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                              <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick=" reset_false();document.getElementById('jnc_id').value='';document.getElementById('job_announcement').reset();" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
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