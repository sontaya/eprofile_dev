<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#code').val('');
    $('#position').val('');
    $('#fAdd8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var position = $('#position').val();
          $.ajax({
            type: 'POST',
            url : '../master/master_position_ajax.php',
            data : {mode : 'add',
              code : code,
              position : position
            },
            success : function(data){
              $('#tableList').load('../master/master_position.php?'+Math.random()+' #tableList');
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
    $('#e_position').val($('#position_txt_'+code).text());
    $('#fEdit8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_position = $('#e_position').val();
          $.ajax({
            type: 'POST',
            url : '../master/master_position_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_position : e_position
            },
            success : function(data){
              $('#tableList').load('../master/master_position.php?'+Math.random()+' #tableList');
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
    $('#fDel8').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/master_position_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/master_position.php?'+Math.random()+' #tableList');
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
    <h3>Master Position</h3>

    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id ="tableList">
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1" class="all_table">
        <tr>
          <th width="79" scope="col">Code</th>
          <th width="292" scope="col">Position</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT code, position  FROM sdu_position ORDER BY code ";
        $st = oci_parse($conn, $sql);
        //echo $sql;
        if (!oci_execute($st)) {
          $err = oci_error($st);
          trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
        }

        while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
          //echo $rc['POSITION'];
          //}
          ?>
          <tr>
            <td><?php echo $rc['CODE']; ?></td>
            <td><span id="position_txt_<?php echo $rc['CODE']; ?>"><?php echo $rc['POSITION']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['CODE']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['CODE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <div id="fEdit8" style="display:none;" title="แก้ไข">
      <table style=" border:none;">
        <tr>
          <td align="right">Code :</td> 
          <td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code" /></td>
        </tr>
        <tr>
          <td align="right">Position :</td> 
          <td><input type="text" id="e_position" name="e_position" /></td>
        </tr>
      </table>

    </div>
    <div id="fDel8"  style="display:none;" title="ลบ">


      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />

    </div>
    <div id="fAdd8" style="display:none" title="เพิ่มใหม่">

      <legend>เพิ่มข้อมูล</legend>
      <table style="border:none;">
        <tr>
          <td align="right">Code :</td>
          <td><input type="text" name="code" id="code" /></td>
        </tr>
        <tr>
          <td align="right">Position :</td>
          <td><input type="text" name="position" id="position" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>