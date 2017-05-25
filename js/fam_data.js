// JavaScript Document
function load_fam_table(){
   ajaxPostData("family_data_table.php","","text","family_list",load_fam_table_res,"");
}

function load_fam_table_res(response){	
   $('div#family_list').html(response);	
}

function del_fam(emp_id,rel,file){
   var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
   if(conf){
      var data = "EMP_ID="+emp_id+"&FAM_RELATION="+rel+"&FAM_CEN_FILE="+file;
      ajaxPostData("family_data_del.php",data,"text","family_list",del_fam_res,"");
   }
}

function del_fam_res(response){	
   if(response == "1"){
      load_fam_table();
   }else{
      alert("ไม่สามารถลบรายการนี้ได้");
   }
}

function edit_fam(rel){
   document.getElementById("data_form").style.display = "block";

   //document.getElementById("fam_relation").options[$('div#fam_relation'+rel).html()].selected= "selected";
   $("select#fam_relation").val($('div#fam_relation'+rel).html()); 
   $("select#fam_title_th").val($('div#fam_title_th'+rel).html()); 
   $('input#fam_fname_th').val($('div#fam_fname_th'+rel).html());
   $('input#fam_mname_th').val($('div#fam_mname_th'+rel).html());
   $('input#fam_lname_th').val($('div#fam_lname_th'+rel).html());
   $("select#fam_title_en").val($('div#fam_title_en'+rel).html()); 
   $('input#fam_fname_en').val($('div#fam_fname_en'+rel).html());
   $('input#fam_mname_en').val($('div#fam_mname_en'+rel).html());
   $('input#fam_lname_en').val($('div#fam_lname_en'+rel).html());
   //document.getElementById("fam_sex").checked="checked";
   if($('div#fam_sex'+rel).html() == "male"){
      document.family_data.fam_sex[0].checked="checked";
   }else if($('div#fam_sex'+rel).html() == "female"){
      document.family_data.fam_sex[1].checked="checked";
   }
		
   if($('div#fam_relation'+rel).html() == "3"){       
      $('#marriage_cer').show();
      if($('div#fam_marriage_cer'+rel).html() == "Y"){  
         $('#FAM_MARRIAGE_CER').attr('checked','checked'); 
      }else{
         $('#FAM_MARRIAGE_CER').removeAttr('checked');
      } 
   }else {
      $('#marriage_cer').hide();
      $('#FAM_MARRIAGE_CER').removeAttr('checked'); 
   }
   var nation_code3 = $('div#fam_nation1'+rel).html()
   var nation_name3 = $('#fam_nation_name1'+rel).html();

   $("span#nation3").html("<input type='hidden' value='"+nation_code3+"' id='fam_nation1' name='fam_nation1' style='width: 130px'><input type='text' value='"+nation_name3+"' style='width: 130px;' readonly='readonly'>");
	
   var nation_code4 = $('div#fam_nation2'+rel).html()
   var nation_name4 = $('#fam_nation_name2'+rel).html();

   $("span#nation4").html("<input type='hidden' value='"+nation_code4+"' id='fam_nation2' name='fam_nation2' style='width: 130px'><input type='text' value='"+nation_name3+"' style='width: 130px;' readonly='readonly'>");	
		
   $('select#fam_religion').val($('div#fam_religion'+rel).html());
   $('input#fam_birthday').val($('div#fam_birthday'+rel).html());
   if($('div#fam_alive'+rel).html() == "1"){
      document.family_data.fam_alive[0].checked="checked";
   }else if($('div#fam_alive'+rel).html() == "2"){
      document.family_data.fam_alive[1].checked="checked";
   }else if($('div#fam_alive'+rel).html() == "3"){
      document.family_data.fam_alive[2].checked="checked";
   }
   Age('fam_birthday','fam_s_year','fam_s_month');
   $("select#fam_status").val($('div#fam_status'+rel).html()); 
   $('input#fam_code_id').val($('div#fam_code_id'+rel).html());
   $('input#fam_id_from').val($('div#fam_id_from'+rel).html());
   $('select#fam_id_from_p').val($('div#fam_id_from_p'+rel).html());
   $('input#fam_id_date_begin').val($('div#fam_id_date_begin'+rel).html());
   $('input#fam_id_date_exp').val($('div#fam_id_date_exp'+rel).html());
   $('input#fam_occupation').val($('div#fam_occupation'+rel).html());
   $('input#fam_work_place').val($('div#fam_work_place'+rel).html());
   $('input#fam_mobile').val($('div#fam_mobile'+rel).html());
   $('input#fam_work_phone').val($('div#fam_work_phone'+rel).html());
   $('input#fam_email').val($('div#fam_email'+rel).html());
   $('input#fam_house_no').val($('div#fam_house_no'+rel).html());
   $('input#fam_moo').val($('div#fam_moo'+rel).html());
   $('input#fam_building').val($('div#fam_building'+rel).html());
   $('input#fam_village').val($('div#fam_village'+rel).html());
   $('input#fam_room').val($('div#fam_room'+rel).html());
   $('input#fam_soi').val($('div#fam_soi'+rel).html());
   $('input#fam_road').val($('div#fam_road'+rel).html());
   /*
	$('input#fam_tumbon').val($('div#fam_tumbon'+rel).html());
	$('input#fam_amphur').val($('div#fam_amphur'+rel).html());
	$('select#fam_province').val($('div#fam_province'+rel).html());*/
	
   var tumbon = $('div#fam_tumbon'+rel).html()
   var amphur = $('div#fam_amphur'+rel).html()
   var province = $('div#fam_province'+rel).html()
   var n1 = $('#fam_tumbon_name'+rel).html();
   var n2 = $('#fam_amphur_name'+rel).html();
   var n3 = $('#fam_province_name'+rel).html();
   
   var country =$('div#fam_country'+rel).html();
   var country_name =$('div#fam_country_name'+rel).html();
	
   /*
	$("span#tumbon2").html("<select id='fam_tumbon' name='fam_tumbon' style='width: 130px'><option value='"+tumbon+"'>"+n1+"</option></select>");
	$("div#amphur2").html("<select id='fam_amphur' name='fam_amphur' style='width: 130px'><option value='"+amphur+"'>"+n2+"</option></select>");
	$("div#province2").html("<select id='fam_province' name='fam_province' style='width: 130px'><option value='"+province+"'>"+n3+"</option></select>");
	*/
	
   $("span#tumbon2").html("<input type='hidden' id='fam_tumbon' name='fam_tumbon' style='width: 130px' value='"+tumbon+"'><input type='text' value='"+n1+"' readonly='readonly'>");
   $("div#amphur2").html("<input type='hidden' id='fam_amphur' name='fam_amphur' style='width: 130px' value='"+amphur+"'><input type='text' value='"+n2+"' readonly='readonly'>");
   $("div#province2").html("<input type='hidden' id='fam_province' name='fam_province' style='width: 130px' value='"+province+"'><input type='text' value='"+n3+"' readonly='readonly'>");

	
   $('input#fam_post_code').val($('div#fam_post_code'+rel).html());
	
   var nation_code5 = $('div#fam_country'+rel).html()
   var nation_name5 = $('#fam_country_name'+rel).html();
   $("span#nation5").html("<input type='hidden' value='"+nation_code5+"' id='fam_country' name='fam_country' style='width: 130px' ><input type='text' id='fam_country_text' value='"+nation_name5+"' readonly='readonly'>");
	
   $('input#fam_phone').val($('div#fam_phone'+rel).html());
   $('input#fam_fax').val($('div#fam_fax'+rel).html());
   $('input#hid_fam_cen_file').val($('div#fam_cen_file'+rel).html());
}