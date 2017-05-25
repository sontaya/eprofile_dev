<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_punish" name="chk_punish" value="1" onChange="check_radio('punish')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_punish" name="chk_punish" value="2" onChange="check_radio('punish')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การตักเตือน ลงโทษ" disabled="disabled" id="bt_punish" name="bt_punish">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_WARN_PUNISH_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$i++;
while($row = $db->fetch($sql,$conn)){
?>
<br />
<div class="row">
  <div class="alert alert-success" role="alert">การลงโทษทางวินัยครั้งที่ <?=$i;?></div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">โทษทางวินัย</div>
<?
	switch($row["WAP_TYPE"]){
		case "1" : $wap_name = "ตักเตือน";break;
		case "2" : $wap_name = "ภาคทัณฑ์";break;
		case "3" : $wap_name = "ตัดเงินเดือน";break;
		case "4" : $wap_name = "ถูกสอบสวนทางวินัย";break;
		case "5" : $wap_name = "อื่นๆ";break;
	}
?>      
      <div class="form-control"><?=$wap_name?></div>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="input-group">
      <div class="input-group-addon">วันที่</div>
      <div class="form-control"><?=$row["WAP_DATE"]?>&nbsp;</div>
    </div>
  </div>
</div>
<?
	$i++;
}
?> 
