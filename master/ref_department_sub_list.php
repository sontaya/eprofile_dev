<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    //$('#code').val('');
    $('#code_department_section').val('');
    $('#name_department_section').val('');
    $('#fAdd5').dialog({
      modal: true,
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var code_department_section = $('#code_department_section').val();
          var name_department_section = $('#name_department_section').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_sub_list_ajax.php',
            data : {mode : 'add',
              code : code,
              code_department_section : code_department_section,
              name_department_section : name_department_section
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_sub_list.php?'+Math.random()+' #tableList');
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
  function open_f(code, code2) {
//    alert($('#e_code_fac').val($('#code_fac_'+code).text()));
    $('#e_code_faculty_txt').text($('#code_fac_'+code2).text());
    $('#e_code_fac').val($('#code_fac_'+code2).text());
    $('#e_code_department_section_txt').text(code);
    $('#e_code_dep').val(code);
    $('#n_code_dep').val($('#new_code_dep_'+code2+'_'+code).text());
    $('#e_name_department_section').val($('#name_dep_'+code2+'_'+code).text());
    $('#fEdit5').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code_fac = $('#e_code_fac').val();
          var e_code_dep = $('#e_code_dep').val();
          var n_code_dep = $('#n_code_dep').val();
          var e_name_department_section = $('#e_name_department_section').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_sub_list_ajax.php',
            data : {mode : 'edit',
              e_code_fac : e_code_fac,
              e_code_dep : e_code_dep,
              n_code_dep : n_code_dep,
              e_name_department_section : e_name_department_section
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_sub_list.php?'+Math.random()+' #tableList');
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
    $('#fDel5').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_sub_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_sub_list.php?'+Math.random()+' #tableList');
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
    <h3>Master หน่วยงานย่อย</h3>
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
          <th width="79" scope="col">CODE FACULTY</th>
          <th width="252" scope="col">CODE DEPARTMENT SECTION</th>
          <th width="80" scope="col">NEW CODE DEPARTMENT SECTION</th>
          <th width="252" scope="col">NAME DEPARTMENT SECTION</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="52" scope="col">ลบ</th>
        </tr>
        <?php
        $last_id = '';
        // require connected
        $sql = "SELECT CODE_FACULTY, CODE_DEPARTMENT_SECTION, NEW_CODE_DEPARTMENT_SECTION, NAME_DEPARTMENT_SECTION FROM SDU_REF_DEPARTMENT_SUB ORDER BY CODE_DEPARTMENT_SECTION ";
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
            <td><span id="code_fac_<?php echo $rc['CODE_FACULTY']; ?>"><?php echo $rc['CODE_FACULTY']; ?></span></td>
            <td><span id="code_dep_<?php echo $rc['CODE_DEPARTMENT_SECTION']; ?>"><?php echo $rc['CODE_DEPARTMENT_SECTION']; ?></span></td>
            <td><span id="new_code_dep_<?php echo $rc['CODE_FACULTY']; ?>_<?php echo $rc['CODE_DEPARTMENT_SECTION']; ?>"><?php echo $rc['NEW_CODE_DEPARTMENT_SECTION']; ?></span></td>
            <td><span id="name_dep_<?php echo $rc['CODE_FACULTY']; ?>_<?php echo $rc['CODE_DEPARTMENT_SECTION']; ?>"><?php echo $rc['NAME_DEPARTMENT_SECTION']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['CODE_DEPARTMENT_SECTION']; ?>', '<?php echo $rc['CODE_FACULTY']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" class="vtip" title="Edit" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['CODE_DEPARTMENT_SECTION']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" class="vtip" title="Delete" /></span></td>
          </tr>
          <?php
          $last_id = $rc['CODE_DEPARTMENT_SECTION'];
        }
        $last_id++;
        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit5" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">CODE FACULTY :</td><td><span id="e_code_faculty_txt"></span><input type="hidden" name="e_code_fac" id="e_code_fac"></td>
        </tr>
        <tr>
          <td align="right">CODE DEPARTMENT SECTION :</td><td><span id="e_code_department_section_txt"></span><input type="hidden" name="e_code_dep" id="e_code_dep"></td>
        </tr>
        <tr>
          <td align="right">NEW CODE DEPARTMENT SECTION :</td><td><input type="text" name="n_code_dep" id="n_code_dep"></td>
        </tr>
        <tr>
          <td align="right">NAME DEPARTMENT SECTION :</td><td><input type="text" id="e_name_department_section" name="e_name_department_section" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel5"  style="display:none;" title="ลบ">
      <span id="d_position"></span><br />
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd5" style="display:none;" title="เพิ่มใหม่">
      <table style="border:none;">
        <tr>
          <td align="right">CODE FACULTY :</td>
          <td><input type="text" name="code" id="code" onKeyUp="data_table('data_table','code','data_department');" /></td>
        </tr>
        <tr>
          <td align="right">CODE DEPARTMENT SECTION :</td>
          <td><input type="text" name="code_department_section" id="code_department_section" value="<?php echo $last_id; ?>" /></td>
        </tr>
        <tr>
          <td align="right">NEW CODE DEPARTMENT SECTION :</td>
          <td><input type="text" name="new_code_department_section" id="new_code_department_section" value="" /></td>
        </tr>
        <tr>
          <td align="right">NAME DEPARTMENT SECTION :</td>
          <td><input type="text" name="name_department_section" id="name_department_section" /></td>
        </tr>
      </table>
    </div>
  </div>

  <div id="data_table" title="หน่วยงานหลัก">

  </div>
</body>
</html>