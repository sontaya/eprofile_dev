<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#course_name').val('');
    $('#fAdd8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
          var course_name = $('#course_name').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_course_ajax.php',
            data : {mode : 'add',
              course_name : course_name  
            },
            success : function(data){
              $('#tableList').load('../master/ref_course.php?'+Math.random()+' #tableList');
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
	
	$('#e_course_name').val($('#course_name_id_'+code).text());
	$('#e_course_id').val(code);
	
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
          var e_course_id = $('#e_course_id').val();
          var e_course_name = $('#e_course_name').val();
          //var e_detail = $('#e_detail').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_course_ajax.php',
            data : {mode : 'edit',
              e_course_id : e_course_id,
              e_course_name : e_course_name
            },
            success : function(data){
              $('#tableList').load('../master/ref_course.php?'+Math.random()+' #tableList');
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
          var course_id = $('#d_code').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_course_ajax.php',
            data : {mode : 'delete',
              course_id : course_id
            },
            success : function(data){
              $('#tableList').load('../master/ref_course.php?'+Math.random()+' #tableList');
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
    			<td align="right">Code :</td> 
                <td><span id="show_ecode"></span><input type="hidden" name="e_course_id" id="e_course_id" /></td>
        	</tr>
            <tr>
      			<td align="right">หลักสูตร :</td> 
                <td><input type="text" id="e_course_name" name="e_course_name" /></td>
      		</tr>
      	</table>
    </div>
    
     <div id="fDel8"  style="display:none;" title="ลบ">


      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code" id="d_code" />

    </div>
    
  <div id="mainContainer" >
    <h3>Master ชื่อเต็มของหลักสูตร</h3>

    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div><br />
    <div id ="tableList">
    <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="485" border="1" class="all_table">
          <tr>
          <th width="300" scope="col">หลักสูตร</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
        $sql = "SELECT * FROM SDU_REF_COURSE";
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
            <td><span id="course_name_id_<?php echo $rc['COURSE_ID']; ?>"><?php  echo $rc['COURSE_NAME']; ?></span></td>
            <td align="center"><span onClick="open_f('<?php echo $rc['COURSE_ID']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span></td>
            <td align="center"><span onClick="open_d('<?php echo $rc['COURSE_ID']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span></td>
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
      			<td align="right">หลักสูตร :</td>
      			<td><input type="text" name="course_name" id="course_name" style="width:250px;" /></td>
      		</tr>
	  </table>
    </div>
  </div>
</body>
</html>