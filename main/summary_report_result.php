<?
$type = @$_REQUEST['type'];@date_default_timezone_set("Asia/Bangkok");
if(@$_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=summary_report_type(".$type.")".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
include("../includes/connect.php");
$all_person = 0;
?>


<script type="text/javascript">

$(function() {
        $.fx.speeds._default = 1000;
        $( "#dialog" ).dialog({
          autoOpen: false,
          show: "blind",
          width: "700"
        });

        $( "#opener" ).click(function() {
          $( "#dialog" ).dialog( "open" );
          return false;
        });
      });
	  
function openModal(table){
		//alert("test");
		var rd=Math.floor(Math.random()*11);
        $("#dialog").load("summary_report_result_views.php", { 'table': table , 'rd': rd} );
        $("#dialog" ).dialog( "open" );
      }
</script>

<style type="text/css">
.t_head{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:14px;
}
.sub{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 25px;
	font-size:14px;
	
}
.sub2{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 50px;
	font-size:14px;
}
.sub3{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 5px;
	font-size:14px;
}
.sub4{
	font-family:Tahoma, Geneva, sans-serif;
	padding-right: 10px;
	font-size:14px;
	font-weight:bold;
}
.sub44{
	font-family:Tahoma, Geneva, sans-serif;
	padding-right: 10px;
	font-size:14px;
}
.main_sub{
	font-family:Tahoma, Geneva, sans-serif;
	font-weight:bold;
	font-size:14px;
}

</style>
<?
if($type == "1"){
	echo "<img src='../images/under-construction.jpg' border='0' height='300' />";
?>
<div id="open"></div>
<!--<h2 align="center" style="font-family:Tahoma, Geneva, sans-serif">สรุปจำนวนบุคลากร<br />มหาวิทยาลัยราชภัฏสวนดุสิต<br />ข้อมูล ณ วันที่ <?=date("d")?>  <?=get_month_full(date("m"))?> <?=(date("Y")+543)?></h2>	
<table  border="0" cellspacing="2" cellpadding="3" align="center" >
  <tr>
    <td width="630" align="left" class="main_sub">1. ข้าราชการพลเรือนในสถาบันอุดมศึกษา</td>
    <td width="51" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">1.1 ข้าราชการพลเรือนในสถาบันอุดมศึกษา (วิชาการ)</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">1.2 ข้าราชการพลเรือนในสถาบันอุดมศึกษา (ปฏิบัติการ)</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">2. ลูกจ้างประจำ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">3. พนักงานราชการ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">3.1 กลุ่มงานบริหารทั่วไป (วิชาการ)</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">3.2 กลุ่มงานบริหารทั่วไป (ปฏิบัติการ)</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">3.3 กลุ่มบริการ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">4. พนักงานมหาวิทยาลัย</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">4.1 สายวิชาการ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">4.2 สายสนับสนุนวิชาการ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">5. อาจารย์ประจำตามสัญญาจ้าง</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">5.1 อาจารย์ประจำตามสัญญาจ้าง</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">5.2 อาจารย์ชาวต่างประเทศ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">6. ผู้ช่วยสอน</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">6.1 ผู้ช่วยสอน</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">6.2 ผู้ช่วยสอนด้านภาษาและเทคนิค</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">7. นักวิจัย</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">8. ครู การศึกษาพิเศษ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">9. ครู รร.สาธิตอนุบาลละอออุทิศ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">10. เจ้าหน้าที่ประจำตามสัญญาจ้าง</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">10.1 เจ้าหน้าที่ประจำตามสัญญาจ้าง</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub2">10.1.1 คนงาน</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">10.2 ผู้ช่วยนักวิจัย</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">10.3 เจ้าหน้าศูนย์การศึกษาพิเศษ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub">10.4 เจ้าหน้าที่โรงเรียนสาธิตอนุบาลละอออุทิศ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="sub2">10.4.1 พี่เลี้ยงเด็ก</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">11. เจ้าหน้าที่สังกัดสำนักกิจการพิเศษ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">12. เจ้าหน้าที่โครงการบริการอาหารและขนมอบ</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="main_sub">13. ที่ปรึกษา</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="main_sub">รวมทั้งสิ้น (คน)</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
	<br />-->
<?
//if(!isset($_REQUEST['print'])){
?>
<!--<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=1','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=1'" /></div>-->
<?
//}
?>
<?	
}elseif($type == "2"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสรุปยอดรวมบุคลากรทั้งมหาวิทยาลัยตามประเภทบุคลากร</h3>
<table width="633" border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr >
    <th width="492" align="center" class="t_head">ประเภทบุคลากร</th>
    <th width="123" align="center" class="t_head">จำนวน (คน)</th>
  </tr>
<?
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND (CWK_STATUS = '03' OR CWK_STATUS = '01') ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$row_count = oci_fetch_array($stid_count, OCI_BOTH);
	$all_person += $row_count[0];
?>
  <tr>
    <td  align="left" class="sub3"><?=$row["STAFFTYPE_NAME"]?></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick='openModal(" CWK_MUA_EMP_TYPE={<?=$row["STAFFTYPE_ID"]?>}")'><?=number_format($row_count[0])?></a></td>
  </tr>
<? }  ?>
  <tr>
    <td  align="center" class="main_sub">รวม</td>
    <td align="right" class="sub4"><?=number_format($all_person)?></td>
  </tr>
</table>
<p style="color: red">
  *แสดงเฉพาะบุคลากรที่กำลังปฏิบัติการ หรือ ลาศึกษาต่อ
</p>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=2','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=2'" /></div>
<? }?>
<?
}elseif($type == "3"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสรุปยอดรวมบุคลากรทั้งมหาวิทยาลัยตามหน่วยงาน</h3>
<table width="633" border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="492" align="center" class="t_head">หน่วยงาน</th>
    <th width="123" align="center" class="t_head">จำนวน (คน)</th>
  </tr>
<?
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$row_count = oci_fetch_array($stid_count, OCI_BOTH);
	$all_person += $row_count[0];
?>
  <tr>
    <td  align="left" class="sub3"><?=$row["NAME_FACULTY"]?></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_MAIN={<?=$row["CODE_FACULTY"]?>}')"><?=number_format($row_count[0])?></a></td>
  </tr>
<? }  ?>
  <tr>
    <td  align="center" class="main_sub">รวม</td>
    <td align="right" class="sub4"><?=number_format($all_person)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=3','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=3'" /></div>
<? }?>
<?	
}elseif($type == "4"){
	?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสรุปยอดรวมบุคลากรตามวุฒิการศึกษาและประเภท</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="137" align="center" class="t_head">ประเภทบุคลากร</th>
    <th width="90" align="center" class="t_head">ปริญญาเอก</th>
    <th width="90" align="center" class="t_head">ปริญญาโท</th>
    <th width="90" align="center" class="t_head">ปริญญาตรี</th>
    <th width="90" align="center" class="t_head">อื่นๆ</th>
    <th width="90" align="center" class="t_head">รวม</th>
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){ // staff type 8 records
	$sql_count = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$num1 = 0;// ปริญญาเอก
	$num2 = 0;// ปริญญาโท
	$num3 = 0;// ปริญญาตรี
	$num4 = 0;// อื่นๆ
	$all_person =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn); //รวมทั้งหมดในแต่ละประเภท
	
	while($row_count = oci_fetch_array($stid_count, OCI_BOTH)){
		$sql_count1 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '80' AND EMP_ID = '".$row_count['EMP_ID']."'   ";
		$stid_count1 = oci_parse($conn, $sql_count1 );
		oci_execute($stid_count1);
		while($row_count1 = oci_fetch_array($stid_count1, OCI_BOTH)){
			$num1++ ;
			$c1++;
			//print $row_count1["EMP_ID"]."<br>";
			 break;
		}
		
		if($c1 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count2 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE  EDU_LEVEL = '60'  AND EMP_ID = '".$row_count['EMP_ID']."'  ";
			$stid_count2 = oci_parse($conn, $sql_count2 );
			oci_execute($stid_count2);
			while($row_count2 = oci_fetch_array($stid_count2, OCI_BOTH)){
				$num2++ ;
				$c2++;
				break;
			}
			
		if($c2 > 0 ){
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count3 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '40'  AND EMP_ID = '".$row_count['EMP_ID']."'";
			$stid_count3 = oci_parse($conn, $sql_count3 );
			oci_execute($stid_count3);
			while($row_count3 = oci_fetch_array($stid_count3, OCI_BOTH)){
				$num3++ ;
				$c3++;
				break;
			}
			
		if($c3 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
			$num4++;
			
	}	// end while all EMP_ID
	
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;
	$total += $all_person;

?>
  <tr>
    <td  align="left" class="sub3"><?=$row["STAFFTYPE_NAME"]?></td>
    <td align="center" ><a style="cursor:pointer" onclick="openModal('CWK_MUA_EMP_TYPE ={<?=$row["STAFFTYPE_ID"]?>} AND DOCTER={80} ')"><?=number_format($num1)?><a></td>
    <td align="center" ><a style="cursor:pointer" onclick="openModal('(DOCTER<>80  or DOCTER is null) AND CWK_MUA_EMP_TYPE ={<?=$row["STAFFTYPE_ID"]?>} AND MASTE = 60')"><?=number_format($num2)?></a></td>
    <td align="center" ><a style="cursor:pointer" onclick="openModal('(DOCTER<>80  or DOCTER is null) AND (MASTE<>60  or MASTE is null) AND CWK_MUA_EMP_TYPE ={<?=$row["STAFFTYPE_ID"]?>} AND  BACHELOR=40')"><?=number_format($num3)?></a></td>
    <td align="center" ><a style="cursor:pointer" onclick="openModal('(DOCTER<>80  or DOCTER is null) AND (MASTE<>60  or MASTE is null) AND (BACHELOR<>40 or BACHELOR is null)  AND CWK_MUA_EMP_TYPE ={<?=$row["STAFFTYPE_ID"]?>}')"><?=number_format($num4)?></a></td>
    <td align="center" ><a style="cursor:pointer" onclick="openModal('CWK_MUA_EMP_TYPE ={<?=$row["STAFFTYPE_ID"]?>} ')"><?=number_format($all_person)?></a></td>
  </tr>
<? 
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
} // end while staff type 8 records

?>
  <tr>
    <td  align="center" class="main_sub">รวม</td>
    <td align="center" class="main_sub"><?=number_format($num1_all)?></td>
    <td align="center" class="main_sub"><?=number_format($num2_all)?></td>
    <td align="center" class="main_sub"><?=number_format($num3_all)?></td>
    <td align="center" class="main_sub"><?=number_format($num4_all)?></td>
    <td align="center" class="main_sub"><?=number_format($total)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=4','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=4'" /></div>
<? }?>
<?	
}elseif($type == "5"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานแสดงจำนวนบุคลากรจำแนกตามตำแหน่งวิชาการ</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="255" align="center" class="t_head">หน่วยงาน</th>
    <th width="27" align="center" class="t_head">ศ.</th>
    <th width="27" align="center" class="t_head">รศ.</th>
    <th width="65" align="center" class="t_head">รศ.พิเศษ</th>
    <th width="27" align="center" class="t_head">ผศ.</th>
    <th width="65" align="center" class="t_head">ผศ.พิเศษ</th>
    <th width="60" align="center" class="t_head">อาจารย์</th>
    <th width="46" align="center" class="t_head">รวม</th>
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$num5_all = 0;
$num6_all = 0;
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){ // department 15 records
	$num1 = 0;// ศ. 04
	$num2 = 0;// รศ. 03
	$num3 = 0;// รศ.พิเศษ 06
	$num4 = 0;// ผศ. 02
	$num5 = 0;// ผศ.พิเศษ 05
	$num6 = 0;// อาจารย์ 01

		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '04' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num1 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '03' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num2 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '06' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num3 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '02' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num4 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '05' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num5 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '01' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num6 = $num[0];
		
	$all_person =  $num1 + $num2 + $num3 + $num4 + $num5 + $num6;
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;
	$num5_all += $num5;
	$num6_all += $num6;
	$total += $all_person;
	
?>
  <tr>
    <td  align="left" class="sub3"><?=$row["NAME_FACULTY"]?></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {04} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num1)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {03} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num2)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {06} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num3)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {02} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num4)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {05} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num5)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_VPOS = {01} AND  CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num6)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>} AND CWK_MUA_VPOS <> {00}  ')"><?=number_format($all_person)?></a></td>
  </tr>
<?
} //end while department 15 records


?>
  <tr>
    <td  align="center" class="main_sub">รวม</td>
    <td align="right" class="sub4"><?=number_format($num1_all)?></td>
    <td align="right" class="sub4"><?=number_format($num2_all)?></td>
    <td align="right" class="sub4"><?=number_format($num3_all)?></td>
    <td align="right" class="sub4"><?=number_format($num4_all)?></td>
    <td align="right" class="sub4"><?=number_format($num5_all)?></td>
    <td align="right" class="sub4"><?=number_format($num6_all)?></td>
    <td align="right" class="sub4"><?=number_format($total)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=5','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=5'" /></div>
<? }?>
<?	
}elseif($type == "6"){
	?>
<h3 align="center">รายงานแสดงจำนวนบุคลากรจำแนกตามหน่วยงานและคุณวุฒิ</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="255" align="center" class="t_head">หน่วยงาน</th>
    <th width="74" align="center" class="t_head">ปริญญาเอก</th>
    <th width="74" align="center" class="t_head">ปริญญาโท</th>
    <th width="74" align="center" class="t_head">ปริญญาตรี</th>
    <th width="59" align="center" class="t_head">อื่นๆ</th>
    <th width="65" align="center" class="t_head">รวม</th>
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){ //department 15 records
	$sql_count = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$num1 = 0;// ปริญญาเอก
	$num2 = 0;// ปริญญาโท
	$num3 = 0;// ปริญญาตรี
	$num4 = 0;// อื่นๆ
	$all_person =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn); //รวมทั้งหมดในแต่ละประเภท
	
	while($row_count = oci_fetch_array($stid_count, OCI_BOTH)){
		//echo $row_count['EMP_ID']." ";
		$sql_count1 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '80' AND EMP_ID = '".$row_count['EMP_ID']."'  ";
		$stid_count1 = oci_parse($conn, $sql_count1 );
		oci_execute($stid_count1);
		while($row_count1 = oci_fetch_array($stid_count1, OCI_BOTH)){
			$num1++ ;
			$c1++;
			 break;
		}
		
		if($c1 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count2 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '60'  AND EMP_ID = '".$row_count['EMP_ID']."'   ";
			$stid_count2 = oci_parse($conn, $sql_count2 );
			oci_execute($stid_count2);
			while($row_count2 = oci_fetch_array($stid_count2, OCI_BOTH)){
				$num2++ ;
				$c2++;
				break;
			}
			
		if($c2 > 0 ){
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count3 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE  EDU_LEVEL = '40'  AND EMP_ID = '".$row_count['EMP_ID']."'  ";
			$stid_count3 = oci_parse($conn, $sql_count3 );
			oci_execute($stid_count3);
			while($row_count3 = oci_fetch_array($stid_count3, OCI_BOTH)){
				$num3++ ;
				$c3++;
				break;
			}
			
		if($c3 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
			$num4++;
			
	}	// end while all EMP_ID
	
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;
	$total += $all_person;

?>
  <tr>
    <td  align="left" class="sub3"><?=$row["NAME_FACULTY"]?></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' DOCTER={80} AND CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>} AND DOCTER={80}')"><?=number_format($num1)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' (DOCTER<>80  or DOCTER is null) AND CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>} AND MASTE={60}')"><?=number_format($num2)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' (DOCTER<>80  or DOCTER is null) AND (MASTE<>60  or MASTE is null) AND CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>} AND BACHELOR={40}')"><?=number_format($num3)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' (DOCTER<>80  or DOCTER is null) AND (MASTE<>60  or MASTE is null) AND (BACHELOR<>40 or BACHELOR is null) AND CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($num4)?></a></td>
    <td align="right" class="sub44"><a style="cursor:pointer" onclick="openModal(' CWK_MUA_MAIN = {<?=$row["CODE_FACULTY"]?>}')"><?=number_format($all_person)?></a></td>
  </tr>
<?
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
} //end while department 15 records

?>
  <tr>
    <td  align="center" class="main_sub">รวม</td>
    <td align="right" class="sub4"><?=number_format($num1_all)?></td>
    <td align="right" class="sub4"><?=number_format($num2_all)?></td>
    <td align="right" class="sub4"><?=number_format($num3_all)?></td>
    <td align="right" class="sub4"><?=number_format($num4_all)?></td>
    <td align="right" class="sub4"><?=number_format($total)?></td>
  </tr>
</table>
<br />
<p style="color: red">
  *แสดงเฉพาะบุคลากรที่กำลังปฏิบัติการ หรือ ลาศึกษาต่อ
</p>
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('summary_report_result.php?print=1&type=6','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='summary_report_result.php?excel=1&type=6'" /></div>
<? }?>
<?
} 
$db->closedb($conn);
if($_REQUEST['print'] == "1"){
?>
<script language="javascript">
window.print();
var t=setTimeout("window.close()",300)
</script>

<?
}
?>