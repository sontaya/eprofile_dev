<?
include("./../includes/config.inc.php");
include("./../includes/connect.php");

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
<form method="post" action="s3.php">
<table style="font-size:12px;">
	<tr>
    	<td align="right">ชื่อ :</td>
        <td><input type="text" id="name" name="name"  style="width:150px;" /></td>
    </tr>
    <tr>
    	<td align="right">นามสกุล :</td>
        <td><input type="text" id="name" name="last_name"  style="width:150px;" /></td>
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
		?>
        <option value="<?php echo $rc['STAFFTYPE_ID']; ?>"><?php echo $rc['STAFFTYPE_NAME']; ?></option>
        <?php
			}
		?>
        </select>
        
        </td>
      </tr>
     <tr>
    	<td align="right"></td>
        <td><input type="submit" value="ค้นหา" /></td>
    </tr>
</table>
</form>