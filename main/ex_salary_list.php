<?
@session_start();
$fpath = "../";
require_once($fpath."includes/connect.php");
$numrow = $db->count_row(TB_EXTRA_SALARY_TAB,"  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
if($numrow > 0){
?>
<table width="727" border="0" cellspacing="3" cellpadding="3" align="left">
<?
$sql_ex = "SELECT * FROM  ".TB_EXTRA_SALARY_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY EX_ID ASC"; 
$stid_ex = oci_parse($conn, $sql_ex );
oci_execute($stid_ex);
while($row_ex = oci_fetch_array($stid_ex, OCI_BOTH)){
	$sql_bud = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
	$stid_bud = oci_parse($conn, $sql_bud );
	oci_execute($stid_bud);

		$option_bud="<option value=''>เลือก</option>";

	while(($row_bud = oci_fetch_array($stid_bud, OCI_BOTH))){

			if($row_ex["EX_SOURCE"] == $row_bud["CODE_SALARY_SOURCE"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_bud .= "<option value='".$row_bud["CODE_SALARY_SOURCE"]."' $select>".$row_bud["NAME_SALARY_SOURCE"]."</option>";

	}
		
	
	$sql_ex2 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
	$stid_ex2 = oci_parse($conn, $sql_ex2 );
	oci_execute($stid_ex2);
	
	$option_ex2="<option value=''>เลือก</option>";
	
	while(($row_ex2 = oci_fetch_array($stid_ex2, OCI_BOTH))){
		
			 if($row_ex["EX_SALARY_REF"] == $row_ex2["ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ex2 .= "<option value='".$row_ex2["ID"]."' $select>".$row_ex2["NAME"]."</option>";

	}
	
	
?>
  <tr>
    <td width="285" align="right"  class="form_text"><select name="cwk_extra_salary1[]" style="width: 150px; text-align:right"><?=$option_ex2?></select></td>
    <td width="148" align="right" >จำนวน <input type="text" name="cwk_cost1[]"  style="width: 100px; text-align:right" class="input_text"  value="<?=number_format($row_ex["EX_SALARY"],2)?>"/></td>
    <td width="90" align="right" class="form_text">ใช้งบประมาณ</td>
    <td width="165" align="left" valign="middle" ><select  name="cwk_from1[]" style="width: 130px"><?=$option_bud?></select>
     <input type="hidden" name="ex_id[]" value="<?=$row_ex["EX_ID"]?>" /> <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" align="absmiddle" onclick="del_ex_salary('<?=$row_ex["EX_ID"]?>');"/></td>
  </tr>
  <?
}
  ?>
</table>

<?
}else{
$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
$stid_budget = oci_parse($conn, $sql_budget );
oci_execute($stid_budget);

	$option="<option value=''>เลือก</option>";

while(($row_budget = oci_fetch_array($stid_budget, OCI_BOTH))){
	
			$option .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' >".$row_budget["NAME_SALARY_SOURCE"]."</option>";
			
}


$sql_ex_salary = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
$stid_ex_salary = oci_parse($conn, $sql_ex_salary );
oci_execute($stid_ex_salary);

$option_ex_salary="<option value=''>เลือก</option>";

while(($row_ex_salary = oci_fetch_array($stid_ex_salary, OCI_BOTH))){

		$option_ex_salary .= "<option value='".$row_ex_salary["ID"]."'>".$row_ex_salary["NAME"]."</option>";
	
	
}
echo "<table width='100%' border='0' cellspacing='3' cellpadding='3' align='left'>";
 echo " <tr>";
 echo "   <td  align='right'  class='form_text'><select name='cwk_extra_salary[]' style='width: 260px; text-align:right'>".$option_ex_salary."</select></td>";
echo "    <td  align='right' >จำนวน <input type='text' name='cwk_cost[]'  style='width: 100px; text-align:right' class='input_text'  /></td>";
echo "    <td  align='right' class='form_text'>ใช้งบประมาณ</td>";
echo "    <td  align='left' ><select  name='cwk_from[]' style='width: 130px'>".$option."</select> </td>";
echo "  </tr>";
echo "</table>";

}
?>