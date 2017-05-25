<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>

<? }

?>
<script language="javascript">
function change_retire(year,type){
	$("div#retire_data").html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	var data = "year="+year+"&type="+type;
	ajaxPostData("retire_report_res2.php",data,"text","",result_retire_res,"","");
	
}

function result_retire_res(response){
		$("div#retire_data").html(response);
}

function retire_now(emp_id){
	var conf = window.confirm("ยืนยันที่จะเกษียนอายุราชการ");
	//alert(emp_id);	
	if(conf){
		$("div#retire_data").html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
		var data = "EMP_ID="+emp_id;
		ajaxPostData("retire_now.php",data,"text","",result_retire_now,"","");
	}else{
		return false;	
	}
}

function result_retire_now(response){
	//alert(response);
		change_retire(document.getElementById('year').value,document.getElementById('type').value);
}

function new_gov(emp_id){
	var pr = window.prompt('กรอกวันที่หมดอายุราชการใหม่ \n ex. 01/12/2553');
	if(pr){
		if(pr != ""){
			$("div#retire_data").html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
			var data = "EMP_ID="+emp_id+"&date="+pr;
			ajaxPostData("new_gov.php",data,"text","",result_retire_now,"","");
		}
	}else{
		return false;	
	}
}

</script>
<?
$fpath = '../';
require_once($fpath."includes/connect.php");

?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<div align="center">
<h3>เกษียณอายุราชการ ประจำปี : 
<select id="year" name="year"  style="width:65px;">
<?
$year = ((date("Y") + 543)-6);
for($i=0;$i<11;$i++){
	$year = $year + 1;
	if($year == (date("Y") + 543)) $select = "selected='selected'"; else $select = "";
echo "<option value='$year' $select>$year</option>\n";
}
?>
</select> 
&nbsp;&nbsp; ประเภท 
<select id="type" name="type"  >
<?
$sql = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID = '1' OR STAFFTYPE_ID = '2' OR STAFFTYPE_ID = '3' ORDER BY STAFFTYPE_ID ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n1 = 0;
$check = "";
while($row = oci_fetch_array($stid, OCI_BOTH)){
echo "<option value='".$row['STAFFTYPE_ID']."' >".$row['STAFFTYPE_NAME']."</option>\n";
}
?>
</select> 
<input type="button" value="แสดง" onclick="change_retire(document.getElementById('year').value,document.getElementById('type').value);"/>
</h3>
</div>
<div  align="center" id="retire_data">

</div>

<? $db->closedb($conn);	?>