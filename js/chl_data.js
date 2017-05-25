// JavaScript Document
function load_chl_table(){
		ajaxPostData("children_data_table.php","","text","children_list",load_chl_table_res,"");
}

function load_chl_table_res(response){	
		$('div#children_list').html(response);	
}

function del_chl(emp_id,rel,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "EMP_ID="+emp_id+"&CHL_CODE_ID="+rel+"&CHL_CEN_FILE="+file;
	ajaxPostData("children_data_del.php",data,"text","children_list",del_chl_res,"");
	}
}

function del_chl_res(response){	
	if(response == "1"){
		load_chl_table();
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
	}
}

function edit_chl(rel){
	document.getElementById("data_form").style.display = "block";
	$("select#chl_title_th").val($('div#chl_title_th'+rel).html()); 
	$('input#chl_fname_th').val($('div#chl_fname_th'+rel).html());
	$('input#chl_mname_th').val($('div#chl_mname_th'+rel).html());
	$('input#chl_lname_th').val($('div#chl_lname_th'+rel).html());
	$("select#chl_title_en").val($('div#chl_title_en'+rel).html()); 
	$('input#chl_fname_en').val($('div#chl_fname_en'+rel).html());
	$('input#chl_mname_en').val($('div#chl_mname_en'+rel).html());
	$('input#chl_lname_en').val($('div#chl_lname_en'+rel).html());
	//document.getElementById("chl_sex").checked="checked";
	if($('div#chl_sex'+rel).html() == "male"){
		document.children_data.chl_sex[0].checked="checked";
	}else if($('div#chl_sex'+rel).html() == "female"){
		document.children_data.chl_sex[1].checked="checked";
		}
	
	var nation_code3 = $('div#chl_nation1'+rel).html()
	var nation_name3 = $('#chl_nation_name1'+rel).html();
	$("span#nation9").html("<input type='hidden' id='chl_nation1' name='chl_nation1' value='"+nation_code3+"'><input readonly='readonly' type='text' value='"+nation_name3+"' style='width:130px;'>");
	
	var nation_code4 = $('div#chl_nation2'+rel).html()
	var nation_name4 = $('#chl_nation_name2'+rel).html();
	$("span#nation7").html("<input type='hidden' id='chl_nation2' name='chl_nation2' value='"+nation_code4+"'><input readonly='readonly' type='text' value='"+nation_name4+"' style='width:130px;'>");
	
	$('select#chl_religion').val($('div#chl_religion'+rel).html());
	$('input#chl_birthday').val($('div#chl_birthday'+rel).html());
	Age('chl_birthday','chl_s_year','chl_s_month');
	if($('div#chl_alive'+rel).html() == "1"){
		document.children_data.chl_alive[0].checked="checked";
	}else if($('div#chl_alive'+rel).html() == "2"){
		document.children_data.chl_alive[1].checked="checked";
	}else if($('div#chl_alive'+rel).html() == "3"){
		document.children_data.chl_alive[2].checked="checked";
		}
	$('input#chl_school').val($('div#chl_school'+rel).html());
	$('input#chl_sch_amphur').val($('div#chl_sch_amphur'+rel).html());
	$('input#chl_sch_province').val($('div#chl_sch_province'+rel).html());
	$('input#chl_sch_level').val($('div#chl_sch_level'+rel).html());
	$('input#chl_code_id').val($('div#chl_code_id'+rel).html());
	//document.children_data.chl_code_id.readOnly="readonly";
	$("select#chl_relation").val($('div#chl_relation'+rel).html()); 
	$('input#chl_occupation').val($('div#chl_occupation'+rel).html());
	$('input#chl_work_place').val($('div#chl_work_place'+rel).html());
	$('input#chl_mobile').val($('div#chl_mobile'+rel).html());
	$('input#chl_work_phone').val($('div#chl_work_phone'+rel).html());
	$('input#chl_email').val($('div#chl_email'+rel).html());
	$('input#chl_house_no').val($('div#chl_house_no'+rel).html());
	$('input#chl_moo').val($('div#chl_moo'+rel).html());
	$('input#chl_building').val($('div#chl_building'+rel).html());
	$('input#chl_village').val($('div#chl_village'+rel).html());
	$('input#chl_room').val($('div#chl_room'+rel).html());
	$('input#chl_soi').val($('div#chl_soi'+rel).html());
	$('input#chl_road').val($('div#chl_road'+rel).html());
	
	var tumbon = $('div#chl_tumbon'+rel).html()
	var amphur = $('div#chl_amphur'+rel).html()
	var province = $('div#chl_province'+rel).html()
	var n1 = $('#chl_tumbon_name'+rel).html();
	var n2 = $('#chl_amphur_name'+rel).html();
	var n3 = $('#chl_province_name'+rel).html();
	
	$("span#tumbon2").html("<input type='hidden' id='chl_tumbon' name='chl_tumbon' value='"+tumbon+"'><input readonly='readonly' type='text' value='"+n1+"' style='width:120px;'>");
	$("div#amphur2").html("<input type='hidden' id='chl_amphur' name='chl_amphur' value='"+amphur+"'><input readonly='readonly' type='text' value='"+n2+"' style='width:120px;'>");
	$("div#province2").html("<input type='hidden' id='chl_province' name='chl_province' value='"+province+"'><input readonly='readonly' type='text' value='"+n3+"' style='width:120px;'>");
	
	$('input#chl_post_code').val($('div#chl_post_code'+rel).html());
	
	var nation_code5 = $('div#chl_country'+rel).html()
	var nation_name5 = $('#chl_country_name'+rel).html();
	$("span#nation8").html("<input type='hidden' id='chl_country' name='chl_country' value='"+nation_code5+"'><input readonly='readonly' id='chl_country_text' type='text' value='"+nation_name5+"' style='width:120px;'>");
	
		
	
	$('input#chl_phone').val($('div#chl_phone'+rel).html());
	$('input#chl_fax').val($('div#chl_fax'+rel).html());
	$('input#hid_chl_cen_file').val($('div#chl_cen_file'+rel).html());
}