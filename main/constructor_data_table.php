<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_CONSTRUCTOR_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
   
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="28%" class="text_tr">ชื่อหลักสูตร</td>
        <td width="24%" class="text_tr">วันที่เริ่ม - เสร็จสิ้น</td>
        <td width="24%" class="text_tr">สถานที่</td>
        <td width="7%" class="text_tr">ไฟล์แนบ</td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td width="10%" class="text_tr">แก้ไข/แสดง</td>
   		<?php
		}
		?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="3%" class="text_tr">ลบ</td>
    <?php
	}
	?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_CONSTRUCTOR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY CON_ID ASC"; 
	$id = 1;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
   
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["CON_COURSE_NAME"]?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["CON_START_DATE"])?> ถึง <?=change_date_thai($row["CON_END_DATE"])?></td>
        <td align="left" class="text_td text_data"><?=$row["CON_PLACE"]?></td>
        <td align="center" valign="middle" class="text_td">
        <?php
			if($row["CON_FILE"] == '') {
				echo "&nbsp;";
				$file = "";
			}
			else {
				$file = "<img src='../images/macosx100.png' border='0' height='20' border='0' title='Document' alt='Document'>";
		?>
        <a href="files/constructor_file/<?=$row["CON_FILE"]?>" target="_blank">
		<? echo "<img src='../images/macosx100.png' border='0' height='20' border='0' title='".$row["CON_FILE"]."' class='vtip'>";?>
        </a>
        <?php
			}
		?>
        </td>
         <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip"  onclick="edit_constructor('<?=$id?>')"/>
		</td>
        <?php
		}
		?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip"  onclick="del_constructor('<?=$row["CON_ID"]?>','<?=$row["CON_FILE"]?>')"/>
        </td>
        <?php
	}
	?>
    </tr>
    <div style="display:none">
    <div id="con_id<?=$id?>"><?=$row["CON_ID"]?></div>
    <div id="con_order_no<?=$id?>"><?=$row["CON_ORDER_NO"]?></div>
    <div id="con_course_name<?=$id?>"><?=$row["CON_COURSE_NAME"]?></div>
    <div id="con_type<?=$id?>"><?=$row["CON_TYPE"]?></div>
    <div id="con_start_date<?=$id?>"><?=change_date_thai($row["CON_START_DATE"]);?></div>
    <div id="con_end_date<?=$id?>"><?=change_date_thai($row["CON_END_DATE"]);?></div>
    <div id="con_place<?=$id?>"><?=$row["CON_PLACE"]?></div>
    <div id="con_detail<?=$id?>"><?=$row["CON_DETAIL"]?></div>
    <div id="con_country<?=$id?>"><?=$row["CON_COUNTRY"]?></div>
    <div id="con_level<?=$id?>"><?=$row["CON_LEVEL"]?></div>
    <div id="con_file<?=$id?>"><?=$file?></div>
    <div id="con_filename<?=$id?>"><?=$row["CON_FILE"]?></div>
    </div>
    <?
	$id++;
}
 	 ?>
    </table>
        <div id="debugg" style="display:none;border:1px solid #F00;">&nbsp;</div>
<br />
    <? } 
	
	$db->closedb($conn);	
	?>