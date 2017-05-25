<?
@session_start();
//print_r($_SESSION);
//$_SESSION['USER_TYPE']="admin";
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
  <?
}

$fpath = '../';
require_once($fpath . "includes/connect.php");
$sql = "SELECT
	SBT.EMP_ID,
	SBT.BIO_PIC_FILE,
    SBT.BIO_TITLE_TH,
    SBT.BIO_FNAME_TH,
    SBT.BIO_LNAME_TH,
    SPOS.POSITION,
    SRD.NAME_FACULTY,
    SBT.BIO_BIRTHDAY,
    SRN.NATION_NAME_TH as NATION1,
    SRN2.NATION_NAME_TH as NATION2,
    SRR.RELIGION_NAME_TH,
    SBT.PERSON_ID,
    SCAT.*,
    SBT.BIO_H_PHONE,
    SBT.BIO_MOBILE_1,
    SRT.CODE_REF_TUMBON,
    SRT.NAME_REF_TUMBON,
    SRA.CODE_REF_AMPHUR,
    SRA.NAME_REF_AMPHUR,
    SRP.CODE_REF_PROVINCE,
    SRP.NAME_REF_PROVINCE
FROM 
    SDU_BIODATA_TAB SBT, 
    SDU_CURRENT_WORK_TAB SCWT, 
    SDU_REF_DEPARTMENT SRD, 
    SDU_POSITION spos,
    SDU_REF_NATION srn,
    SDU_REF_NATION srn2,
    SDU_REF_RELIGION srr,
    SDU_CURRENT_ADDRESS_TAB scat,
    SDU_REF_TUMBON srt,
    SDU_REF_AMPHUR sra,
    SDU_REF_PROVINCE srp
WHERE 
    SBT.EMP_ID = '" . $_SESSION["EMP_ID"] . "' AND 
    SBT.EMP_ID = SCWT.EMP_ID AND 
    SCWT.CWK_MUA_MAIN = SRD.CODE_FACULTY AND 
    SCWT.CWK_DSU_POS = SPOS.CODE AND
    SBT.BIO_NATION1 = SRN.NATION_ID AND
    SBT.BIO_NATION2 = SRN2.NATION_ID AND
    SBT.BIO_RELIGION = SRR.RELIGION_ID AND
    SBT.EMP_ID = SCAT.EMP_ID AND
    SCAT.CU_TUMBON = SRT.CODE_REF_TUMBON AND
    SCAT.CU_AMPHUR = SRA.CODE_REF_AMPHUR AND
    SCAT.CU_PROVINCE = SRP.CODE_REF_PROVINCE";
//echo $sql;
$row = $db->fetch($sql, $conn);
?>
<script language="javascript">
function check_value(){
	if(!document.getElementById('BIO_ID_FORM').value){
		document.getElementById('BIO_ID_FORM').focus();
		return false;
	}
	if(!document.getElementById('BIO_ID_DATE_BEGIN').value){
		document.getElementById('BIO_ID_DATE_BEGIN').focus();
		return false;
	}
	if(!document.getElementById('BIO_ID_DATE_EXP').value){
		document.getElementById('BIO_ID_DATE_EXP').focus();
		return false;
	}
	if(!document.getElementById('file_person_id').value){
		document.getElementById('file_person_id').focus();
		return false;
	}
	if(!document.getElementById('file_person_sdu').value){
		document.getElementById('file_person_sdu').focus();
		return false;
	}
	return true;
}
</script>
<script>
function pick_location1(id){
	document.getElementById('CODE_REF_TUMBON').value = document.getElementById('t'+id).value;
	document.getElementById('NAME_REF_TUMBON').value = document.getElementById('n1'+id).value;
	document.getElementById('CODE_REF_AMPHUR').value = document.getElementById('a'+id).value;
	document.getElementById('NAME_REF_AMPHUR').value = document.getElementById('n2'+id).value;
	document.getElementById('CODE_REF_PROVINCE').value = document.getElementById('p'+id).value;
	document.getElementById('NAME_REF_PROVINCE').value = document.getElementById('n3'+id).value;
	$("#search_location1").val("");
	$("div#result_search_address1").html("");
	$("#dialog_address1").dialog('close');
}

function search_tumbon1(txt){
	//alert(txt);
	var data = "";
      
	data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
	ajaxPostData("_find_location1.php",data,"text","result_search_address1",result_search_tumbon1,"","");
      }
}

function result_search_tumbon1(response){
	if(response == "0"){
		$('#result_search_address1').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
	}else{
		$('#result_search_address1').html(response);
	}
}

$(function() {

		  	
		$('#dialog_address1').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'500',
			height: '300',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
					$("#search_location1").val("");
					$("div#result_search_address1").html("");
				}
			}
		});
		
		$( "#opener1" ).click(function() {
			$( "#dialog_address1" ).dialog( "open" );
			return false;
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
		
		$('#Error_upload').dialog({
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
<div style="display:none">

<div id="dialog_address1" title="ระบบค้นหาที่อยู่">
	<p align="center">
    กรอกตำบล : <input type="text" id="search_location1" name="search_location1" class="input_text" style="width:120px"  /> <input type="button" value="ค้นหา" onclick="search_tumbon1($('#search_location1').val())"/>
    </p>
    <div id="result_search_address1" align="center"></div>
</div>

</div>
<div style="margin-left:20px; width:730px;">
	<div>
    	<h2 style="text-align:center;">ข้อแนะนำในการสมัคร</h2>
    	<p>1. ใบสมัคร ให้ผู้สมัครติดรูปถ่ายหน้าตรง ไม่สวมหมวก ไม่สวมแว่นตาดำ ขนาด 1 นิ้ว จำนวน 3 รูป (ถ่ายไว้ไม่เกิน 6 เดือน) กรอกข้อความลงในใบสมัครให้ถูกต้องครบถ้วนพร้อมแนบเอกสารหลักฐานที่ใช้ในการสมัคร และนำมายื่นด้วยตนเองที่ กองบริหารงานบุคคล อาคารสำนักงานมหาวิทยาลัย ชั้น 3 ตั้งแต่วันที่เปิดรับสมัครเป็นต้นไป</p>
    	<p>2. การสมัครตามประกาศจะสมบูรณ์ เมื่อผู้สมัครนำใบสมัครพร้อมหลักฐานมายื่นตรวจเอกสารการสมัครที่กองบริหารงานบุคคล เพื่อให้เจ้าหน้าที่กองฯ ออกเลขบัตรประจำตัวผู้สมัครเข้ารับการสอบ และนำใบสมัครไปชำระเงินค่าธรรมเนียม คนละ 500 บาท ที่กองคลัง อาคาร 2 ชั้น 1 ได้ตั้งแต่วันที่ประกาศรับสมัครเป็นต้นไป ภายในเวลา 08.30 - 16.30 น. ไม่เว้นวันหยุดราชการและวันหยุดนักขัตฤกษ์ (โปรดแต่งกายสุภาพ)</p>
    </div>
<form action="regis_form_save.php" enctype="multipart/form-data" onSubmit="return check_value()" target="_blank" method="post" >
	<div>
		<h2>แบบฟอร์มสมัคร (สอบเปลี่ยนสถานภาพเป็นพนักงานมหาวิทยาลัย)</h2>
    </div>
    <hr/>
    <div>
    	<div><img src="files/bio_data_file/<?=$row["BIO_PIC_FILE"]?>" width="95" style="float:right;"></div>
    	<p><strong>1. ประวัติส่วนตัว</strong></p>
    	<p>ชื่อ (<? if($row["BIO_TITLE_TH"]=='นาย') { echo "<strong>นาย</strong>"; }else{ echo "นาย"; } ?>/<? if($row["BIO_TITLE_TH"]=='นาง') { echo "<strong>นาง</strong>"; }else{ echo "นาง"; } ?>/<? if($row["BIO_TITLE_TH"]=='นางสาว') { echo "<strong>นางสาว</strong>"; }else{ echo "นางสาว"; } ?>) <input type="text" value="<?=$row["BIO_FNAME_TH"]?>" readonly /> นามสกุล <input type="text" value="<?=$row["BIO_LNAME_TH"]?>" readonly /></p>
    	<p>ตำแหน่ง <input type="text" value="<?=$row["POSITION"]?>" readonly /></p>
    	<p>สังกัด <input type="text" value="<?=$row["NAME_FACULTY"]?>" readonly /></p>
    	<p>เกิดวันที่ <input type="text" value="<?=substr($row["BIO_BIRTHDAY"],-2,2)?>" size="2" readonly /> เดือน <input type="text" value="<? switch(substr($row["BIO_BIRTHDAY"],5,2)){ case '01': echo "มกราคม"; break; case '02': echo "กุมภาพันธ์"; break; case '03': echo "มีนาคม"; break; case '04': echo "เมษายน"; break; case '05': echo "พฤษภาคม"; break; case '06': echo "มิถุนายน"; break; case '07': echo "กรกฎาคม"; break; case '08': echo "สิงหาคม"; break; case '09': echo "กันยายน"; break; case '10': echo "ตุลาคม"; break; case '11': echo "พฤศจิกายน"; break; case '12': echo "ธันวาคม"; break; }?>" size="10" readonly /> พ.ศ. <input type="text" value="<?=substr($row["BIO_BIRTHDAY"],0,4)+543?>" size="4" readonly /></p>
    	<p>อายุถึงวันสมัคร <input type="text" value="<?=floor(abs(strtotime(date("Y-m-d"))-strtotime($row["BIO_BIRTHDAY"]))/ (365*60*60*24))?>" readonly size="2" /> ปี <input type="text" value="<?=floor(((abs(strtotime(date("Y-m-d"))-strtotime($row["BIO_BIRTHDAY"]))) - (floor(abs(strtotime(date("Y-m-d"))-strtotime($row["BIO_BIRTHDAY"]))/ (365*60*60*24))) * 365*60*60*24) / (30*60*60*24))?>" readonly size="2" /> เดือน สัญชาติ <input type="text" value="<?=$row["NATION1"]?>" readonly /></p>
    	<p>เชื้อชาติ <input type="text" value="<?=$row["NATION2"]?>" readonly /> ศาสนา <input type="text" value="<?=$row["RELIGION_NAME_TH"]?>" readonly /></p>
    	<p>เลขที่บัตรประจำตัวประชาชน / Passport <input type="text" value="<?=$row["PERSON_ID"]?>" readonly /> ออกให้ ณ สำนักงาน <input type="text" name="BIO_ID_FORM" id="BIO_ID_FORM" /></p>
    	<p>วันออกบัตร <input type="text" name="BIO_ID_DATE_BEGIN" id="BIO_ID_DATE_BEGIN" readonly /> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('BIO_ID_DATE_BEGIN','YYYY-MM-DD')"  style="cursor:pointer"/> วันหมดอายุ <input type="text" name="BIO_ID_DATE_EXP" id="BIO_ID_DATE_EXP" readonly /> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('BIO_ID_DATE_EXP','YYYY-MM-DD')"  style="cursor:pointer"/></p>
    	<p>ที่อยู่ปัจจุบัน</p>
    	<p>เลขที่ <input type="text" value="<?=$row["CU_HOUSE_NO"]?>" /> ซอย <input type="text" value="<?=$row["CU_SOI"]?>" /> ถนน <input type="text" value="<?=$row["CU_ROAD"]?>" /></p>
        <p>ตำบล/แขวง <input type="hidden" name="CODE_REF_TUMBON" id="CODE_REF_TUMBON" value="<?=$row["CODE_REF_TUMBON"]?>" /><input type="text" value="<?=$row["NAME_REF_TUMBON"]?>" name="NAME_REF_TUMBON" id="NAME_REF_TUMBON" /> อำเภอ/เขต <input type="hidden" name="CODE_REF_AMPHUR" id="CODE_REF_AMPHUR" value="<?=$row["CODE_REF_AMPHUR"]?>" /><input type="text" name="NAME_REF_AMPHUR" id="NAME_REF_AMPHUR" value="<?=$row["NAME_REF_AMPHUR"]?>" /> จังหวัด <input type="hidden" name="CODE_REF_PROVINCE" id="CODE_REF_PROVINCE" value="<?=$row["CODE_REF_PROVINCE"]?>" /><input type="text" name="NAME_REF_PROVINCE" id="NAME_REF_PROVINCE" value="<?=$row["NAME_REF_PROVINCE"]?>" /><img src="../images/search_icon.gif" width="25" border="0"   style="cursor:pointer; " id="opener1"  title="ค้นหา" /> </p>
        <p>รหัสไปรษณีย์ <input type="text" value="<?=$row["CU_POST_CODE"]?>" /> โทรศัพท์ <input type="text" value="<?=$row["BIO_H_PHONE"]?>" /> โทรศัพท์มือถือ <input type="text" value="<?=$row["BIO_MOBILE_1"]?>" /></p>
        <p>สำเนาบัตรประจำตัวบุคลากร <input type="file" name="file_person_id" id="file_person_id" /></p>
        <p>สำเนาบัตรประจำตัวประชาชน <input type="file" name="file_person_sdu" id="file_person_sdu" /></p>
        <p>สำเนาเอกสารการเปลี่ยนคำนำหน้าชื่อ หรือเปลี่ยนชื่อ หรือเปลี่ยนนามสกุล <input type="file" name="file_change_name" id="file_change_name" /></p>
        <p>ข้าพเจ้าขอรับรองว่า ข้อความที่ข้าพเจ้าเขียนข้างต้นนั้นรวมทั้งเอกสารหลักฐานที่แนบถุกต้องและเป็นความจริงทุกประการ</p>
        <p align="center"><input type="submit" value="ตกลง"><input type="hidden" value="<?=$row["EMP_ID"]?>" /></p>
    </div>
</form>
</div>