<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<?
 }

//echo getdays("2010/12/10","2011/03/15");
?>
<script language="javascript">
  function check_data(){
    var dateStart = getDateObject($("#sem_start_date").val(),'/');
    var dateEnd = getDateObject($("#sem_end_date").val(),'/');
    
    if($("#sem_start_date").val() != "" && $("#sem_end_date").val() != ""){
      calcDays('sem_start_date','sem_end_date','sem_long');
    }
    if($("#sem_who_name").val() == "" || $("#sem_who_position").val() == "" || $("#sem_depart").val() == "" || $("#sem_type").val() == "" || $("#sem_course_name").val() == "" || $("#sem_start_date").val() == "" || $("#sem_end_date").val() == ""){
      $("#Please_fill_in").dialog('open');
      return false;
    }
        
    if(dateStart > dateEnd){
      $("#End_Nmmore").dialog('open');
      return false;
    }
	
    if(!CheckfilesPdf($("input#sem_file"))){
      $("input#sem_file").val("");
      $("#Valid_sem_file").dialog('open');
      return false;
    }
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("seminar").submit();
	
	
  }


  $(function(){
    /*var dates = $('#sem_start_date, #sem_end_date').datepicker({
            changeMonth: true,
            changeYear: true,
            duration: 'fast',
            dateFormat: 'dd/mm/yy',
            yearRange: '1930:2030',
            onSelect: function(selectedDate) {
                var option = this.id == "sem_start_date" ? "minDate" : "maxDate";
                var instance = $(this).data("datepicker");
                var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
		
        });*/

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
    $('#Valid_sem_file').dialog({
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
<table cellpadding="0" cellspacing="0" align="center" width="758" border="0">
  <tr><td >
      <div id="seminar_list" align="center" class="data_details_list">
<? include "seminar_data_table.php"; ?>
      </div>
      <div align="center"  id="toggle_form"><?php if ($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['USER_EMP_ID'] == $_SESSION['EMP_ID']) { ?><img src="../images/add.png" onclick="toggle_form('seminar','sem_id')" style="cursor:pointer"/><?php } ?></div><br />
      <div id="data_form" style="display:none"> 

        <table  cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td><form id="seminar" name="seminar" method="post"  enctype="multipart/form-data" action="seminar_data_save.php" target="upload_target">
                <div style="width:90%; height:20px; color:#FFF; background-color: #D187D2; font-size:14px; padding-left:5px; margin-left: 18px" >ข้อมูลผู้เข้าอบรม/สัมมนา</div>
                <table width="679" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="187" align="right" class="form_text">* ชื่อผู้เข้ารับการอบรม :</td>
                    <td width="506" align="left"><input type="text" name="sem_who_name" id="sem_who_name" style="width: 200px; " class="input_text" value="<?= get_name($_SESSION["EMP_ID"], TB_BIODATA_TAB); ?>"/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ตำแหน่ง :</td>
                    <td align="left"><input type="text" name="sem_who_position" id="sem_who_position" style="width: 150px; " class="input_text" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* หน่วยงาน/ฝ่าย :</td>
                    <?
                    include("../includes/connect.php");
                    $sql_ref_department = "SELECT * FROM  " . TB_REF_DEPARTMENT . "  ORDER BY NAME_FACULTY ASC ";
                    $stid_ref_department = oci_parse($conn, $sql_ref_department);
                    oci_execute($stid_ref_department);
                    $option_ref_department = "<option value=''>เลือก</option>";
                    while (($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))) {
                      $option_ref_department .= "<option value='" . $row_ref_department["CODE_FACULTY"] . "' >" . $row_ref_department["NAME_FACULTY"] . "</option>\n";
                    }
                    $option_ref_department .= "<option value='other' >อื่นๆ</option>\n";
                    ?>
                    <td align="left"><select name="sem_depart" id="sem_depart" >
                        <?= $option_ref_department ?>
                      </select></td>
                  </tr>
                </table>
                <br /><br />
                <div style="width:90%; height:20px; color:#FFF; background-color: #D187D2; font-size:14px; padding-left:5px; margin-left: 18px">ข้อมูลหลักสูตรอบรม/สัมมนา</div>
                <table width="705" border="0" cellspacing="4" cellpadding="4">
                                    <tr>
                    <td align="right" class="form_text">* เลขที่คำสั่ง :</td>
                    <td align="left"><input type="text" name="sem_order_no" id="sem_order_no" style="width: 120px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ประเภท :</td>
                    <td align="left">
                      <?
                      $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >0 AND ORDER_NO <9) ORDER BY ORDER_NO ASC ";
                      $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
                      oci_execute($stid_ref_traintype);
                      $option_ref_traintype = "<option value=''>เลือก</option>";
                      while (($row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH))) {
                        $option_ref_traintype .= "<option value='" . $row_ref_traintype["CODE_TRAINTYPE"] . "' >" . $row_ref_traintype["NAME_TRAINTYPE"] . "</option>\n";
                      }
                      ?>

                      <select name="sem_type" id="sem_type" >
                        <?= $option_ref_traintype ?>
                      </select>
                      <input type="radio" name="sem_type_course" id="sem_type_course" value="1" />วิชาชีพ
                      <input type="radio" name="sem_type_course" id="sem_type_course" value="2" />วิชาการ
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* ชื่อหลักสูตร :</td>
                    <td align="left"><input type="text" name="sem_course_name" id="sem_course_name" style="width: 400px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td width="182" align="right" class="form_text">* วันที่เริ่มเข้าอบรม :</td>
                    <td width="505" align="left"><input  type="text" name="sem_start_date" id="sem_start_date" style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sem_start_date','YYYY-MM-DD')"  style="cursor:pointer"/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * วันสิ้นสุดการอบรม :
                      <input type="text" name="sem_end_date" id="sem_end_date" style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sem_end_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">ระยะเวลาในการอบรม :</td>
                    <td align="left"><input type="text" name="sem_long" id="sem_long" style="width: 40px; " class="input_text" onclick="calcDays('sem_start_date','sem_end_date','sem_long');"/>
                      วัน</td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">สถานที่จัดอบรม :</td>
                    <td align="left"><input type="text" name="sem_place" id="sem_place" style="width: 400px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">หน่วยงานที่จัด :</td>
                    <td align="left">

                      <input name="sem_by" class="input_text" id="sem_by" style="width: 400px; " type="text" />
                    </td>
                  </tr>
                </table>
                <br /><br />
                <div style="width:90%; height:20px; color:#FFF; background-color: #D187D2; font-size:14px; padding-left:5px; margin-left: 18px">รายละเอียดรายงานการฝึกอบรม/สัมมนา</div>
                <table width="713" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="247" align="right" class="form_text">จุดประสงค์ของการอบรม :</td>
                    <td width="438" align="left" class="form_text"><input type="text" name="sem_point" class="input_text" id="sem_point" style="width: 400px; " /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">ค่าใช้จ่าย :</td>
                    <td align="left" valign="top" class="form_text">
                      <input type="radio" id="sem_expense" name="sem_expense" value="1"/> ไม่เสียค่าใช้จ่ายเนื่องจาก <input type="text" id="sem_free_expense" name="sem_free_expense"  style="width: 200px; " class="input_text"/>
                      <br />
                      <input type="radio" id="sem_expense" name="sem_expense" value="2"/> เสียค่าใช้จ่ายทั้งสิ้นเป็นเงิน <input type="text" id="sem_expenses" name="sem_expenses"  style="width: 100px; " class="input_text"/> บาท
                      <br />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ประเภทเงิน
                      <input type="text" id="sem_money_type" name="sem_money_type"  style="width: 100px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">ความรู้และประโยชน์ที่ได้รับ :</td>
                    <td align="left" valign="top" class="form_text"><textarea id="sem_benefit" name="sem_benefit" rows="8" cols="40"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">ผลที่คาดว่าจะได้ในการปรับปรุงงาน :</td>
                    <td align="left" valign="top" class="form_text"><textarea id="sem_improve" name="sem_improve" rows="8" cols="40" ></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">ข้อเสนอแนะ :</td>
                    <td align="left" valign="top" class="form_text"><textarea id="sem_suggestion" name="sem_suggestion" rows="8" cols="40"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">คำแนะนำที่เพิมเติมจากหัวหน้างาน&nbsp;:</td>
                    <td align="left" valign="top" class="form_text"><textarea id="sem_chief_adv" name="sem_chief_adv" rows="8" cols="40" class="input_text"></textarea></td>
                  </tr>
                  <tr>
                    <td height="30" align="right"  class="form_text">หัวหน้างาน :</td>
                    <td align="left"  class="form_text"><input type="text" id="sem_chief" name="sem_chief"  style="width: 200px; " class="input_text"/></td>
                  </tr>
                </table>
                <br /><br />
                <div style="width:90%; height:20px; color:#FFF; background-color: #D187D2; font-size:14px; padding-left:5px; margin-left: 18px">อัพโหลดวุฒิบัตร / ใบรับรองการอบรม</div>
                <table width="678" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="237" align="right" class="form_text">ไฟล์เอกสาร :</td>
                    <td width="413" align="left" class="form_text" style="color:#663; font-size:11px" valign="middle"><input  type="file"name="sem_file"  id="sem_file" class="file_upload" /> อัพโหลดไฟล์ .pdf เท่านั้น
                    </td>
                  </tr>
                </table>
                <table width="687" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="200" align="right" ><input type="hidden" id="sem_id" name="sem_id" value="" /></td>
                    <td width="459" align="left"><input type='text' id='hid_sem_file' name='hid_sem_file' style="display:none" />
                    </td>
                  </tr>

                  <tr>
                    <td height="44" align="right" valign="top" >
                      <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                      <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                    </td>
                    <td colspan="2" align="left" valign="top">
                      <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                      <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('seminar.php','../images/head2/work_data2/seminar.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
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
<?
$db->closedb($conn);
?>