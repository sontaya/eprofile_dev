<?
@session_start();
 	$fpath = '';
	include "../includes/connect.php";
	$numrow = $db->count_row(TB_EDUCATION_TAB,"  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY EDU_LEVEL DESC, EDU_ID DESC",$conn);

	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}

	if($numrow >0){
		if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') {
			$icon_img="view.png";
		}
		else{
			$icon_img="b_edit.png";
		}
?>
	<script src="../js/vtip.js" type="text/javascript"></script>
    <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center" class="text_th">

        <td height="28" class="text_tr">ลำดับ</td>
        <td class="text_tr">ชื่อเต็ม</td>
        <td class="text_tr">สาขา/วิชาเอก</td>
        <td class="text_tr">ชื่อสถาบัน</td>
        <td class="text_tr">ปี พ.ศ.</td>
	<?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td class="text_tr">ไฟล์เอกสาร</td>
        <td class="text_tr"><?php if($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?>แสดงข้อมูล<?php }else{?>แก้ไข<?php } ?></td>
    <?php } ?>
    </tr>
    <?
	$id = 1;
    $sql = "SELECT * FROM  ".TB_EDUCATION_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY EDU_LEVEL DESC, EDU_ID DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	?>
    <tr align="center"  valign="top">

        <td height="25" align="center" valign="middle" class="text_td"><?=$id?></td>
        <td height="25" align="left" valign="middle" class="text_td text_data"><?=$row["EDU_NAME"]?></td>
        <td height="25" align="left" valign="middle" class="text_td text_data"><? if($row["EDU_MAJOR"]=="อื่น ๆ"){ echo $row["EDU_DISCIPLINE2"];}else{ echo $row["EDU_MAJOR"];}?></td>
        <td height="25" align="left" valign="middle" class="text_td text_data"><?=$row["EDU_FROM"]?></td>
      <td height="25" align="center" valign="middle" class="text_td"><?=$row["EDU_YEAR"]?></td>
      <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
      
      	<td height="25" align="center" valign="middle" class="text_td">
            <span class="label-icon" onclick="window.open('edu_manage_file.php?id=<?=$row["EDU_ID"]?>','<?=$id?>','height=500,width=600,resizable=1,scrollbars=1')">
                <i class="fa fa-file-text-o fa-2" aria-hidden="true"></i> เอกสาร
            </span>
		</td>
		<td height="25" align="right" valign="middle" class="text_td">
        <?php if($row["AUDIT_CHECK"] == "Y"){ ?>
        	<span class="icon-success">	
	        	<i class="fa fa-check-circle fa-2" aria-hidden="true"></i>
            </span>
        <?php } ?>
        
        	<img src="../images/<?=$icon_img?>" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_edu('<?=$id?>')"/>
            
            <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_edu('<?=$_SESSION["EMP_ID"]?>','<?=$row["EDU_ID"]?>')"/>
           &nbsp; 
        </td>
        <?php } ?>
    </tr>
     <div style="display:none">
     <div id="edu_id<?=$id?>"><?=$row["EDU_ID"]?></div>
     <div id="audit_check<?=$id?>"><?=$row["AUDIT_CHECK"]?></div>
     <div id="edu_level<?=$id?>"><?=$row["EDU_LEVEL"]?></div>
     <div id="edu_country<?=$id?>"><?=$row["EDU_COUNTRY"]?></div>
     <div id="edu_country_name<?=$id?>"><?=get_nation_name($row["EDU_COUNTRY"],TB_REF_NATION)?></div>
     <div id="edu_name<?=$id?>"><?=$row["EDU_NAME"]?></div>
     <div id="edu_name_short<?=$id?>"><?=$row["EDU_NAME_SHORT"]?></div>
    <div id="edu_gpa<?=$id?>"><?=$row["EDU_GPA"]?></div>
    <div id="edu_discipline<?=$id?>"><?=$row["EDU_DISCIPLINE"]?></div>
    <div id="edu_year<?=$id?>"><?=$row["EDU_YEAR"]?></div>
    <div id="edu_major<?=$id?>"><?=$row["EDU_MAJOR"]?></div>
    <div id="edu_program<?=$id?>"><?=$row["EDU_DISCIPLINE"]?></div>
    <div id="edu_program_name<?=$id?>"><?=get_edu_major2($row["EDU_DISCIPLINE"],TB_REF_ISCED)?></div>
    <div id="edu_from<?=$id?>"><?=$row["EDU_FROM"]?></div>

     <div id="edu_major2<?=$id?>"><?=$row["EDU_MAJOR2"]?></div>
      <div id="edu_program2<?=$id?>"><?=$row["EDU_DISCIPLINE2"]?></div>
      
     <div id="audit_check<?=$id?>"><?=$row["AUDIT_CHECK"]?></div>
      <div id="cert_confirm<?=$id?>"><?=$row["CERT_CONFIRM"]?></div>
     <div id="cert_at<?=$id?>"><?=$row["CERT_AT"]?></div>
      <div id="cert_number_at<?=$id?>"><?=$row["CERT_NUMBER_AT"]?></div>
     <div id="cert_date<?=$id?>"><?=$row["CERT_DATE"]?></div>
      <div id="cert_answer_at<?=$id?>"><?=$row["CERT_ANSWER_AT"]?></div>
     <div id="cert_answer_number_at<?=$id?>"><?=$row["CERT_ANSWER_NUMBER_AT"]?></div>
      <div id="cert_answer_date<?=$id?>"><?=$row["CERT_ANSWER_DATE"]?></div>
     </div>
    <?
	$id++;
	}
oci_free_statement($stid);
 	 ?>
    </table>
    <br />

   <?

   }

   $db->closedb($conn);?>
