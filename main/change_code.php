<script type="text/javascript">
	function seve_change_code(){
		var code_old=document.getElementById("code_old").value;
		var code_new=document.getElementById("code_new").value;
		if(code_old==""){
			alert("กรุณาใส่ หมายเลขบุคลากรเดิม");
			document.getElementById("code_old").focus;
		}
		else if(code_new==""){
			alert("กรุณาใส่ หมายเลขบุคลากรใหม่");
			document.getElementById("code_new").focus;
		}
		else{
			//var data = "code_old="+code_old+"&code_new="+code_new;
			//ajaxPostData("change_code_save.php",data,"text","wait",return_add,"","");
			$.post("./change_code_save.php",{code_old:code_old,code_new:code_new},
			function(data){
				alert(data);
				document.getElementById("code_old").value="";
				document.getElementById("code_new").value="";
			});	
		}
	}
	
	
</script>
<div align="center">
<img src="../images/head2/bio/chang_code.png" />
<form>
<table>
	<tr>
    	<td>หมายเลขบุคลากรเดิม :</td>
        <td><input type="text" name="code_old" id="code_old" /></td>
    </tr>
    <tr>
    	<td>หมายเลขบุคลากรใหม่ :</td>
        <td><input type="text" name="code_new" id="code_new" /></td>
    </tr>
    <tr>
    	<td></td>
        <td><input type="button" value="เปลี่ยน" onclick="seve_change_code();" />&nbsp;&nbsp;<input type="reset" value="เคลียร์" /></td>
    </tr>
</table>
</form>
</div>