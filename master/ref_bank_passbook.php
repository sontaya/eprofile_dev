<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    //$('#code').val('');
    //$('#staff_lev_name').val('');
    //$('#detail').val('');
    $('#fAdd8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var expert_name = $('#expert_name').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_bank_passbook_ajax.php',
            data : {mode : 'add',
              expert_name : expert_name  
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_passbook.php?'+Math.random()+' #tableList');
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
	
    $('#e_expert_name').val($('#expert_name_id_'+code).text());
    $('#e_expert_id').val(code);
	
    /*
    $('#show_ecode').text(code);
    $('#e_code').val(code);
    $('#e_staff_lev_name').val($('#staff_lev_name_txt_'+code).text());
    $('#e_detail').val($('#detail_txt_'+code).text());
     */
    $('#fEdit8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_expert_id = $('#e_expert_id').val();
          var e_expert_name = $('#e_expert_name').val();
          //var e_detail = $('#e_detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_bank_passbook_ajax.php',
            data : {mode : 'edit',
              e_expert_id : e_expert_id,
              e_expert_name : e_expert_name
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_passbook.php?'+Math.random()+' #tableList');
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
          var expert_id = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_bank_passbook_ajax.php',
            data : {mode : 'delete',
              expert_id : expert_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_bank_passbook.php?'+Math.random()+' #tableList');
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
  <div id="fEdit8" style="display:none;" title="แก้ไข">
    <table style=" border:none;">
      <tr>
        <td align="right"></td> 
        <td><span id="show_ecode"></span><input type="hidden" name="e_expert_id" id="e_expert_id" /></td>
      </tr>
      <tr>
        <td align="right">ประเภทเงิน :</td> 
        <td><input type="text" id="e_expert_name" name="e_expert_name" /></td>
      </tr>
    </table>
  </div>

  <div id="fDel8"  style="display:none;" title="ลบ">


    <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
    <input type="hidden" name="d_code" id="d_code" />

  </div>

  <div id="mainContainer" >
    <h3>Master ประเภทสมุดเงินฝาก</h3>

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
          <th width="300" scope="col">ประเภทสมุดเงินฝาก</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT * FROM SDU_BANK_PASSBOOK ";
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
            <td><span id="expert_name_id_<?php echo $rc['PASSBOOK_ID']; ?>"><?php echo $rc['PASSBOOK_NAME_TH']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['PASSBOOK_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['PASSBOOK_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>


    <div id="fAdd8" style="display:none" title="เพิ่มใหม่">

      <legend>เพิ่มข้อมูล</legend>
      <table style="border:none;">
        <tr>
          <td align="right">ประเภทสมุดเงินฝาก :</td>
          <td><input type="text" name="expert_name" id="expert_name" style="width:250px;" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>