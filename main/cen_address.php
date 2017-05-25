<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT * FROM  ".TB_CEN_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 

$row = $db->fetch($sql,$conn);
?>
<script type="text/javascript" language="javascript">
function cennn_address(){
$("#cu_house_no").val($("#ca_house_no").val());
$("#cu_moo").val($("#ca_moo").val());
$("#cu_building").val($("#ca_building").val());
$("#cu_village").val($("#ca_village").val());
$("#cu_room").val($("#ca_room").val());
$("#cu_soi").val($("#ca_soi").val());
$("#cu_road").val($("#ca_road").val());
$("#cu_country").val($("#ca_country").val());
$("#cu_country_text").val($("#ca_country_text").val());

/*$("select#cu_tumbon").val($("select#ca_tumbon").val());
$("select#cu_amphur").val($("select#ca_amphur").val());
$("select#cu_province").val($("select#ca_province").val());*/

/*

$("span#tumbon2").html("\n<select id='cu_tumbon' name='cu_tumbon' style='width: 130px'>"+$("select#ca_tumbon").html()+"</select>\n");
$("div#amphur2").html("\n<select id='cu_amphur' name='cu_amphur' style='width: 130px'>"+$("select#ca_amphur").html()+"</select>\n");
$("div#province2").html("\n<select id='cu_province' name='cu_province' style='width: 130px'>"+$("select#ca_province").html()+"</select>\n");
*/

$("span#tumbon2").html("<input type='hidden' name='cu_tumbon' id='cu_tumbon' value='"+$("#ca_tumbon").val()+"'><input readonly='readonly' type='text' style='width: 120px;'  value='"+$("#ca_tumbon_show").val()+"'>");
$("div#amphur2").html("<input type='hidden' name='cu_amphur' id='cu_amphur' value='"+$("#ca_amphur").val()+"' /> <input type='text' style='width: 120px;' readonly='readonly' value='"+$("#ca_amphur_show").val()+"' />");
$("div#province2").html("<input type='hidden' name='cu_province' id='cu_province' value='"+$("#ca_province").val()+"' /><input type='text' style='width: 120px;' readonly='readonly' value='"+$("#ca_province_show").val()+"' />");

$("#cu_post_code").val($("#ca_post_code").val());

	
}

function check_data(){
		
		if($("#ca_house_no").val() == "" || $("#ca_tumbon").val() == "" || $("#ca_amphur").val() == "" || $("#ca_province").val() == "" || $("#ca_post_code").val() == ""){
			$("#Please_fill_in").dialog('open');
				return false;
		}
		
		/*if(!Checkfiles($("input#ca_cen_file"))){
				$("input#ca_cen_file").val("");
				$("#Valid_cen_file").dialog('open');
				return false;
		}*/
	
		$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
		document.getElementById("cen_address").submit();
}

function show_upload(id,target,file,pic,title){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" class=\"file_upload\" /> <input type=\"button\" value=\"Cancel\" onclick=\"cancel_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"')\"/>  เฉพาะ .jpg, .gif, .bmp, .png, .doc, .docx");
}

function cancel_upload(id,target,file,pic,title){
	$("div#show_upload"+id).html("<input type=\"file\" name=\""+target+"\" id=\""+target+"\" style=\"display:none\" class=\"file_upload\"/><span style='font-size: 14px'><img src=\"../images/"+pic+"\" height=\"20\" border=\"0\" onclick=\"window.open('files/ca_data_file/"+file+"','"+target+"','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\""+title+"\" alt=\"Present Photo\"/> &nbsp;&nbsp;&nbsp;<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('"+id+"','"+target+"','"+file+"','"+pic+"','"+title+"')\"/>");
}

function search_tumbon1(txt){
	//alert(txt);
	var data = "";
      
	data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
	ajaxPostData("_find_location1.php",data,"text","result_search_address1",result_search_tumbon1,"","");
      }
}

function result_search_tumbon1(response){
	if(response == "0"){
		$('#result_search_address1').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
	}else{
		$('#result_search_address1').html(response);
	}
}

function search_tumbon2(txt){
	//alert(txt);
	var data = "";
	data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
	ajaxPostData("_find_location2.php",data,"text","result_search_address2",result_search_tumbon2,"","");
      }
}

function result_search_tumbon2(response){
	if(response == "0"){
		$('#result_search_address2').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
	}else{
		$('#result_search_address2').html(response);
	}
}

function pick_location1(id){
	var tumbon = $('#t'+id).val();
	var amphur = $('#a'+id).val();
	var province = $('#p'+id).val();
    var postcode = $('#c'+id).val();
	var n1 = $('#n1'+id).val();
	var n2 = $('#n2'+id).val();
	var n3 = $('#n3'+id).val();
	/*
	$("span#tumbon").html("<select id='ca_tumbon' name='ca_tumbon' style='width: 130px'><option value='"+tumbon+"'>"+n1+"</option></select>");
	$("div#amphur").html("<select id='ca_amphur' name='ca_amphur' style='width: 130px'><option value='"+amphur+"'>"+n2+"</option></select>");
	$("div#province").html("<select id='ca_province' name='ca_province' style='width: 130px' ><option value='"+province+"'>"+n3+"</option></select>");
	*/
	
	$("span#tumbon").html("<input type='hidden' name='ca_tumbon' id='ca_tumbon' value='"+tumbon+"'><input type='text' readonly='readonly' id='ca_tumbon_show' style='width: 120px;'  value='"+n1+"'>");
	$("div#amphur").html("<input type='hidden' name='ca_amphur' id='ca_amphur' value='"+amphur+"' /> <input type='text' id='ca_amphur_show' style='width: 120px;' readonly='readonly' value='"+n2+"' />");
	$("div#province").html("<input type='hidden' name='ca_province' id='ca_province' value='"+province+"' /><input type='text' id='ca_province_show' readonly='readonly' style='width: 120px;' value='"+n3+"' />");
	$("#ca_post_code").val(postcode);
	$("#search_location1").val("");
	$("div#result_search_address1").html("");
	$('#dialog_address1').dialog('close');
}

function pick_location2(id){
	var tumbon = $('#t'+id).val();
	var amphur = $('#a'+id).val();
	var province = $('#p'+id).val();
    var postcode = $('#c'+id).val();
	var n1 = $('#n1'+id).val();
	var n2 = $('#n2'+id).val();
	var n3 = $('#n3'+id).val();
	/*
	$("span#tumbon2").html("<select id='cu_tumbon' name='cu_tumbon' style='width: 130px'><option value='"+tumbon+"'>"+n1+"</option></select>");
	$("div#amphur2").html("<select id='cu_amphur' name='cu_amphur' style='width: 130px'><option value='"+amphur+"'>"+n2+"</option></select>");
	$("div#province2").html("<select id='cu_province' name='cu_province' style='width: 130px'><option value='"+province+"'>"+n3+"</option></select>");
	*/
	$("span#tumbon2").html("<input type='hidden' name='cu_tumbon' id='cu_tumbon' value='"+tumbon+"'><input readonly='readonly' type='text' style='width: 120px;'  value='"+n1+"'>");
	$("div#amphur2").html("<input type='hidden' name='cu_amphur' id='cu_amphur' value='"+amphur+"' /> <input readonly='readonly' type='text' style='width: 120px;' value='"+n2+"' />");
	$("div#province2").html("<input type='hidden' name='cu_province' id='cu_province' value='"+province+"' /><input readonly='readonly' type='text' style='width: 120px;' value='"+n3+"' />");
	$("#cu_post_code").val(postcode);
	$("#search_location2").val("");
	$("div#result_search_address2").html("");
	$('#dialog_address2').dialog('close');
}

function search_nation6(txt){
	//alert(txt);
	var data = "";
	data += "txt="+txt;
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
	ajaxPostData("_find_nation6.php",data,"text","result_search_nation6",result_search_nation6,"","");
      }
}

function result_search_nation6(response){
	if(response == "0"){
		$('#result_search_nation6').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
	}else{
		$('#result_search_nation6').html(response);
	}
}

function pick_nation6(id){
	var id_nation = $('#id'+id).val();
	var name_nation = $('#name'+id).val();
	
	$("span#nation6").html("<input type='hidden' id='cu_country' name='cu_country' value='"+id_nation+"' /><input type='text' value='"+name_nation+"' style='width:120px;' readonly='readonly'>");
	
	$("#search_nation6").val("");
	$("div#result_search_nation6").html("");
	$('#dialog_nation6').dialog('close');
}




function search_nation7(txt){
	//alert(txt);
	var data = "";
	data += "txt="+txt;
	
            if(txt==""){
         alert('คุณต้องกรอกอย่างน้อย 1 ตัวอักษร');
      }else{
	ajaxPostData("_find_nation12.php",data,"text","result_search_nation7",result_search_nation7,"","");
      }
}

function result_search_nation7(response){
	if(response == "0"){
		$('#result_search_nation7').html("<h3 style='color:red' >ไม่พบข้อมูล</h3>");
	}else{
		$('#result_search_nation7').html(response);
	}
}

function pick_nation7(id){
	var id_nation = $('#id'+id).val();
	var name_nation = $('#name'+id).val();
	
	$("span#nation7").html("<input type='hidden' id='ca_country' name='ca_country' value='"+id_nation+"' /><input type='text' value='"+name_nation+"' style='width:120px;' readonly='readonly2'>");
	
	$("#search_nation7").val("");
	$("div#result_search_nation7").html("");
	$('#dialog_nation7').dialog('close');
}




$(function() {

		  	
		$('#dialog_address1').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'500',
			height: '300',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
					$("#search_location1").val("");
					$("div#result_search_address1").html("");
				}
			}
		});
		
		$('#dialog_address2').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'500',
			height: '300',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
					$("#search_location2").val("");
					$("div#result_search_address2").html("");
				}
			}
		});

		$( "#opener1" ).click(function() {
			$( "#dialog_address1" ).dialog( "open" );
			return false;
		});
		
		$( "#opener2" ).click(function() {
			$( "#dialog_address2" ).dialog( "open" );
			return false;
		});
		
		$('#dialog_nation6').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'500',
			height: '400',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
					$("#search_nation6").val("");
					$("div#result_search_nation6").html("");
				}
			}
		});

	$( "#opener6" ).click(function() {
			$( "#dialog_nation6" ).dialog( "open" );
			return false;
		});
		
		$('#dialog_nation7').dialog({
			autoOpen: false,
			modal: true,
			hide: 'slide',
			show: 'slide',
			width:'500',
			height: '400',
			buttons: {
				ปิด: function() {
					$(this).dialog('close');
					$("#search_nation7").val("");
					$("div#result_search_nation7").html("");
				}
			}
		});

	$( "#opener7" ).click(function() {
			$( "#dialog_nation7" ).dialog( "open" );
			return false;
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
		
		
		
 });
</script>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<div style="display:none">

<div id="dialog_address1" title="ระบบค้นหาที่อยู่">
	<p align="center">
    กรอกตำบล : <input type="text" id="search_location1" name="search_location1" class="input_text" style="width:120px"  /> <input type="button" value="ค้นหา" onclick="search_tumbon1($('#search_location1').val())"/>
    </p>
    <div id="result_search_address1" align="center"></div>
</div>

<div id="dialog_address2" title="ระบบค้นหาที่อยู่">
	<p align="center">
    กรอกตำบล : <input type="text" id="search_location2" name="search_location2" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_tumbon2($('#search_location2').val())"/>
    </p>
    <div id="result_search_address2" align="center"></div>
</div>

</div>
<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td valign="top">
    <form id="cen_address" name="cen_address" enctype="multipart/form-data" method="post" action="cen_address_save.php" target="upload_target" onsubmit="o_input();">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="187" align="right" class="form_text">* บ้านเลขที่ :</td>
        <td colspan="2" align="left"><input type="text" name="ca_house_no" id="ca_house_no" style="width: 100px; " class="input_text" value="<?=$row["CA_HOUSE_NO"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่ :</td>
        <td colspan="2" align="left"><input type="text" name="ca_moo" id="ca_moo" style="width: 80px; " class="input_text" value="<?=$row["CA_MOO"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ตึก/อาคาร :</td>
        <td colspan="2" align="left"><input type="text" name="ca_building" id="ca_building" style="width: 120px; " class="input_text" value="<?=$row["CA_BUILDING"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่บ้าน :</td>
        <td colspan="2" align="left"><input type="text" name="ca_village" id="ca_village" style="width: 120px; " class="input_text" value="<?=$row["CA_VILLAGE"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ห้อง :</td>
        <td colspan="2" align="left"><input type="text" name="ca_room" id="ca_room" style="width: 120px; " class="input_text" value="<?=$row["CA_ROOM"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ซอย :</td>
        <td colspan="2" align="left"><input type="text" name="ca_soi" id="ca_soi" style="width: 120px; " class="input_text" value="<?=$row["CA_SOI"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ถนน :</td>
        <td colspan="2" align="left"><input type="text" name="ca_road" id="ca_road" style="width: 120px; " class="input_text" value="<?=$row["CA_ROAD"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" valign="middle" class="form_text">* ตำบล/แขวง :</td>
        <td width="130" align="left" valign="middle">
        <span id='tumbon'>
         <?
		 echo "\n";
    $sql_ca_tumbon = "SELECT * FROM  ".TB_REF_TUMBON."  WHERE  CODE_REF_TUMBON = '".$row["CA_TUMBON"]."' "; 
	$stid_ca_tumbon = oci_parse($conn, $sql_ca_tumbon);
	oci_execute($stid_ca_tumbon);
	while(($row_ca_tumbon = oci_fetch_array($stid_ca_tumbon, OCI_BOTH))){
			//$option_ca_tumbon = "<option value='".$row_ca_tumbon["CODE_REF_TUMBON"]."' >".$row_ca_tumbon["NAME_REF_TUMBON"]."</option>\n";
			$option_ca_tumbon = "<input type='hidden' name='ca_tumbon' id='ca_tumbon' value='".$row_ca_tumbon["CODE_REF_TUMBON"]."'><input type='text' style='width: 120px;' id='ca_tumbon_show' readonly='readonly'  value='".$row_ca_tumbon["NAME_REF_TUMBON"]."'>";
	}
	?>
    <!--
     <select name="ca_tumbon" id="ca_tumbon" style="width: 130px" >
	<?=$option_ca_tumbon?>
            </select>
     -->
     	<?=$option_ca_tumbon?>
        </span></td>
        <td width="401" align="left" valign="middle"><?php if( $_SESSION['USER_TYPE']
		 != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"   style="cursor:pointer; " id="opener1"  title="ค้นหา" /><?php } ?>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="form_text">* อำเภอ/เขต :</td>
        <td colspan="2" align="left">
        <div id='amphur'>
        <?
		echo "\n";
    $sql_ca_amphur = "SELECT * FROM  ".TB_REF_AMPHUR." WHERE  CODE_REF_AMPHUR = '".$row["CA_AMPHUR"]."'  "; 
	$stid_ca_amphur = oci_parse($conn, $sql_ca_amphur);
	oci_execute($stid_ca_amphur);
	while(($row_ca_amphur = oci_fetch_array($stid_ca_amphur, OCI_BOTH))){
			//$option_ca_amphur = "<option value='".$row_ca_amphur["CODE_REF_AMPHUR"]."' >".$row_ca_amphur["NAME_REF_AMPHUR"]."</option>\n";
			$option_ca_amphur='<input type="hidden" name="ca_amphur" id="ca_amphur" value="'.$row_ca_amphur["CODE_REF_AMPHUR"].'" />
     <input type="text" style="width: 120px;" readonly="readonly" id="ca_amphur_show" value="'.$row_ca_amphur["NAME_REF_AMPHUR"].'" />';
	}
	?>
    <!--
     <select name="ca_amphur" id="ca_amphur" style="width: 130px" >
	<?=$option_ca_amphur?>
            </select>
    --> 
    <?=$option_ca_amphur?>
            </div>
       </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* จังหวัด :</td>
        <td colspan="2" align="left">
        <div id='province'>
          <?
		  echo "\n";
    $sql_ca_province = "SELECT * FROM  ".TB_REF_PROVINCE."  WHERE  CODE_REF_PROVINCE = '".$row["CA_PROVINCE"]."' "; 
	$stid_ca_province = oci_parse($conn, $sql_ca_province);
	oci_execute($stid_ca_province);
	while(($row_ca_province = oci_fetch_array($stid_ca_province, OCI_BOTH))){
			//$option_ca_province = "<option value='".$row_ca_province["CODE_REF_PROVINCE"]."' >".$row_ca_province["NAME_REF_PROVINCE"]."</option>\n";
			$option_ca_province = '<input type="hidden" name="ca_province" id="ca_province" value="'.$row_ca_province["CODE_REF_PROVINCE"].'" />
     <input type="text" style="width: 120px;" readonly="readonly" id="ca_province_show" value="'.$row_ca_province["NAME_REF_PROVINCE"].'" />';
	}
	?>
     <!--<select name="ca_province" id="ca_province" style="width: 130px" >
	<?=$option_ca_province?>
            </select>
     -->
     <?=$option_ca_province?>
        </div>
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* รหัสไปรษณีย์ :</td>
        <td colspan="2" align="left"><input type="text" name="ca_post_code" id="ca_post_code" style="width: 50px; " class="input_text"  maxlength="5" value="<?=$row["CA_POST_CODE"]?>"<?php if($_SESSION['USER_TYPE'] == 'user'  || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ประเทศ :</td>
        <td colspan="2" align="left">
        <span id='nation7'>
        <?
    $sql_cu_country = "SELECT * FROM  ".TB_REF_NATION."  WHERE NATION_ID = '".$row["CA_COUNTRY"]."' ORDER BY NATION_NAME_TH ASC "; 
	$stid_cu_country = oci_parse($conn, $sql_cu_country);
	oci_execute($stid_cu_country);
	$row_cu_country = oci_fetch_array($stid_cu_country, OCI_BOTH);
	$name_country2 = $row_cu_country["NATION_NAME_TH"];
	?>

            <input type="hidden" name="ca_country" id="ca_country" value="<?=$row["CA_COUNTRY"]?>" />
            <input type="text" style="width:120" id="ca_country_text" readonly value="<?=$name_country2?>" />
            </span>
            <?php if ($_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener7"  title="ค้นหา"/><?php } ?>
        </td>
      <tr>
     <!-- <tr>
        <td height="20" align="right" class="form_text">ไฟล์ดิจิตอล ทะเบียนบ้าน :</td>
         <td colspan="2" align="left" valign="middle" style="color:#663; font-size:11px">
        <div id="show_upload1">
        <?
	//	if($row["CA_CEN_FILE"] == ""){
		?>
        <input type="file" name="ca_cen_file" id="ca_cen_file" class="file_upload" />
        เฉพาะ .jpg, .gif, .bmp, .png, .pdf
        <?
	/*	}else{
			$file = $row["CA_CEN_FILE"];
			echo "<input type=\"file\" name=\"ca_cen_file\" id=\"ca_cen_file\" style=\"display:none \" class=\"file_upload\"/>";
			echo "<span style='font-size: 14px'><img src=\"../images/macosx100.png\" height=\"20\" border=\"0\" onclick=\"window.open('files/ca_data_file/$file','ca_cen_file','width=500,height=400,resizable=1,scrollbars=1')\" style=\"cursor:pointer\" title=\"Document\" alt=\"Document\" /></span> &nbsp;&nbsp;&nbsp;";
			echo "<input type='button' value='New Upload' style='height:22px;' onclick=\"show_upload('1','ca_cen_file','$file','macosx100.png','Document')\"/>";
		}*/
        ?>
        </div>
        </td>
      </tr>-->
      <tr>
        <td align="right" >&nbsp;</td>
        <td colspan="2" align="left">
          <?
        if($row["CA_CEN_FILE"] != ""){
			echo "<input type='hidden' id='hid_ca_cen_file' name='hid_ca_cen_file' value='".$row["CA_CEN_FILE"]."' />";
		}
		
		$sql = "SELECT * FROM  ".TB_CURRENT_ADDRESS_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
		$row = $db->fetch($sql,$conn);
		?>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top" >
         <table width="740" border="0" cellspacing="4" cellpadding="4">
         <tr>
        <td height="35" colspan="3" align="left"  style="padding-left:30px">
         <div class="head2" align="left">ที่อยู่ปัจจุบัน</div>
        </td>
        </tr>
      <tr>
        <td width="173" align="right" class="form_text">* บ้านเลขที่ :</td>
        <td width="130" align="left"><input type="text" name="cu_house_no" id="cu_house_no" style="width: 100px;" class="input_text" value="<?=$row["CU_HOUSE_NO"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
        &nbsp; &nbsp;</td>
        <td width="397" align="left"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><div style="background-color:#6FF; cursor:pointer;width:140px; " onclick="cennn_address()">ใช้ที่อยู่เดียวกับทะเบียนบ้าน</div><?php } ?>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่ :</td>
        <td colspan="2" align="left"><input type="text" name="cu_moo" id="cu_moo" style="width: 80px;" class="input_text" value="<?=$row["CU_MOO"]?>"<?php if($_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ตึก/อาคาร :</td>
        <td colspan="2" align="left"><input type="text" name="cu_building" id="cu_building" style="width: 120px;" class="input_text" value="<?=$row["CU_BUILDING"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">หมู่บ้าน :</td>
        <td colspan="2" align="left"><input type="text" name="cu_village" id="cu_village" style="width: 120px;" class="input_text" value="<?=$row["CU_VILLAGE"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ห้อง :</td>
        <td colspan="2" align="left"><input type="text" name="cu_room" id="cu_room" style="width: 120px;" class="input_text" value="<?=$row["CU_ROOM"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ซอย :</td>
        <td colspan="2" align="left"><input type="text" name="cu_soi" id="cu_soi" style="width: 120px;" class="input_text" value="<?=$row["CU_SOI"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">ถนน :</td>
        <td colspan="2" align="left"><input type="text" name="cu_road" id="cu_road" style="width: 120px;" class="input_text" value="<?=$row["CU_ROAD"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
      <tr>
        <td align="right" class="form_text">* ตำบล/แขวง :</td>
        <td align="left" valign="middle"> 
         <span id='tumbon2'>
         <?
		 echo "\n";
    $sql_cu_tumbon = "SELECT * FROM  ".TB_REF_TUMBON."  WHERE  CODE_REF_TUMBON = '".$row["CU_TUMBON"]."' "; 
	$stid_cu_tumbon = oci_parse($conn, $sql_cu_tumbon);
	oci_execute($stid_cu_tumbon);
	while(($row_cu_tumbon = oci_fetch_array($stid_cu_tumbon, OCI_BOTH))){
			//$option_cu_tumbon = "<option value='".$row_cu_tumbon["CODE_REF_TUMBON"]."'>".$row_cu_tumbon["NAME_REF_TUMBON"]."</option>\n";
			$option_cu_tumbon = "<input type='hidden' name='cu_tumbon' id='cu_tumbon'  value='".$row_cu_tumbon["CODE_REF_TUMBON"]."' >";
			$option_cu_tumbon .= "<input type='text' readonly='readonly' style='width: 120px;' value='".$row_cu_tumbon["NAME_REF_TUMBON"]."' >";
			//$option_cu_tumbon .="1234";
	}
	//$option_cu_tumbon .="1234";
	?>
    <!--
     <select name="cu_tumbon" id="cu_tumbon" style="width: 130px" >
	<?=$option_cu_tumbon?>
            </select>
     -->
   
     	<?=$option_cu_tumbon?>
        </span></td>
        <td align="left" valign="middle"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="middle" style="cursor:pointer" id="opener2"  title="ค้นหา"/><?php } ?>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="form_text">* อำเภอ/เขต :</td>
        <td colspan="2" align="left">
         <div id='amphur2'>
        <?
		echo "\n";
    $sql_cu_amphur = "SELECT * FROM  ".TB_REF_AMPHUR."  WHERE  CODE_REF_AMPHUR = '".$row["CU_AMPHUR"]."'  "; 
	$stid_cu_amphur = oci_parse($conn, $sql_cu_amphur);
	oci_execute($stid_cu_amphur);
	while(($row_cu_amphur = oci_fetch_array($stid_cu_amphur, OCI_BOTH))){
			//$option_cu_amphur = "<option value='".$row_cu_amphur["CODE_REF_AMPHUR"]."' >".$row_cu_amphur["NAME_REF_AMPHUR"]."</option>\n";
			$option_cu_amphur = "<input type='hidden'  name='cu_amphur' id='cu_amphur' value='".$row_cu_amphur["CODE_REF_AMPHUR"]."' ><input type='text'  value='".$row_cu_amphur["NAME_REF_AMPHUR"]."' readonly='readonly' style='width: 120px' >";
	}
	?>
    <!--
     <select name="cu_amphur" id="cu_amphur" style="width: 130px" >
	<?=$option_cu_amphur?>
            </select>
     -->
     <?=$option_cu_amphur?>
            </div>
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* จังหวัด :</td>
        <td colspan="2" align="left">
        <div id='province2'>
          <?
		  echo "\n";
    $sql_cu_province = "SELECT * FROM  ".TB_REF_PROVINCE." WHERE  CODE_REF_PROVINCE = '".$row["CU_PROVINCE"]."'   "; 
	$stid_cu_province = oci_parse($conn, $sql_cu_province);
	oci_execute($stid_cu_province);
	while(($row_cu_province = oci_fetch_array($stid_cu_province, OCI_BOTH))){
			//$option_cu_province = "<option value='".$row_cu_province["CODE_REF_PROVINCE"]."' >".$row_cu_province["NAME_REF_PROVINCE"]."</option>\n";
			$option_cu_province = "<input type='hidden' name='cu_province' id='cu_province' value='".$row_cu_province["CODE_REF_PROVINCE"]."' ><input type='text'  value='".$row_cu_province["NAME_REF_PROVINCE"]."' readonly='readonly' style='width: 120px' >";
	}
	?>
    <!--
     <select name="cu_province" id="cu_province" style="width: 130px" >
	<?=$option_cu_province?>
            </select>
    -->
    	<?=$option_cu_province?>
        </div>
        </td>
      </tr>
      <tr>
        <td align="right" class="form_text">* รหัสไปรษณีย์ :</td>
        <td colspan="2" align="left"><input type="text" name="cu_post_code" id="cu_post_code" style="width: 50px;" maxlength="5" class="input_text" value="<?=$row["CU_POST_CODE"]?>"<?php if( $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/></td>
      </tr>
        <tr>
        <td align="right" class="form_text">ประเทศ :</td>
        <td colspan="2" align="left">
        <span id='nation6'>
        <?
    $sql_cu_country = "SELECT * FROM  ".TB_REF_NATION."  WHERE NATION_ID = '".$row["CU_COUNTRY"]."' ORDER BY NATION_NAME_TH ASC "; 
	$stid_cu_country = oci_parse($conn, $sql_cu_country);
	oci_execute($stid_cu_country);
	$row_cu_country = oci_fetch_array($stid_cu_country, OCI_BOTH);
	$name_country = $row_cu_country["NATION_NAME_TH"];
	?>

            <input type="hidden" name="cu_country" id="cu_country" value="<?=$row["CU_COUNTRY"]?>" />
            <input type="text" style="width:120" id="cu_country_text" readonly value="<?=$name_country?>" />
            </span>
            <?php if ($_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/search_icon.gif" width="25" border="0"  align="absmiddle" style="cursor:pointer" id="opener6"  title="ค้นหา"/><?php } ?>
        </td>
      <tr>
        <td align="right" >&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      </table>
        
        </td>
        </tr>
      <?php if( $_SESSION['USER_TYPE'] != 'chief') { ?>
       <tr>
        <td align="right" >
        <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
        <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data();"/>
        </td>
        <td colspan="2" align="left">
        <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('cen_address.php','../images/head2/bio/cen_address.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
        </td>
      </tr>
      <?php } ?>
       <tr>
        <td colspan="3" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  
</table>
  </td>
  </tr>  
</table>
<div id="dialog_nation6" title="ระบบค้นหาประเทศ" style="display:none">
	<p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_nation6" name="search_nation6" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation6($('#search_nation6').val())"/>
    </p>
    <div id="result_search_nation6" align="center"></div>
</div>
<div id="dialog_nation7" title="ระบบค้นหาประเทศ" style="display:none">
	<p align="center">
    กรอกคำที่ต้องการ : <input type="text" id="search_nation7" name="search_nation7" class="input_text" style="width:120px" /> <input type="button" value="ค้นหา" onclick="search_nation7($('#search_nation7').val())"/>
    </p>
    <div id="result_search_nation7" align="center"></div>
</div>
<?
$db->closedb($conn);
?>