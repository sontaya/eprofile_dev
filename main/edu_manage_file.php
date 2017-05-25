<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Upload Management</title>
<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<link rel="stylesheet" type="text/css" href="../jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
<script src="../js/myAjax.js" type="text/javascript"></script>
<script src="../js/main_for_popup.js" type="text/javascript"></script>
<script src="../js/edu_data.js" type="text/javascript"></script>
<script language="javascript">
function Checkfiles2(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup;
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "pdf" || ext == "PDF" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP" || ext == "doc" || ext == "docx"){
		return true;
	} 
	else{
		//alert("ไฟล์อัพโหลดไม่ถูกต้อง");
		//fup.focus();
		return false;
	}
}
return true;
}


function check_data(){
	
		var count = document.getElementsByName("edu_file[]").length;
		var edu_file = document.education.elements["edu_file[]"];
		var i=0;
		//var n=0;
		while(i<count){
			if(edu_file[i].value != ""){
				//n++;
				if(!Checkfiles2(edu_file[i].value)){
					edu_file[i].value = "";
					$("#Valid_upl_file").dialog('open');
					return false;
				}

			}
			i++
		}
		/*if(n==0){
			$("#emp_upl_file").dialog('open');
			return false;
		}*/
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("education").submit();
}

$(function() {
		
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
				$("#morefile").after("<input type='file' name='edu_file[]'  class='file_upload'  /><br />");
			   //var edu_file = document.getElementsByName("edu_file[]").length;				
		 });
 });
</script>
</head>

<body >
<div align="center" >
<?
	$fpath = '';
	require_once($fpath."../includes/connect.php");
	
	function education_ref($id){
		global $conn;
		$sql = "SELECT * FROM  ".TB_EDUCATION_TAB."  WHERE  EDU_ID= '$id'"; 
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		$row = oci_fetch_array($stid, OCI_BOTH);
		return "ไฟล์เอกสาร ".$row["EDU_NAME"];
	}
	
	echo "<h3>".education_ref($_GET["id"])."</h3>";
	//echo "<br />";
	$sql = "SELECT * FROM  ".TB_EDUCATION_FILE_TAB."  WHERE  EDU_ID= ".$_GET["id"]." ORDER BY ID DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$n = 1;
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		echo "<div style=\"height: 30px; \">ไฟล์ที่ $n <a href=\"files/edu_data_file/".$row["EDU_FILE_NAME"]."\" ><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" title=\"ไฟล์ที่ $n \" alt=\"ไฟล์ที่ $n \" align=\"top\" /></a> ".$row["EDU_FILE_NAME"]." <span style=\"cursor:pointer;width:140px\" onclick=\"del_edu_file('".$row["ID"]."','".$row["EDU_FILE_NAME"]."')\"><img src='../images/b_del.png' height='15' border='0' style='cursor:pointer' title='Delete' alt='Delete'></span></div>";
		$n++;
	}
	oci_free_statement($stid);
	$db->closedb($conn);
?>
<table border="0"><tr><td width="231" align="left" style="color:#663; font-size:11px" valign="top">
<form id="education" name="education" enctype="multipart/form-data" method="post" action="edu_manage_file_save.php"  target="upload_target" >
<input type="hidden" id="edu_id" name="edu_id" value="<?=$_GET["id"]?>" />
<input type="file" name="edu_file[]"  class="file_upload"/><br />
<input type="file" name="edu_file[]"  class="file_upload"/><br />
<input type="file" name="edu_file[]"  class="file_upload"/><br />
<span  id="morefile"></span>
<input type="button" id="addfile"  value="เพิ่มไฟล์แนบ" style="height: 23px; "/>
<br />
เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx, .pdf
</form>
</td></tr>
</table>
<table border="0" cellpadding="3">
<tr>
        <td width="174" align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onMouseOver="over_button('pic_save','pic_save2');" onMouseOut="out_button('pic_save','pic_save2')" onClick="check_data();"/>
        </td>
        <td width="239"  align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onClick="window.location.reload();" style="cursor:pointer; display:none" onMouseOver="over_button('pic_cancel','pic_cancel2');" onMouseOut="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left"  valign="top" style="padding-left:100px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
</table>
<br />


<div style="text-align:left; padding:8px;">
- วิธีการเพิ่มไฟล์ คลิ๊กที่ปุ่ม Browse แล้วเลือกไฟล์ที่ต้องการ แล้วคลิกปุ่ม Save กรณีที่อัปโหลดไฟล์มากกว่า 3 ไฟล์ คลิ๊กที่ปุ่ม เพิ่มไฟล์แนบ<br />
- การเรียกใช้งานไฟล์ คลิ๊กที่ <img src="../images/macosx100.png" height="20" border="0" />
</div>


</div>
<iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;border:0px solid #fff;"></iframe> 
<div style="display: none">
<div id="Valid_upl_file" title="File Upload Error !">
	<p>
		ไฟล์เอกสารวุฒิการศึกษา ไม่ถูกต้อง
	</p>
</div>
<div id="emp_upl_file" title="File Upload Error !">
	<p>
		ท่านยังไม่ได้แนบไฟล์
	</p>
</div>
</div>
</body>
</html>