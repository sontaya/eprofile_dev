<? 
session_start();
if(empty($_SESSION['idcode'])){
  header("location: http://demo.local.com/DusitPoll-TAP/login.php");
  exit();
} 
?>