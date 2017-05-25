<?
if ($row["BIO_BIRTHDAY"] != "") {
  $bio_birthday = change_date_thai($row["BIO_BIRTHDAY"]);
} else {
  $bio_birthday = "";
}
if ($row["BIO_ID_DATE_BEGIN"] != "") {
  $bio_id_date_begin = change_date_thai($row["BIO_ID_DATE_BEGIN"]);
} else {
  $bio_id_date_begin = "";
}

if ($row["BIO_ID_DATE_EXP"] != "") {
  $bio_id_date_exp = change_date_thai($row["BIO_ID_DATE_EXP"]);
} else {
  $bio_id_date_exp = "";
}

if ($row["BIO_GOV_ID_DATE_BEGIN"] != "") {
  $bio_gov_id_date_begin = change_date_thai($row["BIO_GOV_ID_DATE_BEGIN"]);
} else {
  $bio_gov_id_date_begin = "";
}

if ($row["BIO_GOV_ID_DATE_EXP"] != "") {
  $bio_gov_id_date_exp = change_date_thai($row["BIO_GOV_ID_DATE_EXP"]);
} else {
  $bio_gov_id_date_exp = "";
}
?>
<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_profile" name="chk_profile" value="1" onclick="check_radio('profile')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_profile" name="chk_profile" value="2" onChange="check_radio('profile')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลเบื้องต้น" disabled="disabled" id="bt_profile" name="bt_profile">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ยศ/ตำแหน่ง</div>
      <div class="form-control"><?=$row["BIO_TITILE2_TH"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-8">
    <div class="input-group">
      <div class="input-group-addon">ฐานันดร/บรรดาศักดิ์พระราชทาน</div>
      <div class="form-control"><?=$row["BIO_TITLE3_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำนำหน้า</div>
      <div class="form-control"><?=$row["BIO_TITLE_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อ</div>
      <div class="form-control"><?=$row["BIO_FNAME_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อกลาง</div>
      <div class="form-control"><?=$row["BIO_MNAME_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">นามสกุล</div>
      <div class="form-control"><?=$row["BIO_LNAME_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Title</div>
      <div class="form-control"><?=$row["BIO_TITLE_EN"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Fname</div>
      <div class="form-control"><?=$row["BIO_FNAME_EN"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Mname</div>
      <div class="form-control"><?=$row["BIO_MNAME_EN"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">Lname</div>
      <div class="form-control"><?=$row["BIO_LNAME_EN"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon ">เพศ</div>
      <div class="form-control"><? switch($row["BIO_SEX"]) { case '1' : echo "ชาย"; break; case '2' : echo "หญิง"; break; } ?></div>
    </div>
  </div>
  <?
  $sql_bio_nation1 = "SELECT * FROM  " . TB_REF_NATION . "  WHERE  NATION_ID = '" . $row["BIO_NATION1"] . "'";
  $stid_bio_nation1 = oci_parse($conn, $sql_bio_nation1);
  oci_execute($stid_bio_nation1);
  $option_bio_nation1 = "";
  while (($row_bio_nation1 = oci_fetch_array($stid_bio_nation1, OCI_BOTH))) {
    if ($row_bio_nation1["NATION_NAME_TH"] == "" or $row_bio_nation1["NATION_NAME_TH"] == NULL)
      $name_country = $row_bio_nation1["NATION_NAME_ENG"];
    else
      $name_country = $row_bio_nation1["NATION_NAME_TH"];
    //if($row["BIO_NATION1"] == $row_bio_nation1["NATION_ID"]){ $select="selected = 'selected'";}else{ $select="";}
    $option_bio_nation1 .= "<option value='" . $row_bio_nation1["NATION_ID"] . "' selected='selected'>" . $name_country . "</option>\n";
  }
  ?>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">เชื้อชาติ</div>
      <div class="form-control"><?= $name_country ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon"><span class="form_text">สัญชาติ</span></div>
      <div class="form-control"><?= $name_country ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ศาสนา</div>
		<?
        $sql_bio_religion = "SELECT * FROM  " . TB_REF_RELIGION . "  WHERE RELIGION_ID='".$row["BIO_RELIGION"]."' ORDER BY RELIGION_ID ASC ";
        $stid_bio_religion = oci_parse($conn, $sql_bio_religion);
        oci_execute($stid_bio_religion);
        $row_bio_religion = oci_fetch_array($stid_bio_religion, OCI_BOTH);
        ?>
      <div class="form-control"><?=$row_bio_religion["RELIGION_NAME_TH"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ว/ด/ป เกิด</div>
      <div class="form-control"><?= $bio_birthday ?></div>
    </div>
  </div>
<div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon"><? if (strlen($row["PERSON_ID"]) == 13) { echo "เลขประจำตัวประชาชน"; } else{ echo "Passport"; } ?></div>
      <div class="form-control"><?= $row["PERSON_ID"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ออกให้ ณ</div>
      <div class="form-control"><?= $row["BIO_ID_FROM"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">จังหวัด</div>
		<?
        $sql_bio_id_from_p = "SELECT * FROM  " . TB_REF_PROVINCE . " WHERE CODE_REF_PROVINCE='".$row["BIO_ID_FROM_P"]."' ORDER BY NAME_REF_PROVINCE ASC ";
        $stid_bio_id_from_p = oci_parse($conn, $sql_bio_id_from_p);
        oci_execute($stid_bio_id_from_p);
        $option_bio_id_from_p = "<option value='0'>เลือก</option>";
        $row_bio_id_from_p = oci_fetch_array($stid_bio_id_from_p, OCI_BOTH);
        ?>
      <div class="form-control"><?=$row_bio_id_from_p["NAME_REF_PROVINCE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันออกบัตร</div>
      <div class="form-control"><?= $bio_id_date_begin; ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันบัตรหมดอายุ</div>
      <div class="form-control"><?= $bio_id_date_exp; ?></div>
    </div>
  </div>
<div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">เลขประจำตัวผู้เสียภาษี</div>
      <div class="form-control"><?= $row["BIO_TAX_ID"]; ?></div>
    </div>
  </div>
<div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">เลขที่บัตรข้าราชการ</div>
      <div class="form-control"><?= $row["BIO_GOV_ID"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันออกบัตร</div>
      <div class="form-control"><?= $bio_gov_id_date_begin ?></div>
    </div>
  </div>
<div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันบัตรหมดอายุ</div>
      <div class="form-control"><?= $bio_gov_id_date_exp ?></div>
    </div>
  </div>
<div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">Work Permit</div>
      <div class="form-control"><?=$row["BIO_WORK_PERMIT"]?></div>
    </div>
  </div>
<div class="form-group col-md-12">
    <div class="input-group">
      <div class="input-group-addon">เลขบัตรบุคลากร</div>
      <div class="form-control"><?=$row["EMP_ID"]?></div>
    </div>
  </div>
<div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">เลขที่บัญชีธนาคาร</div>
      <div class="form-control"><?=$row["BIO_BANK_ACC_ID"]?></div>
    </div>
  </div>
<div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">ธนาคาร</div>
      <div class="form-control"><?=$row["BIO_BANK"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">สถานภาพ</div>
      <div class="form-control"><? switch($row["BIO_STATUS"]) { case '1' : echo "โสด"; break; case '2' : echo "สมรส"; break; case '3' : echo "หย่า"; break; case '4' : echo "หม้าย"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon"><span class="form_text">หมู่เลือด</span></div>
      <div class="form-control"><? switch($row["BIO_BLOOD_GROUP"]) { case '1' : echo "A"; break; case '2' : echo "AB"; break; case '3' : echo "B"; break; case '4' : echo "O"; break; } ?>(<? switch($row["BIO_BLOOD_TYPE"]) { case 'plus' : echo "RH +"; break; case 'minus' : echo "RH -"; break; } ?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์ที่บ้าน</div>
      <div class="form-control"><?=$row["BIO_H_PHONE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">โทรสาร</div>
      <div class="form-control"><?=$row["BIO_H_FAX"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์มือถือ 1</div>
      <div class="form-control"><?=$row["BIO_MOBILE_1"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon ">โทรศัพท์มือถือ 2</div>
      <div class="form-control"><?=$row["BIO_MOBILE_2"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ห้องพักอาจารย์</div>
      <div class="form-control"><?= $row["BIO_ROOM_TEACHER"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">ผู้ติดต่อ(กรณีฉุกเฉิน)</div>
      <div class="form-control"><?= $row["BIO_NAME_EMER"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">โทรศัพท์</div>
      <div class="form-control"><?= $row["BIO_EMER_PHONE"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">e-mail ชื่อที่ 1</div>
      <div class="form-control"><?= $row["BIO_EMAIL1"]; ?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">e-mail ชื่อที่ 2</div>
      <div class="form-control"><?= $row["BIO_EMAIL2"]; ?></div>
    </div>
  </div>
</div>