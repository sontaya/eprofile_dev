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
?>
<script>
function search_time(){
	var data = "emp_id="+ <?=$_SESSION["EMP_ID"]?> +"&month="+document.getElementById('month').value +"&year="+document.getElementById('year').value+"&show="+document.getElementById('show').value;
	ajaxPostData("show_time.php",data,"text","",result_time,"","");
}
function result_time(response){
	if(response == "0"){
		document.getElementById("show_data").innerHTML = "<div style='color:red;'><h2>- ไม่มีข้อมูล -</h2></div>";
	}else{
		document.getElementById("show_data").innerHTML = response;
	}
}
</script>
<div style="margin-left:20px; width:730px;">
	<div>
    	<h2 style="text-align:center;">รายงานการลงเวลาปฏิบัติงานรายเดือน</h2>
    	<p style="text-align:center;">ประจำเดือน  <select id="month" name="month" class="form-ListWhite">
        <option value="01">มกราคม</option>
        <option value="02">กุมภาพันธ์</option>
        <option value="03">มีนาคม</option>
        <option value="04">เมษายน</option>
        <option value="05">พฤษภาคม</option>
        <option value="06">มิถุนายน</option>
        <option value="07">กรกฏาคม</option>
        <option value="08">สิงหาคม</option>
        <option value="09">กันยายน</option>
        <option value="10">ตุลาคม</option>
        <option value="11">พฤศจิกายน</option>
        <option value="12">ธันวาคม</option>
      </select>
      ปี </span> 
      <select id="year" name="year" class="form-ListWhite">
	<?
	$day_year=date("Y")+543;
	$year_start=$day_year-5;
	for($i=0;$i<10;$i++){
		$year_start=$year_start+1;
		echo "<option value='".$year_start."'>".$year_start."</option>";
	}
	?>
      </select>
      <span class="MSSansSerif_10"> รายละเอียด</span> 
      <select name="show" class="form-ListWhite" id="show">
        <option value="1">แสดง</option>
        <option value="0">ไม่แสดง</option>
      </select>
      <input type="button" value="แสดง" onclick="search_time()"></p>
  <?
	if ((!$month) or (!$year)){
		$month = date("m");
		$year = date("Y")+543;
	}

$show+=0;	
?>
  <script language=javascript>
	document.getElementById('month').value="<?echo $month;?>";
	document.getElementById('year').value="<?echo $year;?>";
	document.getElementById('show').value="<?echo $show;?>";
	$(function() {
    	search_time();
	});
</script>
		</p>
	</div>
</div>
<div id="show_data"></div>
