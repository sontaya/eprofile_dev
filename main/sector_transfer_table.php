<?
@session_start();
$emp_id = $_SESSION["EMP_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_SECTOR_TRANSFER_TAB,"",$conn);

	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}

	if($numrow >0){
?>
<script src="../js/st_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="100%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
        <td width="30" class="text_tr" rowspan="2">ลำดับ</td>
        <td width="" class="text_tr" rowspan="2">รายการ</td>
		<td width="" class="text_tr" colspan="3">รายละเอียดใหม่</td>
        <td width="" class="text_tr" colspan="3">รายละเอียดเดิม</td>
        <td width="70" class="text_tr" rowspan="2">คําสั่ง</td>
        <td width="70" class="text_tr" rowspan="2">มีผลตั้งเเต่</td>
        <td width="70" class="text_tr" rowspan="2">ไฟล์เอกสาร</td>
        <td width="" class="text_tr" rowspan="2">เเก้ไข/ลบ</td>

    </tr>
    <tr align="center"  class="text_th">
        <!--<td width="15%" class="text_tr">คําสั่ง</td> -->
		<td width="60" class="text_tr">ประเภท/ตําเเหน่ง</td>
        <td width="60" class="text_tr">สังกัด</td>
        <td width="60" class="text_tr">เงินเดือน</td>
        <td width="60" class="text_tr">ประเภท/ตําเเหน่ง</td>
        <td width="60" class="text_tr">สังกัด</td>
        <td width="60" class="text_tr">เงินเดือน</td>
    </tr>
    <?

    $sql = "SELECT * FROM  ".TB_SDU_SECTOR_TRANSFER_TAB." WHERE EMP_ID='".$emp_id."' ORDER BY ST_id DESC";
	//echo $sql;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
    $st=0;
while (($row = oci_fetch_array($stid, OCI_BOTH))) { $st++;
	//$no = $row["SCH_ORDER_NO"];
	?>
     <tr align="center" height="20" valign="top" class="text_td">
        <td width="" class="text_tr" align="center"><?= $st ?></td>
        <td width="" class="text_tr">
            <? if($row["TYPE_ST"]=="1"){ echo "ย้ายสังกัด";}  ?>
            <? if($row["TYPE_ST"]=="2"){ echo "ช่วยปฏิบัติหน้าที่";}  ?>
            <? if($row["TYPE_ST"]=="3"){ echo "เปลี่ยนสถานที่ปฏิบัติงาน";}  ?>
            <? if($row["TYPE_ST"]=="4"){ echo "เปลี่ยนตำเเหน่ง";}  ?>
         </td>
		<td width="" class="text_tr">
            <?
            $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID ='".$row["ST_MUA_EMP_TYPE"]."' ";
            $stid_emp_type = oci_parse($conn, $sql_emp_type );
            oci_execute($stid_emp_type);
            while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
                echo $row_emp_type["STAFFTYPE_NAME"];
            }
			?>
        </td>
        <td width="" class="text_tr">
            <?
            $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY ='".$row["ST_MUA_MAIN"]."' ";
            $stid_ref_department = oci_parse($conn, $sql_ref_department);
            oci_execute($stid_ref_department);
            while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
               echo $row_ref_department["NAME_FACULTY"];
            }
            ?>
            /
            <?
            $sql_ref_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION ='".$row["ST_MUA_SUBMAIN"]."' AND CODE_FACULTY='".$row["ST_MUA_MAIN"]."' ";
            $stid_ref_sub = oci_parse($conn, $sql_ref_sub);
            oci_execute($stid_ref_sub);
            while(($row_ref_sub = oci_fetch_array($stid_ref_sub, OCI_BOTH))){
               echo $row_ref_sub["NAME_DEPARTMENT_SECTION"];
            }
            ?>
            /
            <?
            $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE ='".$row["ST_DSU_EDU_CENTER"]."' ";
            $stid_ref_site = oci_parse($conn, $sql_ref_site);
            oci_execute($stid_ref_site);
            while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
               echo $row_ref_site["NAME_SITE"];
            }
            ?>
            
         </td>
        <td width="" class="text_tr"><?= number_format($row["ST_MUNNY_HISTORY"]); ?> </td>
        <td width="" class="text_tr">
            <?
            $sql_emp_type2 = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID ='".$row["ST_MUA_EMP_TYPE2"]."' ";
            $stid_emp_type2 = oci_parse($conn, $sql_emp_type2 );
            oci_execute($stid_emp_type2);
            while(($row_emp_type2 = oci_fetch_array($stid_emp_type2, OCI_BOTH))){
                echo $row_emp_type2["STAFFTYPE_NAME"];
            }
            ?>
         </td>
		<td width="" class="text_tr">
            <?
            $sql_ref_department2 = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY ='".$row["ST_MUA_MAIN2"]."' ";
            $stid_ref_department2 = oci_parse($conn, $sql_ref_department2);
            oci_execute($stid_ref_department2);
            while(($row_ref_department2 = oci_fetch_array($stid_ref_department2, OCI_BOTH))){
               echo $row_ref_department2["NAME_FACULTY"];
            }
            ?>
             /
            <?
            $sql_ref_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION ='".$row["ST_MUA_SUBMAIN2"]."' AND CODE_FACULTY ='".$row["ST_MUA_MAIN2"]."' ";
			//echo $sql_ref_sub;
            $stid_ref_sub = oci_parse($conn, $sql_ref_sub);
            oci_execute($stid_ref_sub);
            while(($row_ref_sub = oci_fetch_array($stid_ref_sub, OCI_BOTH))){
               echo $row_ref_sub["NAME_DEPARTMENT_SECTION"];
            }
            ?>
            /
            <?
            $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE ='".$row["ST_DSU_EDU_CENTER2"]."' ";
            $stid_ref_site = oci_parse($conn, $sql_ref_site);
            oci_execute($stid_ref_site);
            while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
               echo $row_ref_site["NAME_SITE"];
            }
            ?>
         </td>
        <td width="" class="text_tr"><?= number_format($row["ST_MUNNY_HISTORY2"]); ?></td>
        <td width="" class="text_tr"><?= $row["ST_ORDER_NO"]." ".$row["ST_AT"]." (".change_date_thai($row["ST_AT_DATE"]).")" ?></td>
        <td width="" class="text_tr"><?= $row["START_ST"]; ?></td>
		<td width="" class="text_tr">
            <?
            $sql_img = "SELECT * FROM  ".TB_SDU_SECTOR_TRANSFER_IMG_TAB." WHERE EMP_ID='".$row["EMP_ID"]."' AND MAT_ID='".$row["ST_ID"]."' AND ID_PAGS = 'ST' ";
            $sql_img_row = oci_parse($conn, $sql_img);
            oci_execute($sql_img_row);
            while(($img_row = oci_fetch_array($sql_img_row, OCI_BOTH))){ ?>
                <img src="../images/macosx100.png" height="20" border="0" title="<?=$img_row["IMG_NAME"]?>" class="vtip" onclick="window.open('files/st_file/<?=$img_row["IMG_NAME"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		    <?
            }
            ?>
         </td>
        <td width="80" class="text_tr">
        <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_st('<?=$id?>','<?=$row["ST_ID"]?>')"/>
        <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_st('<?=$row["ST_ID"]?>','<?=$_SESSION["EMP_ID"]?>')"/>
         </td>
    </tr>
    <div style="display:none">
    <div id="type_st<?=$id?>"><?=$row["TYPE_ST"]?></div>

        <div id="st_id<?=$id?>"><?=$row["ST_ID"]?></div>
        
        <div id="st_order_no<?=$id?>"><?=$row["ST_ORDER_NO"]?></div>
        <div id="st_at<?=$id?>"><?=$row["ST_AT"]?></div>
        <div id="st_at_date<?=$id?>"><?= change_date_thai($row["ST_AT_DATE"])?></div>

        <div id="st_mua_emp_type<?=$id?>"><?=$row["ST_MUA_EMP_TYPE"]?></div>
        <div id="st_mua_main<?=$id?>"><?=$row["ST_MUA_MAIN"]?></div>
        <div id="st_mua_submain<?=$id?>"><?=$row["ST_MUA_SUBMAIN"]?></div>
        <div id="st_dsu_edu_center<?=$id?>"><?=$row["ST_DSU_EDU_CENTER"]?></div>
        <div id="st_current_history<?=$id?>"><?=$row["ST_CURRENT_HISTORY"]?></div>
        <div id="st_munny_history<?=$id?>"><?=$row["ST_MUNNY_HISTORY"]?></div>
        
        <div id="st_mua_emp_type2<?=$id?>"><?=$row["ST_MUA_EMP_TYPE2"]?></div>
        <div id="st_mua_main2<?=$id?>"><?=$row["ST_MUA_MAIN2"]?></div>
        <div id="st_mua_submain2<?=$id?>"><?=$row["ST_MUA_SUBMAIN2"]?></div>
        <div id="st_dsu_edu_center2<?=$id?>"><?=$row["ST_DSU_EDU_CENTER2"]?></div>
        <div id="st_current_history2<?=$id?>"><?=$row["ST_CURRENT_HISTORY2"]?></div>
        <div id="st_munny_history2<?=$id?>"><?=$row["ST_MUNNY_HISTORY2"]?></div>
        
        <div id="start_dates<?=$id?>"><?= change_date_thai($row["START_DATES"])?></div>
        <div id="end_dates<?=$id?>"><?= change_date_thai($row["END_DATES"])?></div>
        <div id="start_ck<?=$id?>"><?=$row["START_CK"]?></div>
        <div id="st_note<?=$id?>"><?=$row["ST_NOTE"]?></div>
        <div id="start_st<?=$id?>"><?=$row["START_ST"]?></div>
        
        
    </div>
   
    <?
	$id++;
}
oci_free_statement($stid);
 	 ?>
    </table>
<br />
    <? }

	//$db->closedb($conn);
	?>
