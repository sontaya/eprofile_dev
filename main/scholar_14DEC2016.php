
<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<? 
}
$fpath = '../';
require_once($fpath . "includes/connect.php");
$sch_id = auto_increment("SCH_ID", TB_SCHOLAR_TAB);
//echo "SELECT * FROM  " . TB_SCHOLAR_TAB . "  WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'";
//$sql = "SELECT * FROM  " . TB_SCHOLAR_TAB . "  WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'";
//$row = $db->fetch($sql, $conn);
//$sch_edu_start_date = change_date_thai($row["SCH_EDU_START_DATE"]);
//$sch_edu_end_date = change_date_thai($row["SCH_EDU_END_DATE"]);
//$sch_start_date = change_date_thai($row["SCH_START_DATE"]);
//$sch_end_date = change_date_thai($row["SCH_END_DATE"]);
?>
<script src="../js/main.js" type="text/javascript"></script>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">

  function show_input(){
    if(document.scholar.sch_payback_type[0].checked){
      document.scholar.sch_payback_day.disabled=false;
      document.scholar.sch_payback_money.value="";
      document.scholar.sch_payback_money.disabled=true;
    }
    else if(document.scholar.sch_payback_type[1].checked){
      document.scholar.sch_payback_money.disabled=false;
      document.scholar.sch_payback_day.value="";
      document.scholar.sch_payback_day.disabled=true;
    }
  }

  function show_major_oth(){
    if(document.scholar.sch_major.value == "oth"){
      document.scholar.sch_major_oth.style.display = "inline";
    }
    else{
      document.scholar.sch_major_oth.style.display = "none";
    }
  }

  function check_data(){
    if($("#sch_type").val() == "" || $("#sch_edu_level").val() == "" || $("#sch_course").val() == "" || $("#sch_country").val() == "" || $("#sch_major").val() == "" || $("#sch_uni").val() == "" || $("#sch_money").val() == "" || $("#sch_source").val() == "" || $("#coun_try").val() == "" ){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if($("#new_munny").val()!= $(".new_munny_old").val()){
        //$("#alert_slip").dialog('open');
        alert("กรุณาเปลียนตําเเหน่งสังกัด เเละเงินเดือนใหม่ในรายการตําเเหน่งงานปัจจุบัน");
        //alert($("#new_munny").val());
        //alert($(".new_munny_old").val());
        //return false;
    }

    $("span#waiting1").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("scholar").submit();
  }

  function check_data2(){

    var count = document.getElementsByName("sch_file[]").length;
    var sch_file = document.education.elements["sch_file[]"];
    var i=0;
    var n=0;

    while(i<count){
      if(sch_file[i].value != ""){
        n++;
        if(!Checkfiles2(sch_file[i].value)){
          sch_file[i].value = "";
          $("#Valid_upl_file").dialog('open');
          return false;
        }

      }
      i++
    }

    if(n==0){
      $("#emp_upl_file").dialog('open');
      return false;
    }

    $("span#waiting2").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("education").submit();
  }

  function check_data3(){

    if($("#ref").val() == "" || $("#ex_start_date").val() == "" || $("#ex_end_date").val() == ""  || $("#ex_old_date1").val() == ""  || $("#ex_old_date2").val() == ""  || $("#ex_at_date").val() == ""  || $("#ex_at").val() == "" ){
      $("#Please_fill_in").dialog('open');
      return false;
    }


    $("span#waiting3").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("contract_extend").submit();
  }

  function check_data4(){

    if($("#pay_ref").val() == "" || $("#pay_type").val() == "" ){
      $("#Please_fill_in").dialog('open');
      return false;
    }

    $("span#waiting4").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("pay_scholar").submit();
  }

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function check_data5(){

		if($("#capital").val() == "" || $().val("#date_start")=="" || $("#date_end").val=="" || $("#nb_money").val==""){
			$("#Please_fill_in").dialog('open');
				return false;
		}


		$("span#waiting5").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("money_fund").submit();
		//document.getElementById("data_form2").style.display = "none";
		//window.top.$("span#waiting5").html("");
			window.top.document.getElementById("contract_extend").reset();
			window.top.$('#money_fund_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
			window.top.$('#money_fund_list').load('money_fund_table.php');
			//document.getElementById("data_form2").style.display = "none";
			//window.top.$("span#waiting5").html("");

}

function check_data6(){

		if($("#no_num").val() == "" || $("#category").val()=="" || $("#munny_num").val()=="" || $("#date_opan").val()=="" || $("#no_record").val()=="") {
			$("#Please_fill_in").dialog('open');
				return false;
		}
        //alert("ok");
		document.getElementById("pay_fund").submit();
		document.getElementById("pay_list").html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
		window.top.$('#pay_list').load('pay_fund_table.php');
}

function check_data7(){

		if($('#stop_type').val() == "" || $("#la_date_start").val() == "" || $("#la_end_start").val() == "" || $('#approve_date').val()==""  || $('#la_order_no1').val()=="" || $('#la_at1').val()==""  || $('#la_at_date1').val()=="" ) {
			$("#Please_fill_in").dialog('open');
				return false;
		}

        $("span#waiting7").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("la_fund").submit();
        //window.top.document.getElementById("contract_extend").reset();
		//window.top.$('#la_list').load('la_fund_table.php');
		//document.getElementById("data_form7").style.display = "none";
}
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
  function del_sch_file(id,name){
    var conf = window.confirm("ยืนยันที่จะลบไฟล์นี้");
    if(conf){
      $("#sch_file_list").html("Waiting. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
      var data = "ID="+id+"&SCH_FILE_NAME="+name;
      ajaxPostData("sch_file_del.php",data,"text","",del_sch_file_res,"");
    }
  }

  function del_sch_file_res(response){
    if(response == "1"){
      $('#sch_file_list').load('sch_file_list.php');
    }else{
      alert("ไม่สามารถลบรายการนี้ได้");
    }
  }

  function get_short_name(name){
    var count = educationName.length;
    var short = "";
    for(var i = 0;i<count;i++){
      if(educationName[i] == name){
        short = educationShortName[i];
        break;
      }
    }
    $("#sch_course_short").val(short);
  }

  function search_major(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
          if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
    ajaxPostData("_find_program.php",data,"text","result_search_major",result_search_major,"","");
      }
  }

  function result_search_major(response){
    if(response == "0"){
      $('#result_search_major').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_major').html(response);
    }
  }

  function pick_program(id){
    var id_major = $('#id'+id).val();
    var name_major = $('#name'+id).val();

    $("span#major").html("<input type='hidden' id='sch_major' name='sch_major' value='"+id_major+"'><input readonly='readonly' id='sch_major_name' type='text' value='"+name_major+"' style='width:200px;' >");

    $("#search_major").val("");
    $("div#result_search_major").html("");
    $('#dialog_major').dialog('close');
  }

  function search_nation(txt){
    //alert(txt);
    var data = "";
    data += "txt="+txt;
          if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
    ajaxPostData("_find_nation11.php",data,"text","result_search_nation",result_search_nation,"","");
      }
  }

  function result_search_nation(response){
    if(response == "0"){
      $('#result_search_nation').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
    }else{
      $('#result_search_nation').html(response);
    }
  }

  function pick_nation(id){

    var id_nation = $('#idx'+id).val();
    var name_nation = $('#namex'+id).val();

	//alert(id+":"+id_nation+":"+name_nation);

    $("span#nation").html("<input type='hidden' id='sch_country' name='sch_country' value='"+id_nation+"' ><input readonly='readonly' id='sch_country_name' type='text' value='"+name_nation+"'>");

    $("#search_nation").val("");
    $("div#result_search_nation").html("");
    $('#dialog_nation').dialog('close');
  }

  $(function() {
    $("#tabs").tabs();
  });


  $(function() {
    $("#sch_uni").autocomplete({
      source: universityTags
    });
    $("#sch_major").autocomplete({
      source: expertTags
    });
    $("#sch_course").autocomplete({
      source: educationName
    });

    $('#dialog_major').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'600',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_major").val("");
          $("div#result_search_major").html("");
        }
      }
    });

    $('#dialog_nation').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'500',
      height: '400',
      buttons: {
        ปิด: function() {
          $(this).dialog('close');
          $("#search_nation").val("");
          $("div#result_search_nation").html("");
        }
      }
    });

    $( "#opener_major" ).click(function() {
      $( "#dialog_major" ).dialog( "open" );
      return false;
    });

    $( "#opener_nation" ).click(function() {
      $( "#dialog_nation" ).dialog( "open" );
      return false;
    });


    $('#Save_success').dialog({
      resizable: false,
      autoOpen: false,
      modal: true,
      hide: 'slide',
      buttons: {
        ตกลง: function() {
          $(this).dialog('close');
        }
      }
    });

    $('#Save_error').dialog({
      resizable: false,
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      buttons: {
        ตกลง: function() {
          $(this).dialog('close');
        }
      }
    });

    $('#Valid_upl_file').dialog({
      resizable: false,
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      buttons: {
        ตกลง: function() {
          $(this).dialog('close');
        }
      }
    });

    $('#emp_upl_file').dialog({
      resizable: false,
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      buttons: {
        ตกลง: function() {
          $(this).dialog('close');
        }
      }
    });

    $("#addfile").click(function(){
      $("#morefile").after("<input type='file' name='sch_file[]'  class='file_upload'  /><br />");
      //var sch_file = document.getElementsByName("sch_file[]").length;
    });

  });

  function ac(v) {

    if(v == "1") {
      $('#b1').show("fast");
      $('#b2').hide("fast");
      $('#b3').hide("fast");
      $('#b4').show("fast");
    }
    else if(v == "2") {
      $('#b2').show("fast");
      $('#b1').hide("fast");
      $('#b3').hide("fast");
      $('#b4').show("fast");
    }
    else if(v == "3") {
      $('#b3').show("fast");
      $('#b2').hide("fast");
      $('#b1').hide("fast");
      $('#b4').show("fast");
    }else{
      $('#b3').hide("fast");
      $('#b2').hide("fast");
      $('#b1').hide("fast");
      $('#b4').hide("fast");
    }
  }

  function ch1(v) {
    $('#multiply1').val(v);
    send_date();
  }

  function ch2(v) {
    $('#multiply2').val(v);
    calc_money();
  }

  function send_date() {
    calcDays('datepicker1','datepicker2');
  }

  function calcDays(d1,d2){
    t1=document.getElementById(d1).value ;
    t2=document.getElementById(d2).value ;
    if((t1 && t2) != ""){
      var one_day=1000*60*60*24;
      var x=t1.split("/");
      var y=t2.split("/");
      var date1=new Date(x[2],(x[1]-1),x[0]);
      var date2=new Date(y[2],(y[1]-1),y[0])
      var month1=x[1]-1;
      var month2=y[1]-1;
      _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day))+1;

      $('#countdate1').val(_Diff);
      var mul = $('#multiply1').val();
      var cdate = $('#countdate1').val();
      mul = parseInt(mul);
      cdate = parseInt(cdate);
      $('#days1').val(mul*cdate);
    }
  }

  function calc_money() {
    var m = $('#money2').val();
    $('#mp').val(m);
    m = parseFloat(m);
    var mul = $('#multiply2').val();
    mul = parseFloat(mul);
    if(mul == 2) {
      //mul = 3;
    }
    $('#tw').val(mul*m);
    mul++;
    $('#result2').val(mul*m);

  }

  function datediff(d1, d2) {
    t1=document.getElementById(d1).value ;
    t2=document.getElementById(d2).value ;
    var one_day=1000*60*60*24;
    var x=t1.split("/");
    var y=t2.split("/");
    var date1=new Date(x[2],(x[1]-1),x[0]);
    var date2=new Date(y[2],(y[1]-1),y[0])
    var month1=x[1]-1;
    var month2=y[1]-1;
    _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day))+1;
    return(_Diff);
  }

  function calc_days2() {
	var d1 = 'datepicker3';
    var d2 = 'datepicker4';
    t1=document.getElementById(d1).value ;
    t2=document.getElementById(d2).value ;
    if(t1 != '' && t2 != '') {
      var diff = datediff(d1, d2)+1;
      $('#count_days_2').val(diff);
    }
    calc_ddays();
  }

  function calc_days3() {
    var d1 = 'datepicker5';
    var d2 = 'datepicker6';
    t1=document.getElementById(d1).value ;
    t2=document.getElementById(d2).value ;
    if(t1 != '' && t2 != '') {
      var diff = datediff(d1, d2)-1;
      $('#count_days_3').val(diff);
    }
    calc_ddays();
  }

  function change_m3(v) {
    $('input[name=mch3]').val(v);
    $('input[name=mch4]').val(v);
    calc_ddays();
  }

  function calc_ddays() {
    var days = $('#count_days_2').val();
    var m = $('input[name=mch3]').val();
    var money3 = $('#money3').val();
    var count_days_3 = $('#count_days_3').val();
    var fee = $('input[name=mch4]').val();
    days = parseFloat(days);
    m = parseFloat(m);
    money3 = parseFloat(money3);
    count_days_3 = parseInt(count_days_3);
    fee = parseFloat(fee);
    cdays = m*days;
    $('#ddays').val(cdays);
    var bathperday =  money3/cdays;
    $('#bpd').val(bathperday.toFixed(2));
    var remaindays = cdays - count_days_3;
    $('#remain_days').val(remaindays);
    var remain_m = (money3/cdays)*(cdays - count_days_3);
    $('#remain_money').val(remain_m.toFixed(2));
    var ttfee = (money3/cdays)*(cdays - count_days_3)*fee;
    $('#ttfee').val(ttfee.toFixed(2));
    var grand_total = remain_m + ttfee;
    $('#grand_total').val(grand_total.toFixed(2));
  }

  function quit(id){
	if(id == "4"){
		//document.getElementById("quit").style.display = "none";
		document.getElementById("quit").style.display = "block";
	}else{
		//document.getElementById("quit").style.display = "block";
	}

}

$(document).ready(function() {
    $(".int_text").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });
});
</script>

<table cellpadding="0" cellspacing="0" align="center" width="758">
  <tr><td >
      <div id="tabs" style="width:725px; margin-left:15px">
        <ul>
          <li><a href="#tabs-1" style="width:85px; font-size:12px;">ข้อมูลการศึกษาต่อ</a></li>
          <li><a href="#tabs-2" style="width:95px; font-size:12px;">แนบไฟล์ผลการเรียน</a></li>
          <li><a href="#tabs-3" style="width:60px; font-size:12px;">คำนวณใช้ทุน</a></li>
          <li><a href="#tabs-4" style="width:85px; font-size:12px;">ขยายเวลาศึกษาต่อ</a></li>
          <li><a href="#tabs-5" style="width:40px; font-size:12px;">ข้อมูลทุน</a></li>
          <li><a href="#tabs-6" style="width:50px; font-size:12px;">เบิกจ่ายทุน</a></li>
          <li><a href="#tabs-7" style="width:100px; font-size:12px;">ลาทำวิทยานิพนธ์/วิจัย</a></li>
        </ul>

        <div id="tabs-1">
          <div id="scholar_list" align="center" class="data_details_list">
            <? include "scholar_data_table.php"; ?>
          </div>
          <div align="center"  id="toggle_form" ><img src="../images/add.png" onclick="toggle_form('scholar','sch_id'); clear_data_ajax();" style="cursor:pointer"/></div>
          <div id="data_form" style="display:none;"  >
          <img src="../images/bg_d.png" style="margin-left:10px;" width="680" />
            <table  cellspacing="0" cellpadding="0" align="center" >
              <tr>
                <td>
                  <form id="scholar" name="scholar" method="post" action="sch_data_save.php" target="upload_target">
                    <table width="758" border="0" cellspacing="4" cellpadding="4">
                      <tr>
                        <input type="hidden" id="sch_id" name="sch_id" value=""/>
                        <td align="right" class="form_text">* ประเภท :</td>
                        <td colspan="2" align="left" class="form_text">
                          <input name="sch_type" type="radio" id="sch_type" value="1" <? if ($row["SCH_TYPE"] == "1") { echo "checked='checked' "; } ?> /> ในเวลาราชการ
                          <input type="radio" name="sch_type" id="sch_type" value="2" <? if ($row["SCH_TYPE"] == "2") { echo "checked='checked' "; } ?>/> นอกเวลาราชการ

                        </td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* สถานที่ศึกษา :</td>
                        <td colspan="2" align="left" class="form_text">
                          <input type="radio" name="coun_try" id="coun_try" value="1" <? if ($row["COUN_TRY"] == "1") { echo "checked='checked' "; } ?>/> ในประเทศ
                          <input type="radio" name="coun_try" id="coun_try" value="2" <? if ($row["COUN_TRY"] == "2") { echo "checked='checked' "; } ?>/> ต่างประเทศ

                        </td>
                      </tr>
                      <tr>
                        <td width="169" align="right" class="form_text"> คำสั่ง : </td>
                        <td colspan="2" align="left"><input type="text" name="sch_order_no" id="sch_order_no" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                          ที่ <input type="text" id="sch_at" name="sch_at" style="width: 80px; " class="input_text" value="<?= $row["SCH_AT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                          สั่ง ณ วันที่ <input type="text"  name="sch_at_date" id="sch_at_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      </tr>
                      <tr>
                        <td width="169" align="right" class="form_text"> บันทึกข้อความที่ : </td>
                        <td colspan="2" align="left"><input type="text" name="sch_order_no2" id="sch_order_no2" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo ""; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                          ที่ <input type="text" id="sch_at2" name="sch_at2" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                          ลงวันที่ <input type="text"  name="sch_at_date5" id="sch_at_date5" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_at_date5','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text"> เลขที่สัญญาลาศึกษาต่อ :</td>
                        <td colspan="2" align="left"><input type="text" name="sch_contract" id="sch_contract" style="width: 100px;" class="input_text" value="<?= $row["SCH_CONTRACT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                      </tr>
<?
                      $sql_edu_level = "SELECT * FROM  " . TB_REF_LEV . "  ORDER BY LEV_NAME_TH ASC ";
                      $stid_edu_level = oci_parse($conn, $sql_edu_level);
                      oci_execute($stid_edu_level);
                      $option_edu_level = "<option value=''>เลือก</option>";
                      while (($row_edu_level = oci_fetch_array($stid_edu_level, OCI_BOTH))) {
                        $option_edu_level .= "<option value='" . $row_edu_level["LEV_ID"] . "' >" . $row_edu_level["LEV_NAME_TH"] . " (".$row_edu_level["LEV_NAME_ENG"].")</option>\n";
                      }
?>
                      <tr>
                        <td align="right" class="form_text">* ระดับการศึกษา :</td>
                        <td colspan="2" align="left"><select name="sch_edu_level" id="sch_edu_level" style="width:150px"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> onfocus="myDisable(this);"<?php } ?>>
                        <?= $option_edu_level ?>
<!--                            <option value="">เลือก</option>
                            <option value="1" <? if ($row["SCH_EDU_LEVEL"] == "1") { echo "selected='selected' "; } ?>>ปริญญาโท</option>
                            <option value="2" <? if ($row["SCH_EDU_LEVEL"] == "2") { echo "selected='selected' "; } ?>>ปริญญาเอก</option>-->
                            <option value="3" <? if ($row["SCH_EDU_LEVEL"] == "3") { echo "selected='selected' "; } ?>>ปริญญาโท - ปริญญาเอก</option>
                          </select></td>
                      </tr>

                      <tr>
                        <td align="right" class="form_text">* ระยะเวลาหลักสูตร :</td>
                        <td colspan="2" align="left" class="form_text">
                          <input name="sch_long" type="text" id="sch_long" style="width: 30px" maxlength="3" class="input_text" value="<?= $row["SCH_LONG"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>  ปี (หากเป็นครึ่งปี ให้เป็น .5)

                        </td>
                      </tr>

                      <tr>
                    <td align="right" class="form_text">* ประเทศ : </td>
                    <td align="left">
                    <select name="sch_country" id="sch_country" >
                        <option value="TH">ไทยTH</option>

                      <?
                       	$sql_edu_country = "SELECT * FROM  ".TB_REF_NATION."  ORDER BY NATION_NAME_TH ASC ";
                        $stid_edu_country = oci_parse($conn, $sql_edu_country);
                        oci_execute($stid_edu_country);
                      $option_edu_country = "";
					  while($row_edu_country = oci_fetch_array($stid_edu_country, OCI_BOTH)){

					  ?>
                      <option value="<?=$row_edu_country["NATION_ID"]; ?>"><?=$row_edu_country["NATION_NAME_TH"].$row_edu_country["NATION_ID"]; ?></option>
                      <? }?>
                      </select>

                      </td>
                    <td align="left">&nbsp;</td>
                  </tr>
                      <tr>
                        <td align="right" class="form_text">* ชื่อเต็มของหลักสูตร :</td>
                        <td colspan="2" align="left"><input type="text" name="sch_course" id="sch_course" style="width: 260px; " class="input_text" onblur="get_short_name(this.value)" value="<?= $row["SCH_COURSE"] ?>"/></td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* ชื่อย่อของวุฒิ :</td>
                        <td colspan="2" align="left"><input type="text" name="sch_course_short" id="sch_course_short" style="width: 70px; " class="input_text" onfocus="get_short_name($('#sch_course').val())" value="<?= $row["SCH_COURSE_SHORT"] ?>"/></td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* สาขาวิชา :</td>
                        <td colspan="2" align="left">
                          <? ?>
                        <!-- <select name="sch_major" id="sch_major" style="width: 200px" onchange="show_major_oth()">
                          <? //$option_sch_major?>
                                </select>-->

                          <?
							$display = "none";
							$sql_sch_major = "SELECT * FROM  " . TB_REF_ISCED . "  WHERE ISCED_ID = '" . $row["SCH_MAJOR"] . "' ";
							// echo $sql_sch_major;
							$stid_sch_major = oci_parse($conn, $sql_sch_major);
							oci_execute($stid_sch_major);
							$option_sch_major = "<option value='oth'>อื่นๆ</option>\n";
							while (($row_sch_major = oci_fetch_array($stid_sch_major, OCI_BOTH))) {
							if ($row_sch_major["ISCED_ID"] == $row["SCH_MAJOR"]) { $select = "selected = 'selected'"; } elseif ($row["SCH_MAJOR"] == "oth") { $display = "inline"; } else { $select = ""; }
							$option_sch_major .= "<option value='" . $row_sch_major["ISCED_ID"] . "' $select>" . $row_sch_major["ISCED_NAME_TH"] . "</option>\n";
                              }
                          ?>
                              <span id="major">

                              <!--
                                <select name="sch_major" id="sch_major" style="width: 200px" onchange="show_major_oth()">
                              <?= $option_sch_major ?>
                            </select>
                            -->
                            <input type="hidden" value="<?=$row_sch_major["ISCED_ID"]?>" name="sch_major" id="sch_major" onchange="quit_moj(this.value);"/>
                            <input type="text" id="sch_major_name" name="sch_major_name" class="input_text" readonly value="<?=$row_sch_major["ISCED_NAME_TH"]?>"  style="width: 200px" />
                          </span>
                          <input type="text" id="sch_major_oth" name="sch_major_oth"  style="width: 150px; display: <?= $display ?>" class="input_text" value="<?= $row["SCH_MAJOR_OTH"] ?>"/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener_major"  title="ค้นหา"/><?php } ?> อื่น ๆ :  <input type="text" name="sch_major2" id="sch_major2" class="input_text" style="width: 200px" placeholder="โปรดระบุสาขาวิชาเป็นอื่น ๆ ก่อนกรอกข้อมูล"/>

                        </td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* มหาวิทยาลัย/สถาบัน :</td>
                        <td colspan="2" align="left" class="form_text">
                          <input type="text" name="sch_uni" id="sch_uni" style="width: 300px; " class="input_text" value="<?= $row["SCH_UNI"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* เเหล่งเงินทุน :</td>
                        <td colspan="2" align="left" class="form_text">
                          <input type="radio" name="fund_money" id="fund_money" value="1" <? if ($row["FUND_MONEY"] == "1") { echo "checked='checked' "; } ?>/>ส่วนตัว
                          <input type="radio" name="fund_money" id="fund_money" value="2" <? if ($row["FUND_MONEY"] == "2") { echo "checked='checked' "; } ?>/>อื่น ๆ</td>
                      </tr>
					  <!--
                      <tr>
                        <td align="right" class="form_text">* แหล่งทุน :</td>
                        <td colspan="2" align="left">
                          <input type="text" name="sch_source" id="sch_source" style="width: 120px; " class="input_text" value="<?= $row["SCH_SOURCE"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" class="form_text">* วงเงินที่ได้รับอนุมัติทุน :</td>
                        <td width="184" align="left" class="form_text"><input type="text" name="sch_money" id="sch_money" style="width: 100px; " class="input_text" value="<? if ($row["SCH_MONEY"] != "") { echo $row["SCH_MONEY"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> บาท</td>
                        <td width="365" align="left" class="form_text">วันที่อนุมัติ  :
                          <input type="text"  name="sch_money_date" id="sch_money_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_MONEY_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>
                          <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_money_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text"> วงเงินที่ขออนุมัติเพิ่มครั้งที่ 1 :</td>
                            <td width="184" align="left" class="form_text"><input type="text" name="sch_money1" id="sch_money1" style="width: 100px; " class="input_text" value="<? if ($row["SCH_MONEY1"] != "") { echo $row["SCH_MONEY1"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> บาท</td>
                            <td width="365" align="left" class="form_text">วันที่อนุมัติครั้งที่ 1  :
                              <input  type="text" name="sch_money_date1" id="sch_money_date1" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_MONEY_DATE1"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>
                          <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_money_date1','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text"> วงเงินที่ขออนุมัติเพิ่มครั้งที่ 2 :</td>
                            <td width="184" align="left" class="form_text"><input type="text" name="sch_money2" id="sch_money2" style="width: 100px; " class="input_text" value="<? if ($row["SCH_MONEY2"] != "") { echo $row["SCH_MONEY2"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> บาท</td>
                            <td width="365" align="left" class="form_text">วันที่อนุมัติครั้งที่ 2  :
                              <input type="text" name="sch_money_date2" id="sch_money_date2" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_MONEY_DATE2"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>
                          <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_money_date2','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text"> วงเงินที่ขออนุมัติเพิ่มครั้งที่ 3 :</td>
                            <td width="184" align="left" class="form_text"><input type="text" name="sch_money3" id="sch_money3" style="width: 100px; " class="input_text" value="<? if ($row["SCH_MONEY3"] != "") { echo $row["SCH_MONEY3"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/> บาท</td>
                            <td width="365" align="left" class="form_text">วันที่อนุมัติครั้งที่ 3  :
                              <input type="text"  name="sch_money_date3" id="sch_money_date3" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_MONEY_DATE3"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly="readonly"<?php } ?>/>
                          <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_money_date3','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                          </tr>
						  -->
                          <tr>
                            <td align="right" class="form_text">วันที่เริ่มต้นสัญญาลาศึกษาต่อ :</td>
                            <td colspan="2" align="left" class="form_text">
                              <input type="text" name="sch_start_date" id="sch_start_date" style="width: 80px; " class="input_text" value="<?= $sch_start_date ?>"/><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_start_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สิ้นสุดสัญญาลาศึกษาต่อ :
                              <input type="text" name="sch_end_date" id="sch_end_date" style="width: 80px; " class="input_text" value="<?= $sch_end_date ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_end_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text">วันที่เริ่มการศึกษา :</td>
                            <td colspan="2" align="left" class="form_text">
                              <input type="text" name="sch_edu_start_date" id="sch_edu_start_date" style="width: 80px; " class="input_text" value="<?= $sch_edu_start_date ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_edu_start_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สำเร็จการศึกษา :
                              <input type="text" name="sch_edu_end_date" id="sch_edu_end_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_EDU_END_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_edu_end_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>
                            </td>
                          </tr>
						  <tr>
                            <td align="right" class="form_text">วันที่กลับเข้าปฏิบัติหน้าที่ :</td>
                            <td colspan="2" align="left" class="form_text">
                              <input type="text" name="sch_start_new" id="sch_start_new" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_start_new','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?>

                            </td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text">สถานะ :</td>
                            <td colspan="2" align="left" class="form_text">
                              <input type="radio" name="status_education" id="status_education" value="1">กําลังศึกษา
                              <input type="radio" name="status_education" id="status_education" value="2">สําเร็จการศึกษา
                            </td>
                          </tr>
                          <tr>
                            <td align="right" class="form_text">ปรับเงินเดือน :</td>
                            <td colspan="2" align="left" class="form_text">
                              เงินเดือนเดิม : <input type="text" name="old_munny" id="old_munny" style="width:100px;"> บาท &nbsp;&nbsp;
                              เงินเดือนใหม่ : <input type="text" name="new_munny" id="new_munny" style="width:100px;"> บาท
                              <input type="hidden" name="new_munny_old" id="new_munny" class="new_munny_old">
                            </td>
                          </tr>
                          <tr>
                            <td align="right" valign="top" class="form_text">บันทึก :</td>
                            <td colspan="2" align="left" valign="top">
                              <textarea id="sch_memo" name="sch_memo"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>><?= $row["SCH_MEMO"] ?></textarea>
                            </td>
                          </tr>
						<!---------- --------->

							<tr>
								<td colspan="3" align="center" id="scholar_withdraw_money"><? include("scholar_withdraw_money.php"); ?></td>
							</tr>
						<!---------- --------->
                          <tr>
                            <td align="right" class="form_text">&nbsp;</td>
                            <td colspan="2" align="left">&nbsp;</td>
                          </tr>
                      <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                <tr>
                                  <td height="44" align="center" valign="top" colspan="3">

									<table>
										<tr>
										<td>
                                    <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
                                    <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
                                  </td>
                                  <td>
                                    <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
                                    <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('scholar.php','../images/head2/work_data/scholar.png')" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/></td>


										</tr>
									</table>

                                  </td>
                                </tr>
                      <? } ?>
                              <tr>
                                <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting1"></span></td>
                              </tr>
                            </table>
                          </form>

                        </td>
                      </tr>

                    </table>
                  </div>
                </div>

                <div id="tabs-2">
                  <br />
                  <div align="center"  id="sch_file">

                    <table width="707" border="0"><tr><td width="434" align="left" style="color:#663; font-size:11px" valign="top">
                          <form id="education" name="education" enctype="multipart/form-data" method="post" action="sch_manage_file_save.php"  target="upload_target" >
                            ปีการศึกษา <select name="sch_year_file[]">
                      <?
                              $year = date("Y") + 543;
                              for ($i = 0; $i < 30; $i++) {
                                $y = $year - $i;
                                echo "<option value='$y'>$y</option>\n";
                              }
                      ?></select>
                            ภาคเรียน  <select name="sch_sem_file[]">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">ทั้งปี</option>
                            </select>
                            <input type="file" name="sch_file[]"  class="file_upload"/><br /><br />

                            ปีการศึกษา <select name="sch_year_file[]">
                      <?
                              $year = date("Y") + 543;
                              for ($i = 0; $i < 30; $i++) {
                                $y = $year - $i;
                                echo "<option value='$y'>$y</option>\n";
                              }
                      ?></select>
                            ภาคเรียน  <select name="sch_sem_file[]">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">ทั้งปี</option>
                            </select>
                            <input type="file" name="sch_file[]"  class="file_upload"/><br /><br />

                            ปีการศึกษา <select name="sch_year_file[]">
                      <?
                              $year = date("Y") + 543;
                              for ($i = 0; $i < 30; $i++) {
                                $y = $year - $i;
                                echo "<option value='$y'>$y</option>\n";
                              }
                      ?></select>
                            ภาคเรียน  <select name="sch_sem_file[]">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">ทั้งปี</option>
                            </select>
                            <input type="file" name="sch_file[]"  class="file_upload"/><br /><br />
                            <span  id="morefile"></span>
                            <!--<input type="button" id="addfile"  value="เพิ่มไฟล์แนบ" style="height: 23px; "/>-->
                            <br />
                            เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx, .pdf
                          </form><br />
                  <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data2();"/>
                                <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')" onClick="document.getElementById('education').reset();"/>
                  <?php } ?>
                            </td>
                            <td width="263" align="left" style="color:#663; font-size:11px" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2"><br />
                              <div align="left" style="padding-left: 7px" id="sch_file_list">
                    <?
                              include "sch_file_list.php";
                    ?>
                            </div>
                          </td>
                        </tr>
                      </table>
                      <table  border="0" cellpadding="3">
                        <tr>
                          <td width="223" height="45" align="left"  valign="top" style="padding-left:100px; color:#06C;">&nbsp;<span id="waiting2"></span></td>
                        </tr>
                      </table>
                    </div>
                    <div style="display: none">
                      <div id="emp_upl_file" title="File Upload Error !">
                        <p>
                          ท่านยังไม่ได้แนบไฟล์
                        </p>
                      </div>
                    </div>
                  </div>

                  <div id="tabs-3" align="left" style="padding-bottom:50px">
                    <br />
                    <div id="pay_list" align="center">
            <? //include "sch_pay_table.php"; ?>
                            </div>
                            <!--<img src='../images/under-construction.jpg' border='0' height='300' />-->
                            <form id="pay_scholar" name="pay_scholar" method="post" target="upload_target" action="sch_pay_save.php">
                              <table width="485" border="0" cellspacing="0" cellpadding="4">
                                <tr>
                                 <!--   <td width="156" align="right">* คำสั่ง : </td>
                                  <td width="313">
                                 <select id="pay_ref" name="pay_ref">
                                  <option value="">เลือก</option>
                <?
                              //$sql =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY SCH_ORDER_NO ASC";
                              //$stid = oci_parse($conn, $sql );
                              //oci_execute($stid);
                              //while (($row = oci_fetch_array($stid, OCI_BOTH))) {
                ?>
                                  <option value="<? //$row["SCH_ID"] ?>"><? //echo $row["SCH_ORDER_NO"]." ที่ ".$row["SCH_AT"]." สั่ง ณ วันที่ ".change_date_thai($row["SCH_AT_DATE"]); ?></option>
                <?
//	}
                ?>
                                  </select>
                                  </td>
                                </tr>-->
                            <tr>
                              <td align="right" width="156">* เลือกแบบการใช้ทุน : </td>
                              <td width="313">
                                <select id="pay_type" name="pay_type" onchange="ac(this.value)">
                                  <option value="">เลือก</option>
                                  <option value="1">คืนโดยการทำงานชดใช้</option>
                                  <option value="2">คืนโดยจำนวนเงินชดใช้</option>
                                  <option value="3">คืนทั้งเงินและวันที่ทำงานชดใช้</option>
                                </select>

                              </td>
                            </tr>
                          </table><br />
                          <div id="b1" align="left" class="pay"  style="display:none">
              <? include "sch_b1.php"; ?>
                            </div>

                            <div id="b2" align="left" class="pay" style="display:none">
              <? include "sch_b2.php"; ?>
                            </div>

                            <div id="b3" align="left" class="pay"  style="display:none">
              <? include "sch_b3.php"; ?>
                            </div>

                            <div id="b4" style="display:none; padding-top: 5px;" >
                              <div align="left" style="color:blue">*** กดปุ่มคำนวนก่อนบันทึกข้อมูลทุกครั้ง ***</div>
                                <?php
                                 // Hide for user and chief
                                 if($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') {
                                 ?>
                              <table align="left" border="0">
                                <tr>
                                  <td width="79" height="57" align="right" valign="middle"><img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer"  onClick="check_data4();"/></td>
                                  <td width="79" align="left" valign="middle"><img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer"  onClick="document.getElementById('pay_scholar').reset();"/></td>
                                  <td width="198" align="left" valign="middle"><span id="waiting4"></span></td>
                                </tr>

                              </table>
                                <? } ?>
                            </div>
                          </form>

                        </div>

                        <div id="tabs-4" align="center" >
                          <br />
                          <div id="ex_list" align="center" class="data_details_list">
           					<? include "sch_ex_table.php"; ?>
                            </div>
                            <form id="contract_extend" name="contract_extend" method="post" action="sch_extend_save.php" target="upload_target">
                              <table width="655" border="0" align="center" cellpadding="4" cellspacing="0">
                              <tr>
                                <td width="173" align="right">* วันที่ได้รับอนุมัติเดิม : <input  type="hidden" id="id_ex" name="id_ex" value="" /></td>
                                <td width="466" align="left"><input type="text" name="ex_old_date1" id="ex_old_date1" style="width: 80px; " class="input_text" value="<?= $sch_start_date ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ex_old_date1','YYYY-MM-DD')"  style="cursor:pointer" /><?php } ?> ถึง <input type="text" name="ex_old_date2" id="ex_old_date2" style="width: 80px; "  class="input_text" value="<?= $sch_end_date ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/><?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ex_old_date2','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                              </tr>
                              <tr>
                                <td align="right">* วันที่ขอขยายเวลาศึกษาต่อ : </td>
                                <td align="left"><input  type="text" name="ex_start_date" id="ex_start_date" style="width: 80px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ex_start_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?> ถึง <input  type="text" name="ex_end_date" id="ex_end_date" style="width: 80px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ex_end_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                              </tr>
                              <tr>
                                <td align="right"> คำสั่ง : </td>
                                <td align="left"><input type="text" name="ex_order_no" id="ex_order_no" style="width: 80px; " class="input_text" value="มสด."<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                                  ที่ <input type="text" id="ex_at" name="ex_at" style="width: 80px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                                  สั่ง ณ วันที่ <input type="text"  name="ex_at_date" id="ex_at_date" style="width: 80px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ex_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                              </tr>
                              <tr>
                                <td align="right"> เลขที่สัญญา : </td>
                                <td align="left"><input type="text" name="ex_contract" id="ex_contract" style="width: 140px; " class="input_text"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?> /></td>
                              </tr>
                              <tr>
                                <td align="right">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                              </tr>
              					<?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                <tr>
                                  <td align="right"><img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data3();"/></td>
                                  <td><img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')" onClick="document.getElementById('contract_extend').reset();document.getElementById('id_ex').value = ''"/></td>
                                </tr>
              					<?php } ?>
                              <tr>
                                <td align="right">&nbsp;</td>
                                <td align="left" height="43"><span id="waiting3"></span></td>
                              </tr>
                            </table>
                          </form>
                        </div>
                         <div id="tabs-5" align="center" >
                          <div id="money_fund_list" align="center" class="data_details_list">
						  <? include "money_fund_table.php"; ?>
                          </div>

                          <div align="center"><img src="../images/add.png" onclick="toggle_form('money_fund','money_fund_id',this,'#data_form2'); clear_data_ajax();" style="cursor:pointer"/></div>
                          <div id="data_form2" style="display:none;">
                          <img src="../images/bg_d.png" style="margin-left:10px;" width="640" />
                            <table  cellspacing="0" cellpadding="0" align="center" >
                              <tr>
                                <td>
                                  <form id="money_fund" name="money_fund" method="post" action="add_money_fund_save.php" target="upload_target">
                                    <table width="758" border="0" cellspacing="4" cellpadding="4">
                                      <tr>
                                        <input type="hidden" id="money_fund_id" name="money_fund_id" value="">
                                            <tr>
                                                <td width="140" align="right" class="form_text">* เเหล่งทุน :</td>
                                                <td width="590" align="left"><input type="radio" name="capital" id="capital" value="2" onchange="quit(this.value);">มหาวิทยาลัย<input type="radio" name="capital" id="capital" value="3" onchange="quit(this.value);">รัฐบาล<input type="radio" name="capital" id="capital" value="4" onchange="quit(this.value);"> อื่น ๆ <span id="quit"  align="left" style="padding-left:195px; margin-top:-20px; display:none;">: <input type="text" name="munny_full" id="munny_full" style="width:200px;"></span></td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text">* เลขที่สัญญา :</td>
                                                <td align="left"><input type="text" name="ct_no" id="ct_no" style="width: 100px; " class="int_text"<?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {?> onfocus="myDisable(this);"<?php } ?>/>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text"> วันเริ่มต้น :</td>
                                                <td align="left"><input type="text" name="date_start" id="date_start" style="width: 100px; " class="input_text"/>
                                                  <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_start','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text"> วันสิ้นุสุด :</td>
                                                <td align="left"><input type="text" name="date_end" id="date_end" style="width: 100px; " class="input_text"/>
                                                  <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_end','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                                              </tr>
                                               <tr>
                                                <td align="right" class="form_text">* วงเงินที่ได้รับ :</td>
                                                <td align="left"><input type="text" name="nb_money" id="nb_money" style="width: 100px; " class="int_text" /></td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text">หมายเหตุ :</td>
                                                <td align="left"><input type="text" name="note" id="note" style="width: 400px; " class="input_text"/></td>
                                              </tr>

                                               <tr>
                                                <td align="right" class="form_text"> ขอเพิ่มวงเงินทุน ครั้งที่ 1 :</td>
                                                <td align="left">
                                                <input type="text" name="money_one" id="money_one" style="width: 70px; " class="int_text"/>&nbsp;บาท
                                                &nbsp;&nbsp;อ้างถึงสัญญา/มติที่ประชุม  : <input type="text" name="wb_one" id="wb_one" style="width: 70px; " class="input_text"/>
                                                &nbsp;&nbsp;วันที่อนุมัติ : <input type="text" name="date_staer_wb_one" id="date_staer_wb_one" style="width: 100px; " class="input_text"/>
                                                 <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_staer_wb_one','YYYY-MM-DD')"  style="cursor:pointer"/>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text"> ขอเพิ่มวงเงินทุน ครั้งที่ 2 :</td>
                                                <td align="left">
                                                <input type="text" name="money_two" id="money_two" style="width: 70px; " class="int_text"/>&nbsp;บาท
                                                &nbsp;&nbsp;อ้างถึงสัญญา/มติที่ประชุม : <input type="text" name="wb_two" id="wb_two" style="width: 70px; " class="input_text"/>
                                                &nbsp;&nbsp;วันที่อนุมัติ : <input type="text" name="date_staer_wb_two" id="date_staer_wb_two" style="width: 100px; " class="input_text"/>
                                                  <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_staer_wb_two','YYYY-MM-DD')"  style="cursor:pointer"/>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text"> ขอเพิ่มวงเงินทุน ครั้งที่ 3 :</td>
                                                <td align="left">
                                                <input type="text" name="money_thee" id="money_thee" style="width: 70px; " class="int_text"/>&nbsp;บาท
                                                &nbsp;&nbsp;อ้างถึงสัญญา/มติที่ประชุม : <input type="text" name="wb_thee" id="wb_thee" style="width: 70px; " class="input_text"/>
                                                &nbsp;&nbsp;วันที่อนุมัติ : <input type="text" name="date_staer_wb_thee" id="date_staer_wb_thee" style="width: 100px; " class="input_text"/>
                                                  <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_staer_wb_thee','YYYY-MM-DD')"  style="cursor:pointer"/>
                                                </td>
                                              </tr>

                                              <tr>
                                                <td align="right" >&nbsp;</td>
                                                <td align="left"><input type="hidden" id="wrk_id" name="wrk_id"  /></td>
                                              </tr>

                                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                            <tr>
                                              <td align="right"><img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data5();"/></td>
                                              <td><img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')" onclick="cal()"/></td>
                                            </tr>
                         					<?php } ?>

                                      </tr>
                                   </table>
                                   </form>
                              </td>
                              </tr>
                            </table>
                           </div>

                         </div>


                         <div id="tabs-6" align="center">
                          <div id="pay_list" align="center" class="data_details_list">
						   <? include "pay_fund_table.php"; ?>
                          </div>
                          <div align="center"><img src="../images/add.png" onclick="toggle_form('pay_fund','pay_fund_id',this,'#data_form3'); clear_data_ajax();" style="cursor:pointer"/></div>
                          <div id="data_form3" style="display:none;">
                          <img src="../images/bg_d.png" style="margin-left:10px;" width="640" />
                          <p>
                             <table  cellspacing="0" cellpadding="0" align="center" >
                              <tr>
                                <td>
                                  <form id="pay_fund" name="pay_fund" method="post" action="pay_fund_data_save.php" target="upload_target">
                                    <table width="758" border="0" cellspacing="4" cellpadding="4">
                                      <tr>
                                        <input type="hidden" id="pay_fund_id" name="pay_fund_id" value="">

                                             <tr>
                                                <td align="right" class="form_text">สัญญาทุน :</td>
                                                <td align="left">
                                                <select name="contract_fund" id="contract_fund"  onchange="load_pay(this.value),load_position_code()">
                                                <option value="">-- เลือกเลขที่สัญญา --</option>
                                                <?
                                                $sql_pay = "SELECT * FROM  " . TB_SDU_MUNNY_TAB . " WHERE EMP_ID = '" .$_SESSION["EMP_ID"]. "' ";
                                                $stid_pay = oci_parse($conn, $sql_pay);
                                                oci_execute($stid_pay);
                                                while ($row_pay = oci_fetch_array($stid_pay, OCI_BOTH)) { ?>
                                                 <option value="<?=$row_pay["CT_NO"]; ?>"><?=$row_pay["CT_NO"]; ?></option>
                                               <?  } ?>

                                                </select>
                                               </td>
                                            </tr>
                                              <tr>
                                                <td align="right" class="form_text">ครั้งที่ :</td>
                                                <td align="left"><input type="text" name="no_num" id="no_num" style="width: 100px; " class="int_text"/></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">ประเภทการเบิกจ่าย :</td>
                                                <td align="left"><input type="text" name="category" id="category" style="width: 200px; " class="input_text" /></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">จำนวนเงิน :</td>
                                                <td align="left"><input type="text" name="munny_num" id="munny_num" style="width: 100px; " class="int_text" />
                                                </td>

                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">วันที่เบิก :</td>
                                                <td align="left"><input type="text" name="date_opan" id="date_opan" style="width: 100px; " class="input_text"/>
                                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_opan','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">เลขที่บันทึก :</td>
                                                <td align="left"><input type="text" name="no_record" id="no_record" style="width: 100px; " class="int_text"/></td>
                                            </tr>

                                            <tr>
                                                <td align="right" class="form_text">หมายเหตุ :</td>
                                                <td align="left"><input type="text" name="note_c" id="note_c" style="width: 300px; " class="input_text"/></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">จำนวนเงินคงเหลือ :</td>
                                                <td align="left"><input type="text" name="num_munny" id="num_munny" style="width: 100px; " class="int_text"/></td>
                                            </tr>

                                             <tr>
                                                <td align="right" >&nbsp;</td>
                                                <td align="left"><input type="hidden" id="id_p" name="id_p"  /></td>
                                              </tr>

                                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                            <tr>
                                              <td align="right"><img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data6();"/></td>
                                              <td><img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')" onclick="cal2()"/></td>
                                            </tr>
                         					<?php } ?>
                                            <tr>
                                            <td align="right">&nbsp;</td>
                                            <td align="left" height="43"><span id="waiting3"></span></td>
                                          </tr>
                                      </tr>
                                   </table>
                                   </form>
                              </td>
                              </tr>
                            </table>
                            </p>
                           </div>

                         </div>
						<div id="tabs-7" align="center">
                          <div id="la_list" align="center" class="data_details_list">
						   <? include "la_fund_table.php"; ?>
                          </div>
                          <div align="center"><img src="../images/add.png" onclick="toggle_form('la_fund','la_fund_id',this,'#data_form7'); clear_data_ajax();" /></div>
                          <div id="data_form7" style="display:none;">
                          <img src="../images/bg_d.png" style="margin-left:10px;" width="640" />
                          <p>
                             <table  cellspacing="0" cellpadding="0" align="center" >
                              <tr>
                                <td>
                                  <form id="la_fund" name="la_fund" method="post" action="la_fund_data_save.php" target="upload_target">
                                    <table width="758" border="0" cellspacing="4" cellpadding="4">
                                      <tr>
                                        <input type="hidden" id="la_fund_id" name="la_fund_id" value="">


                                            <tr>
                                                <td align="right" class="form_text">*ประเภทการลา:</td>
                                                <td align="left">
                                                    <select name="stop_type" id="stop_type">
                                                         <option value="">----- เลือก ------</option>
                                                         <option value="1">ลาทำวิทยานิพนธ์ </option>
                                                         <option value="2">วิจัย</option>
                                                         <option value="3">ศึกษาอบรม </option>
                                                         <option value="4">ศึกษาดูงาน </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">*วันที่เริ่มต้น :</td>
                                                <td align="left"><input type="text" name="la_date_start" id="la_date_start" style="width: 100px; " class="input_text"/>
                                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_date_start','YYYY-MM-DD')"  style="cursor:pointer"/>
                                                &nbsp;&nbsp;&nbsp;*วันที่สิ้นสุด : <input type="text" name="la_end_start" id="la_end_start" style="width: 100px; " class="input_text"/>
                                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_end_start','YYYY-MM-DD')"  style="cursor:pointer"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="form_text">*วันที่ได้รับอนุมัติ :</td>
                                                <td align="left"><input type="text" name="approve_date" id="approve_date" style="width: 100px; " class="input_text"/>
                                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('approve_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="169" align="right" class="form_text"> *คำสั่ง : </td>
                                                <td colspan="2" align="left"><input type="text" name="la_order_no1" id="la_order_no1" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  ที่ <input type="text" id="la_at1" name="la_at1" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  สั่ง ณ วันที่ <input type="text"  name="la_at_date1" id="la_at_date1" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_at_date1','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                                              </tr>
                                               <tr>
                                                <td width="169" align="right" class="form_text"> บันทึกข้อความที่ : </td>
                                                <td colspan="2" align="left"><input type="text" name="la_order_no2" id="la_order_no2" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo ""; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  ที่ <input type="text" id="la_at2" name="la_at2" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													 ลงวันที่ <input type="text"  name="la_at_date2" id="la_at_date2" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_at_date2','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?> </td>
                                              </tr>
                                              <tr>
                                                <td align="right" >&nbsp;</td>
                                                <td align="left">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td align="right" class="form_text">วันที่กลับเข้าปฏิบัติหน้าที่ :</td>
                                                <td align="left"><input type="text" name="approve_end_date" id="approve_end_date" style="width: 100px; " class="input_text"/>
                                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('approve_end_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
                                            </tr>
                                               <tr>
                                                <td width="169" align="right" class="form_text"> คำสั่ง : </td>
                                                <td colspan="2" align="left"><input type="text" name="la_order_no3" id="la_order_no3" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  ที่ <input type="text" id="la_at3" name="la_at3" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													 สั่ง ณ วันที่ <input type="text"  name="la_at_date3" id="la_at_date3" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_at_date3','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
											</tr>
                                               <tr>
                                                <td width="169" align="right" class="form_text"> บันทึกข้อความที่ : </td>
                                                <td colspan="2" align="left"><input type="text" name="la_order_no4" id="la_order_no4" style="width: 80px; " class="input_text" value="<? if ($row["SCH_ORDER_NO"] == "") { echo ""; } else { echo $row["SCH_ORDER_NO"]; } ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  ที่ <input type="text" id="la_at4" name="la_at4" style="width: 80px; " class="input_text" <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
													  ลงวันที่ <input type="text"  name="la_at_date4" id="la_at_date4" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["SCH_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>> <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('la_at_date4','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                                              </tr>

                                             <tr>
                                                <td align="right" >&nbsp;</td>
                                                <td align="left"><input type="hidden" id="id_la" name="id_la"  /></td>
                                              </tr>

                                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
                                            <tr>
                                              <td align="right"><img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data7();"/></td>
                                              <td><img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')" onclick="cal3()"/></td>
                                            </tr>
                         					<?php } ?>
                                            <tr>
                                            <td align="right">&nbsp;</td>
                                            <td align="left" height="43"><span id="waiting3"></span></td>
                                          </tr>
                                      </tr>
                                   </table>
                                   </form>
                              </td>
                              </tr>
                            </table>
                            </p>
                           </div>

                         </div>

                      </div>


                    </td>
                  </tr>
                </table>
                <div id="dialog_major" title="ระบบค้นหาสาขาวิชา" style="display:none">
                  <p align="center">
                    กรอกคำที่ต้องการ : <input type="text" id="search_major" name="search_major" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_major($('#search_major').val())"/>
                  </p>
                  <div id="result_search_major" align="center"></div>
                </div>

                <div id="dialog_nation" title="ระบบค้นหาประเทศ" style="display:none">
                  <p align="center">
                    กรอกคำที่ต้องการ : <input type="text" id="search_nation" name="search_nation" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation($('#search_nation').val())"/>
                  </p>
                  <div id="result_search_nation" align="center"></div>
                </div>

				<div id="dialog_bursary" title="เงินทุน" style="display:none">
                  <p align="center">
                    <table>
						<tr>
							<td align="right">แหล่งทุน :</td>
							<td><input id="bursary_n" type="text"/></td>
						</tr>
						<tr>
							<td align="right">วงเงินขอทุน :</td>
							<td><input id="bursary_money" type="text"/></td>
						</tr>
						<tr>
							<td align="right">วันที่อนุมัติ :</td>
							<td><input type="text" id="bursary_date" style="width: 80px;"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('bursary_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
						</tr>
					</table>
                  </p>

                </div>

				<div id="dialog_open_ream" title="เบิกทุน" style="display:none">
                  <div id="dialog_open_ream_output"></div>
				  <input type="hidden" id="dialog_open_ream_main">
                </div>
<? $db->closedb($conn); ?>

<script>
function show_scholar_withdraw_money(id){
	//show_scholar_withdraw_money
	//alert("444");
	/*
	$.ajax({
		type: "POST",
		url: "scholar_withdraw_money.php",
		cache: false,
		data: "ids="+id,
		success: function(msg){
					$("#scholar_withdraw_money").html(msg);
				}
	});
	*/
	open_bursary_ajax(id);
}

function open_bursary_ajax(id){
	$.ajax({
		type: "POST",
		url: "scholarship_data_.php",
		cache: false,
		data: "ids="+id,
		success: function(msg){
					$("#bursary_data").html(msg);
				}
	});
}

function open_bursary(){
	 $('#dialog_bursary').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'400',
      height: '250',
      buttons: {
	  	เพิ่ม: function() {
          $(this).dialog('close');
		   bursary_add();
          $("#bursary_n").val("");
          $("#bursary_money").val("");
		  $("#bursary_date").val("");
        },
        ปิด: function() {
          $(this).dialog('close');
          $("#bursary_n").val("");
          $("#bursary_money").val("");
		  $("#bursary_date").val("");
        }
      }
    });

	$('#dialog_bursary').dialog("open");
}

function bursary_add(){
	var bursary_data = $("#bursary_data");
	var chk = 0;
	if($("#bursary_money").val()=="" || $("#bursary_date").val()=="" || $("#bursary_date").val()==""){
		chk = 1;
		alert("กรุณากรอกข้อมูลให้ครบ");
	}
	//alert(bursary_data.find("table").length);
	if(bursary_data.find("table").length == 0 && chk == 0){
		bursary_data.html("<table width='90%'  border='0' align='left'  bgcolor='#e9e9e9' id='table_bursary'><tr align='center'  class='text_th'><td class='text_tr' width='8%'>ครั้งที่</td><td class='text_tr' >แหล่งทุน</td><td class='text_tr' width='20%'>วงเงินขอทุน</td><td class='text_tr' width='20%'>วันที่ได้รับอนุมัติ</td><td class='text_tr' width='20%'>คงเหลืองทุน</td><td class='text_tr' width='10%'>เบิก</td><td class='text_tr' width='10%'>ลบ</td></tr></table>");
	}

	var input_val = "<input type='hidden' name='bursary_money[]' value='"+$("#bursary_money").val()+"'><input type='hidden' name='bursary_n[]' value='"+$("#bursary_n").val()+"'><input type='hidden' name='bursary_date[]' value='"+$("#bursary_date").val()+"'>";
	var html = "<tr id='tr_bursary"+(bursary_data.find("table tr").length)+"'><td class='text_td' align='center'>"+(bursary_data.find("table tr").length)+"</td><td class='text_td'>"+$("#bursary_n").val()+"</td><td class='text_td' align='right'>"+addCommas($("#bursary_money").val())+"</td><td class='text_td' align='center'>"+$("#bursary_date").val()+"</td><td class='text_td' align='right'>"+addCommas($("#bursary_money").val())+"</td><td class='text_td' align='center'>ยังไม่บันทึก</td><td class='text_td' align='center'><img src='../images/b_del.png' height='15' border='0'' style='cursor:pointer' title='Delete'' class='vtip' onclick='del_bursary(\""+(bursary_data.find("table tr").length)+"\")' />"+input_val+"</td></tr>";
	if(chk == 0){
		$("#table_bursary").append(html);
	}

}

function del_bursary(id){
	//alert(id);
	$("#tr_bursary"+id).remove();
	var i =0;
	$("#bursary_data tr").each(function(){
		if(i>0){
			$(this).find("td:first").html(i);
		}
		i++;
	});

}

function del_bursary2(id,id2){
	//alert(id);
	$.ajax({
		type: "POST",
		url: "scholarship_data_del_.php",
		cache: false,
		data: "ids="+id,
		success: function(msg){
					//$("#bursary_data").html(msg);
					alert(msg);
				}
	});
	$("#tr_bursary"+id2).remove();
	var i =0;
	$("#bursary_data tr").each(function(){
		if(i>0){
			$(this).find("td:first").html(i);
		}
		i++;
	});

}

function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
}

function open_ream(id,id2){
	$("#dialog_open_ream_main").val(id2);
	//alert($("#dialog_open_ream_main").val());
	//dialog_open_ream
	$('#dialog_open_ream').dialog({
      autoOpen: false,
      modal: true,
      hide: 'slide',
      show: 'slide',
      width:'700',
      height: '500',
      buttons: {
	  	บันทึก: function() {
          //$(this).dialog('close');
		  ream_save();
        },
        ปิด: function() {
		  open_bursary_ajax($("#dialog_open_ream_main").val());
		  $("#dialog_open_ream_main").val('');
          $(this).dialog('close');

        }
      }
    });

	$.ajax({
		type: "POST",
		url: "scholar_withdraw_money.php",
		cache: false,
		data: "ids="+id+"&ac=show",
		success: function(msg){
					$("#dialog_open_ream_output").html(msg);
				}
	});

	$('#dialog_open_ream').dialog("open");
}

function ream_save(){

	var scholarship_id = $("#scholarship_id").val();
	var withdraw_money = $("#withdraw_money").val();
	var withdraw_money_date  = $("#withdraw_money_date").val();
	$.ajax({
		type: "POST",
		url: "scholar_withdraw_money.php",
		cache: false,
		data: "scholarship_id="+scholarship_id+"&withdraw_money="+withdraw_money+"&withdraw_money_date="+withdraw_money_date+"&ac=add",
		success: function(msg){
					//alert(msg);
					//open_ream(scholarship_id);
					open_bursary_ajax($("#dialog_open_ream_main").val());
		  			$("#dialog_open_ream_main").val('');
          			$("#dialog_open_ream").dialog('close');
				}
	});
}

function ream_del(id,no){
	var con = confirm("ยืนยันการลบข้อมูล");
	if(con == true){

		$.ajax({
			type: "POST",
			url: "scholar_withdraw_money.php",
			cache: false,
			data: "scholarship_id="+id+"&no="+no+"&ac=del",
			success: function(msg){
					open_bursary_ajax($("#dialog_open_ream_main").val());
		  			$("#dialog_open_ream_main").val('');
          			$("#dialog_open_ream").dialog('close');
			}
		});

	}
}

function clear_data_ajax(){
	$("#bursary_data").html("");
}

</script>
