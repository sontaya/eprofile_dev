<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ต่อสัญญา</title>
<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<link href="../css/calendar-mos.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="../jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
<script src="../js/myAjax.js" type="text/javascript"></script>
<script src="../js/calendar.js" type="text/javascript"></script>
<script type="text/javascript">	

	
	function check_data() {
		var contract_no = $('#contract_no').val();  // เลขที่สัญญา
		var contract_period = $('#contract_period').val(); // สัญญาระยะที่
		var contract_year = $('#contract_year').val(); // จำนวนปี
		var contract_position = $('#contract_position').val(); // ตำแหน่งปัจจุบัน
		var contract_start = $('#contract_start').val(); // วันเริ่มสัญญา
		var contract_finish = $('#contract_finish').val(); // วันสิ้นสุดสัญญา
		if(contract_no == "" || contract_period == "" || contract_year == "" || contract_position == "" || contract_start == "") {
			$('#Please_fill_in').dialog('open');
			return false;
		}
		else {
			//$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
			document.getElementById("contract").submit();
			//change_data('contract_history.php','../images/head2/work_data2/contract_history.png'); // 2010-10-20
			//reload_data_table();
		}
	}
	
	
	
		$(function() {
	
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
</head>

<body>
<?
include "../includes/connect.php";
?>
<h2 align="center">ต่อสัญญา <?=get_name($_REQUEST['emp_id'],TB_BIODATA_TAB)?></h2>
<table width="758" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <form id="contract" name="contract" method="post" action="contract_data_save2.php" enctype="multipart/form-data">
    <table width="781" border="0" cellspacing="4" cellpadding="4">
    <tr>
        <td align="right" class="form_text">* เลขที่สัญญาใหม่ :</td>
        <td align="left"><input type="text" class="input_text" name="contract_no" id="contract_no"/>
        <input type="hidden" id="emp_id" name="emp_id" value="<?=$_REQUEST['emp_id']?>" />
        <input type="hidden" id="b_contract_no" name="b_contract_no" value="<?=$_REQUEST['b_contract_no']?>" />
        </td>
      </tr>
    <tr>
        <td width="310" align="right" class="form_text">* สัญญาระยะที่ :</td>
        <td width="443" align="left"><input type="text" class="input_text" name="contract_period" id="contract_period"/>  จำนวนปี : <input type="text" class="input_text" name="contract_year" /></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ตำแหน่งปัจจุบัน :</td>
        <td align="left">
        	<input type="radio" name="contract_position" value="1" checked="checked"> เจ้าหน้าที่  <input type="radio" name="contract_position" value="2"> อาจารย์  <input type="radio" name="contract_position" value="3"> ผศ. <input type="radio" name="contract_position" value="4"> รศ. <input type="radio" name="contract_position" value="5"> ศ. <input type="radio" name="contract_position" value="6"> ที่ปรึกษา<input type="radio" name="contract_position" value="7"> ครู <input type="radio" name="contract_position" value="8"> ผู้บริหาร
        </td>
      </tr>
        
        <tr>
        <td width="200" align="right" class="form_text">* ตําเเหน่งประเภทบุคลากร<!--(สกอ.)--> :</td>
        <td width="600" align="left" colspan="3">
             <?
            $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC ";
            $stid_emp_type = oci_parse($conn, $sql_emp_type );
            oci_execute($stid_emp_type);
            $option_emp_type="<option value=''>เลือก</option>";
            while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
                if($row["CWK_MUA_EMP_TYPE"] == $row_emp_type["STAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
                    $option_emp_type .= "<option value='".$row_emp_type["STAFFTYPE_ID"]."' $select>".$row_emp_type["STAFFTYPE_NAME"]."</option>\n";
            }
            ?>
             <select name="ck_mua_emp_type" id="ck_mua_emp_type" class="widthFix2"  >
            <?=$option_emp_type?>
                    </select>
        </td>
    </tr>
        
        <tr>
        <td align="right" class="form_text">*สัญญาระยะที่</td>
        <td align="left" class="form_text">
            <input type="text" class="input_text" name="contract_period" id="contract_period" style="width:150px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนปี <input type="text" name="scorse_yer" id="scorse_yer" style="width:50px;"> ปี
         </td>
      </tr>
      <tr>
        <td align="right" class="form_text"> คำสั่งจ้าง</td>
        <td align="left" class="form_text">
            <input type="text" name="directive" id="directive" style="width:80px;">&nbsp;&nbsp;&nbsp;&nbsp;ที่ <input type="text" name="directive_no" id="directive_no" style="width:50px;">
            สั่ง ณ <input type="text" name="directive_date" id="directive_date" style="width:80px;" >&nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('directive_date','YYYY-MM-DD')" />
         </td>
      </tr>
     <tr>
        <td width="169" align="right" class="form_text"> บันทึกข้อความที่ : </td>
        <td colspan="2" align="left"><input type="text" name="sch_order_no" id="sch_order_no" style="width: 80px; " class="input_text" />
          ที่ <input type="text" id="sch_at" name="sch_at" style="width: 80px; " class="input_text"/>
          ลงวันที่ <input type="text"  name="sch_at_date" id="sch_at_date" style="width: 80px; " class="input_text" value=""> <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('sch_at_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ครั้งที่จ้าง</td>
        <td align="left" class="form_text">
            <input type="text" name="employ" id="employ" style="width:150px;" >
         </td>
      </tr>
        
        
        
        
      <tr>
        <td align="right" class="form_text">* วันเริ่มสัญญา :</td>
        <td align="left" class="form_text"><input type="text" class="input_text" id="contract_start" name="contract_start" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_start','YYYY-MM-DD')" /> </td>
      </tr>
      <tr>
        <td align="right" class="form_text"> วันสิ้นสุดสัญญา :</td>
        <td align="left" class="form_text"><input type="text" class="input_text" id="contract_finish" name="contract_finish" /> <img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('contract_finish','YYYY-MM-DD')" /> </td>
      </tr>
      <tr>
        <td align="right" class="form_text">เซ็นสัญญากับมหาวิทยาลัยเมื่ออายุมากกว่า 60 ปี : </td>
        <td align="left" class="form_text"><input name="contract_m60" type="radio" value="0" checked="checked"> ไม่ใช่ <input type="radio" name="contract_m60" value="1"> ใช่</td>
      </tr>
        
     <tr>
        <td align="right" class="form_text">&nbsp;</td>
        <td align="left" class="form_text">
            <input type="checkbox" name="secret_document" id="secret_document" value="1">รับเอกสารคู่ฉบับสัญญาจ้างแล้ว &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            เมื่อวันที่ <input type="text" name="document_date" id="document_date" style="width:80px;">&nbsp;&nbsp;<img src="../images/vcalendar.png" align="absmiddle" style="cursor:pointer" onclick="showCalendar('document_date','YYYY-MM-DD')" />
         </td>
      </tr>
      <tr>
        <td align="right" class="form_text">&nbsp;</td>
        <td align="left" class="form_text">
           <input type="radio" name="secret_b" id="secret_b" value="1">รับรองเอง &nbsp;&nbsp;&nbsp;<input type="radio" name="secret_b" id="secret_b"value="2" >ผู้รับเเทน&nbsp;&nbsp;<input type="text" name="secret_name" id="secret_name" style="width:150px;" >
         </td>
      </tr>
        
        <tr>
        <input name="one_files_h" type="hidden" id="one_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารคำสั่งจ้าง</td>
        <td width="" align="left">
            <input class="files" name="one_files" type="file" >
            <div class="contents"></div>
        </td>
    </tr>
    <tr>
        <input name="two_files_h" type="hidden" id="two_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารบันทึกข้อความ</td>
        <td width="" align="left">
            <input class="files" name="two_files" type="file" >
            <div class="contents"></div>
        </td>
    </tr>
    <tr>
        <input name="tree_files_h" type="hidden" id="tree_files_h">
        <td width="" align="right" class="form_text" valign= "top">แนบเอกสารสัญญาจ้าง</td>
        <td width="" align="left">
            <input class="files" name="tree_files" type="file" >
            <div class="contents2"></div>
        </td>
    </tr>
        
      <tr>
        <td align="right" class="form_text" valign="top">หมายเหตุ :</td>
        <td align="left"><textarea name="contract_comment" style="width: 250px"></textarea></td>
      </tr>
      <tr>
        <td align="right" >&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
          
       <tr>
        <td height="44" align="right" valign="top" >
        <img name="pic_save2" id="pic_save2" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer;"  onclick="javascript: return check_data();"/>
        </td>
        <td colspan="2" align="left" valign="top">
        <img name="pic_cancel2" id="pic_cancel2" src="../images/default_button/cancel_default_buttons_03.png" border="0" style="cursor:pointer; "  onclick="document.getElementById('contract').reset();document.getElementById('contract_no').readOnly = false;"/>
        </td>
      </tr>
             <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
</table>

<iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;border:0px solid #fff;display:none;" ></iframe> 
<div id="Please_fill_in" title="Please fill in" style="display:none">
	<p>
		กรุณากรอกข้อมูล * ให้ครบ
	</p>
</div>
</body>
</html>