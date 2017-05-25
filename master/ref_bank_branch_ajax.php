<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $stafftype_normal_id = $_POST['stafftype_normal_id'];
  $stafftype_sga_id = $_POST['stafftype_sga_id'];
  $sql = "INSERT INTO SDU_BANK_BRANCH (BRANCH_ID, BANK_ID, BRANCH_NAME) VALUES (PAIR_ID_SEQ.NEXTVAL,'{$stafftype_normal_id}','{$stafftype_sga_id}') ";
  echo $sql;
  $st = oci_parse($conn, $sql);
  if (oci_execute($st)) {
    echo "บันทึกข้อมูลเรียบร้อย";
  } else {
    echo "ข้อมูลซ้ำ!!";
  }
}

if ($task == 'edit') {
  global $conn;
  //print_r($_POST);
  $code = $_POST['e_code'];
  $stafftype_normal_id = $_POST['e_stafftype_normal_id'];
  $stafftype_sga_id = $_POST['e_stafftype_sga_id'];

  $sql = "UPDATE SDU_BANK_BRANCH SET BANK_ID = '{$stafftype_normal_id}',BRANCH_NAME = '{$stafftype_sga_id}' WHERE BRANCH_ID = '{$code}' ";
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
  $sql = "DELETE FROM SDU_BANK_BRANCH WHERE BRANCH_ID = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>