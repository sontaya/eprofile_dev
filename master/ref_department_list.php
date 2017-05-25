<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">
  function open_a() {
    $('#code_faculty').val('');
    $('#name_faculty').val('');
    $('#uoc_ref_fac').val('');
    $('#fAdd4').dialog({
      modal: true,
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var code_faculty = $('#code_faculty').val();
          var name_faculty = $('#name_faculty').val();
          var uoc_ref_fac = $('#uoc_ref_fac').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_list_ajax.php',
            data : {mode : 'add',
              code_faculty : code_faculty,
              name_faculty : name_faculty,
              uoc_ref_fac : uoc_ref_fac
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_list.php?'+Math.random()+' #tableList');
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
    $('#n_code').val($('#new_code_'+code).text());
    $('#e_faculty').val($('#department_txt_'+code).text());
    $('#e_uoc_ref').val($('#uoc_txt_'+code).text());
    $('#fEdit4').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var n_code = $('#n_code').val();
          var e_faculty = $('#e_faculty').val();
          var e_uoc_ref = $('#e_uoc_ref').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_list_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              n_code : n_code,
              e_faculty : e_faculty,
              e_uoc_ref : e_uoc_ref
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_list.php?'+Math.random()+' #tableList');
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
    $('#fDel4').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_department_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_department_list.php?'+Math.random()+' #tableList');
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
    <h3>Master หน่วยงานหลัก</h3>
    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList" >
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1" class="all_table" >
        <tr>
          <th width="79" scope="col">CODE FACULTY</th>
          <th width="252" scope="col">NAME FACULTY</th>
          <th width="252" scope="col">UOC REF FAC</th>
          <th width="79" scope="col">NEW CODE FACULTY</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="52" scope="col">ลบ</th>
        </tr>
        <?php
        $last_id = '';
        // require connected
        $sql = "SELECT CODE_FACULTY, NAME_FACULTY, UOC_REF_FAC, NEW_CODE_FACULTY FROM SDU_REF_DEPARTMENT ORDER BY CODE_FACULTY ";
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
            <td><?php echo $rc['CODE_FACULTY']; ?></td>
            <td><span id="department_txt_<?php echo $rc['CODE_FACULTY']; ?>"><?php echo $rc['NAME_FACULTY']; ?></span></td>
            <td><span id="uoc_txt_<?php echo $rc['CODE_FACULTY']; ?>"><?php echo $rc['UOC_REF_FAC']; ?></span></td>
            <td><span id="new_code_<?php echo $rc['CODE_FACULTY']; ?>"><?php echo $rc['NEW_CODE_FACULTY']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['CODE_FACULTY']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" class="vtip" title="Edit" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['CODE_FACULTY']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" class="vtip" title="Delete" /></span></td>
          </tr>
          <?php
          $last_id = $rc['CODE_FACULTY'];
        }
        $last_id++;
        $last_id = str_pad($last_id, 2, '0', STR_PAD_LEFT);
        ?>
      </table>
    </div>
    <div id="fEdit4" style="display:none;" title="แก้ไข">
      <table style="border:none;">
        <tr>
          <td align="right">CODE FACULTY :</td><td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code"></td>
        </tr>
        <tr>
          <td align="right">NEW CODE FACULTY :</td><td><input type="text" name="n_code" id="n_code"></td>
        </tr>
        <tr>
          <td align="right">NAME FACULTY :</td><td><input type="text" id="e_faculty" name="e_faculty" /></td>
        </tr>
        <tr>
          <td align="right">UOC REF FAC :</td><td><input type="text" id="e_uoc_ref" name="e_uoc_ref" /></td>
        </tr>
      </table>
    </div>
    <div id="fDel4"  style="display:none;" title="ลบ">
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd4" style="display:none" title="เพิ่มใหม่">
      <legend>เพิ่มข้อมูล</legend>
      <table style="border:none;">
        <tr>
          <td align="right">CODE FACULTY :</td>
          <td><input type="text" name="code_faculty" id="code_faculty" value="<?php echo $last_id; ?>" /></td>
        </tr>
        <tr>
          <td align="right">NAME FACULTY :</td>
          <td><input type="text" name="name_faculty" id="name_faculty" /></td>
        </tr>
        <tr>
          <td align="right">UOC REF FAC :</td>
          <td><input type="text" name="uoc_ref_fac" id="uoc_ref_fac" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>