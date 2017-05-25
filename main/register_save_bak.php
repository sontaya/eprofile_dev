<?
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
//sleep(1);
//$id_card = pea_substr($_POST["id_card"],13);
$emp_id = pea_substr(trim($_POST["emp_id"]),30);
$username = pea_substr($_POST["username"],20);
$password = md5($_POST["password"]);
$user_type = $_POST["user_type"];
$main_department = $_POST["main_department"];
$sub_department = $_POST["sub_department"];
$register_date = date("Y-m-d");

$numrow_id = $db->count_row(TB_USER_TAB," WHERE EMP_ID = '$emp_id' AND USER_TYPE = '$user_type' ",$conn); 
if($numrow_id == 0 && $user_type!="user"){ // ถ้าเป็น user จะไม่บันทึกลง 
	$numrow_username = $db->count_row(TB_USER_TAB," WHERE USERNAME = '$username' ",$conn); 
	if($numrow_username == 0){
		$id = auto_increment("ID",TB_USER_TAB);
		$result=$db->add_db(TB_USER_TAB,array(
											"ID"=>"$id",
										  "EMP_ID"=>"$emp_id",
										  "USERNAME"=>"$username",
										  "PASSWORD"=>"$password",
										  "USER_TYPE"=>"$user_type",
										  "MAIN_DEPARTMENT"=>"$main_department",
										  "SUB_DEPARTMENT"=>"$sub_department",
										  "REGISTER_DATE"=>"TO_DATE('$register_date','YYYY-MM-DD')",
										  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
										  "UPDATE_BY"=>"$update_user"
										  ),$conn);
        echo "hi".$result;
		if($result){
			echo "1";
			access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ผู้ใช้งาน' -> $username ($emp_id)");
		}else{
			echo "0";	
		}
	}else{
		echo "3";
	}
}else{
	echo "2";
}
$db->closedb($conn);	
}
?>