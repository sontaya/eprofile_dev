// JavaScript Document

function load_sch_table(){
   ajaxPostData("scholar_data_table.php","","text","scholar_list",load_sch_table_res,"");
}

function load_sch_table_res(response){
   $('div#scholar_list').html(response);
}

function del_sch(id){
   var conf = window.confirm("ข้อมูลชดใช้ทุน และข้อมูลขยายเวลาศึกษาต่อ จะถูกลบไปด้วย ยืนยันที่จะลบรายการนี้");
   if(conf){
      var data = "ID="+id;
      ajaxPostData("sch_data_del.php",data,"text","scholar_list",del_sch_res,"");
   }
}

function del_sch_res(response){
   if(response == "success"){
      load_sch_table();
   }else{
      alert("ไม่สามารถลบรายการนี้ได้");
      load_sch_table();
   }
}

function del_sch_ex(id_ex,emp_id){
   var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
   if(conf){
      var data = "ID="+id_ex+"&EMP_ID="+emp_id;
      ajaxPostData("sch_ex_del.php",data,"text","ex_list",del_sch_ex_res,"");
   }
}

function del_sch_ex_res(response){
   if(response == "1"){
      $('#ex_list').load('sch_ex_table.php');
   }else{
      alert("ไม่สามารถลบรายการนี้ได้");
   }
}

function del_sch_pay(pay_ref,emp_id){
   var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
   if(conf){
      var data = "PAY_REF="+pay_ref+"&EMP_ID="+emp_id;
      ajaxPostData("sch_pay_del.php",data,"text","pay_list",del_sch_pay_res,"");
   }
}

function del_sch_pay_res(response){
   if(response == "1"){
      $('#pay_list').load('sch_pay_table.php');
   }else{
      alert("ไม่สามารถลบรายการนี้ได้");
   }
}

function edit_sch(rel){
	//console.log('xxxx');
   document.getElementById("data_form").style.display = "block";
   $("input#sch_id").val($('div#sch_id'+rel).html());
   $('input#sch_order_no').val($('div#sch_order_no'+rel).html());
   $("input#sch_at").val($('div#sch_at'+rel).html());
   $("input#sch_at_date").val($('div#sch_at_date'+rel).html());
   $("input#sch_contract").val($('div#sch_contract'+rel).html());
   $("select#sch_edu_level").val($('div#sch_edu_level'+rel).html());
   if($('div#sch_type'+rel).html() == "1"){
      document.scholar.sch_type[0].checked="checked";
   }else if($('div#sch_type'+rel).html() == "2"){
      document.scholar.sch_type[1].checked="checked";
   }else if($('div#sch_type'+rel).html() == "3"){
      document.scholar.sch_type[2].checked="checked";
   }
   $("input#sch_long").val($('div#sch_long'+rel).html());
   $("input#sch_course").val($('div#sch_course'+rel).html());
   $("input#sch_course_short").val($('div#sch_course_short'+rel).html());
   $("select#sch_major").val($('div#sch_major'+rel).html());
   if($('div#sch_major'+rel).html() == "oth") {
      document.getElementById("sch_major_oth").style.display = "inline";
      $("input#sch_major_oth").val($('div#sch_major_oth'+rel).html());
   }
   $("input#sch_uni").val($('div#sch_uni'+rel).html());
   $("select#sch_country").val($('div#sch_country'+rel).html());

   $.post("ajax_get_data_ref.php", {
      task: "countryname",
      id: $('div#sch_country'+rel).html()
   },
   function(data) {
      $("input#sch_country_name").val(data);
   });

   /*$("input#sch_major").val($('div#sch_major'+rel).html());
      $.post("ajax_get_data_ref.php", {
      task: "majorname",
      id: $('div#sch_major'+rel).html()
   },
   function(data) {
      $("input#sch_major_name").val(data);
   });*/
   $("input#sch_major").val($('div#sch_major'+rel).html());
   $("input#sch_major_name").val($('div#sch_major_name'+rel).html());
   $("input#sch_money").val($('div#sch_money'+rel).html());
   $("input#sch_money1").val($('div#sch_money1'+rel).html());
   $("input#sch_money2").val($('div#sch_money2'+rel).html());
   $("input#sch_money3").val($('div#sch_money3'+rel).html());
   $("input#sch_money_date").val($('div#sch_money_date'+rel).html());
   $("input#sch_money_date1").val($('div#sch_money_date1'+rel).html());
   $("input#sch_money_date2").val($('div#sch_money_date2'+rel).html());
   $("input#sch_money_date3").val($('div#sch_money_date3'+rel).html());
   $("input#sch_source").val($('div#sch_source'+rel).html());
   $("input#sch_start_date").val($('div#sch_start_date'+rel).html());
   $("input#sch_end_date").val($('div#sch_end_date'+rel).html());
   $("input#sch_edu_start_date").val($('div#sch_edu_start_date'+rel).html());
   $("input#sch_edu_end_date").val($('div#sch_edu_end_date'+rel).html());
   $("input#sch_start_order_on").val($('div#sch_start_order_on'+rel).html()); 		
   $("input#sch_start_at_on").val($('div#sch_start_at_on'+rel).html()); 		
   $("input#sch_start_at_date").val($('div#sch_start_at_date'+rel).html()); 		
   $("textarea#sch_memo").val($('div#sch_memo'+rel).html());

   if($('div#coun_try'+rel).html() == "1"){
      document.scholar.coun_try[0].checked="checked";
   }else if($('div#coun_try'+rel).html() == "2"){
      document.scholar.coun_try[1].checked="checked";
   }
   //console.log($('div#coun_try'+rel).html());
   // $("textarea#coun_try").val($('div#coun_try'+rel).html());
	$("input#sch_order_no2").val($('div#sch_order_no2'+rel).html());
	$("input#sch_at2").val($('div#sch_at2'+rel).html());
	$("input#sch_at_date5").val($('div#sch_at_date5'+rel).html());
	$("input#sch_major2").val($('div#sch_major2'+rel).html());

	$("input#sch_start_new").val($('div#sch_start_new'+rel).html());

	if($('div#fund_money'+rel).html() == "1"){
      document.scholar.fund_money[0].checked="checked";
   }else if($('div#fund_money'+rel).html() == "2"){
      document.scholar.fund_money[1].checked="checked";
   }else if($('div#fund_money'+rel).html() == "2"){
      document.scholar.fund_money[1].checked="checked";
   }

   if($('div#status_education'+rel).html() == "1"){
      document.scholar.status_education[0].checked="checked";
   }else if($('div#status_education'+rel).html() == "2"){
      document.scholar.status_education[1].checked="checked";
   }
   $("input#old_munny").val($('div#old_munny'+rel).html());
   $("input#new_munny").val($('div#new_munny'+rel).html())
}

function edit_sch_ex(rel){

   $("input#id_ex").val($('div#id_ex'+rel).html());
   $("input#ex_old_date1").val($('div#ex_old_date1'+rel).html());
   $("input#ex_old_date2").val($('div#ex_old_date2'+rel).html());
   $("input#ex_start_date").val($('div#ex_start_date'+rel).html());
   $("input#ex_end_date").val($('div#ex_end_date'+rel).html());
   $("input#ex_at_date").val($('div#ex_at_date'+rel).html());
   $("input#ex_at").val($('div#ex_at'+rel).html());
   $("input#ex_order_no").val($('div#ex_order_no'+rel).html());
   $("input#ex_contract").val($('div#ex_contract'+rel).html());
}

function edit_sch_pay(rel,type){

   if(type == "1"){
      $('#b1').show("fast");
      $('#b2').hide("fast");
      $('#b3').hide("fast");
      $('#b4').show("fast");

      $("select#pay_ref").val($('div#pay_ref'+rel).html());
      $("select#pay_type").val($('div#pay_type'+rel).html());
      if($('div#scholar1'+rel).html() == "1"){
         document.pay_scholar.scholar1[0].checked="checked";
      }else if($('div#scholar1'+rel).html() == "2"){
         document.pay_scholar.scholar1[1].checked="checked";
      }
      $('input#datepicker1').val($('div#date1'+rel).html());
      $('input#datepicker2').val($('div#date2'+rel).html());
      $('input#date_start_work1').val($('div#date_start_work1'+rel).html());
      $('input#date_start_pay1').val($('div#date_start_pay1'+rel).html());
      $('input#countdate1').val($('div#countdate1'+rel).html());
      $('input#multiply1').val($('div#multiply1'+rel).html());
      $('input#days1').val($('div#days1'+rel).html());

   }else if(type == "2"){
      $('#b2').show("fast");
      $('#b1').hide("fast");
      $('#b3').hide("fast");
      $('#b4').show("fast");

      $("select#pay_ref").val($('div#pay_ref'+rel).html());
      $("select#pay_type").val($('div#pay_type'+rel).html());
      if($('div#scholar2'+rel).html() == "1"){
         document.pay_scholar.scholar2[0].checked="checked";
      }else if($('div#scholar2'+rel).html() == "2"){
         document.pay_scholar.scholar2[1].checked="checked";
      }
      $('input#money2').val($('div#money2'+rel).html());
      $('input#mp').val($('div#mp'+rel).html());
      $('input#multiply2').val($('div#multiply2'+rel).html());
      $('input#tw').val($('div#tw'+rel).html());
      $('input#result2').val($('div#result2'+rel).html());

   }else if(type == "3"){
      $('#b3').show("fast");
      $('#b2').hide("fast");
      $('#b1').hide("fast");
      $('#b4').show("fast");

      $("select#pay_ref").val($('div#pay_ref'+rel).html());
      $("select#pay_type").val($('div#pay_type'+rel).html());
      if($('div#scholar3'+rel).html() == "1"){
         document.pay_scholar.scholar3[0].checked="checked";
      }else if($('div#scholar3'+rel).html() == "2"){
         document.pay_scholar.scholar3[1].checked="checked";
      }
      $('input#money3').val($('div#money3'+rel).html());
      $('input#datepicker3').val($('div#date3'+rel).html());
      $('input#datepicker4').val($('div#date4'+rel).html());
      $('input#date_start_work3').val($('div#date_start_work3'+rel).html());
      $('input#date_start_pay3').val($('div#date_start_pay3'+rel).html());
      $('input#count_days_2').val($('div#count_days_2'+rel).html());
      $('input#mch3').val($('div#mch3'+rel).html());
      $('input#ddays').val($('div#ddays'+rel).html());
      $('input#bpd').val($('div#bpd'+rel).html());
      $('input#datepicker5').val($('div#date5'+rel).html());
      $('input#datepicker6').val($('div#date6'+rel).html());
      $('input#count_days_3').val($('div#count_days_3'+rel).html());
      $('input#remain_days').val($('div#remain_days'+rel).html());
      $('input#remain_money').val($('div#remain_money'+rel).html());
      $('input#mch4').val($('div#mch4'+rel).html());
      $('input#ttfee').val($('div#ttfee'+rel).html());
      $('input#grand_total').val($('div#grand_total'+rel).html());


   }

}
