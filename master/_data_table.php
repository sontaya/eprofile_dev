<?

require_once("conn.php");

function data_department(){
	 global $conn;
	 $sql = "SELECT * FROM REF_DEPARTMENT";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<center>คลิ๊กที่ชื่อหน่วยงาน</center>";
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['CODE_FACULTY']."')\">".$row['NAME_FACULTY']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_department_sub(){
	 global $conn;
	 $sql = "SELECT * FROM REF_DEPARTMENT_SUB";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['CODE_DEPARTMENT_SECTION']."')\">".$row['NAME_DEPARTMENT_SECTION']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_extra_salary(){
	 global $conn;
	 $sql = "SELECT * FROM REF_EXTRA_SALARY";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['ID']."')\">".$row['NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_admin(){
	 global $conn;
	 $sql = "SELECT * FROM REF_ADMIN";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['ADMIN_ID']."')\">".$row['ADMIN_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_fac(){
	 global $conn;
	 $sql = "SELECT * FROM REF_FAC";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['FAC_ID']."')\">".$row['FAC_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_isced(){
	 global $conn;
	 $sql = "SELECT * FROM REF_ISCED";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['ISCED_ID']."')\">".$row['ISCED_NAME_TH']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_lev(){
	 global $conn;
	 $sql = "SELECT * FROM REF_LEV";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['LEV_ID']."')\">".$row['LEV_NAME_TH']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_position(){
	 global $conn;
	 $sql = "SELECT * FROM REF_POSITION";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['POSITION_ID']."')\">".$row['POSITION_NAME_TH']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_program(){
	 global $conn;
	 $sql = "SELECT * FROM REF_PROGRAM";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['PROGRAM_ID']."')\">".$row['PROGRAM_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_salary_source(){
	 global $conn;
	 $sql = "SELECT * FROM REF_SALARY_SOURCE";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['CODE_SALARY_SOURCE']."')\">".$row['NAME_SALARY_SOURCE']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_staff_lev(){
	 global $conn;
	 $sql = "SELECT * FROM REF_STAFF_LEV";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['STAFF_LEV_ID']."')\">".$row['STAFF_LEV_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_stafftype(){
	 global $conn;
	 $sql = "SELECT * FROM REF_STAFFTYPE";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['STAFFTYPE_ID']."')\">".$row['STAFFTYPE_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_stafftype_pair(){
	 global $conn;
	 $sql = "SELECT * FROM REF_STAFFTYPE_PAIR";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['STAFFTYPE_PAIR_ID']."')\">".$row['STAFFTYPE_NORMAL_ID']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_stafftype_sga(){
	 global $conn;
	 $sql = "SELECT * FROM REF_STAFFTYPE_SGA";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['STAFFTYPE_ID']."')\">".$row['STAFFTYPE_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_substafftype(){
	 global $conn;
	 $sql = "SELECT * FROM REF_SUBSTAFFTYPE";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['SUBSTAFFTYPE_ID']."')\">".$row['SUBSTAFFTYPE_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_time_contact(){
	 global $conn;
	 $sql = "SELECT * FROM REF_TIME_CONTACT";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['TIME_CONTACT_ID']."')\">".$row['TIME_CONTACT_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}

function data_traintype(){
	 global $conn;
	 $sql = "SELECT * FROM REF_TRAINTYPE";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['CODE_TRAINTYPE']."')\">".$row['NAME_TRAINTYPE']."</td></tr>";
	 }
	 
	 print "</table>";
}




function data_budget(){
	 global $conn;
	 $sql = "SELECT * FROM REF_BUDGET";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['BUDGET_ID']."')\">".$row['BUDGET_NAME']."</td></tr>";
	 }
	 
	 print "</table>";
}



function data_department_group(){
	 global $conn;
	 $sql = "SELECT * FROM REF_BUDGET";
     $stid = oci_parse($conn, $sql );
	 oci_execute($stid);
	 print "<table border='0' cellpadding='5' align='center'  >";
	 $n=0;
	 while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 
	 	if($bgcolor=="#CCCCCC"){
			$bgcolor="#EBEBEB";
		}
		else{
			$bgcolor="#CCCCCC";
		}
		$n++;
		echo "\n<tr bgcolor='".$bgcolor."'><td align='right'>$n.</td><td width='350' align='left'><samp style='cursor:pointer' title='เลือก' onclick=\"select_data_table('".$_POST["return_text"]."','".$_POST["return_output"]."','".$row['CODE_DEPARTMENT_GROUP']."')\">".$row['NAME_DEPARTMENT_GROUP']."</td></tr>";
	 }
	 
	 print "</table>";
}




$fc=$_POST["fc"];
switch($fc){
	case "data_department" : data_department(); break;
	case "data_department_sub" : data_department_sub(); break;
	case "data_admin" : data_admin(); break;
	case "data_extra_salary" : data_extra_salary(); break;
	case "data_fac" : data_ref_fac(); break;
	case "data_lev" : data_lev(); break;
	case "data_position" : data_position(); break;
	case "data_program" : data_program(); break;
	case "data_salary_source" : data_salary_source(); break; 
	case "data_staff_lev" : data_staff_lev(); break;
	case "data_stafftype" : data_stafftype(); break;
	case "data_stafftype_pair" : data_stafftype_pair(); break;
	case "data_substafftype" : data_substafftype(); break;
	case "data_traintype" : data_traintype(); break;
	case "data_budget" : data_budget(); break;
	case "data_department_group" : data_department_group(); break;
}

?>