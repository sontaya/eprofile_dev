// JavaScript Document// JavaScript Document

function load_da_table(){
		ajaxPostData("data_answer_table.php","","text","da_list",load_da_table_res,"");
}

function load_img_table(s_id){
        //alert(s_id);
        if(s_id){
	    var data = "s_id="+s_id+"|DA|da_file";
		ajaxPostData("upload_ing_all.php",data,"text","img_list_s",load_img_table_res,"");
        }
}

function load_da_table_res(response){	
		$('div#da_list').html(response);	
}

function load_img_table_res(response){	
        //alert(response);
		$('div#img_list_s').html(response);	
        document.getElementById("img_list_s").innerHTML=response;
        load_da_table();
}

function del_da(id,file){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("data_answer_del.php",data,"text","da_list",del_da_res,"");
	}
}

function del_da_res(response){	
	if(response == "1"){
		load_da_table();
	}else{
		load_da_table();
	}
}

function del_img(id,s_id){
    //alert(s_id);
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id+"|DA";
	ajaxPostData("sector_transfer_data_img_del.php",data,"text","img_list_s",del_img_res,"");
	}
}

function del_img_res(response){
    var s_id = $('#da_id').val();
	if(response == "1"){
		load_img_table(s_id);
	}else{
		load_img_table(s_id);
	}
}


function edit_da(rel,s_id){
	//console.log(rel);
	document.getElementById("data_form").style.display = "block";
    document.getElementById("toggle_form").style.display = "none";
    if(s_id){
    load_img_table(s_id);
	}
    
    $("input#da_id").val($('div#da_id'+rel).html());
    
    $("input#da_order_no").val($('div#da_order_no'+rel).html());
    $("input#da_at").val($('div#da_at'+rel).html());
    $("input#da_at_date").val($('div#da_at_date'+rel).html());
    
    $("select#type_munny").val($('div#type_munny'+rel).html());
    $("select#location_munny").val($('div#location_munny'+rel).html());
    $("input#munny_da").val($('div#munny_da'+rel).html());
 
    
    $("input#start_dates").val($('div#start_dates'+rel).html());
    $("input#end_dates").val($('div#end_dates'+rel).html());
    $("checkbox#start_ck").val($('div#start_ck'+rel).html());  
    $("textarea#da_note").val($('div#da_note'+rel).html());
}