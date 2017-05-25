<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_CHILDREN_TAB,"  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
		
		if($_SESSION['USER_TYPE'] == 'user') { 
			$icon_img="view.png";
		}
		else{
			$icon_img="b_edit.png";
		}
	
?>
    <table width="90%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center" class="text_th">
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="28%" class="text_tr">ชื่อ - นามสกุล</td>
        <td width="7%" class="text_tr">อายุ</td>
        <td width="15%" class="text_tr">สัญชาติ</td>
        <td width="32%" class="text_tr">อาชีพ</td>
        <td width="11%" class="text_tr"><?php if($_SESSION['USER_TYPE'] == 'user') { ?>แสดงข้อมูล<?php }else { ?>แก้ไข/แสดง<?php } ?></td>
        <!--<td width="10%" class="text_tr">ไฟล์เอกสาร</td>-->
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><td width="3%" class="text_tr">ลบ</td><?php } ?>
    </tr>
    <?
	$id = 1;
    $sql = "SELECT * FROM  ".TB_CHILDREN_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY CHL_BIRTHDAY ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		
		if($row["CHL_BIRTHDAY"] == "0000-00-00" or $row["CHL_BIRTHDAY"] == "" or $row["CHL_BIRTHDAY"] == "null"){
		$age =  "";
	}else{
		$age = birthday($row["CHL_BIRTHDAY"]);
		$age = $age[0]." ปี";
	}

	$chl_mobile = $row["CHL_MOBILE"];
	$chl_work_phone = $row["CHL_WORK_PHONE"];
	$chl_phone = $row["CHL_PHONE"];
	$chl_fax = $row["CHL_FAX"];
	?>
    <tr align="center" height="22" valign="top">
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["CHL_FNAME_TH"]?> <?=$row["CHL_LNAME_TH"]?></td>
        <td align="center" class="text_td"><?=$age?></td>
        <td align="center" class="text_td"><?=get_nation_name($row["CHL_NATION2"],TB_REF_NATION)?></td>
        <td align="left" class="text_td text_data"><?=$row["CHL_OCCUPATION"]?></td>
        <td align="center" class="text_td"><img src="../images/<?=$icon_img?>" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_chl('<?=$id?>')"/></td>
       <!-- <td align="center" class="text_td">
        <? //if($row["CHL_CEN_FILE"] != ""){?><img src="../images/macosx100.png" height="20" border="0" title="Document" alt="Document" onclick="window.open('files/chl_data_file/<? //$row["CHL_CEN_FILE"]?>','<? //$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		<? // }?>
        </td>-->
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" class="text_td">
        <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_chl('<?=$_SESSION["EMP_ID"]?>','<?=$row["CHL_CODE_ID"]?>','<?=$row["CHL_CEN_FILE"]?>')"/>
        </td>
        <?php } ?>
    </tr>
     <div style="display:none">
    <div id="chl_title_th<?=$id?>"><?=$row["CHL_TITLE_TH"]?></div>
    <div id="chl_fname_th<?=$id?>"><?=$row["CHL_FNAME_TH"]?></div>
    <div id="chl_mname_th<?=$id?>"><?=$row["CHL_MNAME_TH"]?></div>
    <div id="chl_lname_th<?=$id?>"><?=$row["CHL_LNAME_TH"]?></div>
    <div id="chl_title_en<?=$id?>"><?=$row["CHL_TITLE_EN"]?></div>
    <div id="chl_fname_en<?=$id?>"><?=$row["CHL_FNAME_EN"]?></div>
    <div id="chl_mname_en<?=$id?>"><?=$row["CHL_MNAME_EN"]?></div>
    <div id="chl_lname_en<?=$id?>"><?=$row["CHL_LNAME_EN"]?></div>
    <div id="chl_sex<?=$id?>"><?=$row["CHL_SEX"]?></div>
    <div id="chl_nation1<?=$id?>"><?=$row["CHL_NATION1"]?></div>
    <div id="chl_nation2<?=$id?>"><?=$row["CHL_NATION2"]?></div>
    <div id="chl_nation_name1<?=$id?>"><?=get_nation_name($row["CHL_NATION1"],TB_REF_NATION)?></div>
    <div id="chl_nation_name2<?=$id?>"><?=get_nation_name($row["CHL_NATION2"],TB_REF_NATION)?></div>
    <div id="chl_religion<?=$id?>"><?=$row["CHL_RELIGION"]?></div>
    <div id="chl_birthday<?=$id?>"><? if($row["CHL_BIRTHDAY"] == ""){ echo "";}else{ echo change_date_thai($row["CHL_BIRTHDAY"]);}?></div>
    <div id="chl_alive<?=$id?>"><?=$row["CHL_ALIVE"]?></div>
    <div id="chl_school<?=$id?>"><?=$row["CHL_SCHOOL"]?></div>
    <div id="chl_sch_amphur<?=$id?>"><?=$row["CHL_SCH_AMPHUR"]?></div>
    <div id="chl_sch_province<?=$id?>"><?=$row["CHL_SCH_PROVINCE"]?></div>
    <div id="chl_sch_level<?=$id?>"><?=$row["CHL_SCH_LEVEL"]?></div>
    <div id="chl_code_id<?=$id?>"><?=$row["CHL_CODE_ID"]?></div>
    <div id="chl_relation<?=$id?>"><?=$row["CHL_RELATION"]?></div>
    <div id="chl_occupation<?=$id?>"><?=$row["CHL_OCCUPATION"]?></div>
    <div id="chl_work_place<?=$id?>"><?=$row["CHL_WORK_PLACE"]?></div>
    <div id="chl_mobile<?=$id?>"><?=$chl_mobile?></div>
    <div id="chl_work_phone<?=$id?>"><?=$chl_work_phone?></div>
    <div id="chl_email<?=$id?>"><?=$row["CHL_EMAIL"]?></div>
    <div id="chl_house_no<?=$id?>"><?=$row["CHL_HOUSE_NO"]?></div>
    <div id="chl_moo<?=$id?>"><?=$row["CHL_MOO"]?></div>
    <div id="chl_building<?=$id?>"><?=$row["CHL_BUILDING"]?></div>
    <div id="chl_village<?=$id?>"><?=$row["CHL_VILLAGE"]?></div>
    <div id="chl_room<?=$id?>"><?=$row["CHL_ROOM"]?></div>
    <div id="chl_soi<?=$id?>"><?=$row["CHL_SOI"]?></div>
    <div id="chl_road<?=$id?>"><?=$row["CHL_ROAD"]?></div>
    
    <div id="chl_tumbon<?=$id?>"><?=$row["CHL_TUMBON"]?></div>
     <div id="chl_tumbon_name<?=$id?>"><?=get_tumbon_name($row["CHL_TUMBON"],TB_REF_TUMBON)?></div>
    <div id="chl_amphur<?=$id?>"><?=$row["CHL_AMPHUR"]?></div>
     <div id="chl_amphur_name<?=$id?>"><?=get_amphur_name($row["CHL_AMPHUR"],TB_REF_AMPHUR)?></div>
    <div id="chl_province<?=$id?>"><?=$row["CHL_PROVINCE"]?></div>
    <div id="chl_province_name<?=$id?>"><?=get_province_name($row["CHL_PROVINCE"],TB_REF_PROVINCE)?></div>
    
    <div id="chl_post_code<?=$id?>"><?=$row["CHL_POST_CODE"]?></div>
    <div id="chl_country<?=$id?>"><?=$row["CHL_COUNTRY"]?></div>
     <div id="chl_country_name<?=$id?>"><?=get_nation_name($row["CHL_COUNTRY"],TB_REF_NATION)?></div>
    <div id="chl_cen_file<?=$id?>"><?=$row["CHL_CEN_FILE"]?></div>
    <div id="chl_phone<?=$id?>"><?=$chl_phone?></div>
    <div id="chl_fax<?=$id?>"><?=$chl_fax?></div>
     </div>
    <?
	$id++;
	}
 	 ?>
    </table>
    <br />
   <? }
  // oci_free_statement($stid);
   //$db->closedb($conn);?>