<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SEMINAR_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="10%" class="text_tr">เลขที่คำสั่ง</td>
        <td width="27%" class="text_tr">ชื่อหลักสูตร</td>
        <td width="23%" class="text_tr">วันที่เริ่ม - เสร็จสิ้น</td>
        <td width="28%" class="text_tr">สถานที่</td>
        <td width="5%" class="text_tr">ไฟล์</td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="11%" class="text_tr">แก้ไข/แสดง</td>
        <?php
	}
		?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="2%" class="text_tr">ลบ</td>
        <?php
	}
		?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_SEMINAR_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY SEM_START_DATE DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id=1;
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	$sem_id = $row["ID"];
	?>
    <tr align="center" height="22" valign="top">
   
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["SEM_ORDER_NO"]?></td>
        <td align="left" class="text_td text_data"><?=$row["SEM_COURSE_NAME"]?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["SEM_START_DATE"])?> ถึง <?=change_date_thai($row["SEM_END_DATE"])?></td>
        <td align="left" class="text_td text_data"><?=$row["SEM_PLACE"]?></td>
        <td width="5%" align="center" valign="middle" class="text_td"><? if($row["SEM_FILE"] != ""){?><img src="../images/macosx100.png" title="<?=$row["SEM_FILE"]?>" class="vtip" height="20" border="0" alt="Document" onclick="window.open('files/sem_data_file/<?=$row["SEM_FILE"]?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer;" /><? }?></td>
        
         <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_seminar('<?=$id?>')"/>
		</td>
        <?php
	}
		?>
        
         <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="2%" align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_seminar('<?=$sem_id?>','<?=$row["SEM_FILE"]?>')"/>
        </td>
        <?php
	}
		?>
    </tr>
    <div style="display:none">
    <div id="sem_id<?=$id?>"><?=$sem_id?></div>
    <div id="sem_order_no<?=$id?>"><?=$row["SEM_ORDER_NO"]?></div>
    <div id="sem_who_name<?=$id?>"><?=$row["SEM_WHO_NAME"]?></div>
    <div id="sem_who_position<?=$id?>"><?=$row["SEM_WHO_POSITION"]?></div>
    <div id="sem_depart<?=$id?>"><?=$row["SEM_DEPART"]?></div>
    <div id="sem_type<?=$id?>"><?=$row["SEM_TYPE"]?></div>
    <div id="sem_course_name<?=$id?>"><?=$row["SEM_COURSE_NAME"]?></div>
    <div id="sem_start_date<?=$id?>"><?=change_date_thai($row["SEM_START_DATE"])?></div>
    <div id="sem_end_date<?=$id?>"><?=change_date_thai($row["SEM_END_DATE"])?></div>
    <div id="sem_long<?=$id?>"><?=$row["SEM_LONG"]?></div>
    <div id="sem_place<?=$id?>"><?=$row["SEM_PLACE"]?></div>
    <div id="sem_by<?=$id?>"><?=$row["SEM_BY"]?></div>
    <div id="sem_point<?=$id?>"><?=$row["SEM_POINT"]?></div>
    <div id="sem_expense<?=$id?>"><?=$row["SEM_EXPENSE"]?></div>
    <div id="sem_free_expense<?=$id?>"><?=$row["SEM_FREE_EXPENSE"]?></div>
    <div id="sem_expenses<?=$id?>"><?=$row["SEM_EXPENSES"]?></div>
    <div id="sem_money_type<?=$id?>"><?=$row["SEM_MONEY_TYPE"]?></div>
    <div id="sem_benefit<?=$id?>"><?=$row["SEM_BENEFIT"]?></div>
    <div id="sem_improve<?=$id?>"><?=$row["SEM_IMPROVE"]?></div>
    <div id="sem_suggestion<?=$id?>"><?=$row["SEM_SUGGESTION"]?></div>
    <div id="sem_chief_adv<?=$id?>"><?=$row["SEM_CHIEF_ADV"]?></div>
    <div id="sem_chief<?=$id?>"><?=$row["SEM_CHIEF"]?></div>
    <div id="sem_file<?=$id?>"><?=$row["SEM_FILE"]?></div>
    </div>
    <?
	$id++;
}
 	 ?>
    </table>
    <br />
    <? } 
	//oci_free_statement($stid);
	?>