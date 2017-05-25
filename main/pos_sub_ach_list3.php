<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
?>
<div>
    * ประเภทผลงาน 
   <select id="va_type3" name="va_type3" onchange="change_inner_form(this.value,'3')">
   <option value="">--เลือกข้อมูล--</option>
                    <option value="1">เอกสารประกอบการสอน</option>
                    <option value="2">ตำรา</option>
                    <option value="3">หนังสือ</option>
                    <option value="4">งานวิจัย</option>
                    <option value="5">บทความ</option>
                    <option value="6">ผลงานทางวิชาการลักษณะอื่นๆ</option>
   </select>
<br /><br />
 <div id="pos_ach_form3" align="center"><span id="waiting_ach3"></span></div>
</div>
<table width="629"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center" class="text_th">
    	
        <td width="35" class="text_tr">ลำดับ</td>
        <td width="191"  class="text_tr">ประเภทผลงาน</td>
        <td width="327"  class="text_tr">ชื่อผลงาน</td>
        <td width="35"  class="text_tr">แก้ไข</td>
        <td width="19"  class="text_tr">ลบ</td>
    </tr>
    <?
	$id = 1;
    $sql = "SELECT * FROM  SDU_POSSUB_ACH1_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY COURSE_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">เอกสารประกอบการสอน</td>
        <td align="left" class="text_td text_data"><?=$row["COURSE_NAME"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form1('<?=$row["ID"]?>','<?=$row["COURSE_NAME"]?>','<?=$row["COURSE_YEAR"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH1_TAB')"/></td>
    </tr>
    <?
	$id++;
	}
	
    $sql = "SELECT * FROM  SDU_POSSUB_ACH2_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY PRESS_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">ตำรา</td>
        <td align="left" class="text_td text_data"><?=$row["TBOOK_NAME_TH"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form2('<?=$row["ID"]?>','<?=$row["TBOOK_NAME_TH"]?>','<?=$row["TBOOK_NAME_EN"]?>','<?=$row["TBOOK_NAME_OTH"]?>','<?=$row["TBOOK_NAME_OTH2"]?>','<?=$row["COURSE_NAME"]?>','<?=$row["EDITION"]?>','<?=$row["VOLUME"]?>','<?=$row["PRESS_NAME"]?>','<?=$row["PRESS_COUNTRY"]?>','<?=$row["PRESS_YEAR"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH2_TAB')"/></td>
    </tr>
    <?
	$id++;
	}
	
	 $sql = "SELECT * FROM  SDU_POSSUB_ACH3_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY PRESS_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">หนังสือ</td>
        <td align="left" class="text_td text_data"><?=$row["BOOK_NAME_TH"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form3('<?=$row["ID"]?>','<?=$row["BOOK_NAME_TH"]?>','<?=$row["BOOK_NAME_EN"]?>','<?=$row["BOOK_NAME_OTH"]?>','<?=$row["BOOK_NAME_OTH2"]?>','<?=$row["EDITION"]?>','<?=$row["VOLUME"]?>','<?=$row["PRESS_NAME"]?>','<?=$row["PRESS_COUNTRY"]?>','<?=$row["PRESS_YEAR"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH3_TAB')"/></td>
    </tr>
    <?
	$id++;
	}
	
	$sql = "SELECT * FROM  SDU_POSSUB_ACH4_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY PRESS_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">งานวิจัย</td>
        <td align="left" class="text_td text_data"><?=$row["RESEARCH_NAME_TH"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form4('<?=$row["ID"]?>','<?=$row["RESEARCH_NAME_TH"]?>','<?=$row["RESEARCH_NAME_EN"]?>','<?=$row["RESEARCH_NAME_OTH"]?>','<?=$row["RESEARCH_NAME_OTH2"]?>','<?=$row["RESEARCH_NAME2_TH"]?>','<?=$row["RESEARCH_NAME2_EN"]?>','<?=$row["RESEARCH_NAME2_OTH"]?>','<?=$row["RESEARCH_NAME2_OTH2"]?>','<?=$row["WRITER"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','<?=$row["DISTRIBUTE_LEVEL"]?>','<?=$row["JOURNAL_NAME"]?>','<?=$row["V_I_N_P"]?>','<?=$row["PRESS_YEAR"]?>','<?=$row["MEETING_DISTRIBUTE_LEVEL"]?>','<?=$row["MEETING_NAME"]?>','<?=$row["MEETING_COUNTRY"]?>','<?=$row["MEETING_MONTH"]?>','<?=$row["MEETING_YEAR"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH4_TAB')"/></td>
    </tr>
    <?
	$id++;
	}
	
	$sql = "SELECT * FROM  SDU_POSSUB_ACH5_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY PRESS_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">บทความ</td>
        <td align="left" class="text_td text_data"><?=$row["ARTICLE_NAME_TH"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form5('<?=$row["ID"]?>','<?=$row["ARTICLE_NAME_TH"]?>','<?=$row["ARTICLE_NAME_EN"]?>','<?=$row["ARTICLE_NAME_OTH"]?>','<?=$row["ARTICLE_NAME_OTH2"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','<?=$row["DISTRIBUTE_JOURNAL_LEVEL"]?>','<?=$row["JOURNAL_NAME"]?>','<?=$row["WRITER"]?>','<?=$row["V_I_N_P"]?>','<?=$row["PRESS_YEAR"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH5_TAB')"/></td>
    </tr>
    <?
	$id++;
	}

	$sql = "SELECT * FROM  SDU_POSSUB_ACH6_TAB  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '3' ORDER BY ACHEIVE_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data">ผลงานทางวิชาการลักษณะอื่นๆ</td>
        <td align="left" class="text_td text_data"><?=$row["ACHEIVE_NAME_TH"]?></td>
        <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="load_sub_edit_form6('<?=$row["ID"]?>','<?=$row["ACHEIVE_TYPE"]?>','<?=$row["ACHEIVE_NAME_TH"]?>','<?=$row["ACHEIVE_NAME_EN"]?>','<?=$row["ACHEIVE_NAME_OTH"]?>','<?=$row["ACHEIVE_NAME_OTH2"]?>','<?=$row["ACHEIVE_YEAR"]?>','<?=$row["TYPE"]?>','<?=$row["COOP"]?>','<?=$row["PROPORTION"]?>','3','แก้ไข')"/></td>
        <td align="center" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sub_ach('3','<?=$row["ID"]?>','SDU_POSSUB_ACH6_TAB')"/></td>
    </tr>
    <?
	$id++;
	}

	oci_free_statement($stid);
 	 ?>
    </table>
    <? 
	$db->closedb($conn);
	?>