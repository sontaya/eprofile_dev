<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $code = $_POST['code'];
  $position = $_POST['position'];
  $position_e = $_POST['position_e'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM SDU_REF_LEV WHERE LEV_ID = '{$code}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_LEV(LEV_ID,LEV_NAME_TH,LEV_NAME_ENG) VALUES ('{$code}','{$position}','{$position_e}') ";
    $st = oci_parse($conn, $sql);
    if (oci_execute($st)) {
      echo "บันทึกข้อมูลเรียบร้อย";
    }
  } else {
    echo "ข้อมูลซ้ำ!!";
  }
}

if ($task == 'edit') {
  global $conn;
  //print_r($_POST);
  $code = $_POST['e_code'];
  $position = $_POST['e_position'];
  $position_e = $_POST['e_position_e'];

  $sql = "UPDATE SDU_REF_LEV SET LEV_NAME_TH = '{$position}', LEV_NAME_ENG= '{$position_e}' WHERE LEV_ID = '{$code}' ";
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
  $code = $_POST['d_code'];
  $sql = "DELETE FROM SDU_REF_LEV WHERE LEV_ID = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>