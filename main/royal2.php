<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<? }
?>
<script type="text/javascript" language="javascript">
  function check_data(){
    if($("#roy_year").val() == "" || $("#roy_name").val() == "" ){
      $("#Please_fill_in").dialog('open');
      return false;
    }

	
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("royal").submit();
  }

  $(function() {
	    
        
    $.post("ajax_get_data_ref.php", { task: "royallist" },
    function(data) {
      royal = $.parseJSON(data);
      $("#roy_name").autocomplete({
        source: royal
      });
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
  });
</script>
<table cellpadding="0" cellspacing="0" align="center" width="758">
  <tr><td >    
      <div id="royal_list" align="center" class="data_details_list">
        <? include "royal_data_table.php"; ?>
      </div>
      <? if ($_SESSION["USER_TYPE"] == "admin" || $_SESSION['USER_TYPE'] == 'hr') { ?>
        <div align="center"  id="toggle_form"><?php if ($_SESSION['USER_TYPE'] != 'user') { ?><img src="../images/add.png" onclick="toggle_form('royal','roy_id')" style="cursor:pointer"/><?php } ?></div>
        <div id="data_form" style="display:none;"> 

          <img src="../images/bg_d.png" style="margin-left:10px;" />

          <table  cellspacing="0" cellpadding="0" align="center" >
            <tr>
              <td><form id="royal" name="royal" method="post" action="royal_data_save.php" target="upload_target">
                  <table width="758" border="0" cellspacing="4" cellpadding="4">
                    <tr>
                      <td width="126" align="right" class="form_text">* ปี พ.ศ. ที่ได้รับ :</td>
                      <td width="604" align="left">
                        <select id="roy_year" name="roy_year">
                          <option value="">เลือก</option>
                          <?
                          $year = date("Y") + 543;
                          for ($i = 0; $i < 70; $i++) {
                            $y = $year - $i;
                            if ($_POST["press_year"] == $y) {
                              $txt = "selected = 'selected'";
                            } else { $txt = ""; }
                            echo "<option value='$y' $txt>$y</option>\n";
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" class="form_text"> เล่มที่  :</td>
                      <td align="left">
                        <input type="text" name="roy_no1" id="roy_no1" style="width: 40px;" class="input_text"/>
                        &nbsp;&nbsp; ตอนที่ :  
                        <input type="text" name="roy_no2" id="roy_no2" style="width: 40px;" class="input_text"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" class="form_text">* ชั้นของเครื่องราชฯ  :</td>
                      <td align="left">
                        <input type="text" name="roy_name" id="roy_name" style="width: 300px;" class="input_text"/>
                        <input type="hidden" id="roy_id" name="roy_id" value="" /></td>
                    </tr>
                    <tr>
                      <td align="right" >อยู่ที่เจ้าตัว : </td>
                      <td align="left"><input type="radio" id="roy_own" name="roy_own" value="1"  checked="checked" />ใช่ <input type="radio" id="roy_own" name="roy_own" value="0"  />ไม่ใช่</td>
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
                        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('royal.php','../images/head2/work_data/royal.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
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
        <?
      }
      ?>

    </td>
  </tr>  
</table>