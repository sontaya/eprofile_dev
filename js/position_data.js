// JavaScript Document
function load_sch_ach_form(id,page){//id = list select, page =  mainpage
		var data = "page="+page;
		ajaxPostData("pos_ach_form"+id+".php",data,"text","pos_ach_form"+page,load_sch_ach_form_res,id,page);
}

function load_sch_ach_sub_form(id,page){//id = list select, page =  mainpage
		var data = "page="+page;
		ajaxPostData("pos_sub_ach_form"+id+".php",data,"text","pos_ach_form"+page,load_sch_ach_form_res,id,page);
}

function load_sch_ach_form_res(response,id,page){	
		$('div#pos_ach_form'+page).html(response);	
}

function load_ach_list(id){
	var targetWait = "pos_ach_list"+id;
	var targetFile = "pos_ach_list"+id+".php";
		ajaxPostData(targetFile,"","text",targetWait,load_ach_list_res,id);
}

function load_ach_sub_list(id){
	var targetWait = "pos_ach_list"+id;
	var targetFile = "pos_sub_ach_list"+id+".php";
		ajaxPostData(targetFile,"","text",targetWait,load_ach_list_res,id);
}

function load_ach_list_res(response,id){	
		$('div#pos_ach_list'+id).html(response);	
}

function load_pos_list(id){
	var targetWait = "pos_list"+id;
	var targetFile = "pos_list"+id+".php";
		ajaxPostData(targetFile,"","text",targetWait,load_pos_list_res,id);
}

function load_pos_sub_list(id){
	var targetWait = "pos_list"+id;
	var targetFile = "pos_sub_list"+id+".php";
		ajaxPostData(targetFile,"","text",targetWait,load_pos_list_res,id);
}

function load_pos_list_res(response,id){	
		$('div#pos_list'+id).html(response);	
}

function del_pos(id){
	var conf = window.confirm("ข้อมูลผลงานจะถูกลบทั้งหมด ยืนยันที่จะลบรายการนี้");
	if(conf){
	var targetDiv = "pos_list"+id;
	var data = "POSITION_TYPE="+id;
	ajaxPostData("position_pos_del.php",data,"text",targetDiv,del_pos_res,id);
	}
}

function del_pos_res(response,id){	
	if(response == "1"){
		load_pos_list(id);
		load_ach_list(id);
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		load_pos_list(id);
		load_ach_list(id);
	}
}

function del_sub_pos(id){
	var conf = window.confirm("ข้อมูลผลงานจะถูกลบทั้งหมด ยืนยันที่จะลบรายการนี้");
	if(conf){
	var targetDiv = "pos_list"+id;
	var data = "POSITION_TYPE="+id;
	ajaxPostData("position_pos_del.php",data,"text",targetDiv,del_pos_sub_res,id);
	}
}

function del_pos_sub_res(response,id){	
	if(response == "1"){
		load_pos_sub_list(id);
		load_ach_list(id);
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		load_pos_sub_list(id);
		load_ach_list(id);
	}
}

function del_ach(list,id,table){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var targetDiv = "pos_ach_list"+list;
	//alert(targetDiv);
	var data = "ID="+id+"&TABLE="+table;
    var respond 
	ajaxPostData("position_ach_del.php",data,"text",targetDiv,del_ach_res,list);
	}
}

function del_sub_ach(list,id,table){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var targetDiv = "pos_ach_list"+list;
	//alert(targetDiv);
	var data = "ID="+id+"&TABLE="+table;
    var respond 
	ajaxPostData("position_ach_del.php",data,"text",targetDiv,del_sub_ach_res,list);
	}
}

function del_ach_res(response,list){	
	if(response == "1"){
		load_ach_list(list);
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		load_ach_list(list);
	}
}

function del_sub_ach_res(response,list){	
	if(response == "1"){
		load_ach_sub_list(list);
	}else{
		alert("ไม่สามารถลบรายการนี้ได้");
		load_ach_sub_list(list);
	}
}

function load_edit_form1(id,course_name,course_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&course_name="+course_name;
	data += "&course_year="+course_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion ;
	data += "&page="+page;
	data += "&button="+button;
	ajaxPostData("pos_ach_form1.php",data,"text","pos_ach_form"+page,load_edit_form1_res,page);
	$("select#va_type"+page).val('1'); 
}

function load_sub_edit_form1(id,course_name,course_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&course_name="+course_name;
	data += "&course_year="+course_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion ;
	data += "&page="+page;
	data += "&button="+button;
	ajaxPostData("pos_sub_ach_form1.php",data,"text","pos_ach_form"+page,load_edit_form1_res,page);
	$("select#va_type"+page).val('1'); 
}

function load_edit_form1_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}

function load_edit_form2(id,tbook_name_th,tbook_name_en,tbook_name_oth,tbook_name_oth2,course_name,edition,volume,press_name,press_country,press_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&tbook_name_th="+tbook_name_th;
	data += "&tbook_name_en="+tbook_name_en;
	data += "&tbook_name_oth="+tbook_name_oth;
	data += "&tbook_name_oth2="+tbook_name_oth2;
	data += "&course_name="+course_name;
	data += "&edition="+edition;
	data += "&volume="+volume;
	data += "&press_name="+press_name;
	data += "&press_country="+press_country;
	data += "&press_year="+press_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_ach_form2.php",data,"text","pos_ach_form"+page,load_edit_form2_res,page);
	$("select#va_type"+page).val('2'); 
}

function load_sub_edit_form2(id,tbook_name_th,tbook_name_en,tbook_name_oth,tbook_name_oth2,course_name,edition,volume,press_name,press_country,press_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&tbook_name_th="+tbook_name_th;
	data += "&tbook_name_en="+tbook_name_en;
	data += "&tbook_name_oth="+tbook_name_oth;
	data += "&tbook_name_oth2="+tbook_name_oth2;
	data += "&course_name="+course_name;
	data += "&edition="+edition;
	data += "&volume="+volume;
	data += "&press_name="+press_name;
	data += "&press_country="+press_country;
	data += "&press_year="+press_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_sub_ach_form2.php",data,"text","pos_ach_form"+page,load_edit_form2_res,page);
	$("select#va_type"+page).val('2'); 
}

function load_edit_form2_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}

function load_edit_form3(id,book_name_th,book_name_en,book_name_oth,book_name_oth2,edition,volume,press_name,press_country,press_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&book_name_th="+book_name_th;
	data += "&book_name_en="+book_name_en;
	data += "&book_name_oth="+book_name_oth;
	data += "&book_name_oth2="+book_name_oth2;
	data += "&edition="+edition;
	data += "&volume="+volume;
	data += "&press_name="+press_name;
	data += "&press_country="+press_country;
	data += "&press_year="+press_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_ach_form3.php",data,"text","pos_ach_form"+page,load_edit_form3_res,page);
	$("select#va_type"+page).val('3'); 
}

function load_sub_edit_form3(id,book_name_th,book_name_en,book_name_oth,book_name_oth2,edition,volume,press_name,press_country,press_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&book_name_th="+book_name_th;
	data += "&book_name_en="+book_name_en;
	data += "&book_name_oth="+book_name_oth;
	data += "&book_name_oth2="+book_name_oth2;
	data += "&edition="+edition;
	data += "&volume="+volume;
	data += "&press_name="+press_name;
	data += "&press_country="+press_country;
	data += "&press_year="+press_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_sub_ach_form3.php",data,"text","pos_ach_form"+page,load_edit_form3_res,page);
	$("select#va_type"+page).val('3'); 
}

function load_edit_form3_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}

function load_edit_form4(id,research_name_th,research_name_en,research_name_oth,research_name_oth2,research_name2_th,research_name2_en,research_name2_oth,research_name2_oth2,writer,type,coop,proportion,distribute_level,journal_name,v_i_n_p,press_year,meeting_distribute_level,meeting_name,meeting_country,meeting_month,meeting_year,page,button){
	var data = "";
	data += "id="+id;
	data += "&research_name_th="+research_name_th;
	data += "&research_name_en="+research_name_en;
	data += "&research_name_oth="+research_name_oth;
	data += "&research_name_oth2="+research_name_oth2;
	data += "&research_name2_th="+research_name2_th;
	data += "&research_name2_en="+research_name2_en;
	data += "&research_name2_oth="+research_name2_oth;
	data += "&research_name2_oth2="+research_name2_oth2;
	data += "&writer="+writer;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&distribute_level="+distribute_level;
	data += "&journal_name="+journal_name;
	data += "&v_i_n_p="+v_i_n_p;
	data += "&press_year="+press_year;
	data += "&meeting_distribute_level="+meeting_distribute_level;
	data += "&meeting_name="+meeting_name;
	data += "&meeting_country="+meeting_country;
	data += "&meeting_month="+meeting_month;
	data += "&meeting_year="+meeting_year;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_ach_form4.php",data,"text","pos_ach_form"+page,load_edit_form4_res,page);
	$("select#va_type"+page).val('4'); 
}

function load_sub_edit_form4(id,research_name_th,research_name_en,research_name_oth,research_name_oth2,research_name2_th,research_name2_en,research_name2_oth,research_name2_oth2,writer,type,coop,proportion,distribute_level,journal_name,v_i_n_p,press_year,meeting_distribute_level,meeting_name,meeting_country,meeting_month,meeting_year,page,button){
	var data = "";
	data += "id="+id;
	data += "&research_name_th="+research_name_th;
	data += "&research_name_en="+research_name_en;
	data += "&research_name_oth="+research_name_oth;
	data += "&research_name_oth2="+research_name_oth2;
	data += "&research_name2_th="+research_name2_th;
	data += "&research_name2_en="+research_name2_en;
	data += "&research_name2_oth="+research_name2_oth;
	data += "&research_name2_oth2="+research_name2_oth2;
	data += "&writer="+writer;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&distribute_level="+distribute_level;
	data += "&journal_name="+journal_name;
	data += "&v_i_n_p="+v_i_n_p;
	data += "&press_year="+press_year;
	data += "&meeting_distribute_level="+meeting_distribute_level;
	data += "&meeting_name="+meeting_name;
	data += "&meeting_country="+meeting_country;
	data += "&meeting_month="+meeting_month;
	data += "&meeting_year="+meeting_year;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_sub_ach_form4.php",data,"text","pos_ach_form"+page,load_edit_form4_res,page);
	$("select#va_type"+page).val('4'); 
}

function load_edit_form4_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}

function load_edit_form5(id,article_name_th,article_name_en,article_name_oth,article_name_oth2,type,coop,proportion,distribute_journal_level,journal_name,writer,v_i_n_p,press_year,page,button){
	var data = "";
	data += "id="+id;
	data += "&article_name_th="+article_name_th;
	data += "&article_name_en="+article_name_en;
	data += "&article_name_oth="+article_name_oth;
	data += "&article_name_oth2="+article_name_oth2;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&distribute_journal_level="+distribute_journal_level;
	data += "&journal_name="+journal_name;
	data += "&writer="+writer;
	data += "&v_i_n_p="+v_i_n_p;
	data += "&press_year="+press_year;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_ach_form5.php",data,"text","pos_ach_form"+page,load_edit_form5_res,page);
	$("select#va_type"+page).val('5'); 
}

function load_sub_edit_form5(id,article_name_th,article_name_en,article_name_oth,article_name_oth2,type,coop,proportion,distribute_journal_level,journal_name,writer,v_i_n_p,press_year,page,button){
	var data = "";
	data += "id="+id;
	data += "&article_name_th="+article_name_th;
	data += "&article_name_en="+article_name_en;
	data += "&article_name_oth="+article_name_oth;
	data += "&article_name_oth2="+article_name_oth2;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&distribute_journal_level="+distribute_journal_level;
	data += "&journal_name="+journal_name;
	data += "&writer="+writer;
	data += "&v_i_n_p="+v_i_n_p;
	data += "&press_year="+press_year;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_sub_ach_form5.php",data,"text","pos_ach_form"+page,load_edit_form5_res,page);
	$("select#va_type"+page).val('5'); 
}

function load_edit_form5_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}

function load_edit_form6(id,acheive_type,acheive_name_th,acheive_name_en,acheive_name_oth,acheive_name_oth2,acheive_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&acheive_type="+acheive_type;
	data += "&acheive_name_th="+acheive_name_th;
	data += "&acheive_name_en="+acheive_name_en;
	data += "&acheive_name_oth="+acheive_name_oth;
	data += "&acheive_name_oth2="+acheive_name_oth2;
	data += "&acheive_year="+acheive_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_ach_form6.php",data,"text","pos_ach_form"+page,load_edit_form6_res,page);
	$("select#va_type"+page).val('6'); 
}

function load_sub_edit_form6(id,acheive_type,acheive_name_th,acheive_name_en,acheive_name_oth,acheive_name_oth2,acheive_year,type,coop,proportion,page,button){
	var data = "";
	data += "id="+id;
	data += "&acheive_type="+acheive_type;
	data += "&acheive_name_th="+acheive_name_th;
	data += "&acheive_name_en="+acheive_name_en;
	data += "&acheive_name_oth="+acheive_name_oth;
	data += "&acheive_name_oth2="+acheive_name_oth2;
	data += "&acheive_year="+acheive_year;
	data += "&type="+type ;
	data += "&coop="+coop ;
	data += "&proportion="+proportion;
	data += "&page="+page;
	data += "&button="+button;
	
	ajaxPostData("pos_sub_ach_form6.php",data,"text","pos_ach_form"+page,load_edit_form6_res,page);
	$("select#va_type"+page).val('6'); 
}

function load_edit_form6_res(response,page){	
		$('div#pos_ach_form'+page).html(response);	///form1=page1
}
