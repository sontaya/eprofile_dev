// JavaScript Document// JavaScript Document

function load_cwk_table(){
		ajaxPostData("current_work_data_table.php","","text","current_work_list",load_cwk_table_res,"");
}

function load_cwk_table_res(response){	
		$('div#current_work_list').html(response);	
}

function del_cwk(id){
	//alert(id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("current_work_del.php",data,"text","current_work_list",cwk_data_del_list,"");
	}
}

function cwk_data_del_list(response){	
		load_cwk_table();
	
}

function edit_cwk(rel){
	//alert("ok");
	document.getElementById("data_form").style.display = "block";
	$('select#cwk_status').val($('div#cwk_status'+rel).html());
	$('input#ch_id').val($('div#ch_id'+rel).html());
	$('input#cwk_id').val($('div#cwk_id'+rel).html());
	$('select#cwk_mua_emp_type').val($('div#cwk_mua_emp_type'+rel).html());
	$('select#cwk_mua_emp_subtype').val($('div#cwk_mua_emp_subtype'+rel).html());
	
	$('select#cwk_mua_main').val($('div#cwk_mua_main'+rel).html());
	$('select#cwk_mua_submain').val($('div#cwk_mua_submain'+rel).html());
	$('select#cwk_mua_work_group').val($('div#cwk_mua_work_group'+rel).html());
	$('select#cwk_dsu_edu_center').val($('div#cwk_dsu_edu_center'+rel).html());
	$('select#cwk_dsu_pos').val($('div#cwk_dsu_pos'+rel).html());
	$('select#cwk_mua_vpos').val($('div#cwk_mua_vpos'+rel).html());
	
	$('select#cwk_mua_level').val($('div#cwk_mua_level'+rel).html());
	$('select#cwk_mua_mpos').val($('div#cwk_mua_mpos'+rel).html());
	$('input#cwk_start_work_date').val($('div#cwk_start_work_date'+rel).html());
	$('input#cwk_end_work_date').val($('div#cwk_end_work_date'+rel).html());
	
	$('input#cwk_start_work_hour').val($('div#cwk_start_work_hour'+rel).html());
	$('input#cwk_start_work_min').val($('div#cwk_start_work_min'+rel).html());
	$('input#cwk_end_work_hour').val($('div#cwk_end_work_hour'+rel).html());
	$('input#cwk_end_work_min').val($('div#cwk_end_work_min'+rel).html());
	
	$('input#cwk_start_teach_date').val($('div#cwk_start_teach_date'+rel).html());
	$('input#cwk_order1').val($('div#cwk_order1'+rel).html());
	$('input#cwk_promote_date').val($('div#cwk_promote_date'+rel).html());
	$('input#cwk_order2').val($('div#cwk_order2'+rel).html());
	
	$('input#cwk_phone').val($('div#cwk_phone'+rel).html());
	$('select#cwk_edu_group1').val($('div#cwk_edu_group1'+rel).html());
	$('select#cwk_edu_group2').val($('div#cwk_edu_group2'+rel).html());
	$('select#cwk_edu_group3').val($('div#cwk_edu_group3'+rel).html());
	
	$('select#cwk_salary_time_type').val($('div#cwk_salary_time_type'+rel).html());
	
	$('input#cwk_sat').val($('div#cwk_sat'+rel).html());
	
	/*if($('div#cwk_sat'+rel).html() == "1"){
      document.scholar.cwk_sat[0].checked="checked";
   }else if($('div#cwk_sat'+rel).html() == "2"){
      document.scholar.cwk_sat[1].checked="checked";
   }*/
	
	$('select#cwk_start_work').val($('div#cwk_start_work'+rel).html());
	$('select#cwk_end_work').val($('div#cwk_end_work'+rel).html());
	$('input#date_m').val($('div#date_m'+rel).html());
	
	$('input#no').val($('div#no'+rel).html());
	
	
	$('input#cwk_teach_order').val($('div#cwk_teach_order'+rel).html());
	$('input#cwk_promote_order').val($('div#cwk_promote_order'+rel).html());
	$('input#position_code').val($('div#position_code'+rel).html());
	// window.top.change_data('current_woek.php','../images/head2/work_data/scholar.png');
	
	
	

}// JavaScript Document