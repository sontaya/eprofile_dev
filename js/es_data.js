// JavaScript Document// JavaScript Document
function load_es_table(){
		ajaxPostData("estimate_service_table.php","","text","es_list",load_es_table_res,"");
}

function load_img_table(s_id){
        //alert(s_id);
        if(s_id){
	    var data = "s_id="+s_id+"|ES|es_file";
		ajaxPostData("upload_ing_all.php",data,"text","img_list_s",load_img_table_res,"");
        }
}

function load_es_table_res(response){	
		$('div#es_list').html(response);	
}

function load_img_table_res(response){	
        //alert(response);
		$('div#img_list_s').html(response);	
        document.getElementById("img_list_s").innerHTML=response;
        load_es_table();
}

function del_es(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("estimate_service_del.php",data,"text","es_list",del_es_res,"");
	}
}

function del_es_res(response){	
	if(response == "1"){
		load_es_table();
	}else{
		load_es_table();
	}
}

function del_img(id,s_id){
    //alert(s_id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"|ES";
	ajaxPostData("sector_transfer_data_img_del.php",data,"text","img_list_s",del_img_res,"");
	}
}

function del_img_res(response){
    var s_id = $('#es_id').val();
	if(response == "1"){
		load_img_table(s_id);
	}else{
		load_img_table(s_id);
	}
}


function edit_es(rel,s_id){
	//console.log(rel);
	document.getElementById("data_form").style.display = "block";
    document.getElementById("toggle_form").style.display = "none";
    if(s_id){
    load_img_table(s_id);
	}
    
    $("input#es_id").val($('div#es_id'+rel).html());
    $("select#rate_year").val($('div#rate_year'+rel).html());
    
	if($('div#episode_no'+rel).html() == "1"){
		document.estimate_service.episode_no[0].checked="checked";
	}else if($('div#episode_no'+rel).html() == "2"){
		document.estimate_service.episode_no[1].checked="checked";
	}
    
    $("input#name_rate").val($('div#name_rate'+rel).html());
    $("input#pis_rate").val($('div#pis_rate'+rel).html());
    $("select#p_sdu_one").val($('div#p_sdu_one'+rel).html());
    
    $("select#achieve_one").val($('div#achieve_one'+rel).html());
    $("input#achieve_quantity_one").val($('div#achieve_quantity_one'+rel).html());
    $("select#achieve_two").val($('div#achieve_two'+rel).html());
    $("input#achieve_quantity_two").val($('div#achieve_quantity_two'+rel).html());
    $("select#achieve_tree").val($('div#achieve_tree'+rel).html());
    $("input#achieve_quantity_tree").val($('div#achieve_quantity_tree'+rel).html());
    
    $("select#p_sdu_two").val($('div#p_sdu_two'+rel).html());
    $("input#quantity_fig_1").val($('div#quantity_fig_1'+rel).html());
    $("input#quantity_new_1").val($('div#quantity_new_1'+rel).html());
    $("input#quantity_fig_2").val($('div#quantity_fig_2'+rel).html());
    $("input#quantity_new_2").val($('div#quantity_new_2'+rel).html());
    
    $("input#quantity_fig_3").val($('div#quantity_fig_3'+rel).html());
    $("input#quantity_new_3").val($('div#quantity_new_3'+rel).html());
    $("input#quantity_fig_4").val($('div#quantity_fig_4'+rel).html());
    $("input#quantity_new_4").val($('div#quantity_new_4'+rel).html());
    $("input#quantity_fig_5").val($('div#quantity_fig_5'+rel).html());
    $("input#quantity_new_5").val($('div#quantity_new_5'+rel).html());
    
    $("input#quantity_fig_6").val($('div#quantity_fig_6'+rel).html());
    $("input#quantity_new_6").val($('div#quantity_new_6'+rel).html());
    $("input#quantity_fig_7").val($('div#quantity_fig_7'+rel).html());
    $("input#quantity_new_7").val($('div#quantity_new_7'+rel).html());
    $("input#quantity_fig_8").val($('div#quantity_fig_8'+rel).html());
    $("input#quantity_new_8").val($('div#quantity_new_8'+rel).html());
    
    $("input#quantity_fig_9").val($('div#quantity_fig_9'+rel).html());
    $("input#quantity_new_9").val($('div#quantity_new_9'+rel).html());
    $("input#quantity_fig_10").val($('div#quantity_fig_10'+rel).html());
    $("input#quantity_new_10").val($('div#quantity_new_10'+rel).html());
    $("input#quantity_fig_all").val($('div#quantity_fig_all'+rel).html());
    $("input#quantity_new_all").val($('div#quantity_new_all'+rel).html());
    
    $("input#sdu_quantity_fig_one").val($('div#sdu_quantity_fig_one'+rel).html());
    $("input#sdu_quantity_new_one").val($('div#sdu_quantity_new_one'+rel).html());
    $("input#sdu_quantity_fig_two").val($('div#sdu_quantity_fig_two'+rel).html());
    $("input#sdu_quantity_new_two").val($('div#sdu_quantity_new_two'+rel).html());
    
    if($('div#level_quantity'+rel).html() == "5"){
		document.estimate_service.level_quantity[0].checked="checked";
	}else if($('div#level_quantity'+rel).html() == "4"){
		document.estimate_service.level_quantity[1].checked="checked";
	}else if($('div#level_quantity'+rel).html() == "3"){
		document.estimate_service.level_quantity[2].checked="checked";
	}else if($('div#level_quantity'+rel).html() == "2"){
		document.estimate_service.level_quantity[3].checked="checked";
	}else if($('div#level_quantity'+rel).html() == "1"){
		document.estimate_service.level_quantity[4].checked="checked";
	}
   
    
    $("textarea#noet_one").val($('div#noet_one'+rel).html());
    $("textarea#noet_two").val($('div#noet_two'+rel).html());
    
    $("input#quantity_fig_now_one").val($('div#quantity_fig_now_one'+rel).html());
    $("input#quantity_new_now_one").val($('div#quantity_new_now_one'+rel).html());
    

}