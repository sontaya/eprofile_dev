<?
@session_start();
?>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr>
      <td align="center" >&nbsp;</td></tr>
    <tr><td >
    <div class="head" ><img src="images/head/seminar.png" /><br />
      <br />
    </div>
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="seminar" name="seminar" method="post" action="">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="186" align="right" class="form_text">เลขที่คำสั่ง :</td>
        <td width="540" align="left"><input type="text" name="sem_order_no" id="sem_order_no" style="width: 100px; height:13px" class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ชื่อหลักสูตร :</td>
        <td align="left"><input type="text" name="sem_course_name" id="sem_course_name" style="width: 300px; height:13px" class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ประเภท :</td>
        <td align="left"><select name="sem_type" id="sem_type">
          <option value="0">เลือก</option>
        </select></td>
      </tr>
      <tr>
        <td align="right" class="form_text">วันที่เริ่ม :</td>
        <td align="left"><input type="text" name="sem_start_date" id="sem_start_date" style="width: 100px; height:13px" class="input_text"/>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วันที่เสร็จสิ้น :
        <input type="text" name="sem_end_date" id="sem_end_date" style="width: 100px; height:13px" class="form_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">สถานที่ :</td>
        <td align="left"><input type="text" name="sem_place" id="sem_place" style="width: 100px; height:13px" class="input_text"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ประเทศ :</td>
        <td align="left">

        <input name="sem_country" class="input_text" id="sem_country" style="width: 150px; height:13px" />
        </td>
      </tr>
     
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
       <tr>
       <td align="right" >
        <img name="pic_save" id="pic_save" src="images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        </td>
        <td align="left">
        <img name="pic_cancel" id="pic_cancel" src="images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="images/active_default/cancel_active_buttons_03.png" border="0" onclick="document.getElementById('seminar').reset()" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:50px; color:#06C">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    <div id="seminar_list">
    <table width="98%"  border="0" align="center"  bgcolor="#E3F0F9" >
    <tr align="center" bgcolor="#2B96E8" class="text_th">
    	<td width="6%" style="color:#FFFFFF;">แก้ไข</td>
        <td width="6%" style="color:#FFFFFF;">ลำดับ</td>
        <td width="24%" style="color:#FFFFFF;">ชื่อหลักสูตร</td>
        <td width="16%" style="color:#FFFFFF;">ประเภท</td>
        <td width="18%" style="color:#FFFFFF;">วันที่เริ่ม - เสร็จสิ้น</td>
        <td width="26%" style="color:#FFFFFF;">สถานที่</td>
        <td width="4%" style="color:#FFFFFF;">ลบ</td>
    </tr>
    <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
    </tr>
     <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
    </tr>
     <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
    </tr>
     <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
    </tr>
     <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="left" class="text_td text_data"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
        <td align="center" class="text_td"><div id=""></div></td>
    </tr>
    </table>
    </div>
    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>

    
  </td>
  </tr>  
</table>