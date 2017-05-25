<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_assesment" name="chk_assesment" value="1" onChange="check_radio('assesment')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_assesment" name="chk_assesment" value="2" onChange="check_radio('assesment')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลการประเมินผลการปฏิบัติราชการ" disabled="disabled" id="bt_assesment" name="bt_assesment">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_SDU_ESTIMATE_SERVICE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">ข้อมูลการประเมินผลการปฏิบัติราชการ</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ปีงบประมาณ</div>
      <div class="form-control"><?=$row["RATE_YEAR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">รอบที่</div>
      <div class="form-control"><?=$row["EPISODE_NO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ชื่อผู้ประเมิน</div>
      <div class="form-control"><?=$row["NAME_RATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำแหน่ง</div>
      <div class="form-control"><?=$row["RIS_RATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ป.มสด.1 ผลสัมฤทธิ์ของงาน</div>
      <div class="form-control"><?=$row["P_SDU_ONE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ผลสัมฤทธิ์ของงานตามข้อบังคับฯ</div>
      <div class="form-control"><?=$row["ACHIEVE_QUANTITY_ONE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ผลสัมฤทธิ์ของงานตามสัญญาจ้าง</div>
      <div class="form-control"><?=$row["ACHIEVE_QUANTITY_TWO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ผลสัมฤทธิ์ของงานตามภาระงานเพิ่มเติม</div>
      <div class="form-control"><?=$row["ACHIEVE_QUANTITY_TREE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ป.มสด.2 พฤติกรรมการปฏิบัติงาน</div>
      <div class="form-control"><?=$row["P_SDU_TWO"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ความเป็นสวนดุสิต</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_1"]?>(<?=$row["QUANTITY_FIG_1"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ความมุ่งมั่นสู่ความสำเร็จที่เป็นเลิศ</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_2"]?>(<?=$row["QUANTITY_FIG_2"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">การสั่งสมความเชี่ยวชาญในวิชาชีพ</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_3"]?>(<?=$row["QUANTITY_FIG_3"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">การสร้างเครือข่ายพันธมิตรและทีมงาน</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_4"]?>(<?=$row["QUANTITY_FIG_4"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">การดำรงตนบนฐานของวินัย คุณธรรม จรรยาบรรณวิชาชีพ</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_5"]?>(<?=$row["QUANTITY_FIG_5"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ความเข้าใจในมหาวิทยาลัย</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_6"]?>(<?=$row["QUANTITY_FIG_6"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">ความรู้และทักษะที่จำเป็นสำหรับการปฏิบัติงานตามหน้าที่รับผิดชอบ</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_8"]?>(<?=$row["QUANTITY_FIG_8"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">การพัฒนานวัตกรรมจากฐานความรู้</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_9"]?>(<?=$row["QUANTITY_FIG_9"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">การประยุกต์ใช้เทคโนโลยีในการปฏิบัติงาน</div>
      <div class="form-control"><?=$row["QUANTITY_NEW_10"]?>(<?=$row["QUANTITY_FIG_10"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ป.มสด.1 ผลสัมฤทธิ์ของงาน</div>
      <div class="form-control"><?=$row["SDU_QUANTITY_NEW_ONE"]?>(<?=$row["SDU_QUANTITY_FIG_ONE"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ป.มสด.2 พฤติกรรมการปฏิบัติงาน</div>
      <div class="form-control"><?=$row["SDU_QUANTITY_NEW_TWO"]?>(<?=$row["SDU_QUANTITY_FIG_TWO"]?>)</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ระดับผลการประเมิน</div>
      <div class="form-control"><? switch($row["LEVEL_QUANTITY"]){ case '5' : echo "ดีเด่น"; break; case '4' : echo "ดีมาก"; break; case '3' : echo "ดี"; break; case '2' : echo "พอใช้"; break; case '1' : echo "ต้องปรับปรุง"; break; } ?></div>
    </div>
  </div>
</div>
<?
}
?> 
