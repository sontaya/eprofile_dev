<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">
  function open_a() {
    $('#id').val('');
    $('#name').val('');
    $('#abbreviation').val('');
    $('#order').val('');
    $('#fAdd6').dialog({
      modal: true,
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var id = $('#id').val();
          var name = $('#name').val();
          var abbreviation = $('#abbreviation').val();
          var order = $('#order').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_extra_salary_list_ajax.php',
            data : {mode : 'add',
              id : id,
              name : name,
              abbreviation : abbreviation,
              order : order
            },
            success : function(data){
              $('#tableList').load('../master/ref_extra_salary_list.php?'+Math.random()+' #tableList');
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
    $('#e_id').val(code);
    $('#e_position').val($('#position_txt_'+code).text());
		
    $('#e_name').val($('#position_txt_'+code).text());
    $('#e_abbreviation').val($('#uoc_txt_'+code).text());
    $('#e_order').val($('#od_'+code).text());
		
    $('#fEdit6').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_id = $('#e_id').val();
          var e_position = $('#e_position').val();
          var e_name = $('#e_name').val();
          var e_abbreviation = $('#e_abbreviation').val();
          var e_order = $('#e_order').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_extra_salary_list_ajax.php',
            data : {mode : 'edit',
              e_id : e_id,
              e_position : e_position,
              e_name : e_name,
              e_abbreviation : e_abbreviation,
              e_order : e_order
            },
            success : function(data){
              $('#tableList').load('../master/ref_extra_salary_list.php?'+Math.random()+' #tableList');
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
    $('#fDel6').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_extra_salary_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_extra_salary_list.php?'+Math.random()+' #tableList');
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
    <h3>Master เงินพิเศษ</h3>
    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList">

      <script src="../js/vtip.js" type="text/javascript"></script>

      <table width="600" border="1" class="all_table">
        <tr>
          <th width="79" scope="col">ID</th>
          <th width="292" scope="col">NAME</th>
          <th width="292" scope="col">ABBREVIATION</th>
          <th width="292" scope="col">ORDERS</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        $last_id = '';
        // require connected
        $sql = "SELECT ID, NAME, ABBREVIATION, ORDERS FROM SDU_REF_EXTRA_SALARY ORDER BY ID ";
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
            <td><?php echo $rc['ID']; ?></td>
            <td><span id="position_txt_<?php echo $rc['ID']; ?>"><?php echo $rc['NAME']; ?></span></td>
            <td><span id="uoc_txt_<?php echo $rc['ID']; ?>"><?php echo $rc['ABBREVIATION']; ?></span></td>
            <td><span id="od_<?php echo $rc['ID']; ?>"><?php echo $rc['ORDERS']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
          $last_id = $rc['ID'];
        }
        $last_id++;
        $last_id = str_pad($last_id, 2, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit6" style="display:none;" title="แก้ไข">

      <table style="border:none;">
        <tr>
          <td align="right">ID :</td>
          <td><span id="show_ecode"></span><input type="hidden" name="e_id" id="e_id" /></td>
        </tr>
        <tr>
          <td align="right">NAME :</td>
          <td><input type="text" name="e_name" id="e_name" /></td>
        </tr>
        <tr>
          <td align="right">ABBREVIATION :</td>
          <td><input type="text" name="e_abbreviation" id="e_abbreviation" /></td>
        </tr>
        <tr>
          <td align="right">ORDER :</td> 
          <td><input type="text" name="e_order" id="e_order" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel6"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd6" style="display:none" title="เพิ่มใหม่">
      <table style="border:none;">
        <tr>
          <td align="right">ID :</td>
          <td><input type="text" name="id" id="id" value="<?php echo $last_id; ?>" /></td>
        </tr>
        <tr>
          <td align="right">NAME :</td>
          <td><input type="text" name="name" id="name" /></td>
        </tr>
        <tr>
          <td align="right">ABBREVIATION :</td>
          <td><input type="text" name="abbreviation" id="abbreviation" /></td>
        </tr>
        <tr>
          <td align="right">ORDER :</td> 
          <td><input type="text" name="order" id="order" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>