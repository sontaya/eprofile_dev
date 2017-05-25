<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<? }
?>
<script type="text/javascript">
  load_pos_sub_list("1");
  load_ach_sub_list("1");
  function change_inner_form(id,page){
    if(id == ""){
      $("div#pos_sub_ach_form"+page).html("");
      $("select#va_type"+page).val("");
    }else{
      load_sch_ach_sub_form(id,page);
	
    }
	
  }


  function check_data_ach1(id,page){
    //alert("page="+page+" list="+id);
    if($("#course_name").val() == "" || $("#course_year").val() == "" || (!document.position_ach1.type[0].checked && !document.position_ach1.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach1.type[1].checked){
      if(document.position_ach1.coop.value == "" || document.position_ach1.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
		
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data_ach2(id,page){
    //alert("page="+page+" list="+id);
    if($("#tbook_name_th").val() == "" || $("#tbook_name_en").val() == "" || (!document.position_ach2.type[0].checked && !document.position_ach2.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach2.type[1].checked){
      if(document.position_ach2.coop.value == "" || document.position_ach2.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data_ach3(id,page){
    //alert("page="+page+" list="+id);
    if($("#book_name_th").val() == "" || $("#book_name_en").val() == ""  || (!document.position_ach3.type[0].checked && !document.position_ach3.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach3.type[1].checked){
      if(document.position_ach3.coop.value == "" || document.position_ach3.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data_ach4(id,page){
    //alert("page="+page+" list="+id);
    if($("#research_name_th").val() == "" || $("#research_name_en").val() == ""  || (!document.position_ach4.type[0].checked && !document.position_ach4.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach4.type[1].checked){
      if(document.position_ach4.coop.value == "" || document.position_ach4.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data_ach5(id,page){
    //alert("page="+page+" list="+id);
    if($("#article_name_th").val() == "" || $("#article_name_en").val() == ""  || (!document.position_ach5.type[0].checked && !document.position_ach5.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach5.type[1].checked){
      if(document.position_ach5.coop.value == "" || document.position_ach5.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data_ach6(id,page){
    //alert("page="+page+" list="+id);
    if($("#acheive_type").val() == "" || $("#acheive_name_th").val() == "" || $("#acheive_name_en").val() == ""  || (!document.position_ach6.type[0].checked && !document.position_ach6.type[1].checked)){
      $("#Please_fill_in").dialog('open');
      return false;
    }
    if(document.position_ach6.type[1].checked){
      if(document.position_ach6.coop.value == "" || document.position_ach6.proportion.value == ""){
        $("#Please_fill_in").dialog('open');
        return false;
      }
    }
    $("span#waiting_ach"+page).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position_ach"+id).submit();
  }

  function check_data(id){
		
    if($("#vp_type"+id).val() == "" || $("#vp_sub_type"+id).val() == "" || $("#vp_method"+id).val() == "" || $("#vp_by"+id).val() == "" || $("#vp_university"+id).val() == "" || $("#vp_professional_major"+id).val() == "" || $("#vp_date"+id).val() == "" || $("#vp_mati_1"+id).val() == "" || $("#vp_mati_2"+id).val() == ""){
      $("#Please_fill_in").dialog('open');
      return false;
    }
		
    $("span#waiting"+id).html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("position"+id).submit();
  }

  $(function() {
    $("#tabs").tabs();

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
		
		
  });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
  <tr><td >

      <div id="tabs" style="width:725px; margin-left:15px">
        <ul>
          <li><a href="#tabs-1" onclick="load_pos_sub_list('1');load_ach_sub_list('1');">ตำแหน่ง ชำนาญการ</a></li>
          <li><a href="#tabs-2" onclick="load_pos_sub_list('2');load_ach_sub_list('2');">ตำแหน่ง เชี่ยวชาญ</a></li>
          <li><a href="#tabs-3" onclick="load_pos_sub_list('3');load_ach_sub_list('3'); ">ตำแหน่ง เชี่ยวชาญ.พิเศษ</a></li>
        </ul>
        <div id="tabs-1">
          <table  cellspacing="0" cellpadding="0" align="center" >
            <tr>
              <td width="670" >
                <form id="position1" name="position1" method="post" action="position_sub_data_save.php"  target="upload_target" >
                  <input type="hidden" id="vp_type" name="vp_type" value="1" />
                  <div style="width:670px;">
                    <fieldset>
                      <legend style="font:17px bold;">ตำแหน่ง ชำนาญการ</legend><br />
                      <div id="pos_list1" align="center">
                      </div>
                    </fieldset>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td width="650" >
                <br />
                <div style="width:650px;">
                  <fieldset><legend style="font:17px bold;">ผลงาน</legend><br />
                    <div id="pos_ach_list1" align="center" >
                    </div>
                  </fieldset>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div id="tabs-2">
          <table  cellspacing="0" cellpadding="0" align="center" >
            <tr>
              <td width="670" >
                <form id="position2" name="position2" method="post" action="position_sub_data_save.php"  target="upload_target" >
                  <input type="hidden" id="vp_type" name="vp_type" value="2" />
                  <div style="width:670px;">
                    <fieldset>
                      <legend style="font:17px bold;">ตำแหน่ง เชี่ยวชาญ</legend><br />
                      <div id="pos_list2"  align="center">
                      </div>
                    </fieldset>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td width="650" >
                <br />
                <div style="width:650px;">
                  <fieldset><legend style="font:17px bold;">ผลงาน</legend><br />  
                    <div id="pos_ach_list2" align="center">
                    </div>
                  </fieldset>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div id="tabs-3">
          <table  cellspacing="0" cellpadding="0" align="center" >
            <tr>
              <td width="670" >
                <form id="position3" name="position3" method="post" action="position_sub_data_save.php"  target="upload_target" >
                  <input type="hidden" id="vp_type" name="vp_type" value="3" />
                  <div style="width:670px;">
                    <fieldset>
                      <legend style="font:17px bold;">ตำแหน่ง เชี่ยวชาญพิเศษ</legend><br />
                      <div id="pos_list3"  align="center">
                      </div>

                    </fieldset>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td width="650" >
                <br />
                <div style="width:650px;">
                  <fieldset><legend style="font:17px bold;">ผลงาน</legend><br /> 
                    <div id="pos_ach_list3" align="center">
                    </div>
                  </fieldset>
                </div>
              </td>
            </tr>
          </table>
        </div>

      </div>

    </td>
  </tr>  
</table>