<h3>ตาราง : <?=$_GET["table"]?></h3>

<?
$table=$_GET["table"];
$sql="SELECT * FROM ".$table;
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$ncols = oci_num_fields($stmt);
		
		$index=fide_index($table,$conn);
?>
	<table border="1" style="border-collapse:collapse;">
		<tr class="tb_head">
        	<td width="80"> PRIMARY </td>
            <td width="80"> INDEX </td>
        	<td width="200"> NAME </td>
            <td width="100"> TYPE </td>
            <td width="80"> SIZE </td>
            <td width="80"> เพิ่ม/ลบ PRIMARY </td>
            <td width="80"> เพิ่ม/ลบ INDEX </td>
            <td width="80"> ข้อมูลที่ซ้ำ </td>
        </tr>
<?
	for ($i = 1; $i <= $ncols; $i++) {
    	$column_name  = oci_field_name($stmt, $i);
    	$column_type  = oci_field_type($stmt, $i);
    	$column_size  = oci_field_size($stmt, $i);
		
		$text1="";
		$text2="";
		
		$link1="<a href='javascript:popup(\"./popup/add_primary.php?table=".$table."&column=".$column_name."\",500,200)'>เพิ่ม</a>";
		$link2="<a href='javascript:popup(\"./popup/add_index.php?table=".$table."&column=".$column_name."\",500,200)'>เพิ่ม</a>";
		
		if($index["pre_key"][$column_name]!=""){
			$text1="Y";
			$link1="<a href='javascript:drop_key(\"".$table."\",\"".$index["pre_key"]["name"]."\")'>ลบ</a>";
		}
		else if($index["index"][$column_name]!=""){
			$text2="Y";
			$link2="<a href='javascript:drop_index(\"".$table."\",\"".$index["index"]["name"][$column_name]."\")'>ลบ</a>";
		}
		
    	print "
			<tr height='25'>
				<td><center>".$text1."</center></td>
				<td><center>".$text2."</center></td>
				<td>".$column_name."</td>
				<td><center>".$column_type."</center></td>
				<td><center>".$column_size."</center></td>
				<td><center>".$link1."</center></td>
				<td><center>".$link2."</center></td>
				<td><center><samp id='fide".$i."'><a href='javascript:count_row(\"".$table."\",\"".$column_name."\",\"fide".$i."\");'>ดู</a></samp></center></td>
			</tr>
		";
		
	}
?>
	</table>