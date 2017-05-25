// JavaScript Document

function load_consult_table(){
	$('span#file_upp').html('<input type="file" name="consult_file" id="consult_file" />');
		$('#combo_group').html('<input type="radio" name="document_type" value="1" checked="checked" /> คำสั่ง <input type="text" name="document_type_1" id="document_type_1" class="input_text" /><br /><input type="radio" name="document_type" value="2" /> บันทึกข้อความ <input type="text" name="document_type_2" id="document_type_2" class="input_text" /><br /><input type="radio" name="document_type" value="3" /> อื่น ๆ <input type="text" name="document_type_3" id="document_type_3" class="input_text" />');
		ajaxPostData("consult_data_table.php","","text","consult_list",load_consult_table_res,"");
}

function load_consult_table_res(response){	
		$('div#consult_list').html(response);	
}

function del_consult(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"&FILE="+file;
	ajaxPostData("consult_data_del.php",data,"text","consult_list",del_consult_res,"");
	}
}

function del_consult_res(response){	
	if(response == "1"){
		load_consult_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_consult(rel){
	document.getElementById("data_form").style.display = "block";	
	$('input#com_id').val($('div#com_id'+rel).html());
	$('input#com_order_no').val($('div#com_order_no'+rel).html());
	//document.consult.com_order_no.readOnly = true;
	$('input#com_org_name').val($('div#com_org_name'+rel).html());
	$('input#com_course').val($('div#com_course'+rel).html());
	$('#com_detail').val($('div#com_detail'+rel).html());
	$("select#com_type").val($('div#com_type'+rel).html());
	$("input#com_start_date").val($('div#com_start_date'+rel).html()); 
	$("input#com_end_date").val($('div#com_end_date'+rel).html()); 
	$('input#com_place').val($('div#com_place'+rel).html());
	$('input#com_country').val($('div#com_country'+rel).html());
	if($('div#com_type'+rel).html() == "1"){
		document.consult.com_type[0].checked="checked";
	}else if($('div#com_type'+rel).html() == "2"){
		document.consult.com_type[1].checked="checked";
	}
	
	var doctype = $('div#com_order_type'+rel).html();
	var doctype_text = "อื่น ๆ";
	if(doctype == 1) {
		doctype_text = "คำสั่ง";
	}
	else if(doctype == 2) {
		doctype_text = "บันทึกข้อความ";
	}
	
	$('#combo_group').html(doctype_text+': <input type="hidden" name="document_type" value="'+doctype+'" /><input type="text" id="ttest" class="input_text" value="'+$('div#com_order_no'+rel).html()+'" name="document_type_'+doctype+'" />');
	document.consult.ttest.readOnly = true;
	
	var file_att = $('div#com_file'+rel).html();
	var filename_att = $('div#com_filename'+rel).html();
	$('div#debugg').html(filename_att);
	if(file_att != '') {
		$('span#file_upp').html(file_att + ' <span id="" style="cursor: pointer; color: red;" onclick="delfile_consult(\''+filename_att+'\');">[ลบ]</span>');
	}
	else {
		$('span#file_upp').html('<input type="file" name="consult_file" id="consult_file" />');
	}

}

function delfile_consult(file_id) {
	//alert('Sengjit: '+file_id);
	var di = confirm("แน่ใจว่าจะลบไฟล์นี้หรือไม่ ?");
	if(di) {
		//$('span#file_upp').html('ลบแล้ว เฮ่อ ๆ');
		$.ajax({
			url: '_delfile_consult.php?p='+ Math.random(),
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