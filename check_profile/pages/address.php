<?
$sql = "SELECT * FROM  ".TB_CEN_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_address" name="chk_address" value="1" onChange="check_radio('address')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_address" name="chk_address" value="2" onChange="check_radio('address')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน" disabled="disabled" id="bt_address" name="bt_address">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<div class="row">
  <div class="alert alert-success" role="alert">ที่อยู่ตามทะเบียนบ้าน</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">บ้านเลขที่</div>
      <div class="form-control"><?=$row["CA_HOUSE_NO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่</div>
      <div class="form-control"><?=$row["CA_MOO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตึก/อาคาร</div>
      <div class="form-control"><?=$row["CA_BUILDING"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่บ้าน</div>
      <div class="form-control"><?=$row["CA_VILLAGE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ห้อง</div>
      <div class="form-control"><?=$row["CA_ROOM"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ซอย</div>
      <div class="form-control"><?=$row["CA_SOI"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ถนน</div>
      <div class="form-control"><?=$row["CA_ROAD"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำบล/แขวง</div>
    <?
	$sql_ca_tumbon = "SELECT * FROM  ".TB_REF_TUMBON."  WHERE  CODE_REF_TUMBON = '".$row["CA_TUMBON"]."' "; 
	$stid_ca_tumbon = oci_parse($conn, $sql_ca_tumbon);
	oci_execute($stid_ca_tumbon);
	$row_ca_tumbon = oci_fetch_array($stid_ca_tumbon, OCI_BOTH);
		$option_ca_tumbon = $row_ca_tumbon["NAME_REF_TUMBON"];
	?>
      <div class="form-control"><?=$option_ca_tumbon?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">อำเภอ/เขต</div>
	<?
    $sql_ca_amphur = "SELECT * FROM  ".TB_REF_AMPHUR." WHERE  CODE_REF_AMPHUR = '".$row["CA_AMPHUR"]."'  "; 
    $stid_ca_amphur = oci_parse($conn, $sql_ca_amphur);
    oci_execute($stid_ca_amphur);
    $row_ca_amphur = oci_fetch_array($stid_ca_amphur, OCI_BOTH);
    $option_ca_amphur=$row_ca_amphur["NAME_REF_AMPHUR"];
    ?>
      <div class="form-control"><?=$option_ca_amphur?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จังหวัด</div>
	<?
    $sql_ca_province = "SELECT * FROM  ".TB_REF_PROVINCE."  WHERE  CODE_REF_PROVINCE = '".$row["CA_PROVINCE"]."' "; 
    $stid_ca_province = oci_parse($conn, $sql_ca_province);
    oci_execute($stid_ca_province);
    $row_ca_province = oci_fetch_array($stid_ca_province, OCI_BOTH);
    $option_ca_province = $row_ca_province["NAME_REF_PROVINCE"];
    ?>
      <div class="form-control"><?=$option_ca_province?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">รหัสไปรษณีย์</div>
      <div class="form-control"><?=$row["CA_POST_CODE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
	<?
    $sql_cu_country = "SELECT * FROM  ".TB_REF_NATION."  WHERE NATION_ID = '".$row["CA_COUNTRY"]."' ORDER BY NATION_NAME_TH ASC "; 
    $stid_cu_country = oci_parse($conn, $sql_cu_country);
    oci_execute($stid_cu_country);
    $row_cu_country = oci_fetch_array($stid_cu_country, OCI_BOTH);
    $name_country2 = $row_cu_country["NATION_NAME_TH"];
    ?>
      <div class="form-control"><?=$name_country2?>&nbsp;</div>
    </div>
  </div>
</div>
<?
$sql = "SELECT * FROM  ".TB_CURRENT_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?> 
<div class="row">
  <div class="alert alert-success">ที่อยู่ปัจจุบัน</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">บ้านเลขที่</div>
      <div class="form-control"><?=$row["CU_HOUSE_NO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่</div>
      <div class="form-control"><?=$row["CU_MOO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตึก/อาคาร</div>
      <div class="form-control"><?=$row["CU_BUILDING"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่บ้าน</div>
      <div class="form-control"><?=$row["CU_VILLAGE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ห้อง</div>
      <div class="form-control"><?=$row["CU_ROOM"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ซอย</div>
      <div class="form-control"><?=$row["CU_SOI"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ถนน</div>
      <div class="form-control"><?=$row["CU_ROAD"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำบล/แขวง</div>
    <?
	$sql_ca_tumbon = "SELECT * FROM  ".TB_REF_TUMBON."  WHERE  CODE_REF_TUMBON = '".$row["CU_TUMBON"]."' "; 
	$stid_ca_tumbon = oci_parse($conn, $sql_ca_tumbon);
	oci_execute($stid_ca_tumbon);
	$row_ca_tumbon = oci_fetch_array($stid_ca_tumbon, OCI_BOTH);
		$option_ca_tumbon = $row_ca_tumbon["NAME_REF_TUMBON"];
	?>
      <div class="form-control"><?=$option_ca_tumbon?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">อำเภอ/เขต</div>
	<?
    $sql_ca_amphur = "SELECT * FROM  ".TB_REF_AMPHUR." WHERE  CODE_REF_AMPHUR = '".$row["CU_AMPHUR"]."'  "; 
    $stid_ca_amphur = oci_parse($conn, $sql_ca_amphur);
    oci_execute($stid_ca_amphur);
    $row_ca_amphur = oci_fetch_array($stid_ca_amphur, OCI_BOTH);
    $option_ca_amphur=$row_ca_amphur["NAME_REF_AMPHUR"];
    ?>
      <div class="form-control"><?=$option_ca_amphur?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จังหวัด</div>
	<?
    $sql_ca_province = "SELECT * FROM  ".TB_REF_PROVINCE."  WHERE  CODE_REF_PROVINCE = '".$row["CU_PROVINCE"]."' "; 
    $stid_ca_province = oci_parse($conn, $sql_ca_province);
    oci_execute($stid_ca_province);
    $row_ca_province = oci_fetch_array($stid_ca_province, OCI_BOTH);
    $option_ca_province = $row_ca_province["NAME_REF_PROVINCE"];
    ?>
      <div class="form-control"><?=$option_ca_province?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">รหัสไปรษณีย์</div>
      <div class="form-control"><?=$row["CU_POST_CODE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
	<?
    $sql_cu_country = "SELECT * FROM  ".TB_REF_NATION."  WHERE NATION_ID = '".$row["CU_COUNTRY"]."' ORDER BY NATION_NAME_TH ASC "; 
    $stid_cu_country = oci_parse($conn, $sql_cu_country);
    oci_execute($stid_cu_country);
    $row_cu_country = oci_fetch_array($stid_cu_country, OCI_BOTH);
    $name_country2 = $row_cu_country["NATION_NAME_TH"];
    ?>
      <div class="form-control"><?=$name_country2?>&nbsp;</div>
    </div>
  </div>
</div>
