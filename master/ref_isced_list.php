<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">
  function open_a() {
    $('#fAdd9').dialog({
      modal: true,
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var isced_id = $('#isced_id').val();
          var isced_name_th = $('#isced_name_th').val();
          var isced_name_eng = $('#isced_name_eng').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_isced_list_ajax.php',
            data : {mode : 'add',
              isced_id : isced_id,
              isced_name_th : isced_name_th,
              isced_name_eng : isced_name_eng
            },
            success : function(data){
              $('#tableList').load('../master/ref_isced_list.php?'+Math.random()+' #tableList');
              alert(data)
            }
          });
          $(this).dialog('close');
        },
        'ยกเลิก': function() {
          $(this).dialog('close');
        }
      },
      width: '500px'
    });
  }
  function open_f(code) {
    //alert(code);
    $('#show_ecode').text(code);
    $('#e_code').val(code);
    $('#e_th').val($('#position_txt_'+code).text());
    $('#e_eng').val($('#uoc_txt_'+code).text());
    $('#fEdit9').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_th = $('#e_th').val();
          var e_eng = $('#e_eng').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_isced_list_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_th : e_th,
              e_eng : e_eng
            },
            success : function(data){
              $('#tableList').load('../master/ref_isced_list.php?'+Math.random()+' #tableList');
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
 
    $('#d_position').text($('#position_txt_'+code).text());
    $('#d_code').val(code);
    $('#fDel9').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_isced_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_isced_list.php?'+Math.random()+' #tableList');
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
    <h3>Master ประเภทของงบประมาณ</h3>
    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList">
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1" class="all_table">
        <tr>
          <th width="79" scope="col">ISCED ID</th>
          <th width="292" scope="col">ISCED NAME TH</th>
          <th width="292" scope="col">ISCED NAME ENG</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT ISCED_ID,ISCED_NAME_TH,ISCED_NAME_ENG FROM REF_ISCED ORDER BY ISCED_ID ";
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
            <td><span id="id_<?php echo $rc['ISCED_ID']; ?>"><?php echo $rc['ISCED_ID']; ?></span></td>
            <td><span id="position_txt_<?php echo $rc['ISCED_ID']; ?>"><?php echo $rc['ISCED_NAME_TH']; ?></span></td>
            <td><span id="uoc_txt_<?php echo $rc['ISCED_ID']; ?>"><?php echo $rc['ISCED_NAME_ENG']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['ISCED_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['ISCED_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
          $last_id = $rc['CODE_DEPARTMENT_SECTION'];
        }
        $last_id++;
        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit9" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">ISCED ID :</td> 
          <td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code"></td>
        </tr>
        <tr>
          <td align="right">ISCED NAME TH :</td> 
          <td><input type="text" id="e_th" name="e_th" /></td>
        </tr>
        <tr>
          <td align="right">ISCED NAME ENG :</td>
          <td><input type="text" id="e_eng" name="e_eng" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel9"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd9" style="display:none" title="เพิ่มใหม่">
      <table style="border:none;">
        <tr>
          <td align="right">ISCED ID :</td>
          <td><input type="text" name="isced_id" id="isced_id" /></td>
        </tr>
        <tr>
          <td align="right">ISCED NAME TH :</td>
          <td><input type="text" name="isced_name_th" id="isced_name_th" /></td>
        </tr>
        <tr>
          <td align="right">ISCED NAME ENG :</td>
          <td><input type="text" name="isced_name_eng" id="isced_name_eng" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>