// JavaScript Document

function load_constructor_table(){
		$('span#file_upp').html('<input type="file" name="constructor_file" id="constructor_file" />');
		ajaxPostData("constructor_data_table.php","","text","constructor_list",load_constructor_table_res,"");
}

function load_constructor_table_res(response){	
		$('div#constructor_list').html(response);	
}

function del_constructor(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"&FILE="+file;
	ajaxPostData("constructor_data_del.php",data,"text","constructor_list",del_constructor_res,"");
	}
}

function del_constructor_res(response){	
	if(response == "1"){
		load_constructor_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_constructor(rel){
	document.getElementById("data_form").style.display = "block";
	$('input#con_id').val($('div#con_id'+rel).html());
	$('input#con_order_no').val($('div#con_order_no'+rel).html());
	//document.constructor.con_order_no.readOnly = true;
	$('input#con_course_name').val($('div#con_course_name'+rel).html());
	$("select#con_type").val($('div#con_type'+rel).html());
	$("input#con_start_date").val($('div#con_start_date'+rel).html()); 
	$("input#con_end_date").val($('div#con_end_date'+rel).html()); 
	$('input#con_place').val($('div#con_place'+rel).html());
	$('#con_detail').val($('div#con_detail'+rel).html());
	$('input#con_country').val($('div#con_country'+rel).html());
	if($('div#con_level'+rel).html() == "1"){
		document.constructor.con_level[0].checked="checked";
	}else if($('div#con_level'+rel).html() == "2"){
		document.constructor.con_level[1].checked="checked";
	}
	
	var file_att = $('div#con_file'+rel).html(); 
	var filename_att = $('div#con_filename'+rel).html();
	$('div#debugg').html(filename_att);
	if(file_att != '') {
	$('span#file_upp').html(file_att + ' <span id="" style="cursor: pointer; color: red;" onclick="delfile_constructor(\''+filename_att+'\');">[ลบ]</span>');
	}
	else {
		$('span#file_upp').html('<input type="file" name="constructor_file" id="constructor_file" />');
	}

}

function delfile_constructor(file_id) {
	//alert('Sengjit: '+file_id);
	var di = confirm("แน่ใจว่าจะลบไฟล์นี้หรือไม่ ?");
	if(di) {
		//$('span#file_upp').html('ลบแล้ว เฮ่อ ๆ');
		$.ajax({
			url: '_delfile_constructor.php?p='+ Math.random(),
			type: 'POST',
			data: {filename : file_id },
			success: function(data) {
				$('span#file_upp').html('<input type="file" name="constructor_file" id="constructor_file" />');
			},
			beforeSend: function() {
				$('span#file_upp').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");	
			}
		});
	}
}