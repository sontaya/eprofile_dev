<?
$sql="SELECT * FROM user_objects WHERE object_type = 'TABLE'"; 
$query = @oci_parse($conn,$sql);
@oci_execute($query);
		
?>
<table width="100%">
<?
while($dbarr = @oci_fetch_array($query, OCI_BOTH)){
?>	
	<tr>
    	<td><a href="?ac=viwe&table=<?=$dbarr[0]?>"><?=$dbarr[0]?></a></td>
    </tr>		
<? } ?>
</table>