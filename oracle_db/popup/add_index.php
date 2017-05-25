<?
include("./../includes/config.inc.php");
include("./../includes/conn.php");
include("./../includes/function.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADD INDEX</title>
<script type="text/javascript" src="./../js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="./../css/style.css"/>
<script>

function add(){
	
	$.post("./../ajax/ajax_add_index.php", {table:$("#table").val() , constraint_name:$("#constraint_name").val() , column:$("#column").val()}, 
		function(data){
			if(data=="OK"){
				alert("สร้าง INDEX เรียบร้อย");
				window.opener.location.reload();
				window.close();
			}
			else{
				$("#page_data").html(data);
			}
		}
	);
	
}

</script>
</head>

<body style="background-color:#F2F2F2;">
<div class="title">สร้าง INDEX</div>
<div id="page_data">
<table>
	<tr>
    	<td align="right">ตาราง :</td>
        <td><input type="text" style="width:200px;" id="table" value="<?=$_GET["table"]?>" /></td>
    </tr>
    <tr>
    	<td align="right">คอลัมน์ :</td>
        <td><input type="text" style="width:200px;" id="column" value="<?=$_GET["column"]?>" /></td>
    </tr>
    <tr>
    	<td align="right">Constraint Name :</td>
        <td><input type="text" style="width:200px;" id="constraint_name" value="<?=$_GET["table"]?>_INDEX" /></td>
    </tr>
    <tr>
    	<td align="right"></td>
        <td><input type="button" value="สร้าง" onclick="add()" /></td>
    </tr>
</table>
</div>
</body>
</html>