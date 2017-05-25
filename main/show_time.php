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
?>
<table border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td valign="top"><?
	$year=$_POST["year"]-543;
	if ($_POST["show"]){
?>
      <table border="0" cellspacing="1" cellpadding="3" align="center" class="MSSansSerif_10">
        <tr>
          <td>&nbsp;</td>
          <td bgcolor="#FF33FF"><font color="#FFFFFF"><strong>วันที่</strong></font></td>
          <td bgcolor="#FF33FF"><font color="#FFFFFF"><strong>เวลา</strong></font></td>
          <td bgcolor="#FF33FF"><font color="#FFFFFF"><strong>สถานที่</strong></font></td>
        </tr>
        <?
		$sql="SELECT ts_code_person, to_char(TS_STAMP_DATETIME,'DD/MM/YYYY') as day_stamp, to_char(TS_STAMP_DATETIME,'HH24:MI:SS') as time_stamp, ts_ip, log_name FROM SDPERSON.TIME_STAMPLOG ts, SDPERSON.TIME_LOGSITE tl WHERE TS.TS_STAMP_SITE = TL.LOG_ID (+) AND TS.TS_CODE_PERSON='".substr($_SESSION["EMP_ID"],0,4)."0".substr($_SESSION["EMP_ID"],-3,3)."45"."' AND to_char(TS.TS_STAMP_DATETIME,'DD/MM/YYYY') like '%$_POST[month]/".$year."' ORDER BY day_stamp, time_stamp";
		$stid = oci_parse($conn, $sql);
	    oci_execute($stid);
	    while (($row = oci_fetch_array($stid, OCI_BOTH))) {
  ?>
        <tr bgcolor="#FF33FF">
          <td bgcolor="#FF33FF"><B>
            <div align="center"><font color="#FFFFFF"><?echo $numrows;?></font></div>
          </B></td>
          <td bgcolor="#E0E0E0"><?echo $row["DAY_STAMP"];?></td>
          <td bgcolor="#E0E0E0"><?
		echo $row["TIME_STAMP"];
	  ?>
            <font color="#009933"><?echo "$rows[comment]";?> </font></td>
          <td bgcolor="#E0E0E0"><?echo "$row[LOG_NAME]";?></td>
        </tr>
        <?
        }
		?>
      </table>
      <?
      }
	  ?></td>
    <td valign="top"><div align="center" class="MSSansSerif_Large2">
    </div>
      <table border="0" cellspacing="1" cellpadding="2" class="MSSansSerif_10" align="center">
        <tr>
          <td>&nbsp;</td>
			<td bgcolor="#FF33FF"><div align="center"><font color="#FFFFFF"><strong>วัน</strong></font></div></td>
          <td bgcolor="#FF33FF"><div align="center"><font color="#FFFFFF"><strong>ทันเวลา</strong></font></div></td>
          <td bgcolor="#FF33FF"><div align="center"><font color="#FFFFFF"><strong>มาสาย</strong></font></div></td>
          <td nowrap bgcolor="#FF33FF"><div align="center"><font color="#FFFFFF"><strong>นอกเวลา 
            (หลัง 15:30 น.)</strong></font></div></td>
          <td bgcolor="#FF33FF"><div align="center"><font color="#FFFFFF"><strong>ไม่มาทำงาน</strong></font></div></td>
        </tr>
        <?
	$dm=cal_days_in_month(CAL_GREGORIAN,$_POST[month],$year);
	$comerows=0;
	$nocomerows=0;
	$laterows=0;
	$otrows=0;
	$day=1;
	while ($day<=$dm){
		if(strlen($day)==1){
			$day=substr("00".$day,-2,2);
		}
		if($_POST["emp_show"]){
			$person=$_POST["emp_show"];
		}else{
			$person=$_SESSION["EMP_ID"];
		}
/*		$sql2="SELECT * FROM (SELECT TS_CODE_PERSON, TS_STAMP_DATE, 
            LEAVETYPE_NAME, 
            TS_STAMP_TIME_MIN, 
            TS_STAMP_TIME_MAX, 
            CHOOSE_PERIOD_SECTION,
            ROW_NUMBER() OVER (PARTITION BY TS_STAMP_DATE ORDER BY TS_CODE_PERSON) as number_row FROM
        (SELECT
            TS_CODE_PERSON,
            TS_STAMP_DATE,
            LEAVETYPE_NAME,
            MIN(TS_STAMP_TIME) OVER(PARTITION BY TS_STAMP_DATE) AS TS_STAMP_TIME_MIN,
            MAX(TS_STAMP_TIME) OVER(PARTITION BY TS_STAMP_DATE) AS TS_STAMP_TIME_MAX,
            CHOOSE_PERIOD_SECTION
        FROM
            (SELECT
                TS_CODE_PERSON, 
                to_char(TS_STAMP_DATETIME,'DD/MM/YYYY') as TS_STAMP_DATE, 
                to_char(TS_STAMP_DATETIME,'HH24:MI:SS') as TS_STAMP_TIME, 
                TS_STAMP_SITE, 
                TS_IP, 
                LEAVETYPE_NAME,
                CHOOSE_PERIOD_SECTION
            FROM
                SDPERSON.time_stamplog,
                SDPERSON.TIME_LEAVETYPE,
                SDPERSON.SDU_CURRENT_WORK_TAB scwt,
                SDPERSON.SDU_REF_DEPARTMENT_SUB srds
            WHERE
                TS_CODE_PERSON = '".substr($person,0,4)."0".substr($person,-3,3)."45"."' AND
                TIME_STAMPLOG.TS_TYPE = TIME_LEAVETYPE.LEAVETYPE_ID (+) AND
                to_char(TS_STAMP_DATETIME,'DD/MM/YYYY') like '%$day/$_POST[month]/".$year."%' AND
                SCWT.EMP_ID = '".$person."' AND
                SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
                SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+)
            ORDER BY
                TS_STAMP_DATETIME)
        ORDER BY
            TS_STAMP_DATE, 
            LEAVETYPE_NAME)
    GROUP BY
        TS_CODE_PERSON,
        TS_STAMP_DATE,
        LEAVETYPE_NAME,
        TS_STAMP_TIME_MIN,
        TS_STAMP_TIME_MAX,
        CHOOSE_PERIOD_SECTION
    ORDER BY
        TS_STAMP_DATE)
WHERE NUMBER_ROW=1";*/
	$sql2="SELECT
				TS_CODE_PERSON, 
				MIN(to_char(TS_STAMP_DATETIME,'HH24:MI:SS')) OVER(PARTITION BY TS_CODE_PERSON) as TS_STAMP_DATETIME, 
				to_char(TS_STAMP_DATETIME,'d') as day_ofweek, 
				TS_STAMP_SITE, 
				TS_IP, 
				LEAVETYPE_NAME,
				CHOOSE_PERIOD_SECTION
			FROM
				SDPERSON.time_stamplog,
				SDPERSON.TIME_LEAVETYPE,
				SDPERSON.SDU_CURRENT_WORK_TAB scwt,
				SDPERSON.SDU_REF_DEPARTMENT_SUB srds
			WHERE
                TS_CODE_PERSON = '".substr($person,0,4)."0".substr($person,-3,3)."45"."' AND
                TIME_STAMPLOG.TS_TYPE = TIME_LEAVETYPE.LEAVETYPE_ID (+) AND
                to_char(TS_STAMP_DATETIME,'DD/MM/YYYY') like '%$day/$_POST[month]/".$year."%' AND
                SCWT.EMP_ID = '".$person."' AND
                SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
                SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+)
			ORDER BY
				TS_STAMP_DATETIME";
//		echo $sql2."<br>";
		$stid = oci_parse($conn, $sql2);
	    oci_execute($stid);
	    $row = oci_fetch_array($stid, OCI_BOTH);
?>
        <tr>
          <td bgcolor="#FF33FF" align="right" style="color:#FFFFFF; font-weight:bold;"><?="$day";?></td>
          <td><? $dayofweek = date('w', strtotime($year.'-'.$_POST[month].'-'.$day));
			switch($dayofweek){
				case '0' : echo "อาทิตย์"; break;
				case '1' : echo "จันทร์"; break;
				case '2' : echo "อังคาร"; break;
				case '3' : echo "พุธ"; break;
				case '4' : echo "พฤหัส"; break;
				case '5' : echo "ศุกร์"; break;
				case '6' : echo "เสาร์"; break;
			}
		  ?></td>
<? if($row["TS_CODE_PERSON"]==''){ 
		$sql_holiday="select * from SDPERSON.TIME_HOLIDAYS ths WHERE TH_DATE='$day' and TH_MONTH='$_POST[month]' and TH_YEAR in ('$year', 'all')";
		$stid_holiday = oci_parse($conn, $sql_holiday);
	    oci_execute($stid_holiday);
	    $row_holiday = oci_fetch_array($stid_holiday, OCI_BOTH);
		if($row_holiday["TH_NAMEOFDAY"]){
			?>
          <td bgcolor="#E0E0E0" align="center" colspan="4"><?=$row_holiday["TH_NAMEOFDAY"]?></td>
			<?
		}else{
?>        
          <td bgcolor="#E0E0E0" align="center" colspan="4">ไม่มา</td>
<?
			$nocomerows++;
		}
 }elseif($row["TH_YEAR"]==$year){ ?>        
          <td bgcolor="#E0E0E0" align="center" colspan="4"><?=$row["TH_NAMEOFDAY"]?></td>
<? }elseif($row["LEAVETYPE_NAME"]<>''){ ?>        
          <td bgcolor="#E0E0E0" align="center" colspan="4"><?=$row["LEAVETYPE_NAME"]?></td>
<? }else{
		$t=strtotime($row["TS_STAMP_DATETIME"]);
		$t1=strtotime("08:00");
		$t2=strtotime("08:30");
		$t3=strtotime("09:00");
		switch($row["CHOOSE_PREIOD_SECTION"]){
			case '1': if(date("H:i",$t)>date("H:i",$t1)){ echo "          <td bgcolor=\"#E0E0E0\" align=\"center\">&nbsp;</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>".date("H:i",$t)."</font></td>"; $laterows++; }else{ echo "<td bgcolor=\"#E0E0E0\" align=\"center\">".date("H:i",$t)."</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>&nbsp;</font></td>"; $comerows++; } break;
			case '2': if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td bgcolor=\"#E0E0E0\" align=\"center\">&nbsp;</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>".date("H:i",$t)."</font></td>"; $laterows++; }else{ echo "<td bgcolor=\"#E0E0E0\" align=\"center\">".date("H:i",$t)."</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>&nbsp;</font></td>"; $comerows++; } break;
			case '3': if(date("H:i",$t)>date("H:i",$t3)){ echo "          <td bgcolor=\"#E0E0E0\" align=\"center\">&nbsp;</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>".date("H:i",$t)."</font></td>"; $laterows++; }else{ echo "<td bgcolor=\"#E0E0E0\" align=\"center\">".date("H:i",$t)."</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>&nbsp;</font></td>"; $comerows++; } break;
			default : if(date("H:i",$t)>date("H:i",$t2)){ echo "          <td bgcolor=\"#E0E0E0\" align=\"center\">&nbsp;</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>".date("H:i",$t)."</font></td>"; $laterows++; }else{ echo "<td bgcolor=\"#E0E0E0\" align=\"center\">".date("H:i",$t)."</td>
          <td bgcolor=\"#E0E0E0\" align=\"center\">
<font color=red>&nbsp;</font></td>"; $comerows++; } break;
		}
		
	$sql3="SELECT
				TS_CODE_PERSON, 
				MAX(to_char(TS_STAMP_DATETIME,'HH24:MI:SS')) OVER(PARTITION BY TS_CODE_PERSON) as TS_STAMP_DATETIME, 
				TS_STAMP_SITE, 
				TS_IP, 
				LEAVETYPE_NAME,
				CHOOSE_PERIOD_SECTION
			FROM
				SDPERSON.time_stamplog,
				SDPERSON.TIME_LEAVETYPE,
				SDPERSON.SDU_CURRENT_WORK_TAB scwt,
				SDPERSON.SDU_REF_DEPARTMENT_SUB srds
			WHERE
                TS_CODE_PERSON = '".substr($person,0,4)."0".substr($person,-3,3)."45"."' AND
                TIME_STAMPLOG.TS_TYPE = TIME_LEAVETYPE.LEAVETYPE_ID (+) AND
                to_char(TS_STAMP_DATETIME,'DD/MM/YYYY') like '%$day/$_POST[month]/".$year."%' AND
                SCWT.EMP_ID = '".$person."' AND
                SCWT.CWK_MUA_MAIN = SRDS.CODE_FACULTY (+) AND
                SCWT.CWK_MUA_SUBMAIN = SRDS.CODE_DEPARTMENT_SECTION (+)
			ORDER BY
				TS_STAMP_DATETIME";
//		echo $sql2."<br>";
		$stid = oci_parse($conn, $sql3);
	    oci_execute($stid);
	    $row2 = oci_fetch_array($stid, OCI_BOTH);

?>
          <td bgcolor="#E0E0E0" align="center"><? if(date("H:i",strtotime($row2["TS_STAMP_DATETIME"]))>date("H:i",strtotime($row["TS_STAMP_DATETIME"]))){ echo date("H:i",strtotime($row2["TS_STAMP_DATETIME"]));  $otrows++; } ?></td>
          <td bgcolor="#E0E0E0" align="center"></td>
<? }?>
        </tr>
        <?
		$day++;		
	} // end while
  ?>
        <tr bgcolor="#FF33FF">
          <td align="right" colspan="2"><font color="#FFFFFF"><strong>รวม</strong></font></td>
          <td nowrap><div align="center"><font color="#FFFFFF"><strong> มาทัน <?echo $comerows;?> วัน </strong></font></div></td>
          <td nowrap><div align="center"><font color="#FFFFFF"><strong>มาสาย <?echo $laterows;?> วัน </strong></font></div></td>
          <td nowrap><div align="center"><font color="#FFFFFF"><strong>นอกเวลา <?echo $otrows;?> วัน</strong></font></div></td>
          <td nowrap><div align="center"><font color="#FFFFFF"><strong> ไม่มา <?echo $nocomerows;?> วัน </strong></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
