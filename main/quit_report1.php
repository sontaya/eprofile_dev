<?
@session_start();
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
  $year = date("Y");
  if($_GET["yr"] != "") $year = $_GET["yr"];
 $month = date("m");
 if($_GET["mo"] != "") $month = $_GET["mo"];
 $sum_day = date("t",strtotime("{$year}-{$month}-01"));
 
$month_arr = array(1=>"มกราคม", 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สรุปคนลาออก</title>
<style type="text/css">
.textAlignVer{
	display:block;
	writing-mode: tb-rl;
	filter: flipv fliph;
	-webkit-transform: rotate(-90deg); 
	-moz-transform: rotate(-90deg);	
	transform: rotate(-90deg); 
	position:relative;
	width:20px;
	white-space:nowrap;
	font-size:12px;
	margin-bottom:5px;
}

</style>
<script language="javascript">
function change_stat(dd){
	var date = dd.split("-");
	window.location="quit_report1.php?yr="+date[1]+"&mo="+date[0];
}

function ch_date(){
	var m=document.getElementById("m").value;
	var y=document.getElementById("y").value;
	window.location="quit_report1.php?yr="+y+"&mo="+m;
}

</script>
</head>

<body>
<div align="center">ดูสถิติย้อนหลัง 
<!--<select id="dd" name="dd" onchange="change_stat(this.value)" style="text-align:right">
<?
$select = "";

for($i = 0;$i <= 12 ;$i++){
	
	$ty =  date("Y", strtotime("-$i month"));
	$mh =  date("m", strtotime("-$i month"));
	if($ty == ((int)$_GET["yr"]) and $mh == ((int)$_GET["mo"])) $select = "selected = 'selected' ";
	else $select = "";
	echo "<option value='".$mh."-".$ty."'  $select>".get_month_full($mh)." ".($ty+543)."</option>\n";
	
}
?>
</select>-->

<form>
	เดือน :
    <select id='m' onchange="ch_date()">
    <?
    for($i = 1 ;$i <= 12 ;$i++){
	if(str_pad($i,2,"0",STR_PAD_LEFT) == ((int)$_GET["mo"])){
	 $select = "selected = 'selected' ";
	}
	else{
		$select="";
	}
	echo "<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'  $select>".$month_arr[number_format($i)]."</option>\n";
	
	}
	?>
    </select>
    &nbsp;
    ปี :
    <select id='y' onchange="ch_date()">
    <?
    for($i = 0;$i <= 20 ;$i++){
	$ty=date("Y")-$i;
	if($ty == ((int)$_GET["yr"])){
		$select = "selected = 'selected' ";
	}
	else{
		$select = "";
	}
		echo "<option value='".$ty."'  $select>".($ty+543)."</option>\n";
	}
	?>
    </select>
</form>

</div><br />
<div align="center">ทะเบียนลาออกของบุคลากรประจำมหาวิทยาลัยราชภัฏสวนดุสิต <br /> ประจำเดือน <? echo get_month_full($month)." ".($year+543);?></div><br />
<table width="1181" border="1" cellspacing="0" cellpadding="3" style="font-family:Tahoma, Geneva, sans-serif;font-size:14px;" align="center">

	<tr align="center" bgcolor="#CAE4FF">
    	<td rowspan="2" width="25">ที่</td>
        <td rowspan="2" width="150">ชื่อ-สกุล</td>
        <td rowspan="2" width="237">สังกัด</td>
        <td rowspan="2" width="105">วันเริ่มงาน</td>
        <td style="border-bottom:none;" width="39">&nbsp;</td>
        <td style="border-bottom:none;" width="40">&nbsp;</td>
        <td style="border-bottom:none;" width="38">&nbsp;</td>
        <td colspan="2">พนักงาน<br />มหาวิทยาลัย</td>
        <td colspan="2">พนักงานราชการ</td>
        <td rowspan="2" width="104">วัน/เดือน/ปี<br />ที่ลาออก</td>
        <td rowspan="2" width="228">หมายเหตุที่ลาออก</td>
    </tr>
  
	<tr height="130" valign="bottom" bgcolor="#CAE4FF">
    	<td style="border-top:none;" align="center"><span class="textAlignVer">ข้าราชการ</span></td>
        <td style="border-top:none;" align="center"><span class="textAlignVer">อาจารย์ประจำตามสัญญาจ้าง</span></td>
        <td style="border-top:none;" align="center"><span class="textAlignVer">เจ้าหน้าที่ประจำตามสัญญาจ้าง</span></td>
    	<td width="48" align="center"><span class="textAlignVer">สายวิชาการ</span></td>
        <td width="45" align="center"><span class="textAlignVer">สายสนับสนุน</span></td>
        <td width="47" align="center"><span class="textAlignVer">สายวิชาการ</span></td>
        <td width="47" align="center"><span class="textAlignVer">สายสนับสนุน</span></td>
    </tr>
<? 
$where = "";
if($_SESSION["USER_TYPE"] == "chief") $where .= $_SESSION["report_where"];
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE $where CWK_STATUS = '02' AND (CWK_QUIT_DATE BETWEEN TO_DATE('{$year}-{$month}-01','YYYY-MM-DD') AND TO_DATE('{$year}-{$month}-{$sum_day}','YYYY-MM-DD'))  ";
//print $sql;
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n = 1;
while($row = oci_fetch_array($stid, OCI_BOTH)){
	list($year1,$month1,$day1) = explode("-",$row['CWK_START_WORK_DATE']);
	list($year2,$month2,$day2) = explode("-",$row['CWK_QUIT_DATE']);
 ?>      
    <tr>
    	<td align="center" valign="top"><?=$n?></td>
        <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
        <td align="left" valign="top" style="padding-left:3px"><?=get_department($row["CWK_MUA_MAIN"],TB_REF_DEPARTMENT)?></td>
        <td align="center"><? echo $day1." ".get_month($month1)." ".($year1+543);?></td>
        <td align="center" valign="middle"><? if($row["CWK_MUA_EMP_TYPE"] =="1" ){echo "<img src=\"../images/mark.png\" />";}?></td>
        <td align="center" valign="middle"><? if($row["CWK_DSU_POS"] > 122  and $row["CWK_DSU_POS"] < 140){echo "X";}?></td>
        <td align="center" valign="middle"><? if(($row["CWK_DSU_POS"] < 15  and $row["CWK_DSU_POS"] > 23) and ($row["CWK_DSU_POS"] < 123  and $row["CWK_DSU_POS"] > 139) and ($row["CWK_DSU_POS"] < 77  and $row["CWK_DSU_POS"] > 79) ){echo "X";}?></td>
        <td align="center" valign="middle"><? if($row["CWK_MUA_EMP_TYPE"] =="3" and  $row["CWK_MUA_EMP_SUBTYPE"] =="1" ){echo "X";}?></td>
        <td align="center" valign="middle"><? if($row["CWK_MUA_EMP_TYPE"] =="3" and  $row["CWK_MUA_EMP_SUBTYPE"] =="2" ){echo "X";}?></td>
        <td align="center" valign="middle"><? if($row["CWK_MUA_EMP_TYPE"] =="2" and  $row["CWK_MUA_EMP_SUBTYPE"] =="1" ){echo "X";}?></td>
        <td align="center" valign="middle"><? if($row["CWK_MUA_EMP_TYPE"] =="2" and  $row["CWK_MUA_EMP_SUBTYPE"] =="2" ){echo "X";}?></td>
        <td align="center"><? echo $day2." ".get_month($month2)." ".(($year2+543));?></td>
        <td align="left" valign="top" style="padding-left:3px"><?=$row["CWK_QUIT_REASON"]?></td>
    </tr>
<?
$n++;
}
?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'quit_report1_excel.php?excel=1&yr=<?=$year?>&mo=<?=$month?>'"/></div>
</body>
</html>
<?
$db->closedb($conn);
?>