// JavaScript Document// JavaScript Document

function load_fi_table(){
		ajaxPostData("file_upmanu_table.php","","text","file_list",load_fi_table_res,"");
}

function load_fi_table_res(response){	
		$('div#file_list').html(response);	
}

function del_fi(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("fi_data_del.php",data,"text","file_list",del_fi_res,"");
	}
}

function del_fi_res(response){	
	if(response == "1"){
		load_fi_table();
	}else{
		load_fi_table();
	}
}

function edit_fi(rel){
	//alert("ok");
	document.getElementById("data_form").style.display = "block";
	$('select#mame_manu').val($('div#mame_manu'+rel).html());
	$("input#fi_name").val($('div#fi_name'+rel).html());
	$('input#fi_id').val($('div#fi_id'+rel).html());
	$('input#fi_d').val($('div#fi_d'+rel).html());
}