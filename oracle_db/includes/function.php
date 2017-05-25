<?
function fide_index($table,$conn){
	//$sql="SELECT constraint_name, position, column_name  FROM user_cons_columns WHERE table_name = '".$table."'";
	$sql="SELECT index_name, column_position, column_name, descend FROM user_ind_columns WHERE table_name = '".$table."'";
	//print $sql."<br>";
	$query = @oci_parse($conn, $sql );
	@oci_execute($query);
	$data=array();
	$data["pre_key"]='';
	$prm_key_name=prm_key($table,$conn);
	while($dbarr = @oci_fetch_array($query, OCI_BOTH)){
		if($dbarr[0]==$prm_key_name){
			$data["pre_key"][$dbarr[2]]=$dbarr[2];
			$data["pre_key"]["name"]=$dbarr[0];
		}
		else{
			$data["index"][$dbarr[2]]=$dbarr[2];
			$data["index"]["name"][$dbarr[2]]=$dbarr[0];
		}
	}
	
	return $data;
}

function prm_key($table,$conn){
	$sql="SELECT constraint_name, constraint_type FROM user_constraints WHERE  table_name = '".$table."'";
	$query = @oci_parse($conn, $sql );
	@oci_execute($query);
	$data=array();
	while($dbarr = @oci_fetch_array($query, OCI_BOTH)){
		if($dbarr[1]=="P"){
			$key=$dbarr[0];
		}
	}
	return $key;
}

?>