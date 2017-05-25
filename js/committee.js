// JavaScript Document

function load_committee_table(){
	//alert('load_committee_table');
		$('span#file_upp').html('<input type="file" name="consult_file" id="consult_file" />');
		$('#combo_group').html('<input type="radio" name="document_type" value="1" checked="checked" /> คำสั่ง <input type="text" name="document_type_1" id="document_type_1" class="input_text" /><br /><input type="radio" name="document_type" value="2" /> บันทึกข้อความ <input type="text" name="document_type_2" id="document_type_2" class="input_text" /><br /><input type="radio" name="document_type" value="3" /> อื่น ๆ <input type="text" name="document_type_3" id="document_type_3" class="input_text" />');
		ajaxPostData("committee_data_table.php","","text","consult_list",load_committee_table_res,"");
		//alert('I FLY.');
		//change_data('constructor.php','../images/head2/work_data2/constructor.png');
		
}

function load_committee_table_res(response){	
		//alert(response);
		$('div#consult_list').html(response);	
}

function del_committee(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"&FILE="+file;
	ajaxPostData("committee_data_del.php",data,"text","consult_list",del_committee_res,"");
	}
}

function del_committee_res(response){	
	if(response == "1"){
		load_committee_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_committee(rel){ 	
	document.getElementById("data_form").style.display = "block";
//alert('committee::rel = ' +rel);
	//$('div#debugg').html('ไอ้บ้า');

	
	//$('input#com_order_no').val($('div#com_order_no'+rel).html());
	//$('input#com_order_no').val($('div#com_order_no'+rel).html());
	//document.consult.com_order_no.readOnly = true;
	//document.consult.document_type.readOnly = true;
	//document.consult.com_type.readOnly = true;
	//document.getElementById('com_type').readOnly = true;
	$('input#com_id').val($('div#com_id'+rel).html());
	$('input#com_org_name').val($('div#com_org_name'+rel).html());
	$("select#com_type").val($('div#com_type'+rel).html());
	$("input#com_start_date").val($('div#com_start_date'+rel).html()); 
	$("input#com_end_date").val($('div#com_end_date'+rel).html()); 
	$('input#com_place').val($('div#com_place'+rel).html());
	$('input#com_country').val($('div#com_country'+rel).html());
	if($('div#com_level'+rel).html() == "1"){
		document.consult.com_level[0].checked="checked";
	}else if($('div#com_level'+rel).html() == "2"){
		document.consult.com_level[1].checked="checked";
	}
	
	// จัดการซ่อน/แสดงออบเจ็กต์ให้เหมาะสมกับการแสดงผล
	var manage_objects = $('div#com_type'+rel).html();
	if(manage_objects == 11) {
		$('.thesis').css({
					'display':'none'
		});
		$('#label_org').html('ชื่อหน่วยงานภายนอก');
	}
	else {
		$('.thesis').css({
					'display':'table-row'
		});
		$('#label_org').html('ชื่อสถาบันการศึกษา');
	}
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	
	var doctype = $('div#com_order_type'+rel).html();
	var doctype_text = "อื่น ๆ";
	if(doctype == 1) {
		doctype_text = "คำสั่ง";
	}
	else if(doctype == 2) {
		doctype_text = "บันทึกข้อความ";
	}
	
	$('input#com_student_name').val($('div#com_student_name'+rel).html());
	var dgree = $('div#com_degree'+rel).html();
	$('input#com_curriculum').val($('div#com_curriculum'+rel).html());
	$('input#com_year').val($('div#com_year'+rel).html());
	$('input#com_topic').val($('div#com_topic'+rel).html());
	
	if(dgree == 1) {
		document.consult.com_degree[0].checked="checked";
	}
	else {
		document.consult.com_degree[1].checked="checked";
	}
	
	
	$('#combo_group').html(doctype_text+': <input type="hidden" name="document_type" value="'+doctype+'" /><input type="text" id="ttest" class="input_text" value="'+$('div#com_order_no'+rel).html()+'" name="document_type_'+doctype+'" />');
	//document.consult.ttest.readOnly = true;
	
	var file_att = $('div#com_file'+rel).html();
	var filename_att = $('div#com_filename'+rel).html();
	$('div#debugg').html(filename_att);
	if(file_att != '') {
		$('span#file_upp').html(file_att + ' <span id="" style="cursor: pointer; color: red;" onclick="delfile_committee(\''+filename_att+'\');">[ลบ]</span>');
	}
	else {
		$('span#file_upp').html('<input type="file" name="consult_file" id="consult_file" />');
	}

}

function delfile_committee(file_id) {
	//alert('Sengjit: '+file_id);
	var di = confirm("แน่ใจว่าจะลบไฟล์นี้หรือไม่ ?");
	if(di) {
		//$('span#file_upp').html('ลบแล้ว เฮ่อ ๆ');
		$.ajax({
			url: '_delfile_committee.php?p='+ Math.random(),
			type: 'POST',
			data: {filename : file_id },
			success: function(data) {
				$('span#file_upp').html('<input type="file" name="consult_file" id="consult_file" />');
			},
			beforeSend: function() {
				$('span#file_upp').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
			}
		});
	}
}