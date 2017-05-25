<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_training" name="chk_training" value="1" onChange="check_radio('training')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_training" name="chk_training" value="2" onChange="check_radio('training')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การอบรมสัมมนา" disabled="disabled" id="bt_training" name="bt_training">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_SEMINAR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">การอบรมสมัมนา</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เลขที่คำสั่ง</div>
      <div class="form-control"><?=$row["SEM_ORDER_NO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเภท</div>
      <div class="form-control">
	  <?
      $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >0 AND ORDER_NO <9) AND CODE_TRAINTYPE = '".$row["SEM_TYPE"]."'  ";
      $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
      oci_execute($stid_ref_traintype);
      $row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH);
      $option_ref_traintype = $row_ref_traintype["NAME_TRAINTYPE"];
	  echo $option_ref_traintype."(".$row["SEM_TYPE_COURSE"].")";
      ?>
      </div>
    </div>
  </div>
  <div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">ชื่อหลักสูตร</div>
      <div class="form-control"><?=$row["SEM_COURSE_NAME"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เริ่มเข้าอบรม</div>
      <div class="form-control"><?=$row["SEM_START_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันสิ้นสุดการอบรม</div>
      <div class="form-control"><?=$row["SEM_END_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ระยะเวลาในการอบรม</div>
      <div class="form-control"><?=$row["SEM_LONG"]?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">สถานที่จัดอบรม</div>
      <div class="form-control"><?=$row["SEM_PLACE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หน่วยงานที่จัด</div>
      <div class="form-control"><?=$row["SEM_BY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จุดประสงค์ของการอบรม</div>
      <div class="form-control"><?=$row["SEM_POINT"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ค่าใช้จ่าย</div>
      <div class="form-control"><? switch($row["SEM_EXPENSE"]){ case '1' : echo "ไม่เสียค่าใช้จ่ายเนื่องจาก (".$row["SEM_FREE_EXPENSE"].")"; break; case '2' : echo "เสียค่าใช้จ่ายทั้งสิ้นเป็นเงิน (".$row["SEM_EXPENSE"].")"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเภทเงิน</div>
      <div class="form-control"><?=$row["SEM_MONEY_TYPE"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
