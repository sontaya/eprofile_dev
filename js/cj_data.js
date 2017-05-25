// JavaScript Document// JavaScript Document

function load_cj_table(){
	ajaxPostData("change_job_table.php","","text","cj_list",load_cj_table_res,"");
}

function load_img_table(s_id){
	//alert(s_id);
	if(s_id){
		var data = "s_id="+s_id+"|CJ|cj_file";
		ajaxPostData("upload_ing_all.php",data,"text","img_list_s",load_img_table_res,"");
	}
}

function load_cj_table_res(response){	
	$('div#cj_list').html(response);	
}

function load_img_table_res(response){	
	//alert(response);
	$('div#img_list_s').html(response);	
	document.getElementById("img_list_s").innerHTML=response;
	load_cj_table();
}

function del_cj(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
		var data = "ID="+id;
		ajaxPostData("change_job_del.php",data,"text","cj_list",del_cj_res,"");
	}
}

function del_cj_res(response){	
	if(response == "1"){
		load_cj_table();
	}else{
		load_cj_table();
	}
}

function del_img(id,s_id){
    //alert(s_id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
		var data = "ID="+id+"|CJ";
		ajaxPostData("sector_transfer_data_img_del.php",data,"text","img_list_s",del_img_res,"");
	}
}

function del_img_res(response){
    var s_id = $('#cj_id').val();
	if(response == "1"){
		load_img_table(s_id);
	}else{
		load_img_table(s_id);
	}
}


function edit_cj(rel,s_id){
	
	//console.log(rel);
	document.getElementById("data_form").style.display = "block";
    document.getElementById("toggle_form").style.display = "none";
    if(s_id){
		load_img_table(s_id);
	}
    
    $("input#cj_id").val($('div#cj_id'+rel).html());
    
	if($('div#definition'+rel).html() == "1"){
		document.change_job.definition[0].checked="checked";
        $("#box_one").show();
        $("#box_one2").show();
        $("#box_one3").show();
        $("#box_one4").show();
        $("#box_one5").show();
        $("#box_one6").show();
        $("#box_one7").show();
        $("#box_one8").show();
        $("#box_one9").show();
        $("input#definition_ck").val(1);
	}else if($('div#definition'+rel).html() == "2"){
		document.change_job.definition[1].checked="checked";
        $("#box_one").hide();
        $("#box_one2").hide();
        $("#box_one3").hide();
        $("#box_one4").hide();
        $("#box_one5").hide();
        $("#box_one6").hide();
        $("#box_one7").hide();
        $("#box_one8").hide();
        $("#box_one9").hide();
        $("input#definition_ck").val(2);
	}
    
    $("input#cj_order_no").val($('div#cj_order_no'+rel).html());
    $("input#cj_at").val($('div#cj_at'+rel).html());
    $("input#cj_at_date").val($('div#cj_at_date'+rel).html());
    
    $("input#cj_instructor").val($('div#cj_instructor'+rel).html());
    $("select#cj_mua_main_test").val($('div#cj_mua_main_test'+rel).html());
	change_depsub($("select#cj_mua_main_test").val(),"cj_mua_submain_test");
    $("select#cj_mua_submain_test").val($('div#cj_mua_submain_test'+rel).html());
    $("select#cj_dsu_edu_center_test").val($('div#cj_dsu_edu_center_test'+rel).html());
    $("input#start_dates_test").val($('div#start_dates_test'+rel).html());
    $("input#end_dates_test").val($('div#end_dates_test'+rel).html());
    $("input#term_test").val($('div#term_test'+rel).html());
    //$("input#test_type").val($('div#test_type'+rel).html());
    if($('div#test_type'+rel).html() == "1"){
		document.change_job.test_type[0].checked="checked";
        $("#box_one").show();
        $("#box2_one2").show();
        $("#box2_one3").show();
        $("#box2_one4").show();
        $("#box2_one5").show();
        $("#box2_one6").show();
        $("#box2_one7").show();
        $("#box2_one8").show();
        $("#box2_one9").show();
        $("#box2_one10").show();
        $("#box2_one11").show();
        $("#box2_one12").show();
        $("#box2_one13").show();
        $("#box2_one14").show();
        $("#box2_one15").show();
        $("#box2_one16").show();
        $("#box2_one17").show();
        $("input#test_type_ck").val(1);
	}else if($('div#test_type'+rel).html() == "2"){
		document.change_job.test_type[1].checked="checked";
        $("#box2_one").hide();
        $("#box2_one2").hide();
        $("#box2_one3").hide();
        $("#box2_one4").hide();
        $("#box2_one5").hide();
        $("#box2_one6").hide();
        $("#box2_one7").hide();
        $("#box2_one8").hide();
        $("#box2_one9").hide();
        $("#box2_one10").hide();
        $("#box2_one11").hide();
        $("#box2_one12").hide();
        $("#box2_one13").hide();
        $("#box2_one14").hide();
        $("#box2_one15").hide();
        $("#box2_one16").hide();
        $("#box2_one17").hide();
        $("input#test_type_ck").val(2);
	}
    $("textarea#test_noet").val($('div#test_noet'+rel).html());
    
    $("input#cj_order_no_two").val($('div#cj_order_no_two'+rel).html());
    $("input#cj_at_two").val($('div#cj_at_two'+rel).html());
    $("input#cj_at_date_two").val($('div#cj_at_date_two'+rel).html());
    
    $("select#cj_mua_emp_type").val($('div#cj_mua_emp_type'+rel).html());
    $("select#cj_mua_main").val($('div#cj_mua_main'+rel).html());
	change_depsub($("select#cj_mua_main").val(),"cj_mua_submain");
    $("select#cj_mua_submain").val($('div#cj_mua_submain'+rel).html());
    $("select#cj_dsu_edu_center").val($('div#cj_dsu_edu_center'+rel).html());
    $("select#cj_current_history").val($('div#cj_current_history'+rel).html());
    $("input#cj_munny_history").val($('div#cj_munny_history'+rel).html());
    
    $("select#cj_mua_emp_type2").val($('div#cj_mua_emp_type2'+rel).html());
    $("select#cj_mua_main2").val($('div#cj_mua_main2'+rel).html());
	change_depsub($("select#cj_mua_main2").val(),"cj_mua_submaintwo");
    $("select#cj_mua_submaintwo").val($('div#cj_mua_submain2'+rel).html());
    $("select#cj_dsu_edu_center2").val($('div#cj_dsu_edu_center2'+rel).html());
    $("select#cj_current_history2").val($('div#cj_current_history2'+rel).html());
    $("input#cj_munny_history2").val($('div#cj_munny_history2'+rel).html());
    
    $("input#start_dates").val($('div#start_dates'+rel).html());
    $("input#end_dates").val($('div#end_dates'+rel).html());
    $("checkbox#start_ck").val($('div#start_ck'+rel).html());  
    $("textarea#cj_note").val($('div#cj_note'+rel).html());
    $("input#start_st").val($('div#start_cj'+rel).html());
    
   // $("input#definition_ck").val($('div#definition_ck'+rel).html());
   // $("input#test_type_ck").val($('div#test_type_ck'+rel).html());
}