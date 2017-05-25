<?
@session_start();
@ini_set('display_errors', '0');
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$code_old=$_POST["code_old"];
$code_new=$_POST["code_new"];

$numrow = $db->count_row(TB_BIODATA_TAB," WHERE EMP_ID = '$code_new' ",$conn); 

if($numrow>0){
	print $code_new." หมายเลขบุคคลการนี้มีอยู่ในฐานข้อมูลแล้ว";
}

$numrow_old = $db->count_row(TB_BIODATA_TAB," WHERE EMP_ID = '$code_old' ",$conn);

if($numrow==0){
//$sql="SELECT * FROM ".TB_BIODATA_TAB." WHERE EMP_ID='".$code_old."'";


//$stdt = oci_parse($conn,$sql);
//oci_execute($stdt);
			$insert="INSERT INTO SDU_CHANGE_CODE(CODE_OLD,CODE_NEW,CREATE_DATE,CREATE_BY) VALUES('".$code_old."','".$code_new."',TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS'),'".$_SESSION["EMP_ID"]."')";
			//print $insert;
			$stid = oci_parse($conn, $insert );
    		$result=oci_execute($stid);
			include("data_insert.php");
			include("update_code.php");
			
			$db->closedb($conn);
		}
			
			if($result){
				print "เปลี่ยนรหัสบุคคลกรเรียบร้อย";
			}
			else if($numrow_old==0){
				print "ไม่พบหมายเลขบุคคลกร $code_old";
			}
			else{
				print "ไม่สามารถเปลี่ยนรหัสบุคคลกรได้";
			}
	}


?>