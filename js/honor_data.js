// JavaScript Document

function load_honor_table(){
		ajaxPostData("honor_data_table.php","","text","honor_list",load_honor_table_res,"");
}

function load_honor_table_res(response){	
		$('div#honor_list').html(response);	
}

function del_honor(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"&HON_FILE="+file;
	ajaxPostData("honor_data_del.php",data,"text","honor_list",del_honor_res,"");
	}
}

function del_honor_res(response){	
	if(trim_string(response) === "1"){
		load_honor_table(); 
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_honor(rel){
		document.getElementById("data_form").style.display = "block";
	$('input#hon_id').val($('div#hon_id'+rel).html());
	$("select#hon_year").val($('div#hon_year'+rel).html());
	$('input#hon_name').val($('div#hon_name'+rel).html());
	$('input#hon_from').val($('div#hon_from'+rel).html());
	$('input#hid_hon_file').val($('div#hon_file'+rel).html());
	

}