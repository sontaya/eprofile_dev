<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POSITION</title>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.6.custom.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript">
function open_a() {
	$('#fAdd').dialog({
		modal: true,
		resizable: false,
		buttons: {
			'เพิ่ม': function() {
					$('#fAdd_form').submit();
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
		$('#fEdit').dialog({
			modal: true,
			resizable: false,
			width: '400px',
			buttons: {
				'แก้ไข': function() {
					$('#fEdit_form').submit();
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
					$('#fDel_form').submit();
				},
				'ยกเลิก': function() {
					$(this).dialog('close');
				}
			},
			resizable: false,
			width: '400px'
			});
	}
</script>
</head>

<body>
<h3>POSITION</h3>
<?php
	require_once("conn.php");
	
	$mode = $_GET['mode'];
	switch($mode) {
		case 'add' :
			add();
		break;
		case 'edit' :
			edit();
		break;
		case 'delete' :
			delete();
		break;
	}
	
	function add() {
		global $conn;
		$code = $_POST['code'];
		$position = $_POST['position'];
		//echo $code . " " . $position;
		// connect
		$sql = "SELECT COUNT(*) C FROM POSITION WHERE CODE = '{$code}' ";
		$st = oci_parse($conn,$sql);
		
		if(!oci_execute($st)) {
			$err = oci_error($st);
			trigger_error('Query failed: ' . $err['message'] , E_USER_ERROR);
		}
		$rc = oci_fetch_array($st, OCI_ASSOC);
		//echo "\$rc : " .$rc['C'];
		// ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
		if($rc['C'] == 0) {
			$sql = "INSERT INTO POSITION VALUES ('{$code}','{$position}') ";
			$st = oci_parse($conn,$sql);
			if(oci_execute($st)) {
				echo "<p>เพิ่มข้อมูล {$code} : {$position} แล้ว !</p>";
			}
		}
		else {
			echo "<p> -ข้อมูลซ้ำ- </p>";
		}
	}
	
	function edit() {
		global $conn;
		//print_r($_POST);
		$code = $_POST['e_code'];
		$position = $_POST['e_position'];
		
		$sql = "UPDATE POSITION SET POSITION = '{$position}' WHERE CODE = '{$code}' ";
		$st = oci_parse($conn,$sql);
		oci_execute($st);
	}
	
	function delete() {
		//print_r($_POST);
		global $conn;
		$code = $_POST['d_code'];
		$sql = "DELETE FROM POSITION WHERE CODE = '{$code}' ";
		$st = oci_parse($conn,$sql);
		oci_execute($st);
	}
?>
<div onclick="open_a()" style="cursor:pointer;">
	<span class="ui-icon ui-icon-circle-plus" style="float:left; margin:0 7px 50px 0;"></span> เพิ่มใหม่
</div><br />
<table width="485" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <th width="79" scope="col">CODE</th>
    <th width="292" scope="col">POSITION</th>
    <th width="63" scope="col">แก้ไข</th>
    <th width="51" scope="col">ลบ</th>
  </tr>
  <?php
	// require connected
	$sql = "SELECT CODE, POSITION FROM POSITION ORDER BY CODE ";
	$st = oci_parse($conn,$sql);
	
	if(!oci_execute($st)) {
		$err = oci_error($st);
		trigger_error('Query failed: ' . $err['message'] , E_USER_ERROR);
	}
	
	while($rc = oci_fetch_array($st,OCI_ASSOC)) {
		//echo $rc['POSITION'];
	//}
?>
  <tr>
    <td><?php echo $rc['CODE']; ?></td>
    <td><span id="position_txt_<?php echo $rc['CODE']; ?>"><?php echo $rc['POSITION']; ?></span></td>
    <td align="center"><span onclick="open_f('<?php echo $rc['CODE']; ?>')" style="cursor:pointer"><img src="images/b_edit.png" width="16" height="16" /></span></td>
    <td align="center"><span onclick="open_d('<?php echo $rc['CODE']; ?>')" style="cursor:pointer"><img src="images/b_del.png" width="12" height="12" /></span></td>
  </tr>
  <?php
  }
  ?>
</table>
<div id="fEdit" style="display:none;" title="แก้ไข">
	<form action="position_list.php?mode=edit" method="post" id="fEdit_form">
    	CODE : <span id="show_ecode"></span><input type="hidden" name="e_code" id="e_code" /><br/>
        POSITION : <input type="text" id="e_position" name="e_position" />
    </form>
</div>
<div id="fDel"  style="display:none;" title="ลบ">
<span id="d_position"></span><br />
<form action="position_list.php?mode=delete" method="post" id="fDel_form">
	<span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 50px 0;"></span> ลบหรือไม่
    <input type="hidden" name="d_code" id="d_code" />
</form>
</div>
<div id="fAdd" style="display:none" title="เพิ่มใหม่">
  <form method="post" action="position_list.php?mode=add" id="fAdd_form">
    <legend>เพิ่มข้อมูล</legend>
    CODE :
    <input type="text" name="code" id="code" />
    POSITION :
    <input type="text" name="position" id="position" />
  </form>
</div>
</body>
</html>