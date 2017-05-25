<?
/*
define("ORA_USERNAME","EPROFILE_HOST_YUI");//oracle username
define("ORA_PASSWORD","1234");// oracle password
define("ORA_HOST","127.0.0.1/xe"); //ordacle host and global name
define("ORA_CHARSET","AL32UTF8");//oracle ch
*/

define("ORA_USERNAME","SDPERSON");//oracle username
define("ORA_PASSWORD","PERSON");// oracle password
define("ORA_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
define("ORA_CHARSET","AL32UTF8");//oracle ch

function edit_pic($pic){
	$type=end(explode(".",$pic));
	$new_pic=substr($pic,0,12)."45.".$type;
	$new_pic=str_replace("bio_","",$new_pic);
	$new_pic=str_replace("-","0",$new_pic);
	if($pic==""){
		$new_pic="";
	}
	return $new_pic;
}

$conn = oci_connect(ORA_USERNAME,ORA_PASSWORD,ORA_HOST,ORA_CHARSET);
if(!$conn){
	print "ERROR CONNECT ORACALE";
}

$sql="SELECT EMP_ID , BIO_PIC_FILE FROM SDU_BIODATA_TAB";
$stid = @oci_parse($conn, $sql );
@oci_execute($stid);
$data=array();
$i=0;
while($row = @oci_fetch_array($stid, OCI_BOTH)){
	$new_pic=edit_pic($row["BIO_PIC_FILE"]);
	$data[$i]["EMP_ID"]=$row["EMP_ID"];
	$data[$i]["PIC"]=$new_pic;
	//print $i.".".$row["EMP_ID"].":".$new_pic."<br>";
	if($row["BIO_PIC_FILE"]!=""){
		//print $row["BIO_PIC_FILE"]."<br>";
		print $i.".".$row["EMP_ID"].":".$new_pic."<br>";
	}
	$i++;
}

for($a=0;$a<=$i;$a++){
	if($data[$a]["EMP_ID"]!=""){
		
		$sql="UPDATE SDU_BIODATA_TAB SET BIO_PIC_FILE='".$data[$a]["PIC"]."' WHERE EMP_ID='".$data[$a]["EMP_ID"]."'";
		$stid = @oci_parse($conn, $sql );
		@oci_execute($stid);
		
	}
}

?>