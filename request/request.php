<?
@session_start();
@ini_set('display_errors', '0');
if($_SESSION["FNAME_TH"]!=""){
	$name=$_SESSION["FNAME_TH"]."&nbsp;&nbsp;".$_SESSION["LNAME_TH"];
}
?>
<script>

function post_request(){
	var re_type1 = $("#re_type1").is(':checked');
	var re_type2 = $("#re_type2").is(':checked');
	var re_type;
	var request = $("#request").val();
	var comment = $("#comment").val();
	
	if(re_type1==true){
		re_type=1;
	}
	else if(re_type2==true){
		re_type=2;
	}
	
	if(re_type!="" && request!=""){
		$.post("./../request/request_action.php",{request:request,re_type:re_type,comment:comment,action:"save"},
			function(data){
				if(data==1){
				$('#request1').dialog("open");
					document.getElementById("request2").innerHTML="บันทึกคำร้องของคุณเรียบร้อย";
					$("#request").val("");
					$("#comment").val("");
					$("#t1").val("");
					$("#t2").val("");
				}
				else{
					document.getElementById("request2").innerHTML=data;
				}
		});	
	}
	else{
		alert("กรุณากรอกรายละเอียดที่ต้องการแก้ไข");
	}
	
}

$(function() {
 $('#request1').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'300',
			height: '200',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
				}
			}
		});
		
$('#request3').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'600',
			height: '400',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
				}
			}
		});
		
 });
 
function chk_input(input,text_return){
	var text=$("#"+input).val();
	$("#"+text_return).html("จำนวนตัวอักษรที่พิมพ์ "+text.length+" ตัวอักษร");
}

</script>
<br />
<center>
<div id="request1" title="รายละเอียด"><div id="request2"></div></div>
<div id="request3"></div>
<form>
<table width="650">
	<tr height="20">
    	<td align="center">แจ้งเพื่อแก้ไขข้อมูล  <?=$name?></td>
    </tr>
    <tr height="20">
    	<td align="center">ประเภท <input type="radio" name="t" id="re_type1" value="1" checked="checked"  /> ข้อมูลไม่ทันสมัย &nbsp;&nbsp;<input name="t" type="radio"  id="re_type2" value="2"  /> ข้อมูลผิด</td>
    </tr>
</table>
<br /><br />
<table width="500">
	<tr height="20">
    	<td align="center">รายละเอียดที่ต้องการแก้ไข (200 ตัวอักษร) <samp id="t1" style="color:#FF0000;"></samp></td>
    </tr>
    <tr height="20">
    	<td align="center"><textarea style=" width:300px; height:150px;" id="request" maxlength="200" onkeyup="chk_input('request','t1');"></textarea></td>
    </tr>
    <tr height="20">
    	<td align="center">หมายเหตุ (200 ตัวอักษร) <samp id="t2" style="color:#FF0000;"></samp></td>
    </tr>
    <tr height="20">
    	<td align="center"><textarea style=" width:300px; height:150px;" id="comment" maxlength="200" onkeyup="chk_input('comment','t2');"></textarea></td>
    </tr>
    <tr height="20">
    	<td align="center"><input type="button" value="บันทึก" onclick="post_request();" /> &nbsp; <input type="reset" value="ยกเลิก" /></td>
    </tr>
</table>
</form>
</center>