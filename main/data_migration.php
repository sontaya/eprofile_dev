<?
$fpath = '';
require_once($fpath . "../includes/connect.php");
set_time_limit(0);

//DATABASE MIGRATION  ชื่อ table จากฐานข้อมูลเก่า ตามด้วย  ฐานข้อมูลใหม่ที่จะนำเข้า
//BIOGRAPHY_PERSON_TO_BIODATA_TAB_AND_CURRENT_ADDRESS_TAB();   // pass
//FAMILY_PARENT_TO_FAMILY_TAB();                               // pass
CURRENTWORK_TO_CURRENT_WORK_TAB();                           // pass
UPDATE_DSU_POS_IN_CURRENTWORK_TAB();
UPDATE_DSU_POS_IN_CURRENTWORK_TAB_ver2();
PERSONNEL_STATUS_TO_CURRENT_WORK_TAB();                      // pass
//SALARY_MASTER_TO_EX_SALARY();                                // pass
//ROYAL_DECORATE_DETAIL_AND_ROTAL_DECORATE_TO_ROYAL_TAB();     // pass
//PASTWORK_TO_WORK_HISTORY_TAB();                              // pass
//QUALIFICATION_TO_EDUCATION_TAB();                            // pass
//EXPERT_EXTEND_TO_EXPERT_TAB();                               // pass
//COMMITTEE_AND_PERSONAL_DEVELOPMENT_TO_SEMINAR_TAB();         // pass
//COMMITTEE_TO_CONSULT_COMMIT_TAB();                           // pass
//RES_SCHOLAR_TO_RESEARCH_TAB();                               // pass
//SALARY_MASTER_AND_SALARY_HISTORY_LOG_TO_SALARY_STEP();       // pass
//SCHOLAR_TO_SCHOLAR_TAB();                                    // pass
//COMMITTEE_AND_PERSONNEL_DEVELOPMENT_TO_COMMITTEE_TAB();      // pass
//CURRENT_WORK_TO_VCHAKARN_POSITION_TAB();

//BIOGRAPHY_PERSON_TO_CEN_ADDRESS_TAB();
//PERSONAL_DEVELOP_TO_CONSTRUCTOR();




function UPDATE_DSU_POS_IN_CURRENTWORK_TAB() {
  global $conn, $db;
  $sql = "SELECT DISTINCT CODE_PERSON, CUR_POSITION,CODE FROM CURRENTWORK
          LEFT JOIN SDU_POSITION 
          ON CUR_POSITION = POSITION
          WHERE CODE IS NOT NULL";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $CWK_DSU_POS = $row['CODE'];
      $result = $db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_DSU_POS" => "$CWK_DSU_POS",
                      ), "EMP_ID='$emp_id'", $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }
}

// ล่าสุดหลังจากคุณอี้ดอัพเดต
function UPDATE_DSU_POS_IN_CURRENTWORK_TAB_ver2() { 
  global $conn, $db;
  $sql = "SELECT DISTINCT CODE,POSITION FROM SDU_PAIR_POSITION ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE'];
      $CWK_DSU_POS = $row['POSITION'];
      $result = $db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_DSU_POS" => "$CWK_DSU_POS",
                      ), "EMP_ID='$emp_id'", $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }
}

function PERSONAL_DEVELOP_TO_CONSTRUCTOR() {
  global $conn, $db;
  $sql = "SELECT * FROM PERSONNEL_DEVELOPMENT WHERE DEV_TYPE IN (05,06) ";

  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $CON_TYPE = $row['DEV_TYPE'];
      $CON_COURSE_NAME = $row['DEV_COURSE'];
      $CON_START_DATE = $row['DEV_DATE_START'];
      $CON_END_DATE = $row['DEV_DATE_END'];
      $CON_PLACE = $row['DEV_PLACE'];
      $CON_DETAIL = $row['DEV_DETAIL'];
      $n++;


      $res = $db->add_db("SDU_CONSTRUCTOR_TAB", array(
                  "EMP_ID" => "$emp_id",
                  "CON_ID" => "$n",
                  "CON_TYPE" => "$CON_TYPE",
                  "CON_COURSE_NAME" => "$CON_COURSE_NAME",
                  "CON_START_DATE" => "$CON_START_DATE",
                  "CON_END_DATE" => "$CON_END_DATE",
                  "CON_PLACE" => "$CON_PLACE",
                  "CON_DETAIL" => "$CON_DETAIL"
                      ), $conn);
      if ($res)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }
}

function CURRENT_WORK_TO_VCHAKARN_POSITION_TAB() {
  global $conn, $db;
  $sql = "SELECT CODE_PERSON,CUR_KNOWPOSITION FROM CURRENTWORK WHERE CUR_KNOWPOSITION IN (03,14,15,02,04)";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      if ($row['CUR_KNOWPOSITION'] == 03) { $vp_sub_type = 1; $vp_type = 2; }
      if ($row['CUR_KNOWPOSITION'] == 14) { $vp_sub_type = 2; $vp_type = 2; }
      if ($row['CUR_KNOWPOSITION'] == 15) { $vp_sub_type = 2; $vp_type = 1; }
      if ($row['CUR_KNOWPOSITION'] == 02) { $vp_sub_type = 1; $vp_type = 1; }
      if ($row['CUR_KNOWPOSITION'] == 04) { $vp_sub_type = 1; $vp_type = 3; }


      $res = $db->add_db("SDU_VCHARKARN_POSITION_TAB", array(
                  "EMP_ID" => "$emp_id",
                  "VP_TYPE" => "$vp_type",
                  "VP_SUB_TYPE" => "$vp_sub_type",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);
      if ($res)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }
}

function BIOGRAPHY_PERSON_TO_BIODATA_TAB_AND_CURRENT_ADDRESS_TAB() {
  global $conn, $db;
  $sql = "SELECT DISTINCT * FROM BIOGRAPHY_PERSON ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $person_id = $row['CITIZEN_CODE'];
      $bio_title_th = $row['NAME_PRENAME_THA'];
      $bio_fname_th = $row['FIRST_NAME_THA'];
      $bio_mname_th = $row['MIDDLE_NAME_THA'];
      $bio_lname_th = $row['LAST_NAME_THA'];
      $bio_title_en = $row['NAME_PRENAME_ENG'];
      $bio_fname_en = $row['FIRST_NAME_ENG'];
      $bio_mname_en = $row['MIDDLE_NAME_ENG'];
      $bio_lname_en = $row['LAST_NAME_ENG'];
      $bio_sex = $row['CODE_GENDER'];
      $bio_status = $row['MSTATUS'];
      $bio_birthday = $row['BIRTH_DATE'];
      $bio_blood_group = $row['CODE_BLOOD'];
      $bio_nation1 = $row['CODE_RACE'];
      $bio_nation2 = $row['CODE_NATIONALITY'];
      $bio_religion = $row['CODE_RELIGION'];
      $bio_name_emer = $row['CONTACT_PERSON'];
      $bio_emer_phone = $row['CONTACT_PHONE'];
      $bio_email1 = pea_substr(trim($row['EMAIL']), 80);
      $bio_email2 = pea_substr(trim($row['DUSIT_EMAIL']), 80);
      $bio_mobile_1 = pea_substr(trim($row['MOBILE_PHONE']), 25);
      $bio_h_phone = pea_substr(trim($row['TELEPHONE_1']), 25);


      $res = $db->add_db(TB_BIODATA_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "BIO_TITLE_TH" => "$bio_title_th",
                  "BIO_FNAME_TH" => "$bio_fname_th",
                  "BIO_MNAME_TH" => "$bio_mname_th",
                  "BIO_LNAME_TH" => "$bio_lname_th",
                  "BIO_TITLE_EN" => "$bio_title_en",
                  "BIO_FNAME_EN" => "$bio_fname_en",
                  "BIO_MNAME_EN" => "$bio_mname_en",
                  "BIO_LNAME_EN" => "$bio_lname_en",
                  "BIO_SEX" => "$bio_sex",
                  "BIO_NATION1" => "$bio_nation1",
                  "BIO_NATION2" => "$bio_nation2",
                  "BIO_RELIGION" => "$bio_religion",
                  "BIO_BIRTHDAY" => "TO_DATE('$bio_birthday','YYYY-MM-DD')",
                  "PERSON_ID" => "$person_id",
                  "BIO_STATUS" => "$bio_status",
                  "BIO_BLOOD_GROUP" => "$bio_blood_group",
                  "BIO_H_PHONE" => "$bio_h_phone",
                  "BIO_MOBILE_1" => "$bio_mobile_1",
                  "BIO_EMAIL1" => "$bio_email1",
                  "BIO_EMAIL2" => "$bio_email2",
                  "BIO_NAME_EMER" => "$bio_name_emer",
                  "BIO_EMER_PHONE" => "$bio_emer_phone",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($res)
        echo "row $n BIODATA insert successful <br >";
      else
        echo "row $n BIODATA insert fail <br >";

      $emp_id = $row['CODE_PERSON'];
      $ca_house_no = $row['HOMEADD_2'];
      $ca_moo = $row['MOO_2'];
      $ca_soi = $row['SOI_2'];
      $ca_road = $row['STREET_2'];
      $ca_tumbon = $row['CODE_TUMBON_2'];
      $ca_amphur = $row['CODE_AMPHUR_2'];
      $ca_province = $row['CODE_PROVINCE_2'];
      $ca_post_code = $row['ZIPCODE_2'];

      $res = $db->add_db(TB_CURRENT_ADDRESS_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "CU_HOUSE_NO" => "$ca_house_no",
                  "CU_MOO" => "$ca_moo",
                  "CU_SOI" => "$ca_soi",
                  "CU_ROAD" => "$ca_road",
                  "CU_TUMBON" => "$ca_tumbon",
                  "CU_AMPHUR" => "$ca_amphur",
                  "CU_PROVINCE" => "$ca_province",
                  "CU_POST_CODE" => "$ca_post_code",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($res)
        echo "row $n ADDRESS insert successful <br >";
      else
        echo "row $n ADDRESS insert fail <br >";
    }
  } else {
    echo "fail";
  }
}

function BIOGRAPHY_PERSON_TO_CEN_ADDRESS_TAB() {

  global $conn, $db;
  $sql = "SELECT DISTINCT * FROM BIOGRAPHY_PERSON ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $ca_house_no = $row['HOMEADD_1'];
      $ca_moo = $row['MOO_1'];
      $ca_soi = $row['SOI_1'];
      $ca_road = $row['STREET_1'];
      $ca_tumbon = $row['CODE_TUMBON_1'];
      $ca_amphur = $row['CODE_AMPHUR_1'];
      $ca_province = $row['CODE_PROVINCE_1'];
      $ca_post_code = $row['ZIPCODE_1'];

      $res = $db->add_db("SDU_CEN_ADDRESS_TAB", array(
                  "EMP_ID" => "$emp_id",
                  "CA_HOUSE_NO" => "$ca_house_no",
                  "CA_MOO" => "$ca_moo",
                  "CA_SOI" => "$ca_soi",
                  "CA_ROAD" => "$ca_road",
                  "CA_TUMBON" => "$ca_tumbon",
                  "CA_AMPHUR" => "$ca_amphur",
                  "CA_PROVINCE" => "$ca_province",
                  "CA_POST_CODE" => "$ca_post_code",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($res)
        echo "row $n ADDRESS insert successful <br >";
      else
        echo "row $n ADDRESS insert fail <br >";
    }
  } else {
    echo "fail";
  }
}

function FAMILY_PARENT_TO_FAMILY_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM FAMILY_PARENT WHERE FIRST_NAME_THA_SPOUSE <> '' OR FIRST_NAME_THA_SPOUSE <> 'Null' OR FIRST_NAME_THA_SPOUSE <> 'null' ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $fam_title_th = $row['CODE_PRENAME_SPOUSE'];
      $fam_fname_th = $row['FIRST_NAME_THA_SPOUSE'];
      $fam_lname_th = $row['LAST_NAME_THA_SPOUSE'];
      $fam_code_id = $row['CITIZEN_CODE_SPOUSE'];
      $fam_birthday = $row['BIRTH_DATE_SPOUSE'];
      $fam_alive = $row['CURRENT_STATUS_CODE_SPOUSE'];
      $fam_occupation = $row['OCCUPATION_REMARK_SPOUSE'];
      $fam_work_place = $row['OFFICE_SPOUSE'];
      $fam_phone = $row['PHONE_SPOUSE'];

      $fam_title_th = $row['CODE_PRENAME_SPOUSE'];

      if ($fam_title_th == "นาย")
        $gender = "male";
      elseif ($fam_title_th == "นาง" or $fam_title_th == "น.ส.")
        $gender = "female";
      else
        $gender = "";


      $result = $db->add_db(TB_FAMILY_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "FAM_RELATION" => "3",
                  "FAM_SEX" => "$gender",
                  "FAM_TITLE_TH" => "$fam_title_th",
                  "FAM_FNAME_TH" => "$fam_fname_th",
                  "FAM_LNAME_TH" => "$fam_lname_th",
                  "FAM_CODE_ID" => "$fam_code_id",
                  "FAM_BIRTHDAY" => "TO_DATE('$fam_birthday','YYYY-MM-DD')",
                  "FAM_ALIVE" => "$fam_alive",
                  "FAM_OCCUPATION" => "$fam_occupation",
                  "FAM_WORK_PLACE" => "$fam_work_place",
                  "FAM_MOBILE" => "$fam_phone",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }

  $sql = "SELECT * FROM FAMILY_PARENT WHERE FIRST_NAME_THA_FATHER <> '' OR FIRST_NAME_THA_FATHER <> 'Null' OR FIRST_NAME_THA_FATHER <> 'null' ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $fam_title_th = $row['CODE_PRENAME_FATHER'];
      $fam_fname_th = $row['FIRST_NAME_THA_FATHER'];
      $fam_lname_th = $row['LAST_NAME_THA_FATHER'];
      $fam_code_id = $row['CITIZEN_CODE_FATHER'];
      $fam_birthday = $row['BIRTH_DATE_FATHER'];
      $fam_alive = $row['CURRENT_STATUS_CODE_FATHER'];
      $fam_occupation = $row['OCCUPATION_REMARK_FATHER'];
      $fam_work_place = $row['OFFICE_FATHER'];
      $fam_phone = $row['PHONE_FATHER'];

      $fam_title_th = $row['CODE_PRENAME_FATHER'];

      if ($fam_title_th == "นาย")
        $gender = "male";
      elseif ($fam_title_th == "นาง" or $fam_title_th == "น.ส.")
        $gender = "female";
      else
        $gender = "";


      $result = $db->add_db(TB_FAMILY_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "FAM_RELATION" => "1",
                  "FAM_SEX" => "$gender",
                  "FAM_TITLE_TH" => "$fam_title_th",
                  "FAM_FNAME_TH" => "$fam_fname_th",
                  "FAM_LNAME_TH" => "$fam_lname_th",
                  "FAM_CODE_ID" => "$fam_code_id",
                  "FAM_BIRTHDAY" => "TO_DATE('$fam_birthday','YYYY-MM-DD')",
                  "FAM_ALIVE" => "$fam_alive",
                  "FAM_OCCUPATION" => "$fam_occupation",
                  "FAM_WORK_PLACE" => "$fam_work_place",
                  "FAM_MOBILE" => "$fam_phone",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }

  $sql = "SELECT * FROM FAMILY_PARENT WHERE FIRST_NAME_THA_MOTHER <> '' OR FIRST_NAME_THA_MOTHER <> 'Null' OR FIRST_NAME_THA_MOTHER <> 'null' ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $n++;
      $emp_id = $row['CODE_PERSON'];
      $fam_title_th = $row['CODE_PRENAME_MOTHER'];
      $fam_fname_th = $row['FIRST_NAME_THA_MOTHER'];
      $fam_lname_th = $row['LAST_NAME_THA_MOTHER'];
      $fam_code_id = $row['CITIZEN_CODE_MOTHER'];
      $fam_birthday = $row['BIRTH_DATE_MOTHER'];
      $fam_alive = $row['CURRENT_STATUS_CODE_MOTHER'];
      $fam_occupation = $row['OCCUPATION_REMARK_MOTHER'];
      $fam_work_place = $row['OFFICE_MOTHER'];
      $fam_phone = $row['PHONE_MOTHER'];

      $fam_title_th = $row['CODE_PRENAME_MOTHER'];

      if ($fam_title_th == "นาย")
        $gender = "male";
      elseif ($fam_title_th == "นาง" or $fam_title_th == "น.ส.")
        $gender = "female";
      else
        $gender = "";


      $result = $db->add_db(TB_FAMILY_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "FAM_RELATION" => "2",
                  "FAM_SEX" => "$gender",
                  "FAM_TITLE_TH" => "$fam_title_th",
                  "FAM_FNAME_TH" => "$fam_fname_th",
                  "FAM_LNAME_TH" => "$fam_lname_th",
                  "FAM_CODE_ID" => "$fam_code_id",
                  "FAM_BIRTHDAY" => "TO_DATE('$fam_birthday','YYYY-MM-DD')",
                  "FAM_ALIVE" => "$fam_alive",
                  "FAM_OCCUPATION" => "$fam_occupation",
                  "FAM_WORK_PLACE" => "$fam_work_place",
                  "FAM_MOBILE" => "$fam_phone",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function CURRENTWORK_TO_CURRENT_WORK_TAB() {
  global $conn, $db;
  
    $sql = "TRUNCATE TABLE '".TB_CURRENT_WORK_TAB."'";
  $stid = oci_parse($conn, $sql);
  
  $sql = "SELECT DISTINCT * FROM CURRENTWORK  ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $CWK_MUA_EMP_TYPE = $row['CUR_STAFFTYPE'];
      $CWK_MUA_EMP_SUBTYPE = $row['CUR_SUBSTAFFTYPE'];
      $CWK_MUA_MAIN = $row['CUR_FACULTY'];
      $CWK_MUA_SUBMAIN = $row['CUR_DEPARTMENT_SECTION'];
      $CWK_MUA_WORK_GROUP = $row['CUR_DEPARTMENT_GROUP'];
      $CWK_DSU_EDU_CENTER = $row['CUR_SITE'];
      $CWK_MUA_VPOS = $row['CUR_KNOWPOSITION'];
      $CWK_MUA_LEVEL = $row['CUR_KNOWPOSITIONLEVEL'];

      $CWK_START_WORK_DATE = $row['CUR_DATEIN'];
      $CWK_EDU_GROUP1 = $row['CUR_TEACHSUBJECT'];
      $CWK_MUA_MPOS = $row['ADMIN_POSITION_ID'];
      $CWK_SALARY_TIME_TYPE = $row['TIME_CONTACT_ID'];
      $CWK_PHONE = $row['CUR_INPHONE'];



      $result = $db->add_db(TB_CURRENT_WORK_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "CWK_MUA_EMP_TYPE" => "$CWK_MUA_EMP_TYPE",
                  "CWK_MUA_EMP_SUBTYPE" => "$CWK_MUA_EMP_SUBTYPE",
                  "CWK_MUA_MAIN" => "$CWK_MUA_MAIN",
                  "CWK_MUA_SUBMAIN" => "$CWK_MUA_SUBMAIN",
                  "CWK_MUA_WORK_GROUP" => "$CWK_MUA_WORK_GROUP",
                  "CWK_DSU_EDU_CENTER" => "$CWK_DSU_EDU_CENTER",
                  "CWK_MUA_VPOS" => "$CWK_MUA_VPOS",
                  "CWK_MUA_LEVEL" => "$CWK_MUA_LEVEL",
                  "CWK_START_WORK_DATE" => "$CWK_START_WORK_DATE",
                  "CWK_EDU_GROUP1" => "$CWK_EDU_GROUP1",
                  "CWK_MUA_MPOS" => "$CWK_MUA_MPOS",
                  "CWK_SALARY_TIME_TYPE" => "$CWK_SALARY_TIME_TYPE",
                  "CWK_PHONE" => "$CWK_PHONE",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);

      $n++;
      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function SALARY_MASTER_AND_SALARY_HISTORY_LOG_TO_SALARY_STEP() {
  global $conn, $db;
  $sql = "SELECT * FROM SALARY_MASTER WHERE SALARY_TYPE_ID = 10  ";
  echo "hi";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $SALARY = $row['SALARY_AMOUNT'];
      $SOURCE = $row['SALARY_SOURCE'];
      $n++;


      $result = $db->add_db(TB_REF_SALARY_STEP, array(
                  "REF" => "$n",
                  "EMP_ID" => "$emp_id",
                  "SALARY1" => "$SALARY",
                  "SOURCE1" => "$SOURCE",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
                      ), $conn);



      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }

//  $sql = "SELECT DISTINCT CODE_PERSON,HISTORY_SALARY_AMOUNT,HISTORY_SALARY_SOURCE,HISTORY_SALARY_TYPE_ID
//          FROM SALARY_HISTORY_LOG
//          WHERE HISTORY_SALARY_TYPE_ID = '10'
//          ORDER BY history_salary_amount
//          ";
//  $stid = oci_parse($conn, $sql);
//  if (oci_execute($stid)) {
//
//    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
//      $EMP_ID = $row['CODE_PERSON'];
//      $SOURCE1 = $row['HISTORY_SALARY_SOURCE'];
//      $SALARY1 = $row['HISTORY_SALARY_AMOUNT'];
//      $n++;
//
//      $result = $db->add_db(TB_REF_SALARY_STEP, array(
//                  "REF" => "$n",
//                  "EMP_ID" => "$EMP_ID",
//                  "SOURCE1" => "$SOURCE1",
//                  "SALARY1" => "$SALARY1"
//                      ), $conn);
//
//      if ($result)
//        echo "row $n insert successful <br >";
//      else
//        echo "row $n insert fail <br >";
//    }
//  }else {
//    echo "fail";
//  }
}

function PERSONNEL_STATUS_TO_CURRENT_WORK_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM PERSONNEL_STATUS";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $STA_CODE = $row['STA_CODE'];
      $STA_DATE = $row['STA_DATE'];
      $CWK_QUIT_REASON = $row['STA_NOTE'];
      $n++;



      $result = $db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_STATUS" => "$STA_CODE",
                  "CWK_QUIT_DATE" => "$STA_DATE",
                  "CWK_QUIT_REASON" => "$CWK_QUIT_REASON"
                      ), "EMP_ID='$emp_id'", $conn);




      if ($result)
        echo "row $n update successful <br >";
      else
        echo "row $n update fail <br >";
    }
  }else {
    echo "fail";
  }
}

function SALARY_MASTER_TO_EX_SALARY() {
  global $conn, $db;
  $sql = "SELECT * FROM SALARY_MASTER WHERE SALARY_TYPE_ID <> '10' ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $EX_SALARY_REF = $row['SALARY_TYPE_ID'];
      $EX_SALARY = $row['SALARY_AMOUNT'];
      $EX_SOURCE = $row['SALARY_SOURCE'];
      $n++;



      $result = $db->add_db(TB_EXTRA_SALARY_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "EX_ID" => "$n",
                  "EX_SALARY_REF" => "$EX_SALARY_REF",
                  "EX_SALARY" => "$EX_SALARY",
                  "EX_SOURCE" => "$EX_SOURCE"
                      ), $conn);




      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function ROYAL_DECORATE_DETAIL_AND_ROTAL_DECORATE_TO_ROYAL_TAB() {
  global $conn, $db;

  $sql = "SELECT * FROM ROYAL_DECORATE_DETAIL  ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $RDD_DEC_TYPE = $row['RDD_DEC_TYPE'];
      $ROY_YEAR = substr($row['RDD_DATE_PROMOTE'], 0, 4) + 543;
      list($ROY_NO1, $ROY_NO2) = explode("/", $row['RDD_TITLE']);


      $CWK_DSU_POS = trim($row['CUR_POSITION']);
      $sql2 = "SELECT RD_FULL_NAME,RD_SHORT_NAME FROM ROYAL_DECORATE  WHERE RD_ID = '$RDD_DEC_TYPE'  ";
      $stid2 = oci_parse($conn, $sql2);
      oci_execute($stid2);
      $row2 = oci_fetch_array($stid2, OCI_BOTH);
      $ROY_NAME = $row2['RD_FULL_NAME'] . " (" . $row2['RD_SHORT_NAME'] . ")";
      $n++;

      $result = $db->add_db(TB_ROYAL_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "ROY_ID" => "$n",
                  "ROY_NAME" => "$ROY_NAME",
                  "ROY_YEAR" => "$ROY_YEAR",
                  "ROY_NO1" => "$ROY_NO1",
                  "ROY_NO2" => "$ROY_NO2",
                  "ROY_OWN" => "1"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function PASTWORK_TO_WORK_HISTORY_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM PASTWORK ORDER BY CODE_PASTWORK ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $WRK_WORK_PLACE = $row['OLD_WORKPLACE'];
      $WRK_POSITION = $row['OLD_POSITION'];
      $WRK_DEPART = $row['OLD_DIVISION'];
      $WRK_RESPONSIBILITY = $row['OLD_JOBDESCRIPTION'];
      $WRK_LONG = $row['OLD_PERIOD'];
      $WRK_LOC = $row['OLD_WORKADDRESS'];
      $WRK_PHONE = $row['OLD_WORKTEL'];
      $n++;



      $result = $db->add_db(TB_WORK_HISTORY_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "WRK_ID" => "$n",
                  "WRK_WORK_PLACE" => "$WRK_WORK_PLACE",
                  "WRK_POSITION" => "$WRK_POSITION",
                  "WRK_DEPART" => "$WRK_DEPART",
                  "WRK_RESPONSIBILITY" => "$WRK_RESPONSIBILITY",
                  "WRK_LONG" => "$WRK_LONG",
                  "WRK_LOC" => "$WRK_LOC",
                  "WRK_PHONE" => "$WRK_PHONE"
                      ), $conn);




      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function QUALIFICATION_TO_EDUCATION_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM QUALIFICATION ORDER BY CODE_QUA ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $EDU_LEVEL = $row['QUA_EDU_LEV'];
      $EDU_COUNTRY = $row['QUA_NATION'];
      $EDU_NAME = $row['QUA_NAME'];
      $EDU_NAME_SHORT = $row['QUA_QUA'];
      $EDU_GPA = $row['QUA_GPA'];
      $EDU_DISCIPLINE = $row['QUA_DISCIPLINE'];
      $EDU_YEAR = $row['QUA_YEAR'];
      $EDU_MAJOR = $row['QUA_MAJOR'];
      $EDU_PROGRAM = $row['QUA_PROG_ID'];
      $EDU_FROM = $row['QUA_SCHOOL'];
      $n++;

      $result = $db->add_db(TB_EDUCATION_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "EDU_ID" => "$n",
                  "EDU_LEVEL" => "$EDU_LEVEL",
                  "EDU_COUNTRY" => "$EDU_COUNTRY",
                  "EDU_NAME" => "$EDU_NAME",
                  "EDU_NAME_SHORT" => "$EDU_NAME_SHORT",
                  "EDU_GPA" => "$EDU_GPA",
                  "EDU_DISCIPLINE" => "$EDU_DISCIPLINE",
                  "EDU_YEAR" => "$EDU_YEAR",
                  "EDU_MAJOR" => "$EDU_MAJOR",
                  "EDU_PROGRAM" => "$EDU_PROGRAM",
                  "EDU_FROM" => "$EDU_FROM"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function EXPERT_EXTEND_TO_EXPERT_TAB() {
  global $conn, $db;
  $sql = "SELECT DISTINCT * FROM EXPERT_EXTEND  ORDER BY CODE_PERSON ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $EXP_EXPERT1 = $row['EXPERT_EXTEND'];
      $EXP_EXPERT2 = $row['EXPERT_OTHER'];

      $n++;



      $result = $db->add_db(TB_EXPERT_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "EXP_EXPERT1" => "$EXP_EXPERT1",
                  "EXP_EXPERT2" => "$EXP_EXPERT2"
                      ), $conn);




      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function COMMITTEE_AND_PERSONAL_DEVELOPMENT_TO_SEMINAR_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM COMMITTEE  WHERE CMT_TYPE = '07' OR  CMT_TYPE = '08' OR  CMT_TYPE = '02' OR  CMT_TYPE = '03' OR  CMT_TYPE = '01' OR  CMT_TYPE = '04' OR  CMT_TYPE = '09' OR  CMT_TYPE = '14' ORDER BY CMT_ID ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $SEM_TYPE = $row['CMT_TYPE'];
      $SEM_COURSE_NAME = $row['CMT_COURSE'];
      $SEM_START_DATE = $row['CMT_DATE_START'];
      $SEM_END_DATE = $row['CMT_DATE_END'];
      $SEM_PLACE = $row['CMT_PLACE'];
      $SEM_BENEFIT = $row['CMT_DETAIL'];

      $sql2 = "SELECT * FROM SDU_CURRENT_WORK_TAB  WHERE EMP_ID = '$emp_id' ";
      $stid2 = oci_parse($conn, $sql2);
      oci_execute($stid2);
      $row2 = oci_fetch_array($stid2, OCI_BOTH);

      $SEM_WHO_NAME = get_name($emp_id, TB_BIODATA_TAB);
//$SEM_WHO_POSITION = get_position($row2['CWK_MUA_VPOS'], $row2['CWK_MUA_LEVEL']);
      $SEM_DEPART = $row2['CWK_MUA_MAIN'];

      $n++;

      $result = $db->add_db(TB_SEMINAR_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "ID" => "$n",
                  "SEM_WHO_NAME" => "$SEM_WHO_NAME",
                  "SEM_WHO_POSITION" => "$SEM_WHO_POSITION",
                  "SEM_DEPART" => "$SEM_DEPART",
                  "SEM_TYPE" => "$SEM_TYPE",
                  "SEM_COURSE_NAME" => "$SEM_COURSE_NAME",
                  "SEM_START_DATE" => "$SEM_START_DATE",
                  "SEM_END_DATE" => "$SEM_END_DATE",
                  "SEM_PLACE" => "$SEM_PLACE",
                  "SEM_BENEFIT" => "$SEM_BENEFIT"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }

  $sql = "SELECT * FROM PERSONNEL_DEVELOPMENT WHERE DEV_TYPE NOT IN (05,06,10,11,12,13) ";
  $stid = oci_parse($conn, $sql);

  if (oci_execute($stid)) {

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $SEM_TYPE = $row['DEV_TYPE'];
      $SEM_COURSE_NAME = $row['DEV_COURSE'];
      $SEM_START_DATE = $row['DEV_DATE_START'];
      $SEM_END_DATE = $row['DEV_DATE_END'];
      $SEM_PLACE = $row['DEV_PLACE'];
      $SEM_BENEFIT = $row['DEV_DETAIL'];

      $sql2 = "SELECT * FROM SDU_CURRENT_WORK_TAB  WHERE EMP_ID = '$emp_id' ";
      $stid2 = oci_parse($conn, $sql2);
      oci_execute($stid2);
      $row2 = oci_fetch_array($stid2, OCI_BOTH);

      $SEM_WHO_NAME = get_name($emp_id, TB_BIODATA_TAB);
      $SEM_WHO_POSITION = get_position($row2['CWK_MUA_VPOS'], $row2['CWK_MUA_LEVEL']);
      $SEM_DEPART = $row2['CWK_MUA_MAIN'];
      $n++;

      $result = $db->add_db(TB_SEMINAR_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "ID" => "$n",
                  "SEM_WHO_NAME" => "$SEM_WHO_NAME",
                  "SEM_WHO_POSITION" => "$SEM_WHO_POSITION",
                  "SEM_DEPART" => "$SEM_DEPART",
                  "SEM_TYPE" => "$SEM_TYPE",
                  "SEM_COURSE_NAME" => "$SEM_COURSE_NAME",
                  "SEM_START_DATE" => "$SEM_START_DATE",
                  "SEM_END_DATE" => "$SEM_END_DATE",
                  "SEM_PLACE" => "$SEM_PLACE",
                  "SEM_BENEFIT" => "$SEM_BENEFIT"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function COMMITTEE_TO_CONSULT_COMMIT_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM COMMITTEE  WHERE  CMT_TYPE = '10'   ORDER BY CMT_ID ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $COM_ORDER_NO = $row['CMT_CODE_COMMAND'];
      $COM_COURSE = $row['CMT_COURSE'];
      $COM_TYPE = $row['CMT_TYPE'];
      $COM_START_DATE = $row['CMT_DATE_START'];
      $COM_END_DATE = $row['CMT_DATE_END'];
      $COM_ORG_NAME = $row['CMT_PLACE'];
      $COM_DETAIL = $row['CMT_DETAIL'];


      $n++;

      $result = $db->add_db(TB_CONSULT_COMMIT_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "COM_ID" => "$n",
                  "COM_ORDER_NO" => "$COM_ORDER_NO",
                  "COM_ORG_NAME" => "$COM_ORG_NAME",
                  "COM_COURSE" => "$COM_COURSE",
                  "COM_DETAIL" => "$COM_DETAIL",
                  "COM_TYPE" => "$COM_TYPE",
                  "COM_START_DATE" => "$COM_START_DATE",
                  "COM_END_DATE" => "$COM_END_DATE"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function COMMITTEE_AND_PERSONNEL_DEVELOPMENT_TO_COMMITTEE_TAB() {
  global $conn, $db;
  $sql = "SELECT * FROM COMMITTEE  WHERE  CMT_TYPE IN (11,12,13) ORDER BY CMT_ID ASC";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $COM_ORDER_NO = $row['CMT_CODE_COMMAND'];
      $COM_COURSE = $row['CMT_COURSE'];
      $COM_TYPE = $row['CMT_TYPE'];
      $COM_START_DATE = $row['CMT_DATE_START'];
      $COM_END_DATE = $row['CMT_DATE_END'];
      $COM_ORG_NAME = $row['CMT_PLACE'];
      $COM_DETAIL = $row['CMT_DETAIL'];


      $n++;

      $result = $db->add_db(TB_COMMITTEE_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "COM_ID" => "$n",
                  "COM_ORDER_NO" => "$COM_ORDER_NO",
                  "COM_ORG_NAME" => "$COM_ORG_NAME",
                  "COM_TOPIC" => "$COM_COURSE",
                  "COM_DETAIL" => "$COM_DETAIL",
                  "COM_TYPE" => "$COM_TYPE",
                  "COM_START_DATE" => "$COM_START_DATE",
                  "COM_END_DATE" => "$COM_END_DATE"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }

  $sql = "SELECT * FROM PERSONNEL_DEVELOPMENT WHERE DEV_TYPE IN (11,12,13) ";
  $stid = oci_parse($conn, $sql);

  if (oci_execute($stid)) {

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $emp_id = $row['CODE_PERSON'];
      $COM_TYPE = $row['DEV_TYPE'];
      $COM_COURSE_NAME = $row['DEV_COURSE'];
      $COM_START_DATE = $row['DEV_DATE_START'];
      $COM_END_DATE = $row['DEV_DATE_END'];
      $COM_ORG_NAME = $row['DEV_PLACE'];
      $COM_DETAIL = $row['DEV_DETAIL'];

      $n++;

      $result = $db->add_db(TB_COMMITTEE_TAB, array(
                  "EMP_ID" => "$emp_id",
                  "COM_ID" => "$n",
                  "COM_ORDER_NO" => "$COM_ORDER_NO",
                  "COM_ORG_NAME" => "$COM_ORG_NAME",
                  "COM_TOPIC" => "$COM_COURSE",
                  "COM_DETAIL" => "$COM_DETAIL",
                  "COM_TYPE" => "$COM_TYPE",
                  "COM_START_DATE" => "$COM_START_DATE",
                  "COM_END_DATE" => "$COM_END_DATE"
                      ), $conn);
      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function RES_SCHOLAR_TO_RESEARCH_TAB() {
  global $conn, $db;
  $sql = "SELECT DISTINCT *
          FROM RES_SCHOLAR
          ";
  $stid = oci_parse($conn, $sql);
  echo $stid;
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {

      $EMP_ID = $row['CODE_PERSON'];
      $REC_ID = $row['RES_ID'];
      $REC_TYPE = $row['RES_TYPE'];
      $REC_YEAR = $row['YEAR_STUDY'];
      $REC_NAME = $row['RES_TITLE'];
      $REC_PRICES = $row['RES_BUDGET'];
      $REC_SOURCE = $row['RES_BUDGET_TYPE'];
      $REC_END_DATE = $row['REC_ENDDATE'];
      $REC_START_DATE = $row['REC_START_DATE'];
      $n++;

      $result = $db->add_db(TB_RESEARCH_TAB, array(
                  "EMP_ID" => "$EMP_ID",
                  "REC_ID" => "$REC_ID",
                  "REC_TYPE" => "$REC_TYPE",
                  "REC_YEAR" => "$REC_YEAR",
                  "REC_NAME" => "$REC_NAME",
                  "REC_PRICES" => "$REC_PRICES",
                  "REC_SOURCE" => "$REC_SOURCE",
                  "REC_END_DATE" => "$REC_END_DATE",
                  "REC_START_DATE" => "$REC_START_DATE"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

function SCHOLAR_TO_SCHOLAR_TAB() {
  global $conn, $db;
  $sql = "SELECT DISTINCT *
          FROM SCHOLAR
          ";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    $n = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      $EMP_ID = $row['CODE_PERSON'];
      $SCH_LONG = $row['SCH_TERM'];
      $SCH_UNI = $row['SCH_UNIVERSITY'];
      $SCH_COUNTRY = $row['SCH_COUNTRY'];
      $SCH_MONEY = $row['SCH_BUDGET'];
      $SCH_SOURCE = $row['SCH_BUDGET_TYPE'];
      $SCH_START_DATE = $row['SCH_START_CONTACT_DATE'];
      $SCH_END_DATE = $row['SCH_END_CONTACT_DATE'];
      $SCH_EDU_START_DATE = $row['SCH_STARTDATE'];
      $SCH_MEMO = $row['SCH_NOTE'];
      $n++;

      $result = $db->add_db(TB_SCHOLAR_TAB, array(
                  "SCH_ID" => "$n",
                  "EMP_ID" => "$EMP_ID",
                  "SCH_LONG" => "$SCH_LONG",
                  "SCH_UNI" => "$SCH_UNI",
                  "SCH_COUNTRY" => "$SCH_COUNTRY",
                  "SCH_MONEY" => "$SCH_MONEY",
                  "SCH_SOURCE" => "$SCH_SOURCE",
                  "SCH_START_DATE" => "$SCH_START_DATE",
                  "SCH_END_DATE" => "$SCH_END_DATE",
                  "SCH_EDU_START_DATE" => "$SCH_EDU_START_DATE",
                  "SCH_MEMO" => "$SCH_MEMO"
                      ), $conn);

      if ($result)
        echo "row $n insert successful <br >";
      else
        echo "row $n insert fail <br >";
    }
  }else {
    echo "fail";
  }
}

oci_free_statement($stid);
$db->closedb($conn);
?>