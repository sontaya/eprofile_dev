<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_WORK_HISTORY_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
  
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="25%" class="text_tr">สถานที่ทำงาน</td>
        <td width="28%" class="text_tr">ตำแหน่ง</td>
        <td width="31%" class="text_tr">หน่วยงาน/ฝ่าย/แผนก</td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td width="10%" class="text_tr">แก้ไข/แสดง</td>
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
   
    $sql = "SELECT * FROM  ".TB_WORK_HISTORY_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];
	list($m,$d,$y) = explode("-",$row["WRK_LONG"]);
	list($a1,$p1) = explode("-",$row["WRK_PHONE"]);
	list($a2,$p2) = explode("-",$row["WRK_FAX"]);


	?>
    <tr align="center" height="20" valign="top">
   
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["WRK_WORK_PLACE"]?></td>
        <td align="left" class="text_td text_data"><?=$row["WRK_POSITION"]?></td>
        <td align="left" class="text_td text_data"><?=$row["WRK_DEPART"]?></td>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
    	<td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_wrk('<?=$id?>')"/>
		</td>
         <?php
	}
		?>
        <?php if($_SESSION['USER_TYPE'] != 'chief' || $_SESSION['EMP_ID'] == $_SESSION['USER_EMP_ID']) { ?>
        <td align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_wrk('<?=$row["WRK_ID"]?>')"/>
        </td>
                 <?php
	}
		?>

    </tr>
    <div style="display:none">
    <div id="wrk_id<?=$id?>"><?=$row["WRK_ID"]?></div>
    <div id="wrk_work_place<?=$id?>"><?=$row["WRK_WORK_PLACE"]?></div>
    <div id="wrk_position<?=$id?>"><?=$row["WRK_POSITION"]?></div>
    <div id="wrk_depart<?=$id?>"><?=$row["WRK_DEPART"]?></div>
    <div id="wrk_responsibility<?=$id?>"><?=$row["WRK_RESPONSIBILITY"]?></div>
    <div id="wrk_long<?=$id?>"><?=$row["WRK_LONG"]?></div>
    <div id="wrk_loc<?=$id?>"><?=$row["WRK_LOC"]?></div>
    <div id="wrk_phone<?=$id?>"><?=$row["WRK_PHONE"]?></div>
    <div id="wrk_fax<?=$id?>"><?=$row["WRK_FAX"]?></div>
    </div>
    <?
	$id++;
}
oci_free_statement($stid);
 	 ?>
    </table>
    <br />
    <? } 
	
	$db->closedb($conn);	
	?>