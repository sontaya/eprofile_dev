<?
include("./../includes/config.inc.php");
include("./../includes/connect.php");
ini_set('display_errors', '0');
/*
define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
/*
$sql="SELECT * FROM RSDUHR.VSALARY";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
	print ">>".$dbarr["ID_CARD"]."<br>";
}
*/
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
<script>
function popup(){
	
	var name=document.getElementById("name").value;
	//alert("uu");
	var last_name=document.getElementById("last_name").value;
	var emp_id=document.getElementById("emp_id").value;
	var id_card=document.getElementById("id_card").value;
	var emp_type=document.getElementById("emp_type").value;
	
	window.open("../salery/popup_salary.php?name="+name+"&last_name="+last_name+"&emp_id="+emp_id+"&id_card="+id_card+"&emp_type="+emp_type,null,"height=600,width=1200,status=yes,toolbar=no,menubar=no,scrollbars=yes");
}
</script>

<form method="post" action="">
<table style="font-size:12px;">
	<tr>
    	<td align="right">ชื่อ :</td>
        <td><input type="text" id="name" name="name"  style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">นามสกุล :</td>
        <td><input type="text" id="last_name" name="last_name"  style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">หมายเลขพนักงาน :</td>
        <td><input type="text" id="emp_id" name="emp_id" style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">หมายเลขประชาชน :</td>
        <td><input type="text" id="id_card" name="id_card" style="width:150px;" /></td>
    </tr>
    <!--<tr>
    	<td align="right">ฝ่าย :</td>
        <td><input type="text" id="party" name="party" readonly="readonly" style="width:150px;" /> <input type="button" value="ค้นหาฝ่าย" /></td>
    </tr>
    -->
    <tr>
        <td align="right" class="form_text">ประเภทบุคลากร  :</td>
        <td align="left">
        <select name="emp_type" id="emp_type">
        <option value="">ทุกประเภท</option>
        <?php
			$sql = "SELECT STAFFTYPE_ID, STAFFTYPE_NAME ";
			$sql .= "FROM ".TB_REF_STAFFTYPE." ";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rc = oci_fetch_array($stdt)) {
			if($rc['STAFFTYPE_ID']!=""){
		?>
        <option value="<?php echo $rc['STAFFTYPE_ID']; ?>"><?php echo $rc['STAFFTYPE_NAME']; ?></option>
        <?php
			 }}
		?>
        </select>
        
        </td>
      </tr>
     <tr>
    	<td align="right"></td>
        <td><input type="button" value="แสดง" onclick="popup();" /></td>
    </tr>
</table>
</form>