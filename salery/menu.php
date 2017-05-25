<?php
@session_start();
$user_type = $_SESSION["USER_TYPE"];
//$user_type = 'chief';
//initial var     1 = allow , 0 = not allow

for ($i = 1; $i <= 52; $i++) {
  $menu[$i] = 1;
}
for ($i = 1; $i <= 5; $i++) {
  $menu_header[$i] = 1;
}

$user_head1 = 1;
$user_head5 = 1;

//if ($user_type == "finance") {
  $menu_header[6] = 1;
  $menu[42] = 1;
  $menu[43] = 1;
//}
//$menu_header[6] = 1;

//allow setting
if ($user_type == "user") {
  $menu_header[1] = 0;
  $menu_header[5] = 0;
  $menu[1] = 0;
  $menu[2] = 0;
  $menu[3] = 0;
  $menu[4] = 0;
  $menu[5] = 0;
  $menu[6] = 0;
  $menu[7] = 0;
  $menu[8] = 0;
  $menu[14] = 0;
  $menu[20] = 0;
  $menu[32] = 0;
  $menu[33] = 0;
  $menu[34] = 0;
  $menu[35] = 0;
  $menu[36] = 0;
  $menu[37] = 0;
  $menu[38] = 0;
  $menu[39] = 0;
  $menu[40] = 0;
  $menu[41] = 0;
}


if ($user_type == "chief") {
  $menu[1] = 0;
  $menu[2] = 0;
  $menu[4] = 0;
  $menu[5] = 0;
  $menu[6] = 0;
  $menu[7] = 0;
  $menu[8] = 0;
  $menu[37] = 0;
  $menu[40] = 0;
  $menu[41] = 0;
}

if ($user_type == "chief" && $_SESSION['USER_EMP_ID'] != $_SESSION['EMP_ID']) {
  $menu[1] = 0;
  $menu[2] = 0;
  $menu[4] = 0;
  $menu[5] = 0;
  $menu[6] = 0;
  $menu[7] = 0;
  $menu[8] = 0;
  $menu[10] = 0;
  $menu[11] = 0;
  $menu[12] = 0;
  //$menu[14] = 0;
  $menu[15] = 0;
  $menu[16] = 0;
  $menu[17] = 0;
  $menu[18] = 0;
  $menu[20] = 0;
  $menu[21] = 0;
  $menu[40] = 0;
  $menu[41] = 0;
}
?>
<style type="text/css" >
  .menu_visited{
    background-color: #d5aec9;
    color: #033;
    font-weight: bold;
    padding-left: 9px;
  }
</style>
<div class="urbangreymenu" align="left">
  <? if ($menu_header[1]) { ?>
    <div  class="headerbar" ><?php if ($_SESSION['USER_TYPE'] == 'chief') { ?>ค้นหา<?php } else { ?>ผู้ดูแลระบบ<?php } ?></div>
    <ul class="submenu" <?= $user_head1 ?>>
      <? if ($menu[1]) { ?>
        <li ><a  onclick="change_color(1);change_data('new_person.php','../images/head2/bio/new_person.png');"  id="menu1" >เพิ่มประวัติบุคลากร</a></li>
      <? } ?>
      <? if ($menu[2]) { ?>
        <li ><a onclick="change_color(2);change_data('register.php','../images/head2/bio/new_user.png');" id="menu2">เพิ่มผู้ใช้งาน</a></li>
      <? } ?>
      <? if ($menu[3]) { ?>
        <li ><a onclick="change_color(3);change_data('search.php','../images/head2/bio/search.png');" id="menu3">ระบบค้นหา</a></li>
      <? } ?>
      <? if ($menu[4]) { ?>
        <li><a onclick="change_color(4);change_data('salary_step.php','../images/head2/work_data/salary.png');" id="menu4">เงินเดือน</a></li>
      <? } ?>
      <? if ($menu[5]) { ?>
        <li><a onclick="change_color(5);change_data('job_announcement.php','../images/head2/work_data2/job_announcement.png');" id="menu5">ประกาศรับสมัครบุคลากร</a></li>
      <? } ?>
      <? if ($menu[6]) { ?>
        <li ><a onclick="change_color(6);change_data('temp_card.php','../images/head2/work_data2/temp_card.png');" id="menu6">ออกบัตรประจำตัวบุคลากร</a></li>
      <? } ?>
      <? if ($menu[7]) { ?>
        <li ><a onclick="change_color(7);change_data('retire_data.php','../images/head2/work_data/retire.png');" id="menu7">เกษียณอายุ</a></li>
      <? } ?>
      <? if ($menu[8]) { ?>
        <li ><a onclick="change_color(8);change_data('ex_contract.php','../images/head2/bio/ex_contract.png');" id="menu8">ต่อสัญญา</a></li>
      <? } ?>
      <? if ($menu[40]) { ?>
        <li ><a onclick="change_color(40);change_data('../master/master_menu.php','../images/none.png');" id="menu40">จัดการข้อมูลตารางมาตรฐาน</a></li>
      <? } ?>
      <!-- <li>จัดการข้อมูลตารางมาตรฐาน</li>-->
      <? if ($menu[41]) { ?>
        <li ><a onclick="change_color(40);change_data('change_code.php','../images/no.png');" id="menu40">เปลี่ยนหมายเลขบุคลากร</a></li>
      <? } ?>
    </ul>
    <div style="height:1px"></div>
  <? } ?>
  <? if ($menu_header[2]) { ?>
    <div class="headerbar">ทะเบียนประวัติ</div >
    <ul class="submenu">
      <? if ($menu[9]) { ?>
        <li ><a onclick="change_color(9);change_data('bio_data.php','../images/head2/bio/biodata.png');" id="menu9" >ข้อมูลเบื้องต้น</a></li>
      <? } ?>
      <? if ($menu[10]) { ?>
        <li ><a onclick="change_color(10);change_data('cen_address.php','../images/head2/bio/cen_address.png');" id="menu10">ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน</a></li>
      <? } ?>
      <? if ($menu[11]) { ?>
        <li ><a onclick="change_color(11);change_data('family_data.php','../images/head2/bio/family.png');" id="menu11">ข้อมูลบิดา มารดา คู่สมรส</a></li>
      <? } ?>
      <? if ($menu[12]) { ?>
        <li ><a onclick="change_color(12);change_data('children_data.php','../images/head2/bio/children.png');" id="menu12">ข้อมูลบุตร</a></li>
      <? } ?>
    </ul>
    <div style="height:1px"></div>
  <? } ?>

  <? if ($menu_header[3]) { ?>
    <div class="headerbar">ข้อมูลบุคคล</div>
    <ul class="submenu">
      <? if ($menu[13]) { ?>
        <li ><a onclick="change_color(13);change_data('education.php','../images/head2/work_data/education.png');" id="menu13">ประวัติการศึกษา</a></li>
      <? } ?>
      <? if ($menu[15]) { ?>
        <li ><a onclick="change_color(15);change_data('scholar.php','../images/head2/work_data/scholar.png');" id="menu15">ข้อมูลการศึกษาต่อ</a></li>
      <? } ?>
      <? if ($menu[16]) { ?>
        <li ><a onclick="change_color(16);change_data('research_creative.php','../images/head2/work_data/research.png');"  id="menu16">การขอทุนวิจัย</a></li>
      <? } ?>
      <? if ($menu[17]) { ?>
        <li ><a onclick="change_color(17);change_data('royal.php','../images/head2/work_data/royal.png');" id="menu17" >เครื่องราชอิสริยาภรณ์</a></li>
      <? } ?>
      <? if ($menu[18]) { ?>
        <li ><a onclick="change_color(18);change_data('honor.php','../images/head2/work_data/honor.png');" id="menu18" >ประกาศเกียรติคุณ</a></li>
      <? } ?>
      <? if ($menu[19]) { ?>
        <li ><a onclick="change_color(19);change_data('expert.php','../images/head2/work_data/expert.png');"  id="menu19">ความเชี่ยวชาญ</a></li>
      <? } ?>
      <? if ($menu[20]) { ?>
        <li ><a onclick="change_color(20);change_data('guarantee_data.php','../images/head2/work_data2/guarantee.png');"  id="menu20">ผู้ค้ำประกัน</a></li>
      <? } ?>
      <? if ($menu[21]) { ?>
        <li ><a onclick="change_color(21);change_data('welfare.php','../images/head2/work_data2/welfare.png');"  id="menu21">สวัสดิการและสิทธิประโยชน์</a></li>
      <? } ?>
      <? if ($menu[22]) { ?>
        <li ><a onclick="change_color(22);change_data('warn_punish.php','../images/head2/work_data2/warn.png');"  id="menu22">การตักเตือน ลงโทษ</a></li>
      <? } ?>
    </ul>
    <div style="height:1px"></div>
  <? } ?>
  <? if ($menu_header[4]) { ?>
    <div class="headerbar">ข้อมูลการทำงาน</div>
    <ul class="submenu">
      <? if ($menu[23]) { ?>
        <li ><a onclick="change_color(23);change_data('work_history.php','../images/head2/work_data/workhistory.png');"  id="menu23">ประวัติการทำงานในอดีต</a></li>
      <? } ?>
      <? if ($menu[24]) { ?>
        <li ><a onclick="change_color(24);change_data('current_work.php','../images/head2/work_data/current_work.png');"  id="menu24">ตำแหน่งงานปัจจุปัน</a></li>
      <? } ?>
      <? if ($menu[25]) { ?>
        <li ><a onclick="change_color(25);change_data('position.php','../images/head2/work_data/vcharkarn_position.png');"  id="menu25">ตำแหน่งทางวิชาการ</a></li>
      <? } ?>
      <? if ($menu[41]) { ?>
        <li ><a onclick="change_color(41);change_data('position_sup.php','../images/head2/work_data/position_sup.png');"  id="menu41">ตำแหน่งสายสนับสนุน</a></li>
      <? } ?>
      <? if ($menu[26]) { ?>
        <li ><a onclick="change_color(26);change_data('seminar.php','../images/head2/work_data2/seminar.png');"  id="menu26">การอบรมสัมมนา</a></li>
      <? } ?>
      <? if ($menu[27]) { ?>
        <li ><a onclick="change_color(27);change_data('constructor.php','../images/head2/work_data2/constructor.png');"  id="menu27">การเป็นวิทยากร อาจารย์พิเศษ</a></li>
      <? } ?>
      <? if ($menu[28]) { ?>
        <li ><a onclick="change_color(28);change_data('consult_commit.php','../images/head2/work_data2/consult.png');"  id="menu28">การเป็นที่ปรึกษา</a></li>
      <? } ?>
      <? if ($menu[29]) { ?>
        <li ><a onclick="change_color(29);change_data('committee.php','../images/head2/work_data2/commit.png');"  id="menu29">การเป็นกรรมการภายนอก</a></li>
      <? } ?>
      <? if ($menu[30]) { ?>
        <li><a onclick="change_color(30);change_data('appraise_data.php','../images/head2/work_data2/appraise.png');"  id="menu30">การประเมินการทำงาน</a></li>
      <? } ?>
      <? if ($menu[31]) { ?>
        <li ><a onclick="change_color(31);change_data('contract_history.php','../images/head2/work_data2/contract_history.png');"  id="menu31">ประวัติข้อมูลการต่อสัญญา</a></li>
      <? } ?>
    </ul>
    <div style="height:1px"></div>
  <? } ?>
  <? if ($menu_header[5]) { ?>
    <div class="headerbar" >รายงาน</div>
    <ul class="submenu" >
      <? if ($menu[32]) { ?>
        <li ><a onclick="change_color(32);change_data('summary_report.php','../images/head2/report/summary.png');"  id="menu32">สรุปยอดรวมบุคลากร</a></li>
      <? } ?>
      <? if ($menu[33]) { ?>
        <li ><a onclick="change_color(33);change_data('scholar_report.php','../images/head2/report/scholar_report.png');"  id="menu33">ศึกษาต่อ/สำเร็จการศึกษา</a></li>
      <? } ?>
      <? if ($menu[34]) { ?>
        <li ><a onclick="change_color(34);change_data('dev_report.php','../images/head2/report/dev_report.png');"  id="menu34">การพัฒนาบุคคลากร</a></li>
      <? } ?>
      <? if ($menu[35]) { ?>
        <li ><a onclick="change_color(35);change_data('quit_report.php','../images/head2/report/quit_report.png');"  id="menu35">ลาออก</a></li>
      <? } ?>
      <? if ($menu[36]) { ?>
        <li ><a onclick="change_color(36);change_data('new_report.php','../images/head2/report/new_report.png');"  id="menu36">บุคลากรเข้าใหม่</a></li>
      <? } ?>
      <? if ($menu[37]) { ?>
        <li ><a onclick="change_color(37);change_data('salary_report.php','../images/head2/report/salary_report.png');"  id="menu37">เงินเดือน</a></li>
      <? } ?>
      <? if ($menu[38]) { ?>
        <li ><a onclick="change_color(38);change_data('retire_report.php','../images/head2/report/retire.png');"  id="menu38">เกษียณอายุราชการ</a></li>
      <? } ?>
      <? if ($menu[39]) { ?>
        <li ><a onclick="change_color(39);change_data('royal_report.php','../images/head2/report/royal_data.png');"  id="menu39">เครื่องราชอิสริยาภรณ์</a></li>
      <? } ?>
      <? if ($menu[40]) { ?>
        <li ><a onclick="change_color(14);change_data('quality_report.php','../images/head2/report/quality.png');"  id="menu14" >งานประกันคุณภาพ</a></li>
      <? } ?>
    </ul>
  <? } ?>
  <? if ($menu_header[6]) { ?>
    <div class="headerbar" >โปรแกรมสำหรับฝ่ายการเงิน</div>
    <ul class="submenu" >
      <? if ($menu[42]) { ?>
        <li ><a onclick="change_color(42);change_data('s1.php','');"  id="menu42" >รายงานเปรียบเทียบเงินเดือน</a></li>
      <? } ?>
      <!--
      <? if ($menu[43]) { ?>
        <li ><a onclick="change_color(43);change_data('s2.php','');"  id="menu43" >รายงานเงินเดือน</a></li>
      <? } ?>
      -->
    </ul>
  <? } ?>
</div>