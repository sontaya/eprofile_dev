<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $abbreviation = $_POST['abbreviation'];
  $order = $_POST['order'];


  $sql = "SELECT COUNT(*) C FROM SDU_REF_EXTRA_SALARY WHERE ID = '{$id}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_EXTRA_SALARY VALUES ('{$id}','{$name}','{$abbreviation}','{$order}') ";
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
  $e_id = $_POST['e_id'];
  $e_name = $_POST['e_name'];
  $e_abbreviation = $_POST['e_abbreviation'];
  $e_order = $_POST['e_order'];

  $sql = "UPDATE SDU_REF_EXTRA_SALARY SET NAME = '{$e_name}', ABBREVIATION = '{$e_abbreviation}', ORDERS = '{$e_order}' WHERE ID = '{$e_id}' ";
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
  $sql = "DELETE FROM SDU_REF_EXTRA_SALARY WHERE ID = '{$code}' ";
  $st = oci_parse($conn, $sql);

  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>