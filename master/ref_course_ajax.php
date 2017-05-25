<?
include("../includes/connect.php");

$task = $_POST['mode'];
if ($task == 'add') {
  global $conn;
  $course_name = $_POST['course_name'];
  //echo $code . " " . $position;
  // connect
  $sql = "SELECT COUNT(*) AS C FROM ".TB_REF_COURSE." WHERE COURSE_NAME = '{$course_name}' ";
  $st = oci_parse($conn, $sql);

  if (!oci_execute($st)) {
    $err = oci_error($st);
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $rc = oci_fetch_array($st, OCI_ASSOC);
  //echo "\$rc : " .$rc['C'];
  // ถ้ามี CODE อยู่แล้ว จะไม่เพิ่มอีก
  if ($rc['C'] == 0) {
  
  	$sql = "SELECT * FROM ".TB_REF_COURSE." ORDER BY COURSE_ID" ;
  	$st = oci_parse($conn, $sql);
	oci_execute($st);
  	while($dbarr= oci_fetch_array($st, OCI_ASSOC)){
		$max=$dbarr["COURSE_ID"];
	}
	$max=$max+1;
    $sql = "INSERT INTO ".TB_REF_COURSE." VALUES ('{$course_name}',$max) ";
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
  $course_id = $_POST['e_course_id'];
  $course_name = $_POST['e_course_name'];

  $sql = "UPDATE ".TB_REF_COURSE." SET COURSE_NAME = '{$course_name}' WHERE COURSE_ID = '{$course_id}' ";
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
  $course_id = $_POST['course_id'];
  $sql = "DELETE FROM ".TB_REF_COURSE." WHERE course_ID = '{$course_id}' ";
  $st = oci_parse($conn, $sql);
  $result = oci_execute($st);
  if ($result) {
    echo "ลบข้อมูลเรียบร้อย";
  } else {
    echo "failure";
  }
}

?>