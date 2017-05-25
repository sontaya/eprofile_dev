<script language="javascript">
$(function() {
	
	$("#tbook_name_oth").autocomplete({
			source: languageTags
		});
	$("#press_country").autocomplete({
			source: contryTags
		});
});
</script>
<form id="position_ach2" name="position_ach2" method="post" action="pos_sub_ach_data_save.php"  target="upload_target2">
<table width="629" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr>
    <td width="264"  align="right" valign="middle">* ชื่อตำราภาษาไทย : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="tbook_name_th" name="tbook_name_th" style="width:256px" class="input_text" value="<?=$_POST["tbook_name_th"]?>" /></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">* ชื่อตำราภาษาอังกฤษ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="tbook_name_en" name="tbook_name_en" style="width:256px" class="input_text" value="<?=$_POST["tbook_name_en"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อตำราภาษาอื่น : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="tbook_name_oth" name="tbook_name_oth" style="width:100px" class="input_text" value="<?=$_POST["tbook_name_oth"]?>"/> <input type="text" id="tbook_name_oth2" name="tbook_name_oth2" style="width:149px" class="input_text" value="<?=$_POST["tbook_name_oth2"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ใช้ประกอบการสอนวิชา : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="course_name" name="course_name" style="width:256px" class="input_text" value="<?=$_POST["course_name"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle"> Edition : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="edition" name="edition" style="width:80px" class="input_text" value="<?=$_POST["edition"]?>"/>
    &nbsp; Volume : <input type="text" id="volume" name="volume" style="width:80px" class="input_text" value="<?=$_POST["volume"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อสำนักพิมพ์ / โรงพิมพ์ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="press_name" name="press_name" style="width:150px" class="input_text" value="<?=$_POST["press_name"]?>"/></td>
  </tr>
  <tr>
    <td align="right" valign="middle"> ประเทศของสำนักพิมพ์ / โรงพิมพ์ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="press_country" name="press_country" style="width:150px" class="input_text" value="<?=$_POST["press_country"]?>"/></td>
  </tr>
  <tr>
    <td align="right" valign="middle">ปี พ.ศ. ที่ตีพิมพ์ : </td>
    <td colspan="2" align="left" valign="middle">
    <select id="press_year" name="press_year">
        <option value="">เลือก</option>
        <?
        $year = date("Y")+543;
			for($i=0;$i<70;$i++){
			$y= $year-$i;
			if($_POST["press_year"] == $y){
				$txt = "selected = 'selected'";
			}else{$txt = "";}
			echo "<option value='$y' $txt>$y</option>\n";	
		}
		?>
        </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">* สัดส่วนในผลงาน : </td>
    <td colspan="2" align="left" valign="middle"><input name="type" type="radio" id="type"  value="1" <? if($_POST["type"] == "1") echo "checked='checked'";?>/> 
    จัดทำผลงานเอง ( เต็ม 100 % )<br />
    <input type="radio" id="type" name="type"  value="2" <? if($_POST["type"] == "2") echo "checked='checked'";?>/>
    มีส่วนร่วมทำผลงาน  <input type="text" id="proportion" name="proportion" style="width:40px" class="input_text"  maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["proportion"]."'";?>/> % <br />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ร่วมจัดทำผลงาน  
   <input type="text" id="coop" name="coop" style="width:40px" class="input_text" maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["coop"]."'";?>/> คน
    <input type="hidden" id="page" name="page" value="<?=$_POST["page"];?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="2"/>
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle" height="43"><input type="button" value="<? if($_POST["button"] != "") echo $_POST["button"]; else echo "เพิ่มข้อมูล";?>" onclick="check_data_ach2('2','<?=$_POST["page"];?>')" /></td>
    <td width="64"  align="left" valign="middle"> <input type='button' value='ยกเลิก' onclick="change_inner_form('','<?=$_POST["page"];?>')" /></td>
    <td width="261"  align="left" valign="middle"><span id="waiting_ach<?=$_POST["page"];?>"></span></td>
  </tr>
</table>
</form>