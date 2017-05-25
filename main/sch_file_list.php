<?
@session_start();
$fpath = '';
	include $fpath."../includes/connect.php";
	
	//echo "<br />";
	 $sql = "SELECT * FROM  ".TB_SCHOLAR_FILE_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY SCH_ID ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$n = 1;
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		if($row["SCH_SEM_FILE"] == "3" ) $txt = "ทั้งปี" ; else $txt = "เทอม ".$row["SCH_SEM_FILE"];
		echo "<div style=\"height: 30px; \">
		ไฟล์ที่ $n ปีการศึกษา ".$row["SCH_YEAR_FILE"]." ".$txt." <a href=\"files/sch_data_file/".$row["SCH_FILE_NAME"]."\" target=\"_blank\"><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" title=\"ไฟล์ที่ $n \" alt=\"ไฟล์ที่ $n \" align=\"top\" /></a> <span style=\"cursor:pointer;width:140px\" onclick=\"del_sch_file('".$row["SCH_ID"]."','".$row["SCH_FILE_NAME"]."')\"><img src='../images/b_del.png' height='15' border='0' style='cursor:pointer' title='Delete'></span></div>";
/*		 		echo "<div style=\"height: 30px; \">
		ไฟล์ที่ $n ปีการศึกษา ".$row["SCH_YEAR_FILE"]." ".$txt."<a href=\"files/sch_data_file/".$row["SCH_FILE_NAME"]."\" target=\"_blank\"><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" title=\"ไฟล์ที่ $n \" alt=\"ไฟล์ที่ $n \" align=\"top\" /> </a>
		".$row["SCH_FILE_NAME"]."
		 <span style=\"cursor:pointer;width:140px\" onclick=\"del_sch_file('".$row["SCH_ID"]."','".$row["SCH_FILE_NAME"]."')\"><img src='../images/b_del.png' height='15' border='0' style='cursor:pointer' title='Delete'></span></div>";
*/		 
		$n++;
	}
	oci_free_statement($stid);
?>