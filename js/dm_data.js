// JavaScript Document// JavaScript Document

function load_dm_table(){
		ajaxPostData("define_manage_table.php","","text","dm_list",load_dm_table_res,"");
}

function load_img_table(s_id){
        //alert(s_id);
        if(s_id){
	    var data = "s_id="+s_id+"|DM|dm_file";
		ajaxPostData("upload_ing_all.php",data,"text","img_list_s",load_img_table_res,"");
        }
}

function load_dm_table_res(response){	
		$('div#dm_list').html(response);	
}

function load_img_table_res(response){	
        //alert(response);
		$('div#img_list_s').html(response);	
        document.getElementById("img_list_s").innerHTML=response;
        load_dm_table();
}

function del_dm(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("define_manage_del.php",data,"text","dm_list",del_dm_res,"");
	}
}

function del_dm_res(response){	
	if(response == "1"){
		load_dm_table();
	}else{
		load_dm_table();
	}
}

function del_img(id,s_id){
    //alert(s_id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"|DM";
	ajaxPostData("sector_transfer_data_img_del.php",data,"text","img_list_s",del_img_res,"");
	}
}

function del_img_res(response){
    var s_id = $('#dm_id').val();
	if(response == "1"){
		load_img_table(s_id);
	}else{
		load_img_table(s_id);
	}
}


function edit_dm(rel,s_id){
    //alert($('div#munny_one'+rel).html());
	document.getElementById("data_form").style.display = "block";
    document.getElementById("toggle_form").style.display = "none";
    
    if(s_id){
    load_img_table(s_id);
	}
    
    $("input#dm_id").val($('div#dm_id'+rel).html());
    
    $("input#dm_order_no").val($('div#dm_order_no'+rel).html());
    $("input#dm_at").val($('div#dm_at'+rel).html());
    $("input#dm_at_date").val($('div#dm_at_date'+rel).html());
    
    $("select#dm_mua_emp_type").val($('div#dm_mua_emp_type'+rel).html());
    $("select#dm_mua_main").val($('div#dm_mua_main'+rel).html());
	change_depsub($("select#dm_mua_main").val(),"dm_mua_submain");
	$("select#dm_mua_submain").val($('div#dm_mua_submain'+rel).html());
    $("select#dm_dsu_edu_center").val($('div#dm_dsu_edu_center'+rel).html());
    $("select#dm_current_history").val($('div#dm_current_history'+rel).html());
    
    $("select#munny_dm_1").val($('div#munny_dm_1'+rel).html());
    $("select#munny_dm_2").val($('div#munny_dm_2'+rel).html());
    $("select#munny_dm_3").val($('div#munny_dm_3'+rel).html());
    $("select#munny_dm_4").val($('div#munny_dm_4'+rel).html());
    $("select#munny_dm_5").val($('div#munny_dm_5'+rel).html());
    
    $("input#start_dates").val($('div#start_dates'+rel).html());
    $("input#end_dates").val($('div#end_dates'+rel).html());
    $("textarea#dm_note").val($('div#dm_note'+rel).html());
    $("input#start_dm").val($('div#start_dm'+rel).html());
    
    $("input#munny_one").val($('div#munny_one'+rel).html());
    $("input#munny_two").val($('div#munny_two'+rel).html());
    $("input#munny_tree").val($('div#munny_tree'+rel).html());
    $("input#munny_four").val($('div#munny_four'+rel).html());
    $("input#munny_five").val($('div#munny_five'+rel).html());
    
    $("select#redo_dm_1").val($('div#redo_dm_1'+rel).html());
    $("select#redo_dm_2").val($('div#redo_dm_2'+rel).html());
    $("select#redo_dm_3").val($('div#redo_dm_3'+rel).html());
    $("select#redo_dm_4").val($('div#redo_dm_4'+rel).html());
    $("select#redo_dm_5").val($('div#redo_dm_5'+rel).html());
    
}
