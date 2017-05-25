<?
include("./../includes/config.inc.php");
include("./../includes/connect.php");

$sql="SELECT * FROM SDU_REF_EXTRA_SALARY";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
	$salary_type[$dbarr["ID"]]=$dbarr["NAME"];
}



$emp=$_GET["emp"];
$sql3="SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM ";
$sql3.=" SDU_BIODATA_TAB INNER JOIN RSDUHR.VSALARY ON SDU_BIODATA_TAB.PERSON_ID=RSDUHR.VSALARY.ID_CARD "; 
$sql3.=" INNER JOIN SDU_CURRENT_WORK_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID=SDU_BIODATA_TAB.EMP_ID ";
$sql3.=" INNER JOIN SDU_SALARY_STEP ON SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND  SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND SDU_BIODATA_TAB.EMP_ID ='".$emp."' ORDER BY SDU_SALARY_STEP.REF DESC";

$stid = @oci_parse($conn, $sql3 );
@oci_execute($stid);
$dbarr = @oci_fetch_array($stid, OCI_BOTH);

?>
<div style="font-size:12px;">
<table style="font-size:12px;">
	<tr>
    	<td align="right">รหัสบุคคลกร : </td><td><?=$dbarr["EMP_ID"]?></td>
    </tr>
    <tr>
		<td align="right">หมายเลขบัตรประชาชน : </td><td><?=$dbarr["PERSON_ID"]?></td>
    </tr>
     <tr>
		<td align="right">ชื่อ-นามสกุล : </td><td><?=$dbarr["BIO_FNAME_TH"]?>  <?=$dbarr["BIO_LNAME_TH"]?></td>
    </tr>
    <tr>
		<td align="right">เงินเดือน : </td><td><?=number_format($dbarr["SALARY1"]+$dbarr["SALARY2"]+$dbarr["SALARY3"],2)?> บาท</td>
    </tr>
    <tr valign="top">
		<td align="right">เงินอื่นๆ : </td><td>
        		<table style="font-size:12px;">
                <?
					$sql="SELECT * FROM SDU_EX_SALARY WHERE EMP_ID='".$dbarr["EMP_ID"]."' AND EX_SALARY_REF!='10'";
					$stid = @oci_parse($conn, $sql );
					@oci_execute($stid);
					while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
					
				?>
                	<tr>
                    	<td><?=$salary_type[$dbarr["EX_SALARY_REF"]]?></td>
                        <td><?=number_format($dbarr["EX_SALARY"],2)?> บาท</td>
                    </tr>
                <? } ?>
                </table>
        </td>
    </tr>
</table>


</div>