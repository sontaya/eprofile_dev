<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_family" name="chk_family" value="1" onChange="check_radio('family')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_family" name="chk_family" value="2" onChange="check_radio('family')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลบิดามารดา" disabled="disabled" id="bt_family" name="bt_family">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	function relation($rel){
		switch($rel){
		case "1": $returntxt = "บิดา";
		break;
		case "2": $returntxt = "มารดา";
		break;
		case "3": $returntxt = "คู่สมรส";
		break;
		}
		return $returntxt;
	}

    $sql = "SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY FAM_RELATION ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
  <div class="alert alert-success" role="alert">ข้อมูล<span class="text_td"><?=relation($row["FAM_RELATION"])?></span></div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำนำหน้า</div>
      <div class="form-control"><?=$row["FAM_TITLE_TH"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อ</div>
      <div class="form-control"><?=$row["FAM_FNAME_TH"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อกลาง</div>
      <div class="form-control"><?=$row["FAM_MNAME_TH"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">นามสกุล</div>
      <div class="form-control"><?=$row["FAM_LNAME_TH"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Title</div>
      <div class="form-control"><?=$row["FAM_TITLE_EN"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Fname</div>
      <div class="form-control"><?=$row["FAM_FNAME_EN"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Mname</div>
      <div class="form-control"><?=$row["FAM_MNAME_EN"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Lname</div>
      <div class="form-control"><?=$row["FAM_LNAME_EN"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เพศ</div>
      <div class="form-control"><?=$row["FAM_SEX"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เชื้อชาติ</div>
	<?
    $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["FAM_NATION1"]."' ";
    $stid_nation = oci_parse($conn, $sql_nation);
    oci_execute($stid_nation);
    $row_nation = oci_fetch_array($stid_nation, OCI_BOTH);
    $option_nation = $row_nation["NATION_NAME_TH"];
    ?>
      <div class="form-control"><?=$option_nation?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สัญชาติ</div>
	<?
    $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["FAM_NATION2"]."' ";
    $stid_nation = oci_parse($conn, $sql_nation);
    oci_execute($stid_nation);
    $row_nation = oci_fetch_array($stid_nation, OCI_BOTH);
    $option_nation = $row_nation["NATION_NAME_TH"];
    ?>      
      <div class="form-control"><?=$option_nation?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ศาสนา</div>
	<?
    $sql_religion = "SELECT * FROM  ".TB_REF_RELIGION." WHERE RELIGION_ID = '".$row["FAM_RELIGION"]."' ";
    $stid_religion = oci_parse($conn, $sql_religion);
    oci_execute($stid_religion);
    $row_religion = oci_fetch_array($stid_religion, OCI_BOTH);
    $option_religion = $row_religion["RELIGION_NAME_TH"];
    ?>      
      <div class="form-control"><?=$option_religion?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ว/ด/ป เกิด</div>
      <div class="form-control"><?=$row["FAM_BIRTHDAY"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สถานะ</div>
      <div class="form-control"><? switch($row["FAM_ALIVE"]){ case '1': echo "มีชีวิต"; break; case '2': echo "ถึงแก่กรรม"; break; case '3': echo "สาบสูญ"; break; } ?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สถานภาพ</div>
      <div class="form-control"><? switch($row["FAM_STATUS"]){ case '1': echo "โสด"; break; case '2': echo "สมรส"; break; case '3': echo "หย่า"; break; case '4': echo "หม้าย"; break; } ?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">เลขประจำตัวประชาชน</div>
      <div class="form-control"><?=$row["FAM_CODE_ID"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จังหวัด</div>
	<?
    $sql_fam_id_from_p = "SELECT * FROM  " . TB_REF_PROVINCE . " WHERE CODE_REF_PROVINCE = '".$row["FAM_ID_FORM_P"]."' ";
    $stid_fam_id_from_p = oci_parse($conn, $sql_fam_id_from_p);
    oci_execute($stid_fam_id_from_p);
    $row_fam_id_from_p = oci_fetch_array($stid_fam_id_from_p, OCI_BOTH);
    $option_fam_id_from_p = $row_fam_id_from_p["NAME_REF_PROVINCE"];
    ?>
      <div class="form-control"><?= $option_fam_id_from_p ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันออกบัตร</div>
      <div class="form-control"><?=$row["FAM_ID_DATE_BEGIN"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">อาชีพ</div>
      <div class="form-control"><?=$row["FAM_OCCUPATION"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สถานที่ทำงาน</div>
      <div class="form-control"><?=$row["FAM_WORK_PLACE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์มือถือ</div>
      <div class="form-control"><?=$row["FAM_MOBILE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์ที่ทำงาน</div>
      <div class="form-control"><?=$row["FAM_WORK_PHONE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์บ้าน</div>
      <div class="form-control"><?=$row["FAM_PHONE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">โทรสาร</div>
      <div class="form-control"><?=$row["FAM_FAX"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">e-mail</div>
      <div class="form-control"><?=$row["FAM_EMAIL"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">บ้านเลขที่</div>
      <div class="form-control"><?=$row["FAM_HOUSE_NO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่</div>
      <div class="form-control"><?=$row["FAM_MOO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตึก/อาคาร</div>
      <div class="form-control"><?=$row["FAM_BUILDING"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่บ้าน</div>
      <div class="form-control"><?=$row["FAM_VILLAGE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ห้อง</div>
      <div class="form-control"><?=$row["FAM_ROOM"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ซอย</div>
      <div class="form-control"><?=$row["FAM_SOI"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ถนน</div>
      <div class="form-control"><?=$row["FAM_ROAD"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำบล/แขวง</div>
	<?
    $sql_tumbon = "SELECT * FROM  " . TB_REF_TUMBON . " WHERE CODE_REF_TUMBON = '".$row["FAM_TUMBON"]."' ";
    $stid_tumbon = oci_parse($conn, $sql_tumbon);
    oci_execute($stid_tumbon);
    $row_tumbon = oci_fetch_array($stid_tumbon, OCI_BOTH);
    $option_tumbon = $row_tumbon["NAME_REF_TUMBON"];
    ?>
      <div class="form-control"><?=$option_tumbon?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">อำเภอ/เขต</div>
	<?
    $sql_amphur = "SELECT * FROM  " . TB_REF_AMPHUR . " WHERE CODE_REF_AMPHUR = '".$row["FAM_AMPHUR"]."' ";
    $stid_amphur = oci_parse($conn, $sql_amphur);
    oci_execute($stid_amphur);
    $row_amphur = oci_fetch_array($stid_amphur, OCI_BOTH);
    $option_amphur = $row_amphur["NAME_REF_AMPHUR"];
    ?>
      <div class="form-control"><?=$option_amphur?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จังหวัด</div>
	<?
    $sql_province = "SELECT * FROM  ".TB_REF_PROVINCE." WHERE  CODE_REF_PROVINCE = '".$row["FAM_PROVINCE"]."' ";
    $stid_province = oci_parse($conn, $sql_province);
    oci_execute($stid_province);
    $row_province = oci_fetch_array($stid_province, OCI_BOTH);
    $option_province = $row_province["NAME_REF_PROVINCE"];
    ?>      
      <div class="form-control"><?=$option_province?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">รหัสไปรษณีย์</div>
      <div class="form-control"><?=$row["FAM_POST_CODE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
	<?
    $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["FAM_COUNTRY"]."' ";
    $stid_nation = oci_parse($conn, $sql_nation);
    oci_execute($stid_nation);
    $row_nation = oci_fetch_array($stid_nation, OCI_BOTH);
    $option_nation = $row_nation["NATION_NAME_TH"];
    ?>      
      <div class="form-control"><?=$option_nation?>&nbsp;</div>
    </div>
  </div>
</div>
<?
	}
?>
