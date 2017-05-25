<?
$fpath = '../';
require_once($fpath."includes/connect.php");
if($_POST["id"] == "") $where = "99999"; 
else $where = $_POST["id"];

 $sql_ref_department_group = "SELECT * FROM  ".TB_REF_DEPARTMENT_GROUP."  WHERE CODE_DEPARTMENT_SUB = '".$where."'  ORDER BY NAME_DEPARTMENT_GROUP ASC "; 
	$stid_ref_department_group = oci_parse($conn, $sql_ref_department_group);
	oci_execute($stid_ref_department_group);
	$option_ref_department_group="<option value=''>เลือก</option>";
	while(($row_ref_department_group = oci_fetch_array($stid_ref_department_group, OCI_BOTH))){
		if($row["CWK_MUA_WORK_GROUP"] == $row_ref_department_group["CODE_DEPARTMENT_GROUP"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_group .= "<option value='".$row_ref_department_group["CODE_DEPARTMENT_GROUP"]."' $select>".$row_ref_department_group["NAME_DEPARTMENT_GROUP"]."</option>\n";
	}
	?>
             <select name="cwk_mua_work_group" id="cwk_mua_work_group" style="width:480px;">
               <?=$option_ref_department_group?>
             </select>


<?
$db->closedb($conn);
?>