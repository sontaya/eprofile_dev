<?
$fpath = '../';
require_once($fpath."includes/connect.php");
if($_POST["id"] == "") $where = "99999"; 
else $where = $_POST["id"];

 $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$where."'  ORDER BY NAME_DEPARTMENT_SECTION ASC "; 
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
		if($row["CWK_MUA_SUBMAIN"] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
	}
	?>
     <select name="cwk_mua_submain" id="cwk_mua_submain"   onchange="load_depsub2(this.value)" style="width:480px;">
	<?=$option_ref_department_sub?>
            </select>    


<?
$db->closedb($conn);
?>