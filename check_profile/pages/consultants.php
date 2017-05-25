<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_consultants" name="chk_consultants" value="1" onChange="check_radio('consultants')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_consultants" name="chk_consultants" value="2" onChange="check_radio('consultants')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การเป็นที่ปรึกษา" disabled="disabled" id="bt_consultants" name="bt_consultants">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_CONSULT_COMMIT_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
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
      <div class="form-control">ที่ปรึกษา</div>
    </div>
  </div>
  <div class="form-group col-md-9">
    <div class="input-group">
      <div class="input-group-addon">หัวข้อ</div>
      <div class="form-control"><?=$row["COM_COURSE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-12">
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
