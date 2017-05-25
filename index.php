<?
@session_start();
//$_SESSION["ses_id"] = "000001";
//header("location: bio_data.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบบริหารงานบุคลากร กองบริหารงานบุคคล มหาวิทยาลัยราชภัฎสวนดุสิต</title>
<link rel="stylesheet" type="text/css" href="css/main1.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<script src="js/jquery.min.js?Math.random()" type="text/javascript"></script>
<script src="js/myAjax.js?Math.random()" type="text/javascript"></script>
<script src="js/login.js?Math.random()" type="text/javascript"></script>
</head>
<body>
<table width="981" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="images/e_profile_ori/banner-eprofile-eng.jpg" /></td>
  </tr>
  <tr>
    <td valign="top" align="center" background="images/e_profile_ori/bg_login.png" style="background-repeat:repeat-y">
    
    <table width="601" border="0" align="center" cellpadding="3"  cellspacing="3">
  <tr background="images/login/bg_01.png" ><td width="601" height="415">
  <form id="login" >
  <table width="441" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td width="109" height="39" align="right" valign="middle"><span style="font-size:17px">ชื่อผู้ใช้ :</span></td>
    <td colspan="2" align="left"  background="images/login/login_e_profile_06.png" style="background-repeat:no-repeat; padding-left:15px;padding-bottom:11px"><input type="text"  id="user_name" name="user_name" class="input_login" style="width: 210px;"/></td>
  </tr>
  <tr>
    <td height="39" align="right" valign="middle"><span style="font-size:17px">รหัสผ่าน :</span></td>
    <td colspan="2" align="left"  background="images/login/login_e_profile_06.png" style="background-repeat:no-repeat; padding-left:15px;padding-bottom:11px"><input type="password"  id="pass_word" name="pass_word" class="input_login" style="width: 210px;"/></td>
  </tr>
  <tr>
    <td height="53" align="right"></td>
    <td width="197" align="left" ><img src="images/login/login_e_profile_09.png" onclick="sub_login($('#user_name').val(),$('#pass_word').val())" style="cursor:pointer" /> <img src="images/login/login_e_profile_11.png" style="cursor:pointer" onclick="document.getElementById('login').reset()"/></td>
    <td width="105" align="left" valign="middle"><div id="wait"></div></td>
  </tr>
 <!-- <tr>
    <td height="40" align="right" valign="middle"><input type="button" value="เข้าสู่ระบบ" onclick="sub_login($('#user_name').val(),$('#pass_word').val())"/></td>
    <td width="50" align="left" valign="middle"><input type="reset" value="เคลียร์" /> </td>
    <td width="244" align="left" valign="middle"><div id="wait"></div></td>
  </tr>-->
   <tr>
     <td height="61" colspan="3"  align="left" style="padding-left:43px; color:red; font: 18px bold;"><div id="login_error"></div></td>
   </tr>
   </table>
  </form>
</td></tr>
  <tr>
    <td><span style="color:red; font: 14px bold;">คำแนะนำ 1. ระบบรองรับเว็บเบราว์เซอร์ Google Chrome, Mozilla Firefox, Safari<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. ชื่อผู้ใช้งาน (Username) และ รหัสผ่าน (Password) เป็นข้อมูลเดียวกับที่ใช้งาน ระบบอินเทอร์เน็ต (Internet) ของมหาวิทยาลัยฯ</span></td>
  </tr>
    </table>
      
    </td>
  </tr>
  <tr>
    <td><img src="images/e_profile_ori/foot_edit_14.png" /></td>
  </tr>
</table>
<?php
	/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	*/
?>
</body>
</html>