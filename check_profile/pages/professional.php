<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_professional" name="chk_professional" value="1" onChange="check_radio('professional')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_professional" name="chk_professional" value="2" onChange="check_radio('professional')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ความเชียวชาญ" disabled="disabled" id="bt_professional" name="bt_professional">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
    $sql = "SELECT * FROM  ".TB_EXPERT_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	for($i=1;$i<=10;$i++){
		$row = oci_fetch_array($stid, OCI_BOTH);
		if($row["EXP_EXPERT$i"]!=''){
?>
<div class="row">
    <div class="alert alert-success" role="alert">ความเชี่ยวชาญที่ <?=$i?></div>
	<div class="form-group col-md-8">
		<div class="input-group">
			<div class="form-control"><?=$row["EXP_EXPERT$i"]?>&nbsp;</div>
		</div>
	</div>
</div>
<?
		}
	}
?>
