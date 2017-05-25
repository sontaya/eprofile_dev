<?
@session_start();
$fpath = "../";
require_once($fpath."includes/connect.php");
if($_SESSION["USER_TYPE"] == "admin"){
	
 $sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  AND (CWK_MUA_EMP_TYPE = '1' OR CWK_MUA_EMP_TYPE = '4') ";
 $stid = oci_parse($conn, $sql );
	oci_execute($stid);
		
		$n1 = 0;
		while (($row = oci_fetch_array($stid, OCI_BOTH))) {

			list($year1,$month1,$day1) = explode("-",$row['CWK_RETIRE_DATE']);
			list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
			
			if($row['CWK_STATUS'] != '02' and $row['CWK_STATUS'] != '04' and $row['CWK_STATUS'] != '07'){
				$d =  (date("Y")+543) - $year2;
					if($d > 60){
						$n1++;
					}
					else if($d == 60) {
						if(($month2+0) < 10){
							$n1++;
						}
					}
				}

	}
	
	echo $n1;
}
$db->closedb($conn);
?>