<?
include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $rate_name = $_POST['rate_name'];
  $rate_tax = $_POST['rate_tax'];
  $rate_break = $_POST['rate_break'];
  //echo $expert_name;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM ".TB_SDU_TAXRATE." WHERE RATE_NAME = '{$rate_name}' ";
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
  
  	$sql = "SELECT * FROM ".TB_SDU_TAXRATE." ORDER BY RATE_CODE" ;
  	$st = oci_parse($conn, $sql);
	oci_execute($st);
  	while($dbarr= oci_fetch_array($st, OCI_ASSOC)){
		$max=$dbarr["RATE_CODE"];
	}
	$max=$max+1;
    $sql = "INSERT INTO ".TB_SDU_TAXRATE." (RATE_CODE ,RATE_NAME, RATE_TAX, RATE_BREAK) VALUES ($max, '{$rate_name}', '{$rate_tax}', '{$rate_break}') ";
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
  $rate_name = $_POST['e_rate_name'];
  $rate_tax = $_POST['e_rate_tax'];
  $rate_break = $_POST['e_rate_break'];

  $sql = "UPDATE ".TB_SDU_TAXRATE." SET RATE_NAME = '{$rate_name}', RATE_TAX = '{$rate_tax}', RATE_BREAK = '{$rate_break}' WHERE RATE_CODE = '{$expert_id}' ";
//  echo $sql;
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
  $sql = "DELETE FROM ".TB_SDU_TAXRATE." WHERE RATE_CODE = '{$expert_id}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

?>