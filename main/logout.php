<?
@session_start();

// DELETE From USER_ONLINE
require_once("../includes/connect2.php");

$sql = "DELETE FROM SDU_USER_ONLINE WHERE USER_NAME = '{$_SESSION['USER_NAME']}' ";
$stmt = oci_parse($conn,$sql);
oci_execute($stmt);
//echo $sql;


$_SESSION["PERSON_ID"] = "";
$_SESSION["USER_TYPE"] = "";
$_SESSION["USER_NAME"] = "";
$_SESSION["MAIN_DEPARTMENT"] = "";
$_SESSION["SUB_DEPARTMENT"] = "";
$_SESSION["report_where"] = "";
$_SESSION["EMP_ID"] = "";
$_SESSION["FNAME_EN"] = "";
$_SESSION["LNAME_EN"] = "";
$_SESSION["PIC_FILE"] = "";
$_SESSION["watching"] = "";

$_SESSION["PERSON_ID_ADMIN"] = "";
$_SESSION["EMP_ID_ADMIN"] = ""; 
$_SESSION["FNAME_TH_ADMIN"] = "";
$_SESSION["LNAME_TH_ADMIN"] = "";
$_SESSION["FNAME_EN_ADMIN"] = "";
$_SESSION["LNAME_EN_ADMIN"] = "";

$_SESSION["STATUS"] = "";


unset($_SESSION["PERSON_ID"]);
unset($_SESSION["USER_TYPE"]);
unset($_SESSION["USER_NAME"]);
unset($_SESSION["MAIN_DEPARTMENT"]);
unset($_SESSION["SUB_DEPARTMENT"]);
unset($_SESSION["report_where"]);
unset($_SESSION["EMP_ID"]);
unset($_SESSION["FNAME_EN"]);
unset($_SESSION["LNAME_EN"]);
unset($_SESSION["PIC_FILE"]);

unset($_SESSION["PERSON_ID_ADMIN"]);
unset($_SESSION["EMP_ID_ADMIN"]);
unset($_SESSION["FNAME_TH_ADMIN"]);
unset($_SESSION["LNAME_TH_ADMIN"]);
unset($_SESSION["FNAME_EN_ADMIN"]);
unset($_SESSION["LNAME_EN_ADMIN"]);
unset($_SESSION["watching"]);

unset($_SESSION["STATUS"]);

session_destroy();

header("Location: ../");


?>