<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_FAMILY_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
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
    <tr align="center"  class="text_th">
        <td width="10%" class="text_tr">ความสัมพันธ์</td>
        <td width="23%" class="text_tr">ชื่อ - นามสกุล</td>
        <td width="6%" class="text_tr">อายุ</td>
        <td width="15%" class="text_tr">สัญชาติ</td>
        <td width="32%" class="text_tr">อาชีพ</td>
        <td width="11%" class="text_tr"><?php if($_SESSION['USER_TYPE'] == 'user') { ?>แสดงข้อมูล<?php }else{ ?>แก้ไข/แสดง<?php } ?></td>
        <!--<td width="11%" class="text_tr">ไฟล์เอกสาร</td>-->
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><td width="3%" class="text_tr">ลบ</td><?php } ?>
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
   
    $sql = "SELECT * FROM  ".TB_FAMILY_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY FAM_RELATION ASC"; 
	$stid = oci_parse($conn, $sql );

	oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	if($row["FAM_BIRTHDAY"] == "0000-00-00" or $row["FAM_BIRTHDAY"] == "" or $row["FAM_BIRTHDAY"] == "null"){
		$age =  "";
	}else{
		$age = birthday($row["FAM_BIRTHDAY"]);
		$age = $age[0]." ปี";
	}
	$id = $row["FAM_RELATION"];
	?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=relation($id)?></td>
        <td align="left" class="text_td text_data"><?=$row["FAM_FNAME_TH"]?> <?=$row["FAM_LNAME_TH"]?> </td>
        <td align="center" class="text_td"><?=$age?> </td>
        <td align="center" class="text_td"><?=get_nation_name($row["FAM_NATION2"],TB_REF_NATION)?></td>
        <td align="left" class="text_td text_data"><?=$row["FAM_OCCUPATION"]?></td>
        <td align="center" class="text_td" valign="middle">
		<img src="../images/<?=$icon_img?>" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_fam('<?=$id?>')"/>
		</td>
       <!-- <td align="center" valign="middle" class="text_td">
		<? //if($row["FAM_CEN_FILE"] != ""){?><img src="../images/macosx100.png" height="20" border="0" title="Document" alt="Document" onclick="window.open('files/fam_data_file/<? //$row["FAM_CEN_FILE"]?>','<? //$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		<? //}?></td>-->
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" class="text_td" valign="middle">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_fam('<?=$_SESSION["EMP_ID"]?>','<?=$id?>','<?=$row["FAM_CEN_FILE"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="fam_relation<?=$id?>"><?=$id?></div>
    <div id="fam_title_th<?=$id?>"><?=$row["FAM_TITLE_TH"]?></div>
    <div id="fam_fname_th<?=$id?>"><?=$row["FAM_FNAME_TH"]?></div>
    <div id="fam_mname_th<?=$id?>"><?=$row["FAM_MNAME_TH"]?></div>
    <div id="fam_lname_th<?=$id?>"><?=$row["FAM_LNAME_TH"]?></div>
    <div id="fam_title_en<?=$id?>"><?=$row["FAM_TITLE_EN"]?></div>
    <div id="fam_fname_en<?=$id?>"><?=$row["FAM_FNAME_EN"]?></div>
    <div id="fam_mname_en<?=$id?>"><?=$row["FAM_MNAME_EN"]?></div>
    <div id="fam_lname_en<?=$id?>"><?=$row["FAM_LNAME_EN"]?></div>
    <div id="fam_sex<?=$id?>"><?=$row["FAM_SEX"]?></div>
    <div id="fam_nation1<?=$id?>"><?=$row["FAM_NATION1"]?></div>
    <div id="fam_nation2<?=$id?>"><?=$row["FAM_NATION2"]?></div>
    <div id="fam_nation_name1<?=$id?>"><?=get_nation_name($row["FAM_NATION1"],TB_REF_NATION)?></div>
    <div id="fam_nation_name2<?=$id?>"><?=get_nation_name($row["FAM_NATION2"],TB_REF_NATION)?></div>
    <div id="fam_religion<?=$id?>"><?=$row["FAM_RELIGION"]?></div>
    <div id="fam_birthday<?=$id?>"><? if($row["FAM_BIRTHDAY"] == "0000-00-00"){ echo "";}else{ echo change_date_thai($row["FAM_BIRTHDAY"]);}?></div>
    <div id="fam_alive<?=$id?>"><?=$row["FAM_ALIVE"]?></div>
    <div id="fam_status<?=$id?>"><?=$row["FAM_STATUS"]?></div>
    <div id="fam_code_id<?=$id?>"><?=$row["FAM_CODE_ID"]?></div>
    <div id="fam_id_from<?=$id?>"><?=$row["FAM_ID_FROM"]?></div>
    <div id="fam_id_from_p<?=$id?>"><?=$row["FAM_ID_FROM_P"]?></div>
    <div id="fam_id_date_begin<?=$id?>"><? if($row["FAM_ID_DATE_BEGIN"] == "0000-00-00"){ echo "";}else{ echo change_date_thai($row["FAM_ID_DATE_BEGIN"]);}?></div>
    <div id="fam_id_date_exp<?=$id?>"><? if($row["FAM_ID_DATE_EXP"] == "0000-00-00"){ echo "";}else{ echo change_date_thai($row["FAM_ID_DATE_EXP"]);}?></div>
    <div id="fam_occupation<?=$id?>"><?=$row["FAM_OCCUPATION"]?></div>
    <div id="fam_work_place<?=$id?>"><?=$row["FAM_WORK_PLACE"]?></div>
    <div id="fam_mobile<?=$id?>"><?=$row["FAM_MOBILE"]?></div>
    <div id="fam_work_phone<?=$id?>"><?=$row["FAM_WORK_PHONE"]?></div>
    <div id="fam_email<?=$id?>"><?=$row["FAM_EMAIL"]?></div>
    <div id="fam_house_no<?=$id?>"><?=$row["FAM_HOUSE_NO"]?></div>
    <div id="fam_moo<?=$id?>"><?=$row["FAM_HOUSE_NO"]?></div>
    <div id="fam_building<?=$id?>"><?=$row["FAM_BUILDING"]?></div>
    <div id="fam_village<?=$id?>"><?=$row["FAM_VILLAGE"]?></div>
    <div id="fam_room<?=$id?>"><?=$row["FAM_ROOM"]?></div>
    <div id="fam_soi<?=$id?>"><?=$row["FAM_SOI"]?></div>
    <div id="fam_road<?=$id?>"><?=$row["FAM_ROAD"]?></div>
    <div id="fam_tumbon<?=$id?>"><?=$row["FAM_TUMBON"]?></div>
     <div id="fam_tumbon_name<?=$id?>"><?=get_tumbon_name($row["FAM_TUMBON"],TB_REF_TUMBON)?></div>
    <div id="fam_amphur<?=$id?>"><?=$row["FAM_AMPHUR"]?></div>
     <div id="fam_amphur_name<?=$id?>"><?=get_amphur_name($row["FAM_AMPHUR"],TB_REF_AMPHUR)?></div>
    <div id="fam_province<?=$id?>"><?=$row["FAM_PROVINCE"]?></div>
    <div id="fam_province_name<?=$id?>"><?=get_province_name($row["FAM_PROVINCE"],TB_REF_PROVINCE)?></div>
    <div id="fam_post_code<?=$id?>"><?=$row["FAM_POST_CODE"]?></div>
    <div id="fam_country<?=$id?>"><?=$row["FAM_COUNTRY"]?></div>
    <div id="fam_country_name<?=$id?>"><?=get_nation_name($row["FAM_COUNTRY"],TB_REF_NATION)?></div>
    <div id="fam_cen_file<?=$id?>"><?=$row["FAM_CEN_FILE"]?></div>
    <div id="fam_phone<?=$id?>"><?=$row["FAM_PHONE"]?></div>
    <div id="fam_fax<?=$id?>"><?=$row["FAM_FAX"]?></div>
    <div id="fam_marriage_cer<?=$id?>"><?=$row["FAM_MARRIAGE_CER"]?></div>
    </div>
    <?
}
 	 ?>
    </table>
    <br />
    <? } 
	//oci_free_statement($stid);
	?>
	<script src="../js/edit_by_user.js" type="text/javascript"></script>