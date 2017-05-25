<?
@session_start();
$fpath = '';
require_once($fpath . "../includes/connect.php");
$sql = "SELECT * FROM  " . TB_POSITION_SUB_TAB . "  WHERE  EMP_ID= '" . $_SESSION["EMP_ID"] . "' AND VP_TYPE = '1' ";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
$row1 = oci_fetch_array($stid, OCI_BOTH);
?>
<script language="javascript">
  $(function() {
				

    $.post("ajax_get_data_ref.php", { task: "universitylist" },
    function(data) {
      university = $.parseJSON(data);
      $("#vp_university1").autocomplete({
        source: university
      });
    });
    
    $.post("ajax_get_data_ref.php", { task: "expertlist" },
    function(data) {
      expert = $.parseJSON(data);
      $("#vp_professional_major1").autocomplete({
        source: expert
      });
    });
  });
</script>
<script type="text/javascript" src="../js/edit_by_user.js"></script>
<table width="670" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td align="right" class="form_text"> * วิธีขอกำหนดตำแหน่ง :</td>
    <td align="left">
      <select id="vp_method1" name="vp_method1"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
        <option value="">--เลือกข้อมูล--</option>
        <option value="1" <? if ($row1["VP_METHOD"] == "1") { echo "selected='selected'"; } ?>>ปกติ</option>
        <option value="2" <? if ($row1["VP_METHOD"] == "2") { echo "selected='selected'"; } ?>>พิเศษ</option>
        <option value="3" <? if ($row1["VP_METHOD"] == "3") { echo "selected='selected'"; } ?>>อื่นๆ</option>
      </select>
      &nbsp;&nbsp;&nbsp;แต่งตั้งโดย :
      <select id="vp_by1" name="vp_by1"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?> >
        <option  value="">--เลือกข้อมูล--</option>
        <option value="1" <? if ($row1["VP_BY"] == "1") { echo "selected='selected'"; } ?>>กพอ.</option>
        <option value="2" <? if ($row1["VP_BY"] == "2") { echo "selected='selected'"; } ?>>กกอ.</option>
        <option value="3" <? if ($row1["VP_BY"] == "3") { echo "selected='selected'"; } ?>>กม.</option>
        <option value="4" <? if ($row1["VP_BY"] == "4") { echo "selected='selected'"; } ?>>กสอ.</option>
        <option value="5" <? if ($row1["VP_BY"] == "5") { echo "selected='selected'"; } ?>>กค.</option>
        <option value="6" <? if ($row1["VP_BY"] == "6") { echo "selected='selected'"; } ?>>สภาสถาบัน</option>
        <option value="8" <? if ($row1["VP_BY"] == "8") { echo "selected='selected'"; } ?>>สภามหาวิทยาลัย</option>
        <option value="7" <? if ($row1["VP_BY"] == "7") { echo "selected='selected'"; } ?>>หน่วยงานอื่นๆ</option>
      </select>
    </td>
  </tr>
  <tr>
    <td align="right" class="form_text"> * มหาวิทยาลัย/สถาบันการศึกษา :</td>
    <td align="left" class="form_text"><input type="text" name="vp_university1" id="vp_university1" style="width: 300px;" class="input_text" value="<?= $row1["VP_UNIVERSITY"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
  </tr>
  <tr>
    <td align="right" class="form_text"> * สาขาวิชาที่ขอกำหนดตำแหน่ง :</td>
    <td align="left"><input type="text" name="vp_professional_major1" id="vp_professional_major1" style="width: 300px;" class="input_text" value="<?= $row1["VP_PROFESSIONAL_MAJOR"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/></td>
  </tr>
  <tr>
    <td align="right" > * วันที่ได้รับอนุมัติแต่งตั้ง :</td>
    <td align="left"><input  type="text" name="vp_date1" id="vp_date1" style="width:80px;" class="input_text" value="<?= change_date_thai($row1["VP_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> <img src="../images/vcalendar.png" align="absmiddle"<?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?> onclick="showCalendar('vp_date1','YYYY-MM-DD')"<?php } ?>  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td align="right" > คำสั่งที่ :</td>
    <td align="left"><input type="text" name="vp_order1" id="vp_order1" style="width: 80px;" class="input_text"  maxlength="2" value="<?= $row1["VP_ORDER"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>   ณ วันที่ <input type="text" name="vp_order_date1" id="vp_order_date1" style="width: 80px;" class="input_text" value="<?= change_date_thai($row1["VP_ORDER_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> <img src="../images/vcalendar.png" align="absmiddle"<?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?> onclick="showCalendar('vp_order_date1','YYYY-MM-DD')"<?php } ?>  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td align="right" > * มติที่ประชุมสภามหาวิทยาลัย/สถาบันการศึกษา ครั้งที่ :</td>
    <td align="left"><input type="text" name="vp_mati_11" id="vp_mati_11" style="width: 20px;" class="input_text"  maxlength="2" value="<?= $row1["VP_MATI_1"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>   วันที่ <input type="text" name="vp_mati_21" id="vp_mati_21" style="width: 80px;" class="input_text" value="<?= change_date_thai($row1["VP_MATI_2"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> <img src="../images/vcalendar.png" align="absmiddle"<?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?> onclick="showCalendar('vp_mati_21','YYYY-MM-DD')"<?php } ?>  style="cursor:pointer"/></td>
  </tr>
</table>
<?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
  <table border="0">
    <tr>
      <td width="441" height="47" align="right" valign="middle" >
        <input type="button" value="แก้ไขข้อมูลการกำหนดตำแหน่ง" onclick="check_data('1')"/> 
        <input type="button" value="ลบการขอกำหนดตำแหน่ง" onclick="del_pos('1')" /></td>
      <td width="214" height="47" align="left" valign="middle" > <span id="waiting1"></span></td>
    </tr>
  </table>
<?php } ?>
<?
oci_free_statement($stid);
$db->closedb($conn);
?>