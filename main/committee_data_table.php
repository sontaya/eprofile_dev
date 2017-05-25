<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_COMMITTEE_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    	
        <td width="6%" class="text_tr">ลำดับ</td>
        <td width="30%" class="text_tr">ชื่อหน่วยงานภายนอก/สถาบันการศึกษา</td>
        <td width="29%" class="text_tr">วันที่เริ่ม - เสร็จสิ้น</td>
        <td width="17%" class="text_tr">เอกสารประกอบ</td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td width="10%" class="text_tr">แก้ไข/แสดง</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="8%" class="text_tr">ลบ</td>
        <?php } ?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_COMMITTEE_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY COM_ID ASC"; 
	$id = 1;	
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];
	?>
    <tr align="center" height="20" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["COM_ORG_NAME"]?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["COM_START_DATE"])?> ถึง <?=change_date_thai($row["COM_END_DATE"])?></td>
        <td align="center" valign="middle" class="text_td">
        <?php
			if($row["COM_FILE"] == '') {
				echo "&nbsp;";
				$file = "";
			}
			else {
				$file = "<img src='../images/macosx100.png' border='0' height='20' border='0' title='Document' alt='Document'>";
		?>
        <a href="files/committee_file/<?=$row["COM_FILE"]?>" target="_blank">
        <? echo "<img src='../images/macosx100.png' border='0' height='20' border='0' title='".$row["COM_FILE"]."' class='vtip'>";?>
        </a>
        <?php
			}
		?>
        </td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_committee('<?=$id?>')"/>
		</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_committee('<?=$row["COM_ID"]?>','<?=$row["COM_FILE"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="com_id<?=$id?>"><?=$row["COM_ID"]?></div>
    <div id="com_order_no<?=$id?>"><?=$row["COM_ORDER_NO"]?></div>
    <div id="com_org_name<?=$id?>"><?=$row["COM_ORG_NAME"]?></div>
    <div id="com_type<?=$id?>"><?=$row["COM_TYPE"]?></div>
    <div id="com_start_date<?=$id?>"><?=change_date_thai($row["COM_START_DATE"]);?></div>
    <div id="com_end_date<?=$id?>"><?=change_date_thai($row["COM_END_DATE"]);?></div>
    <div id="com_place<?=$id?>"><?=$row["COM_PLACE"]?></div>
    <div id="com_country<?=$id?>"><?=$row["COM_COUNTRY"]?></div>
    <div id="com_level<?=$id?>"><?=$row["COM_LEVEL"]?></div>
    <div id="com_file<?=$id?>"><?=$file?></div>
    <div id="com_filename<?=$id?>"><?=$row["COM_FILE"]?></div>
    <div id="com_order_type<?=$id?>"><?=$row["COM_ORDER_TYPE"]?></div>
    <div id="com_student_name<?=$id?>"><?=$row["COM_STUDENT_NAME"]?></div>
    <div id="com_degree<?=$id?>"><?=$row["COM_DEGREE"]?></div>
    <div id="com_year<?=$id?>"><?=$row["COM_YEAR"]?></div>
    <div id="com_topic<?=$id?>"><?=$row["COM_TOPIC"]?></div>
    <div id="com_curriculum<?=$id?>"><?=$row["COM_CURRICULUM"]?></div>
    </div>
    <?
	$id++;
}
 	 ?>
    </table>
    <div id="debugg" style=" display:none;border:1px solid #F00;">&nbsp;</div>
<br />
    <? } 
	
	$db->closedb($conn);	
	?>