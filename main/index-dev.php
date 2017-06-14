
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


<!doctype html>
<html><head>
<meta charset="utf-8">
<title>ระบบบริหารงานบุคลากร กองบริหารงานบุคคล มหาวิทยาลัยสวนดุสิต</title>



	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="../css/main1.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/vtip.css" />

	<link href="../assets/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link href="../assets/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css" >

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript" src="../js/ddaccordion.js?Math.random()"></script>


	
	<script src="../assets/bootstrap-fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>
	<script src="../assets/bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
	<script src="../assets/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
	<script src="../assets/bootstrap-fileinput/js/fileinput.min.js"></script>
	<script src="../assets/bootstrap-fileinput/themes/fa/theme.js"></script>
	<script src="../assets/bootstrap-fileinput/js/locales/<lang>.js"></script>
	
	<script type="text/javascript" src="../assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script src="../assets/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
	
	

	<script src="../js/main.js?Math.random()" type="text/javascript"></script>
	<script src="../js/function_interface.js" type="text/javascript"></script>
	<script src="../js/vtip.js?Math.random()" type="text/javascript"></script>
	<script src="../js/shortcut.js?Math.random()" type="text/javascript"></script>
	
	<script type="text/javascript">
		ddaccordion.preloadimages(jQuery(ddaccordion.ajaxloadingmsg).filter('img'))

		ddaccordion.init({
			headerclass: "headerbar", //Shared CSS class name of headers group
			contentclass: "submenu", //Shared CSS class name of contents group
			revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
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


		function ajax_change_permit() {
			var permit_value = $('#user_permit_value').val();
			var permit_empid = $('#user_permit_empid').text();
			//alert(permit_value + '\n'+permit_empid);
			$.ajax({
				type: 'POST',
				data: {permit_value: permit_value, permit_empid: permit_empid},
				success: function(data) {
				/*
					$('#change_permit_').("close");
				*/
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
				<td width="211"  height="64"  background="../images/e_profile_ori/e_profile_origin_099.png">
					<div style="color: #333; position:relative; " align="center">
						<h5>ผู้ใช้งานขณะนี้คือ <br /><span style='color: #9E709B'><u><samp id='watching'></samp></u></span></h5>
					</div>
				</td>
			  </tr>
			</table>

			<table width="211" border="0" cellspacing="0" cellpadding="0">
				  <tr valign="top">
					<td width="211"  height="252"  background="../images/e_profile_ori/e_profile_origin_13.png" style="background-repeat:no-repeat">&nbsp;

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
		<td   width="771" height="750" align="left" valign="top" background="../images/e_profile_ori/bg.png">
			<div class="head"></div>
			<div class="container-fluid">
				<div id="inner_data" style="padding: 5px;" ></div>
			</div>
		</td>
	  </tr>
	  <tr>
		<td colspan="2"><img src="../images/e_profile_ori/banner-eprofile-footer.jpg" width="981" height="153" /></td>
	  </tr>
	</table>

	<script>
		user_name_thai("<?=$_SESSION["watching"]?>","watching");
	</script>
<script>
		
	window.onload = function(){
		var targetLocation = getURLParameter('target')+".php";
		var ran=Math.random();
		change_data("change_currentwork_status.php,"");
		load_dialog();
		/* getFileName(); */
	}

	
	
</script>
</body>
</html>