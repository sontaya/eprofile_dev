<?php
@session_start();
@ini_set('display_errors', '0');
$fpath = '../';
require_once($fpath . "includes/connect.php");
include("request_class.php");

$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
$request=new request();
$request->conn=$conn ;
$data=$request->data_request($arr=array("re_id"=>$_POST["re_id"]));
?>
<script>
function update_type(){
	var re_id=$("#up_re_id").val();
	var ch_type=$("#ch_type").val();
	//alert(re_id);
	$.post("./../request/request_action.php",{re_id:re_id,ch_type:ch_type,action:"update"},
	function(data){
			//alert(">>>"+data);
			if(data==1){
				document.getElementById("request4").innerHTML="แก้ไขสถานะเรียบร้อย";
			}
			else{
				document.getElementById("request4").innerHTML=data;
			}
	});	
}
</script>
<table>
	<tr valign="top">
		<td align="right">รายละเอียด :</td>
        <td><?=$data[0]["RE_REQUEST"]?></td>
    </tr>
    <tr valign="top">
		<td align="right">หมายเหตุ :</td>
        <td><?=$data[0]["RE_COMMENT"]?></td>
    </tr>
    <tr valign="top">
		<td align="right">เปลี่ยนสถานะคำร้อง : </td>
        <td>
        <select id="ch_type">
            <option value="1" <? if($data[0]["RE_STATUS"]=="1"){?> selected="selected" <? } ?>>ปิด</option>
            <option value="2" <? if($data[0]["RE_STATUS"]=="2"){?> selected="selected" <? } ?>>ยกเลิก</option>
        </select>
        <input id="up_re_id" value="<?=$data[0]["RE_ID"]?>" type="hidden"  /> <input type="button" value="บันทึก" onclick="update_type();" />
        </td>
    </tr>
</table>

<div id="request4" style="margin-top:10px; text-align:center; color:#FF0000; text-align:center;">

</div>