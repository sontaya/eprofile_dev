<?
@session_start();
$last_update = date("Y-m-d");
if($_SESSION["USER_TYPE"] == "admin"){
	$update_by = $_SESSION["EMP_ID_ADMIN"]."[".$_SESSION["FNAME_TH_ADMIN"]." ".$_SESSION["LNAME_TH_ADMIN"]."]"."[".$_SESSION["USER_TYPE"]."]";
}else{
	$update_by = $_SESSION["EMP_ID"]."[".$_SESSION["FNAME_TH"]." ".$_SESSION["LNAME_TH"]."]"."[".$_SESSION["USER_TYPE"]."]";
}
$update_user = $_SESSION["USER_NAME"];
?>