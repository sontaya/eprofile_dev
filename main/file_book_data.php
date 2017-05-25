<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">


var ar_ext = ['pdf','doc','docx','xlsx','xls','jpg'];        // นามสกุลไฟล์

$(function() {
	
			$('#file_up_manu').dialog({
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
  
function checkName(el, to, sbm) {
// - coursesweb.net
  // get the file name and split it to separe the extension
  var name = el.value;
  var ar_name = name.split('.');

  // for IE - separe dir paths (\) from name
  var ar_nm = ar_name[0].split('\\');
  for(var i=0; i<ar_nm.length; i++) var nm = ar_nm[i];

  // add the name in 'to'
  document.getElementById(to).value = nm;

  // check the file extension
  var re = 0;
  for(var i=0; i<ar_ext.length; i++) {
    if(ar_ext[i] == ar_name[1]) {
      re = 1;
      break;
    }
  }

  // if re is 1, the extension is in the allowed list
  if(re==1) {
    // enable submit
    document.getElementById(sbm).disabled = false;
  }
  else {
    // delete the file name, disable Submit, Alert message
    el.value = '';
    //document.getElementById(sbm).disabled = true;
	$("#file_up_manu").dialog('open');
      return false;
    //alert('".'+ ar_name[1]+ '" ไฟล์ไม่ถูกต้อง เเนบได้เฉพราะไฟล์ .pdf .doc .xls .xlsx .jpg ');
  }
}

function check_data_file(){
	
		if($('#mame_manu').val()==""){
		 $("#Please_fill_in").dialog('open');
				return false;
		 }
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("file_manu").submit();
}

$(function() {
		   
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
    <div id="file_list" align="center" class="data_details_list">
      <? include "file_upmanu_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('file_manu','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form" style="display:none;"> 
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="file_manu" name="file_manu" method="post" action="file_manu_save.php" enctype="multipart/form-data" target="upload_target">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
         <input type="hidden" id="file_id" name="file_id" value=""/></td>
          <input type="hidden" id="fi_id" name="fi_id" value=""/>
        <!--<td width="182" align="right" class="form_text">ชื่อเมนู :</td>
        <td width="548" align="left">
        <select name="mame_manu" id="mame_manu" style="width:300px">
            <option value="">-------------------------- เลือกชื่อเมนู ------------------------</option>
            <option value=""><h2>1.&nbsp;ผู้ดูเเลระบบ</h2></option>
            <option value="เพิ่มประวัติบุคลากร">&nbsp;&nbsp;&nbsp;1.1 &nbsp;เพิ่มประวัติบุคลากร</option>
            <option value="เพิ่มผู้ใช้งาน">&nbsp;&nbsp;&nbsp;1.2 &nbsp;เพิ่มผู้ใช้งาน</option>
            <option value="ระบบค้นหา">&nbsp;&nbsp;&nbsp;1.3 &nbsp;ระบบค้นหา</option>
            <option value="เงินเดือน">&nbsp;&nbsp;&nbsp;1.4 &nbsp;เงินเดือน</option>
            <option value="ประกาศรับสมัครบุคลากร">&nbsp;&nbsp;&nbsp;1.5 &nbsp;ประกาศรับสมัครบุคลากร</option>
            <option value="ออกบัตรประจำตัวบุคลากร">&nbsp;&nbsp;&nbsp;1.6 &nbsp;ออกบัตรประจำตัวบุคลากร</option>
            <option value="เกษียณอายุ">&nbsp;&nbsp;&nbsp;1.7 &nbsp;เกษียณอายุ</option>
            <option value="ต่อสัญญา">&nbsp;&nbsp;&nbsp;1.8 &nbsp;ต่อสัญญา</option>
            <option value="จัดการข้อมูลตารางมาตรฐาน">&nbsp;&nbsp;&nbsp;1.9 &nbsp;จัดการข้อมูลตารางมาตรฐาน</option>
            <option value="เปลี่ยนหมายเลขบุคลากร">&nbsp;&nbsp;&nbsp;1.10 &nbsp;เปลี่ยนหมายเลขบุคลากร</option>
            <option value="สร้างไฟล์ ส่ง  สกอ.">&nbsp;&nbsp;&nbsp;1.11 &nbsp;สร้างไฟล์ ส่ง  สกอ.</option>
            <option value="">2.&nbsp;ทะเบียนประวัติ</option>
            <option value="ข้อมูลเบื้องต้น">&nbsp;&nbsp;&nbsp;2.1 &nbsp;ข้อมูลเบื้องต้น</option>
            <option value="ที่อยู่ตามทะเบียนบ้าน,ปัจุบัน">&nbsp;&nbsp;&nbsp;2.2 &nbsp;ที่อยู่ตามทะเบียนบ้าน,ปัจุบัน</option>
            <option value="ข้อมูลบิดา,มารดา,คู่สมรส">&nbsp;&nbsp;&nbsp;2.3 &nbsp;ข้อมูลบิดา,มารดา,คู่สมรส</option>
            <option value="ข้อมูลบุตร">&nbsp;&nbsp;&nbsp;2.4 &nbsp;ข้อมูลบุตร</option>
            <option value="ไฟล์เอกสารที่เกียวข้อง">&nbsp;&nbsp;&nbsp;2.5 &nbsp;ไฟล์เอกสารที่เกียวข้อง</option>
            <option value="">3.&nbsp;ข้อมูลบุคคล</option>
            <option value="ประวัติการศึกษา">&nbsp;&nbsp;&nbsp;3.1 &nbsp;ประวัติการศึกษา</option>
            <option value="ข้อมูลการศึกษาต่อ">&nbsp;&nbsp;&nbsp;3.2 &nbsp;ข้อมูลการศึกษาต่อ</option>
            
            <option value="ข้อมูลการศึกษาต่อ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.1 &nbsp;ข้อมูลการศึกษาต่อ</option>
            <option value="เเนบไฟล์ผลการเรียน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.2 &nbsp;เเนบไฟล์ผลการเรียน</option>
            <option value="คำนวนใช้ทุน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.3 &nbsp;คำนวนใช้ทุน</option>
            <option value="ข้อมูลทุน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.4 &nbsp;ข้อมูลทุน</option>
            <option value="เบิกจ่ายทุน">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.5 &nbsp;เบิกจ่ายทุน</option>
            <option value="ลาทำวิทยานิพนธ์/วิจัย">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2.6 &nbsp;ลาทำวิทยานิพนธ์/วิจัย</option>
            
            <option value="การขอทุนวิจัย">&nbsp;&nbsp;&nbsp;3.3 &nbsp;การขอทุนวิจัย</option>
            <option value="เครื่องราชอิสริยาภรณ์">&nbsp;&nbsp;&nbsp;3.4 &nbsp;เครื่องราชอิสริยาภรณ์</option>
            <option value="ประกาศเกียรติคุณ">&nbsp;&nbsp;&nbsp;3.5 &nbsp;ประกาศเกียรติคุณ</option>
            <option value="ความเชี่ยวชาญ">&nbsp;&nbsp;&nbsp;3.6 &nbsp;ความเชี่ยวชาญ</option>
            <option value="ผู้ค้ำประกัน">&nbsp;&nbsp;&nbsp;3.7 &nbsp;ผู้ค้ำประกัน</option>
            <option value="สวัสดิการและสิทธิประโยชน์">&nbsp;&nbsp;&nbsp;3.8 &nbsp;สวัสดิการและสิทธิประโยชน์</option>
            <option value="การตักเตือน ลงโทษ">&nbsp;&nbsp;&nbsp;3.9 &nbsp;การตักเตือน ลงโทษ</option>
            <option value="">4.&nbsp;ข้อมูลการทำงาน</option>
            <option value="ประวัติการทำงานในอดีต">&nbsp;&nbsp;&nbsp;4.1 &nbsp;ประวัติการทำงานในอดีต</option>
            <option value="ตำแหน่งงานปัจจุปัน">&nbsp;&nbsp;&nbsp;4.2 &nbsp;ตำแหน่งงานปัจจุปัน</option>
            <option value="ตำแหน่งทางวิชาการ">&nbsp;&nbsp;&nbsp;4.3 &nbsp;ตำแหน่งทางวิชาการ</option>
            <option value="ตำแหน่งสายสนับสนุน">&nbsp;&nbsp;&nbsp;4.4 &nbsp;ตำแหน่งสายสนับสนุน</option>
            <option value="การอบรมสัมมนา">&nbsp;&nbsp;&nbsp;4.5 &nbsp;การอบรมสัมมนา</option>
            <option value="การเป็นวิทยากร อาจารย์พิเศษ">&nbsp;&nbsp;&nbsp;4.6 &nbsp;การเป็นวิทยากร อาจารย์พิเศษ</option>
            <option value="การเป็นที่ปรึกษา">&nbsp;&nbsp;&nbsp;4.7 &nbsp;การเป็นที่ปรึกษา</option>
            <option value="การเป็นกรรมการภายนอก">&nbsp;&nbsp;&nbsp;4.8 &nbsp;การเป็นกรรมการภายนอก</option>
            <option value="การประเมินการทำงาน">&nbsp;&nbsp;&nbsp;4.9 &nbsp;การประเมินการทำงาน</option>
            <option value="ประวัติข้อมูลการต่อสัญญา">&nbsp;&nbsp;&nbsp;4.10 &nbsp;ประวัติข้อมูลการต่อสัญญา</option>
         </select></td>
    </tr> -->
    <tr>
        <td width="182" align="right" class="form_text">ชื่อไฟล์ :</td>
        <td width="548" align="left"><input type="text" name="fi_name" id="fi_name" style="width:300px"> </td>
    </tr>
    <tr>
        <td width="182" align="right" class="form_text">เเนบไฟล์ :</td>
        <td width="548" align="left"><input type="file" name="fup" onchange="checkName(this, 'fname', 'submit')" style="width:300px;"/>เฉพาะ &nbsp;.pdf &nbsp;.doc &nbsp;.docx &nbsp;.xls &nbsp;.xlsx &nbsp;.jpg</td>
    </tr>
	<input type="hidden" name="fi_d" id="fi_d">
      <?php if( $_SESSION['USER_TYPE'] != 'chief') { ?>
      <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data_file();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('file_book_data.php','../images/head2/work_data/honor.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
        </td>
      </tr>
      <?php } ?>
             <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
      
    </table>
    </form>

    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>
</div>
    
  </td>
  </tr>  
</table>
<div style="display: none">
    <div id="file_up_manu" title="File Upload Error !">
        <p>
            ไฟล์ไม่ถูกต้อง เเนบได้เฉพราะไฟล์ .pdf .doc .docx .xls .xlsx .jpg 
        </p>
    </div>
</div>