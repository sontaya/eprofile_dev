<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#admin_id').val('');
    $('#admin_name').val('');
    $('#fAdd2').dialog({
      modal: true,
      width: '500px',
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var admin_id = $('#admin_id').val();
          var admin_name = $('#admin_name').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_admin_list_ajax.php',
            data : {mode : 'add',
              admin_id : admin_id,
              admin_name : admin_name
            },
            success : function(data){
              $('#tableList').load('../master/ref_admin_list.php?'+Math.random()+' #tableList');
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
    $('#show_eid').text(code);
    $('#e_id').val(code);
    $('#e_name').val($('#admin_txt_'+code).text());
    $('#fEdit2').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_id = $('#e_id').val();
          var e_name = $('#e_name').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_admin_list_ajax.php',
            data : {mode : 'edit',
              e_id : e_id,
              e_name : e_name
            },
            success : function(data){
              $('#tableList').load('../master/ref_admin_list.php?'+Math.random()+' #tableList');
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
    $('#d_position').text($('#admin_txt_'+code).text());
    $('#d_id').val(code);
    $('#fDel2').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_id = $('#d_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_admin_list_ajax.php',
            data : {mode : 'delete',
              d_id : d_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_admin_list.php?'+Math.random()+' #tableList');
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
  <div id="mainContainer">
    <h3>Master ตำแหน่งงานทางบริหาร</h3>
    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList" >
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1"  class="all_table" >
        <tr>
          <th width="79" scope="col">ADMIN ID</th>
          <th width="292" scope="col">ADMIN NAME</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected

        $last_id = '';

        $sql = "SELECT ADMIN_ID, ADMIN_NAME FROM SDU_REF_ADMIN ORDER BY ADMIN_ID ";
        $st = oci_parse($conn, $sql);

        if (!oci_execute($st)) {
          $err = oci_error($st);
          trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
        }

        while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
          //echo $rc['POSITION'];
          //}
          ?>
          <tr>
            <td><?php echo $rc['ADMIN_ID']; ?></td>
            <td><span id="admin_txt_<?php echo $rc['ADMIN_ID']; ?>"><?php echo $rc['ADMIN_NAME']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['ADMIN_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" class="vtip" title="Edit" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['ADMIN_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" class="vtip" title="Delete" /></span></td>
          </tr>
          <?php
          $last_id = $rc['ADMIN_ID']; // เอาไว้สำหรับสร้างใหม่
        }
        $last_id++;
        $last_id = str_pad($last_id, 2, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit2" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">ADMIN ID :</td><td><span id="show_eid"></span><input type="hidden" name="e_id" id="e_id"></td>
        </tr>
        <tr>
          <td align="right">ADMIN NAME :</td><td><input type="text" id="e_name" name="e_name" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel2"  style="display:none;" title="ลบ">
      <span id="d_position"></span><br />
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_id" id="d_id" />
    </div>
    <div id="fAdd2" style="display:none" title="เพิ่มใหม่">
      <table style="border:none;">
        <tr>
          <td align="right">ADMIN ID :</td>
          <td><input type="text" name="admin_id" id="admin_id" value="<?php echo $last_id; ?>" /></td>
        </tr>
        <tr>
          <td align="right">ADMIN NAME :</td>
          <td><input type="text" name="admin_name" id="admin_name" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>