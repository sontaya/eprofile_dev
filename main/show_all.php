<?
@session_start();
//print_r($_SESSION);
//$_SESSION['USER_TYPE']="admin";
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
  <?
}

$fpath = '../';
require_once($fpath . "includes/connect.php");

$year=$_POST["year"]-543;
	$sql_admin="SELECT * FROM SDU_ADMIN_DEPARTMENT WHERE EMP_ID='$_SESSION[EMP_ID]'";
	$stid = oci_parse($conn, $sql_admin);
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
if($row["CODE_FACULTY"] == '01' || $row["CODE_FACULTY"] == '02' || $row["CODE_FACULTY"] == '05' || $_SESSION["USER_TYPE"]=='admin'){
	$sql="SELECT
    *
FROM
    (SELECT
        SBT.EMP_ID, 
        SBT.BIO_TITLE_TH, 
        SBT.BIO_FNAME_TH, 
        SBT.BIO_LNAME_TH, 
        SRD.NAME_FACULTY,
        SRSE.STATUS_NAME,
        SRDS.CHOOSE_PERIOD_SECTION,
        MIN(TO_CHAR(TS.TS_STAMP_DATETIME,'HH24:MI')) OVER(PARTITION BY TS_CODE_PERSON ORDER BY TS_STAMP_DATETIME RANGE UNBOUNDED PRECEDING) AS MIN_TIME,
        TL.LEAVETYPE_NAME
    FROM
        SDPERSON.SDU_BIODATA_TAB sbt,
        SDPERSON.SDU_CURRENT_WORK_TAB scwt,
        SDPERSON.SDU_REF_DEPARTMENT srd,
        SDPERSON.SDU_REF_DEPARTMENT_SUB srds,
        SDPERSON.SDU_REF_STATUS_EXT srse,
        SDPERSON.TIME_STAMPLOG ts,
        SDPERSON.TIME_LEAVETYPE tl
    WHERE
        SBT.EMP_ID = SCWT.EMP_ID AND
        SCWT.CWK_MUA_MAIN = SRD.CODE_FACULTY AND
        SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
        SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+) AND
        SCWT.CWK_STATUS = SRSE.STATUS_ID AND
        SRSE.STATUS_ID in ('01', '03', '05') AND
        TS.TS_CODE_PERSON = SUBSTR(SBT.EMP_ID,0,4)||'0'||substr(SBT.EMP_ID,-3,3)||'45' AND
        TO_CHAR(TS.TS_STAMP_DATETIME,'DD/MM/YYYY') = '$_POST[day]/$_POST[month]/$year' AND
        TS.TS_TYPE = TL.LEAVETYPE_ID (+))
GROUP BY
    EMP_ID, 
    BIO_TITLE_TH, 
    BIO_FNAME_TH, 
    BIO_LNAME_TH, 
    STATUS_NAME,
    NAME_FACULTY,
    CHOOSE_PERIOD_SECTION,
    MIN_TIME,
    LEAVETYPE_NAME
ORDER BY
    MIN_TIME,
	EMP_ID
";
		$stid = oci_parse($conn, $sql);
	    oci_execute($stid);
?>
<table width="90%" align="center">
<?
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
	<tr>
    	<td><a href="#" onClick="search_person('<?=$row["EMP_ID"]?>')"><?=$row["EMP_ID"]?></a></td>
    	<td><?=$row["BIO_TITLE_TH"]?> <?=$row["BIO_FNAME_TH"]?> <?=$row["BIO_LNAME_TH"]?></td>
    	<td><?=$row["STATUS_NAME"]?></td>
    	<td><?=$row["NAME_FACULTY"]?></td>
<?
		$t=strtotime($row["MIN_TIME"]);
		$t1=strtotime("08:00");
		$t2=strtotime("08:30");
		$t3=strtotime("09:00");
		switch($row["CHOOSE_PREIOD_SECTION"]){
			case '1': if(date("H:i",$t)>date("H:i",$t1)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '2': if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '3': if(date("H:i",$t)>date("H:i",$t3)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			default : if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
		}
?>    	<td>&nbsp;<?=$row["LEAVETYPE_NAME"]?></td>
    </tr>
<?
	}
?>
</table>
<?
}elseif($row["CODE_FACULTY"] == '03'){
	$sql="SELECT
    *
FROM
    (SELECT
        SBT.EMP_ID, 
        SBT.BIO_TITLE_TH, 
        SBT.BIO_FNAME_TH, 
        SBT.BIO_LNAME_TH, 
        SRD.NAME_FACULTY,
        SRSE.STATUS_NAME,
        SRDS.CHOOSE_PERIOD_SECTION,
        MIN(TO_CHAR(TS.TS_STAMP_DATETIME,'HH24:MI')) OVER(PARTITION BY TS_CODE_PERSON ORDER BY TS_STAMP_DATETIME RANGE UNBOUNDED PRECEDING) AS MIN_TIME,
        TL.LEAVETYPE_NAME
    FROM
        SDPERSON.SDU_BIODATA_TAB sbt,
        SDPERSON.SDU_CURRENT_WORK_TAB scwt,
        SDPERSON.SDU_REF_DEPARTMENT srd,
        SDPERSON.SDU_REF_DEPARTMENT_SUB srds,
        SDPERSON.SDU_REF_STATUS_EXT srse,
        SDPERSON.TIME_STAMPLOG ts,
        SDPERSON.TIME_LEAVETYPE tl
    WHERE
        SBT.EMP_ID = SCWT.EMP_ID AND
		SCWT.CWK_MUA_MAIN = '$row[CODE_FACULTY]' AND
        SCWT.CWK_MUA_MAIN = SRD.CODE_FACULTY AND
        SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
        SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+) AND
        SCWT.CWK_STATUS = SRSE.STATUS_ID AND
        SRSE.STATUS_ID in ('01', '03', '05') AND
        TS.TS_CODE_PERSON = SUBSTR(SBT.EMP_ID,0,4)||'0'||substr(SBT.EMP_ID,-3,3)||'45' AND
        TO_CHAR(TS.TS_STAMP_DATETIME,'DD/MM/YYYY') = '$_POST[day]/$_POST[month]/$year' AND
        TS.TS_TYPE = TL.LEAVETYPE_ID (+))
GROUP BY
    EMP_ID, 
    BIO_TITLE_TH, 
    BIO_FNAME_TH, 
    BIO_LNAME_TH, 
    STATUS_NAME,
    NAME_FACULTY,
    CHOOSE_PERIOD_SECTION,
    MIN_TIME,
    LEAVETYPE_NAME
ORDER BY
    MIN_TIME,
	EMP_ID
";
		$stid = oci_parse($conn, $sql);
	    oci_execute($stid);
?>
<table width="90%" align="center">
<?
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
	<tr>
    	<td><?=$row["EMP_ID"]?></td>
    	<td><?=$row["BIO_TITLE_TH"]?> <?=$row["BIO_FNAME_TH"]?> <?=$row["BIO_LNAME_TH"]?></td>
    	<td><?=$row["STATUS_NAME"]?></td>
    	<td><?=$row["NAME_FACULTY"]?></td>
<?
		$t=strtotime($row["MIN_TIME"]);
		$t1=strtotime("08:00");
		$t2=strtotime("08:30");
		$t3=strtotime("09:00");
		switch($row["CHOOSE_PREIOD_SECTION"]){
			case '1': if(date("H:i",$t)>date("H:i",$t1)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '2': if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '3': if(date("H:i",$t)>date("H:i",$t3)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			default : if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
		}
?>    	<td>&nbsp;<?=$row["LEAVETYPE_NAME"]?></td>
    </tr>
<?
	}
?>
</table>
<?
}elseif($row["CODE_FACULTY"] == '07'){
	$sql="SELECT
    *
FROM
    (SELECT
        SBT.EMP_ID, 
        SBT.BIO_TITLE_TH, 
        SBT.BIO_FNAME_TH, 
        SBT.BIO_LNAME_TH, 
        SRD.NAME_FACULTY,
        SRSE.STATUS_NAME,
        SRDS.CHOOSE_PERIOD_SECTION,
        MIN(TO_CHAR(TS.TS_STAMP_DATETIME,'HH24:MI')) OVER(PARTITION BY TS_CODE_PERSON ORDER BY TS_STAMP_DATETIME RANGE UNBOUNDED PRECEDING) AS MIN_TIME,
        TL.LEAVETYPE_NAME
    FROM
        SDPERSON.SDU_BIODATA_TAB sbt,
        SDPERSON.SDU_CURRENT_WORK_TAB scwt,
        SDPERSON.SDU_REF_DEPARTMENT srd,
        SDPERSON.SDU_REF_DEPARTMENT_SUB srds,
        SDPERSON.SDU_REF_STATUS_EXT srse,
        SDPERSON.TIME_STAMPLOG ts,
        SDPERSON.TIME_LEAVETYPE tl
    WHERE
        SBT.EMP_ID = SCWT.EMP_ID AND
		SCWT.CWK_MUA_MAIN = '$row[CODE_FACULTY]' AND
		SCWT.CWK_MUA_SUBMAIN = '$row[CODE_DEPARTMENT_SECTION]' AND
        SCWT.CWK_MUA_MAIN = SRD.CODE_FACULTY AND
        SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
        SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+) AND
        SCWT.CWK_STATUS = SRSE.STATUS_ID AND
        SRSE.STATUS_ID in ('01', '03', '05') AND
        TS.TS_CODE_PERSON = SUBSTR(SBT.EMP_ID,0,4)||'0'||substr(SBT.EMP_ID,-3,3)||'45' AND
        TO_CHAR(TS.TS_STAMP_DATETIME,'DD/MM/YYYY') = '$_POST[day]/$_POST[month]/$year' AND
        TS.TS_TYPE = TL.LEAVETYPE_ID (+))
GROUP BY
    EMP_ID, 
    BIO_TITLE_TH, 
    BIO_FNAME_TH, 
    BIO_LNAME_TH, 
    STATUS_NAME,
    NAME_FACULTY,
    CHOOSE_PERIOD_SECTION,
    MIN_TIME,
    LEAVETYPE_NAME
ORDER BY
    MIN_TIME,
	EMP_ID
";
		$stid = oci_parse($conn, $sql);
	    oci_execute($stid);
?>
<table width="90%" align="center">
<?
    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
	<tr>
    	<td><?=$row["EMP_ID"]?></td>
    	<td><?=$row["BIO_TITLE_TH"]?> <?=$row["BIO_FNAME_TH"]?> <?=$row["BIO_LNAME_TH"]?></td>
    	<td><?=$row["STATUS_NAME"]?></td>
    	<td><?=$row["NAME_FACULTY"]?></td>
<?
		$t=strtotime($row["MIN_TIME"]);
		$t1=strtotime("08:00");
		$t2=strtotime("08:30");
		$t3=strtotime("09:00");
		switch($row["CHOOSE_PREIOD_SECTION"]){
			case '1': if(date("H:i",$t)>date("H:i",$t1)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '2': if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			case '3': if(date("H:i",$t)>date("H:i",$t3)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
			default : if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td><font color=red>".date("H:i",$t)."</font></td>"; }else{ echo "<td>".date("H:i",$t)."</td>"; } break;
		}
?>    	<td>&nbsp;<?=$row["LEAVETYPE_NAME"]?></td>
    </tr>
<?
	}
?>
</table>
<?
}
?>