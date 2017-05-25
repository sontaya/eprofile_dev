<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#code').val('');
    $('#name_salary_source').val('');
    $('#uoc_budget_id').val('');
    $('#fAdd7').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var name_salary_source = $('#name_salary_source').val();
          var uoc_budget_id = $('#uoc_budget_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_salary_source_ajax.php',
            data : {mode : 'add',
              code : code,
              name_salary_source : name_salary_source,
              uoc_budget_id : uoc_budget_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_salary_source.php?'+Math.random()+' #tableList');
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
    $('#e_name_salary_source').val($('#name_salary_source_txt_'+code).text());
    $('#e_uoc_budget_id').val($('#uoc_budget_id_txt_'+code).text());
    $('#fEdit7').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_name_salary_source = $('#e_name_salary_source').val();
          var e_uoc_budget_id = $('#e_uoc_budget_id').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_salary_source_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_name_salary_source : e_name_salary_source,
              e_uoc_budget_id : e_uoc_budget_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_salary_source.php?'+Math.random()+' #tableList');
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
    $('#fDel7').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_salary_source_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_salary_source.php?'+Math.random()+' #tableList');
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
    <h3>ref_salary_source</h3>
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
          <th width="79" scope="col">Code</th>
          <th width="292" scope="col">name salary source</th>
          <th width="292" scope="col">uoc budget id</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT CODE_SALARY_SOURCE, NAME_SALARY_SOURCE , UOC_BUDGET_ID FROM sdu_ref_salary_source ORDER BY CODE_SALARY_SOURCE ";
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
            <td><?php echo $rc['CODE_SALARY_SOURCE']; ?></td>
            <td><span id="name_salary_source_txt_<?php echo $rc['CODE_SALARY_SOURCE']; ?>"><?php echo $rc['NAME_SALARY_SOURCE']; ?></span></td>
            <td><span id="uoc_budget_id_txt_<?php echo $rc['CODE_SALARY_SOURCE']; ?>"><?php echo $rc['UOC_BUDGET_ID']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['CODE_SALARY_SOURCE']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['CODE_SALARY_SOURCE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <div id="fEdit7" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">Code :</td> 
          <td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code" /></td>
        </tr>
        <tr>
          <td align="right">Name salary source :</td>
          <td><input type="text" id="e_name_salary_source" name="e_name_salary_source" /></td>
        </tr>
        <tr>
          <td align="right">Uoc budget id :</td> 
          <td><input type="text" id="e_uoc_budget_id" name="e_uoc_budget_id" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel7"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd7" style="display:none" title="เพิ่มใหม่">
      <legend>เพิ่มข้อมูล</legend>
      <table style="border:none;">
        <tr>
          <td align="right">Code :</td>
          <td><input type="text" name="code" id="code" /></td>
        </tr>
        <tr>
          <td align="right">name salary source :</td>
          <td><input type="text" name="name_salary_source" id="name_salary_source" /></td>
        </tr>
        <tr>
          <td align="right">uoc budget id :</td>
          <td><input type="text" id="uoc_budget_id" name="uoc_budget_id" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>