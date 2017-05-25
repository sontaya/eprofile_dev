// JavaScript Document

function load_res_table(){
		ajaxPostData("res_cre_data_table.php","","text","research_list",load_res_table_res,"");
}

function load_res_table_res(response){	
		$('div#research_list').html(response);	
}

function del_res(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("research_data_del.php",data,"text","research_list",del_res_res,"");
	}
}

function del_res_res(response){	
	if(response == "1"){
		load_res_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_res(rel){
	document.getElementById("data_form").style.display = "block";	
	$("input#rec_id").val($('div#rec_id'+rel).html()); 
	$('input#rec_order_no').val($('div#rec_order_no'+rel).html());
	$("input#rec_at").val($('div#rec_at'+rel).html()); 
	$("input#rec_at_date").val($('div#rec_at_date'+rel).html()); 
	
	if($('div#rec_type'+rel).html() == "1"){
		document.research.rec_type[0].checked="checked";
	}else if($('div#rec_type'+rel).html() == "2"){
		document.research.rec_type[1].checked="checked";
	}
	$("select#rec_year").val($('div#rec_year'+rel).html());
	$('input#rec_name').val($('div#rec_name'+rel).html());
	$('input#rec_prices').val($('div#rec_prices'+rel).html());
	$("input#rec_source").val($('div#rec_source'+rel).html());
	$("input#rec_start_date").val($('div#rec_start_date'+rel).html()); 
	$("input#rec_end_date").val($('div#rec_end_date'+rel).html()); 

}