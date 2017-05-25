<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
/*$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT * FROM  ".TB_APPRAISE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$row = $db->fetch($sql,$conn);*/
?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<script type="text/javascript" language="javascript">

function check_data(){
	if($("#apr_year").val() == "" || $("#apr_result").val() == "" || $("#apr_score").val() == "" || $("#apr_dev_comment").val() == "" || $("#apr_date").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("appraise_data").submit();
		
}

function change_txt(value){
	if(value == "ลูกจ้างทั่วไป"){
		document.getElementById("head_1").style.display = "none";
		document.getElementById("head_2").style.display = "block";
		document.getElementById("head_11").style.display = "none";
		document.getElementById("head_22").style.display = "block";
		document.getElementById("up1").style.display = "none";
		document.getElementById("up2").style.display = "block";
	}else{
		document.getElementById("head_1").style.display = "block";
		document.getElementById("head_2").style.display = "none";
		document.getElementById("head_11").style.display = "block";
		document.getElementById("head_22").style.display = "none";
		document.getElementById("up1").style.display = "block";
		document.getElementById("up2").style.display = "none";
	}
}

$(function() {
	
		/*$('#apr_date').datepicker({
		    changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1970:2020'
		});
*/

		
		$('#OnlyThai').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#OnlyEn').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#OnlyNm').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#ValidEml').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#Save_success').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#Save_error').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
		$('#Error_upload').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
		
				$('#Please_fill_in').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});
	
 });


</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
    <div id="appraise_list" align="center" class="data_details_list">
      <? include "appraise_data_table.php";?>
    </div>
    <?php if($_SESSION['USER_TYPE'] != 'user') { ?>
    <div align="center"  id="toggle_form"><img src="../images/add.png" onclick="toggle_form('appraise_data','')" style="cursor:pointer"/></div>
    <?php } ?>
      <div id="data_form" style="display:none"> 
<table  cellspacing="0" cellpadding="0" align="center" >
<tr>
    <td>
    <form id="appraise_data" name="appraise_data" enctype="multipart/form-data" method="post" action="appraise_data_save.php"  target="upload_target">
    
    <img src="../images/bg_d.png" style="margin-left:3px;" />
    
    <table width="99%"  cellspacing="0" cellpadding="4"  align="center">
        <tr>
        	<td width="282" align="right">  ประเภท : </td>
        	<td width="432" align="left"><select name="apr_type" id="apr_type" onchange="change_txt(this.value);">
            <option value="ข้าราชการ/ลูกจ้างประจำ" <? //$row["APR_TYPE"] == "ข้าราชการ/ลูกจ้างประจำ") echo "selected='selected'";?>>ข้าราชการ/ลูกจ้างประจำ</option>
            <option value="ลูกจ้างทั่วไป" <? //$row["APR_TYPE"] == "ลูกจ้างทั่วไป") echo "selected='selected'";?>>ลูกจ้างทั่วไป</option>
            </select></td>
          </tr>
           <tr>
        	<td align="right"> * ปีการศึกษา : </td>
        	<td align="left"><select id="apr_year" name="apr_year">
        <option value="">เลือก</option>
        <?
        $year = date("Y")+543;
			for($i=0;$i<30;$i++){
			$y= $year-$i;
			$txt = "";
			//if($row["APR_YEAR"] == "$y") $txt = "selected = 'selected'";
			echo "<option value='$y' $txt>$y</option>\n";	
		}
		?>
        </select></td>
          </tr>
           <tr>
        	<td align="right" valign="top"> * ผลการประเมิน : </td>
        	<td align="left" valign="top">
            <input type="radio" id="apr_result" name="apr_result"  value="5" <? //$row["APR_RESULT"] == "5") echo "checked = 'checked'";?>/> ดีเยี่ยม(ระดับ 5) (คะแนน 95 - 100) <br />
            <input type="radio" id="apr_result" name="apr_result"  value="4" <? //$row["APR_RESULT"] == "4") echo "checked = 'checked'";?>/> ดีมาก(ระดับ 4) (คะแนน 85 - 94.99) <br />
            <input type="radio" id="apr_result" name="apr_result"  value="3" <? //$row["APR_RESULT"] == "3") echo "checked = 'checked'";?>/> ดี(ระดับ 3) (คะแนน 70 - 84.99) <br />
            <input type="radio" id="apr_result" name="apr_result"  value="1" <? //$row["APR_RESULT"] == "2") echo "checked = 'checked'";?>/> พอใช้(ระดับ 2) (คะแนน 60 - 69.99) <br />
            <input type="radio" id="apr_result" name="apr_result"  value="1" <? //$row["APR_RESULT"] == "1") echo "checked = 'checked'";?>/> ต้องปรับปรุง(ระดับ 1) (คะแนน 1 - 59.99) 
            
            </td>
          </tr>
          <tr>
        	<td width="282" align="right"> * ได้คะแนน : </td>
        	<td width="432" align="left"><input type="text" id="apr_score" name="apr_score"  style="width: 50px" maxlength="5" class="input_text" value="<? //$row["APR_SCORE"]?>"/> คะแนน</td>
          </tr>
           <tr>
             <td height="35" colspan="2" align="left"  style="padding-left:30px"><br /><br />
               <div class="head2" align="left" id="head_1">ความเห็นของผู้ประเมิน</div>
               <div class="head2" align="left" id="head_2" style="display:none">ความเห็นของผู้บังคับบัญชา</div>
               </td>
           </tr>
        <tr>
        	<td align="left" valign="top"> 
            * ความเห็นเกี่ยวกับการพัฒนาและการแก้ไขการปฏิบัติงาน<br />
            <br />
        	  (ระบุความถนัด จุดเด่น และสิ่งที่ควรพัฒนาของผู้รับการ<br />
        	  <br />
        	  ประเมิน) </td>
        	<td align="left" valign="top">
            <textarea id="apr_dev_comment" name="apr_dev_comment" class="input_text" style="width: 300px; height: 110px"><? //$row["APR_DEV_COMMENT"]?></textarea>
            </td>
          </tr>
          <tr>
        	<td align="right" valign="top"> ความเห็นเกียวกับการเลื่อนขั้นเงินเดือน : </td>
        	<td align="left" valign="top">
            <div id="up1">
            <input type="radio" id="apr_salary_step" name="apr_salary_step"  value="1" <? //$row["APR_SALARY_STEP"] == "1") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 1 ขั้น <br />
            <input type="radio" id="apr_salary_step" name="apr_salary_step"  value="0.5" <? //$row["APR_SALARY_STEP"] == "0.5") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 0.5 ขั้น <br />
            <input type="radio" id="apr_salary_step" name="apr_salary_step"  value="0" <? //$row["APR_SALARY_STEP"] == "0") echo "checked = 'checked'";?>/> ไม่ควรเลื่อนขั้นเงินเดือน
            </div>
            <div id="up2" style="display:none">
            <input type="radio" id="apr_salary_percent" name="apr_salary_percent"  value="8" <? //$row["APR_SALARY_PERCENT"] == "8") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 8%<br />
            <input type="radio" id="apr_salary_percent" name="apr_salary_percent"  value="6" <? //$row["APR_SALARY_PERCENT"] == "6") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 6% <br />
            <input type="radio" id="apr_salary_percent" name="apr_salary_percent"  value="4" <? //$row["APR_SALARY_PERCENT"] == "4") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 4% <br />
            <input type="radio" id="apr_salary_percent" name="apr_salary_percent"  value="2" <? //if($row["APR_SALARY_PERCENT"] == "4") echo "checked = 'checked'";?>/> ควรเลื่อนขั้นเงินเดือน 2% <br />
            <input type="radio" id="apr_salary_percent" name="apr_salary_percent"  value="0" <? //$row["APR_SALARY_PERCENT"] == "0") echo "checked = 'checked'";?>/> ไม่ควรเลื่อนขั้นเงินเดือน
            </div>
        	</td>
          </tr>
          <tr>
        	<td width="282" align="right" valign="top"> ระบุเหตุผล : </td>
        	<td width="432" align="left" valign="top"><textarea id="apr_salary_reason" name="apr_salary_reason" class="input_text" style="width: 300px; height: 110px"><? //$row["APR_SALARY_REASON"]?></textarea></td>
          </tr>
           <tr>
        	<td align="right"> ผู้ประเมิน : </td>
        	<td><input name="apr_by_name" type="text" class="input_text" id="apr_by_name" style="width: 200px; " value="<? //$row["APR_BY_NAME"];?>"/>
        	&nbsp;</td>
          </tr>
          <tr>
        	<td align="right"> ตำแหน่ง : </td>
        	<td><input name="apr_by_pos" type="text" class="input_text" id="apr_by_pos" style="width: 200px; "  value="<? //$row["APR_BY_POS"];?>" />
        	&nbsp; &nbsp;</td>
          </tr>
          <tr>
        	<td align="right"> * วันที่ : </td>
        	<td><input  name="apr_date" type="text" class="input_text" id="apr_date" style="width: 80px; " value="<? //change_date_thai($row["APR_DATE"]);?>" />
        	&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('apr_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
          </tr>
             <tr>
        	<td align="right" valign="top"  >
            <div id="head_11">ความเห็นของผู้ประเมินเหนือขึ้นไป : </div>
            <div id="head_22" style="display:none">* ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป : </div>
            </td>
        	<td align="left" valign="top">
            <input type="radio" id="apr_up_comment" name="apr_up_comment"  value="1" <? //$row["APR_UP_COMMENT"] == "1") echo "checked = 'checked'";?>/> 
            เห็นด้วยกับการประเมินข้างต้น <br />
            <input type="radio" id="apr_up_comment" name="apr_up_comment"  value="2" <? //$row["APR_UP_COMMENT"] == "2") echo "checked = 'checked'";?>/> 
            มีความเห็นแตกต่างจากการประเมินข้างต้น<br />
            (ระบุเหตุผล)</td>
          </tr>
          <tr>
        	<td width="282" align="right" valign="top">&nbsp;</td>
        	<td width="432" align="left" valign="top"><textarea id="apr_up_reason" name="apr_up_reason" class="input_text" style="width: 300px; height: 110px"><? //$row["APR_UP_REASON"]?></textarea></td>
          </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;
          </td>
      </tr>
      <? if($_SESSION["USER_TYPE"] == "admin"){?>
       <tr>
        <td align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" onclick="check_data();" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        </td>
        <td align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('appraise_data.php','../images/head2/work_data2/appraise.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
        <?
		 }
	?>
    </table>
    </form>
    </td>
  </tr>
</table>
</div>
  </td>
  </tr>  
</table>
<script language="javascript">
	var myTextField = document.getElementById('apr_type').value;
	change_txt(myTextField);
</script>
<?

//$db->closedb($conn);
?>