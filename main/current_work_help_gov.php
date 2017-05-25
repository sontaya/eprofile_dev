<?php

$sql = "SELECT * FROM ".TB_HELP_GOV." WHERE EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY START_DATE";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
?>
<br><br>
<div style="padding-left: 90px; font-size:16px" align="left">การช่วยปฏิบัติงานราชการ</div>
<br>
<center>
<table id="help_gov">
	<?
	$i=0;
	while($row = @oci_fetch_array($stid, OCI_BOTH)){
		$i++;
	?>
	<tr>
		<td align="right">หน่วยงาน :</td>
		<td><input type="text" name="institution[]" style="width: 250px;" value="<?=$row["INSTITUTION"]?>" maxlength="200"/></td>
		<td>วันที่เริ่ม :</td>
		<td><input name="start_date[]" id="start_date<?=$i?>" value="<?=change_date_thai($row["START_DATE"])?>" type="text" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_date<?=$i?>','YYYY-MM-DD')" style="cursor:pointer"/></td>
		<td>วันที่สิ้นสุด :</td>
		<td><input name="end_date[]" id="end_date<?=$i?>" type="text"  value="<?=change_date_thai($row["END_DATE"])?>"  style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_date<?=$i?>','YYYY-MM-DD')"  style="cursor:pointer"/></td>
	</tr>
	<?	
	}
	?>
	<tr>
		<td align="right">หน่วยงาน :</td>
		<td><input type="text" name="institution[]" style="width: 250px;" maxlength="200"/></td>
		<td>วันที่เริ่ม :</td>
		<td><input name="start_date[]" id="start_date999" type="text" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_date999','YYYY-MM-DD')"  style="cursor:pointer"/></td>
		<td>วันที่สิ้นสุด :</td>
		<td><input name="end_date[]" id="end_date999" type="text" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_date999','YYYY-MM-DD')"  style="cursor:pointer"/></td>
	</tr>
</table>
</center>

<div style="padding-left: 90px;"><a href="javascript:add_row()">Add</a></div>
<script>
function add_row(){
	var r = Math.floor((Math.random()*100000000)+1); 
	var htmlv = '<tr><td align="right">หน่วยงาน :</td><td><input type="text" name="institution[]" style="width: 250px;" maxlength="200"/></td><td>วันที่เริ่ม :</td><td><input name="start_date[]" id="start_date'+r+'" type="text" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar(\'start_date'+r+'\',\'YYYY-MM-DD\')"  style="cursor:pointer"/></td><td>วันที่สิ้นสุด :</td><td><input name="end_date[]" id="end_date'+r+'" type="text" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar(\'end_date'+r+'\',\'YYYY-MM-DD\')"  style="cursor:pointer"/></td></tr>';
	$("#help_gov").append(htmlv);
}
</script>