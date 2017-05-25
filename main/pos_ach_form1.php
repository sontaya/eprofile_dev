<form id="position_ach1" name="position_ach1" method="post" action="pos_ach_data_save.php"  target="upload_target2">
<table width="615" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr>
    <td width="276"   align="right" valign="top">* รายวิชา : </td>
    <td colspan="2" align="left" valign="top"><input type="text" id="course_name" name="course_name" style="width:256px" class="input_text" value="<?=$_POST["course_name"]?>"/></td>
  </tr>
  <tr>
    <td align="right" valign="top">* ใช้ประกอบการสอนภาคเรียนที่ : </td>
    <td colspan="2" align="left" valign="top">
    <input type="text" id="course_year" name="course_year" style="width:80px" class="input_text" value="<?=$_POST["course_year"]?>" />
</td>
  </tr>
  <tr>
    <td align="right" valign="top">* สัดส่วนในผลงาน : </td>
    <td colspan="2" align="left" valign="top"><input name="type" type="radio" id="type"  value="1" <? if($_POST["type"] == "1") echo "checked='checked'";?>/> 
    จัดทำผลงานเอง ( เต็ม 100 % )<br />
    <input type="radio" id="type" name="type"  value="2" <? if($_POST["type"] == "2") echo "checked='checked'";?>/>
    มีส่วนร่วมทำผลงาน  <input type="text" id="proportion" name="proportion" style="width:40px" class="input_text"  maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["proportion"]."'";?>/> % <br />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ร่วมจัดทำผลงาน  
   <input type="text" id="coop" name="coop" style="width:40px" class="input_text" maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["coop"]."'";?>/> คน
     <input type="hidden" id="page" name="page" value="<?=$_POST["page"]?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="1"/>
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle" height="43"><input type="button" value="<? if($_POST["button"] != ""){echo $_POST["button"];} else {echo "เพิ่มข้อมูล";}?>" onclick="check_data_ach1('1','<?=$_POST["page"];?>')" /></td>
    <td width="41"  align="left" valign="middle"> <input type='button' value='ยกเลิก' onclick="change_inner_form('','<?=$_POST["page"];?>')" /></td>
    <td width="258"  align="left" valign="middle"><span id="waiting_ach<?=$_POST["page"];?>"></span></td>
  </tr>
</table>
</form>