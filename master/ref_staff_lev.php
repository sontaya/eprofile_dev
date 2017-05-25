<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#code').val('');
    $('#staff_lev_name').val('');
    $('#detail').val('');
    $('#fAdd8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var staff_lev_name = $('#staff_lev_name').val();
          var detail = $('#detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_staff_lev_ajax.php',
            data : {mode : 'add',
              code : code,
              staff_lev_name : staff_lev_name,
              detail : detail
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_lev.php?'+Math.random()+' #tableList');
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
    $('#e_staff_lev_name').val($('#staff_lev_name_txt_'+code).text());
    $('#e_detail').val($('#detail_txt_'+code).text());
    $('#fEdit8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_staff_lev_name = $('#e_staff_lev_name').val();
          var e_detail = $('#e_detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_staff_lev_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_staff_lev_name : e_staff_lev_name,
              e_detail : e_detail
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_lev.php?'+Math.random()+' #tableList');
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
            url : '../master/ref_staff_lev_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_staff_lev.php?'+Math.random()+' #tableList');
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
    <h3>Master ระดับตำแหน่ง</h3>

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
          <th width="292" scope="col">Staff lev name</th>
          <th width="292" scope="col">Detail</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT STAFF_LEV_ID, STAFF_LEV_NAME , DETAIL FROM sdu_ref_staff_lev ORDER BY STAFF_LEV_ID ";
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
            <td><?php echo $rc['STAFF_LEV_ID']; ?></td>
            <td><span id="staff_lev_name_txt_<?php echo $rc['STAFF_LEV_ID']; ?>"><?php echo $rc['STAFF_LEV_NAME']; ?></span></td>
            <td><span id="detail_txt_<?php echo $rc['STAFF_LEV_ID']; ?>"><?php echo $rc['DETAIL']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['STAFF_LEV_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['STAFF_LEV_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
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
          <td align="right">Staff lev name :</td> 
          <td><input type="text" id="e_staff_lev_name" name="e_staff_lev_name" /></td>
        </tr>
        <tr>
          <td align="right">Detail :</td>
          <td><input type="text" id="e_detail" name="e_detail" /></td>
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
          <td align="right">Staff lev name :</td>
          <td><input type="text" name="staff_lev_name" id="staff_lev_name" /></td>
        </tr>
        <tr>
          <td align="right">Detail :</td>
          <td><input type="text" id="detail" name="detail" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>