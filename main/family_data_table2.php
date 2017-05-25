<?
@session_start();
 	$fpath = '';
	require_once($fpath."includes/connect.php");
	$res = $db->select_query("SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  EMP_ID = ".$_SESSION["EMP_ID"].""); 
	$numrow = $db->num_row($res);
	if($numrow >0){
?>
<table width="98%"  border="0" align="center"  bgcolor="#E3F0F9" >
    <tr align="center" bgcolor="#2B96E8" class="text_th">
    	<td width="6%" style="color:#FFFFFF; ">แก้ไข/แสดง</td>
        <td width="13%" style="color:#FFFFFF;">ความสัมพันธ์</td>
        <td width="23%" style="color:#FFFFFF;">ชื่อ - นามสกุล</td>
        <td width="6%" style="color:#FFFFFF;">อายุ</td>
        <td width="15%" style="color:#FFFFFF;">สัญชาติ</td>
        <td width="23%" style="color:#FFFFFF;">อาชีพ</td>
        <td width="11%" style="color:#FFFFFF;">ไฟล์เอกสาร</td>
        <td width="3%" style="color:#FFFFFF;">ลบ</td>
    </tr>
    <?
	function relation($rel){
		switch($rel){
		case "1": $returntxt = "บิดา";
		break;
		case "2": $returntxt = "มารดา";
		break;
		case "3": $returntxt = "คู่สมรส";
		break;
		}
		return $returntxt;
	}
   
	$res = $db->select_query("SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  EMP_ID = ".$_SESSION["EMP_ID"]." AND fam_relation = '1'"); 
	$row = $db->fetch($res);
	$numrow = $db->num_row($res);
	if($row["fam_birthday"] == "0000-00-00" or $numrow == 0){
		$age =  "";
	}else{
		$age = birthday($row["fam_birthday"]);
		$age = $age[0]." ปี";
	}
	?>
    <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td" valign="middle"><div id="edit_fam1">
		<? if($numrow >0){?><img src="images/b_edit.png" height="15" border="0" style="cursor:pointer" onclick="edit_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>')"/>
		<? }?></div></td>
        <td align="center" class="text_td"><div id="fam_relation1"><?=relation($row["fam_relation"])?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_name1"><?=$row["fam_fname_th"]?> <?=$row["fam_lname_th"]?></div></td>
        <td align="center" class="text_td"><div id="fam_age1"><?=$age?> </div></td>
        <td align="center" class="text_td"><div id="fam_nation1"><?=$row["fam_nation2"]?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_occupation1"><?=$row["fam_occupation"]?></div></td>
        <td align="center" valign="middle" class="text_td text_data"><div id="fam_data_file1">
		<? if($row["fam_cen_file"] != ""){?><img src="images/macosx100.png" height="20" border="0" onclick="window.open('files/fam_data_file/<?=$row["fam_cen_file"]?>','<?=$row["fam_relation"]?>','height=600,width=500')" style="cursor:pointer"/>
		<? }?></div></td>
        <td align="center" class="text_td" valign="middle"><div id="del_fam1">
		<? if($numrow >0){?><img src="images/b_del.png" height="15" border="0" style="cursor:pointer" onclick="del_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>','<?=$row["fam_cen_file"]?>')"/>
		<? }?>
        </div>
        </td>
    </tr>
    
    <?
 	 $res = $db->select_query("SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  emp_id = ".$_SESSION["EMP_ID"]." AND fam_relation = '2'"); 
	$row = $db->fetch($res);
	$numrow = $db->num_row($res);
	if($row["fam_birthday"] == "0000-00-00" or $numrow == 0){
		$age =  "";
	}else{
		$age = birthday($row["fam_birthday"]);
		$age = $age[0]." ปี";
	}
	?>
    <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td" valign="middle"><div id="edit_fam2">
		<? if($numrow >0){?><img src="images/b_edit.png" height="15" border="0" style="cursor:pointer" onclick="edit_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>')"/>
		<? }?></div></td>
        <td align="center" class="text_td"><div id="fam_relation2"><?=relation($row["fam_relation"])?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_name2"><?=$row["fam_fname_th"]?> <?=$row["fam_lname_th"]?></div></td>
        <td align="center" class="text_td"><div id="fam_age2"><?=$age?></div></td>
        <td align="center" class="text_td"><div id="fam_nation2"><?=$row["fam_nation2"]?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_occupation2"><?=$row["fam_occupation"]?></div></td>
        <td align="center" valign="middle" class="text_td text_data"><div id="fam_data_file2">
		<? if($row["fam_cen_file"] != ""){?><img src="images/macosx100.png" height="20" border="0" onclick="window.open('files/fam_data_file/<?=$row["fam_cen_file"]?>','<?=$row["fam_relation"]?>','height=600,width=500')" style="cursor:pointer"/>
		<? }?></div></td>
        <td align="center" class="text_td" valign="middle"><div id="del_fam2">
		<? if($numrow >0){?><img src="images/b_del.png" height="15" border="0" style="cursor:pointer" onclick="del_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>','<?=$row["fam_cen_file"]?>')"/>
		<? }?>
        </div>
        </td>
    </tr>
    
    <?
    $res = $db->select_query("SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  emp_id = ".$_SESSION["EMP_ID"]." AND fam_relation = '3'"); 
	$row = $db->fetch($res);
	$numrow = $db->num_row($res);
	if($row["fam_birthday"] == "0000-00-00" or $numrow == 0){
		$age =  "";
	}else{
		$age = birthday($row["fam_birthday"]);
		$age = $age[0]." ปี";
	}
	?>
    <tr align="center" height="22" valign="top">
    	<td align="center" class="text_td" valign="middle"><div id="edit_fam3">
		<? if($numrow >0){?><img src="images/b_edit.png" height="15" border="0" style="cursor:pointer" onclick="edit_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>')"/>
		<? }?></div></td>
        <td align="center" class="text_td"><div id="fam_relation3"><?=relation($row["fam_relation"])?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_name3"><?=$row["fam_fname_th"]?> <?=$row["fam_lname_th"]?></div></td>
        <td align="center" class="text_td"><div id="fam_age3"><?=$age?></div></td>
        <td align="center" class="text_td"><div id="fam_nation3"><?=$row["fam_nation2"]?></div></td>
        <td align="center" class="text_td text_data"><div id="fam_occupation3"><?=$row["fam_occupation"]?></div></td>
        <td align="center" valign="middle" class="text_td text_data"><div id="fam_data_file3">
		<? if($row["fam_cen_file"] != ""){?><img src="images/macosx100.png" height="20" border="0" onclick="window.open('files/fam_data_file/<?=$row["fam_cen_file"]?>','<?=$row["fam_relation"]?>','height=600,width=500')" style="cursor:pointer"/>
		<? }?></div></td>
        <td align="center" class="text_td" valign="middle"><div id="del_fam3">
		<? if($numrow >0){?><img src="images/b_del.png" height="15" border="0" style="cursor:pointer" onclick="del_fam('<?=$_SESSION["EMP_ID"]?>','<?=$row["fam_relation"]?>','<?=$row["fam_cen_file"]?>')"/>
		<? }?>
        </div>
        </td>
    </tr>
    </table>
    <? } $db->closedb();?>