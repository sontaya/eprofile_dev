<?

@session_start();
$sess_id = session_id();
$user_name = $_GET["user_name"];
//$pass_word = md5(trim($_POST["pass_word"]));
$pass_word = $_GET["pass_word"];
$fpath = '';
require_once($fpath . "includes/connect.php");
require_once("includes/ldap_authen.inc.php");

// DELETE SESSION
$ts = mktime();
$user_ip = $_SERVER['REMOTE_ADDR'];

$ts_over = $ts - 3000;
$sql = "DELETE FROM SDU_USER_ONLINE WHERE USER_LOGINTIME < {$ts_over} ";
$result = oci_parse($conn, $sql);
oci_execute($result);
//echo $user_name;
$ldap = ldap_authenticate($user_name, $pass_word);

//echo "{$ldap}";
if ($ldap != "null") {
  //echo "<p>not null</p>";
// Insert USER_ONLINE table to check duplicate user
  $sql = "SELECT USER_NAME, USER_SESSION, USER_LOGINTIME,USER_IP ";
  $sql .= "FROM SDU_USER_ONLINE ";
  $sql .= "WHERE USER_NAME = '{$user_name}' ";

  //echo "<p>Conn : {$conn}</p>";

  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
  $num_rows = 0;
  while (oci_fetch($stmt)) {
    $num_rows++;
  }

  $num_rows = 0;

  if ($num_rows > 0) {
    // มี session ของ User นี้ กำลัง Online อยู่ในระบบ
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $user_name กำลังอยู่ในระบบ ";
  } else {

    $person_id = ldap_getcitizenid($user_name);
//	echo $person_id;
    //echo $person_id."<br>";
    $sql = "SELECT EMP_ID FROM  " . TB_BIODATA_TAB . " WHERE PERSON_ID = '" . $person_id . "' ";
	$sql = "SELECT  ".TB_BIODATA_TAB.".EMP_ID FROM  ".TB_BIODATA_TAB." LEFT JOIN ".TB_CURRENT_WORK_TAB." ON ".TB_BIODATA_TAB.".EMP_ID = ".TB_CURRENT_WORK_TAB.".EMP_ID WHERE ".TB_BIODATA_TAB.".PERSON_ID = '" . $person_id . "' AND  ".TB_CURRENT_WORK_TAB.".CWK_STATUS<>'02'";
//	echo $sql;
    $row = $db->fetch($sql, $conn);
    $emp_id = $row['EMP_ID'];
//     echo $emp_id."<br>";
// /สองบรรทัดล่างนี้ใส่ ldap แล้ว
    $sql = "SELECT * FROM  " . TB_USER_TAB . " WHERE USERNAME = '{$user_name}' ";
	
//	echo $sql;

    $row = $db->fetch($sql, $conn);


    if ($row["USER_TYPE"] == 'chief' || $row["USER_TYPE"] == 'admin' || $row["USER_TYPE"] == 'hr')
      $_SESSION["USER_TYPE"] = $row["USER_TYPE"];
    elseif ($row["USER_TYPE"] == "") {
      $_SESSION["USER_TYPE"] = "user";
    }


    // เอามาจาก table biodata_tab
    $_SESSION["EMP_ID"] = $emp_id;
    $_SESSION['USER_EMP_ID'] = $emp_id;
    $_SESSION["USER_NAME"] = $user_name;
    //$_SESSION['MAIN_DEPARTMENT'] = $row["MAIN_DEPARTMENT"];
    //$_SESSION['SUB_DEPARTMENT'] = $row["SUB_DEPARTMENT"];
    $_SESSION["MAIN_DEPARTMENT"] = $MAIN_DEPARTMENT;
    $_SESSION["SUB_DEPARTMENT"] = $SUB_DEPARTMENT;

    $_SESSION["watching"] = $user_name;

    $_SESSION["report_where"] = "";
    if ($_SESSION["USER_TYPE"] == "chief") {
      if ($row["MAIN_DEPARTMENT"] != "" and $row["SUB_DEPARTMENT"] == "") {
        $_SESSION["report_where"] .= " CWK_MUA_MAIN = '" . $MAIN_DEPARTMENT . "' AND";
      } elseif ($row["SUB_DEPARTMENT"] != "" and $row["MAIN_DEPARTMENT"] != "") {
        $_SESSION["report_where"] .= " CWK_MUA_MAIN = '" . $MAIN_DEPARTMENT . "' AND CWK_MUA_SUBMAIN = '" . $SUB_DEPARTMENT . "' AND";
      }
    }

    sleep(1);
    $sql = "SELECT * FROM  " . TB_BIODATA_TAB . " WHERE EMP_ID = '" . $_SESSION["EMP_ID"] . "' ";
//	echo $sql;
    $row = $db->fetch($sql, $conn);

    $_SESSION["PERSON_ID"] = $row["PERSON_ID"];
    $_SESSION["FNAME_TH"] = $row["BIO_FNAME_TH"];
    $_SESSION["LNAME_TH"] = $row["BIO_LNAME_TH"];
    $_SESSION["FNAME_EN"] = $row["BIO_FNAME_EN"];
    $_SESSION["LNAME_EN"] = $row["BIO_LNAME_EN"];
    $_SESSION["PIC_FILE"] = $row["BIO_PIC_FILE"];

    $sql = "SELECT * FROM  " . TB_CURRENT_WORK_TAB . " WHERE EMP_ID = '" . $_SESSION["EMP_ID"] . "' ";
    $row = $db->fetch($sql, $conn);
    switch ($row["CWK_STATUS"]) {
      case "01": $txt = "ปฏิบัติการ"; break;
      case "02": $txt = "ลาออก"; break;
      case "03": $txt = "ลาศึกษาต่อ"; break;
      case "04": $txt = "เกษียนอายุ"; break;
      case "05": $txt = "ปฏิบัติการตามวาระ"; break;
      case "07": $txt = "เสียชีวิต"; break;
      case "08": $txt = "ไม่ได้ใช่งานแล้ว"; break;
      default: $txt = "ปฏิบัติการ";
    }
    $_SESSION["STATUS"] = $txt;
    $_SESSION['CWK_MUA_MAIN'] = $row["CWK_MUA_MAIN"];
    $_SESSION['CWK_MUA_SUBMAIN'] = $row["CWK_MUA_SUBMAIN"];
    $_SESSION['CWK_MUA_MPOS'] = $row['CWK_MUA_MPOS'];

    if ($_SESSION["USER_TYPE"] == "admin" or $_SESSION["USER_TYPE"] == "hr" or $_SESSION["USER_TYPE"] == "chief") {
      $_SESSION["PERSON_ID_ADMIN"] = $row["PERSON_ID"];
      $_SESSION["EMP_ID_ADMIN"] = $row["EMP_ID"];
      $_SESSION["FNAME_TH_ADMIN"] = $row["BIO_FNAME_TH"];
      $_SESSION["LNAME_TH_ADMIN"] = $row["BIO_LNAME_TH"];
      $_SESSION["FNAME_EN_ADMIN"] = $row["BIO_FNAME_EN"];
      $_SESSION["LNAME_EN_ADMIN"] = $row["BIO_LNAME_EN"];
    }
    $sql = "SELECT * FROM  " . TB_CONTRACT_TAB . " WHERE CONTRACT_EXPIRED = '0' ";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
      if (change_to_timestamp1(date("Y-m-d")) >= change_to_timestamp1($row['CONTRACT_FINISH'])) {// check contract expired
        $db->update_db(TB_CONTRACT_TAB, array(
            "CONTRACT_EXPIRED" => "1"
                ), " CONTRACT_EXPIRED = '0' ", $conn);
      }
    }



    $sql = "INSERT INTO SDU_USER_ONLINE (USER_NAME, USER_SESSION, USER_LOGINTIME, USER_IP) ";
    $sql .= "VALUES ('{$_SESSION['USER_NAME']}','{$sess_id}','{$ts}','{$user_ip}') ";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
     echo "1";
  }
} // ldap_authenticate()
else {
  echo "0";
}
$db->closedb($conn);
?>