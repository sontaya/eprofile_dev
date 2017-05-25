<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">
  
  function open_a() {
    $('#code').val('');
    $('#position').val('');
    $('#position_e').val('');
    $('#fAdd').dialog({
      modal: true,
      width: '500px',
      resizable: false,
      buttons: {
        'เพิ่ม': function() {
          var code = $('#code').val();
          var position = $('#position').val();
          var position_e = $('#position_e').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_education_lever_list_ajax.php',
            data : {mode : 'add',
              code : code,
              position : position,
              position_e : position_e
            },
            success : function(data){
              $('#tableList').load('../master/ref_education_lever_list.php?'+Math.random()+' #tableList');
              alert(data)
            }
          });
          $(this).dialog( "destroy" );
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
    $('#e_position_e').val($('#position_e_txt_'+code).text());
    $('#fEdit').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code').val();
          var e_position = $('#e_position').val();
          var e_position_e = $('#e_position_e').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_education_lever_list_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_position : e_position,
              e_position_e : e_position_e
            },
            success : function(data){
              $('#tableList').load('../master/ref_education_lever_list.php?'+Math.random()+' #tableList');
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
    $('#d_position').text($('#position_txt_'+code).text());
    $('#d_code').val(code);
    $('#fDel').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_education_lever_list_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_education_lever_list.php?'+Math.random()+' #tableList');
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
    <h3>Master ระดับการศึกษา</h3>
    <div onclick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id="tableList" >
    
    <script src="../js/vtip.js" type="text/javascript"></script>
    
      <table width="485" class="all_table" border="1" >
        <tr>
          <th width="79" scope="col">Code</th>
          <th width="292" scope="col">ระดับการศึกษา</th>
          <th width="292" scope="col">ระดับการศึกษา (eng)</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT * FROM SDU_REF_LEV ORDER BY LEV_ID ";
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
            <td><?php echo $rc['LEV_ID']; ?></td>
            <td><span id="position_txt_<?php echo $rc['LEV_ID']; ?>"><?php echo $rc['LEV_NAME_TH']; ?></span></td>
            <td><span id="position_e_txt_<?php echo $rc['LEV_ID']; ?>"><?php echo $rc['LEV_NAME_ENG']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['LEV_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" class="vtip" title="Edit" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['LEV_ID']; ?>')" style="cursor:pointer"><img alt=""  src="images/b_del.png" width="12" height="12" class="vtip" title="Delete" /></span></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
    <div id="fEdit" style="display:none;" title="แก้ไข">
    	<table border="0" style="border:none;">
        	<tr>
    	 		 <td align="right">Code :</td><td><span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code" /></td>
          	</tr>
            <tr>
     		 	 <td align="right">ระดับการศึกษา :</td><td><input type="text" id="e_position" name="e_position" /></td>
            </tr>
            <tr>
     			  <td align="right">ระดับการศึกษา (ENG) :</td><td><input type="text" id="e_position_e" name="e_position_e" /></td>
            </tr>
      	</table>
    </div>
    <div id="fDel"  style="display:none;" title="ลบ">
      <span id="d_position"></span><br />
      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />
    </div>
    <div id="fAdd" style="display:none" title="เพิ่มใหม่">
      <legend>เพิ่มข้อมูล</legend>
      <table border="0" style="border:none;">
      	<tr>
      		<td align="right">Code :</td>
     		<td><input type="text" name="code" id="code" /></td>
     	</tr>
        <tr>
     		<td align="right">ระดับการศึกษา :</td>
      		<td><input type="text" name="position" id="position" /></td>
      	</tr>
        <tr>
     	 	<td align="right">ระดับการศึกษา (ENG) :</td>
      		<td><input type="text" id="position_e" name="position_e" /></td>
      	</tr>
      </table>
    </div>
  </div>
</body>
</html>