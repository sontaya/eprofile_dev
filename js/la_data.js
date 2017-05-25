// JavaScript Document// JavaScript Document

function load_la_table(){
		ajaxPostData("la_fund_table.php","","text","la_list",load_la_table_res,"");
}

function load_la_table_res(response){	
		$('div#la_list').html(response);	
}

function del_la(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("la_data_del.php",data,"text","la_list",del_la_res,"");
	}
}

function del_la_res(response){	
	if(response == "1"){
		load_la_table();
	}else{
		load_la_table();
	}
}

function edit_la(rel){
	document.getElementById("data_form7").style.display = "block";
	$('input#la_date_start').val($('div#la_date_start'+rel).html());
	$("input#la_end_start").val($('div#la_end_start'+rel).html());
	$('input#approve_date').val($('div#approve_date'+rel).html());
	$('input#la_order_no1').val($('div#la_order_no1'+rel).html());
	
	$('input#la_at1').val($('div#la_at1'+rel).html());
	$("input#la_at_date1").val($('div#la_at_date1'+rel).html());
	$('input#la_order_no2').val($('div#la_order_no2'+rel).html());
	$('input#la_at2').val($('div#la_at2'+rel).html());
	
	$('input#la_at_date2').val($('div#la_at_date2'+rel).html());
	$("input#approve_end_date").val($('div#approve_end_date'+rel).html());
	$('input#la_order_no3').val($('div#la_order_no3'+rel).html());
	$('input#la_at3').val($('div#la_at3'+rel).html());
	
	$('input#la_at_date3').val($('div#la_at_date3'+rel).html());
	$("input#la_order_no4").val($('div#la_order_no4'+rel).html());
	$('input#la_at4').val($('div#la_at4'+rel).html());
	$('input#la_at_date4').val($('div#la_at_date4'+rel).html());
	$('select#stop_type').val($('div#stop_type'+rel).html())
    
	$('input#id_la').val($('div#id_la'+rel).html());
	

}

function cal3(){
	  window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
	//window.top.$("span#waiting7").html("");
	//window.top.document.getElementById("contract_extend").reset();
	//window.top.$('#la_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	//window.top.$('#la_list').load('la_fund_table.php');
	//document.getElementById("data_form7").style.display = "none";
}