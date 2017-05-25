<?

header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=new_personnel_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");

include("./../includes/config.inc.php");
include("./../includes/connect.php");
ini_set('display_errors', '0');
function salary_old($emp_id){
	$sql="SELECT * FROM SDU_SALARY_STEP WHERE EMP_ID='".$emp_id."' ORDER BY REF ";
	$stid = @oci_parse($conn, $sql );
	@oci_execute($stid);
	$i=1;
	while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){ 
		if($i<=2){
			$salary=$dbarr["SALARY1"]+$dbarr["SALARY2"]+$dbarr["SALARY3"];
		}
		$i++;
	}
	
	return $salary;
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
<?

$name=$_POST["name"];
$last_name=$_POST["last_name"];
$emp_id=$_POST["emp_id"];
$id_card=$_POST["id_card"];
$emp_type=$_POST["emp_type"];
if($_POST["name"]!=""){
	$sql_where[]=" SDU_BIODATA_TAB.BIO_FNAME_TH LIKE '%".$name."%'  "; 
}

if($_POST["last_name"]!=""){
	$sql_where[]=" SDU_BIODATA_TAB.BIO_LNAME_TH LIKE '%".$last_name."%' ";
}

if($_POST["emp_id"]!=""){
	$sql_where[]=" SDU_BIODATA_TAB.EMP_ID LIKE '%".$emp_id."%' "; 
}

if($_POST["id_card"]!=""){
	$sql_where[]=" SDU_BIODATA_TAB.PERSON_ID LIKE '%".$id_card."%' "; 
}

if($_POST["emp_type"]!=""){
	$sql_where[]=" SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE LIKE '%{$emp_type}%' ";
}

$c=0;
foreach($sql_where as $value){
	if($c>0){
		$sql2.=" AND ";
	}
	$sql2.=$value;
	$c++;
}

$sql3="SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM ";
$sql3.=" SDU_BIODATA_TAB INNER JOIN RSDUHR.VSALARY ON SDU_BIODATA_TAB.PERSON_ID=RSDUHR.VSALARY.ID_CARD "; 
$sql3.=" INNER JOIN SDU_CURRENT_WORK_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID=SDU_BIODATA_TAB.EMP_ID ";
$sql3.=" INNER JOIN SDU_SALARY_STEP ON SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND  SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." ORDER BY SDU_SALARY_STEP.REF DESC";
//print $sql3;

$stid = @oci_parse($conn, $sql3 );
@oci_execute($stid);

while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){ 
	$emp_arr[]=$dbarr["EMP_ID"];
	$data[$dbarr["EMP_ID"]]["PERSON_ID"]=$dbarr["PERSON_ID"];
	$data[$dbarr["EMP_ID"]]["name"]=$dbarr["BIO_FNAME_TH"];
	$data[$dbarr["EMP_ID"]]["lastname"]=$dbarr["BIO_LNAME_TH"];
	$data[$dbarr["EMP_ID"]]["salary"]=$dbarr["SALARY1"]+$dbarr["SALARY2"]+$dbarr["SALARY3"];
	$data[$dbarr["EMP_ID"]]["salary_old"]=salary_old($dbarr["EMP_ID"]);
	$data[$dbarr["EMP_ID"]]["total"]=$data[$dbarr["EMP_ID"]]["salary"]-$data[$dbarr["EMP_ID"]]["salary_old"];
}

/*
while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
	print "vv";
	$person_id[]=$dbarr["PERSON_ID"];
}
*/
$i=1;
?>

<table width="950">
	<tr align="center"  valign="top">
		<td> 
			
            <table border="1" style="font-size:12px;" cellspacing="0">
            	<tr align="center" style="font-weight:bold;">
                	<td width="50">ลำดับที่</td>
            		<td width="150">หมายเลขประชาชน</td>
                    <td width="150">ชื่อ-นามสกุล</td>
                    <td width="150">เงินเดือนใหม่</td>
                    <td width="150">เงินเดือนเดิม</td>
                    <td width="150">ผลต่าง</td>
            	</tr>
           <?  
		   		foreach($emp_arr as $value){ 
					
		   ?>
               <tr >
                	<td width="50" align="center"><?=$i?></td>
            		<td width="150"><?=$data[$value]["PERSON_ID"]?></td>
                    <td width="150"><?=$data[$value]["name"]?> <?=$data[$value]["lastname"]?></td>
                    <td width="150" align="right"><?=number_format($data[$value]["salary"],2)?>่</td>
                    <td width="150" align="right"><?=number_format($data[$value]["salary_old"],2)?></td>
                    <td width="150" align="right"><?=number_format($data[$value]["total"],2)?></td>
            	</tr>
            <? $i++; } ?>  
            	
            </table>
            
        </td>
	</tr>
</table>
</center>