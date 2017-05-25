<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_CONTRACT_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow == 0){
?>
	<script> $("#note_data").html("<center><h3><font color='red'>--ไม่พบข้อมูลการต่อสัญญาจ้าง โปรดติดต่อเจ้าหน้าที่กองบริหารงานบุคคล<br />โทร. 022445152 ในวันและเวลาทำการ--</font></h3></center><br><br>");</script> <div id='note_data'></div>
<?	/*	echo "<script> not_data(); </script> <div id='note_data'></div>";*/
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

		$('input[name=number_contact]').val($('#com_number'+id).html());
		$('input[name=contract_no]').val($('#contract_no'+id).html());
		$('input[name=contract_period]').val($('#contract_period'+id).html());
		$('input[name=contract_year]').val($('#contract_year'+id).html());
		var rad = ($('#contract_position'+id).html());
		$(':radio[value='+rad+']').attr('checked','checked');

		$('input[name=contract_start]').val($('#contract_start'+id).html());
		$('input[name=contract_finish]').val($('#contract_finish'+id).html());
		var rad = ($('#contract_m60'+id).html());
		$(':radio[value='+rad+']').attr('checked','checked');
		$('textarea[name=contract_comment]').val($('#contract_comment'+id).html());
        
        $('select[name=ck_mua_emp_type]').val($('#ck_mua_emp_type'+id).html());
        $('select[name=contract_no2]').val($('#contract_no2'+id).html());
        $('input[name=scorse_yer]').val($('#scorse_yer'+id).html());
        $('input[name=directive]').val($('#directive'+id).html());
        $('input[name=directive_no]').val($('#directive_no'+id).html());
        $('input[name=directive_date]').val($('#directive_date'+id).html());
        $('input[name=sch_order_no]').val($('#sch_order_no'+id).html());
        $('input[name=sch_at]').val($('#sch_at'+id).html());
        $('input[name=sch_at_date]').val($('#sch_at_date'+id).html());
		
        if($('div#contract_document'+id).html() == "1"){
             document.contract.contract_document.checked="checked";
        }else if($('div#contract_document'+id).html() == ""){
            document.contract.contract_document.checked="";
        }
        $('#contract_date').val($('#contract_date'+id).html());
        
        $('input[name=employ]').val($('#employ'+id).html());
        $('input[name=employ_no]').val($('#employ_no'+id).html());
        $('#secret_name').val($('#secret_name'+id).html());
        $('#document_date').val($('#document_date'+id).html());

        if($('div#overtime_document'+id).html() == "1"){
             document.contract.overtime_document.checked="checked";
        }else if($('div#overtime_document'+id).html() == ""){
            document.contract.overtime_document.checked="";
        }
        $('#overtime_date').val($('#overtime_date'+id).html());
        
         $('input#one_files_h').val($('#one_files_h'+id).html());
        $('input#two_files_h').val($('#two_files_h'+id).html());
        $('input#tree_files_h').val($('#tree_files_h'+id).html());
        
        if($('div#secret_document'+id).html() == "1"){
             document.contract.secret_document.checked="checked";
        }else if($('div#secret_document'+id).html() == ""){
            document.contract.secret_document.checked="";
        }
        
       // console.log($('div#secret_document'+id).html());
        $('#document_date').val($('#document_date'+id).html());
        
        if($('div#secret_b'+id).html() == "1"){
            document.contract.secret_b[0].checked="checked";
        }else if($('div#secret_b'+id).html() == "2"){
            document.contract.secret_b[1].checked="checked";
        }
        
        
		var rad = ($('#contract_no'+id).html());
		//$(':text[value='+rad+']').attr('readonly','readonly');
		
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
        <td width="15%" class="text_tr">เลขที่สัญญา</td>
        <td width="18%" class="text_tr">ตำแหน่ง</td>
        <td width="10%" class="text_tr">วันที่เริ่มต้น</td>
        <td width="10%" class="text_tr">วันที่สิ้นสุด</td>
        <td width="15%" class="text_tr">สถานะคู่ฉบับ</td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td width="10%" class="text_tr">ไฟล์แนบ</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td width="20%" class="text_tr">แก้ไข/แสดง/ลบ</td>
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
        <td align="left" class="text_td text_data">
            <? if($row["CONTRACT_POSITION"]=="1"){ echo"เจ้าหน้าที่"; }?>
            <? if($row["CONTRACT_POSITION"]=="2"){ echo"อาจารย์"; }?>
            <? if($row["CONTRACT_POSITION"]=="3"){ echo"ผศ."; }?>
            <? if($row["CONTRACT_POSITION"]=="4"){ echo"รศ."; }?>
            <? if($row["CONTRACT_POSITION"]=="5"){ echo"ศ."; }?>
            <? if($row["CONTRACT_POSITION"]=="6"){ echo"ที่ปรึกษา"; }?>
            <? if($row["CONTRACT_POSITION"]=="7"){ echo"ครู"; }?>
            <? if($row["CONTRACT_POSITION"]=="8"){ echo"ผู้บริหาร"; }?>
        </td>
        <td align="left" class="text_td text_data"><?=change_date_thai($row["CONTRACT_START"])?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["CONTRACT_FINISH"])?></td>
        <td align="center" valign="middle" class="text_td"> 
        <?
			if($row["CONTRACT_DOCUMENT"]){	echo "ติดต่อรับภายใน ".change_date_thai($row["CONTRACT_DATE"]); }elseif($row["OVERTIME_DOCUMENT"]){ echo "พ้นกำหนดรับตั้งแต่ ".change_date_thai($row["OVERTIME_DATE"]); }elseif($row["SECRET_DOCUMENT"]){ echo "รับแล้วเมื่อ ".change_date_thai($row["DOCUMENT_DATE"]); }else { echo "ไม่มีข้อมูล"; }
/*
            $vv = change_date_thai($row["DIRECTIVE_DATE"]);                                       
            $xxx = explode("/",$vv); */
            ?>
            <? /*$row["DIRECTIVE"].$row["DIRECTIVE_NO"]*/ ?>
        </td>
        
         <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td align="center" class="text_td" valign="middle">
        <? if($row["ONE_FILES"]!=""){ ?>
		<img src="../images/macosx100.png" height="20" border="0" title="<?=$row["ONE_FILES"]?>" class="vtip" onclick="window.open('files/con_file/<?=$row["ONE_FILES"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
         <? } ?>
        <? if($row["TWO_FILES"]!=""){ ?>
        <img src="../images/macosx100.png" height="20" border="0" title="<?=$row["TWO_FILES"]?>" class="vtip" onclick="window.open('files/con_file/<?=$row["TWO_FILES"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
        <? } ?>
        <? if($row["TREE_FILES"]!=""){ ?>
        <img src="../images/macosx100.png" height="20" border="0" title="<?=$row["TREE_FILES"]?>" class="vtip" onclick="window.open('files/con_file/<?=$row["TREE_FILES"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		<? } ?>
        </td>
        <?php } ?>
        
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" valign="middle" class="text_td">
        <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_contract('<?=$id?>')"/>
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_contract('<?=$row["CONTRACT_NO"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="com_number<?=$id?>"><?=$row["NUMBER_CONTACT"]?></div>
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
        
    <div id="ck_mua_emp_type<?=$id;?>"><?=$row['CK_MUA_EMP_TYPE'];?></div>
    <div id="contract_no2<?=$id;?>"><?=$row['CONTRACT_NO2'];?></div>
    <div id="scorse_yer<?=$id;?>"><?=$row['SCORSE_YER'];?></div>
    <div id="directive<?=$id;?>"><?=$row['DIRECTIVE'];?></div>

    <div id="directive_no<?=$id;?>"><?=$row['DIRECTIVE_NO'];?></div>
    <div id="directive_date<?=$id;?>"><?=change_date_thai($row['DIRECTIVE_DATE']);?></div>
    <div id="sch_order_no<?=$id;?>"><?=$row['SCH_ORDER_NO'];?></div>
    <div id="sch_at<?=$id;?>"><?=$row['SCH_AT'];?></div>
    <div id="sch_at_date<?=$id;?>"><?=change_date_thai($row['SCH_AT_DATE']);?></div>

    <div id="employ"><?=$row['EMPLOY'];?></div>
    <div id="employ_no<?=$id;?>"><?=$row['EMPLOY_NO'];?></div>
    
    <div id="contract_document<?=$id;?>"><?=$row['CONTRACT_DOCUMENT'];?></div>
    <div id="contract_date<?=$id;?>"><?=change_date_thai($row['CONTRACT_DATE']);?></div>
    
    <div id="secret_document<?=$id;?>"><?=$row['SECRET_DOCUMENT'];?></div>
    <div id="document_date<?=$id;?>"><?=change_date_thai($row['DOCUMENT_DATE']);?></div>
    <div id="secret_b<?=$id;?>"><?=$row['SECRET_B'];?></div>
    <div id="secret_name<?=$id;?>"><?=$row['SECRET_NAME'];?></div>

    <div id="overtime_document<?=$id;?>"><?=$row['OVERTIME_DOCUMENT'];?></div>
    <div id="overtime_date<?=$id;?>"><?=change_date_thai($row['OVERTIME_DATE']);?></div>
        
    <div id="one_files_h<?=$id;?>"><?=$row['ONE_FILES'];?></div> 
    <div id="two_files_h<?=$id;?>"><?=$row['TWO_FILES'];?></div> 
    <div id="tree_files_h<?=$id;?>"><?=$row['TREE_FILES'];?></div> 
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
//$db->closedb($conn);
?>