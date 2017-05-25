<?
include "../master/master_header.php";
require_once("conn.php");
?>
<style type="text/css" >
  #masterMenu ul{
    list-style-type: circle;
  }
  #masterMenu li{
    cursor: pointer;
    margin-bottom: 8px;
  }
  #masterMenu li:hover{
    color: #333;
    font-weight: bold;
    list-style-type: disc;
  }
    #masterMenu li a:hover{
      background-color: #f9e4fc;
  }
</style>
<div id="mainContainer">

  <div id="masterMenu">
    <h3>Menu จัดการฐานข้อมูล</h3>
    <ul>
      <li ><a onclick="change_data('../master/ref_position_list.php','../images/none.png');" id="menu40">master ตำแหน่ง</a></li>
      <li ><a onclick="change_data('../master/ref_admin_list.php','../images/none.png');" id="menu41">master ตำแหน่งงานทางบริหาร</a></li>
      <li ><a onclick="change_data('../master/ref_department_group_list.php','../images/none.png');" id="menu42">master กลุ่มงาน</a></li>
      <li ><a onclick="change_data('../master/ref_department_list.php','../images/none.png');" id="menu43">master หน่วยงานหลัก</a></li>
      <li ><a onclick="change_data('../master/ref_department_sub_list.php','../images/none.png');" id="menu44">master หน่วยงานย่อย</a></li>
      <li ><a onclick="change_data('../master/ref_extra_salary_list.php','../images/none.png');" id="menu45">master เงินพิเศษ</a></li>
      <li ><a onclick="change_data('../master/ref_isced_list.php','../images/none.png');" id="menu46">master กลุ่มวิชาที่สอน</a></li>
      <li ><a onclick="change_data('../master/ref_salary_source.php','../images/none.png');" id="menu47">master ประเภทของงบประมาณ</a></li>
      <li ><a onclick="change_data('../master/ref_staff_lev.php','../images/none.png');" id="menu48">master ระดับตำแหน่ง</a></li>
      <li ><a onclick="change_data('../master/ref_staff_type.php','../images/none.png');" id="menu49">master ประเภทบุคลากร(มสด)</a></li>
      <li ><a onclick="change_data('../master/ref_staff_type_sga.php','../images/none.png');" id="menu50">master ประเภทบุคลากร(สกอ)</a></li>
      <li ><a onclick="change_data('../master/ref_staff_type_pair.php','../images/none.png');" id="menu51">master จับคู่ประเภทบุคลากร</a></li>
      <li ><a onclick="change_data('../master/ref_substaff_type.php','../images/none.png');" id="menu52">master ประเภทบุคลากรย่อย</a></li>
      <li ><a onclick="change_data('../master/ref_uni_list.php','../images/none.png');" id="menu53">master มหาวิทยาลัย</a></li>
      <li ><a onclick="change_data('../master/ref_expert.php','../images/none.png');" id="menu54">master สาขาวิชาที่ขอกำหนดตำแหน่ง</a></li>
      <li ><a onclick="change_data('../master/ref_royal.php','../images/none.png');" id="menu55">master ชั้นของเครื่องราชฯ</a></li>
      <li ><a onclick="change_data('../master/ref_course.php','../images/none.png');" id="menu56">master ชื่อเต็มของหลักสูตร</a></li>
      <li ><a onclick="change_data('../master/master_position.php','../images/none.png');" id="menu57">master position</a></li>
	  <li ><a onclick="change_data('../master/ref_position_code.php','../images/none.png');" id="menu58">master เลขที่ตำแหน่ง</a></li>
	  <li ><a onclick="change_data('../master/ref_education_lever_list.php','../images/none.png');" id="menu59">master ระดับการศึกษา</a></li>
    </ul>
    <hr>
    <h3>Menu จัดการฐานข้อมูลการเงิน</h3>
    <ul>
      <li ><a onclick="change_data('../master/ref_budget.php','../images/none.png');" id="menu60">master ประเภทเงิน</a></li>
      <li ><a onclick="change_data('../master/ref_expend.php','../images/none.png');" id="menu62">master ค่าใช้จ่าย</a></li>
      <li ><a onclick="change_data('../master/ref_bank.php','../images/none.png');" id="menu63">master ข้อมูลธนาคาร</a></li>
      <li ><a onclick="change_data('../master/ref_bank_branch.php','../images/none.png');" id="menu64">master ข้อมูลสาขาธนาคาร</a></li>
      <li ><a onclick="change_data('../master/ref_bank_passbook.php','../images/none.png');" id="menu65">master ข้อมูลประเภทสมุดเงินฝาก</a></li>
      <li ><a onclick="change_data('../master/ref_overtime.php','../images/none.png');" id="menu65">master ประเภทค่าล่วงเวลา</a></li>
      <li ><a onclick="change_data('../master/ref_taxrate.php','../images/none.png');" id="menu65">master กำหนดภาษีและค่าลดหย่อน</a></li>
      <li ><a onclick="change_data('../master/ref_fund_prov.php','../images/none.png');" id="menu65">master กำหนดรหัสกองทุนสำรองเลี้ยงชีพ</a></li>
	</ul>
  </div>
</div>