<? 


	$db_user = "root";
	$db_pass = "";
	$db_name = "dusitpoll_tap";
	$db_host = "localhost";


	$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Connection error " . mysqli_error($link));
  $conn->set_charset("utf8");

  ini_set('error_reporting', E_ERROR);

  $CONFIG_ROOT_URL = "http://demo.local.com/DusitPoll-TAP/";

?>