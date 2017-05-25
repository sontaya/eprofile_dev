<?php

include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $code = $_POST['code'];
  $faculty = $_POST['faculty'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM SDU_REF_POSITION_CODE WHERE POSITION_CODE = '{$code}' ";
  $st = oci_parse($conn, $sql);
 // print $sql;
  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
 // echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
    $sql = "INSERT INTO SDU_REF_POSITION_CODE(POSITION_CODE,CODE_FACULTY) VALUES ('{$code}','{$faculty}') ";
	print $sql;
    $st = oci_parse($conn, $sql);
    if (oci_execute($st)) {
      echo "บันทึกข้อมูลเรียบร้อย";
    } else {
      echo "ข้อมูลซ้ำ!!";
    }
  }else{
  	 echo $code."ข้อมูลซ้ำ!!";
  }
}

if ($task == 'edit') {
  global $conn;
  //print_r($_POST);
  $code = $_POST['e_code'];
  $faculty = $_POST['e_faculty'];
  $code_o = $_POST['code_o'];

  $sql = "UPDATE SDU_REF_POSITION_CODE SET POSITION_CODE = '".$code."' , CODE_FACULTY='".$faculty."' WHERE POSITION_CODE = '{$code_o}' ";
  //print $sql;
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
  $sql = "DELETE FROM SDU_REF_POSITION_CODE WHERE POSITION_CODE = '{$code}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}
?>