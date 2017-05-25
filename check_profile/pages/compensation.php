<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_compensation" name="chk_compensation" value="1" onChange="check_radio('compensation')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_compensation" name="chk_compensation" value="2" onChange="check_radio('compensation')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลค่าตอบแทน" disabled="disabled" id="bt_compensation" name="bt_compensation">ข้อมูลไม่ถูกต้อง</button></div>
  <div class="alert alert-success" role="alert">ข้อมูลค่าตอบแทน</div>
</div>
<?
$sql = "SELECT * FROM  ".TB_SDU_DATA_ANSWER_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำสั่ง</div>
      <div class="form-control"><?=$row["DA_ORDER_NO"]?> ที่ <?=$row["DA_AT"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สั่ง ณ วันที่</div>
      <div class="form-control"><?=$row["DA_AT_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ประเภทงบประมาณ</div>
		<? 
        $sql_ex1 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY." WHERE ID = '".$row["TYPE_MUNNY"]."' "; 
        $stid_ex1 = oci_parse($conn, $sql_ex1 );
        oci_execute($stid_ex1);
        $row_ex1 = oci_fetch_array($stid_ex1, OCI_BOTH);
        ?>
      <div class="form-control"><?=$row_ex1["NAME"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">แหล่งงบประมาณ</div>
		<? 
        $sql_ex1 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE." WHERE CODE_SALARY_SOURCE = '".$row["LOCATION_MUNNY"]."' "; 
        $stid_ex1 = oci_parse($conn, $sql_ex1 );
        oci_execute($stid_ex1);
        $row_ex1 = oci_fetch_array($stid_ex1, OCI_BOTH);
        ?>
      <div class="form-control"><?=$row_ex1["NAME_SALARY_SOURCE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จำนวนเงิน</div>
      <div class="form-control"><?=$row["MUNNY_DA"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เริ่ม</div>
      <div class="form-control"><?=$row["START_DATES"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่สิ้นสุด</div>
      <div class="form-control"><?=$row["END_DATES"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
