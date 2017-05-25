// JavaScript Document

function load_wrk_table(){
		ajaxPostData("workh_data_table.php","","text","work_history_list",load_wrk_table_res,"");
}

function load_wrk_table_res(response){	
		$('div#work_history_list').html(response);	
}

function del_wrk(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("wrk_data_del.php",data,"text","work_history_list",del_wrk_res,"");
	}
}

function del_wrk_res(response){	
	if(response == "1"){
		load_wrk_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_wrk(rel){
	document.getElementById("data_form").style.display = "block";
	$('input#wrk_id').val($('div#wrk_id'+rel).html());
	$('input#wrk_work_place').val($('div#wrk_work_place'+rel).html());
	$('input#wrk_position').val($('div#wrk_position'+rel).html());
	$('input#wrk_depart').val($('div#wrk_depart'+rel).html());
	$('textarea#wrk_responsibility').val($('div#wrk_responsibility'+rel).html());
	$('input#wrk_long').val($('div#wrk_long'+rel).html());
	$("textarea#wrk_loc").val($('div#wrk_loc'+rel).html());
	$("input#wrk_phone").val($('div#wrk_phone'+rel).html());
	$("input#wrk_fax").val($('div#wrk_fax'+rel).html());
	

}