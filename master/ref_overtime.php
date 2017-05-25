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
		  var expert_name_tax;
		  var expert_name_ss;
          var expert_name_th = $('#expert_name_th').val();
          var expert_name_en = $('#expert_name_en').val();
          var expert_name_short = $('#expert_name_short').val();
          var expert_name_unit = $('#expert_name_unit').val();
          var expert_name_amount = $('#expert_name_amount').val();
		  if($("#expert_name_tax").attr('checked') == true){
		      expert_name_tax='T';
		  }else{
		      expert_name_tax='F';
		  }
		  if($("#expert_name_ss").attr('checked') == true){
		      expert_name_ss='T';
		  }else{
		      expert_name_ss='F';
		  }
          $.ajax({
            type: 'POST',
            url : '../master/ref_overtime_ajax.php',
            data : {mode : 'add',
              expert_name_th : expert_name_th,
			  expert_name_en : expert_name_en,
			  expert_name_short : expert_name_short,
			  expert_name_unit : expert_name_unit,
			  expert_name_amount : expert_name_amount,
			  expert_name_tax : expert_name_tax,
			  expert_name_ss : expert_name_ss,
            },
            success : function(data){
              $('#tableList').load('../master/ref_overtime.php?'+Math.random()+' #tableList');
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
    $('#e_expert_name_th').val($('#expert_name_th_'+code).text());
    $('#e_expert_name_en').val($('#expert_name_en_'+code).text());
    $('#e_expert_name_short').val($('#expert_name_short_'+code).text());
    $('#e_expert_name_unit').val($('#expert_name_unit_'+code).text());
    $('#e_expert_name_amount').val($('#expert_name_amount_'+code).text());
    if($('#expert_name_tax_'+code).text()=='T'){
		$('#e_expert_name_tax').attr('checked','checked');
	}else{
		$('#e_expert_name_tax').removeAttr('checked');
	}
    if($('#expert_name_ss_'+code).text()=='T'){
		$('#e_expert_name_ss').attr('checked','checked');
	}else{
		$('#e_expert_name_ss').removeAttr('checked');
	}
	
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
		  var e_expert_name_tax;
		  var e_expert_name_ss;
          var e_expert_id = $('#e_expert_id').val();
          var e_expert_name_th = $('#e_expert_name_th').val();
          var e_expert_name_en = $('#e_expert_name_en').val();
          var e_expert_name_short = $('#e_expert_name_short').val();
          var e_expert_name_unit = $('#e_expert_name_unit').val();
          var e_expert_name_amount = $('#e_expert_name_amount').val();
		  if($("#e_expert_name_tax").attr('checked') == true){
		      e_expert_name_tax='T';
		  }else{
		      e_expert_name_tax='F';
		  }
		  if($("#e_expert_name_ss").attr('checked') == true){
		      e_expert_name_ss='T';
		  }else{
		      e_expert_name_ss='F';
		  }
          //var e_detail = $('#e_detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_overtime_ajax.php',
            data : {mode : 'edit',
              e_expert_id : e_expert_id,
              e_expert_name_th : e_expert_name_th,
			  e_expert_name_en : e_expert_name_en,
			  e_expert_name_short : e_expert_name_short,
			  e_expert_name_unit : e_expert_name_unit,
			  e_expert_name_amount : e_expert_name_amount,
			  e_expert_name_tax : e_expert_name_tax,
			  e_expert_name_ss : e_expert_name_ss,
            },
            success : function(data){
              $('#tableList').load('../master/ref_overtime.php?'+Math.random()+' #tableList');
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
          <td align="right">ชื่อค่าล่วงเวลา :</td>
          <td><input type="text" name="e_expert_name_th" id="e_expert_name_th" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">ชื่อค่าล่วงเวลา(ภาษาอังกฤษ) :</td>
          <td><input type="text" name="e_expert_name_en" id="e_expert_name_en" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">ชื่อใน ภ.ง.ด. :</td>
          <td><input type="text" name="e_expert_name_short" id="e_expert_name_short" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">หน่วยนับของโอที :</td>
          <td><input type="text" name="e_expert_name_unit" id="e_expert_name_unit" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">จำนวนเท่าของโอที :</td>
          <td><input type="text" name="e_expert_name_amount" id="e_expert_name_amount" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">หักก่อนคิดภาษี :</td>
          <td align="left"><input type="checkbox" name="e_expert_name_tax" id="e_expert_name_tax" style="width:250px;" value="T" /></td>
        </tr>
        <tr>
          <td align="right">หักก่อนคิดประกันสังคม :</td>
          <td align="left"><input type="checkbox" name="e_expert_name_ss" id="e_expert_name_ss" style="width:250px;" value="T" /></td>
        </tr>
    </table>
  </div>

  <div id="fDel8"  style="display:none;" title="ลบ">


    <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
    <input type="hidden" name="d_code" id="d_code" />

  </div>

  <div id="mainContainer" >
    <h3>Master ประเภทค่าล่วงเวลา</h3>

    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id ="tableList">
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="658" border="1" class="all_table">
        <tr>
          <th scope="col">ชื่อค่าล่วงเวลา</th>
          <th scope="col">ชื่อค่าล่วงเวลา (ภาษาอังกฤษ)</th>
          <th scope="col">ชื่อใน ภ.ง.ด.</th>
          <th scope="col">หน่วยนับของโอที</th>
          <th scope="col">จำนวนเท่าของโอที</th>
          <th scope="col">หักก่อนคิดภาษี</th>
          <th scope="col">หักก่อนคิดประกันสังคม</th>
          <th scope="col">แก้ไข</th>
          <th scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT * FROM SDU_OVERTIME_PAY ";
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
            <td><span id="expert_name_th_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['OTPAY_NAME_TH']; ?></span></td>
            <td align="center"><span id="expert_name_en_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['OTPAY_NAME_EN']; ?></span></td>
            <td align="center"><span id="expert_name_short_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['OTPAY_NAME_SHORT']; ?></span></td>
            <td align="center"><span id="expert_name_unit_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['OTPAY_UNIT']; ?></span></td>
            <td align="center"><span id="expert_name_amount_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['OTPAY_COUNT']; ?></span></td>
            <td align="center"><span id="expert_name_tax_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['CAL_TAX']; ?></span></td>
            <td align="center"><span id="expert_name_ss_<?php echo $rc['OTPAY_CODE']; ?>"><?php echo $rc['CAL_SSO']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['OTPAY_CODE']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['OTPAY_CODE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
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
          <td align="right">ชื่อค่าล่วงเวลา :</td>
          <td><input type="text" name="expert_name_th" id="expert_name_th" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">ชื่อค่าล่วงเวลา(ภาษาอังกฤษ) :</td>
          <td><input type="text" name="expert_name_en" id="expert_name_en" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">ชื่อใน ภ.ง.ด. :</td>
          <td><input type="text" name="expert_name_short" id="expert_name_short" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">หน่วยนับของโอที :</td>
          <td><input type="text" name="expert_name_unit" id="expert_name_unit" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">จำนวนเท่าของโอที :</td>
          <td><input type="text" name="expert_name_amount" id="expert_name_amount" style="width:250px;" /></td>
        </tr>
        <tr>
          <td align="right">หักก่อนคิดภาษี :</td>
          <td align="left"><input type="checkbox" name="expert_name_tax" id="expert_name_tax" style="width:250px;" value="T" /></td>
        </tr>
        <tr>
          <td align="right">หักก่อนคิดประกันสังคม :</td>
          <td align="left"><input type="checkbox" name="expert_name_ss" id="expert_name_ss" style="width:250px;" value="T" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>