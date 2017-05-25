<div class="urbangreymenu" align="left">
 
<?
		 if($_SESSION["USER_TYPE"] == "admin" or $_SESSION["USER_TYPE"] == "hr" ){
?>
<div  class="headerbar">ผู้ดูแลระบบ</div>
<ul class="submenu" >
<li><a onclick="change_color(1);change_data('new_person.php','../images/head2/bio/new_person.png');"  id="menu1" >เพิ่มประวัติบุคลากร</a></li>
<li><a onclick="change_color(2);change_data('register.php','../images/head2/bio/new_user.png');" id="menu2">เพิ่มผู้ใช้งาน</a></li>
<li><a onclick="change_color(3);change_data('search.php','../images/head2/bio/search.png');" id="menu3">ระบบค้นหา</a></li>
<li><a onclick="change_color(4);change_data('salary_step.php','../images/head2/work_data/salary.png');" id="menu4">เงินเดือน</a></li>
<li><a onclick="change_color(5);change_data('job_announcement.php','../images/head2/work_data2/job_announcement.png');" id="menu5">ประกาศรับสมัครบุคลากร</a></li>
<li><a onclick="change_color(6);change_data('temp_card.php','../images/head2/work_data2/temp_card.png');" id="menu6">ออกบัตรประจำตัวบุคลากร</a></li>
<li><a onclick="change_color(7);change_data('retire_data.php','../images/head2/work_data/retire.png');" id="menu7">เกษียณอายุ</a>
<li><a onclick="change_color(8);change_data('ex_contract.php','../images/head2/bio/ex_contract.png');" id="menu8">ต่อสัญญา</a>
</ul>
<div style="height:1px"></div>
<div class="headerbar">ทะเบียนประวัติ</div >
<ul class="submenu">
<li><a onclick="change_color(9);change_data('bio_data.php','../images/head2/bio/biodata.png');" id="menu9" >ข้อมูลเบื้องต้น</a></li>
<li><a onclick="change_color(10);change_data('cen_address.php','../images/head2/bio/cen_address.png');" id="menu10">ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน</a></li> 
<li><a onclick="change_color(11);change_data('family_data.php','../images/head2/bio/family.png');" id="menu11">ข้อมูลบิดา มารดา คู่สมรส</a></li>
<li><a onclick="change_color(12);change_data('children_data.php','../images/head2/bio/children.png');" id="menu12">ข้อมูลบุตร</a></li>

</ul>
<div style="height:1px"></div>
<div class="headerbar">ข้อมูลบุคคล</div>
<ul class="submenu">
<li><a onclick="change_color(13);change_data('education.php','../images/head2/work_data/education.png');" id="menu13">ประวัติการศึกษา</a></li>
<!--<li><a onclick="change_color(14);change_data('certification.php','../images/head2/work_data/certification.png');" id="menu14" >ใบรับรอง</a></li>-->
<li><a onclick="change_color(15);change_data('scholar.php','../images/head2/work_data/scholar.png');" id="menu15">ข้อมูลศึกษาต่อ</a></li>
<li><a onclick="change_color(16);change_data('research_creative.php','../images/head2/work_data/research.png');"  id="menu16">การขอทุนวิจัย</a></li>
<li><a onclick="change_color(17);change_data('royal.php','../images/head2/work_data/royal.png');" id="menu17" >เครื่องราชอิสริยาภรณ์</a></li>
<li><a onclick="change_color(18);change_data('honor.php','../images/head2/work_data/honor.png');" id="menu18" >ประกาศเกียรติคุณ</a></li>
<li><a onclick="change_color(19);change_data('expert.php','../images/head2/work_data/expert.png');"  id="menu19">ความเชี่ยวชาญ</a></li>
<li><a onclick="change_color(20);change_data('guarantee_data.php','../images/head2/work_data2/guarantee.png');"  id="menu20">ผู้ค้ำประกัน</a></li>  
<li><a onclick="change_color(21);change_data('welfare.php','../images/head2/work_data2/welfare.png');"  id="menu21">สวัสดิการและสิทธิประโยชน์</a></li>  
<li><a onclick="change_color(22);change_data('warn_punish.php','../images/head2/work_data2/warn.png');"  id="menu22">การตักเตือน ลงโทษ</a></li>
</ul>
<div style="height:1px"></div>
<div class="headerbar">ข้อมูลการทำงาน</div>
<ul class="submenu">
<li><a onclick="change_color(23);change_data('work_history.php','../images/head2/work_data/workhistory.png');"  id="menu23">ประวัติการทำงานในอดีต</a></li>
<li><a onclick="change_color(24);change_data('current_work.php','../images/head2/work_data/current_work.png');"  id="menu24">ตำแหน่งงานปัจจุปัน</a></li>
<li><a onclick="change_color(25);change_data('position.php','../images/head2/work_data/vcharkarn_position.png');"  id="menu25">ตำแหน่งทางวิชาการ</a></li>
<!--<li><a onclick="change_color();change_data('','');" >สัญญาการว่าจ้าง</a></li>-->
<!--<li><a onclick="change_color();change_data('retire_data.php','../images/head2/work_data/retire.png');" >เกษียนอายุ</a></li>-->
<li><a onclick="change_color(26);change_data('seminar.php','../images/head2/work_data2/seminar.png');"  id="menu26">การอบรมสัมมนา</a></li>
<li><a onclick="change_color(27);change_data('constructor.php','../images/head2/work_data2/constructor.png');"  id="menu27">การเป็นวิทยากร อาจารย์พิเศษ</a></li>
<li><a onclick="change_color(28);change_data('consult_commit.php','../images/head2/work_data2/consult.png');"  id="menu28">การเป็นที่ปรึกษา</a></li>
<li><a onclick="change_color(29);change_data('committee.php','../images/head2/work_data2/commit.png');"  id="menu29">การเป็นกรรมการภายนอก</a></li>
<li><a onclick="change_color(30);change_data('appraise_data.php','../images/head2/work_data2/appraise.png');"  id="menu30">การประเมินการทำงาน</a></li>
<li><a onclick="change_color(31);change_data('contract_history.php','../images/head2/work_data2/contract_history.png');"  id="menu31">ประวัติข้อมูลการต่อสัญญา</a></li>
</ul>
<div style="height:1px"></div>
<div class="headerbar">รายงาน</div>
<ul class="submenu">
<li><a onclick="change_color(32);change_data('summary_report.php','../images/head2/report/summary.png');"  id="menu32">สรุปยอดรวมบุคลากร</a></li>
<li><a onclick="change_color(33);change_data('scholar_report.php','../images/head2/report/scholar_report.png');"  id="menu33">ศึกษาต่อ/สำเร็จการศึกษา</a></li>
<li><a onclick="change_color(34);change_data('dev_report.php','../images/head2/report/dev_report.png');"  id="menu34">การพัฒนาบุคคลากร</a></li>
<li><a onclick="change_color(35);change_data('quit_report.php','../images/head2/report/quit_report.png');"  id="menu35">ลาออก</a></li>
<li><a onclick="change_color(36);change_data('new_report.php','../images/head2/report/new_report.png');"  id="menu36">บุคลากรเข้าใหม่</a></li>
<li><a onclick="change_color(37);change_data('salary_report.php','../images/head2/report/salary_report.png');"  id="menu37">เงินเดือน</a></li>
<li><a onclick="change_color(38);change_data('retire_report.php','../images/head2/report/retire.png');"  id="menu38">เกษียณอายุราชการ</a></li>
<li><a onclick="change_color(39);change_data('royal_report.php','../images/head2/report/royal_data.png');"  id="menu39">เครื่องราชอิสริยาภรณ์</a></li>
<!--<li><a onclick="change_data('','');" id="menu35">จ่ายค่าตอบแทนรายเดือน</a></li>-->
<!--<li><a onclick="change_data('','');" >การเบิกจ่ายเงินเพื่อการอบรม</a></li>
<li><a onclick="change_data('','');" >การเบิกจ่ายเงินสวัสดิการ</a></li>
<li><a onclick="change_data('','');" >บันทึกเวลาการมาทำงาน</a></li>-->
<li><a onclick="change_color(40);change_data('quality_report.php','../images/head2/report/quality.png');"  id="menu14" >งานประกันคุณภาพ</a></li>
</ul>

<?
		 }else if($_SESSION["USER_TYPE"] == "cheif" ){
?>
<div  class="headerbar">ผู้ดูแลระบบ</div>
<ul class="submenu" >
<li style="display:none"><a onclick="change_color(1);change_data('new_person.php','../images/head2/bio/new_person.png');"  id="menu1" >เพิ่มประวัติบุคลากร</a></li>
<li><a onclick="change_color(2);change_data('register.php','../images/head2/bio/new_user.png');" id="menu2">เพิ่มผู้ใช้งาน</a></li>
<li><a onclick="change_color(3);change_data('search.php','../images/head2/bio/search.png');" id="menu3">ระบบค้นหา</a></li>
<li><a onclick="change_color(4);change_data('salary_step.php','../images/head2/work_data/salary.png');" id="menu4">เงินเดือน</a></li>
<li><a onclick="change_color(5);change_data('job_announcement.php','../images/head2/work_data2/job_announcement.png');" id="menu5">ประกาศรับสมัครบุคลากร</a></li>
<li><a onclick="change_color(6);change_data('temp_card.php','../images/head2/work_data2/temp_card.png');" id="menu6">ออกบัตรประจำตัวบุคลากร</a></li>
<li><a onclick="change_color(7);change_data('retire_data.php','../images/head2/work_data/retire.png');" id="menu7">เกษียนอายุ</a>
<li><a onclick="change_color(8);change_data('ex_contract.php','../images/head2/bio/ex_contract.png');" id="menu8">ต่อสัญญา</a>
</ul>
<div style="height:1px"></div>
<div class="headerbar">ทะเบียนประวัติ</div >
<ul class="submenu">
<li><a onclick="change_color(9);change_data('bio_data.php','../images/head2/bio/biodata.png');" id="menu9" >ข้อมูลเบื้องต้น</a></li>
<li><a onclick="change_color(10);change_data('cen_address.php','../images/head2/bio/cen_address.png');" id="menu10">ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน</a></li> 
<li><a onclick="change_color(11);change_data('family_data.php','../images/head2/bio/family.png');" id="menu11">ข้อมูลบิดา มารดา คู่สมรส</a></li>
<li><a onclick="change_color(12);change_data('children_data.php','../images/head2/bio/children.png');" id="menu12">ข้อมูลบุตร</a></li>

</ul>
<div style="height:1px"></div>
<div class="headerbar">ข้อมูลบุคคล</div>
<ul class="submenu">
<li><a onclick="change_color(13);change_data('education.php','../images/head2/work_data/education.png');" id="menu13">ประวัติการศึกษา</a></li>
<!--<li><a onclick="change_color(14);change_data('certification.php','../images/head2/work_data/certification.png');" id="menu14" >ใบรับรอง</a></li>-->
<li><a onclick="change_color(15);change_data('scholar.php','../images/head2/work_data/scholar.png');" id="menu15">ข้อมูลศึกษาต่อ</a></li>
<li><a onclick="change_color(16);change_data('research_creative.php','../images/head2/work_data/research.png');"  id="menu16">การขอทุนวิจัย</a></li>
<li><a onclick="change_color(17);change_data('royal.php','../images/head2/work_data/royal.png');" id="menu17" >เครื่องราชอิสริยาภรณ์</a></li>
<li><a onclick="change_color(18);change_data('honor.php','../images/head2/work_data/honor.png');" id="menu18" >ประกาศเกียรติคุณ</a></li>
<li><a onclick="change_color(19);change_data('expert.php','../images/head2/work_data/expert.png');"  id="menu19">ความเชี่ยวชาญ</a></li>
<li><a onclick="change_color(20);change_data('guarantee_data.php','../images/head2/work_data2/guarantee.png');"  id="menu20">ผู้ค้ำประกัน</a></li>  
<li><a onclick="change_color(21);change_data('welfare.php','../images/head2/work_data2/welfare.png');"  id="menu21">สวัสดิการและสิทธิประโยชน์</a></li>  
<li><a onclick="change_color(22);change_data('warn_punish.php','../images/head2/work_data2/warn.png');"  id="menu22">การตักเตือน ลงโทษ</a></li>
</ul>
<div style="height:1px"></div>
<div class="headerbar">ข้อมูลการทำงาน</div>
<ul class="submenu">
<li><a onclick="change_color(23);change_data('work_history.php','../images/head2/work_data/workhistory.png');"  id="menu23">ประวัติการทำงานในอดีต</a></li>
<li><a onclick="change_color(24);change_data('current_work.php','../images/head2/work_data/current_work.png');"  id="menu24">ตำแหน่งงานปัจจุปัน</a></li>
<li><a onclick="change_color(25);change_data('position.php','../images/head2/work_data/vcharkarn_position.png');"  id="menu25">ตำแหน่งทางวิชาการ</a></li>
<!--<li><a onclick="change_color();change_data('','');" >สัญญาการว่าจ้าง</a></li>-->
<!--<li><a onclick="change_color();change_data('retire_data.php','../images/head2/work_data/retire.png');" >เกษียนอายุ</a></li>-->
<li><a onclick="change_color(26);change_data('seminar.php','../images/head2/work_data2/seminar.png');"  id="menu26">การอบรมสัมมนา</a></li>
<li><a onclick="change_color(27);change_data('constructor.php','../images/head2/work_data2/constructor.png');"  id="menu27">การเป็นวิทยากร อาจารย์พิเศษ</a></li>
<li><a onclick="change_color(28);change_data('consult_commit.php','../images/head2/work_data2/consult.png');"  id="menu28">การเป็นที่ปรึกษา</a></li>
<li><a onclick="change_color(29);change_data('committee.php','../images/head2/work_data2/commit.png');"  id="menu29">การเป็นกรรมการภายนอก</a></li>
<li><a onclick="change_color(30);change_data('appraise_data.php','../images/head2/work_data2/appraise.png');"  id="menu30">การประเมินการทำงาน</a></li>
<li><a onclick="change_color(31);change_data('contract_history.php','../images/head2/work_data2/contract_history.png');"  id="menu31">ประวัติข้อมูลการต่อสัญญา</a></li>
</ul>
<div style="height:1px"></div>
<div class="headerbar">รายงาน</div>
<ul class="submenu">
<li><a onclick="change_color(32);change_data('summary_report.php','../images/head2/report/summary.png');"  id="menu32">สรุปยอดรวมบุคลากร</a></li>
<li><a onclick="change_color(33);change_data('scholar_report.php','../images/head2/report/scholar_report.png');"  id="menu33">ศึกษาต่อ/สำเร็จการศึกษา</a></li>
<li><a onclick="change_color(34);change_data('dev_report.php','../images/head2/report/dev_report.png');"  id="menu34">การพัฒนาบุคคลากร</a></li>
<li><a onclick="change_color(35);change_data('quit_report.php','../images/head2/report/quit_report.png');"  id="menu35">ลาออก</a></li>
<li><a onclick="change_color(36);change_data('new_report.php','../images/head2/report/new_report.png');"  id="menu36">บุคลากรเข้าใหม่</a></li>
<li><a onclick="change_color(37);change_data('salary_report.php','../images/head2/report/salary_report.png');"  id="menu37">เงินเดือน</a></li>
<li><a onclick="change_color(38);change_data('retire_report.php','../images/head2/report/retire.png');"  id="menu38">เกษียณอายุราชการ</a></li>
<li><a onclick="change_color(39);change_data('royal_report.php','../images/head2/report/royal_data.png');"  id="menu39">เครื่องราชอิสริยาภรณ์</a></li>
<!--<li><a onclick="change_data('','');" id="menu35">จ่ายค่าตอบแทนรายเดือน</a></li>-->
<!--<li><a onclick="change_data('','');" >การเบิกจ่ายเงินเพื่อการอบรม</a></li>
<li><a onclick="change_data('','');" >การเบิกจ่ายเงินสวัสดิการ</a></li>
<li><a onclick="change_data('','');" >บันทึกเวลาการมาทำงาน</a></li>-->
<li><a onclick="change_color(14);change_data('quality_report.php','../images/head2/report/quality.png');"  id="menu14" >งานประกันคุณภาพ</a></li>
</ul>
<?
		 }
?>

</div>