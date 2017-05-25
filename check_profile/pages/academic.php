<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_academic" name="chk_academic" value="1" onChange="check_radio('academic')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_academic" name="chk_academic" value="2" onChange="check_radio('academic')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ตำแหน่งทางวิชาการ" disabled="disabled" id="bt_academic" name="bt_academic">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_POSITION_SUB_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">ตำแหน่งทางวิชาการ</div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ตำแหน่ง</div>
      <div class="form-control"><? switch($row["VP_TYPE"]){ case '1' : echo "ผศ./ผศ.พิเศษ"; break; case '2' : echo "รศ./รศ.พิเศษ"; break; case '3' : echo "ศ./ศ.พิเศษ"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">ขอกำหนดตำแหน่ง</div>
      <div class="form-control"><? switch($row["VP_TYPE"]){ case '1' : if($row["VP_SUB_TYPE"]=='1'){ echo "ผู้ช่วยศาสตราจารย์"; }else{ echo "ผู้ช่วยศาสตราจารย์พิเศษ"; } break; case '2' : if($row["VP_SUB_TYPE"]=='1'){ echo "รองศาสตราจารย์"; }else{ echo "รองศาสตราจารย์พิเศษ"; } break; case '3' : if($row["VP_SUB_TYPE"]=='1'){ echo "ศาสตราจารย์"; }else{ echo "ศาสตราจารย์พิเศษ"; } break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วิธีขอกำหนดตำแหน่ง</div>
      <div class="form-control"><? switch($row["VP_METHOD"]){ case '1' : echo "ปกติ"; break; case '2' : echo "พิเศษ"; break; case '3' : echo "อื่นๆ"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">แต่งตั้งโดย</div>
      <div class="form-control"><? switch($row["VP_BY"]){ case '1' : echo "กพอ."; break; case '2' : echo "กกอ."; break; case '3' : echo "กม."; break; case '4' : echo "กสอ."; break; case '5' : echo "กค."; break; case '6' : echo "สภาสถาบัน"; case '7' : echo "หน่วยงานอื่นๆ"; break; case '8' : echo "สภามหาวิทยาลัย"; break; } ?></div>
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-addon">มหาวิทยาลัย/สถาบันการศึกษา</div>
      <div class="form-control"><?=$row["VP_UNIVERSITY"]?></div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon">สาขาวิชาที่ขอกำหนดตำแหน่ง</div>
      <div class="form-control"><?=$row["VP_PROFESSIONAL_MAJOR"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่ได้รับอนุมัติแต่งตั้ง</div>
      <div class="form-control"><?=$row["VP_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">คำสั่งที่</div>
      <div class="form-control"><?=$row["VP_ORDER"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">ณ วันที่</div>
      <div class="form-control"><?=$row["VP_ORDER_DATE"]?></div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon">มติที่ประชุมสภามหาวิทยาลัย/สถาบันการศึกษา ครั้งที่</div>
      <div class="form-control"><?=$row["VP_MATI_!"]?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่</div>
      <div class="form-control"><?=$row["VP_MATI_2"]?></div>
    </div>
  </div>
</div>
<?
}
?> 
