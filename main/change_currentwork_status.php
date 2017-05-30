<?

      
 // Hide for user and chief
 //if($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') {}


@session_start();
$emp_id = $_SESSION["EMP_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");


?>


<table width="90%" align="center" class="table table-bordered table-hover table-striped text-center" >
   <thead>
    	<tr align="center"  class="text_th">
			<td class="text_tr">ลำดับ</td>
			<td class="text_tr">ประเภทบุคลากร</td>
			<td class="text_tr">หน่วยงานหลัก</td>
			<td class="text_tr">วันที่เข้าทำงาน</td>
			<td class="text_tr">สถานะ</td>
			<td class="text_tr">มีผลตั้งเเต่</td>
			<td class="text_tr">ไฟล์เอกสาร</td>
			<td class="text_tr">เเก้ไข/เเสดง/ลบ</td>
    	</tr>
	</thead> 
   <tbody>
      	<tr align="center"  class="text_th">
			<td >ลำดับ</td>
			<td >ประเภทบุคลากร</td>
			<td >หน่วยงานหลัก</td>
			<td >วันที่เข้าทำงาน</td>
			<td >สถานะ</td>
			<td >มีผลตั้งเเต่</td>
			<td >ไฟล์เอกสาร</td>
			<td ></td>
    	</tr> 	
   </tbody>   

    
    </table>
    <hr>   
        <?

		$sql = "SELECT * FROM  ".TB_SDU_CHANGE_JOB_TAB." WHERE EMP_ID='".$emp_id."' ORDER BY CJ_ID DESC";
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		$id = 1;
		$cj=0;

		while (($row = oci_fetch_array($stid, OCI_BOTH))) { 
			$cj++;
			//$no = $row["SCH_ORDER_NO"];
			$id++;
		}
	?>
     

   
    <?
		oci_free_statement($stid);
 	 ?>

<div id="submit-result-box"></div>

<form id=MyForm class="form-horizontal" method="post" enctype="multipart/form-data">
	<fieldset>
		<div class="form-group">
			<label for="inputCwkStatus" class="col-md-2 col-md-offset-1 control-label">สถานะ</label>
			<div class="col-md-4">
				<select  id="input_sl_status" name="sl_status" class="form-control" onchange="quit(this.value);" >
					<option value="01" >ปฏิบัติการ</option>
					<option value="02" >ลาออก</option>
					<option value="03" >ลาศึกษาต่อ</option>
					<option value="04" >เกษียนอายุ</option>
					<option value="05" >ปฏิบัติการตามวาระ</option>
					<option value="07" >เสียชีวิต</option>
			  	</select>
			</div>
		</div>
		<div class="form-group">
			<label for="inputCwkStatus" class="col-md-2 col-md-offset-1 control-label">หมายเหตุ</label>
			<div class="col-md-6">
				<textarea rows="4" cols="50" name="sl_reason" id="input_sl_reason" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="inputCwkStatus" class="col-md-2 col-md-offset-1 control-label">* มีผลตั้งเเต่<!--(สกอ.)--> :</label>
			<div class="col-md-4">
				<input type="text" name="sl_effective_date" id="input_effective_date" class="form-control">
			</div>
			<div class="col-md-1">
				<img src="../images/vcalendar.png" onclick="showCalendar('start_st','YYYY-MM-DD')"  style="cursor:pointer" class="img-responsive" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-1">
                 <input id="FileInput" name="file" type="file" >
			</div>
		</div>
		<div class="form-group">
		  <div class="col-lg-10 col-lg-offset-2">
		    <input type="hidden" name="emp_id" id="input_emp_id" class="form-control" value="">
            <input type="hidden" name="mod_mode" id="mod_mode" class="form-control" value="">

			<button type="reset" class="btn btn-default">Cancel</button>			
			<button type="button" id="inputSave" class="btn btn-primary" >Save</button>
		  </div>
    	</div>
				
	</fieldset>
</form>

<?
	$db->closedb($conn);
?>

<script>
	$(document).ready(function(){
		$("#inputSave").click(function(){
			var form_data = new FormData();
			var file_data = $('#FileInput').prop('files')[0];   
			
			form_data.append('file', file_data);
			
/*			form_data.append('hid_mode', $("#hid_mode").val());
			form_data.append('document_id', $("#mod_document_id").val());
			form_data.append('list_order', list_order);
			form_data.append('title', $("#mod_title").val());
			form_data.append('document_category', $("#mod_document_category").val());
*/
			form_data.append('sl_status',$("#input_sl_status").val());
			form_data.append('sl_reason',$("#input_sl_reason").val());
			form_data.append('effective_date',$("#input_effective_date").val());
			$.ajax({
				url: 'ajax_currentwork_status_submit.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
            	success: function (ReturnData) {
              		$("#submit-result-box").html(ReturnData); 
            	}
			});
		});
	});
</script>




