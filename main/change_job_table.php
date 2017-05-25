<?
@session_start();
$emp_id = $_SESSION["EMP_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_CHANGE_JOB_TAB,"",$conn);

	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}

	if($numrow >0){
?>
<script src="../js/cj_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="100%"  border="0" align="center"  bgcolor="#e9e9e9" >
   
    <tr align="center"  class="text_th">
        <!--<td width="15%" class="text_tr">คําสั่ง</td> -->
		<td width="60" class="text_tr">ลำดับ</td>
        <td width="60" class="text_tr">ตำเเหน่งเดิม</td>
        <td width="60" class="text_tr">หน่วยงานเดิม</td>
        <td width="60" class="text_tr">ตำเเหน่งใหม่</td>
        <td width="60" class="text_tr">หน่วยงานใหม่</td>
        <td width="60" class="text_tr">คำสั่ง</td>
        <td width="60" class="text_tr">มีผลตั้งเเต่</td>
        <td width="60" class="text_tr">ไฟล์เอกสาร</td>
        <td width="60" class="text_tr">เเก้ไข/เเสดง/ลบ</td>
    </tr>
    <?

    $sql = "SELECT * FROM  ".TB_SDU_CHANGE_JOB_TAB." WHERE EMP_ID='".$emp_id."' ORDER BY CJ_ID DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
    $cj=0;
while (($row = oci_fetch_array($stid, OCI_BOTH))) { $cj++;
	//$no = $row["SCH_ORDER_NO"];
	?>
     <tr align="center" height="20" valign="top" class="text_td">
        <td width="" class="text_tr"> <?= $cj; ?> </td>
        <td width="" class="text_tr">  
            <?
            $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID ='".$row["CJ_MUA_EMP_TYPE"]."' ";
            $stid_emp_type = oci_parse($conn, $sql_emp_type );
            oci_execute($stid_emp_type);
            while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
                echo $row_emp_type["STAFFTYPE_NAME"];
            }
			$sql_emp_position = "SELECT * FROM ".TB_POSITION." WHERE CODE = '".$row["CJ_CURRENT_HISTORY"]."' ";
            $stid_emp_position = oci_parse($conn, $sql_emp_position );
            oci_execute($stid_emp_position);
            while(($row_emp_position = oci_fetch_array($stid_emp_position, OCI_BOTH))){
                echo "/".$row_emp_position["POSITION"];
            }
			
			?> </td>
        <td width="" class="text_tr">
            <?
            $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY ='".$row["CJ_MUA_MAIN"]."' ";
            $stid_ref_department = oci_parse($conn, $sql_ref_department);
            oci_execute($stid_ref_department);
            while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
               echo $row_ref_department["NAME_FACULTY"];
            }
            ?>
            /
            <?
            $sql_ref_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION ='".$row["CJ_MUA_SUBMAIN"]."' AND CODE_FACULTY ='".$row["CJ_MUA_MAIN"]."' ";
            $stid_ref_sub = oci_parse($conn, $sql_ref_sub);
            oci_execute($stid_ref_sub);
            while(($row_ref_sub = oci_fetch_array($stid_ref_sub, OCI_BOTH))){
               echo $row_ref_sub["NAME_DEPARTMENT_SECTION"];
            }
            ?>
            /
            <?
            $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE ='".$row["CJ_DSU_EDU_CENTER"]."' ";
            $stid_ref_site = oci_parse($conn, $sql_ref_site);
            oci_execute($stid_ref_site);
            while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
               echo $row_ref_site["NAME_SITE"];
            }
            ?>
         </td>
        <td width="" class="text_tr">  
            <?
            $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID ='".$row["CJ_MUA_EMP_TYPE2"]."' ";
            $stid_emp_type = oci_parse($conn, $sql_emp_type );
            oci_execute($stid_emp_type);
            while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
                echo $row_emp_type["STAFFTYPE_NAME"];
            }
			$sql_emp_position = "SELECT * FROM ".TB_POSITION." WHERE CODE = '".$row["CJ_CURRENT_HISTORY2"]."' ";
            $stid_emp_position = oci_parse($conn, $sql_emp_position );
            oci_execute($stid_emp_position);
            while(($row_emp_position = oci_fetch_array($stid_emp_position, OCI_BOTH))){
                echo "/".$row_emp_position["POSITION"];
            }
			
			?></td>
        <td width="" class="text_tr">
            <?
            $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY ='".$row["CJ_MUA_MAIN"]."' ";
            $stid_ref_department = oci_parse($conn, $sql_ref_department);
            oci_execute($stid_ref_department);
            while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
               echo $row_ref_department["NAME_FACULTY"];
            }
            ?>
            /
            <?
            $sql_ref_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_DEPARTMENT_SECTION ='".$row["CJ_MUA_SUBMAIN2"]."' AND CODE_FACULTY ='".$row["CJ_MUA_MAIN2"]."' ";
            $stid_ref_sub = oci_parse($conn, $sql_ref_sub);
            oci_execute($stid_ref_sub);
            while(($row_ref_sub = oci_fetch_array($stid_ref_sub, OCI_BOTH))){
               echo $row_ref_sub["NAME_DEPARTMENT_SECTION"];
            }
            ?>
            /
            <?
            $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE." WHERE CODE_SITE ='".$row["CJ_DSU_EDU_CENTER2"]."' ";
            $stid_ref_site = oci_parse($conn, $sql_ref_site);
            oci_execute($stid_ref_site);
            while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
               echo $row_ref_site["NAME_SITE"];
            }
            ?>
         </td>
        <td width="" class="text_tr">
            <?
             $vv = change_date_thai($row["CJ_AT_DATE"]);                                       
            $xxx = explode("/",$vv); 
            ?>
            <?= $row["CJ_ORDER_NO"]."/".$row["CJ_AT"]?>
         </td>
        <td width="" class="text_tr"> <?= change_date_thai($row["START_CJ"]); ?> </td>
         <td width="" class="text_tr">
             <?
            $sql_img = "SELECT * FROM  ".TB_SDU_SECTOR_TRANSFER_IMG_TAB." WHERE EMP_ID='".$row["EMP_ID"]."' AND MAT_ID='".$row["CJ_ID"]."' AND ID_PAGS = 'CJ' ";
            $sql_img_row = oci_parse($conn, $sql_img);
            oci_execute($sql_img_row);
            while(($img_row = oci_fetch_array($sql_img_row, OCI_BOTH))){ ?>
                <img src="../images/macosx100.png" height="20" border="0" title="<?=$img_row["IMG_NAME"]?>" class="vtip" onclick="window.open('files/cj_file/<?=$img_row["IMG_NAME"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"/>
		    <?
            }
            ?>
         </td>
        
        <td width="80" class="text_tr">
        <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_cj('<?=$id?>','<?=$row["CJ_ID"]?>')"/>
        <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_cj('<?=$row["CJ_ID"]?>','<?=$_SESSION["EMP_ID"]?>')"/>
         </td>
    </tr>
    <div style="display:none">

        <div id="cj_id<?=$id?>"><?=$row["CJ_ID"]?></div>
        
        <div id="definition<?=$id?>"><?=$row["CJ_DEFINITION"]?></div>
        <div id="cj_order_no<?=$id?>"><?=$row["CJ_ORDER_NO"]?></div>
        <div id="cj_at<?=$id?>"><?=$row["CJ_AT"]?></div>
        <div id="cj_at_date<?=$id?>"><?= change_date_thai($row["CJ_AT_DATE"])?></div>
        
        <div id="cj_instructor<?=$id?>"><?=$row["CJ_INSTRUCTOR"]?></div>
        <div id="cj_mua_main_test<?=$id?>"><?=$row["CJ_MUA_MAIN_TEST"]?></div>
        <div id="cj_mua_submain_test<?=$id?>"><?=$row["CJ_MUA_SUBMAIN_TEST"]?></div>

        <div id="cj_dsu_edu_center_test<?=$id?>"><?=$row["CJ_DSU_EDU_CENTER_TEST"]?></div>
        <div id="start_dates_test<?=$id?>"><?= change_date_thai($row["START_DATES_TEST"])?></div>
        <div id="end_dates_test<?=$id?>"><?= change_date_thai($row["END_DATES_TEST"])?></div>
        <div id="term_test<?=$id?>"><?=$row["TERM_TEST"]?></div>
        <div id="test_type<?=$id?>"><?=$row["TEST_TYPE"]?></div>
        <div id="test_noet<?=$id?>"><?=$row["TEST_NOET"]?></div>
        
        <div id="cj_order_no_two<?=$id?>"><?=$row["CJ_ORDER_NO_TWO"]?></div>
        <div id="cj_at_two<?=$id?>"><?=$row["CJ_AT_TWO"]?></div>
        <div id="cj_at_date_two<?=$id?>"><?= change_date_thai($row["CJ_AT_DATE_TWO"])?></div>

        <div id="cj_mua_emp_type<?=$id?>"><?=$row["CJ_MUA_EMP_TYPE"]?></div>
        <div id="cj_mua_main<?=$id?>"><?=$row["CJ_MUA_MAIN"]?></div>
        <div id="cj_mua_submain<?=$id?>"><?=$row["CJ_MUA_SUBMAIN"]?></div>
        <div id="cj_dsu_edu_center<?=$id?>"><?=$row["CJ_DSU_EDU_CENTER"]?></div>
        <div id="cj_current_history<?=$id?>"><?=$row["CJ_CURRENT_HISTORY"]?></div>
        <div id="cj_munny_history<?=$id?>"><?=$row["CJ_MUNNY_HISTORY"]?></div>
        
        <div id="cj_mua_emp_type2<?=$id?>"><?=$row["CJ_MUA_EMP_TYPE2"]?></div>
        <div id="cj_mua_main2<?=$id?>"><?=$row["CJ_MUA_MAIN2"]?></div>
        <div id="cj_mua_submain2<?=$id?>"><?=$row["CJ_MUA_SUBMAIN2"]?></div>
        <div id="cj_dsu_edu_center2<?=$id?>"><?=$row["CJ_DSU_EDU_CENTER2"]?></div>
        <div id="cj_current_history2<?=$id?>"><?=$row["CJ_CURRENT_HISTORY2"]?></div>
        <div id="cj_munny_history2<?=$id?>"><?=$row["CJ_MUNNY_HISTORY2"]?></div>
        
        <div id="start_dates<?=$id?>"><?= change_date_thai($row["START_DATES"])?></div>
        <div id="end_dates<?=$id?>"><?= change_date_thai($row["END_DATES"])?></div>
        <div id="start_ck<?=$id?>"><?=$row["START_CK"]?></div>
        <div id="cj_note<?=$id?>"><?=$row["CJ_NOTE"]?></div>
        <div id="start_cj<?=$id?>"><?= change_date_thai($row["START_CJ"])?></div>
        
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
