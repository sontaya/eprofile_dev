<script language="javascript">
$(function() {
	
	$("#acheive_name_oth").autocomplete({
			source: languageTags
		});
});
</script>
<form id="position_ach6" name="position_ach6" method="post" action="pos_sub_ach_data_save.php"  target="upload_target2">
<table width="629" border="0" cellspacing="4" cellpadding="4" align="center">
 <tr>
    <td width="263"  align="right" valign="middle">* ประเภท : </td>
    <td colspan="2" align="left" valign="middle">
    <select id="acheive_type" name="acheive_type" >
    <option value="">เลือก</option>
    <option value="1" <? if($_POST["acheive_type"] == "1"){echo "selected = 'selected'";}?>>สิ่งประดิษฐ์</option>
    <option value="2" <? if($_POST["acheive_type"] == "2"){echo "selected = 'selected'";}?>>งานแปล</option>
    <option value="3" <? if($_POST["acheive_type"] == "3"){echo "selected = 'selected'";}?>>สื่ออิเล็กทรอนิคส์</option>
    <option value="4" <? if($_POST["acheive_type"] == "4"){echo "selected = 'selected'";}?>>ประเภทอื่น</option>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="3"  align="left" valign="top" style="padding-left:200px;"><h4>ชื่อผลงาน</h4></td>
    </tr>
  <tr>
    <td width="263"  align="right" valign="middle">* ภาษาไทย : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="acheive_name_th" name="acheive_name_th" style="width:256px" class="input_text" value="<?=$_POST["acheive_name_th"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">* ภาษาอังกฤษ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="acheive_name_en" name="acheive_name_en" style="width:256px" class="input_text" value="<?=$_POST["acheive_name_en"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ภาษาอื่น : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="acheive_name_oth" name="acheive_name_oth" style="width:100px" class="input_text" value="<?=$_POST["acheive_name_oth"]?>"/> <input type="text" id="acheive_name_oth2" name="acheive_name_oth2" style="width:149px" class="input_text" value="<?=$_POST["acheive_name_oth2"]?>"/></td>
  </tr>
  <tr>
    <td align="right" valign="middle">ปี พ.ศ. ผลิตผลงาน : </td>
    <td colspan="2" align="left" valign="middle">
    <select id="acheive_year" name="acheive_year">
        <option value="">เลือก</option>
        <?
        $year = date("Y")+543;
			for($i=0;$i<70;$i++){
			$y= $year-$i;
			if($_POST["acheive_year"] == $y){
				$txt = "selected = 'selected'";
			}else{$txt = "";}
			echo "<option value='$y' $txt>$y</option>\n";	
		}
		?>
        </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">สัดส่วนในผลงาน : </td>
    <td colspan="2" align="left" valign="middle"><input name="type" type="radio" id="type"  value="1" <? if($_POST["type"] == "1") echo "checked='checked'";?>/> 
    จัดทำผลงานเอง ( เต็ม 100 % )<br />
    <input type="radio" id="type" name="type"  value="2" <? if($_POST["type"] == "2") echo "checked='checked'";?>/>
    มีส่วนร่วมทำผลงาน  <input type="text" id="proportion" name="proportion" style="width:40px" class="input_text"  maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["proportion"]."'";?>/> % <br />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ร่วมจัดทำผลงาน  
   <input type="text" id="coop" name="coop" style="width:40px" class="input_text" maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["coop"]."'";?>/> คน
    <input type="hidden" id="page" name="page" value="<?=$_POST["page"];?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="6"/>
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle" height="43"><input type="button" value="<? if($_POST["button"] != "") echo $_POST["button"]; else echo "เพิ่มข้อมูล";?>" onclick="check_data_ach6('6','<?=$_POST["page"];?>')" /></td>
    <td width="60"  align="left" valign="middle"><input type='button' value='ยกเลิก' onclick="change_inner_form('','<?=$_POST["page"];?>')" /></td>
    <td width="266"  align="left" valign="middle"><span id="waiting_ach<?=$_POST["page"];?>"></span></td>
  </tr>
</table>
</form>