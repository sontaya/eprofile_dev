<script language="javascript">
$(function() {
	
	$("#research_name_oth").autocomplete({
			source: languageTags
		});
	$("#research_name2_oth").autocomplete({
			source: languageTags
		});
	$("#press_country").autocomplete({
			source: contryTags
		});
	$("#meeting_country").autocomplete({
			source: contryTags
		});
});
</script>
<form id="position_ach4" name="position_ach4" method="post" action="pos_sub_ach_data_save.php"  target="upload_target2">
<table width="629" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr>
    <td width="276"  align="right" valign="middle">* ชื่องานวิจัยภาษาไทย : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name_th" name="research_name_th" style="width:256px" class="input_text" value="<?=$_POST["research_name_th"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">* ชื่องานวิจัยภาษาอังกฤษ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name_en" name="research_name_en" style="width:256px" class="input_text" value="<?=$_POST["research_name_en"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่องานวิจัยภาษาอื่น : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name_oth" name="research_name_oth" style="width:100px" class="input_text" value="<?=$_POST["research_name_oth"]?>"/> <input type="text" id="research_name_oth2" name="research_name_oth2" style="width:149px" class="input_text" value="<?=$_POST["research_name_oth2"]?>"/></td>
  </tr>
  <tr>
    <td colspan="3"  align="left" valign="top" style="padding-left:75px; color: #F00">ในกรณีที่ชื่อบทความวิจัยที่เผยแพร่แตกต่างจากชื่องานวิจัย โปรดแก้ไขข้อมูลด้านล่าง</td>
    </tr>
     <tr>
    <td width="276"  align="right" valign="middle">ชื่อบทความวิจัยภาษาไทย : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name2_th" name="research_name2_th" style="width:256px" class="input_text" value="<?=$_POST["research_name2_th"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อบทความวิจัยภาษาอังกฤษ : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name2_en" name="research_name2_en" style="width:256px" class="input_text" value="<?=$_POST["research_name2_en"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อบทความวิจัยภาษาอื่น : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="research_name2_oth" name="research_name2_oth" style="width:100px" class="input_text" value="<?=$_POST["research_name2_oth"]?>"/> <input type="text" id="research_name2_oth2" name="research_name2_oth2" style="width:149px" class="input_text" value="<?=$_POST["research_name2_oth2"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="top">ชื่อผู้เขียนบทความทั้งหมด : </td>
    <td colspan="2" align="left" valign="top"><textarea style="width:250px; height:80px" id="writer" name="writer"><?=$_POST["writer"]?></textarea></td>
  </tr>
 
  <tr>
    <td align="right" valign="top">* สัดส่วนในผลงาน : </td>
    <td colspan="2" align="left" valign="middle"><input name="type" type="radio" id="type"  value="1" <? if($_POST["type"] == "1") echo "checked='checked'";?>/> 
    จัดทำผลงานเอง ( เต็ม 100 % )<br />
    <input type="radio" id="type" name="type"  value="2" <? if($_POST["type"] == "2") echo "checked='checked'";?>/>
    มีส่วนร่วมทำผลงาน  <input type="text" id="proportion" name="proportion" style="width:40px" class="input_text"  maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["proportion"]."'";?>/> % <br />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ร่วมจัดทำผลงาน  
   <input type="text" id="coop" name="coop" style="width:40px" class="input_text" maxlength="3" <? if($_POST["type"] == "2") echo "value='".$_POST["coop"]."'";?>/> คน
    </td>
  </tr>
  <tr>
    <td colspan="3"  align="left" valign="top" style="padding-left:75px;"><h3>วิธีการเผยแพร่</h3></td>
    </tr>
  <tr>
    <td  align="right" valign="middle">เผยแพร่ในวารสารระดับ : </td>
    <td colspan="2" align="left" valign="middle"><input type="radio" id="distribute_level" name="distribute_level" value="1" <? if($_POST["distribute_level"] == "1"){echo "checked = 'checked'";}?>/> ชาติ <input type="radio" id="distribute_level" name="distribute_level"  <? if($_POST["distribute_level"] == "2"){echo "checked = 'checked'";}?> value="2" /> นานาชาติ </td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อวารสาร : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="journal_name" name="journal_name" style="width:256px" class="input_text" value="<?=$_POST["journal_name"]?>"/></td>
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
    <td  align="right" valign="middle">เผยแพร่ในการประชุมวิชาการระดับ : </td>
    <td colspan="2" align="left" valign="middle"><input type="radio" id="meeting_distribute_level" name="meeting_distribute_level" value="1"  <? if($_POST["meeting_distribute_level"] == "1"){echo "checked = 'checked'";}?>/> ชาติ <input type="radio" id="meeting_distribute_level" name="meeting_distribute_level" value="2" <? if($_POST["meeting_distribute_level"] == "2"){echo "checked = 'checked'";}?>/> นานาชาติ </td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ชื่อการประชุม : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="meeting_name" name="meeting_name" style="width:256px" class="input_text" value="<?=$_POST["meeting_name"]?>"/></td>
  </tr>
  <tr>
    <td  align="right" valign="middle">ประเทศที่จัดประชุม : </td>
    <td colspan="2" align="left" valign="middle"><input type="text" id="meeting_country" name="meeting_country" style="width:256px" class="input_text" value="<?=$_POST["meeting_country"]?>"/></td>
  </tr>
  <tr>
    <td align="right" valign="middle">เดือน/ปี พ.ศ. ที่จัดประชุม : </td>
    <td colspan="2" align="left" valign="middle">
    <select id="meeting_month" name="meeting_month">
        <option value="">เลือก</option>
        <?
        $month = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		for($i=1;$i<13;$i++){
			if($_POST["meeting_month"] == $i){
				$txt = "selected = 'selected'";
			}else{$txt = "";}
			echo "<option value='$i' $txt>$month[$i]</option>\n";	
		}
		?>
      </select> 
    <select id="meeting_year" name="meeting_year">
        <option value="">เลือก</option>
        <?
        $year = date("Y")+543;
			for($i=0;$i<70;$i++){
			$y= $year-$i;
			if($_POST["meeting_year"] == $y){
				$txt = "selected = 'selected'";
			}else{$txt = "";}
			echo "<option value='$y' $txt>$y</option>\n";	
		}
		?>
      </select></td>
  </tr>
  <tr>
    <td align="right" valign="middle" height="43"><input type="button" value="<? if($_POST["button"] != "") echo $_POST["button"]; else echo "เพิ่มข้อมูล";?>" onclick="check_data_ach4('4','<?=$_POST["page"];?>')" /></td>
    <input type="hidden" id="page" name="page" value="<?=$_POST["page"];?>"/>
    <input type="hidden" id="id" name="id" value="<?=$_POST["id"]?>"/>
    <input type="hidden" id="what_form" name="what_form" value="4"/>
    <td width="64"  align="left" valign="middle"> <input type='button' value='ยกเลิก' onclick="change_inner_form('','<?=$_POST["page"];?>')" /></td>
    <td width="249"  align="left" valign="middle"><span id="waiting_ach<?=$_POST["page"];?>"></span></td>
  </tr>
</table>
</form>