<script language="javascript">
function print_card(emp_id){
	if(emp_id == ""){
		alert("กรุณากรอกหมายเลขบุคลากร");
		document.getElementById('emp_id').focus();
		return false;
	}
	window.open("temp_card_print.php?emp_id="+emp_id,"print","width=1000,height=700,scrollbars=yes");
}
</script>
<p align="center">ใส่หมายเลขบุคลากร : <input type="text" id="emp_id" name="emp_id"  size="20" /> 
<input type="button" value="Submit" onclick="print_card(document.getElementById('emp_id').value)"/></p>