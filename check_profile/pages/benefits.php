<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_benefits" name="chk_benefits" value="1" onChange="check_radio('benefits')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_benefits" name="chk_benefits" value="2" onChange="check_radio('benefits')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="สวัสดิการและสิทธิประโยชน์" disabled="disabled" id="bt_benefits" name="bt_benefits">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_WELFARE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">สวัสดิการและสิทธิประโยชน์</div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["SSO"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">ประกันสังคม ใช้สิทธ์โรงพยาบาล <?=$row["HOSPITAL"]?>&nbsp;</div>
    </div>
  </div>
  <div class="form-group col-md-2">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["CPK"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">ชพค.</div>
    </div>
  </div>
  <div class="form-group col-md-2">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["CPS"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">ชพส.</div>
    </div>
  </div>
  <div class="form-group col-md-2">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["GPF"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">ทุน กบข.</div>
    </div>
  </div>
  <div class="form-group col-md-2">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["GPEF"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">ทุน กสจ.</div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["PERSONNEL_FUND"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">กองทุนสะสมเลี้ยงชีพสำหรับบุคลากร</div>
    </div>
  </div>
  <div class="form-group col-md-5">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["COOPERATIVES"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">สหกรณ์ออมทรัพย์ <? if($row["DEBT"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?>มียอดหนี้สหกรณ์ <? if($row["DEBT"]=="2"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?>ไม่มียอดหนี้สหกรณ์ </div>
    </div>
  </div>
  <div class="form-group col-md-4">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["WELFARE"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">โครงการจ่ายตรงสวัสดิการรักษาพยาบาล</div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["CHILDLOAN"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">สนับสนุนทุนเล่าเรียนบุตร</div>
    </div>
  </div>
  <div class="form-group col-md-8">
    <div class="input-group">
      <div class="input-group-addon"><? if($row["SCHOLAR"]=="1"){ ?><i class="glyphicon glyphicon-check"></i><? }else{ ?><i class="glyphicon glyphicon-unchecked"></i><? } ?></div>
      <div class="form-control">มีสิทธิ์ขอทุนของมหาวิทยาลัยไปศึกษาต่อได้ (สำหรับผู้ที่ทำงานครบสองปี และมีผลประเมินครั้งล่าสุด ระดับสี่ขึ้นไป)</div>
    </div>
  </div>
</div>
