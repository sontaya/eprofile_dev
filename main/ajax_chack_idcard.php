<?
$fpath = '../';
require_once($fpath."includes/connect.php");
$idcard=$_POST["idcard"];
//print $idcard;

$sql = "SELECT ".TB_BIODATA_TAB.".* , ".TB_CURRENT_WORK_TAB.".* FROM  ".TB_BIODATA_TAB." LEFT JOIN ".TB_CURRENT_WORK_TAB." ON ".TB_BIODATA_TAB.".EMP_ID = ".TB_CURRENT_WORK_TAB.".EMP_ID  WHERE ".TB_BIODATA_TAB.".PERSON_ID = '".$idcard."'"; 

$query = oci_parse($conn, $sql);
oci_execute($query);
$i=1;
while($row = oci_fetch_array($query, OCI_BOTH)){
	if($row["CWK_STATUS"]!="02"){
		$i++;
	}
}
print $i;
$db->closedb($conn);
?>