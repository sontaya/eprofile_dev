// JavaScript Document

function load_certification_table(){
		ajaxPostData("certification_data_table.php","","text","certification_list",load_certification_table_res,"");
}

function load_certification_table_res(response){	
		$('div#certification_list').html(response);	
}

function del_certification(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("certification_data_del.php",data,"text","certification_list",del_certification_res,"");
	}
}

function del_certification_res(response){	
	if(response == "1"){
		load_certification_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_certification(rel){
	document.getElementById("data_form").style.display = "block";
	$("input#cer_id").val($('div#cer_id'+rel).html());	
	$('input#cer_name').val($('div#cer_name'+rel).html());
	$('input#cer_from').val($('div#cer_from'+rel).html());
	$('input#cer_expire').val($('div#cer_expire'+rel).html());

}