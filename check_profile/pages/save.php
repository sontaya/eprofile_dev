<?
include("../../includes/connect.php");

switch($_POST["page_name"]){
	case 'ข้อมูลเบื้องต้น' :
		$page = "profile";
		break;
	case 'ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน' :
		$page = "address";
		break;
	case 'ข้อมูลบิดามารดา' :
		$page = "family";
		break;
	case 'ข้อมูลบุตร' :
		$page = "childen";
		break;
	case 'ประวัติการศึกษา' :
		$page = "history_edu";
		break;
	case 'ข้อมูลการศึกษาต่อ' :
		$page = "education";
		break;
	case 'การขอทุนวิจัย' :
		$page = "research";
		break;
	case 'เครื่องราชอิสริยาภรณ์' :
		$page = "crown";
		break;
	case 'ประกาศเกียรติคุณ' :
		$page = "fame";
		break;
	case 'ความเชี่ยวชาญ' :
		$page = "professional";
		break;
	case 'ผู้ค้ำประกัน' :
		$page = "guarantee";
		break;
	case 'สวัสดิการและสิทธิประโยชน์' :
		$page = "benefits";
		break;
	case 'การตักเตือน ลงโทษ' :
		$page = "punish";
		break;
	case 'ประวัติการทำงานในอดีต' :
		$page = "history_work";
		break;
	case 'ตำแหน่งปัจจุบัน' :
		$page = "current_position";
		break;
	case 'ข้อมูลการย้ายสังกัด/เปลี่ยนสถานที่ปฎิบัติงาน/ช่วยปฏิบัติงาน/เปลี่ยนตำแหน่ง' :
		$page = "change_position";
		break;
	case 'ข้อมูลการแต่งตั้งตำแหน่งทางการบริหาร' :
		$page = "appoint";
		break;
	case 'ข้อมูลการปรับเปลี่ยนตำแหน่ง/สายงาน/เงินเดือน' :
		$page = "salary";
		break;
	case 'ข้อมูลค่าตอบแทน' :
		$page = "compensation";
		break;
	case 'ข้อมูลการประเมินผลการปฏิบัติราชการ' :
		$page = "assesment";
		break;
	case 'ตำแหน่งทางวิชาการ' :
		$page = "academic";
		break;
	case 'การอบรมสัมมนา' :
		$page = "training";
		break;
	case 'การเป็นวิทยากร อาจารย์พิเศษ' :
		$page = "lecturer";
		break;
	case 'การเป็นที่ปรึกษา' :
		$page = "consultants";
		break;
	case 'การเป็นกรรมการภายนอก' :
		$page = "committee";
		break;
	case 'การประเมินการทำงาน' :
		$page = "evaluation";
		break;
	case 'ประวัติข้อมูลการต่อสัญญา' :
		$page = "renew";
		break;
}
$sql_check = "SELECT count(*) as num_rows FROM SDU_CHECK_PROFILE WHERE EMP_ID = '".$_POST["personal_id"]."' ";
$stid = oci_parse($conn, $sql_check );
oci_execute($stid);
$row=oci_fetch_array($stid, OCI_BOTH);
if($row["NUM_ROWS"]==0){
	$sql_profile="INSERT INTO SDU_CHECK_PROFILE (EMP_ID, ".$page."_status, ".$page."_comment) VALUES ('".$_POST["personal_id"]."', 'F', '".$_POST["comment_page"]."')";
}else{
	$sql_profile="UPDATE SDU_CHECK_PROFILE SET ".$page."_status = 'F', ".$page."_comment = '".$_POST["comment_page"]."' WHERE EMP_ID = '".$_POST["personal_id"]."' ";
}
$stid = oci_parse($conn, $sql_profile );
oci_execute($stid);

echo $page;
?>