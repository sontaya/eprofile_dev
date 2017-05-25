<?
$emp_id = $_REQUEST['emp_id'];
include("../includes/connect.php");
$sql = "SELECT * FROM ".TB_CURRENT_WORK_HISTORY_TAB." WHERE EMP_ID = '{$emp_id}' ORDER BY CH_ID ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$nrow = $db->count_row(TB_CURRENT_WORK_HISTORY_TAB,"  WHERE EMP_ID = '{$emp_id}' ",$conn);
$n = 0 ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ประวัติการทำงาน</title>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
}
</style>
</head>

<body>
<h2 align="center">ประวัติการทำงาน</h2>
<table align="left" border="0" cellpadding="4">
<?
while($row = oci_fetch_array($stid, OCI_BOTH)) {
	$sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  WHERE STAFFTYPE_ID = '".$row["CH_MUA_EMP_TYPE"]."' "; 
	$stid_emp_type = oci_parse($conn, $sql_emp_type );
	oci_execute($stid_emp_type);
	$row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH);
	
	$sql_emp_subtype = "SELECT * FROM  ".TB_REF_SUBSTAFFTYPE."  WHERE SUBSTAFFTYPE_ID = '".$row["CH_MUA_EMP_SUBTYPE"]."' "; 
	$stid_emp_subtype = oci_parse($conn, $sql_emp_subtype );
	oci_execute($stid_emp_subtype);
	$row_emp_subtype = oci_fetch_array($stid_emp_subtype, OCI_BOTH);
	
	 $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  WHERE CODE_FACULTY =  '".$row["CH_MUA_MAIN"]."'"; 
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH);
	
	 $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_DEPARTMENT_SECTION = '".$row["CH_MUA_SUBMAIN"]."'   "; 
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH);
	
	$sql_ref_department_group = "SELECT * FROM  ".TB_REF_DEPARTMENT_GROUP."  WHERE CODE_DEPARTMENT_GROUP = '".$row["CH_MUA_WORK_GROUP"]."'  "; 
	$stid_ref_department_group = oci_parse($conn, $sql_ref_department_group);
	oci_execute($stid_ref_department_group);
	$row_ref_department_group = oci_fetch_array($stid_ref_department_group, OCI_BOTH);
	
	$sql_ref_site = "SELECT * FROM  ".TB_REF_SITE."  WHERE CODE_SITE =  '".$row["CH_DSU_EDU_CENTER"]."'  "; 
	$stid_ref_site = oci_parse($conn, $sql_ref_site);
	oci_execute($stid_ref_site);
	$row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH);
	
	$sql_position = "SELECT *  FROM  ".TB_POSITION."  WHERE CODE =  '".$row["CH_DSU_POS"]."'  "; 
	$stid_position = oci_parse($conn, $sql_position);
	oci_execute($stid_position);
	$row_position = oci_fetch_array($stid_position, OCI_BOTH);
	
	 $sql_mua_vpos = "SELECT * FROM  ".TB_REF_POSITION."  WHERE POSITION_ID =  '".$row["CH_MUA_VPOS"]."' "; 
	$stid_mua_vpos = oci_parse($conn, $sql_mua_vpos);
	oci_execute($stid_mua_vpos);
	$row_mua_vpos = oci_fetch_array($stid_mua_vpos, OCI_BOTH);
	
	$sql_mua_level = "SELECT * FROM  ".TB_REF_STAFF_LEV." WHERE STAFF_LEV_ID =  '".$row["CH_MUA_LEVEL"]."'"; 
	$stid_mua_level = oci_parse($conn, $sql_mua_level);
	oci_execute($stid_mua_level);
	$row_mua_level = oci_fetch_array($stid_mua_level, OCI_BOTH);
	
	$sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  WHERE ADMIN_ID =  '".$row["CH_MUA_MPOS"]."'"; 
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH);
	
	echo "<tr ><td align='left'><b>ลำดับที่  ".++$n."</b></td><td align='left'>&nbsp;</td></tr>";
	echo "<tr><td width='200px' align='right'>ประเภทบุคลากร(สกอ.) : </td><td width='400px'  align='left'>".$row_emp_type["STAFFTYPE_NAME"]."</td></tr>";
	echo "<tr><td align='right'>ประเภทบุคลากรย่อย(สกอ.) : </td><td align='left'>".$row_emp_subtype["SUBSTAFFTYPE_NAME"]."</td></tr>";
	echo "<tr><td align='right'>หน่วยงานหลัก(มสด.) : </td><td align='left'>".$row_ref_department["NAME_FACULTY"]."</td></tr>";
	echo "<tr><td align='right'>หน่วยงานย่อย(มสด.) : </td><td align='left'>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</td></tr>";
	echo "<tr><td align='right'>กลุ่มงาน (มสด.) : </td><td align='left'>".$row_ref_department_group["NAME_DEPARTMENT_GROUP"]."</td></tr>";
	echo "<tr><td align='right'>ศูนย์การศึกษา(มสด.) : </td><td align='left'>".$row_ref_site["NAME_SITE"]."</td></tr>";
	echo "<tr><td align='right'>ตำแหน่ง(มสด.) : </td><td align='left'>".$row_position["POSITION"]."</td></tr>";
	echo "<tr><td align='right'>ตำแหน่งทางวิชาการ(สกอ.) : </td><td align='left'>".$row_mua_vpos["POSITION_NAME_TH"]."</td></tr>";
	echo "<tr><td align='right'>ระดับ(สกอ.) : </td><td align='left'>".$row_mua_level["STAFF_LEV_NAME"]."</td></tr>";
	echo "<tr><td align='right'>ตำแหน่งบริหาร(สกอ.) : </td><td align='left'>".$row_mua_mpos["ADMIN_NAME"]."</td></tr>";
	echo "<tr><td align='right'>วันที่เข้าทำงาน : </td><td align='left'>".change_date_thai($row["CH_START_WORK_DATE"])."</td></tr>";
	echo "<tr><td align='right'>ปฏิบัติงานตั้งแต่เวลา : </td><td align='left'>".$row["CH_START_WORK"]." ถึงเวลา ".$row["CH_END_WORK"]." </td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	
	
}

?>
</table>
</body>
</html>
<? $db->closedb($conn); ?>