// JavaScript Document

function load_warn_table(){
		ajaxPostData("warn_data_table.php","","text","warn_list",load_warn_table_res,"");
}

function load_warn_table_res(response){	
		$('div#warn_list').html(response);	
}

function del_warn(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("warn_data_del.php",data,"text","warn_list",del_warn_res,"");
	}
}

function del_warn_res(response){	
	if(response == "1"){
		load_warn_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_warn(rel){
	document.getElementById("data_form").style.display = "block";
	$("select#wap_type").val($('div#wap_type'+rel).html());	
	$('input#wap_date').val($('div#wap_date'+rel).html());
	$('textarea#wap_memo').val($('div#wap_memo'+rel).html());
	$('input#wap_id').val($('div#wap_id'+rel).html());
}