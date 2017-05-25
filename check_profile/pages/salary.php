<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_salary" name="chk_salary" value="1" onChange="check_radio('salary')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_salary" name="chk_salary" value="2" onChange="check_radio('salary')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลการปรับเปลี่ยนตำแหน่ง/สายงาน/เงินเดือน" disabled="disabled" id="bt_salary" name="bt_salary">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM ".TB_SDU_CHANGE_JOB_TAB." scjt, ".TB_REF_DEPARTMENT." rd, ".TB_REF_DEPARTMENT_SUB." rds, ".TB_REF_SITE." rsite WHERE SCJT.EMP_ID='".$_SESSION["EMP_ID"]."' AND SCJT.CJ_MUA_MAIN_TEST=RD.CODE_FACULTY AND SCJT.CJ_MUA_SUBMAIN_TEST=RDS.CODE_DEPARTMENT_SECTION AND SCJT.CJ_DSU_EDU_CENTER=RSITE.CODE_SITE AND RD.CODE_FACULTY=RDS.CODE_FACULTY ";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
?>
<br />
<div class="row">
	<div class="alert alert-success" role="alert">ข้อมูลการปรับเปลี่ยนตำเเหน่ง/สายงาน/เงินเดือน</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำสั่ง</div>
      <div class="form-control"><?=$row["CJ_ORDER_NO"]?> ที่ <?=$row["CJ_AT"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สั่ง ณ วันที่</div>
      <div class="form-control"><?=$row["CJ_AT_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">อาจารย์พี่เลี้ยง</div>
      <div class="form-control"><?=$row["CJ_INSTRUCTOR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานหลักที่ทดลองสอน</div>
      <div class="form-control"><?=$row["NAME_FACULTY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานย่อยที่ทดลองสอน</div>
      <div class="form-control"><?=$row["NAME_DEPARTMENT_SECTION"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ศูนย์การศึกษาที่ทดลองสอน</div>
      <div class="form-control"><?=$row["NAME_SITE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เริ่มต้นทดลองสอน</div>
      <div class="form-control"><?=$row["START_DATES"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่สิ้นสุด</div>
      <div class="form-control"><?=$row["END_DATES"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ภาคการศึกษาที่ทดลองสอน</div>
      <div class="form-control"><?=$row["TERM_TEST"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ผลการทดสองสอน</div>
      <div class="form-control"><? switch($row["TEST_TYPE"]){ case '1' : echo "ผ่านการทดลองสอน"; break; case '2' : echo "ไม่ผ่าน"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon ">คำสั่ง</div>
      <div class="form-control"><?=$row["CJ_ORDER_NO_TWO"]?> ที่ <?=$row["CJ_AT_TWO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สั่ง ณ วันที่</div>
      <div class="form-control"><?=$row["CJ_AT_DATE_TWO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ตำเเหน่งเดิม ประเภทบุคลากร</div>
      <?
		$sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID='".$row["CJ_MUA_EMP_TYPE"]."'";
		$stid_emp_type = oci_parse($conn, $sql_emp_type );
		oci_execute($stid_emp_type);
		$row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH);
		$option_emp_type = $row_emp_type["STAFFTYPE_NAME"];
	  ?>
      <div class="form-control"><?=$option_emp_type?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานหลัก</div>
		<?
        $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY = '".$row["CJ_MUA_MAIN"]."' ";
        $stid_ref_department = oci_parse($conn, $sql_ref_department);
        oci_execute($stid_ref_department);
        $row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH);
		$option_ref_department = $row_ref_department["NAME_FACULTY"];
        ?>
      <div class="form-control"><?=$option_ref_department?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานย่อย</div>
		<?
        $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION = '".$row["CJ_MUA_SUBMAIN"]."' AND CODE_FACULTY = '".$row["CJ_MUA_MAIN"]."' ";
        $stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
        oci_execute($stid_ref_department_sub);
        $row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH);
		$option_ref_department_sub = $row_ref_department_sub["NAME_DEPARTMENT_SECTION"];
        ?>
      <div class="form-control"><?=$row_ref_department_sub?></div>
    </div>
  </div>
<div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ศูนย์การศึกษา</div>
		<?
        $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE = '".$row["CJ_DSU_EDU_CENER2"]."' ";
        $stid_ref_site = oci_parse($conn, $sql_ref_site);
        oci_execute($stid_ref_site);
        $row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH);
        $option_ref_site = $row_ref_site["NAME_SITE"];
        ?>
      <div class="form-control"><?=$option_ref_site?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เงินเดือนเดิม</div>
      <div class="form-control"><?=$row["CJ_MUNNY_HISTORY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ตำเเหน่งใหม่ ประเภทบุคลากร</div>
		<?
        $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID = '".$row["CJ_MUA_EMP_TYPE2"]."' ";
        $stid_emp_type = oci_parse($conn, $sql_emp_type );
        oci_execute($stid_emp_type);
        $row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH);
        $option_emp_type = $row_emp_type["STAFFTYPE_NAME"];
        ?>
      <div class="form-control"><?=$option_emp_type?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานหลัก</div>
		<?
        $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY = '".$row["CJ_MUA_MAIN2"]."' ";
        $stid_ref_department = oci_parse($conn, $sql_ref_department);
        oci_execute($stid_ref_department);
        $row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH);
		$option_ref_department = $row_ref_department["NAME_FACULTY"];
        ?>
      <div class="form-control"><?=$option_ref_department?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานย่อย</div>
		<?
        $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION = '".$row["CJ_MUA_SUBMAIN2"]."' AND CODE_FACULTY = '".$row["CJ_MUA_MAIN2"]."' ";
        $stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
        oci_execute($stid_ref_department_sub);
        $row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH);
		$option_ref_department_sub = $row_ref_department_sub["NAME_DEPARTMENT_SECTION"];
        ?>
      <div class="form-control"><?=$row_ref_department_sub?></div>
    </div>
  </div>
<div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ศูนย์การศึกษา</div>
		<?
        $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE = '".$row["CJ_DSU_EDU_CENTER2"]."' ";
        $stid_ref_site = oci_parse($conn, $sql_ref_site);
        oci_execute($stid_ref_site);
        $row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH);
        $option_ref_site = $row_ref_site["NAME_SITE"];
        ?>
      <div class="form-control"><?=$option_ref_site?></div>
    </div>
  </div>
<div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ตําเเหน่งงานใหม่</div>
<?
		$sql_position = "SELECT *  FROM  ".TB_POSITION." WHERE CODE = '".$row["CJ_CURRENT_HISTORY2"]."' ";
		$stid_position = oci_parse($conn, $sql_position);
		oci_execute($stid_position);
		$row_position = oci_fetch_array($stid_position, OCI_BOTH);
		$option_position = $row_position["POSITION"];
?>
	  <div class="form-control"><?=$option_position?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เงินเดือนใหม่</div>
      <div class="form-control"><?=$row["CJ_MUNNY_HISTORY2"]?></div>
    </div>
  </div>
<div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">มีผลตั้งเเต่</div>
      <div class="form-control"><?=$row["START_CJ"]?></div>
    </div>
  </div>
</div>
<?
}
?>