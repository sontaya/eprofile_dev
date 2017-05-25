<?
session_start();


include("./includes/config.inc.php");
include("./includes/conn.php");
include("./includes/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>O_R_A_C_L_E</title>
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="./js/js.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>
<?
if($_SESSION["login"]!="Am3mBz3"){
?>
<br /><br />
<form action="chk_login.php" method="post">
	PASS : <input type="password" name="pass" /> <input type="submit" />
</form>
<?
	exit;
}
?>
<table width="100%">
	<tr height="80">
    	<td colspan="2" bgcolor="#F2F2F2" style="border-bottom:solid; border-bottom-width:1px; border-bottom-color:#999999;" align="right"><a href="logout.php">logout</a></td>
    </tr>
    <tr valign="top">
    	<td width="200" style=" border-right:solid; border-right-width:1px; border-right-color:#999999;"><? include("menu.php"); ?></td>
        <td>
        
        <?
			if($_GET["ac"]!=""){
				include("./page/".$_GET["ac"].".php");
			}
		?>
        
        </td>
    </tr>
    <tr height="30">
    	<td colspan="2" bgcolor="#F2F2F2" style="border-top:solid; border-top-width:1px; border-top-color:#999999;"></td>
    </tr>
</table>

</body>
</html>