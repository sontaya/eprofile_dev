<?
include "../master/master_header.php";
require_once("conn.php");
?>
<script type="text/javascript">

  function open_a() {
    $('#code_p').val('');
    $('#position_p').val('');
   // alert($('#code_p').val());
    $('#fAdd8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'เพิ่ม': function() {
		  var r = Math.random(); 
		  var code = $('#code_p').val();
		  var faculty = $('#faculty_p').val() ;
          $.ajax({
            type: 'POST',
            url : '../master/ref_position_code_ajax.php?r'+r,
			cache: false ,
			async: false ,
            data : { mode : 'add' , code : code, faculty : faculty },
            success : function(data){
             $('#tableList').load('../master/ref_position_code.php?'+Math.random()+' #tableList');
            },cache: false
          });
          $(this).dialog('close');
        },
        'ยกเลิก': function() {
          $(this).dialog('close');
        }
      }
    });
  }
  
  
  function open_f(code,f) {
    //alert(code);
    //$('#show_ecode').text(code);
	$("#o_code_p").val(code);
    $('#e_code_p').val(code);
	$('#e_faculty_p').val(f);
    $('#fEdit8').dialog({
      modal: true,
      resizable: false,
      width: '500px',
      buttons: {
        'แก้ไข': function() {
          var e_code = $('#e_code_p').val();
          var e_faculty = $('#e_faculty_p').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_position_code_ajax.php',
            data : {mode : 'edit',
              e_code : e_code,
              e_faculty : e_faculty,
			  code_o : $("#o_code_p").val()
            },
            success : function(data){
              $('#tableList').load('../master/ref_position_code.php?'+Math.random()+' #tableList');
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
    $('#d_code_p').val(code);
    $('#fDel8').dialog({
      modal: true,
      buttons: {
        'ลบ' : function() {
          var d_code = $('#d_code_p').val();
          $.ajax({
            type: 'POST',
            url : '../master/ref_position_code_ajax.php',
            data : {mode : 'delete',
              d_code : d_code
            },
            success : function(data){
              $('#tableList').load('../master/ref_position_code.php?'+Math.random()+' #tableList');
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
    <h3>Master เลขที่ตำแหน่ง</h3>

    <div onClick="open_a()" style="cursor:pointer;">
      <span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
    </div>
    <div onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" style="padding-top: 10px;cursor:pointer;">
      <span class="ui-icon ui-icon-arrowreturnthick-1-e" style="float:left; margin:0 7px 50px 0;" /></span>กลับสู่ Master menu
    </div>
    <br />
    <div id ="tableList">
      <script src="../js/vtip.js" type="text/javascript"></script>
      <table width="550" border="1" class="all_table">
        <tr>
          <th width="79" scope="col">Code</th>
          <th width="292" scope="col">หน่วยงาน</th>
		  <th width="100" scope="col">รหัสพนักงาน</th>
          <th width="63" scope="col">แก้ไข</th>
          <th width="51" scope="col">ลบ</th>
        </tr>
        <?php
        // require connected
		
		$sql = "SELECT CODE_FACULTY, NAME_FACULTY, UOC_REF_FAC FROM SDU_REF_DEPARTMENT ORDER BY CODE_FACULTY";
		$st = oci_parse($conn, $sql);
		oci_execute($st);
		while ($rc = oci_fetch_array($st, OCI_BOTH)){
			$fac[$rc["CODE_FACULTY"]] = $rc["NAME_FACULTY"];
		}
		
        $sql = "SELECT *  FROM SDU_REF_POSITION_CODE ORDER BY CODE_FACULTY ";
        $st = oci_parse($conn, $sql);
		oci_execute($st);
        if (!oci_execute($st)) {
          $err = oci_error($st);
          trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
        }
        while ($rc = oci_fetch_array($st, OCI_BOTH)) {
//          echo $rc['POSITION'];
//          }
          ?>
          <tr>
            <td><?php echo $rc['POSITION_CODE']; ?></td>
            <td><span id="position_txt_<?php echo $rc['POSITION_CODE']; ?>"><?php echo $fac[$rc['CODE_FACULTY']]; ?></span></td>
			<td align="center"><?=$rc['EMP_ID']?></td>
            <td align="center"><? if($rc['EMP_ID']=="" OR $rc['EMP_ID']==NULL){ ?><span onClick="open_f('<?php echo $rc['POSITION_CODE']; ?>','<?php echo $rc['CODE_FACULTY']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" title="Edit" class="vtip" /></span><? } ?></td>
            <td align="center"><? if($rc['EMP_ID']=="" OR $rc['EMP_ID']==NULL){ ?><span onClick="open_d('<?php echo $rc['POSITION_CODE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" title="Delete" class="vtip" /></span><? } ?></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <div id="fEdit8" style="display:none;" title="แก้ไข">
	<?
	$sql = "SELECT CODE_FACULTY, NAME_FACULTY, UOC_REF_FAC FROM SDU_REF_DEPARTMENT ORDER BY CODE_FACULTY";
	$st = oci_parse($conn, $sql);
	oci_execute($st);
	?>
       <table style="border:none;">
	  	<tr>
          <td align="right">หน่วยงาน :</td>
          <td>
		  	<select name="e_faculty_p" id="e_faculty_p">
				<option value="">เลือก</option>
				<?
				while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
				?>
					<option value="<?=$rc["CODE_FACULTY"]?>"><?=$rc["NAME_FACULTY"]?></option>
				<? } ?>
			</select>
		  </td>
        </tr>
        <tr>
          <td align="right">Code :</td>
          <td><input type="text" name="e_code_p" id="e_code_p" style="width: 100px;" /><input type="hidden" id="o_code_p"/></td>
        </tr>
      </table>

    </div>
    <div id="fDel8"  style="display:none;" title="ลบ">


      <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
      <input type="hidden" name="d_code_p" id="d_code_p" />

    </div>
    <div id="fAdd8" style="display:none" title="เพิ่มใหม่">
<?
$sql = "SELECT CODE_FACULTY, NAME_FACULTY, UOC_REF_FAC FROM SDU_REF_DEPARTMENT ORDER BY CODE_FACULTY";
$st = oci_parse($conn, $sql);
oci_execute($st);
?>
      <legend>เพิ่มข้อมูล</legend>
	  <br>
      <table style="border:none;">
	  	<tr>
          <td align="right">หน่วยงาน :</td>
          <td>
		  	<select name="faculty_p" id="faculty_p">
				<option value="">เลือก</option>
				<?
				while ($rc = oci_fetch_array($st, OCI_ASSOC)) {
				?>
					<option value="<?=$rc["CODE_FACULTY"]?>"><?=$rc["NAME_FACULTY"]?></option>
				<? } ?>
			</select>
		  </td>
        </tr>
        <tr>
          <td align="right">Code :</td>
          <td><input type="text" name="code_p" id="code_p" style="width: 100px;" /></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>