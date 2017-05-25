<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_lecturer" name="chk_lecturer" value="1" onChange="check_radio('lecturer')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_lecturer" name="chk_lecturer" value="2" onChange="check_radio('lecturer')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การเป็นวิทยากร อาจารย์พิเศษ" disabled="disabled" id="bt_lecturer" name="bt_lecturer">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_CONSTRUCTOR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">การเป็นวิทยากร อาจารย์พิเศษ</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเภท</div>
      <div class="form-control">
	  <?
      $sql_ref_traintype = "SELECT * FROM " . TB_REF_TRAINTYPE . " WHERE (ORDER_NO >8 AND ORDER_NO <11) AND CODE_TRAINTYPE = '".$row["CON_TYPE"]."'  ";
      $stid_ref_traintype = oci_parse($conn, $sql_ref_traintype);
      oci_execute($stid_ref_traintype);
      $row_ref_traintype = oci_fetch_array($stid_ref_traintype, OCI_BOTH);
      $option_ref_traintype = $row_ref_traintype["NAME_TRAINTYPE"];
	  echo $option_ref_traintype;
      ?>
      </div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เลขที่คำสั่ง</div>
      <div class="form-control"><?=$row["CON_ORDER_NO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">ชื่อหลักสูตร</div>
      <div class="form-control"><?=$row["CON_COURSE_NAME"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เริ่ม</div>
      <div class="form-control"><?=$row["CON_START_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่เสร็จสิ้น</div>
      <div class="form-control"><?=$row["CON_END_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">สถานที่</div>
      <div class="form-control"><?=$row["CON_PLACE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
      <div class="form-control"><?=$row["CON_COUNTRY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ระดับความสำคัญ</div>
      <div class="form-control"><? switch($row["CON_LEVEL"]){ case '1' : echo "ระดับชาติ"; break; case '2' : echo "ระดับนานาชาติ"; break; } ?></div>
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
