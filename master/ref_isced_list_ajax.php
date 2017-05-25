<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $isced_id = $_POST['isced_id'];
  $isced_name_th = $_POST['isced_name_th'];
  $isced_name_eng = $_POST['isced_name_eng'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) C FROM REF_ISCED WHERE ISCED_ID = '{$isced_id}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO REF_ISCED VALUES ('{$isced_id}','{$isced_name_th}','{$isced_name_eng}') ";
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

  $e_code = $_POST['e_code'];
  $e_th = $_POST['e_th'];
  $e_eng = $_POST['e_eng'];

  $sql = "UPDATE REF_ISCED SET ISCED_NAME_TH = '{$e_th}', ISCED_NAME_ENG = '{$e_eng}' WHERE ISCED_ID = '{$e_code}' ";
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
  $sql = "DELETE FROM REF_ISCED WHERE ISCED_ID = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>