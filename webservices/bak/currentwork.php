<?php

require_once("../includes/connect.php");
$client = new SoapClient("currentwork.wsdl");
$catalogId = '3100901188283';
//print_r($client->__getFunctions());
$response = $client->getCurrentworkEntry($catalogId);

//$xml = simplexml_load_string($response);
$xml = simplexml_load_file('person1.xml');
//var_dump($xml->PERSON[1]->SALARY_STEP);
//count($xml->PERSON[0]->EX_SALARY);
//echo $xml->PERSON[0]->attributes()->id;
//echo $xml->EMP_ID;
//echo $xml->LAST_UPDATE;
//echo count($xml->PERSON);

for ($i = 0; $i < count($xml->PERSON); $i++) {

// ค้นหาข้อมูลจากของที่มีอยู่เพื่อไปอัพเดตลง history
  $sql = "SELECT * FROM SDU_CURRENT_WORK_TAB WHERE EMP_ID = '{$xml->PERSON[$i]->attributes()->id}' ";

  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);

// add ลง history CURRENT_WORK_TAB_HISTORY
  $result = $db->add_db("SDU_CURRENT_WORK_TAB_HISTORY", array(
              "EMP_ID" => "{$row['EMP_ID']}",
              "CWK_STATUS" => "{$row['CWK_STATUS']}",
              "CWK_MUA_EMP_TYPE" => "{$row['CWK_MUA_EMP_TYPE']}",
              "CWK_MUA_EMP_SUBTYPE" => "{$row['CWK_MUA_EMP_SUBTYPE']}",
              "CWK_MUA_MAIN" => "{$row['CWK_MUA_MAIN']}",
              "CWK_MUA_SUBMAIN" => "{$row['CWK_MUA_SUBMAIN']}",
              "CWK_DSU_EDU_CENTER" => "{$row['CWK_DSU_EDU_CENTER']}",
              "CWK_DSU_POS" => "{$row['CWK_DSU_POS']}",
              "CWK_MUA_VPOS" => "{$row['CWK_MUA_VPOS']}",
              "CWK_MUA_LEVEL" => "{$row['CWK_MUA_LEVEL']}",
              "CWK_MUA_MPOS" => "{$row['CWK_MUA_MPOS']}",
              "CWK_MUA_WORK_GROUP" => "{$row['CWK_MUA_WORK_GROUP']}",
              "CWK_START_WORK_DATE" => "TO_DATE('{$row['CWK_START_WORK_DATE']}','YYYY-MM-DD')",
              "CWK_END_WORK_DATE" => "TO_DATE('{$row['CWK_END_WORK_DATE']}','YYYY-MM-DD')",
              "CWK_START_WORK" => "{$row['CWK_START_WORK']}",
              "CWK_END_WORK" => "{$row['CWK_END_WORK']}",
              "CWK_SAT" => "{$row['CWK_SAT']}",
              "CWK_SUN" => "{$row['CWK_SUN']}",
              "CWK_START_TEACH_DATE" => "TO_DATE('{$row['CWK_START_TEACH_DATE']}','YYYY-MM-DD')",
              "CWK_ORDER1" => "{$row['CWK_ORDER1']}",
              "CWK_TEACH_ORDER" => "{$row['CWK_TEACH_ORDER']}",
              "CWK_PROMOTE_DATE" => "TO_DATE('{$row['cwk_promote_date']}','YYYY-MM-DD')",
              "CWK_ORDER2" => "{$row['CWK_ORDER2']}",
              "CWK_PROMOTE_ORDER" => "{$row['CWK_PROMOTE_ORDER']}",
              "CWK_SALARY_TIME_TYPE" => "{$row['CWK_SALARY_TIME_TYPE']}",
              "CWK_PHONE" => "{$row['CWK_PHONE']}",
              "CWK_EDU_GROUP1" => "{$row['CWK_EDU_GROUP1']}",
              "CWK_EDU_GROUP2" => "{$row['CWK_EDU_GROUP2']}",
              "CWK_EDU_GROUP3" => "{$row['CWK_EDU_GROUP3']}",
              "CWK_TEACHER_FILE" => "{$row['CWK_TEACHER_FILE']}",
              "CWK_CERT_FILE" => "{$row['CWK_CERT_FILE']}",
              "CWK_QUIT_DATE" => "TO_DATE('{$row['CWK_QUIT_DATE']}','YYYY-MM-DD')",
              "CWK_QUIT_REASON" => "{$row['CWK_QUIT_REASON']}",
              "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
              "UPDATE_BY" => "{$row['UPDATE_USER']}"
                  ), $conn);



//$sql = "SELECT * FROM SDU_SALARY_STEP WHERE EMP_ID = '{$xml->PERSON[0]->attributes()->id}' ORDER BY REF DESC ";
//$stid = oci_parse($conn, $sql);
//oci_execute($stid);
//$row = oci_fetch_array($stid, OCI_BOTH);
//
//$id = auto_increment("REF", "SDU_SALARY_STEP_HISTORY");
//$db->add_db("SDU_SALARY_STEP_HISTORY", array(
//    "REF" => "{$id}",
//    "EMP_ID" => "{$xml->PERSON[0]->attributes()->id}",
//    "SOURCE1" => "{$row['SOURCE1']}",
//    "SOURCE2" => "{$row['SOURCE2']}",
//    "SOURCE3" => "{$row['SOURCE3']}",
//    "SALARY1" => "{$row['SALARY1']}",
//    "SALARY2" => "{$row['SALARY2']}",
//    "SALARY3" => "{$row['SALARY3']}",
//    "AFFECTIVE_DATE" => "{$row['AFFECTIVE_DATE']}",
//    "LAST_UPDATE" => "{$row['LAST_UPDATE']}",
//    "UPDATE_BY" => "{$row['UPDATE_BY']}"
//        ), $conn);


  $sql = "SELECT * FROM SDU_EX_SALARY WHERE EMP_ID = '{$xml->PERSON[$i]->attributes()->id}' ";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);
  $id = auto_increment("EX_ID", "SDU_EX_SALARY_HISTORY");
  $db->add_db("SDU_EX_SALARY_HISTORY", array(
      "EMP_ID" => "{$row['EMP_ID']}",
      "EX_ID" => "{$id}",
      "EX_SALARY_REF" => "{$row['EX_SALARY_REF']}",
      "EX_SALARY" => "{$row['EX_SALARY']}",
      "EX_SOURCE" => "{$row['EX_SOURCE']}",
      "LAST_UPDATE" => "{$row['LAST_UPDATE']}",
      "UPDATE_BY" => "{$row['UPDATE_BY']}"
          ), $conn);


// update ฐานข้อมูลตัวเก่าให้เป็นค่าตาม xml ที่รับมา
  $result = $db->update_db("SDU_CURRENT_WORK_TAB", array(
              "EMP_ID" => "{$xml->PERSON[$i]->CURRENTWORK->EMP_ID}",
              "CWK_STATUS" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_STATUS}",
              "CWK_MUA_EMP_TYPE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_EMP_TYPE}",
              "CWK_MUA_EMP_SUBTYPE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_EMP_SUBTYPE}",
              "CWK_MUA_MAIN" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_MAIN}",
              "CWK_MUA_SUBMAIN" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_SUBMAIN}",
              "CWK_DSU_EDU_CENTER" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_DSU_EDU_CENTER}",
              "CWK_DSU_POS" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_DSU_POS}",
              "CWK_MUA_VPOS" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_VPOS}",
              "CWK_MUA_LEVEL" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_LEVEL}",
              "CWK_MUA_MPOS" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_MPOS}",
              "CWK_MUA_WORK_GROUP" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_MUA_WORK_GROUP}",
              //"CWK_START_WORK_DATE" => "TO_DATE('{$xml->PERSON[$i]->CURRENTWORK->CWK_START_WORK_DATE}','YYYY-MM-DD')",
              //"CWK_END_WORK_DATE" => "TO_DATE('{$xml->PERSON[$i]->CURRENTWORK->CWK_END_WORK_DATE}','YYYY-MM-DD')",
              "CWK_START_WORK" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_START_WORK}",
              "CWK_END_WORK" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_END_WORK}",
              "CWK_SAT" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_SAT}",
              "CWK_SUN" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_SUN}",
              //"CWK_START_TEACH_DATE" => "TO_DATE('{$xml->PERSON[$i]->CURRENTWORK->CWK_START_TEACH_DATE}','YYYY-MM-DD')",
              "CWK_ORDER1" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_ORDER1}",
              "CWK_TEACH_ORDER" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_TEACH_ORDER}",
              //"CWK_PROMOTE_DATE" => "TO_DATE('{$xml->PERSON[$i]->CURRENTWORK->cwk_promote_date}','YYYY-MM-DD')",
              "CWK_ORDER2" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_ORDER2}",
              "CWK_PROMOTE_ORDER" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_PROMOTE_ORDER}",
              "CWK_SALARY_TIME_TYPE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_SALARY_TIME_TYPE}",
              "CWK_PHONE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_PHONE}",
              "CWK_EDU_GROUP1" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_EDU_GROUP1}",
              "CWK_EDU_GROUP2" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_EDU_GROUP2}",
              "CWK_EDU_GROUP3" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_EDU_GROUP3}",
              "CWK_TEACHER_FILE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_TEACHER_FILE}",
              "CWK_CERT_FILE" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_CERT_FILE}",
              //"CWK_QUIT_DATE" => "TO_DATE('{$xml->PERSON[$i]->CURRENTWORK->CWK_QUIT_DATE}','YYYY-MM-DD')",
              "CWK_QUIT_REASON" => "{$xml->PERSON[$i]->CURRENTWORK->CWK_QUIT_REASON}",
              "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
              "UPDATE_BY" => "{$xml->PERSON[$i]->CURRENTWORK->UPDATE_BY}"
                  ), "EMP_ID='{$xml->PERSON[$i]->attributes()->id}'", $conn);


  $id = auto_increment("REF", "SDU_SALARY_STEP");
  $db->add_db("SDU_SALARY_STEP", array(
      "REF" => "{$id}",
      "EMP_ID" => "{$xml->PERSON[$i]->attributes()->id}",
      "SOURCE1" => "{$xml->PERSON[$i]->SALARY_STEP->SOURCE1}",
      "SOURCE2" => "{$xml->PERSON[$i]->SALARY_STEP->SOURCE2}",
      "SOURCE3" => "{$xml->PERSON[$i]->SALARY_STEP->SOURCE3}",
      "SALARY1" => "{$xml->PERSON[$i]->SALARY_STEP->SALARY1}",
      "SALARY2" => "{$xml->PERSON[$i]->SALARY_STEP->SALARY2}",
      "SALARY3" => "{$xml->PERSON[$i]->SALARY_STEP->SALARY3}",
      "AFFECTIVE_DATE" => "{$xml->PERSON[$i]->CURRENTWORK->AFFECTIVE_DATE}",
      "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
      "UPDATE_BY" => "{$xml->PERSON[$i]->CURRENTWORK->UPDATE_BY}"
          ), $conn);


  $sql = "DELETE  FROM  SDU_EX_SALARY  WHERE EMP_ID='" . $xml->PERSON[$i]->attributes()->id . "'";
  $query = oci_parse($conn, $sql);
  oci_execute($query);

  for ($j = 0; $j < count($xml->PERSON[$i]->EX_SALARY); $j++) {
    $ex_id = auto_increment("EX_ID", "SDU_EX_SALARY");
    $db->add_db("SDU_EX_SALARY", array(
        "EMP_ID" => "{$xml->PERSON[$i]->attributes()->id}",
        "EX_ID" => "{$ex_id}",
        "EX_SALARY_REF" => "{$xml->PERSON[$i]->EX_SALARY[$j]->EX_SALARY_REF}",
        "EX_SALARY" => "{$xml->PERSON[$i]->EX_SALARY[$j]->EX_SALARY}",
        "EX_SOURCE" => "{$xml->PERSON[$i]->EX_SALARY[$j]->EX_SOURCE}",
        //"LAST_UPDATE" => "{$xml->PERSON[$i]->EX_SALARY[$i]->ES_LAST_UPDATE}",   ติดปัญหา วันที่ ภาษาไทย
        "UPDATE_BY" => "{$xml->PERSON[$i]->EX_SALARY[$j]->UPDATE_BY}"
            ), $conn);
  }
// จบ update ฐานข้อมูลตัวใหม่เข้าตัวเก่า
}
?>