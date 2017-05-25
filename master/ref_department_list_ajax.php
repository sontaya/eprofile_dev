<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $code_faculty = $_POST['code_faculty'];
  $new_code_faculty = $_POST['code_faculty'];
  $name_faculty = $_POST['name_faculty'];
  $uoc_ref_fac = $_POST['uoc_ref_fac'];

  $sql = "SELECT COUNT(*) C FROM SDU_REF_DEPARTMENT WHERE CODE_FACULTY = '{$code_faculty}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_DEPARTMENT VALUES ('{$code_faculty}','{$name_faculty}','{$uoc_ref_fac}','{$new_code_faculty}') ";
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
  $n_code = $_POST['n_code'];
  $e_faculty = $_POST['e_faculty'];
  $e_uoc_ref = $_POST['e_uoc_ref'];


  $sql = "UPDATE SDU_REF_DEPARTMENT SET NAME_FACULTY = '{$e_faculty}',UOC_REF_FAC = '{$e_uoc_ref}',NEW_CODE_FACULTY = '{$n_code}' WHERE CODE_FACULTY = '{$e_code}' ";
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
  $sql = "DELETE FROM SDU_REF_DEPARTMENT WHERE CODE_FACULTY = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>