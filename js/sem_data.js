// JavaScript Document
function load_sem_table(){
		ajaxPostData("seminar_data_table.php","","text","seminar_list",load_sem_table_res,"");
}

function load_sem_table_res(response){	
		$('div#seminar_list').html(response);	
}

function del_seminar(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"&SEM_FILE="+file;
	ajaxPostData("seminar_data_del.php",data,"text","seminar_list",del_seminar_res,"");
	}
}

function del_seminar_res(response){	
	if(response == "1"){
		load_sem_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_seminar(rel){
	document.getElementById("data_form").style.display = "block";
    $('input#sem_order_no').val($('div#sem_order_no'+rel).html());
	$('input#sem_who_name').val($('div#sem_who_name'+rel).html());
	$('input#sem_who_position').val($('div#sem_who_position'+rel).html());
	$("select#sem_depart").val($('div#sem_depart'+rel).html()); 
	$("select#sem_type").val($('div#sem_type'+rel).html()); 
	$('input#sem_course_name').val($('div#sem_course_name'+rel).html());
	$('input#sem_start_date').val($('div#sem_start_date'+rel).html());
	$('input#sem_end_date').val($('div#sem_end_date'+rel).html());
	$('input#sem_long').val($('div#sem_long'+rel).html());
	$('input#sem_place').val($('div#sem_place'+rel).html());
	$('input#sem_by').val($('div#sem_by'+rel).html());
	$('input#sem_point').val($('div#sem_point'+rel).html());

	if($('div#sem_expense'+rel).html() == "1"){
		document.seminar.sem_expense[0].checked="checked";
		$('input#sem_free_expense').val($('div#sem_free_expense'+rel).html());
		
	}else if($('div#sem_expense'+rel).html() == "2"){
		document.seminar.sem_expense[1].checked="checked";
		$('input#sem_expenses').val($('div#sem_expenses'+rel).html());
		$('input#sem_money_type').val($('div#sem_money_type'+rel).html());
		
		}
	$('textarea#sem_benefit').val($('div#sem_benefit'+rel).html());
	$('textarea#sem_improve').val($('div#sem_improve'+rel).html());
	$('textarea#sem_suggestion').val($('div#sem_suggestion'+rel).html());
	$('textarea#sem_chief_adv').val($('div#sem_chief_adv'+rel).html());
	$('input#sem_chief_adv').val($('div#sem_chief_adv'+rel).html());
	$('input#sem_chief').val($('div#sem_chief'+rel).html());
	$('input#hid_sem_file').val($('div#sem_file'+rel).html());
	$('input#sem_id').val($('div#sem_id'+rel).html());
}