<?
@session_start();
include("request_class.php");


define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)

$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$request=new request();
$request->conn=$conn ;
$action=$_POST["action"];
if($action=="save"){
	$arr=array(
		"emp_id"=>$_SESSION["EMP_ID"],
		"request"=>$_POST["request"],
		"comment"=>$_POST["comment"],
		"type"=>$_POST["re_type"]
	);
	//print_r($arr);
	if($arr["emp_id"]!=""){
		$insert=$request->insert_request($arr);
		print $insert;
	}
}

if($action=="data"){
	$arr=array(
		"emp_id"=>"",
		"request"=>"",
		"comment"=>""
	);
	$data=$request->data_request($arr);
}

if($action=="update"){
	$arr=array(
		"re_id"=>$_POST["re_id"],
		"type"=>$_POST["ch_type"]
	);
	$data=$request->update_request($arr);
	print $data;
}
//$data=$request->data_request($arr);

//print_r($data);

?>