<?
@session_start();
/*if (eregi("class.mysql.inc2php",$_SERVER['PHP_SELF'])) {
    Header("Location: ../index.php");
    die();
}*/

class DB{
	//ส่วนของการเชื่อมต่อ
	var $host = DB_HOST ;
	var $database ;
	var $connect_db ;
	var $selectdb ;
	var $db ;
	var $sql ;
	var $table ;
	var $where; 

	////////////////////// ฟังก์ชั่นต่างๆ //////////////////////
	//เชื่อมต่อดาต้าเบส
/*	function connectdb($user="username",$pwd="password"){
		$this->username = $user;
		$this->password = $pwd;
		$this->connect_db = oci_connect( $this->username, $this->password ) or $this->_error();
		return true; 
	}
*/
	//ปิดการเชื่อมต่อดาต้าเบส
	function closedb($conn ){
		//mysql_close ( $this->connect_db ) or $this->_error();
		oci_close($conn);
	}
	
	//นับจำนวนแถว
	//$db->count_row("table","where",$conn); 
	function count_row($tbl,$where,$conn){
	$sql = "SELECT COUNT(*)  FROM ".$tbl." ".$where;
	$stid = @oci_parse($conn, $sql );
	@oci_execute($stid);
	$row = @oci_fetch_array($stid, OCI_BOTH);
	@oci_free_statement($stid);
	
	return $row['COUNT(*)'];
}


	//เพิ่มข้อมูล
	//$db->add_db("table",array("field"=>"value")); 
	function add_db($table="table", $data="data",$conn="conn"){
		$key = array_keys($data); 
        $value = array_values($data); 
		$sumdata = count($key); 
		for ($i=0;$i<$sumdata;$i++) 
        { 
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
			if(substr($value[$i],0,7) == "TO_DATE") $q = ""; else $q = "'";//ถ้าบันทึกวันเวลาต้องไม่มี '
            $add=$add.$key[$i]; 
            $val=$val."$q".$value[$i]."$q"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
         $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 
		 $stid = oci_parse($conn, $sql );
		 
		
		if (oci_execute($stid)){ 
			$this->save_sql_log($sql,$_SESSION['USER_NAME'],"ADD"); // 2011-02-28 เมื่อ insert ให้บันทึกลงใน log
			oci_free_statement($stid);
            return true; 
        }else{ 
            //$this->_error(); 
			oci_free_statement($stid);
            return false; 
        } 
		
		
	}

	//แก้ไขข้อมูลแบบหลายฟิลล์ 
	//$db->update_db("tabel",array("field"=>"value"),"where"); 
    function update_db($table="table",$data="data",$where="where",$conn="conn"){ 
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
			if(substr($value[$i],0,7) == "TO_DATE") $q = ""; else $q = "'";//ถ้าบันทึกวันเวลาต้องไม่มี '
            $set=$set.$key[$i]."=$q".$value[$i]."$q"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where;
		
		$stid = oci_parse($conn, $sql );
        if (oci_execute($stid)){ 
			oci_free_statement($stid);
			$this->save_sql_log($sql,$_SESSION['USER_NAME'],"UPDATE"); // 2011-02-28 เมื่อ update ให้บันทึกลงใน log
            return true; 
        }else{ 
            //$this->_error(); 
			oci_free_statement($stid);
            return false; 
        } 
    } 

	//แก้ไขข้อมูลแบบฟิลล์เดียว
	//$db->update("table","set","where");
	function update($table="table",$set="set",$where="where",$conn="conn"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
		$stid = oci_parse($conn, $sql );
        if (oci_execute($stid)){ 
			$this->save_sql_log($sql,$_SESSION['USER_NAME'],"UPDATE"); // 2011-02-28 เมื่อ update ให้บันทึกลงใน log
			oci_free_statement($stid);
            return true; 
        }else{ 
            //$this->_error(); 
			oci_free_statement($stid);
            return false; 
        } 
    } 

	//ลบข้อมูล
	//$db->del("table","where"); 
    function del($table="table",$where="where",$conn="conn"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
		$stid = oci_parse($conn, $sql );
        if (oci_execute($stid)){ 
			$this->save_sql_log($sql,$_SESSION['USER_NAME'],"DELETE"); // 2011-02-28 เมื่อ update ให้บันทึกลงใน log
			oci_free_statement($stid);
            return true; 
        }else{ 
            //$this->_error(); 
			oci_free_statement($stid);
            return false; 
        } 
    } 
	


    function fetch($sql="sql",$conn="conn"){ 
		$stid = @oci_parse($conn, $sql );
		@oci_execute($stid);
      if ($res = @oci_fetch_array($stid, OCI_BOTH)){ 
			@oci_free_statement($stid);
            return $res; 
        }else{ 
            ////$this->_error(); 
			@oci_free_statement($stid);
            return false; 
        } 
    } 

	//แสดงข้อความผิดพลาด
   /* function _error(){ 
        $this->error[]=oci_error();
    	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    } */
	
	function save_sql_log($sql,$user,$sql_type) {
		$file_name = date("Y-m") . ".txt";
		
		$fh = fopen("../_log/".$file_name,"a+");
		
		$date_time = date("Y-m-d H:i:s");
		
		fwrite($fh,"[{$date_time}] [$user] [{$_SERVER['SCRIPT_NAME']}] [$sql] [{$sql_type}]\r\n\r\n");
		
		fclose($fh);
	}

}
?>