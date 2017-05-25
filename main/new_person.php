<div id="code_user" title="Input Data Error !" style="display:none">
	<br />
	กรอกได้เฉพาะ 0-9 และ "-" เท่านั้น
</div>

<table width="662" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="662">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="center"  style="background-repeat:repeat-y">
    
    <table width="601" border="0" align="center" cellpadding="3"  cellspacing="3">
  <tr><td width="601" height="415" valign="top">
  <form id="new_person" >
  <table width="511" border="0" cellspacing="3" cellpadding="3" align="center" >
  <tr>
    <td width="223" align="right" class="form_text">หมายเลขบุคลากร :</td>
    <td colspan="3" align="left">
    <input type="text" id="emp_id" name="emp_id"  style="width: 150px" class="input_text" onkeyup="check_codeuser('emp_id');"/></td>
  </tr>
  <tr>
    <td height="39" align="right" valign="middle"><input type="button" value="เพิ่ม" onclick="new_person($('#emp_id').val())"/> </td>
    <td width="71" align="left" valign="middle"> <input type="button" value="เคลียร์"  onclick="document.getElementById('new_person').reset()"/> </td>
    <td width="187" colspan="2" align="left" valign="middle"><div id="wait"></div></td>
    </tr>
  <tr>
    <td height="34" colspan="4" align="right">&nbsp;</td>
    </tr>
</table>

  
  </form>

</td></tr></table>
      
    </td>
  </tr>
 
</table>