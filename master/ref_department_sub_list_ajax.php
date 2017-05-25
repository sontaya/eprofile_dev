<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $code = $_POST['code'];
  $code_department_section = $_POST['code_department_section'];
  $new_code_department_section = $_POST['new_code_department_section'];
  $name_department_section = $_POST['name_department_section'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) C FROM SDU_REF_DEPARTMENT_SUB WHERE CODE_FACULTY = '{$code}' AND CODE_DEPARTMENT_SECTION = '{$code_department_section}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_DEPARTMENT_SUB VALUES ('{$code}', '{$code_department_section}', '{$name_department_section}', '{$new_code_department_section}') ";
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
  $e_code_fac = $_POST['e_code_fac'];
  $e_code_dep = $_POST['e_code_dep'];
  $n_code_dep = $_POST['n_code_dep'];
  $e_name_department_section = $_POST['e_name_department_section'];

  $sql = "UPDATE SDU_REF_DEPARTMENT_SUB SET NAME_DEPARTMENT_SECTION = '{$e_name_department_section}', NEW_CODE_DEPARTMENT_SECTION = '{$n_code_dep}' WHERE CODE_FACULTY = '{$e_code_fac}' AND CODE_DEPARTMENT_SECTION = '{$e_code_dep}' ";
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
  $sql = "DELETE FROM SDU_REF_DEPARTMENT_SUB WHERE CODE_DEPARTMENT_SECTION = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>