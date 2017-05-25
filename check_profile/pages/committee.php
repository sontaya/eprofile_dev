<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_committee" name="chk_committee" value="1" onChange="check_radio('committee')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_committee" name="chk_committee" value="2" onChange="check_radio('committee')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การเป็นกรรมการภายนอก" disabled="disabled" id="bt_committee" name="bt_committee">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_COMMITTEE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">การเป็นที่ปรึกษา</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเภท</div>
		<?
        $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >11 AND ORDER_NO <15) AND CODE_TRAINTYPE = '".$row["COM_TYPE"]."' ";
        $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
        oci_execute($stid_ref_traintype);
        $row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH);
        $option_ref_traintype = $row_ref_traintype["NAME_TRAINTYPE"];
        ?>
      <div class="form-control"><?=$option_ref_traintype?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อ - สกุล นักศึกษา</div>
      <div class="form-control"><?=$row["COM_STUDENT_NAME"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ระดับการศึกษาของนักศึกษา</div>
      <div class="form-control"><? switch($row["COM_DEGREE"]){ case '1' : echo "ปริญญาโท"; break; case '2' : echo "ปริญญาเอก"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หลักสูตร/สาขาวิชา</div>
      <div class="form-control"><?=$row["COM_CURRICULUM"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ปีการศึกษา</div>
      <div class="form-control"><?=$row["COM_YEAR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">ชื่อหัวข้อวิทยานิพนธ์</div>
      <div class="form-control"><?=$row["COM_TOPIC"]?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">ชื่อหน่วยงานภายนอก</div>
      <div class="form-control"><?=$row["COM_ORG_NAME"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เริ่ม</div>
      <div class="form-control"><?=$row["COM_START_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เสร็จสิ้น</div>
      <div class="form-control"><?=$row["COM_END_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
      <div class="form-control"><?=$row["COM_COUNTRY"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
