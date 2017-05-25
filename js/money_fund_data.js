// JavaScript Document

function load_money_fund_table(){
		ajaxPostData("money_fund_table.php","","text","money_fund_list",load_money_fund_res,"");
}

function load_money_fund_res(response){	
		$('div#money_fund_list').html(response);	
}

function del_money_fund(id){
	//alert(id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("money_fund_del.php",data,del_honor_res,"");
	window.top.$('#money_fund_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	window.top.$('#money_fund_list').load('money_fund_table.php');
	//document.getElementById("data_form2").style.display = "none";
	}
}

function del_money_fund_res(response){	
	if(response == "1"){
		load_honor_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		document.getElementById(form).reset();
	}
}

function edit_money_fund(rel){
	//if(typeof ele != 'undefined'){
		//alert("ok");
		document.getElementById("data_form2").style.display = "block";
	//}
		//document.getElementById("data_form2").style.display = "block";
		
	if($('div#capital'+rel).html() == "1"){
		document.money_fund.capital[0].checked="checked";
	}else if($('div#capital'+rel).html() == "2"){
		document.money_fund.capital[0].checked="checked";
	}else if($('div#capital'+rel).html() == "3"){
		document.money_fund.capital[1].checked="checked";
	}else if($('div#capital'+rel).html() == "4"){
		document.money_fund.capital[2].checked="checked";
		
	}
	$("input#ct_no").val($('div#ct_no'+rel).html());
	$('input#date_start').val($('div#date_start'+rel).html());
	$('input#date_end').val($('div#date_end'+rel).html());
	
	if($('div#flag'+rel).html() == "1"){
		document.money_fund.capital[0].checked="checked";
	}
	$('input#nb_money').val($('div#nb_money'+rel).html());
	//$("checkbox#flag").val($('div#flag'+rel).html());
	$('input#flag_date').val($('div#flag_date'+rel).html());
	$('input#note').val($('div#note'+rel).html());

	$('input#money_one').val($('div#money_one'+rel).html());
	$("input#wb_one").val($('div#wb_one'+rel).html());
	$('input#date_staer_wb_one').val($('div#date_staer_wb_one'+rel).html());
	$('input#money_two').val($('div#money_two'+rel).html());
	
	$('input#wb_two').val($('div#wb_two'+rel).html());
	$("input#date_staer_wb_two").val($('div#date_staer_wb_two'+rel).html());
	$('input#money_thee').val($('div#money_thee'+rel).html());
	$('input#wb_thee').val($('div#wb_thee'+rel).html());
	
	$('input#date_staer_wb_thee').val($('div#date_staer_wb_thee'+rel).html());
	$("input#flag_date").val($('div#flag_date'+rel).html());
	$('input#wrk_id').val($('div#wrk_id'+rel).html());
	$('input#munny_full').val($('div#munny_full'+rel).html());
	$('input#file_old_money_fund').val($('div#munny_file'+rel).html());

}

function cal(){
	window.top.$("span#waiting5").html("");
	//window.top.document.getElementById("contract_extend").reset();
	window.top.$('#money_fund_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	window.top.$('#money_fund_list').load('money_fund_table.php');
	document.getElementById("data_form2").style.display = "none";
}
// JavaScript Document