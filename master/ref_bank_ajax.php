<?
include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $expert_name = $_POST['expert_name'];
  //echo $expert_name;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM ".TB_SDU_BANK." WHERE BANK_NAME = '{$expert_name}' ";
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
  
  	$sql = "SELECT * FROM ".TB_SDU_BANK." ORDER BY BANK_ID" ;
  	$st = oci_parse($conn, $sql);
	oci_execute($st);
  	while($dbarr= oci_fetch_array($st, OCI_ASSOC)){
		$max=$dbarr["BANK_ID"];
	}
	$max=$max+1;
    $sql = "INSERT INTO ".TB_SDU_BANK." (BANK_ID, BANK_NAME) VALUES ($max,'{$expert_name}') ";
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
  $expert_name = $_POST['e_expert_name'];

  $sql = "UPDATE ".TB_SDU_BANK." SET BANK_NAME = '{$expert_name}' WHERE BANK_ID = '{$expert_id}' ";
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
  $sql = "DELETE FROM ".TB_SDU_BANK." WHERE BANK_ID = '{$expert_id}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

?>