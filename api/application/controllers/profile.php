<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {


	public function __construct() {
			parent::__construct();
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
			header('Access-Control-Allow-Methods: GET, POST, PUT,OPTIONS');
			$method = $_SERVER['REQUEST_METHOD'];
			if ($method === "OPTIONS") {
					die();
			}

	}

	public function index()
	{
		$this->load->view('welcome_message');
	}


	public function getProfileByCode($hr_code){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		
		$sql = "SELECT * FROM SDPERSON.SDU_GENERAL_PROFILE WHERE  CODE_PERSON  = '$hr_code'";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row){
				 $data = array(
					'CODE_PERSON'=>$row->CODE_PERSON,
					'PERSON_CODE'=>$row->PERSON_CODE,
					'CITIZEN_CODE'=>$row->CITIZEN_CODE,
					'NAME_PRENAME_THA'=>$row->NAME_PRENAME_THA,
					'FIRST_NAME_THA'=>$row->FIRST_NAME_THA,
					'MIDDLE_NAME_THA'=>$row->MIDDLE_NAME_THA,
					'LAST_NAME_THA'=>$row->LAST_NAME_THA,
					'NAME_PRENAME_ENG'=>$row->NAME_PRENAME_ENG,
					'FIRST_NAME_ENG'=>$row->FIRST_NAME_ENG,
					'MIDDLE_NAME_ENG'=>$row->MIDDLE_NAME_ENG,
					'LAST_NAME_ENG'=>$row->LAST_NAME_ENG,
					'BIRTH_DATE'=>$row->BIRTH_DATE,
					'TEXT_GENDER'=>$row->TEXT_GENDER,
					'CODE_RELIGION'=>$row->CODE_RELIGION,
					'NAME_RELIGION'=>$row->NAME_RELIGION,
					'RACE_NAME'=>$row->RACE_NAME,
					'NATION_NAME'=>$row->NATION_NAME,
					'NAME_MSTATUS'=>$row->NAME_MSTATUS,
					'BLOOD'=>$row->BLOOD,
					'CU_HOUSE_NO'=>$row->CU_HOUSE_NO,
					'CU_MOO'=>$row->CU_MOO,
					'CU_BUILDING'=>$row->CU_BUILDING,
					'CU_VILLAGE'=>$row->CU_VILLAGE,
					'CU_ROOM'=>$row->CU_ROOM,
					'CU_SOI'=>$row->CU_SOI,
					'CU_ROAD'=>$row->CU_ROAD,
					'CU_CODE_TUMBON'=>$row->CU_CODE_TUMBON,
					'CU_NAME_TUMBON'=>$row->CU_NAME_TUMBON,
					'CU_CODE_AMPHUR'=>$row->CU_CODE_AMPHUR,
					'CU_NAME_AMPHUR'=>$row->CU_NAME_AMPHUR,
					'CU_CODE_PROVINCE'=>$row->CU_CODE_PROVINCE,
					'CU_NAME_PROVINCE'=>$row->CU_NAME_PROVINCE,
					'CU_POST_CODE'=>$row->CU_POST_CODE,
					'CA_HOUSE_NO'=>$row->CA_HOUSE_NO,
					'CA_MOO'=>$row->CA_MOO,
					'CA_BUILDING'=>$row->CA_BUILDING,
					'CA_VILLAGE'=>$row->CA_VILLAGE,
					'CA_ROOM'=>$row->CA_ROOM,
					'CA_SOI'=>$row->CA_SOI,
					'CA_ROAD'=>$row->CA_ROAD,
					'CA_CODE_TUMBON'=>$row->CA_CODE_TUMBON,
					'CA_NAME_TUMBON'=>$row->CA_NAME_TUMBON,
					'CA_CODE_AMPHUR'=>$row->CA_CODE_AMPHUR,
					'CA_NAME_AMPHUR'=>$row->CA_NAME_AMPHUR,
					'CA_CODE_PROVINCE'=>$row->CA_CODE_PROVINCE,
					'CA_NAME_PROVINCE'=>$row->CA_NAME_PROVINCE,
					'CA_POST_CODE'=>$row->CA_POST_CODE,
					'PHONE'=>$row->PHONE,
					'MOBILE1'=>$row->MOBILE1,
					'MOBILE2'=>$row->MOBILE2,
					'EMAIL1'=>$row->EMAIL1,
					'EMAIL2'=>$row->EMAIL2,
					'BIO_PIC_FILE'=>$row->BIO_PIC_FILE,
					'STAFF_TYPE'=>$row->STAFF_TYPE,
					'STAFF_TYPE_NAME'=>$row->STAFF_TYPE_NAME,
					'SUBSTAFF_TYPE'=>$row->SUBSTAFF_TYPE,
					'SUBSTAFF_TYPE_NAME'=>$row->SUBSTAFF_TYPE_NAME,
					'CODE_FACULTY'=>$row->CODE_FACULTY,
					'NAME_FACULTY'=>$row->NAME_FACULTY,
					'CODE_DEPARTMENT'=>$row->CODE_DEPARTMENT,
					'NAME_DEPARTMENT'=>$row->NAME_DEPARTMENT,
					'CODE_SITE'=>$row->CODE_SITE,
					'NAME_SITE'=>$row->NAME_SITE,
					'PHONE_OFFICE'=>$row->PHONE_OFFICE,
					'POSITION_CODE'=>$row->POSITION_CODE,
					'CODE_POSITION'=>$row->CODE_POSITION,
					'NAME_POSITION'=>$row->NAME_POSITION,
					'CODE_VPOS'=>$row->CODE_VPOS,
					'NAME_VPOSITION'=>$row->NAME_VPOSITION,
					'CODE_MPOS'=>$row->CODE_MPOS,
					'NAME_MPOSITION'=>$row->NAME_MPOSITION,
					'CODE_ACADEMIC_POSITION'=>$row->CODE_ACADEMIC_POSITION,
					'NAME_ACADEMIC_POSITION'=>$row->NAME_ACADEMIC_POSITION,
					'START_WORK_DATE'=>$row->START_WORK_DATE,
					'CODE_STATUS'=>$row->CODE_STATUS,
					'NAME_STATUS'=>$row->NAME_STATUS,

			);
		} 
		$query->free_result();
	 print_r(json_encode($data));
	}
	


	public function getActivePersonList($condition){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		
		$sqlSession = "ALTER SESSION SET NLS_DATE_FORMAT = 'yyyy/mm/dd'";
		$this->db->query($sqlSession);
		
		
		$sql = "SELECT * FROM SDPERSON.SDU_GENERAL_PROFILE 
				WHERE  CODE_STATUS IN ('01','03') 
						AND ( 
							CODE_PERSON  like '%".$condition."%' 
							OR FIRST_NAME_THA  like '%".$condition."%' 
							OR LAST_NAME_THA  like '%".$condition."%'
						) 
				" ;
				
		$query = $this->db->query($sql);
		foreach ($query->result() as $row){
				 $data[] = array(
					'CODE_PERSON'=>$row->CODE_PERSON,
					'PERSON_CODE'=>$row->PERSON_CODE,
					'CITIZEN_CODE'=>$row->CITIZEN_CODE,
					'NAME_PRENAME_THA'=>$row->NAME_PRENAME_THA,
					'FIRST_NAME_THA'=>$row->FIRST_NAME_THA,
					'MIDDLE_NAME_THA'=>$row->MIDDLE_NAME_THA,
					'LAST_NAME_THA'=>$row->LAST_NAME_THA,
					'NAME_PRENAME_ENG'=>$row->NAME_PRENAME_ENG,
					'FIRST_NAME_ENG'=>$row->FIRST_NAME_ENG,
					'MIDDLE_NAME_ENG'=>$row->MIDDLE_NAME_ENG,
					'LAST_NAME_ENG'=>$row->LAST_NAME_ENG,
					'STAFF_TYPE'=>$row->STAFF_TYPE,
					'STAFF_TYPE_NAME'=>$row->STAFF_TYPE_NAME,
					'SUBSTAFF_TYPE'=>$row->SUBSTAFF_TYPE,
					'SUBSTAFF_TYPE_NAME'=>$row->SUBSTAFF_TYPE_NAME,
					'CODE_FACULTY'=>$row->CODE_FACULTY,
					'NAME_FACULTY'=>$row->NAME_FACULTY,
					'CODE_DEPARTMENT'=>$row->CODE_DEPARTMENT,
					'NAME_DEPARTMENT'=>$row->NAME_DEPARTMENT,
					'CODE_SITE'=>$row->CODE_SITE,
					'NAME_SITE'=>$row->NAME_SITE,
					'CODE_STATUS'=>$row->CODE_STATUS,
					'NAME_STATUS'=>$row->NAME_STATUS,
			);
		} 
		$query->free_result();
	 print_r(json_encode($data));
	}



	public function getActivePerson($condition){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		
		$sqlSession = "ALTER SESSION SET NLS_DATE_FORMAT = 'yyyy/mm/dd'";
		$this->db->query($sqlSession);
		
		
		$sql = "SELECT * FROM SDPERSON.SDU_GENERAL_PROFILE 
				WHERE  CODE_STATUS IN ('01','03') 
						AND ( 
							CODE_PERSON  like '%".$condition."%' 
							OR FIRST_NAME_THA  like '%".$condition."%' 
							OR LAST_NAME_THA  like '%".$condition."%'
						) 
				" ;
				
		$query = $this->db->query($sql);
		foreach ($query->result() as $row){
				 $data[] = array(
					'CODE_PERSON'=>$row->CODE_PERSON,
					'FIRST_NAME_THA'=>$row->FIRST_NAME_THA,
					'LAST_NAME_THA'=>$row->LAST_NAME_THA,
					'NAME_FACULTY'=>$row->NAME_FACULTY,

			);
		} 
		$query->free_result();
	 print_r(json_encode($data));
	}


	
	
	}
	