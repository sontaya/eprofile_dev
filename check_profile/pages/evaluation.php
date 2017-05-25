<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_evaluation" name="chk_evaluation" value="1" onChange="check_radio('evaluation')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_evaluation" name="chk_evaluation" value="2" onChange="check_radio('evaluation')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การประเมินการทำงาน" disabled="disabled" id="bt_evaluation" name="bt_evaluation">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_APPRAISE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">การปะรเมินการทำงาน</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเภท</div>
      <div class="form-control"><?=$row["APR_TYPE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ปีการศึกษา</div>
      <div class="form-control"><?=$row["APR_YEAR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ผลการประเมิน</div>
      <div class="form-control"><? switch($row["APR_RESULT"]){ case '5' : echo "ดีเยี่ยม"; break; case '4' : echo "ดีมาก"; break; case '3' : echo "ดี"; break; case '2' : echo "พอใช้"; break; case '1' : echo "ต้องปรับปรุง"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ได้คะแนน</div>
      <div class="form-control"><?=$row["APR_SCORE"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
