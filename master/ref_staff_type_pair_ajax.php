<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $stafftype_normal_id = $_POST['stafftype_normal_id'];
  $stafftype_sga_id = $_POST['stafftype_sga_id'];
  $stafftype_sub_id = $_POST['stafftype_sub_id'];
  $sql = "INSERT INTO sdu_ref_stafftype_pair VALUES (PAIR_ID_SEQ.NEXTVAL,'{$stafftype_normal_id}','{$stafftype_sga_id}','{$stafftype_sub_id}') ";
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
  $stafftype_sub_id = $_POST['e_stafftype_sub_id'];

  $sql = "UPDATE sdu_ref_stafftype_pair SET STAFFTYPE_NORMAL_ID = '{$stafftype_normal_id}',STAFFTYPE_SGA_ID = '{$stafftype_sga_id}',STAFFTYPE_SUB_ID = '{$stafftype_sub_id}' WHERE STAFFTYPE_PAIR_ID = '{$code}' ";
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
  $sql = "DELETE FROM sdu_ref_stafftype_pair WHERE STAFFTYPE_PAIR_ID = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>