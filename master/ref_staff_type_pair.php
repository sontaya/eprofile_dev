<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    //alert("555");
    $('#stafftype_normal_id').val('');
    $('#stafftype_sga_id').val('');
    $('#stafftype_sub_id').val('');
    $('#fAdd11').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var stafftype_normal_id = $('#stafftype_normal_id').val();
          var stafftype_sga_id = $('#stafftype_sga_id').val();
          var stafftype_sub_id = $('#stafftype_sub_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_staff_type_pair_ajax.php',
            data : {mode : 'add',
              stafftype_normal_id : stafftype_normal_id,
              stafftype_sga_id : stafftype_sga_id,
              stafftype_sub_id : stafftype_sub_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_type_pair.php?'+Math.random()+' #tableList');
              alert(data)
            }
          });
          $(this).dialog('close');
        },
        'ยกเลิก': function() {
          $(this).dialog('close');
        }
      }
    });
  }
  function open_f(code) {
    //alert(code);
    $('#show_ecode').text(code);
    $('#e_code').val(code);
    $('#e_stafftype_normal_id').val($('#stafftype_normal_'+code).val());
    $('#e_stafftype_sga_id').val($('#stafftype_sga_'+code).val());
    $('#e_stafftype_sub_id').val($('#stafftype_sub_'+code).val());
    $('#fEdit11').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_stafftype_normal_id = $('#e_stafftype_normal_id').val();
          var e_stafftype_sga_id = $('#e_stafftype_sga_id').val();
          var e_stafftype_sub_id = $('#e_stafftype_sub_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_staff_type_pair_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_stafftype_normal_id : e_stafftype_normal_id,
              e_stafftype_sga_id : e_stafftype_sga_id,
              e_stafftype_sub_id : e_stafftype_sub_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_type_pair.php?'+Math.random()+' #tableList');
              alert(data);
            }
          });
          $(this).dialog('close');
        },
        'ยกเลิก': function() {
          $(this).dialog('close');
        }
      }
    });
  }
	
  function open_d(code) {
    $('#d_code').val(code);
    $('#fDel11').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_staff_type_pair_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_type_pair.php #tableList' );
              alert (data);
            }
          });
          $(this).dialog('close');
        },
        'ยกเลิก': function() {
          $(this).dialog('close');
        }
      },
      resizable: false,
      width: '500px'
    });
  }
</script>
</head>

<body>
  <div id="mainContainer" >
    <h3>Master จับคู่ประเภทบุคลากร</h3>
    <?php

    function name_stafftype($staff_id) {
      global $conn;
      $sql = "SELECT * FROM sdu_ref_stafftype WHERE stafftype_id = '{$staff_id}' ";
      $st = oci_parse($conn, $sql);
      if (!oci_execute($st)) {
        $err = oci_error($st);
        trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
      }
      $rc = oci_fetch_array($st, OCI_ASSOC);
      return $rc['STAFFTYPE_NAME'];
    }

    function name_stafftype_sga($staff_id) {
      global $conn;
      $sql = "SELECT * FROM sdu_ref_stafftype_sga WHERE stafftype_id = '{$staff_id}' ";
      $st = oci_parse($conn, $sql);
      if (!oci_execute($st)) {
        $err = oci_error($st);
        trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
      }
      $rc = oci_fetch_array($st, OCI_ASSOC);
      return $rc['STAFFTYPE_NAME'];
    }

    function name_substafftype($staff_id) {
      global $conn;
      $sql = "SELECT * FROM sdu_ref_substafftype WHERE substafftype_id = '{$staff_id}' ";
      $st = oci_parse($conn, $sql);
      if (!oci_execute($st)) {
        $err = oci_error($st);
        trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
      }
      $rc = oci_fetch_array($st, OCI_ASSOC);
      return $rc['SUBSTAFFTYPE_NAME'];
    }
    ?>
    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList" >
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1" class="all_table">
        <tr>
          <th width="79" scope="col">Order</th>
          <th width="292" scope="col">Staff normal name</th>
          <th width="292" scope="col">Staff sga name</th>
          <th width="292" scope="col">Staff sub name</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT stafftype_pair_id, stafftype_normal_id, stafftype_sga_id, stafftype_sub_id FROM sdu_ref_stafftype_pair ORDER BY stafftype_pair_id ";
        $st = oci_parse($conn, $sql);

        if (!oci_execute($st)) {
          $err = oci_error($st);
          trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
        }
        $i = 0;
        while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
          $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td>
              <span id="stafftype_normal_id_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>">
                <?php echo name_stafftype($rc['STAFFTYPE_NORMAL_ID']); ?>
                <input type="hidden" id="stafftype_normal_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>" value="<?= $rc['STAFFTYPE_NORMAL_ID'] ?>" />
              </span>
            </td>
            <td>
              <span id="stafftype_sga_id_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>">
                <?php echo name_stafftype_sga($rc['STAFFTYPE_SGA_ID']); ?>
                <input type="hidden" id="stafftype_sga_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>" value="<?= $rc['STAFFTYPE_SGA_ID'] ?>" />
              </span>
            </td>
            <td>
              <span id="stafftype_sub_id_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>">
                <?php echo name_substafftype($rc['STAFFTYPE_SUB_ID']); ?>
                <input type="hidden" id="stafftype_sub_<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>" value="<?= $rc['STAFFTYPE_SUB_ID'] ?>" />
              </span>
            </td>
            <td align="center"><span onClick="open_f('<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['STAFFTYPE_PAIR_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <div id="fEdit11" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">Code :</td>
          <td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code" /></td>
        </tr>
        <tr>
          <td align="right">Staff normal name : </td>
<!--        <input type="text" id="e_stafftype_normal_id" name="e_stafftype_normal_id" />-->
          <td><select id="e_stafftype_normal_id" name="e_stafftype_normal_id">
              <option>- เลือก -</option>
              <?
              $sql_normal = "SELECT * FROM sdu_ref_stafftype ORDER BY stafftype_id ";
              $st_normal = oci_parse($conn, $sql_normal);
              if (!oci_execute($st_normal)) {
                $err = oci_error($st_normal);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_normal = oci_fetch_array($st_normal, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_normal['STAFFTYPE_ID'] ?>"><?= $rc_normal['STAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">Staff sga name :</td>
          <td><select id="e_stafftype_sga_id" name="e_stafftype_sga_id">
              <option>- เลือก -</option>
              <?
              $sql_sga = "SELECT * FROM sdu_ref_stafftype_sga ORDER BY stafftype_id ";
              $st_sga = oci_parse($conn, $sql_sga);
              if (!oci_execute($st_sga)) {
                $err = oci_error($st_sga);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_sga = oci_fetch_array($st_sga, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_sga['STAFFTYPE_ID'] ?>"><?= $rc_sga['STAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td>Substaff name :</td>
          <td><select id="e_stafftype_sub_id" name="e_stafftype_sub_id">
              <option>- เลือก -</option>
              <?
              $sql_sub = "SELECT * FROM sdu_ref_substafftype ORDER BY substafftype_id ";
              $st_sub = oci_parse($conn, $sql_sub);
              if (!oci_execute($st_sub)) {
                $err = oci_error($st_sub);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_sub = oci_fetch_array($st_sub, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_sub['SUBSTAFFTYPE_ID'] ?>"><?= $rc_sub['SUBSTAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
      </table>
    </div>
    <div id="fDel11"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd11" style="display:none" title="เพิ่มใหม่">
      <legend>เพิ่มข้อมูล</legend><br/>
      <table style="border:none;">
        <tr>
          <td align="right">Staff normal name :</td>
          <td><select id="stafftype_normal_id" name="stafftype_normal_id">
              <option>- เลือก -</option>
              <?
              $sql_normal = "SELECT * FROM sdu_ref_stafftype ORDER BY stafftype_id ";
              $st_normal = oci_parse($conn, $sql_normal);
              if (!oci_execute($st_normal)) {
                $err = oci_error($st_normal);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_normal = oci_fetch_array($st_normal, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_normal['STAFFTYPE_ID'] ?>"><?= $rc_normal['STAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">Staff sga name :</td>
          <td><select id="stafftype_sga_id" name="stafftype_sga_id">
              <option>- เลือก -</option>
              <?
              $sql_sga = "SELECT * FROM sdu_ref_stafftype_sga ORDER BY stafftype_id ";
              $st_sga = oci_parse($conn, $sql_sga);
              if (!oci_execute($st_sga)) {
                $err = oci_error($st_sga);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_sga = oci_fetch_array($st_sga, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_sga['STAFFTYPE_ID'] ?>"><?= $rc_sga['STAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">Substaff name :</td>
          <td><select id="stafftype_sub_id" name="stafftype_sub_id">
              <option>- เลือก -</option>
              <?
              $sql_sub = "SELECT * FROM sdu_ref_substafftype ORDER BY substafftype_id ";
              $st_sub = oci_parse($conn, $sql_sub);
              if (!oci_execute($st_sub)) {
                $err = oci_error($st_sub);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_sub = oci_fetch_array($st_sub, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_sub['SUBSTAFFTYPE_ID'] ?>"><?= $rc_sub['SUBSTAFFTYPE_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>