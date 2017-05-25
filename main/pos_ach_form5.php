<script language="javascript">
$(function() {
	
	$("#article_name_oth").autocomplete({
			source: languageTags
		});
});
</script>
<form id="position_ach5" name="position_ach5" method="post" action="pos_ach_data_save.php"  target="upload_target2">
<table width="629" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr>
    <td width="264"  align="right" valign="middle">* ชื่อบทความภาษาไทย : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="article_name_th" name="article_name_th" style="width:256px" class="input_text" value="<?=$_POST["article_name_th"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">* ชื่อบทความภาษาอังกฤษ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="article_name_en" name="article_name_en" style="width:256px" class="input_text" value="<?=$_POST["article_name_en"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อบทความภาษาอื่น : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="article_name_oth" name="article_name_oth" style="width:100px" class="input_text" value="<?=$_POST["article_name_oth"]?>"/> <input type="text" id="article_name_oth2" name="article_name_oth2" style="width:149px" class="input_text" value="<?=$_POST["article_name_oth2"]?>"/></td>
  </tr>
<tr>
    <td align="right" valign="top">* สัดส่วนในผลงาน : </td>
    <td colspan="2" align="left" valign="top"><input name="type" type="radio" id="type"  value="1" <? if($_POST["type"] == "1") echo "checked='checked'";?>/> 
    จัดทำผลงานเอง ( เต็ม 100 % )<br />
    <input type="radio" id="type" name="type"  value="2" <? if($_POST["type"] == "2") echo "checked='checked'";?>/>
    มีส่วนร่วมทำผลงาน  <input type="text" id="proportion" name="proportion" style="width:40px" class="input_text"  maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["proportion"]."'";?>/> % <br />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ร่วมจัดทำผลงาน  
   <input type="text" id="coop" name="coop" style="width:40px" class="input_text" maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["coop"]."'";?>/> คน
   <input type="hidden" id="page" name="page" value="<?=$_POST["page"];?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="5"/>
    </td>
  </tr>
    <tr>
    <td colspan="3"  align="left" valign="top" style="padding-left:75px;"><h3>วารสารที่เผยแพร่</h3></td>
    </tr>
  <tr>
    <td  align="right" valign="middle">ระดับ : </td>
    <td colspan="2" align="left" valign="middle"><input type="radio" id="distribute_journal_level" name="distribute_journal_level" value="1" <? if($_POST["distribute_journal_level"] == "1"){echo "checked = 'checked'";}?>/> ชาติ <input type="radio" id="distribute_journal_level" name="distribute_journal_level" value="2" <? if($_POST["distribute_journal_level"] == "2"){echo "checked = 'checked'";}?>/> นานาชาติ </td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อวารสาร : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="journal_name" name="journal_name" style="width:256px" class="input_text" value="<?=$_POST["journal_name"]?>"/></td>
  </tr>
    <tr>
    <td  align="right" valign="top">ชื่อผู้แต่งทั้งหมด : </td>
    <td colspan="2" align="left" valign="top"><textarea style="width:250px; height:80px" id="writer" name="writer"><?=$_POST["writer"]?></textarea></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">Volume, Issue, No., หน้า : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="v_i_n_p" name="v_i_n_p" style="width:256px" class="input_text" value="<?=$_POST["v_i_n_p"]?>"/></td>
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
    <td align="right" valign="middle" height="43"><input type="button" value="<? if($_POST["button"] != "") echo $_POST["button"]; else echo "เพิ่มข้อมูล";?>" onclick="check_data_ach5('5','<?=$_POST["page"];?>')" /></td>
    <input type="hidden" id="page" name="page" value="<?=$_POST["page"];?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="5"/>
    <td width="58"  align="left" valign="middle"> <input type='button' value='ยกเลิก' onclick="change_inner_form('','<?=$_POST["page"];?>')" /></td>
    <td width="267"  align="left" valign="middle"><span id="waiting_ach<?=$_POST["page"];?>"></span></td>
  </tr>
</table>
</form>