<?php
@session_start();
error_reporting(E_ALL);

if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }

ini_set('max_execution_time', 300);

$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
////////////////////
/* $sql_ref_department = "SELECT * FROM  ".TB_CURRENT_WORK_TAB."";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$a=0;
	while($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH)){$a++;
	echo $ss=$row_ref_department["EMP_ID"];
		$result=$db->update_db(TB_CURRENT_WORK_TAB,array(
											  "CWK_POS_STATUS"=>"2",
											  "CK_ID"=>"$a"
									 ),"EMP_ID = '$ss'",$conn);
	}*/
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";

/////////////////////
//echo $_SESSION["EMP_ID"];
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'";
//echo $sql;
$row = $db->fetch($sql,$conn);
@list($cwk_start_work_hour,$cwk_start_work_min) = @explode(":",$row["CWK_START_WORK"]);
@list($cwk_end_work_hour,$cwk_end_work_min) = @explode(":",$row["CWK_END_WORK"]);
@list($cwk_salary_bath,$cwk_salary_stang) = @explode(".",$row["CWK_SALARY"]);
$sql_salary = "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '".$_SESSION["EMP_ID"]."' ORDER BY REF DESC";
$stid_salary = oci_parse($conn, $sql_salary );
oci_execute($stid_salary);
$row_salary = oci_fetch_array($stid_salary, OCI_BOTH);
$salary = $row_salary["SALARY1"]+$row_salary["SALARY2"]+$row_salary["SALARY3"];

$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC ";
$stid_budget = oci_parse($conn, $sql_budget );
oci_execute($stid_budget);

$option = array();
for($i=1;$i<11;$i++){
	if($i>3){
	$option[$i]="<option value=''>เลือก</option>";
	}
}
while(($row_budget = oci_fetch_array($stid_budget, OCI_BOTH))){
	for($i=1;$i<4;$i++){
		//if($row_salary["SOURCE{$i}"] == $row_budget["CODE_SALARY_SOURCE"]){
		if(true){
			if($row_salary["SOURCE{$i}"] == $row_budget["CODE_SALARY_SOURCE"]) {
				$select="selected = 'selected'";
			}
			else {
				$select ="";
			}
			$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' $select>".$row_budget["NAME_SALARY_SOURCE"]."</option>";
			}
		}
	for($i=4;$i<11;$i++){
		$j = $i - 3;
		if($row["CWK_FROM{$j}"] == $row_budget["CODE_SALARY_SOURCE"]){ $select="selected = 'selected'";}else{ $select="";}
		$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' $select>".$row_budget["NAME_SALARY_SOURCE"]."</option>";

	}
}

$sql_ex_salary = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC ";
$stid_ex_salary = oci_parse($conn, $sql_ex_salary );
oci_execute($stid_ex_salary);

$option_ex_salary = array();
for($i=1;$i<8;$i++){
	$option_ex_salary[$i]="<option value=''>เลือก</option>";
}
while(($row_ex_salary = oci_fetch_array($stid_ex_salary, OCI_BOTH))){
	for($i=1;$i<8;$i++){
		 if($row["CWK_EXTRA_SALARY{$i}"] == $row_ex_salary["ID"]){ $select="selected = 'selected'";}else{ $select="";}
		$option_ex_salary[$i] .= "<option value='".$row_ex_salary["ID"]."' $select>".$row_ex_salary["NAME"]."</option>";
	}

}

function ex_admin_department(){
	global $conn;
	global $db;

	$sql="SELECT * FROM  SDU_ADMIN_DEPARTMENT WHERE EMP_ID='".$_SESSION["EMP_ID"]."'";
	//print $sql;
	$query = oci_parse($conn, $sql );
	oci_execute($query);
	while(($row = oci_fetch_array($query, OCI_BOTH))){
		//$data_position[]=$row["POSITION"];
		//$data_faculty[]=$row["CODE_FACULTY"];
		//$data_department_section[]=$row["CODE_DEPARTMENT_SECTION"];
		//print $row["POSITION"].":".$row["CODE_FACULTY"].":".$row["CODE_DEPARTMENT_SECTION"]."<br>";
		$data["POSITION"][]=$row["POSITION"];
		$data["CODE_FACULTY"][]=$row["CODE_FACULTY"];
		$data["CODE_DEPARTMENT_SECTION"][]=$row["CODE_DEPARTMENT_SECTION"];
	}

	$return[0]=$data_position;
	$return[1]=$data_faculty;
	$return[2]=$data_department_section;


	return $data;

}

$ex_admin_department=ex_admin_department();;
?>
<script type="text/javascript" language="javascript">

function del_ex_salary(id){
	var conf = window.confirm("ยืนยันที่จะลบรายการนี้");
	if(conf){
	var data = "ID="+id;
	ajaxPostData("ex_salary_del.php",data,"text","ex_salary_list",del_ex_salary_res,"");
	}
}

function del_ex_salary_res(response){
	if(response == "1"){
		$("#ex_salary_list").load("ex_salary_list.php");
	}else{
		//alert("ไม่สามารถลบรายการนี้ได้");
		$("#ex_salary_list").load("ex_salary_list.php");
	}
}

function total_salary(){
var num1 = document.getElementById("cwk_total1").value;
var num2 = document.getElementById("cwk_total2").value;
var num3 = document.getElementById("cwk_total3").value;

var total = 0;
if(num1 != "0.00" || num1 != ""){
	var Nnum1 = parseFloat(num1.replace(/\,/g,''));
}else{
	var Nnum1 = 0;
}
if(num2 != "0.00" || num2 != ""){
	var Nnum2 = parseFloat(num2.replace(/\,/g,''));
}
else{
	var Nnum2 = 0;
}
if(num3 != "0.00" || num3 != ""){
	var Nnum3 = parseFloat(num3.replace(/\,/g,''));
}
else{
	var Nnum3 = 0;
}
//alert(Nnum1+Nnum2+Nnum3);
total = addCommas(roundNumber(Nnum1+Nnum2+Nnum3,2));
document.getElementById("salary").value = total;
//alert(total);
}

function check_data(){

		if($("#cwk_mua_emp_type").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}

		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
	
		document.getElementById("current_work").submit();

}

function salary_history(emp_id){
	window.open("salary_history.php?emp_id="+emp_id,"salary","width=1150,height=400,resizable=1,scrollbars=1");
}

function work_history(emp_id){
	//alert(emp_id);
	window.open("current_work_history.php?emp_id="+emp_id,"work_history","width=650,height=600,resizable=1,scrollbars=1");
}

function show_upload(id,target,file,pic,title){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" class=\"file_upload\" /> <input type=\"button\" value=\"Cancel\" onclick=\"cancel_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"')\"/>  เฉพาะ .jpg, .gif, .bmp, .png, .pdf");
}

function cancel_upload(id,target,file,pic,title){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" style=\"display:none\" class=\"file_upload\"/><span style='font-size: 14px'><img src=\"../images/"+pic+"\" height=\"20\" border=\"0\" onclick=\"window.open('files/cwk_teacher_file/"+file+"','"+target+"','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\""+title+"\" alt=\"Present Photo\"/> &nbsp;&nbsp;&nbsp;<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"')\"/>");
}


$(function() {

		/*$('#cwk_start_work_date').datepicker({
		    changeMonth: true,
			changeYear: true,
			duration: 'fast',
			dateFormat: 'dd/mm/yy',
			yearRange: '1960:2020'
		});*/


		$('#Valid_edu_file').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});


		$('#Save_success').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});

		$('#Save_error').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});

		$('#Error_upload').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});

				$('#Please_fill_in').dialog({
			resizable: false,
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			buttons: {
				ตกลง: function() {
					$(this).dialog('close');
				}
			}
		});

		$("#addfile").click(function(){
				$("#morefile").after("<table width='727' border='0' cellspacing='3' cellpadding='3' align='left'><tr><td width='285' align='right'  class='form_text'><select  name='cwk_extra_salary[]' style='width: 150px; text-align:right'><?=$option_ex_salary[1]?></select></td><td width='148' align='right'>จำนวน <input type='text' name='cwk_cost[]' style='width: 100px; text-align:right' class='input_text'  /></td><td width='90' align='right'>ใช้งบประมาณ</td><td width='165' align='left'><select name='cwk_from[]' style='width: 130px'><?=$option[4]?></select></td></tr></table>");
			   //var sch_file = document.getElementsByName("sch_file[]").length;
		 });

 });

function quit(id){
	if(id == "02"){
		document.getElementById("quit").style.display = "block";
	}else{
		document.getElementById("quit").style.display = "none";
	}

}

function select_executives(data){

	if(data!=""){
		$.post("./ajax_executives.php",{data:data},
			function(data){
				document.getElementById("executives").style.display = "";
				$("#executives_data").html(data);
		});
	}
	else{
		document.getElementById("executives").style.display = "none";
	}
}

//select_executives("");

</script> 
<script type="text/javascript">
    /*function Sum_date()
    {
        // ประกาศตัวแปร
        var num1 = document.getElementById('cwk_start_work_date').value;
        //var num2 = document.getElementById('num2').value;
        //ประกาศหากกรณีuserยังไม่คีย์ให้ค่าในกล่องเป็น 0 เพื่อป้องกันปัญหา NaN
        if (num1 == ""  ) { num1=0; }
        if (num2 == ""  ) { num2=10; }
        // ส่วนประมวลผล
        var sum = parseInt(num1) + parseInt(num2);
        document.getElementById('cwk_end_work_date').value = sum;
    }*/
</script>
<div align="center"  id="toggle_form">&nbsp;</div>
<div id="data_form">
<!-- current_work_data_save.php 
 <form id="current_work" name="current_work" enctype="multipart/form-data" method="post" action="current_work_data_save.php" target="upload_target">
-->
      <form id="current_work" name="current_work" enctype="multipart/form-data" method="post" action="current_work_data_save.php"  target="upload_target">
    <table  cellspacing="0" cellpadding="0" align="center" border="0">
        <tr>
      
        <td>

        <table width="758" border="0" cellspacing="4" cellpadding="4">
          <input type="hidden" id="current_work_id" name="current_work_id" value=""/>
          <input type="hidden" id="ch_id" name="ch_id" value=""/>
          <input type="hidden" id="cwk_id" name="cwk_id" value="<?=$row["CK_ID"]  ?>"/>
          <tr>
            <td height="30" align="right" class="form_text">สถานะปัจจุบัน :</td>
            <td align="left"><select  id="cwk_status" name="cwk_status" class="widthFix2" onchange="quit(this.value);">
                <option value="01" <? if($row["CWK_STATUS"] == "01"){echo "selected='selected'";}?>>ปฏิบัติการ</option>
                <option value="02" <? if($row["CWK_STATUS"] == "02"){echo "selected='selected'";}?>>ลาออก</option>
                <option value="03" <? if($row["CWK_STATUS"] == "03"){echo "selected='selected'";}?>>ลาศึกษาต่อ</option>
                <option value="04" <? if($row["CWK_STATUS"] == "04"){echo "selected='selected'";}?>>เกษียนอายุ</option>
                <option value="05" <? if($row["CWK_STATUS"] == "05"){echo "selected='selected'";}?>>ปฏิบัติการตามวาระ</option>
                <option value="07" <? if($row["CWK_STATUS"] == "07"){echo "selected='selected'";}?>>เสียชีวิต</option>
                <option value="08" <? if($row["CWK_STATUS"] == "08"){echo "selected='selected'";}?>>ไม่ใช้งานแล้ว</option>
              </select></td>
          </tr>
          <tr >
            <td colspan="2" align="left" class="form_text"  height="1"><?
		$style="display:none";
		if($row["CWK_STATUS"] == "02") $style="display:block";

		?>
              <div id="quit"  align="left" style="padding-left:145px;<?=$style?>"> &nbsp; วันที่ลาออก :
                &nbsp;&nbsp;
                <input type="text" id="cwk_quit_date" name="cwk_quit_date" class="input_text" style="width: 80px; " value="<?=change_date_thai($row["CWK_QUIT_DATE"])?>"/>
                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cwk_quit_date','YYYY-MM-DD')"  style="cursor:pointer"/> <br />
                เหตุผลที่ออก :
                &nbsp;&nbsp;
                <input type="text" id="cwk_quit_reason" name="cwk_quit_reason" class="input_text" style="width: 200px; " value="<?=$row["CWK_QUIT_REASON"]?>"/><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="cwk_resignation" name="cwk_resignation" value="Y" /><input type="text" id="cwk_resignation_detail" name="cwk_resignation_detail" class="input_text" style="width: 200px; " value="<?=$row["CWK_RESIGNATION_DETAIL"]?>"/>
                <input type="file" id="cwk_resignation_file" name="cwk_resignation_file" />
              </div></td>
          </tr>
            <tr>
          
          <td align="right" class="form_text">สถานะตำแหน่ง :</td>
            <td align="left">
          
          <select  id="cwk_pos_status" name="cwk_pos_status" >
            <option value="1"> ตำแหน่งเดิม/สังกัดเดิม</option>
            <option value="2">ตำแหน่งใหม่/สังกัดใหม่</option>
           
            
              </td>
            
              </tr>
            
              <tr>
            
              <td width="223" align="right" class="form_text">
              * ประเภทบุคลากร
            <!--(สกอ.)-->
               :
              </td>
            
              <td width="507" align="left">
            
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
            
              <tr>
            
              <td width="15%" align="left">
            
            <?
    $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC ";
	$stid_emp_type = oci_parse($conn, $sql_emp_type );
	oci_execute($stid_emp_type);
	$option_emp_type="<option value=''>เลือก</option>";
	while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
		if($row["CWK_MUA_EMP_TYPE"] == $row_emp_type["STAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_emp_type .= "<option value='".$row_emp_type["STAFFTYPE_ID"]."' $select>".$row_emp_type["STAFFTYPE_NAME"]."</option>\n";
	}
	?>
              <select name="cwk_mua_emp_type" id="cwk_mua_emp_type" class="widthFix2"  >
            
            <?=$option_emp_type?>
          </select>
            </td>
          
            </tr>
          
        </table>
        <!------------------------------------->
        <tr>
          <td align="right" class="form_text">วันที่บรรจุเป็นพนักงานมหาวิทยาลัย :</td>
          <td align="left"><input type="text" id="date_m" name="date_m" class="input_text" style="width: 80px; " value="<?=change_date_thai($row["DATE_M"])?>"/>
            <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('date_m','YYYY-MM-DD')"  style="cursor:pointer"/> คำสั่ง
            <input type="text" name="ck_order_no" id="ck_order_no" style="width: 80px; " class="input_text" value="<?= $row["CK_ORDER_NO"] ?>">
            &nbsp;&nbsp;&nbsp;
            ที่
            <input type="text" name="ck_at" id="ck_at" style="width: 40px; " class="input_text" value="<?= $row["CK_AT"] ?>">
            สั่ง ณ วันที่
            <input type="text" name="ck_order_date" id="ck_order_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["CK_ORDER_DATE"]) ?>">
            &nbsp; <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('ck_order_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
        </tr>
        <tr>
          <td align="right" class="form_text">ประเภทบุคลากรย่อย :</td>
          <td align="left">
			<?
                $sql_emp_subtype = "SELECT * FROM  ".TB_REF_SUBSTAFFTYPE."  ORDER BY SUBSTAFFTYPE_ID ASC ";
                $stid_emp_subtype = oci_parse($conn, $sql_emp_subtype );
                oci_execute($stid_emp_subtype);
                $option_emp_subtype="<option value=''>เลือก</option>";
                while(($row_emp_subtype = oci_fetch_array($stid_emp_subtype, OCI_BOTH))){
                    if($row["CWK_MUA_EMP_SUBTYPE"] == $row_emp_subtype["SUBSTAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
                        $option_emp_subtype .= "<option value='".$row_emp_subtype["SUBSTAFFTYPE_ID"]."' $select>".$row_emp_subtype["SUBSTAFFTYPE_NAME"]."</option>\n";
                }
            ?>
            <select name="cwk_mua_emp_subtype" id="cwk_mua_emp_subtype" style="width:480px;">
              <?=$option_emp_subtype?>
            </select>          
          </td>
        </tr>

      
        <tr>
          <td align="right" class="form_text" >หน่วยงานหลัก<!--(มสด.)--> :</td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="19%" align="left"><?
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value=''>เลือก</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
		if($row["CWK_MUA_MAIN"] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	?>
                  <select name="cwk_mua_main" id="cwk_mua_main" style="width:480px;"  onchange="load_depsub(this.value),load_position_code()">
                    <?=$option_ref_department?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <!------------------------------------->
        <tr>
          <td  align="right" class="form_text" >หน่วยงานย่อย<!--(มสด.)--> : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div id="ajax_depsub">
                    <?
			 if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$where."'  ORDER BY NAME_DEPARTMENT_SECTION ASC ";
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
		if($row["CWK_MUA_SUBMAIN"] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
	}
	?>
                    <select name="cwk_mua_submain" id="cwk_mua_submain" onchange="load_depsub2(this.value)" style="width:480px;" >
                      <?=$option_ref_department_sub?>
                    </select>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        
        <!------------------------------------->
        
          <tr>
        
        <td align="right" class="form_text" > กลุ่มงาน <!--(มสด.)--> :</td>
          <td align="left">

<div id="ajax_depsub2">
                <?
       if($row["CWK_MUA_SUBMAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_SUBMAIN"];
    $sql_ref_department_group = "SELECT * FROM  ".TB_REF_DEPARTMENT_GROUP."  WHERE CODE_DEPARTMENT_SUB = '".$where."'  ORDER BY NAME_DEPARTMENT_GROUP ASC ";
  $stid_ref_department_group = oci_parse($conn, $sql_ref_department_group);
  oci_execute($stid_ref_department_group);
  $option_ref_department_group="<option value=''>เลือก</option>";
  while(($row_ref_department_group = oci_fetch_array($stid_ref_department_group, OCI_BOTH))){
    if($row["CWK_MUA_WORK_GROUP"] == $row_ref_department_group["CODE_DEPARTMENT_GROUP"]){ $select="selected = 'selected'";}else{ $select="";}
      $option_ref_department_group .= "<option value='".$row_ref_department_group["CODE_DEPARTMENT_GROUP"]."' $select>".$row_ref_department_group["NAME_DEPARTMENT_GROUP"]."</option>\n";
  }
  ?>
                <select name="cwk_mua_work_group" id="cwk_mua_work_group" class="widthFix2" style="width:480px;">
                  <?=$option_ref_department_group?>
                </select>
              </div>
        
       
          </td>
        
          </tr>
        
        <tr>
          <td align="right" class="form_text" >ศูนย์การศึกษา : </td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="19%" align="left"><?
    $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE."  ORDER BY NAME_SITE ASC ";
	//echo $sql_ref_site;
	$stid_ref_site = oci_parse($conn, $sql_ref_site);
	oci_execute($stid_ref_site);
	$option_ref_site="<option value=''>เลือก</option>";
	while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
		if($row["CWK_DSU_EDU_CENTER"] == $row_ref_site["CODE_SITE"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_site .= "<option value='".$row_ref_site["CODE_SITE"]."' $select>".$row_ref_site["NAME_SITE"]."</option>\n";
	}
	?>
                  <select name="cwk_dsu_edu_center" id="cwk_dsu_edu_center" style="width:480px;" >
                    <?=$option_ref_site?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="right" class="form_text" >ตำแหน่ง<!--(มสด.)--> : </td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr >
                <td width="19%" align="left"><?
    $sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC ";
	$stid_position = oci_parse($conn, $sql_position);
	oci_execute($stid_position);
	$option_position="<option value=''>เลือก</option>";
	while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
		if($row["CWK_DSU_POS"] == $row_position["CODE"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_position .= "<option value='".$row_position["CODE"]."' $select>".$row_position["POSITION"]."</option>\n";
	}
	?>
                  <select name="cwk_dsu_pos" id="cwk_dsu_pos" class="widthFix2" style="width:480px;" >
                    <?=$option_position?>
                  </select></td>
                <!--
    <td width="42%" align="right" class="form_text" >ตำแหน่งทางวิชาการ :</td>
    <td width="39%" align="left">&nbsp;<?
    $sql_mua_vpos = "SELECT * FROM  ".TB_REF_POSITION."  WHERE POSITION_NAME_ENG = 'ตำแหน่งทางวิชาการ' OR POSITION_ID = '00' ORDER BY POSITION_ID DESC ";
	$stid_mua_vpos = oci_parse($conn, $sql_mua_vpos);
	oci_execute($stid_mua_vpos);
	//$option_mua_vpos="<option value=''>เลือก</option>";
	while(($row_mua_vpos = oci_fetch_array($stid_mua_vpos, OCI_BOTH))){
		if($row["CWK_MUA_VPOS"] == $row_mua_vpos["POSITION_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			//$option_mua_vpos .= "<option value='".$row_mua_vpos["POSITION_ID"]."' $select>".$row_mua_vpos["POSITION_NAME_TH"]."</option>\n";
	}
	?>
      <select name="cwk_mua_vpos" id="cwk_mua_vpos" class="widthFix2">
        <?//$option_mua_vpos?>
      </select></td>
      --> 
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="right" class="form_text" >เลขที่ตำแหน่ง : </td>
          <td align="left"><input type="text" name="position_code" id="position_code" style="width: 100px; " class="input_text" value="<?=$row["POSITION_CODE"];?>"/></td>
        </tr>
        <!-------------------------------------->
        
        <tr>
          <td align="right" class="form_text" > ตำแหน่งทางวิชาการ<!--(สกอ.)--> :</td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="19%" align="left"><?
    $sql_mua_vpos = "SELECT * FROM  ".TB_REF_POSITION."  WHERE POSITION_NAME_ENG = 'ตำแหน่งทางวิชาการ' OR POSITION_ID = '00' ORDER BY POSITION_ID DESC ";
	$stid_mua_vpos = oci_parse($conn, $sql_mua_vpos);
	oci_execute($stid_mua_vpos);
	$option_mua_vpos="<option value=''>เลือก</option>";
	while(($row_mua_vpos = oci_fetch_array($stid_mua_vpos, OCI_BOTH))){
		if($row["CWK_MUA_VPOS"] == $row_mua_vpos["POSITION_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_mua_vpos .= "<option value='".$row_mua_vpos["POSITION_ID"]."' $select>".$row_mua_vpos["POSITION_NAME_TH"]."</option>\n";
	}
	?>
                  <select name="cwk_mua_vpos" id="cwk_mua_vpos" class="widthFix2" style="width:480px;">
                    <?=$option_mua_vpos?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <!-------------------------------------->
        <tr>
          <td align="right" class="form_text">ระดับตำแหน่ง<!--(สกอ.)--> : </td>
          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="19%" align="left"><?
    $sql_mua_level = "SELECT * FROM  ".TB_REF_STAFF_LEV." ORDER BY STAFF_LEV_ID ASC ";
	$stid_mua_level = oci_parse($conn, $sql_mua_level);
	oci_execute($stid_mua_level);
	$option_mua_level="<option value=''>เลือก</option>";
	while(($row_mua_level = oci_fetch_array($stid_mua_level, OCI_BOTH))){
		if($row["CWK_MUA_LEVEL"] == $row_mua_level["STAFF_LEV_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_mua_level .= "<option value='".$row_mua_level["STAFF_LEV_ID"]."' $select>".$row_mua_level["STAFF_LEV_NAME"]."</option>\n";
	}
	?>
                  <select name="cwk_mua_level" id="cwk_mua_level" class="widthFix2" style="width:480px;">
                    <?=$option_mua_level?>
                  </select></td>

              </tr>
            </table></td>
        </tr>
        
        <!------------------------------------->
        <tr>
          <td  align="right" class="form_text" >ตำแหน่งบริหาร<!--(สกอ.)--> : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  ORDER BY ADMIN_NAME ASC ";
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$option_mua_mpos="<option value=''>เลือก</option>";
	$cwk_mua_mpos=$row["CWK_MUA_MPOS"];
	while(($row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH))){
		if($row["CWK_MUA_MPOS"] == $row_mua_mpos["ADMIN_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_mua_mpos .= "<option value='".$row_mua_mpos["ADMIN_ID"]."' $select>".$row_mua_mpos["ADMIN_NAME"]."</option>\n";
	}
	?>
                  <select name="cwk_mua_mpos" id="cwk_mua_mpos" style="width:480px;" onchange="open_executives_data(this);">
                    <?=$option_mua_mpos?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives1" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#E8E3F9">
          <td  align="right" class="form_text" >ตำแหน่งบริหาร 1<!--(สกอ.)--> : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  ORDER BY ADMIN_NAME ASC ";
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$option_mua_mpos="<option value=''>เลือก</option>";


	while(($row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH))){
		if($ex_admin_department["POSITION"][0] == $row_mua_mpos["ADMIN_ID"])
          { $select="selected = 'selected'";}else{ $select="";}
			$option_mua_mpos .= "<option value='".$row_mua_mpos["ADMIN_ID"]."' $select>".$row_mua_mpos["ADMIN_NAME"]."</option>\n";
	}
	?>
                  <select name="cwk_position1" id="cwk_position1"  style="width:480px;"  >
                    <?=$option_mua_mpos?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data1" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#E8E3F9">
          <td  align="right" class="form_text" > หน่วยงานหลักที่บริหาร 1 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value=''>เลือก</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
		if($ex_admin_department["CODE_FACULTY"][0] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
	?>
                  <select name="cwk_mua_main_data1" id="cwk_mua_main_data1" style="width:480px;"  onchange="load_depsub3(this.value)">
                    <?=$option_ref_department?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data2" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#E8E3F9">
          <td  align="right" class="form_text" > หน่วยงานย่อยที่บริหาร 1 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div id="ajax_depsub3">
                    <?
			 if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$ex_admin_department["CODE_FACULTY"][0]."'  ORDER BY NAME_DEPARTMENT_SECTION ASC ";
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
		if($ex_admin_department["CODE_DEPARTMENT_SECTION"][0] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>";
	}

	?>
                    <select name="cwk_mua_submain_data1" id="cwk_mua_submain_data1" style="width:480px;" >
                      <? echo $option_ref_department_sub; ?>
                    </select>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives2" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#D7EBFF">
          <td  align="right" class="form_text" >ตำแหน่งบริหาร 2<!--(สกอ.)--> : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  ORDER BY ADMIN_NAME ASC ";
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$option_mua_mpos="<option value=''>เลือก</option>";
	while(($row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH))){
		if($ex_admin_department["POSITION"][1] == $row_mua_mpos["ADMIN_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_mua_mpos .= "<option value='".$row_mua_mpos["ADMIN_ID"]."' $select>".$row_mua_mpos["ADMIN_NAME"]."</option>\n";
	}
	?>
                  <select name="cwk_position2" id="cwk_position2" style="width:480px;"  >
                    <?=$option_mua_mpos?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data3" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#D7EBFF">
          <td  align="right" class="form_text" > หน่วยงานหลักที่บริหาร 2 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value=''>เลือก</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
		if($ex_admin_department["CODE_FACULTY"][1] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
	?>
                  <select name="cwk_mua_main_data2" id="cwk_mua_main_data2" style="width:480px;"  onchange="load_depsub4(this.value)">
                    <?=$option_ref_department?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data4" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#D7EBFF" >
          <td  align="right" class="form_text" > หน่วยงานย่อยที่บริหาร 2 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div id="ajax_depsub4">
                    <?
			 if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$ex_admin_department["CODE_FACULTY"][1]."'  ORDER BY NAME_DEPARTMENT_SECTION ASC ";
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
		if($ex_admin_department["CODE_DEPARTMENT_SECTION"][1] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
	}
	?>
                    <select name="cwk_mua_submain_data4" id="cwk_mua_submain_data4"  style="width:480px;" >
                      <?=$option_ref_department_sub?>
                    </select>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives3" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#FBDBD0">
          <td  align="right" class="form_text" >ตำแหน่งบริหาร 3<!--(สกอ.)--> : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  ORDER BY ADMIN_NAME ASC ";
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$option_mua_mpos="<option value=''>เลือก</option>";
	while(($row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH))){
		if($ex_admin_department["POSITION"][2] == $row_mua_mpos["ADMIN_ID"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_mua_mpos .= "<option value='".$row_mua_mpos["ADMIN_ID"]."' $select>".$row_mua_mpos["ADMIN_NAME"]."</option>\n";
	}
	?>
                  <select name="cwk_position3" id="cwk_position3" style="width:480px;"  >
                    <?=$option_mua_mpos?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data5" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#FBDBD0">
          <td  align="right" class="form_text" > หน่วยงานหลักที่บริหาร 3 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$option_ref_department="<option value=''>เลือก</option>";
	while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
		if($ex_admin_department["CODE_FACULTY"][2] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
	}
	//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
	?>
                  <select name="cwk_mua_main_data3" id="cwk_mua_main_data3" style="width:480px;"  onchange="load_depsub5(this.value)">
                    <?=$option_ref_department?>
                  </select></td>
              </tr>
            </table></td>
        </tr>
        <tr id="executives_data6" <? if($cwk_mua_mpos=="00" or $cwk_mua_mpos==""){ ?>style="display:none;" <? } ?> bgcolor="#FBDBD0">
          <td  align="right" class="form_text" > หน่วยงานย่อยที่บริหาร 3 : </td>
          <td  align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div id="ajax_depsub5">
                    <?
			 if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$ex_admin_department["CODE_FACULTY"][2]."'  ORDER BY NAME_DEPARTMENT_SECTION ASC ";
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$option_ref_department_sub="<option value=''>เลือก</option>";
	while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
		if($ex_admin_department["CODE_DEPARTMENT_SECTION"][2] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
			$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
	}
	?>
                    <select name="cwk_mua_submain_data5" id="cwk_mua_submain_data5"  style="width:480px;" >
                      <?=$option_ref_department_sub?>
                    </select>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="right" class="form_text">* วันที่เข้าทำงาน :</td>
          <td align="left"><input type="text"  name="cwk_start_work_date" id="cwk_start_work_date" style="width: 80px; " class="input_text" value="<?=change_date_thai($row["CWK_START_WORK_DATE"])?>"/>
            <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cwk_start_work_date','YYYY-MM-DD')"  style="cursor:pointer"/>&nbsp; &nbsp;วันครบทดลองปฏิบัติงาน :
            <input type="text"  name="cwk_end_work_date" id="cwk_end_work_date" style="width: 80px; " class="input_text" value="<?=change_date_thai($row["CWK_END_WORK_DATE"])?>"/>
            <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cwk_end_work_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
        </tr>
        <?
	$q1=substr($row["CWK_START_WORK"], 0, 2);
	$q2=substr($row["CWK_START_WORK"], 3, 2);
	$q3=substr($row["CWK_END_WORK"], 0, 2);
	$q4=substr($row["CWK_END_WORK"], 3, 2);
	 ?>
        <tr>
          <td align="right" class="form_text">ช่วงเวลาปฏิบัติงานตั้งแต่เวลา :</td>
          <td align="left" class="form_text"><input type="text" name="cwk_start_work_hour" id="cwk_start_work_hour" style="width: 25px; " class="input_text" value="<? if($row["CWK_START_WORK"]==":"){ }else {echo $q1;}?>"/>
            :
            <input type="text" name="cwk_start_work_min" id="cwk_start_work_min" style="width: 25px; " class="input_text" value="<? if($row["CWK_START_WORK"]==":"){ }else {echo $q2;}?>"/>
            น.
            &nbsp;&nbsp;&nbsp; ถึงเวลา &nbsp;&nbsp;&nbsp;
            <input type="text" name="cwk_end_work_hour" id="cwk_end_work_hour" style="width: 25px; " class="input_text" value="<? if($row["CWK_END_WORK"]==":"){ }else {echo $q3;}?>"/>
            :
            <input type="text" name="cwk_end_work_min" id="cwk_end_work_min" style="width: 25px; " class="input_text" value="<? if($row["CWK_END_WORK"]==":"){ }else {echo $q3;}?>" />
            น. </td>
        </tr>
        <tr>
          <td align="right" class="form_text">วันที่ทดลองปฏิบัติการสอน :</td>
          <td align="left"><input type="text" name="cwk_start_teach_date" id="cwk_start_teach_date" style="width: 80px; " class="input_text" value="<?=change_date_thai($row["CWK_START_TEACH_DATE"])?>"/>
            <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cwk_start_teach_date','YYYY-MM-DD')"  style="cursor:pointer"/>&nbsp; &nbsp; คำสั่งที่
            <input type="text" id="cwk_order1" name="cwk_order1" class="input_text" style="width: 90px" value="<?=$row["CWK_ORDER1"]?>" />
            <label> สั่ง ณ : </label>
            <input type="text"  name="cwk_teach_order" id="cwk_teach_order" style="width: 120px; " value="<?=$row['CWK_TEACH_ORDER']?>"  class="input_text" /></td>
        </tr>
        <tr>
          <td align="right" class="form_text">วันที่ปรับตำแหน่ง :</td>
          <td align="left"><input type="text"  name="cwk_promote_date" id="cwk_promote_date" style="width: 80px; " class="input_text" value="<?=change_date_thai($row["CWK_PROMOTE_DATE"])?>"/>
            <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cwk_promote_date','YYYY-MM-DD')"  style="cursor:pointer"/>&nbsp; &nbsp; คำสั่งที่
            <input type="text" id="cwk_order2" name="cwk_order2" class="input_text" style="width: 90px" value="<?=$row["CWK_ORDER2"]?>"/>
            <label> สั่ง ณ : </label>
            <input type="text"  name="cwk_promote_order" id="cwk_promote_order" style="width: 120px; " value="<?=$row['CWK_PROMOTE_ORDER']?>"  class="input_text" /></td>
        </tr>
        <tr>
          <td align="right" >ทำงานวันหยุด : </td>
          <td align="left"><input type="checkbox" id="cwk_sat" name="cwk_sat" value="1" <? if($row["CWK_SAT"] == "1"){ echo "checked = 'checked'";}?> />
            วันเสาร์
            <input type="checkbox" id="cwk_sun" name="cwk_sun" value="1" <? if($row["CWK_SUN"] == "1"){ echo "checked = 'checked'";}?>/>
            วันอาทิตย์</td>
        </tr>
        <tr>
          <td align="right" >&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" >เงินเดือน :</td>
          <td align="left">&nbsp;<input type="text" id="salary" name="salary" class="input_text" value="<?=number_format($salary,2)?>" style="text-align:right"<?php if($_SESSION['USER_TYPE'] != 'admin') { ?>  readonly="readonly"<?php } ?> />
          บาท    &nbsp;&nbsp;ประกอบด้วย</td>
        </tr>
        <tr>
          <td height="140" colspan="2" align="center" valign="middle" >
            <?


$sql_time = "SELECT * FROM  ".TB_REF_TIME_CONTACT."  ORDER BY TIME_CONTACT_ID ASC ";
$stid_time = oci_parse($conn, $sql_time );
oci_execute($stid_time);
$option_time="<option value=''>เลือก</option>";

while(($row_time = oci_fetch_array($stid_time, OCI_BOTH))){
	 if($row["CWK_SALARY_TIME_TYPE"] == $row_time["TIME_CONTACT_ID"]){ $select="selected = 'selected'";}else{ $select="";}
	$option_time .= "<option value='".$row_time["TIME_CONTACT_ID"]."' $select>".$row_time["TIME_CONTACT_NAME"]."</option>\n";
}

$sql_teach = "SELECT * FROM  ".TB_REF_ISCED."  ORDER BY ISCED_NAME_TH ASC ";
$stid_teach = oci_parse($conn, $sql_teach );
oci_execute($stid_teach);

$option_teach = array();
for($i=1;$i<4;$i++){
	$option_teach[$i]="<option value=''>เลือก</option>";
}
while(($row_teach = oci_fetch_array($stid_teach, OCI_BOTH))){
	for($i=1;$i<4;$i++){
		 if($row["CWK_EDU_GROUP{$i}"] == $row_teach["ISCED_ID"]){ $select="selected = 'selected'";}else{ $select="";}
		$option_teach[$i] .= "<option value='".$row_teach["ISCED_ID"]."' $select>".$row_teach["ISCED_NAME_TH"]."</option>\n";
	}

}
?>
            <table width="726" border="0" cellspacing="3" cellpadding="3" align="right">
              <tr>
                <td width="206" align="right" class="form_text">ส่วนแรก :ใช้งบประมาณ</td>
                <td width="130" align="left" class="form_text"><select id="cwk_budget1" name="cwk_budget1" style="width: 130px">
                    <?=$option[1]?>
                  </select></td>
                <td width="85" align="center" class="form_text">จำนวนเงิน</td>
                <td width="146" align="left" class="form_text"><input type="text" name="cwk_total1" id="cwk_total1" style="width: 100px; text-align:right " class="input_text"  value="<?=number_format($row_salary["SALARY1"],2)?>" onblur="total_salary()" onkeyup="total_salary()"<?php if($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?>  readonly="readonly"<?php } ?>/>
                  บาท</td>
                <td width="110" class="form_text">&nbsp;</td>
              </tr>
              <tr>
                <td align="right"  class="form_text">ส่วนที่สอง :ใช้งบประมาณ</td>
                <td align="left"  class="form_text"><select id="cwk_budget2" name="cwk_budget2" style="width: 130px">
                    <?=$option[2]?>
                  </select></td>
                <td align="center"  class="form_text"><span class="form_text">จำนวนเงิน</span></td>
                <td align="left"  class="form_text"><input type="text" name="cwk_total2" id="cwk_total2" style="width: 100px;text-align:right " class="input_text"  value="<?=number_format($row_salary["SALARY2"],2)?>" onblur="total_salary()" onkeyup="total_salary()"<?php if($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?>  readonly="readonly"<?php } ?>/>
                  บาท</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right"  class="form_text">ส่วนที่สาม :ใช้งบประมาณ</td>
                <td align="left"  class="form_text"><select id="cwk_budget3" name="cwk_budget3" style="width: 130px">
                    <?=$option[3]?>
                  </select></td>
                <td align="center"  class="form_text"><span class="form_text">จำนวนเงิน</span></td>
                <td align="left"  class="form_text"><input type="text" name="cwk_total3" id="cwk_total3" style="width: 100px; text-align:right " class="input_text"  value="<?=number_format($row_salary["SALARY3"],2)?>" onblur="total_salary()" onkeyup="total_salary()"<?php if($_SESSION['USER_TYPE'] != 'admin' && $_SESSION['USER_TYPE'] != 'hr') { ?>  readonly="readonly"<?php } ?>/>
                  บาท</td>
                <td align="left"><input type="button" value="ดูประวัติเงินเดือน" onclick="salary_history('<?=$_SESSION["EMP_ID"]?>')" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="left" ><div align="left" style="padding-left: 90px; font-size:16px">เงินพิเศษ</div>
            <br />
            <div id="ex_salary_list" align="center">
              <? include "ex_salary_list.php";?>
            </div>
            <br />
            <span  id="morefile"></span><br />
            <div style="padding-left: 140px" align="left">
              <input type="button" id="addfile" value="เพิ่ม" />
            </div>
            <br /></td>
        </tr>
        <tr>
          <td width="385" align="right" class="form_text">ประเภทระยะเวลาการว่าจ้าง :</td>
          <td width="880" align="left"><select name="cwk_salary_time_type" id="cwk_salary_time_type" style="width: 500px">
              <option value="">-------------------- เลือกระยะเวลาการว่าจ้าง ---------------------------</option>
              <?
				$sql_time = "SELECT * FROM  ".TB_REF_TIME_CONTACT."  ORDER BY TIME_CONTACT_ID ASC ";
				$stid_time = oci_parse($conn, $sql_time );
				oci_execute($stid_time);
				while(($row_time = oci_fetch_array($stid_time, OCI_BOTH))){
			 ?>
              <option value="<?=$row_time["TIME_CONTACT_ID"] ?>"<? if($row["CWK_SALARY_TIME_TYPE"]==$row_time["TIME_CONTACT_ID"]){ ?> selected = "selected"<? } ?>>
              <?=$row_time["TIME_CONTACT_NAME"] ?>
              </option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td align="right" class="form_text">* เบอร์ติดต่อภายใน :</td>
          <td align="left"><input type="text" name="cwk_phone" id="cwk_phone" style="width: 100px; " class="input_text" value="<?=$row["CWK_PHONE"]?>"/></td>
        </tr>
        <tr>
          <td align="right" class="form_text">กลุ่มวิชาที่สอน กลุ่มที่ 1 :</td>
          <td align="left"><select name="cwk_edu_group1" id="cwk_edu_group1" style="width: 500px">
              <?=$option_teach[1]?>
            </select></td>
        </tr>
        <tr>
          <td align="right" class="form_text">กลุ่มวิชาที่สอน กลุ่มที่ 2 :</td>
          <td align="left"><select name="cwk_edu_group2" id="cwk_edu_group2" style="width: 500px">
              <?=$option_teach[2]?>
            </select></td>
        </tr>
        <tr>
          <td align="right" class="form_text">กลุ่มวิชาที่สอน กลุ่มที่ 3 :</td>
          <td align="left"><select name="cwk_edu_group3" id="cwk_edu_group3" style="width: 500px">
              <?=$option_teach[3]?>
            </select></td>
        </tr>
        <tr>
          <td align="right" class="form_text">ใบประกอบวิชาชีพครู : </td>
          <td align="left" style="color:#663; font-size:11px" valign="middle"><div id="show_upload1">
              <?
		if($row["CWK_TEACHER_FILE"] == ""){
		?>
              <input type="file" name="cwk_teacher_file" id="cwk_teacher_file" class="file_upload"/>
              เฉพาะ .jpg, .gif, .bmp, .png, .pdf
              <?
		}else{
			$file = $row["CWK_TEACHER_FILE"];
			echo "<input type=\"file\" name=\"cwk_teacher_file\" id=\"cwk_teacher_file\" style=\"display:none \" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/cwk_teacher_file/$file','cwk_teacher_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"Document\" alt=\"Document\" /></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('1','cwk_teacher_file','$file','macosx100.png','Document')\"/>";
		}
        ?>
            </div></td>
        </tr>
        <!-- //---------------------------------------------------------------------------------------------------------------------------------------------------------->
        <tr>
          <td align="right" class="form_text">ใบรับรอง : </td>
          <td align="left" style="color:#663; font-size:11px" valign="middle"><div id="show_upload2">
              <?
		if($row["CWK_CERT_FILE"] == ""){
		?>
              <input type="file" name="cwk_cert_file" id="cwk_cert_file" class="file_upload"/>
              เฉพาะ .jpg, .gif, .bmp, .png, .pdf
              <?
		}else{
			$file = $row["CWK_CERT_FILE"];
			echo "<input type=\"file\" name=\"cwk_cert_file\" id=\"cwk_cert_file\" style=\"display:none \" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/cwk_cert_file/$file','cwk_cert_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"Document\" alt=\"Document\" /></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('1','cwk_cert_file','$file','macosx100.png','Document')\"/>";
		}
        ?>
            </div></td>
        </tr>
        <tr>
          <td colspan="6"><? include("current_work_help_gov.php")?></td>
        </tr>

        <tr>
          <td align="right" >&nbsp;</td>
          <td align="left"><?
        if($row["CWK_TEACHER_FILE"] != ""){
			echo "<input type='hidden' id='hid_cwk_teacher_file' name='hid_cwk_teacher_file' value='".$row["CWK_TEACHER_FILE"]."' />";
		}
		?>
            <?
        if($row["CWK_CERT_FILE"] != ""){
			echo "<input type='hidden' id='hid_cwk_cert_file' name='hid_cwk_cert_file' value='".$row["CWK_CERT_FILE"]."' />";
		}
		?></td>
        </tr>
          
        

      
      <tr>
        <td width="385" colspan="2" align="center">
        <?php
		 if($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') {
		?>

<img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;" onclick="check_data();"/>
<img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="load_page3('current_work.php');" style="cursor:pointer;" />

          <?php
		
		 }
		?>        
        </td>
      </tr>
       <tr>
        <td width="385" colspan="2" align="center"><span id="waiting"></span></td>
      </tr>
    </table>
        
       
      </form>    
  </div>

<?
/*
echo "<pre>";
print_r($option);
echo "</pre>";
*/
$sql = "SELECT *  FROM SDU_REF_POSITION_CODE WHERE  EMP_ID='".$_SESSION["EMP_ID"]."' ";
$st = oci_parse($conn, $sql);
oci_execute($st);
$rc = oci_fetch_array($st, OCI_ASSOC);
$db->closedb($conn);
?>
<script>

function load_position_code(code){
	//alert(code);
	$("#position_code option").remove();
	$.ajax({
          type: 'POST',
          url : 'ajax_position_code.php',
          data : { f_code : $("#cwk_mua_main").val(),code:code},
          success : function(data){
             $("#position_code").append(data);
			 //$("#position_code").val(code);
          }
    });
}

load_position_code('<?=$rc["POSITION_CODE"]?>');
</script> 