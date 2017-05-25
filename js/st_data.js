// JavaScript Document// JavaScript Document

function load_st_table(){
		ajaxPostData("sector_transfer_table.php","","text","st_list",load_st_table_res,"");
}
function load_img_table(s_id){
        //alert(s_id);
        if(s_id){
	    var data = "s_id="+s_id+"|ST|st_file";
		ajaxPostData("upload_ing_all.php",data,"text","img_list_s",load_img_table_res,"");
        }
}

function load_st_table_res(response){	
		$('div#st_list').html(response);	
}
 
function load_img_table_res(response){	
        //alert(response);
		$('div#img_list_s').html(response);	
        document.getElementById("img_list_s").innerHTML=response;
        load_st_table();
}

function del_st(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("sector_transfer_data_del.php",data,"text","st_list",del_st_res,"");
	}
}

function del_st_res(response){
   // alert(response);
	if(response == "1"){
		load_st_table();
	}else{
		load_st_table();
	}
}

function del_img(id,s_id){
   // alert(s_id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"|ST";
	ajaxPostData("sector_transfer_data_img_del.php",data,"text","img_list_s",del_img_res,"");
	}
}

function del_img_res(response){
    var s_id = $('#st_id').val();
	if(response == "1"){
		load_img_table(s_id);
	}else{
		load_img_table(s_id);
	}
}

function edit_st(rel,s_id){
	//console.log(rel);
	document.getElementById("data_form").style.display = "block";
    document.getElementById("toggle_form").style.display = "none";
    if(s_id){
    load_img_table(s_id);
	}
    
    $("input#st_id").val($('div#st_id'+rel).html());
    
	if($('div#type_st'+rel).html() == "1"){
		document.sector_tranfer.type_st[0].checked="checked";
	}else if($('div#type_st'+rel).html() == "2"){
		document.sector_tranfer.type_st[1].checked="checked";
	}else if($('div#type_st'+rel).html() == "3"){
		document.sector_tranfer.type_st[2].checked="checked";
	}else if($('div#type_st'+rel).html() == "4"){
		document.sector_tranfer.type_st[3].checked="checked";
	}
    
    $("input#st_order_no").val($('div#st_order_no'+rel).html());
    $("input#st_at").val($('div#st_at'+rel).html());
    $("input#st_at_date").val($('div#st_at_date'+rel).html());
    
    $("select#st_mua_emp_type").val($('div#st_mua_emp_type'+rel).html());
    $("select#st_mua_main").val($('div#st_mua_main'+rel).html());
    $("select#st_mua_submain").val($('div#st_mua_submain'+rel).html());
    $("select#st_dsu_edu_center").val($('div#st_dsu_edu_center'+rel).html());
    $("select#st_current_history").val($('div#st_current_history'+rel).html());
    $("input#st_munny_history").val($('div#st_munny_history'+rel).html());
    
    $("select#st_mua_emp_type2").val($('div#st_mua_emp_type2'+rel).html());
    $("select#st_mua_main2").val($('div#st_mua_main2'+rel).html());
    $("select#st_mua_submain2").val($('div#st_mua_submain2'+rel).html());
    $("select#st_dsu_edu_center2").val($('div#st_dsu_edu_center2'+rel).html());
    $("select#st_current_history2").val($('div#st_current_history2'+rel).html());
    $("input#st_munny_history2").val($('div#st_munny_history2'+rel).html());
    
    $("input#start_dates").val($('div#start_dates'+rel).html());
    $("input#end_dates").val($('div#end_dates'+rel).html());
    $("checkbox#start_ck").val($('div#start_ck'+rel).html());  
    $("textarea#st_note").val($('div#st_note'+rel).html());
    $("input#start_st").val($('div#start_st'+rel).html());

}