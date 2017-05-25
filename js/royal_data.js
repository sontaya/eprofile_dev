// JavaScript Document

function load_royal_table(){
		ajaxPostData("royal_data_table.php","","text","royal_list",load_royal_table_res,"");
}

function load_royal_table_res(response){	
		$('div#royal_list').html(response);	
}

function del_royal(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("royal_data_del.php",data,"text","royal_list",del_royal_res,"");
	}
}

function del_royal_res(response){	
	if(trim_string(response) === "1"){
		load_royal_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_royal(rel){
	document.getElementById("data_form").style.display = "block";	
	$('input#roy_id').val($('div#roy_id'+rel).html());
	$("select#roy_year").val($('div#roy_year'+rel).html());
	$("input#roy_no1").val($('div#roy_no1'+rel).html());
	$("input#roy_no2").val($('div#roy_no2'+rel).html());
	$('input#roy_name').val($('div#roy_name'+rel).html());
    
	if($('div#status_royal'+rel).html() == "1"){
		document.royal.status_royal[0].checked="checked";
	}else if($('div#status_royal'+rel).html() == "2"){
		document.royal.status_royal[1].checked="checked";
	}
	
    $("input#roy_date").val($('div#roy_date'+rel).html());
	$("input#roy_date_re").val($('div#roy_date_re'+rel).html());
	$('input#date_sen').val($('div#date_sen'+rel).html());
    $("input#roy_note").val($('div#roy_note'+rel).html());
    $("textarea#roy_note").val($('div#roy_note'+rel).html());

}