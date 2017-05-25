<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_CONTRACT_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script type="text/javascript">
				
	function open_issue(contract_no) {
		//alert('contract no : '+contract_no);
		$('#issue_block').dialog({
			show: 'slide',
			hide: 'slide',
			modal: true,
			height: 500,
			width: 810,
			resizable: false,
			title: 'ข้อมูลผลงาน ตามเลขที่สัญญา : '+ contract_no
		});
		
		$('#issue_block p#form_issue').html('<fieldset><legend>เพิ่มข้อมูลผลงาน : </legend><div class="one1" id="jarp"></div><label>ประเภทผลงาน : </label><select name="issue_type" id="issue_type"><option value="1">เอกสารประกอบการสอน</option><option value="2">ตำรา</option><option value="3">งานวิจัย</option><option value="4">หนังสือ</option><option value="5">ผลงานวิชาการลักษณะอื่น</option></select> <br /><label>ชื่อผลงาน : </label><input type="text" name="issue" id="issue" /><br /><label>ปีที่พิมพ์/เผยแพร่ : </label><input type="text" name="issue_publish" id="issue_publish" /><br />        <label>&nbsp;</label><input type="hidden" name="contract" id="contract" value="'+contract_no+'" /><button onclick="save_issue()">บันทึก</button></fieldset>');
		//$('#issue_block p#table_issue').load('contract_issue_table.php?contract='+contract_no+'&p='+Math.random());
		// AJAX Load content of issue
		$.ajax({
			url: 'contract_issue_table.php?k='+ Math.random(),
			data: { contract_no: contract_no },
			success: function(data) {
				$('#issue_block p#table_issue').html(data);
			},
			beforeSend: function() {
				// - - - - - -
				$('#issue_block p#table_issue').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
			},
			type: 'POST'
		});
	}
	
	function open_issue2(contract_no){
		window.open("contract_issue.php?contract_no="+contract_no,"contract_issue","width=900,height=500");
	}
	
	function edit_contract(id) {
			document.getElementById("data_form").style.display = "block";
		//alert('id : '+id);
		$('input[name=contract_no]').val($('#contract_no'+id).html());
		$('input[name=contract_period]').val($('#contract_period'+id).html());
		$('input[name=contract_year]').val($('#contract_year'+id).html());
		//$('input[name=contract_position]').val($('#contract_position'+id).html());
		var rad = ($('#contract_position'+id).html());
		$(':radio[value='+rad+']').attr('checked','checked');
		//alert(rad);
		$('input[name=contract_start]').val($('#contract_start'+id).html());
		$('input[name=contract_finish]').val($('#contract_finish'+id).html());
		var rad = ($('#contract_m60'+id).html());
		$(':radio[value='+rad+']').attr('checked','checked');
		$('textarea[name=contract_comment]').val($('#contract_comment'+id).html());
		
		var rad = ($('#contract_no'+id).html());
		$(':text[value='+rad+']').attr('readonly','readonly');
		
	}
	
	function del_contract(id) {
		//alert(id);
		var cf = confirm("["+id+"] ยืนยันการลบข้อมูลรายการนี้");
		if(cf == true) {
			$.ajax({
				url: 'contract_data_del.php?k='+ Math.random(),
				data: {del: id },
				success: function(data) {
					change_data('contract_history.php','../images/head2/work_data2/contract_history.png');
				},
				befireSend: function() {
				},
				type: 'POST'
			});
		}
	}
</script>
<style type="text/css">
	label {
		width: 130px;
		/*border: 1px solid #F00;*/
		display: inline-block;
	}
	input[type=text], select {
		border: 1px solid #CCC;
		margin-top: 2px;
	}
	button {
		margin-top: 2px;
	}
	.one1 {
		/*display: none;*/
	}
	.two2 {
		display:block;
	}
</style>
<table width="90%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
   
        <td width="5%" class="text_tr">ลำดับ</td>
        <td width="33%" class="text_tr">เลขที่สัญญา</td>
        <td width="28%" class="text_tr">วันที่เริ่ม - เสร็จสิ้น</td>
        <td width="19%" class="text_tr">ผลงาน</td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td width="11%" class="text_tr">แก้ไข/แสดง</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td width="4%" class="text_tr">ลบ</td>
        <?php } ?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_CONTRACT_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY CONTRACT_NO ASC";
	$id = 1;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
   
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["CONTRACT_NO"]?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["CONTRACT_START"])?> ถึง <?=change_date_thai($row["CONTRACT_FINISH"])?></td>
        <td align="center" valign="middle" class="text_td">
        <span style="cursor: pointer; color: #960;" onclick="open_issue2('<?php echo $row['CONTRACT_NO']; ?>')">ผลงาน</span>
        </td>
        
         <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_contract('<?=$id?>')"/>
		</td>
        <?php } ?>
        
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_contract('<?=$row["CONTRACT_NO"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="com_order_no<?=$id?>"><?=$row["COM_ORDER_NO"]?></div>
    <div id="com_org_name<?=$id?>"><?=$row["COM_ORG_NAME"]?></div>
    <div id="com_type<?=$id?>"><?=$row["COM_TYPE"]?></div>
    <div id="com_start_date<?=$id?>"><?=change_date2($row["COM_START_DATE"]);?></div>
    <div id="com_end_date<?=$id?>"><?=change_date2($row["COM_END_DATE"]);?></div>
    <div id="com_place<?=$id?>"><?=$row["COM_PLACE"]?></div>
    <div id="com_country<?=$id?>"><?=$row["COM_COUNTRY"]?></div>
    <div id="com_level<?=$id?>"><?=$row["COM_LEVEL"]?></div>
    <div id="com_file<?=$id?>"><?=$row["COM_FILE12"]?></div>
    <div id="com_filename<?=$id?>"><?=$row["COM_FILE"]?></div>
    <div id="com_order_type<?=$id?>"><?=$row["COM_ORDER_TYPE"]?></div>
    <div id="com_student_name<?=$id?>"><?=$row["COM_STUDENT_NAME"]?></div>
    <div id="com_degree<?=$id?>"><?=$row["COM_DEGREE"]?></div>
    <div id="com_year<?=$id?>"><?=$row["COM_YEAR"]?></div>
    <div id="com_topic<?=$id?>"><?=$row["COM_TOPIC"]?></div>
    <div id="com_curriculum<?=$id?>"><?=$row["COM_CURRICULUM"]?></div>
    
    <div id="contract_no<?=$id;?>"><?=$row['CONTRACT_NO'];?></div>
    <div id="contract_period<?=$id;?>"><?=$row['CONTRACT_PERIOD'];?></div>
    <div id="contract_year<?=$id;?>"><?=$row['CONTRACT_YEAR'];?></div>
    <div id="contract_position<?=$id;?>"><?=$row['CONTRACT_POSITION'];?></div>
    <div id="contract_start<?=$id;?>"><?=change_date_thai($row['CONTRACT_START']);?></div>
    <div id="contract_finish<?=$id;?>"><?=change_date_thai($row['CONTRACT_FINISH']);?></div>
    <div id="contract_m60<?=$id;?>"><?=$row['CONTRACT_M60'];?></div>
    <div id="contract_comment<?=$id;?>"><?=$row['CONTRACT_COMMENT'];?></div>
    </div>
    <?
	$id++;
}
 	 ?>
    </table>
    <div id="debugg" style=" display:none;border:1px solid #F00;">&nbsp;</div>
<br />
    <? } 
	
	?>
	<div id="issue_block" style="display: none;">
    <p id="table_issue">
    
    </p>
    <p id="form_issue">
    </p>
    </div>
   

<?
$db->closedb($conn);
?>