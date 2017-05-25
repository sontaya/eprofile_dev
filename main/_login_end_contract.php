<?
@session_start();
$fpath = "../";
require_once($fpath."includes/connect.php");
/*echo " 60 years date = ";
echo $date_to_reach_60 = date("Y-m-d",strtotime("1951-01-02 + 60 year"));
echo "<br>";
echo "Today = ";
echo $today = date("Y-m-d");
echo "<br>";
echo "Count day before expire ";
echo $c = getdays($today,$date_to_reach_60);
echo "<br>";
if($c < 61){
	echo "Closing to expire";
}
echo "<br>";
echo "<br>";*/
if($_SESSION["USER_TYPE"] == "admin"){
 $n1 = 0;
 $today = date("Y-m-d");
 $sql = "SELECT * FROM  ".TB_CONTRACT_TAB." WHERE CONTRACT_EXPIRED = '0' ";
 $stid = oci_parse($conn, $sql );
	oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_BOTH))) {
			 
			 $date_to_reach_60 = date("Y-m-d",strtotime(date2_formatdb(get_birthday($row['EMP_ID'],TB_BIODATA_TAB))." + 60 year"));
			 if($row['CONTRACT_M60'] == '0'){ // contract not more than 60 year
				  if( change_to_timestamp1($row['CONTRACT_FINISH']) > change_to_timestamp1($date_to_reach_60) ){ //"Contract Expired Date" more than "60 Years Date"
						$c = getdays($today,$date_to_reach_60);
							if($c < 61){//Closing to expire
								$n1++;
							}
					 }else{
						 if(getdays(date("Y-m-d"),$row['CONTRACT_FINISH']) < 61) {
							$n1++;
						}
					 }
				}//end  if($row['CONTRACT_M60'] == '0')
				elseif($row['CONTRACT_M60'] == '1'){//contract more than 60 only
					if(getdays(date("Y-m-d"),$row['CONTRACT_FINISH']) < 61) {//expired contract By Expired Date only
						$n1++;
					}
				}//end if($row['CONTRACT_M60'] == '1')
			
		}///end while
	echo $n1;
}// end session 

$db->closedb($conn);
?>