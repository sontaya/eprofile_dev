// JavaScript Document
function load_app_table(){
		ajaxPostData("appraise_data_table.php","","text","appraise_list",load_app_table_res,"");
}

function load_app_table_res(response){	
		$('div#appraise_list').html(response);	
}

function del_app(emp_id,year){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "EMP_ID="+emp_id+"&APR_YEAR="+year;
	ajaxPostData("appraise_data_del.php",data,"text","appraise_list",del_app_res,"");
	}
}

function del_app_res(response){	
	if(response == "1"){
		load_app_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_app(rel){
	document.getElementById("data_form").style.display = "block";
	$("select#apr_type").val($('div#apr_type'+rel).html()); 
	$('select#apr_year').val($('div#apr_year'+rel).html());
	if($('div#apr_result'+rel).html() == "5"){
		document.appraise_data.apr_result[0].checked="checked";
	}else if($('div#apr_result'+rel).html() == "4"){
		document.appraise_data.apr_result[1].checked="checked";
	}else if($('div#apr_result'+rel).html() == "3"){
		document.appraise_data.apr_result[2].checked="checked";
	}else if($('div#apr_result'+rel).html() == "2"){
		document.appraise_data.apr_result[3].checked="checked";
	}else if($('div#apr_result'+rel).html() == "1"){
		document.appraise_data.apr_result[4].checked="checked";
	}
	
	$('input#apr_score').val($('div#apr_score'+rel).html());
	$("textarea#apr_dev_comment").val($('div#apr_dev_comment'+rel).html()); 
		
	if($('div#apr_type'+rel).html() == "ข้าราชการ/ลูกจ้างประจำ"){
		change_txt("ข้าราชการ/ลูกจ้างประจำ");
		if($('div#apr_salary_step'+rel).html() == "1"){
			document.appraise_data.apr_salary_step[0].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "0.5"){
			document.appraise_data.apr_salary_step[1].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "0"){
			document.appraise_data.apr_salary_step[2].checked="checked";
		}
	}else{
		change_txt("ลูกจ้างทั่วไป");
		if($('div#apr_salary_percent'+rel).html() == "8"){
			document.appraise_data.apr_salary_percent[0].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "6"){
			document.appraise_data.apr_salary_percent[1].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "4"){
			document.appraise_data.apr_salary_percent[2].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "2"){
			document.appraise_data.apr_salary_percent[3].checked="checked";
		}else if($('div#apr_salary_step'+rel).html() == "0"){
			document.appraise_data.apr_salary_percent[4].checked="checked";
		}
	}
	
	$('textarea#apr_salary_reason').val($('div#apr_salary_reason'+rel).html());
	$('input#apr_by_name').val($('div#apr_by_name'+rel).html());
	$('input#apr_by_pos').val($('div#apr_by_pos'+rel).html());
	$('input#apr_date').val($('div#apr_date'+rel).html());
	
	if($('div#apr_up_comment'+rel).html() == "1"){
		document.appraise_data.apr_up_comment[0].checked="checked";
		$('textarea#apr_up_reason').val("");
	}else{
		document.appraise_data.apr_up_comment[1].checked="checked";
		$('textarea#apr_up_reason').val($('div#apr_up_reason'+rel).html());
	}
	
}