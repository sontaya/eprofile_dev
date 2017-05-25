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
          var rate_name = $('#rate_name').val();
          var rate_tax = $('#rate_tax').val();
          var rate_break = $('#rate_break').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_taxrate_ajax.php',
            data : {mode : 'add',
              rate_name : rate_name,
			  rate_tax : rate_tax,
			  rate_break : rate_break,
            },
            success : function(data){
              $('#tableList').load('../master/ref_taxrate.php?'+Math.random()+' #tableList');
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

    $('#e_expert_id').val(code);
    $('#e_rate_name').val($('#rate_name_'+code).text());
    $('#e_rate_tax').val($('#rate_tax_'+code).text());
    $('#e_rate_break').val($('#rate_break_'+code).text());
	
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
          var e_rate_name = $('#e_rate_name').val();
          var e_rate_tax = $('#e_rate_tax').val();
          var e_rate_break = $('#e_rate_break').val();

          //var e_detail = $('#e_detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_taxrate_ajax.php',
            data : {mode : 'edit',
              e_expert_id : e_expert_id,
              e_rate_name : e_rate_name,
			  e_rate_tax : e_rate_tax,
			  e_rate_break : e_rate_break,
            },
            success : function(data){
              $('#tableList').load('../master/ref_taxrate.php?'+Math.random()+' #tableList');
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
            url : '../master/ref_taxrate_ajax.php',
            data : {mode : 'delete',
              expert_id : expert_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_taxrate.php?'+Math.random()+' #tableList');
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
          <td align="right">เงินได้สุทธิ :</td>
          <td><input type="text" name="e_rate_name" id="e_rate_name" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">อัตราภาษี :</td>
          <td><input type="text" name="e_rate_tax" id="e_rate_tax" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">อัตราการลดหย่อน :</td>
          <td><input type="text" name="e_rate_break" id="e_rate_break" style="width:250px;" /></td>
        </tr>
    </table>
  </div>

  <div id="fDel8"  style="display:none;" title="ลบ">


    <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
    <input type="hidden" name="d_code" id="d_code" />

  </div>

  <div id="mainContainer" >
    <h3>Master กำหนดรหัสกองทุนสำรองเลี้ยงชีพ</h3>

    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onClick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id ="tableList">
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="658" border="1" class="all_table">
        <tr>
          <th scope="col">ชื่อกองทุนเลี้ยงชีพ</th>
          <th scope="col">ชื่อกองทุนเลี้ยงชีพ (ภาษาอังกฤษ</th>
          <th scope="col">หมายเลขกองทุนสำรองเลี้ยงชีพ</th>
          <th scope="col">อัตราการหัก (%)</th>
          <th scope="col">แก้ไข</th>
          <th scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT * FROM SDU_TAX_RATE ";
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
            <td><span id="rate_name_<?php echo $rc['RATE_CODE']; ?>"><?php echo $rc['RATE_NAME']; ?></span></td>
            <td align="center"><span id="rate_tax_<?php echo $rc['RATE_CODE']; ?>"><?php echo $rc['RATE_TAX']; ?></span></td>
            <td align="center"><span id="rate_break_<?php echo $rc['RATE_CODE']; ?>"><?php echo $rc['RATE_BREAK']; ?></span></td>
            <td align="center"><span id="rate_break_<?php echo $rc['RATE_CODE']; ?>"><?php echo $rc['RATE_BREAK']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['RATE_CODE']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['RATE_CODE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
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
          <td align="right">เงินได้สุทธิ :</td>
          <td><input type="text" name="rate_name" id="rate_name" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">อัตราภาษี :</td>
          <td><input type="text" name="rate_tax" id="rate_tax" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">อัตราการลดหย่อน :</td>
          <td><input type="text" name="rate_break" id="rate_break" style="width:250px;" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>