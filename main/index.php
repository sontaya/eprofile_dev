
<?
@session_start();
//print_r($_SESSION);
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
}
//$_SESSION["ses_id"] = "000001";
//header("location: bio_data.php");

function chack_img($img){
	if(file_exists($img))
	{
		return $img;
	}
	else
	{
		return "../images/e_profile_ori/e_profile_origin_13_3.png";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบบริหารงานบุคลากร กองบริหารงานบุคคล มหาวิทยาลัยสวนดุสิต</title>
	<link rel="stylesheet" type="text/css" href="../css/main1.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
	<link href="../css/calendar-mos.css" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
	<link rel="stylesheet" type="text/css" href="../css/vtip.css" />

	<script src="../js/jquery.min.js" type="text/javascript"></script>
	<script src="../jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js?Math.random()" type="text/javascript"></script>
	<script type="text/javascript" src="../jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js?Math.random()"></script>

	<!--<script src="../js/menu-collapsed.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="../js/ddaccordion.js?Math.random()"></script>

	<script src="../js/calendar.js?Math.random()" type="text/javascript"></script>
	<script src="../js/autocomplete_maste.js?Math.random()" type="text/javascript"></script>
	<script src="../js/autoComplete.js?Math.random()" type="text/javascript"></script>
	<script src="../js/myAjax.js?Math.random()" type="text/javascript"></script>
	<script src="../js/main.js?Math.random()" type="text/javascript"></script>

	<script src="../js/fam_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/chl_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/edu_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/position_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/sch_data.js?Math.random()" type="text/javascript"></script>

	<script src="../js/research_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/royal_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/warn_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/wrk_h_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/sem_data.js?Math.random()" type="text/javascript"></script>

	<script src="../js/constructor_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/consult_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/ajax_depsub.js?Math.random()" type="text/javascript"></script>
	<script src="../js/register.js" type="text/javascript"></script>
	<script src="../js/new_person.js?Math.random()" type="text/javascript"></script>

	<script src="../js/appraise_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/committee.js?Math.random()" type="text/javascript"></script>
	<script src="../js/retire_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/honor_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/la_data.js?Math.random()" type="text/javascript"></script>

	<script src="../js/fi_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/money_fund_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/certificate_data.js?Math.random()" type="text/javascript"></script>
	<script src="../js/function_interface.js" type="text/javascript"></script>
	<script src="../js/vtip.js?Math.random()" type="text/javascript"></script>
	<script src="../js/shortcut.js?Math.random()" type="text/javascript"></script>
	<script type="text/javascript">
	ddaccordion.preloadimages(jQuery(ddaccordion.ajaxloadingmsg).filter('img'))

	ddaccordion.init({
		headerclass: "headerbar", //Shared CSS class name of headers group
		contentclass: "submenu", //Shared CSS class name of contents group
		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
		defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
		onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})

	function change_color(id){
	  $("#menu"+id).addClass("menu_visited");

	}

	</script>
	 <script type="text/javascript">



		function change_permit(empID,empName,empType){
			//alert(empID);
			$('#change_permit_dialog').dialog({
				buttons: {"ตกลง" : function() { ajax_change_permit();}},
				modal: true,
				resizable: false
				});

			$('#user_permit_value').val(empType);
			$('#user_permit_name').text(empName);
			$('#user_permit_empid').text(empID);
		}
		//change_permit('1234');

		function ajax_change_permit() {
			var permit_value = $('#user_permit_value').val();
			var permit_empid = $('#user_permit_empid').text();
			//alert(permit_value + '\n'+permit_empid);
			$.ajax({
				type: 'POST',
				data: {permit_value: permit_value, permit_empid: permit_empid},
				success: function(data) {
					$('#change_permit_dialog').dialog("close");
				},
				beforeSend: function() {
				},
				url: 'change_permission.php'
				});
		}

		shortcut.add("Backspace", function() {return false;}, { 'type': 'keydown', 'disable_in_input': true }); 

	</script>
</head>
<body>
    <a name="top_main" id="top_main"></a>
<table width="982" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2" width="982"><img src="../images/e_profile_ori/banner-eprofile-eng.jpg" width="982"/></td>
  </tr>
  <tr>
    <td width="211" rowspan="2" valign="top" background="../images/e_profile_ori/e_profile_origin_09.png" style="background-repeat:repeat-y">
    
    <table width="211" border="0" cellspacing="0" cellpadding="0"  >
  <tr valign="top">
    <td width="211"  height="64"  background="../images/e_profile_ori/e_profile_origin_099.png"><div >
    <div style="color: #333; position:relative; " align="center">
    <? 
	
	//echo "<h3>ผู้ใช้งานขณะนี้คือ <br /><span style='color: #9E709B'><u>".$_SESSION["watching"]."</u></span></h3>";
	
	
	?>
    <h3>ผู้ใช้งานขณะนี้คือ <br /><span style='color: #9E709B'><u><samp id='watching'></samp></u></span></h3>
    </div>
    </div>
    </td>
  </tr>
  </table>
    
    <table width="210" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td width="210"  height="252"  background="../images/e_profile_ori/e_profile_origin_13.png" style="background-repeat:no-repeat">&nbsp;
  
  <div style="padding-left:65px;padding-top:37px" id="personal_pic">
  <? if($_SESSION["PIC_FILE"] == ""){?>
  	<img src="../images/e_profile_ori/e_profile_origin_13_3.png" width="90" height="120" />
	<? }else{?>
    <img src="<?=chack_img('files/bio_data_file/'.$_SESSION["PIC_FILE"])?>" width="90" height="120" border="1" />
    <? }?>
  </div>
  <div style="padding-top:10px; padding-left:10px;text-align:center; font-size:13px; font-weight: bold; color:#333" id="personal_name">
  	<? echo $_SESSION["FNAME_TH"]." ".$_SESSION["LNAME_TH"] ?> 
  </div>
  <div style="padding-top:8px; padding-left:15px; text-align:center; font-size:11px; font-weight: bold; color:#0ca345" id="status">
  	<? echo "สถานะปัจจุบัน : ".$_SESSION["STATUS"].""; ?> 
  </div>
  </td>
  </tr>
  </table>
    <table width="211" border="0" cellspacing="0" cellpadding="0" >
  <tr valign="top">
  <td height="500">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="../images/e_profile_ori/e_profile_origin_09.png" style="background-repeat:repeat-y; height: 180px" valign="top" align="center"><br />
        <button onClick="window.location = 'logout.php'">ออกจากระบบ</button><br /><br />
        
		<? include "menu.php";?></td>
        </tr>
    
    </table>
 
  </td>
    </tr>
</table>

 </td>
    <td width="771" height="64" align="left" valign="top"   background="../images/e_profile_ori/e_profile_origin_055.png"  style="background-repeat:no-repeat">
    <div id="emp_head">รหัสบุคคล<br /><?=$_SESSION["EMP_ID"];?></div>
<div id="name_head"><?=$_SESSION["FNAME_EN"];?> <?=$_SESSION["LNAME_EN"];?></div>
    </td>
  </tr>
  <tr>
    <td   width="771"   height="750" align="left" valign="top" background="../images/e_profile_ori/bg.png">
    <div class="head"></div>
  <div id="inner_data" style="width:771px">
&nbsp;
  </div>
    </td>
  </tr>
  <tr>
    <td colspan="2"><img src="../images/e_profile_ori/banner-eprofile-footer.jpg" width="981" height="153" /></td>
  </tr>
</table>
<div id="dialog" style="display:none">
</div>
<iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;border:0px solid #fff;display:none;" ></iframe> 
<iframe id="upload_target2" name="upload_target2" src="#" style="width:0px;height:0px;border:0px solid #fff;display:none;" ></iframe>

<script>
	user_name_thai("<?=$_SESSION["watching"]?>","watching");
</script>


<script>
	window.onload = function(){
		console.log(Date.now() + ": On Load");
		console.log("localStorage: "+ localStorage.getItem('pageTarget'));
		
		var url= localStorage.getItem('pageTarget');
		
		if(url == ""){
			var ran=Math.random();
			change_data("bio_data.php?"+ran,"../images/head2/bio/biodata.png");
			load_dialog();
		}else{
			
			change_data(url, "../images/head2/bio/biodata.png");
			load_dialog();
		}
	}	
</script>

</body>
</html>