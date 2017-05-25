<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_APPRAISE_TAB,"  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
		if($_SESSION['USER_TYPE'] == 'admin') { 
			$icon_img="b_edit.png";
		}
		else{
			$icon_img="view.png";
		}
	
	if($numrow >0){
?>
	<script src="../js/vtip.js" type="text/javascript"></script>
    <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center" class="text_th">
 
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="22%" class="text_tr">ประเภท</td>
        <td width="10%" class="text_tr">ปีการศึกษา</td>
        <td width="10%" class="text_tr">คะแนน</td>
        <td width="27%" class="text_tr">ผู้ประเมิน</td>
        <td width="10%" class="text_tr">วันที่ประเมิน</td>
        <td width="4%" class="text_tr"><? if($_SESSION["USER_TYPE"] == "admin"){ echo "แก้ไข";}else{ echo "แสดง";}?></td>
        <? if($_SESSION["USER_TYPE"] == "admin"){?>
        <td width="3%" class="text_tr">ลบ</td>
        <? }?>
    </tr>
    <?
	$id = 1;	
	$sql = "SELECT * FROM  ".TB_APPRAISE_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY APR_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
		
		
	?>
    <tr align="center" height="22" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["APR_TYPE"]?></td>
        <td align="center" class="text_td"><?=$row["APR_YEAR"]?></td>
        <td align="center" class="text_td"><?=$row["APR_SCORE"]?></td>
        <td align="left" class="text_td text_data"><?=$row["APR_BY_NAME"]?></td>
        <td align="left" class="text_td text_data"><?=change_date_thai($row["APR_DATE"])?></td>
        <td align="center" class="text_td"><img src="../images/<?=$icon_img?>" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_app('<?=$id?>')"/></td>
        <? if($_SESSION["USER_TYPE"] == "admin"){?>
        <td align="center" class="text_td">
        <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_app('<?=$_SESSION["EMP_ID"]?>','<?=$row["APR_YEAR"]?>')"/>
        </td>
        <? }?>
    </tr>
     <div style="display:none">
    <div id="apr_type<?=$id?>"><?=$row["APR_TYPE"]?></div>
    <div id="apr_year<?=$id?>"><?=$row["APR_YEAR"]?></div>
    <div id="apr_result<?=$id?>"><?=$row["APR_RESULT"]?></div>
    <div id="apr_score<?=$id?>"><?=$row["APR_SCORE"]?></div>
    <div id="apr_dev_comment<?=$id?>"><?=$row["APR_DEV_COMMENT"]?></div>
    <div id="apr_salary_step<?=$id?>"><?=$row["APR_SALARY_STEP"]?></div>
    <div id="apr_salary_percent<?=$id?>"><?=$row["APR_SALARY_PERCENT"]?></div>
    <div id="apr_salary_reason<?=$id?>"><?=$row["APR_SALARY_REASON"]?></div>
    <div id="apr_by_name<?=$id?>"><?=$row["APR_BY_NAME"]?></div>
    <div id="apr_by_pos<?=$id?>"><?=$row["APR_BY_POS"]?></div>
    <div id="apr_date<?=$id?>"><? if($row["APR_DATE"] == ""){ echo "";}else{ echo change_date_thai($row["APR_DATE"]);}?></div>
    <div id="apr_up_comment<?=$id?>"><?=$row["APR_UP_COMMENT"]?></div>
    <div id="apr_up_reason<?=$id?>"><?=$row["APR_UP_REASON"]?></div>
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