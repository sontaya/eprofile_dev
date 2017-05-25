<?php
@session_start();

$fpath = '../';
require_once($fpath."includes/connect.php");

$user_permission_value = $_POST['permit_value'];
$emp_id = $_POST['permit_empid'];

$sql = "SELECT * FROM  ".TB_USER_TAB." WHERE EMP_ID = '{$emp_id}'";
$row = $db->fetch($sql,$conn);
$u=$row["USERNAME"];


//$numrow_id = $db->count_row(TB_USER_TAB," WHERE EMP_ID = '$emp_id' AND USER_TYPE = '$user_permission_value' ",$conn); 
$numrow_id = $db->count_row(TB_USER_TAB," WHERE EMP_ID = '$emp_id'",$conn); 
//print $numrow_id;
if($numrow_id == 0 && $user_permission_value!="user"){ // ถ้าเป็น user จะไม่บันทึกลง 

		$id = auto_increment("ID",TB_USER_TAB);
		$result=$db->add_db(TB_USER_TAB,array(
											"ID"=>"$id",
										  "EMP_ID"=>"$emp_id",
											"USERNAME"=>"$u",
										  "USER_TYPE"=>"$user_permission_value",
										  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
										  "UPDATE_BY"=>"$update_user"
										  ),$conn);
		if($result){
			echo "1";
			access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ผู้ใช้งาน' -> $username ($emp_id)");
		}else{
			echo "0";	
		}
}elseif($user_permission_value!="user"){
	//print "n";
	$result = $db->update_db(TB_USER_TAB,array("USER_TYPE"=>"$user_permission_value","USERNAME"=>"$u"),"EMP_ID='$emp_id'",$conn);
}

?>