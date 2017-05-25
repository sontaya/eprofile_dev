<?
@session_start();

?>
<script type="text/javascript" language="javascript">
function check_data(){
		
		if($("#rec_order_no").val() == ""  || $("#rec_at").val() == "" || $("#rec_at_date").val() == "" || $("#rec_year").val() == "" || $("#rec_name").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("research").submit();
}

$(function() {
		/*var dates = $('#rec_start_date, #rec_end_date').datepicker({
			changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1960:2020',
			onSelect: function(selectedDate) {
				var option = this.id == "rec_start_date" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		
		});*/
		   
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
 });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >    
    <div id="research_list" align="center" class="data_details_list">
      <? include "res_cre_data_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><img src="../images/add.png" onclick="toggle_form('research','rec_id')" style="cursor:pointer"/></div>
      <div id="data_form" style="display:none;"> 
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="research" name="research" method="post" action="research_data_save.php" target="upload_target">
    
    <img src="../images/bg_d.png" style="margin-left:10px;" />
    
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="116" align="right" class="form_text">* คำสั่ง :<input type="hidden" id="rec_id" name="rec_id" value="" /></td>
        <td width="614" align="left"><input type="text" name="rec_order_no" id="rec_order_no" style="width: 80px;" class="input_text" value="มสด."/> 
           ที่ <input type="text" id="rec_at" name="rec_at" style="width: 80px; " class="input_text"/>
         สั่ง ณ วันที่ <input  type="text" name="rec_at_date" id="rec_at_date" style="width: 80px; " class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('rec_at_date','YYYY-MM-DD')"  style="cursor:pointer"/>
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ประเภททุน :</td>
        <td align="left" class="form_text"><input name="rec_type" type="radio" id="rec_type"  value="1" checked="checked"/>  ภายในองค์กร <input type="radio" name="rec_type" id="rec_type"  value="2"/> ภายนอกองค์กร</td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ปี พ.ศ. ผลงาน :</td>
        <td align="left">
        <select id="rec_year" name="rec_year">
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
    </select>
        </td>
      </tr>

      <tr>
        <td align="right" class="form_text">* ชื่อผลงาน :</td>
        <td align="left"><input type="text" name="rec_name" id="rec_name" style="width: 300px;" class="input_text"/></td>
      </tr>
      
      <tr>
        <td align="right" class="form_text">แหล่งทุน :</td>
        <td align="left">

        <input type="text" name="rec_source" id="rec_source" style="width:150px" class="input_text">

        
        </td>
      </tr>
            <tr>
        <td align="right" class="form_text">วงเงิน :</td>
        <td align="left" class="form_text"><input type="text" name="rec_prices" id="rec_prices" style="width: 100px;" class="input_text"/> บาท</td>
      </tr>
      <tr>
        <td align="right" class="form_text">วันที่เริ่มทำผลงาน :</td>
        <td align="left" class="form_text"><input  type="text" name="rec_start_date" id="rec_start_date" style="width: 80px;" class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('rec_start_date','YYYY-MM-DD')"  style="cursor:pointer"/>
          &nbsp; &nbsp;&nbsp; &nbsp; วันที่ทำผลงานสำเร็จ : 
          <input type="text" name="rec_end_date" id="rec_end_date" style="width: 80px;" class="input_text"/> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('rec_end_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>
  
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('research_creative.php','../images/head2/work_data/research.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
        </td>
      </tr>
             <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>

    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>
</div>    
  </td>
  </tr>  
</table>