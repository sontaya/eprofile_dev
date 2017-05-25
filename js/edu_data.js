// JavaScript Document
function load_edu_table(){
		ajaxPostData("education_data_table.php","","text","education_list",load_edu_table_res,"");
}

function load_edu_table_res(response){	
		$('div#education_list').html(response);	
}

function del_edu(emp_id,edu_id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "EMP_ID="+emp_id+"&EDU_ID="+edu_id;
	ajaxPostData("education_data_del.php",data,"text","education_list",del_edu_res,"");
	}
}

function del_edu_res(response){	
	if(response == "1"){
		load_edu_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		load_edu_table();
	}
}


function del_edu_file(id,name){
	var conf = window.confirm("ยืนยันที่จะลบไฟล์นี้");
	if(conf){
	var data = "ID="+id+"&EDU_FILE_NAME="+name;
	ajaxPostData("edu_file_del.php",data,"text","",del_edu_file_res,"");
	}
}

function del_edu_file_res(response){	
	if(response == "1"){
		window.location.reload();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}


function edit_edu(rel){
	document.getElementById("data_form").style.display = "block";
	$('input#edu_id').val($('div#edu_id'+rel).html());
	$('select#edu_level').val($('div#edu_level'+rel).html());
	
	var nation_code3 = $('div#edu_country'+rel).html()
	var nation_name3 = $('#edu_country_name'+rel).html();
	$("span#nation10").html("<input type='hidden' id='edu_country' name='edu_country' value='"+nation_code3+"'><input type='text' readonly='readonly' value='"+nation_name3+"'>");
	
	$("select#edu_country").val($('div#edu_country'+rel).html());
	$('input#edu_name').val($('div#edu_name'+rel).html());
	$('input#edu_name_short').val($('div#edu_name_short'+rel).html());
	$('input#edu_gpa').val($('div#edu_gpa'+rel).html());
	$("input#edu_year").val($('div#edu_year'+rel).html()); 
	$('input#edu_major_name').val($('div#edu_major'+rel).html());

	
	var pro_code3 = $('div#edu_program'+rel).html()
	var pro_name3 = $('#edu_program_name'+rel).html();
	$("span#major1").html("<input type='hidden' id='edu_program' name='edu_program' value='"+pro_code3+"'><input readonly='readonly' type='text' value='"+pro_name3+"' style='width: 200px;'>");
	
	$('input#edu_from').val($('div#edu_from'+rel).html());
	
	$("input#edu_major2").val($('div#edu_major2'+rel).html()); 
	$('input#edu_program2').val($('div#edu_program2'+rel).html());
	
	if($('div#audit_check'+rel).html()=='Y'){
		$('div#check_audit_date').show();
	}
	if($('div#audit_check'+rel).html()=='Y'){
		$('checkbox#id_audit_check').val($('div#audit_check'+rel).html());
	}
	$("input#cert_confirm[value='"+$('div#cert_confirm'+rel).html()+"']").attr('checked', 'checked');
	$('input#cert_at').val($('div#cert_at'+rel).html());
	
	$("input#cert_number_at").val($('div#cert_number_at'+rel).html()); 
	$('input#cert_date').val($('div#cert_date'+rel).html());

	$('input#cert_answer_at').val($('div#cert_answer_at'+rel).html());
	
	$("input#cert_answer_number_at").val($('div#cert_answer_number_at'+rel).html()); 
	$('input#cert_answer_date').val($('div#cert_answer_date'+rel).html());

	
	$('#up_row').html("");
}