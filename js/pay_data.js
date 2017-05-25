// JavaScript Document// JavaScript Document

function load_pay_table(){
		ajaxPostData("pay_fund_table.php","","text","pay_list",load_pay_table_res,"");
}

function load_pay_table_res(response){	
		$('div#pay_list').html(response);	
}

function del_pay(id){
	//alert(id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	 var data = "ID="+id;
	 ajaxPostData("pay_data_del.php",data,del_pay_res,"");
    //  ajaxPostData("pay_data_del.php",data,"");
	window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
	window.top.$('#pay_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	window.top.$('#pay_list').load('pay_fund_table.php');
	//document.getElementById("data_form3").style.display = "none";
	}
}

function del_pay_res(response){
	alert("ok");	
	if(response == "1"){
		load_pay_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_pay(rel){
	
		document.getElementById("data_form3").style.display = "block";
	$('input#no_num').val($('div#no_num'+rel).html());
	$('input#category').val($('div#category'+rel).html());
	$('input#munny_num').val($('div#munny_num'+rel).html());
	$('input#date_opan').val($('div#date_opan'+rel).html());
	$('input#no_record').val($('div#no_record'+rel).html());
	$('input#note_c').val($('div#note_c'+rel).html());
	//$('input#wrk_id').val($('div#id_p'+rel).html());
	$('input#id_p').val($('div#id_p'+rel).html());
	$("select#contract_fund").val($('div#contract_fund'+rel).html());
	

}
function cal2(){
	window.top.$("span#waiting6").html("");
	//window.top.document.getElementById("contract_extend").reset();
	window.top.$('#pay_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	window.top.$('#pay_list').load('pay_fund_table.php');
	document.getElementById("data_form3").style.display = "none";
}