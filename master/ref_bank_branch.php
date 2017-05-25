<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    //alert("555");
    $('#stafftype_normal_id').val('');
    $('#stafftype_sga_id').val('');
    $('#fAdd11').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var stafftype_normal_id = $('#stafftype_normal_id').val();
          var stafftype_sga_id = $('#stafftype_sga_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_bank_branch_ajax.php',
            data : {mode : 'add',
              stafftype_normal_id : stafftype_normal_id,
              stafftype_sga_id : stafftype_sga_id,
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_branch.php?'+Math.random()+' #tableList');
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
    $('#fEdit11').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_stafftype_normal_id = $('#e_stafftype_normal_id').val();
          var e_stafftype_sga_id = $('#e_stafftype_sga_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_bank_branch_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_stafftype_normal_id : e_stafftype_normal_id,
              e_stafftype_sga_id : e_stafftype_sga_id,
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_branch.php?'+Math.random()+' #tableList');
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
            url : '../master/ref_bank_branch_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_branch.php #tableList' );
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
    <h3>Master สาขาธนาคาร</h3>
    <?php

    function name_bank($staff_id) {
      global $conn;
      $sql = "SELECT * FROM sdu_bank WHERE BANK_ID = '{$staff_id}' ";
      $st = oci_parse($conn, $sql);
      if (!oci_execute($st)) {
        $err = oci_error($st);
        trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
      }
      $rc = oci_fetch_array($st, OCI_ASSOC);
      return $rc['BANK_NAME'];
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
          <th width="79" scope="col">ลำดับที่</th>
          <th width="292" scope="col">ชื่อธนาคาร</th>
          <th width="292" scope="col">สาขาธนาคาร</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT BRANCH_ID, BANK_ID, BRANCH_NAME FROM SDU_BANK_BRANCH ORDER BY BRANCH_ID ";
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
              <span id="stafftype_normal_id_<?php echo $rc['BRANCH_ID']; ?>">
                <?php echo name_bank($rc['BANK_ID']); ?>
                <input type="hidden" id="stafftype_normal_<?php echo $rc['BRANCH_ID']; ?>" value="<?= $rc['BANK_ID'] ?>" />
              </span>
            </td>
            <td>
              <span id="stafftype_sga_id_<?php echo $rc['BRANCH_ID']; ?>">
                <?php echo $rc['BRANCH_NAME']; ?>
                <input type="hidden" id="stafftype_sga_<?php echo $rc['BRANCH_ID']; ?>" value="<?= $rc['BRANCH_NAME'] ?>" />
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
          <td align="right">ชื่อธนาคาร : </td>
<!--        <input type="text" id="e_stafftype_normal_id" name="e_stafftype_normal_id" />-->
          <td><select id="e_stafftype_normal_id" name="e_stafftype_normal_id">
              <option>- เลือก -</option>
              <?
              $sql_normal = "SELECT * FROM SDU_BANK ORDER BY BANK_ID ";
              $st_normal = oci_parse($conn, $sql_normal);
              if (!oci_execute($st_normal)) {
                $err = oci_error($st_normal);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_normal = oci_fetch_array($st_normal, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_normal['BANK_ID'] ?>"><?= $rc_normal['BANK_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">Staff sga name :</td>
          <td><input type="text" id="e_stafftype_sga_id" name="e_stafftype_sga_id" /></td>
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
          <td align="right">ชื่อธนาคาร :</td>
          <td><select id="stafftype_normal_id" name="stafftype_normal_id">
              <option>- เลือก -</option>
              <?
              $sql_normal = "SELECT * FROM SDU_BANK ORDER BY BANK_ID ";
              $st_normal = oci_parse($conn, $sql_normal);
              if (!oci_execute($st_normal)) {
                $err = oci_error($st_normal);
                trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
              }
              while ($rc_normal = oci_fetch_array($st_normal, OCI_ASSOC)) {
                ?>
                <option value="<?= $rc_normal['BANK_ID'] ?>"><?= $rc_normal['BANK_NAME'] ?></option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">ชื่อสาขา :</td>
          <td><input type="text" id="stafftype_sga_id" name="stafftype_sga_id" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>