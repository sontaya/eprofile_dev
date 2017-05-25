<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_renew" name="chk_renew" value="1" onChange="check_radio('renew')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_renew" name="chk_renew" value="2" onChange="check_radio('renew')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ประวัติข้อมูลการต่อสัญญา" disabled="disabled" id="bt_renew" name="bt_renew">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_CONTRACT_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">ประวัติข้อมูลการต่อสัญญา</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำแหน่งปัจจุบัน</div>
      <div class="form-control"><? switch($row["CONTRACT_POSITION"]){ case '1' : echo "เจ้าหน้าที่"; break; case '2' : echo "อาจารย์"; break; case '3' : echo "ผศ."; break; case '4' : echo "รศ."; break; case '5' : echo "ศ."; break; case '6' : echo "ที่ปรึกษา"; break; case '7' : echo "ครู"; break; case '8' : echo "ผู้บริหาร"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตําเเหน่งประเภทบุคลากร</div>
		<?
        $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID='".$row["CK_MUA_EMP_TYPE"]."' ";
        $stid_emp_type = oci_parse($conn, $sql_emp_type );
        oci_execute($stid_emp_type);
	    $option_emp_type = $row_emp_type["STAFFTYPE_NAME"];
        ?>
      <div class="form-control"><?=$option_emp_type?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สัญญาระยะที่</div>
      <div class="form-control"><?=$row["CONTRACT_PREIOD"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จำนวนปี</div>
      <div class="form-control"><?=$row["CONTRACT_YEAR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำสั่ง</div>
      <div class="form-control"><?=$row["DIRECTIVE"]?> ที่ <?=$row["DIRECTIVE_NO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">บันทึกข้อความที่</div>
      <div class="form-control"><?=$row["SCH_ORDER_NO"]?> ที่ <?=$row["SCH_AT"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ลงวันที่</div>
      <div class="form-control"><?=$row["SCH_AT_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ครั้งที่จ้าง</div>
      <div class="form-control"><?=$row["EMPLOY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เลขที่สัญญา</div>
      <div class="form-control"><?=$row["CONTRACT_NO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันเริ่มสัญญา</div>
      <div class="form-control"><?=$row["CONTRACT_START"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันสิ้นสุดสัญญา</div>
      <div class="form-control"><?=$row["CONTRACT_FINISH"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
