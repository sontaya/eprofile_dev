<?php

$fpath = '';
require_once($fpath . "../includes/connect.php");

$task = $_POST['task'];
$id = $_POST['id'];

if ($task == 'countryname') {
   $sql_cu_country = "SELECT * FROM  " . TB_REF_NATION . "  WHERE NATION_ID = '" . $id . "' ORDER BY NATION_NAME_TH ASC ";
   $stid_cu_country = oci_parse($conn, $sql_cu_country);
   oci_execute($stid_cu_country);
   $row_cu_country = oci_fetch_array($stid_cu_country, OCI_BOTH);
   $name_country = $row_cu_country["NATION_NAME_TH"];
   echo $name_country;
}

if ($task == 'majorname') {
   $sql_sch_major = "SELECT * FROM  " . TB_REF_ISCED . "  WHERE ISCED_ID = '" . $id . "' ";
   $stid_sch_major = oci_parse($conn, $sql_sch_major);
   oci_execute($stid_sch_major);
   $row = oci_fetch_array($stid_sch_major, OCI_BOTH);
   $name_major = $row["ISCED_NAME_TH"];
   echo $name_major;
}

if ($task == 'educationlist') {
   $sql = "SELECT * FROM " . TB_REF_COURSE;
   $stid = oci_parse($conn, $sql);
   oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_BOTH) )
  {
      $results[] = $row['COURSE_NAME'];
    }
    
   echo json_encode($results);
}

if ($task == 'universitylist') {
   $sql = "SELECT * FROM SDU_REF_UNIV";
   $stid = oci_parse($conn, $sql);
   oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_BOTH) )
  {
      $results[] = $row['UNIV_NAME_TH'];
    }
    
   echo json_encode($results);
}

if ($task == 'expertlist') {
   $sql = "SELECT * FROM SDU_REF_EXPERT";
   $stid = oci_parse($conn, $sql);
   oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_BOTH) )
  {
      $results[] = $row['EXPERT_NAME'];
    }
    
   echo json_encode($results);
}

if ($task == 'royallist') {
   $sql = "SELECT * FROM SDU_REF_ROYAL";
   $stid = oci_parse($conn, $sql);
   oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_BOTH) )
  {
      $results[] = $row['ROYAL_NAME'];
    }
    
   echo json_encode($results);
}

$db->closedb($conn);
?>