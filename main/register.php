<table width="662" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="662">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="center"  style="background-repeat:repeat-y">
    
    <table width="601" border="0" align="center" cellpadding="3"  cellspacing="3">
  <tr><td width="601" height="415" valign="top">
  <form id="register" >
  <table width="511" border="0" cellspacing="3" cellpadding="3" align="center" >
  <tr>
    <td width="223" align="right" class="form_text">หมายเลขบุคลากร :</td>
    <td colspan="3" align="left">
   <input type="text" id="emp_id" name="emp_id"  maxlength="13" style="width: 150px" class="input_text"/></td>
  </tr>
  <tr>
    <td align="right">ชื่อล็อกอิน : </td>
    <td colspan="3" align="left"><input type="text" id="username" name="username" style="width: 100px" class="input_text"/></td>
  </tr>
  <tr>
    <td align="right">รหัสผ่าน :</td>
    <td colspan="3" align="left"><input type="password" id="password" name="password" style="width: 100px" class="input_text"/></td>
  </tr>
  <tr>
    <td align="right">กรอกรหัสผ่านอีกครั้ง :</td>
    <td colspan="3" align="left"><input type="password" id="password2" name="password2" style="width: 100px" class="input_text"/></td>
  </tr>
  <script language="javascript">
  function is_chief(data){
	  if(data == "chief")
	  document.getElementById("for_chief").style.display = "block";
	  else 
	  document.getElementById("for_chief").style.display = "none";
  }
  </script>
   <tr>
    <td align="right">ระดับผู้ใช้งาน : </td>
    <td colspan="3" align="left">
    <select id="user_type" name="user_type" onchange="is_chief(this.value)">
    <option value="user" selected="selected">ผู้ใช้ทั่วไป</option>
    <option value="chief">หัวหน้าหน่วยงาน</option>
    <option value="hr">ก.บ.</option>
    <option value="admin">ผู้ดูแลระบบ</option>
    <option value="finance">การเงิน</option>
    </select>
     </td>
  </tr>
  <tr>
    <td colspan="4" align="center"><div id="for_chief" style="display:none"><table width="469" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="208" align="right">หน่วยงานหลัก : </td>
        <td width="249" align="left"><?
		require_once("../includes/connect.php");
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC "; 
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value=''>เลือก</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' >".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
	?><select name="cwk_mua_main" id="cwk_mua_main" class="widthFix2" onchange="load_depsub(this.value)">
	<?=$option_ref_department?>
            </select>  
        </td>
      </tr>
      <tr>
        <td align="right"><span class="form_text">หน่วยงานย่อย
            <!--(มสด.)-->
:</span></td>
        <td align="left"><div id="ajax_depsub" ><?
			 if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$where."'  ORDER BY NAME_DEPARTMENT_SECTION ASC "; 
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' >".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
	}
	?><select name="cwk_mua_submain" id="cwk_mua_submain" class="widthFix2"  >
               <?=$option_ref_department_sub?>
             </select>
        </div>
        </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
    </table></div></td>
    </tr>
  <tr>
    <td height="39" align="right" valign="middle"><input type="button" value="เพิ่ม" onclick="register($('#emp_id').val(),$('#username').val(),$('#password').val(),$('#password2').val(),$('#user_type').val(),$('#cwk_mua_main').val(),$('#cwk_mua_submain').val())"/> </td>
    <td width="71" align="left" valign="middle"> <input type="button" value="เคลียร์"  onclick="document.getElementById('register').reset()"/> </td>
    <td width="187" colspan="2" align="left" valign="middle"><div id="wait"></div></td>
    </tr>
  <tr>
    <td height="34" colspan="4" align="right">&nbsp;</td>
    </tr>
</table>

  
  </form>

</td></tr></table>
      
    </td>
  </tr>
 
</table>
<?
$db->closedb($conn);
?>