<?

      
 // Hide for user and chief
 //if($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') {}


@session_start();
$emp_id = $_SESSION["EMP_ID"];
$person_id = $_SESSION["PERSON_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");

?>

<h3>บันทึกการปรับเปลี่ยนสถานะ</h3>
<hr>

    <div id="table-result-box"></div>

    
    <div class="text-center">
    	<a href="#" class="btn btn-primary add-record"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
    </div>
    
    <hr>   

    <?
		oci_free_statement($stid);
 	 ?>

<div id="submit-result-box"></div>
<div id="delete-result-box"></div>

<div id="form-box" style="display: none">
	

	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">

			
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
						<label for="input_sl_effective" class="col-md-2 col-md-offset-1 control-label">มีผลตั้งเเต่</label>
						<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="input_sl_effective" data-link-format="yyyy-mm-dd">
							<input class="form-control" size="16" type="text" value="" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<input type="hidden" id="input_sl_effective" value="" /><br/>
					</div>

					<div class="form-group">
						<label for="inputCwkStatus" class="col-md-2 col-md-offset-1 control-label">เอกสาร</label>
						<div class="col-md-6">
							 <input id="FileInput" name="file" 
								type="file" class="file-loading" 
								multiple=false 
								data-show-upload="false" 
								>
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
												
		</div>
	</div>





	
</div>

<?
	$db->closedb($conn);
?>

<script>
	$(document).ready(function(){
		
		initTable();
		
		$("#FileInput").fileinput({			
			browseClass: "btn btn-success",
			browseLabel: " เลือกไฟล์",
			browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
			removeClass: "btn btn-danger",
			removeLabel: "Delete",
			removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
			overwriteInitial: false,
			showPreview: false,
		});
		
		$("#inputSave").click(function(){
			var form_data = new FormData();
			var file_data = $('#FileInput').prop('files')[0];   
			
			form_data.append('ccs', file_data);
			
			form_data.append('sl_status',$("#input_sl_status").val());
			form_data.append('sl_reason',$("#input_sl_reason").val());
			form_data.append('sl_effective',$("#input_sl_effective").val());
			$.ajax({
				url: 'ajax_currentwork_status_submit.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
            	success: function (ReturnData) {
              		//$("#submit-result-box").html(ReturnData); 
					/*swal({
					  title: "Error!",
					  text: "Here's my error message!",
					  type: "error",
					  confirmButtonText: "Cool"
					});*/
					swal({
						title: "บันทึกข้อมูลเรียบร้อย",
						timer: 2000,
						showConfirmButton: false
					});
					initTable();
            	}
			});
		});
		
		$('.add-record').click(function(){
			$("#form-box").fadeIn(1000);
		});

		
		$('.form_date').datetimepicker({
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		});
		
	});
	

	
	function initTable(){
		$.ajax({
				url: 'ajax_currentwork_status_table.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				type: 'get',
            	success: function (ReturnTableData) {
              		$("#table-result-box").html(ReturnTableData); 
					
            	}
			});
	}
	
	function delete_sl(idx){
		

		
		swal({
		  title: "ยืนยันการลบข้อมูล",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		},
		function(){
			console.log('delete: '+ idx);
			var form_data = new FormData();
			form_data.append('sl_id',idx);
			
			$.ajax({
				url: 'ajax_currentwork_status_delete.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
            	success: function (ReturnData) {
              		//$("#delete-result-box").html(ReturnData); 
					swal({
						title: "ลบข้อมูลเรียบร้อย",
						timer: 2000,
						showConfirmButton: false
					});
					initTable();
            	}
			});			
			
		 
		});		
	}
</script>




