<?

class request{
	/*
	 table >> request
	 emp_id
	 re_request
	 re_comment
	 re_status
	 create_date
	*/
	var $conn;
	var $table="request";
	
	function insert_request($arr=array()){
		$id=$this->count_row()+1;
		$sql="INSERT INTO ".$this->table."(re_id,emp_id,re_request,re_comment,re_status,create_date,re_type) VALUES('".$id."','".$arr["emp_id"]."','".addslashes($arr["request"])."','".addslashes($arr["comment"])."','0',TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS'),'".$arr["type"]."')";
		//print $sql;
		$stid = oci_parse($this->conn, $sql );
        if (oci_execute($stid)){ 
			return true;
		}
		else{
			return false;
		}
	}
	
	function data_request($arr=array()){
		
		if($arr["emp_id"]!=""){
			$where=" WHERE emp_id='".$arr["emp_id"]."'";
		}
		
		else if($arr["re_id"]!=""){
			$where=" WHERE re_id='".$arr["re_id"]."'";
		}
		
		$sql="SELECT * FROM ".$this->table." ".$where;
		if($arr["sql"]!=""){
			$sql=$arr["sql"];
		}
		
		$stdt = oci_parse($this->conn,$sql);
		oci_execute($stdt);
		$data=array();
		while($rc = oci_fetch_array($stdt,OCI_BOTH)) {
			$data[]=$rc;
		}
		
		return $data;
	}
	
	function update_request($arr=array()){
		$sql="UPDATE ".$this->table." SET re_status='".$arr["type"]."' WHERE re_id='".$arr["re_id"]."'";
		//print $sql;
		$stid = oci_parse($this->conn, $sql );
        if (oci_execute($stid)){ 
			return true;
		}
		else{
			return false;
		}
	}
	
	function count_row(){
		$sql = "SELECT COUNT(*)  FROM ".$this->table;
		$stid = @oci_parse($this->conn, $sql );
		@oci_execute($stid);
		$row = @oci_fetch_array($stid, OCI_BOTH);
		@oci_free_statement($stid);
		return $row['COUNT(*)'];
	}
	
}

?>