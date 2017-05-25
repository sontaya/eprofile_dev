<?
include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $expert_name_th = $_POST['expert_name_th'];
  $expert_name_en = $_POST['expert_name_en'];
  $expert_name_short = $_POST['expert_name_short'];
  $expert_name_unit = $_POST['expert_name_unit'];
  $expert_name_amount = $_POST['expert_name_amount'];
  $expert_name_tax = $_POST['expert_name_tax'];
  $expert_name_ss = $_POST['expert_name_ss'];
  //echo $expert_name;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM ".TB_SDU_OVERTIME." WHERE OTPAY_NAME_TH = '{$expert_name_th}' ";
  //print $sql;
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
  
  	$sql = "SELECT * FROM ".TB_SDU_OVERTIME." ORDER BY OTPAY_CODE" ;
  	$st = oci_parse($conn, $sql);
	oci_execute($st);
  	while($dbarr= oci_fetch_array($st, OCI_ASSOC)){
		$max=$dbarr["OTPAY_CODE"];
	}
	$max=$max+1;
    $sql = "INSERT INTO ".TB_SDU_OVERTIME." (OTPAY_CODE ,OTPAY_NAME_TH, OTPAY_NAME_EN, OTPAY_NAME_SHORT, OTPAY_UNIT, OTPAY_COUNT, CAL_TAX, CAL_SSO) VALUES ($max, '{$expert_name_th}', '{$expert_name_en}', '{$expert_name_short}', '{$expert_name_unit}', '{$expert_name_amount}', '{$expert_name_tax}', '{$expert_name_ss}') ";
    $st = oci_parse($conn, $sql);
    if (oci_execute($st)) {
      echo "บันทึกข้อมูลเรียบร้อย";
    } else {
      echo "ข้อมูลซ้ำ!!";
    }
  }
}

if ($task == 'edit') {
  global $conn;
  //print_r($_POST);
  $expert_id = $_POST['e_expert_id'];
  $expert_name_th = $_POST['e_expert_name_th'];
  $expert_name_en = $_POST['e_expert_name_en'];
  $expert_name_short = $_POST['e_expert_name_short'];
  $expert_name_unit = $_POST['e_expert_name_unit'];
  $expert_name_amount = $_POST['e_expert_name_amount'];
  $expert_name_tax = $_POST['e_expert_name_tax'];
  $expert_name_ss = $_POST['e_expert_name_ss'];

  $sql = "UPDATE ".TB_SDU_OVERTIME." SET OTPAY_NAME_TH = '{$expert_name_th}', OTPAY_NAME_EN = '{$expert_name_en}', OTPAY_NAME_SHORT = '{$expert_name_short}', OTPAY_UNIT = '{$expert_name_unit}', OTPAY_COUNT = '{$expert_name_amount}', CAL_TAX = '{$expert_name_tax}', CAL_SSO = '{$expert_name_ss}' WHERE OTPAY_CODE = '{$expert_id}' ";
  echo $sql;
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "แก้ไขข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

if ($task == 'delete') {
  //print_r($_POST);
  global $conn;
  $expert_id = $_POST['expert_id'];
  $sql = "DELETE FROM ".TB_SDU_OVERTIME." WHERE OTPAY_CODE = '{$expert_id}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

?>