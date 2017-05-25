<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">
  function open_a() {
    $('#code').val('');
    $('#code_department_group').val('');
    $('#name_department_group').val('');
    $('#fAdd3').dialog({
      modal: true,
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var code_department_group = $('#code_department_group').val();
          var name_department_group = $('#name_department_group').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_group_list_ajax.php',
            data : {
              mode : 'add',
              code : code,
              code_department_group : code_department_group,
              name_department_group : name_department_group
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_group_list.php?'+Math.random()+' #tableList');
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
    $('#show_groupcode').text(code);
    $('#show_subcode').text($('#sub_'+code).text());
    $('#e_groupcode').val(code);
    $('#e_subcode').val($('#sub_'+code).text());
    $('#e_group').val($('#name_txt_'+code).text());
    $('#fEdit3').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var show_subcode = $('#show_subcode').val();
          var e_groupcode = $('#e_groupcode').val();
          var e_subcode = $('#e_subcode').val();
          var e_group = $('#e_group').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_group_list_ajax.php',
            data : {mode : 'edit',
              show_subcode : show_subcode,
              e_groupcode : e_groupcode,
              e_subcode : e_subcode,
              e_group : e_group
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_group_list.php?'+Math.random()+' #tableList');
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
    $('#fDel3').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_group_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_group_list.php?'+Math.random()+' #tableList');
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
    <h3>Master กลุ่มงาน</h3>
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
          <th width="79" scope="col">CODE DEPARTMENT SUB</th>
          <th width="292" scope="col">CODE DEPARTMENT GROUP</th>
          <th width="292" scope="col">NAME DEPARTMENT GROUP</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        $last_id = '';
        // require connected
        $sql = "SELECT CODE_DEPARTMENT_SUB, CODE_DEPARTMENT_GROUP, NAME_DEPARTMENT_GROUP FROM SDU_REF_DEPARTMENT_GROUP ORDER BY CODE_DEPARTMENT_SUB ";
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
            <td><span id="sub_<?php echo $rc['CODE_DEPARTMENT_GROUP']; ?>"><?php echo $rc['CODE_DEPARTMENT_SUB']; ?></span></td>
            <td><span id="position_txt_<?php echo $rc['CODE_DEPARTMENT_GROUP']; ?>"><?php echo $rc['CODE_DEPARTMENT_GROUP']; ?></span></td>
            <td><span id="name_txt_<?php echo $rc['CODE_DEPARTMENT_GROUP']; ?>"><?php echo $rc['NAME_DEPARTMENT_GROUP']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['CODE_DEPARTMENT_GROUP']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" class="vtip" title="Edit" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['CODE_DEPARTMENT_GROUP']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" class="vtip" title="Delete" /></span></td>
          </tr>
          <?php
          $last_id = $rc['CODE_DEPARTMENT_GROUP'];
        }
        $last_id++;
        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit3" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">CODE DEPARTMENT SUB :</td><td><span id="show_subcode"></span><input type="hidden" name="e_subcode" id="e_subcode"></td>
        </tr>
        <tr>
          <td align="right">CODE DEPARTMENT GROUP :</td><td><span id="show_groupcode"></span><input type="hidden" name="e_groupcode" id="e_groupcode"></td>
        </tr>
        <tr>
          <td align="right">NAME DEPARTMENT GROUP :</td><td><input type="text" id="e_group" name="e_group" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel3"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd3" style="display:none" title="เพิ่มใหม่">
      <table style="border:none;">
        <tr>
          <td align="right">CODE DEPARTMENT SUB :</td>
          <td><input type="text" name="code" id="code" /></td>
        </tr>
        <tr>
          <td align="right">CODE DEPARTMENT GROUP :</td> 
          <td><input type="text" name="code_department_group" id="code_department_group" value="<?php echo $last_id; ?>" /></td>
        </tr>
        <tr>
          <td align="right">NAME DEPARTMENT GROUP :</td> 
          <td><input type="text" name="name_department_group" id="name_department_group" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>