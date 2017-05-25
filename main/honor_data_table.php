<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_HONOR_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>

<table width="90%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
   
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="50%" class="text_tr">ชื่อรางวัลประกาศเกียรติคุณ </td>
        <td width="21%" class="text_tr">ปี พ.ศ. ที่ได้รับ</td>
        <td width="9%" class="text_tr">ไฟล์แนบ</td>
         <?php
	if($_SESSION['USER_TYPE'] != 'user') {
	?>
    	<td width="11%" class="text_tr">แก้ไข/แสดง</td>
    <?php
	}
	?>
         <?php
	if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') {
	?>
        <td width="5%" class="text_tr">ลบ</td>
    </tr>
    <?php
	}
	?>

    <?
   
    $sql = "SELECT * FROM  ".TB_HONOR_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY HON_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
  
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["HON_NAME"]?></td>
        <td align="center" class="text_td"><?=$row["HON_YEAR"]?></td>
        <td align="center" class="text_td">
        <? if($row["HON_FILE"] != ""){?><img src="../images/macosx100.png" height="20" border="0" title="<?=$row["HON_FILE"]?>" class="vtip" onclick="window.open('files/hon_file/<?=$row["HON_FILE"]?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		<? }?>
        </td>
          <?php
	if($_SESSION['USER_TYPE'] != 'user') {
	?>
    	<td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_honor('<?=$id?>')"/>
		</td>
        <?php
	}
	?>
        <?php
	if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') {
	?>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_honor('<?=$row["HON_ID"]?>','<?=$row["HON_FILE"]?>')"/>
        </td>
        <?php
	}
	?>
    </tr>
    <div style="display:none">
    <div id="hon_id<?=$id?>"><?=$row["HON_ID"]?></div>
    <div id="hon_name<?=$id?>"><?=$row["HON_NAME"]?></div>
    <div id="hon_year<?=$id?>"><?=$row["HON_YEAR"]?></div>
    <div id="hon_from<?=$id?>"><?=$row["HON_FROM"]?></div>
     <div id="hon_file<?=$id?>"><?=$row["HON_FILE"]?></div>
    </div>
    <?
	$id++;
}
 	 ?>
    </table>
<br />
    <? } 
	
	$db->closedb($conn);	
	?>