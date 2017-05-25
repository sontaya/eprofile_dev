<script language="javascript">
  function show_report(type){
    if(type == ""){
      alert("กรุณาเลือกประเภทรายงาน");
      return false;
    }
    if(type == "1"){
      window.open("sdu_report.php","sdu","width=1400,height=700,scrollbars=1,resizable=1");
    }else if(type == "7"){
      window.open("sdu_report_teacher.php","sdu","width=1400,height=700,scrollbars=1,resizable=1");
    }else{
      $("div#report_result").html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-top: 200px' />");
      var data = "type="+type;
      ajaxPostData("summary_report_result.php",data,"text","",show_report_res,"","");
    }
  }

  function show_report_res(response){
    $("div#report_result").html(response);
  }
</script>
<br />
<div align="center">ประเภทรายงาน : 
  <select id="type" name="type" >
    <option value="">---------- เลือก ----------</option>
    <option value="1" >ข้อมูลบุคลากรสายสนับสนุน</option>
    <option value="7" >ข้อมูลบุคลากรสายวิชาการ</option>
    <option value="2">จำแนกตามประเภทบุคลากร</option>
    <option value="3">จำแนกตามหน่วยงาน</option>
    <option value="4">จำแนกตามวุฒิการศึกษาและประเภท </option>
    <option value="5">จำแนกตามตำแหน่งวิชาการ</option>
    <option value="6">จำแนกตามหน่วยงานและคุณวุฒิ</option>
  </select>
  &nbsp; 
  <input type="button" value="แสดงรายงาน" onclick="show_report(document.getElementById('type').value)"/>
</div><br />
<div id="report_result" align="center"></div>