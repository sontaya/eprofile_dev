<?
@session_start();
	$fpath = '';
	require_once($fpath."../includes/connect.php");
		function convert_issue_type($type_id) {
		$t = array(1=>"เอกสารประกอบการสอน",2=>"ตำรา",3=>"งานวิจัย",4=>"หนังสือ",5=>"ผลงานวิชาการลักษณะอื่น");
		return $t[$type_id];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<link rel="stylesheet" type="text/css" href="../jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
<link href="../css/calendar-mos.css" rel="stylesheet" type="text/css"> 
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
<script src="../js/myAjax.js" type="text/javascript"></script>
<script language="javascript">
function save_issue() {
		//alert('save issue process');
		var issue_id = $('#issue_id').val();
		var issue_type = $('#issue_type').val();
		var issue = $('#issue').val();
		var issue_publish = $('#issue_publish').val();
		var contract_no = $('#contract_no').val();
		//alert(issue_id);
		if(issue == "" || issue_publish == "") {
			$('#Please_fill_in2').dialog('open');
		}
		else {
			$.ajax({
				url: '_save_issue.php?k='+ Math.random(),
				type: 'POST',
				data: {issue : issue, issue_type: issue_type, issue_publish : issue_publish, contract_no: contract_no,issue_id:issue_id},
				beforeSend: function() {
					$('#waiting').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
				},
				success : function(data) {
					$('#waiting').html("");	
					//$('#issue_block p#table_issue').load('contract_issue_table.php?contract_no='+contract_no+'&p='+Math.random());
					window.location.reload();
					/*$('#issue').val('');
					$('#issue_publish').val('');
					open_issue(contract_no);*/
				}
			});
		}
	}
	
	function edit_issue(id) {
		//alert(id);
		//$('.two2').after('legend');
		$('#issue_id').val(id);
		$('legend').html('แก้ไขข้อมูลผลงาน');
		$('#issue_type').val($('#istype'+id).html());
		$('#issue').val($('#issuename'+id).html());
		$('#issue_publish').val($('#issueyear'+id).html());
	}
	
		function del_issue(id,emp_id,contract_no) {
		//alert(id);
		var isname = $('#issuename'+id).text();
		var cf = confirm('ต้องการลบ '+isname+' จากสัญญานี้');
		if(cf == true) {
			$.ajax({
				url: '_del_issue.php?k='+ Math.random(),
				type: 'POST',
				data: {id: id},
				success: function(data) {
					//loadmai();
					//$('#table_issue').load("contract_issue_table.php?k="+Math.random()+'&contract_no='+contract_no);
					window.location.reload();
				},
				beforeSend: function() {
					$('#issue_block').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
				},
				//url: '_del_issue.php'
			});
		}
	}
	
	$(function() {
	
			$('#Please_fill_in2').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
	});
    </script>
</head>
<body>
<div id="issue_block" align="left">
<?php


	$contract_no = $_REQUEST['contract_no'];
	$emp_id = $_SESSION['EMP_ID'];
	
	
	 $count = $db->count_row(TB_CONTRACT_ISSUE," WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no'",$conn); 
	if($count != 0) {
	$sql = "SELECT * FROM ". TB_CONTRACT_ISSUE ." WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no' ";
	//echo $sql;
	$nub = 1;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	?>
    <table width="90%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td width="4%" class="text_tr">แก้ไข</td>
        <?php } ?>
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="31%" class="text_tr">ประเภทผลงาน</td>
        <td width="39%" class="text_tr">ชื่อผลงาน</td>
        <td width="16%" class="text_tr">ปีที่พิมพ์/เผยแพร่</td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td width="6%" class="text_tr">ลบ</td>
        <?php } ?>
    </tr>

   <?php
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
	<tr align="center">
    <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td width="4%" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_issue('<?=$row['ISSUE_ID'];?>')"/></td>
        <?php } ?>
        <td width="4%" class="text_td"><?=$nub;?></td>
        <td width="31%" class="text_td" align="left"><?=convert_issue_type($row['ISSUE_TYPE']);?><span id="istype<?=$row['ISSUE_ID'];?>" style="display:none;"><?=$row['ISSUE_TYPE'];?></span></td>
        <td width="39%" class="text_td" align="left"><span id="issuename<?php echo $row['ISSUE_ID'];?>"><?=$row['ISSUE'];?></span></td>
        <td width="16%" class="text_td"><span id="issueyear<?=$row['ISSUE_ID'];?>"><?=$row['ISSUE_PUBLISH'];?></span></td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td width="6%" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_issue('<?=$row['ISSUE_ID']?>','<?php echo $emp_id; ?>','<?php echo $contract_no; ?>')"/></td>
        <?php } ?>
    </tr>
<?php
	$nub++;
	}
	

	
?>
</table><br />
<?

}
?>
</div>
<?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
<div align="left">
<form id="_issue" name="_issue">
<fieldset style="width:500px"><legend>เพิ่มข้อมูลผลงาน : </legend>
<div class="one1" id="jarp"></div>
<label>ประเภทผลงาน : </label>
<input type="text" id="issue_id" name="issue_id" value="" style="display:none" />
<select name="issue_type" id="issue_type">
<option value="1">เอกสารประกอบการสอน</option>
<option value="2">ตำรา</option>
<option value="3">งานวิจัย</option>
<option value="4">หนังสือ</option>
<option value="5">ผลงานวิชาการลักษณะอื่น</option>
</select> <br />
<label>ชื่อผลงาน : </label>
<input type="text" name="issue" id="issue" />
<br /><label>ปีที่พิมพ์/เผยแพร่ : </label>
<input type="text" name="issue_publish" id="issue_publish" /><br /> 
<label>&nbsp;</label><input type="hidden" name="contract_no" id="contract_no" value="<?=$_REQUEST['contract_no']?>"  />
<input type="button" value="บันทึก" onclick="save_issue()"/>&nbsp;<input type="reset" value="ยกเลิก" onclick="$('legend').html('เพิ่มข้อมูลผลงาน');" /> 
</fieldset>
</form>
</div>
<div id="waiting"></div>
   <div id="Please_fill_in2" title="Please fill in"  style="display:none; text-align:center;">
	<p>
		กรุณากรอกข้อมูลให้ครบ
	</p>
    <?php } ?>
</body>
</html>
<? $db->closedb($conn);?>