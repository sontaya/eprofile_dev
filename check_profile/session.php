<?
session_start();
$_SESSION["EMP_ID"] = $_REQUEST["emp_id"];
echo "<script>window.location='index.php';</script>";
?>