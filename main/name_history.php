<?php
 session_start(); 
$fpath = '../';
require_once($fpath."includes/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_SESSION['USER_EMP_ID']; ?></title>
<style type="text/css">
body {
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 0.82em;
}
#myDiv1 {
	display: none;
}
</style>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	function chk_txt() {
		var txt_name = document.getElementById('txt_name').value;
		var txt_lastname = document.getElementById('txt_lastname').value;
		var chk_mode = document.getElementById('chk_mode').value;
		if(txt_name == '' || txt_lastname == '') {
			return false;
		}
		else {
			if(chk_mode == '0') {
				add_his('<?php echo $_SESSION['EMP_ID'];?>',txt_name,txt_lastname);
			}
			else {
				edit_his('<?php echo $_SESSION['EMP_ID'];?>',txt_name,txt_lastname);
			}
			return false;
		}
	}
	
	function del_his(emp_id,name,lname) {
		$.ajax({
			type: 'POST',
			url: 'name_history_process.php?mode=del',
			data: {emp_id: emp_id, name: name, lname: lname},
			success: function(data) {
				reload_this_window();
			},
			beforeSend: function() {
			}
		});
	}
	
	function edit_his(emp_id,name,lname) {
		var old_n = $('#old_name').val();
		var old_l = $('#old_lname').val();
	$.ajax({
			type: 'POST',
			url: 'name_history_process.php?mode=edit',
			data: {emp_id: emp_id, name: name, lname: lname, old_n: old_n, old_l: old_l},
			success: function(data) {
				reload_this_window();
			},
			beforeSend: function() {
			}
		});	}
	
	function add_his(emp_id,name,lname) {
		$.ajax({
			type: 'POST',
			url: 'name_history_process.php?mode=add',
			data: {emp_id: emp_id, name: name, lname: lname},
			success: function(data) {
				reload_this_window();
			},
			beforeSend: function() {
			}
		});
	}
	function show_edit(yid) {
		var n = $('#yidn_'+yid).text();
		var l = $('#yidl_'+yid).text();
		$('#txt_name').val(n);
		$('#txt_lastname').val(l);
		$('#chk_mode').val('1');
		$('#old_name').val(n);
		$('#old_lname').val(l);
		$('#mm').val('แก้ไขชื่อเดิม');
		show_myDiv();
	}
	
	function reload_this_window() {
		window.location = 'name_history.php';
	}
	
	function show_myDiv() {
		$('#btn_Div').css('display','none');
		$('#myDiv1').css('display','block');
	}
</script>
</head>

<body>
<h3>ชื่อเดิม : <?php echo $_SESSION['EMP_ID']; ?> </h3>
<?php
	$txt_name = $_POST['txt_name'];
	$txt_lastname = $_POST['txt_lastname'];
	
	


	$numrow = $db->count_row(TB_NAME_HISTORY," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow > 0) {
?>
<table width="400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="49" scope="col">แก้ไข</th>
    <th width="121" scope="col">ชื่อ</th>
    <th width="172" scope="col">นามสกุล</th>
    <th width="48" scope="col">ลบ</th>
  </tr>
  <?php
	$sql = "SELECT * FROM  ".TB_NAME_HISTORY."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
	//$row = $db->fetch($sql,$conn);
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	$i =1;
	while($row = oci_fetch_array($stid,OCI_BOTH)) {
?>
  <tr>
    <td><img src="../images/Originals/b_edit.png" width="16" height="16" onclick="show_edit(<?php echo $i; ?>);" /></td>
    <td><span id="yidn_<?php echo $i; ?>"><?php echo $row['NAME']; ?></span></td>
    <td><span id="yidl_<?php echo $i; ?>"><?php echo $row['LAST_NAME']; ?></span></td>
    <td><img src="../images/Originals/b_del.png" width="12" height="12" onclick="del_his('<?php echo $_SESSION['EMP_ID']; ?>','<?php echo $row['NAME']; ?>','<?php echo $row['LAST_NAME']; ?>');" /></td>
  </tr>
  <?php
  	$i++;
	}
?>
</table>
<?php 
	}
	else {
		echo "ไม่มีข้อมูล !";
	}
	//print "<pre>";
	//print_r($_SESSION);
	//print "</pre>";
?>
<div style="margin-left:auto; margin-right:auto; padding: 3px; padding-left: 144px;" id="btn_Div">
	<img src="../images/add.png" width="105" height="36" onclick="show_myDiv();" />
</div>
<div id="myDiv1">
<h3>เพิ่ม / แก้ไขชื่อเดิม</h3>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return chk_txt();">
    <table width="400" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="81">ชื่อ :</td>
        <td width="313"><input type="text" name="txt_name" id="txt_name" /></td>
      </tr>
      <tr>
        <td>นามสกุล :</td>
        <td><input type="text" name="txt_lastname" id="txt_lastname" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type="hidden" name="chk_mode" id="chk_mode" value="0" />
        <input type="hidden" name="old_name" id="old_name" value="" />
        <input type="hidden" name="old_lname" id="old_lname" value="" />
        <input type="submit" value="เพิ่มชื่อเดิม" name="mm" id="mm" />
          <input type="reset" value="ยกเลิก" /></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>