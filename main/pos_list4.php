<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
    $sql = "SELECT * FROM  ".TB_VCHARKARN_POSITION_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND VP_TYPE = '4' "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row4 = oci_fetch_array($stid, OCI_BOTH);
?>
<script language="javascript">
$(function() {
			
	/*$('#vp_date4').datepicker({
		    changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1960:2020'
		});
	$('#vp_mati_24').datepicker({
		    changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1960:2020'
		});*/
	
	$("#vp_university4").autocomplete({
			source: universityTags
		});
	$("#vp_professional_major4").autocomplete({
			source: expertTags
		});
			
});
</script>
     <table width="670" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="282"   align="right" class="form_text">* ขอกำหนดตำแหน่ง :</td>
        <td width="358"    align="left">
        <input type="radio" id="vp_sub_type4" name="vp_sub_type4" value="1" checked="checked" /> ศาสตราจารย์ 11
</td>
      </tr>
      <tr>
        <td align="right" class="form_text"> * วิธีขอกำหนดตำแหน่ง :</td>
        <td align="left">
        <select id="vp_method4" name="vp_method4">
          <option value="">--เลือกข้อมูล--</option>
          <option value="1" <? if($row4["VP_METHOD"] == "1"){echo "selected='selected'";}?>>ปกติ</option>
          <option value="2" <? if($row4["VP_METHOD"] == "2"){echo "selected='selected'";}?>>พิเศษ</option>
          <option value="3" <? if($row4["VP_METHOD"] == "3"){echo "selected='selected'";}?>>อื่นๆ</option>
        </select>
        &nbsp;&nbsp;&nbsp;แต่งตั้งโดย :
        <select id="vp_by4" name="vp_by4" >
          <option  value="">--เลือกข้อมูล--</option>
          <option value="1" <? if($row4["VP_BY"] == "1"){echo "selected='selected'";}?>>กพอ.</option>
          <option value="2" <? if($row4["VP_BY"] == "2"){echo "selected='selected'";}?>>กกอ.</option>
          <option value="3" <? if($row4["VP_BY"] == "3"){echo "selected='selected'";}?>>กม.</option>
          <option value="4" <? if($row4["VP_BY"] == "4"){echo "selected='selected'";}?>>กสอ.</option>
          <option value="5" <? if($row4["VP_BY"] == "5"){echo "selected='selected'";}?>>กค.</option>
          <option value="6" <? if($row4["VP_BY"] == "6"){echo "selected='selected'";}?>>สภาสถาบัน</option>
          <option value="7" <? if($row4["VP_BY"] == "7"){echo "selected='selected'";}?>>หน่วยงานอื่นๆ</option>
         </select>
        </td>
      </tr>
     <tr>
        <td align="right" class="form_text"> * มหาวิทยาลัย/สถาบันการศึกษา :</td>
        <td align="left" class="form_text"><input type="text" name="vp_university4" id="vp_university4" style="width: 300px;" class="input_text" value="<?=$row4["VP_UNIVERSITY"]?>"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text"> * สาขาวิชาที่ขอกำหนดตำแหน่ง :</td>
        <td align="left"><input type="text" name="vp_professional_major4" id="vp_professional_major4" style="width: 300px;" class="input_text" value="<?=$row4["VP_PROFESSIONAL_MAJOR"]?>"/></td>
      </tr>
      <tr>
        <td align="right" > * วันที่ได้รับอนุมัติแต่งตั้ง :</td>
        <td align="left"><input type="text" name="vp_date4" id="vp_date4" style="width:80px;" class="input_text" value="<?=change_date_thai($row4["VP_DATE"]);?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('vp_date4','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>
       <tr>
        <td align="right" > * มติที่ประชุมสภามหาวิทยาลัย/สถาบันการศึกษา ครั้งที่ :</td>
        <td align="left"><input type="text" name="vp_mati_14" id="vp_mati_14" style="width: 70px;" class="input_text"  maxlength="50" value="<?=$row4["VP_MATI_1"]?>"/> <input type="text" name="vp_mati_24" id="vp_mati_24" style="width: 80px;" class="input_text" value="<?=change_date_thai($row4["VP_MATI_2"]);?>"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('vp_mati_24','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>
      </table>
      <table border="0">
      <tr>
        <td width="441" height="47" align="right" valign="middle" >
        <input type="button" value="แก้ไขข้อมูลการกำหนดตำแหน่ง" onclick="check_data('4')"/> 
        <input type="button" value="ลบการขอกำหนดตำแหน่ง" onclick="del_pos('4')"/></td>
        <td width="214" height="47" align="left" valign="middle" > <span id="waiting4"></span></td>
        </tr>
</table>

<? 
	oci_free_statement($stid);
	$db->closedb($conn);
?>