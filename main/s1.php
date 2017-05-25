<?
include("./includes/config.inc.php");
include("./includes/connect.php");
/*
define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
/*
$sql="SELECT * FROM RSDUHR.VSALARY";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
	print ">>".$dbarr["ID_CARD"]."<br>";
}
*/
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
<form method="post" action="">
<table style="font-size:12px;">
	<tr>
    	<td align="right">ชื่อ :</td>
        <td><input type="text" id="name" name="name"  style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">นามสกุล :</td>
        <td><input type="text" id="name" name="last_name"  style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">หมายเลขพนักงาน :</td>
        <td><input type="text" id="emp_id" name="emp_id" style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">หมายเลขประชาชน :</td>
        <td><input type="text" id="id_card" name="id_card" style="width:150px;" /></td>
    </tr>
    <!--<tr>
    	<td align="right">ฝ่าย :</td>
        <td><input type="text" id="party" name="party" readonly="readonly" style="width:150px;" /> <input type="button" value="ค้นหาฝ่าย" /></td>
    </tr>
    -->
    <tr>
        <td align="right" class="form_text">ประเภทบุคลากร  :</td>
        <td align="left">
        <select name="emp_type" id="emp_type">
        <option value="">ทุกประเภท</option>
        <?php
			$sql = "SELECT STAFFTYPE_ID, STAFFTYPE_NAME ";
			$sql .= "FROM ".TB_REF_STAFFTYPE." ";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rc = oci_fetch_array($stdt)) {
		?>
        <option value="<?php echo $rc['STAFFTYPE_ID']; ?>"><?php echo $rc['STAFFTYPE_NAME']; ?></option>
        <?php
			}
		?>
        </select>
        
        </td>
      </tr>
     <tr>
    	<td align="right"></td>
        <td><input type="submit" value="ค้นหา" /></td>
    </tr>
</table>
</form>
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
//$sql2="SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM SDU_BIODATA_TAB,SDU_CURRENT_WORK_TAB,RSDUHR.VSALARY,SDU_SALARY_STEP WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." GROUP BY SDU_BIODATA_TAB.EMP_ID ";

$sql3="SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM ";
$sql3.=" SDU_BIODATA_TAB INNER JOIN RSDUHR.VSALARY ON SDU_BIODATA_TAB.PERSON_ID=RSDUHR.VSALARY.ID_CARD "; 
$sql3.=" INNER JOIN SDU_CURRENT_WORK_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID=SDU_BIODATA_TAB.EMP_ID ";
$sql3.=" INNER JOIN SDU_SALARY_STEP ON SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND  SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." ORDER BY SDU_SALARY_STEP.REF DESC";

//SDU_CURRENT_WORK_TAB,RSDUHR.VSALARY,SDU_SALARY_STEP WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." GROUP BY SDU_BIODATA_TAB.EMP_ID ";
//print $sql3;

//print $sql3;

$stid = @oci_parse($conn, $sql3 );
@oci_execute($stid);

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
                	<td colspan="4">e-profile</td>
                    <td colspan="5">e-salary</td>
                </tr>
            	<tr align="center" style="font-weight:bold;">
                	<td width="50">ลำดับที่</td>
            		<td width="150">หมายเลขประชาชน</td>
                    <td width="150">ชื่อ-นามสกุล</td>
                    <td width="150">เงินเดือน</td>
                   
            		<td width="150">หมายเลขประชาชน</td>
                    <td width="150">ชื่อ-นามสกุล</td>
                    <td width="150">หมายเลขบัญชี</td>
                    <td width="150">เงินเดือน</td>
                    <td width="150">ผลต่าง</td>
            	</tr>
           <?  
		   		while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){ 
					$salary1=$dbarr["SALARY1"]+$dbarr["SALARY2"]+$dbarr["SALARY3"];
					$total=$salary1-$dbarr["SALARY"];
					
					$sum_salary_ep=$salary1+$sum_salary_ep;
					$sum_salary_es=$dbarr["SALARY"]+$sum_salary_es;
		   ?>
                <tr>
                	<td width="50" align="center"><?=$i?></td>
            		<td width="150"><?=$dbarr["PERSON_ID"]?></td>
                    <td width="150"><?=$dbarr["BIO_FNAME_TH"]?> <?=$dbarr["BIO_LNAME_TH"]?></td>
                    <td width="150" align="right"><?=number_format($salary1,2)?></td>
                   
            		<td width="150"><?=$dbarr["PERSON_ID"]?></td>
                    <td width="150"><?=$dbarr["BIO_FNAME_TH"]?> <?=$dbarr["BIO_LNAME_TH"]?></td>
                    <td width="150"><?=$dbarr["ACCOUNT_NO"]?></td>
                    <td width="150" align="right"><?=number_format($dbarr["SALARY"],2)?></td>
                    <td width="150" align="right"><?=number_format($total,2)?></td>
            	</tr>
            <? $i++; } ?>  
            	<tr>
                	<td colspan="3" align="center" style=" font-weight:bold">รวม</td>
                    <td align="right"><?=number_format($sum_salary_ep,2)?></td>
                    <td colspan="3" align="center" style=" font-weight:bold">รวม</td>
                    <td align="right"><?=number_format($sum_salary_es,2)?></td>
                    <td align="right"><?=number_format(($sum_salary_ep-$sum_salary_es),2)?></td>
                </tr>
            </table>
            
        </td>
	</tr>
</table>
</center>