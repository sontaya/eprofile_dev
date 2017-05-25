<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $admin_id = $_POST['admin_id'];
  $admin_name = $_POST['admin_name'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) C FROM SDU_REF_ADMIN WHERE ADMIN_ID = '{$admin_id}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO ref_admin VALUES ('{$admin_id}','{$admin_name}') ";
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
  $admin_id = $_POST['e_id'];
  $admin_name = $_POST['e_name'];

  $sql = "UPDATE SDU_REF_ADMIN SET ADMIN_NAME = '{$admin_name}' WHERE ADMIN_ID = '{$admin_id}' ";
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
  $d_id = $_POST['d_id'];
  $sql = "DELETE SDU_FROM REF_ADMIN WHERE ADMIN_ID = '{$d_id}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>