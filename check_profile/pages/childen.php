<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_childen" name="chk_childen" value="1" onChange="check_radio('childen')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_childen" name="chk_childen" value="2" onChange="check_radio('childen')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลบุตร" disabled="disabled" id="bt_childen" name="bt_childen">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
    $sql = "SELECT * FROM  ".TB_CHILDREN_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY CHL_BIRTHDAY ASC"; 
//    $sql = "SELECT * FROM  ".TB_CHILDREN_TAB."  WHERE  EMP_ID= '1005-162' ORDER BY CHL_BIRTHDAY ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$i=1;
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">ข้อมูลบุตรคนที่ <?=$i?></div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำนำหน้า</div>
			<div class="form-control"><?=$row["CHL_TITLE_TH"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ชื่อ</div>
			<div class="form-control"><?=$row["CHL_FNAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ชื่อกลาง</div>
			<div class="form-control"><?=$row["CHL_MNAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">นามสกุล</div>
			<div class="form-control"><?=$row["CHL_LNAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">Title</div>
			<div class="form-control"><?=$row["CHL_TITLE_EN"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">Fname</div>
			<div class="form-control"><?=$row["CHL_FNAME_EN"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">Mname</div>
			<div class="form-control"><?=$row["CHL_MNAME_EN"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">Lname</div>
			<div class="form-control"><?=$row["CHL_LNAME_EN"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เพศ</div>
			<div class="form-control"><?=$row["CHL_SEX"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เชื้อชาติ</div>
			<?
            $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["CHL_NATION1"]."' ";
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
            $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["CHL_NATION2"]."' ";
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
            $sql_religion = "SELECT * FROM  ".TB_REF_RELIGION." WHERE  RELIGION_ID = '".$row["CHL_RELIGION"]."' ";
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
			<div class="form-control"><?=$row["CHL_BIRTHDAY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สถานศึกษา</div>
			<div class="form-control"><?=$row["CHL_SCHOOL"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">อำเภอ</div>
			<div class="form-control"><?=$row["CHL_SCH_AMPHUR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">จังหวัด</div>
			<div class="form-control"><?=$row["CHL_SCH_PROVINCE"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระดับการศึกษา</div>
			<div class="form-control"><?=$row["CHL_SCH_LEVEL"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">เลขประจำตัวประชาชน</div>
			<div class="form-control"><?=$row["CHL_CODE_ID"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ความสัมพันธ์</div>
			<div class="form-control"><? switch($row["CHL_SEX"]){ case '1': echo "โดยสายเลือด"; break; case '2': echo "ทะเบียนสมรส"; break; case '3': echo "บุตรบุญธรรม"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">อาชีพ</div>
            <div class="form-control"><?=$row["CHL_OCCUPATION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สถานที่ทำงาน</div>
			<div class="form-control"><?=$row["CHL_WORK_PLACE"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">โทรศัพท์มือถือ</div>
			<div class="form-control"><?=$row["CHL_MOBILE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">โทรศัพท์ที่ทำงาน</div>
			<div class="form-control"><?=$row["CHL_WORK_PHONE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">โทรศัพท์บ้าน</div>
			<div class="form-control"><?=$row["CHL_PHONE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">โทรสาร</div>
			<div class="form-control"><?=$row["CHL_FAX"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">e-mail</div>
			<div class="form-control"><?=$row["CHL_EMAIL"]?>&nbsp;</div>
		</div>
	</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">บ้านเลขที่</div>
      <div class="form-control"><?=$row["CHL_HOUSE_NO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่</div>
      <div class="form-control"><?=$row["CHL_MOO"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตึก/อาคาร</div>
      <div class="form-control"><?=$row["CHL_BUILDING"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">หมู่บ้าน</div>
      <div class="form-control"><?=$row["CHL_VILLAGE"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ห้อง</div>
      <div class="form-control"><?=$row["CHL_ROOM"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ซอย</div>
      <div class="form-control"><?=$row["CHL_SOI"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ถนน</div>
      <div class="form-control"><?=$row["CHL_ROAD"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำบล/แขวง</div>
	<?
    $sql_tumbon = "SELECT * FROM  " . TB_REF_TUMBON . " WHERE CODE_REF_TUMBON = '".$row["CHL_TUMBON"]."' ";
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
    $sql_amphur = "SELECT * FROM  " . TB_REF_AMPHUR . " WHERE CODE_REF_AMPHUR = '".$row["CHL_AMPHUR"]."' ";
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
    $sql_province = "SELECT * FROM  ".TB_REF_PROVINCE." WHERE  CODE_REF_PROVINCE = '".$row["CHL_PROVINCE"]."' ";
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
      <div class="form-control"><?=$row["CHL_POST_CODE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ประเทศ</div>
	<?
    $sql_nation = "SELECT * FROM  ".TB_REF_NATION." WHERE  NATION_ID = '".$row["CHL_COUNTRY"]."' ";
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
	$i++;
	}
?>
