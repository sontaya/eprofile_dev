<script language="javascript">
  function show_report(type){

    var path = "views_sga_report.php?year="+type;
    window.open(path,"new"+type,"width=1400,height=700,scrollbars=1,resizable=1");
	
  }


  function show_report_res(response){
    $("div#report_result").html(response);
  }
  
    $('#fieldDesc tr :gt(1)').hover(function () {$(this).parent().css('background-color', '#ccccff')}, function () {$(this).parent().css('background-color', '')});

  
</script>
<br />
<div align="center">
  <table width="627" border="0" cellpadding="3">
    <tr>
      <td width="164" align="right"> ปี : </td>
      <td width="299" align="left">
        <input type="text" name="year" id="year" style="width:50px" />
      </td
    </tr>


    <tr><td align="right">&nbsp;</td>
      <td align="left">
        <input type="button" value="แสดงรายงาน" onclick="show_report($('#year').val())"/></td>
    </tr>

  </table>
  <br /><br />
  <table border="1" width="600" id="fieldDesc" style="border-collapse: collapse">
    <tr style="background-color: #ff9999">
      <th>ฟิลด์ จากรายการข้อมูลรายบุคคลบุคลากร(uoc_staff) (ปี53)</th>
      <th>ฟิลด์ ที่อ้างอิงมา e profile</th>
    </tr>
    <tr>
      <td>YEAR</td>
      <td>รับค่าจากฟอร์ม</td>
    </tr>
    <tr>
      <td>UNIV_ID</td>
      <td>รหัส ม.ราชภัฎสวนดุสิต (16500)</td>
    </tr>
    <tr>
      <td>CITIZEN_ID</td>
      <td>sdu_biodata_tab.person_id</td>
    </tr>
    <tr>
      <td>PREFIX_NAME</td>
      <td>sdu_biodata_tab.bio_title_th</td>
    </tr> 
    <tr>
      <td>stf_fname</td>
      <td>sdu_biodata_tab.bio_fname_th</td>
    </tr>
    <tr>
      <td>stf_lname</td>
      <td>sdu_biodata_tab.bio_lname_th</td>
    </tr>
    <tr>
      <td>gender_id</td>
      <td>sdu_biodata_tab.bio_sex</td>
    </tr>
    <tr>
      <td>birthday</td>
      <td>sdu_biodata_tab.bio_birthday</td>
    </tr>
    <tr>
      <td>homeadd</td>
      <td>sdu_current_address_tab.cu_house_no</td>
    </tr>
    <tr>
      <td>moo</td>
      <td>sdu_current_address_tab.cu_moo</td>
    </tr>
    <tr>
      <td>street</td>
      <td>sdu_current_address_tab.cu_road</td>
    </tr>
    <tr>
      <td>district</td>
      <td>sdu_ref_tumbon.name_ref_tumbon FROM sdu_current_address_tab.cu_tumbon  join  sdu_ref_tumbon.code_ref_tumbon</td>
    </tr>
    <tr>
      <td>amphur</td>
      <td>sdu_ref_amphur.name_ref_amphur FROM sdu_current_address_tab.cu_amphur  join  sdu_ref_amphur.code_ref_amphur</td>
    </tr>
    <tr>
      <td>province_id</td>
      <td>sdu_ref_province.name_ref_province FROM sdu_current_address_tab.cu_province  join  sdu_ref_province.code_ref_province</td>
    </tr>
    <tr>
      <td>telephone</td>
      <td>sdu_currentwork_tab.cwk_phone</td>
    </tr>
    <tr>
      <td>zipcode</td>
      <td>sdu_current_address_tab.cu_post_code</td>
    </tr>
    <tr>
      <td>nation_id</td>
      <td>sdu_biodata_tab.bio_nation1</td>
    </tr>
    <tr>
      <td>stafftype_id</td>
      <td>sdu_currentwork_tab.cwk_mua_emp_type</td>
    </tr>
    <tr>
      <td>time_contact_id</td>
      <td>sdu_currentwork_tab.cwk_salary_time_type</td>
    </tr>
    <tr>
      <td>budget_id</td>
      <td>sdu_salary_step.source1  salary source ช่องที่ 1  บางคนอาจจะมีแหล่งเงินมากกว่า 1</td>
    </tr>
    <tr>
      <td>substafftype_id</td>
      <td>sdu_currentwork_tab.cwk_mua_emp_subtype</td>
    </tr>
    <tr>
      <td>admin_position_id</td>
      <td>sdu_currentwork_tab.cwk_mua_mpos</td>
    </tr>
    <tr>
      <td>postion_id</td>
      <td>sdu_currentwork_tab.cwk_mua_vpos</td>
    </tr>
    <tr>
      <td>position_work</td>
      <td>sdu_position.position FROM  sdu_currentwork_tab.CWK_DSU_POS = sdu_position.code</td>
    </tr>
    <tr>
      <td>department_id</td>
      <td>sdu_ref_fac.fac_id FROM sdu_currentwork_tab.cwk_mua_main join sdu_ref_department.code_faculty  AND sdu_ref_department.uoc_ref_fac join sdu_ref_fac.fac_id</td>
    </tr>
    <tr>
      <td>grad_lev_id</td>
      <td>sdu_education_tab.edu_level</td>
    </tr>
    <tr>
      <td>grad_curr</td>
      <td>sdu_education_tab.edu_name</td>
    </tr>
    <tr>
      <td>grad_isced_id</td>
      <td>sdu_education_tab.edu_program</td>
    </tr>
    <tr>
      <td>grad_prog_id</td>
      <td>sdu_education_tab.edu_program</td>
    </tr>
    <tr>
      <td>grad_univ</td>
      <td>sdu_education_tab.edu_from</td>
    </tr>
    <tr>
      <td>grad_country_id</td>
      <td>sdu_education_tab.edu_country</td>
    </tr>
  </table>
</div>


<div id="report_result" align="center"></div>