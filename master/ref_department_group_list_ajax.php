<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $code = $_POST['code'];
  $code_department_group = $_POST['code_department_group'];
  $name_department_group = $_POST['name_department_group'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) C FROM SDU_REF_DEPARTMENT_GROUP WHERE CODE_DEPARTMENT_GROUP = '{$code_department_group}' AND CODE_DEPARTMENT_SUB = '{$code}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_DEPARTMENT_GROUP VALUES ('{$code}','{$code_department_group}','{$name_department_group}') ";
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
  $e_subcode = $_POST['e_subcode'];
  $e_groupcode = $_POST['e_groupcode'];
  $e_group = $_POST['e_group'];

  $sql = "UPDATE SDU_REF_DEPARTMENT_GROUP SET NAME_DEPARTMENT_GROUP = '{$e_group}' WHERE CODE_DEPARTMENT_SUB = '{$e_subcode}' AND CODE_DEPARTMENT_GROUP = '{$e_groupcode}' ";
  //echo "<p>{$sql}</p>";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "แก้ไขข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

if ($task == 'delete') {

  global $conn;
  $code = $_POST['d_code'];
  $sql = "DELETE FROM SDU_REF_DEPARTMENT_GROUP WHERE CODE_DEPARTMENT_GROUP = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>