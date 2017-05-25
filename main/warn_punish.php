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
    if($("#wap_type").val() == "" || $("#wap_date").val() == "" || $("#wap_memo").val() == ""){
      $("#Please_fill_in").dialog('open');
      return false;
    }

	
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("warn_punish").submit();
  }

  $(function(){
    /*  $('#wap_date').datepicker({
            changeMonth: true,
            changeYear: true,
            duration: 'fast',
            dateFormat: 'dd/mm/yy',
            yearRange: '1960:2020'
        }); */
		   
		   
		   
  });
</script>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
  <tr><td >
      <div id="warn_list" align="center" class="data_details_list">
        <? include "warn_data_table.php"; ?>
      </div>
      <div align="center"  id="toggle_form">
        <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
          <img src="../images/add.png" onclick="toggle_form('warn_punish','wap_id')" style="cursor:pointer"/><?php } ?></div>
      <div id="data_form" > 
        <table  cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td><form id="warn_punish" name="warn_punish" method="post" action="warn_data_save.php" target="upload_target">
                <img src="../images/bg_d.png" style="margin-left:10px;" />
                <table width="758" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="86" align="right" class="form_text">* โทษทางวินัย :</td>
                    <td width="644" align="left"><select name="wap_type" id="wap_type"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                        <option value="">เลือก</option>
                        <option value="1">ตักเตือน</option>
                        <option value="2">ภาคทัณฑ์</option>
                        <option value="3">ตัดเงินเดือน</option>
                        <option value="4">ถูกสอบสวนทางวินัย</option>
                        <option value="5">อื่นๆ</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">* วันที่ :</td>
                    <td align="left"><input type="text" name="wap_date" id="wap_date"  style="width: 80px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'chief' || $_SESSION['USER_TYPE'] == 'user') { ?> readonly="readonly"<?php } ?>/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('wap_date','YYYY-MM-DD')"  style="cursor:pointer"/>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" class="form_text">* บันทึก :</td>
                    <td align="left" valign="top"><textarea id="wap_memo" name="wap_memo" rows="6" cols="50"<?php if ($_SESSION['USER_TYPE'] == 'chief' || $_SESSION['USER_TYPE'] == 'user') { ?> readonly="readonly"<?php } ?>></textarea>
                      <input type="hidden" id="wap_id" name="wap_id" value="" />
                    </td>
                  </tr>

                  <tr>
                    <td align="right" >&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                    <tr>
                      <td height="44" align="right" valign="top" >
                        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                      </td>
                      <td colspan="2" align="left" valign="top">

                        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('warn_punish.php','../images/head2/work_data2/warn.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>

                      </td>
                    </tr><?php } ?> &nbsp;
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