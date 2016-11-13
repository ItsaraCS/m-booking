<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dbservice_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');
		}

		public function index(){
			$data = json_decode(file_get_contents('php://input'), true);
			$this->$data['funcName']($data['param']);
		}

		public function getSession(){
			$itemList = array();

			$itemList = $this->dbservice_model->getSession();

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function getUserPermissionData($userID){
			$itemList = array();

			$sqlCmd = "SELECT permission_id, p.user_id, p.menu_id, p.menu_sub_id, p.permission_status_id, 
							m.menu_name, ms.menu_sub_name, ps.permission_status_code AS perm_status 
						FROM permission p 
							INNER JOIN menu_sub ms 
								ON p.menu_sub_id = ms.menu_sub_id 
							INNER JOIN menu m 
								ON ms.menu_id = m.menu_id 
							INNER JOIN permission_status ps 
								ON p.permission_status_id = ps.permission_status_id 
						WHERE p.user_id = '$userID' 
						ORDER BY permission_id";
			$itemList = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function login($param){
			$item = array();
			$itemList = array();

			$email = $param['email'];
			$password = $param['password'];

			$sqlCmd = "SELECT user_id, email, password, firstname, lastname, 
							department_id, position, phone, local_phone 
						FROM user 
						WHERE email = '$email' 
						AND password = '$password'";
			$item = $this->dbservice_model->getObj($sqlCmd);

			if(count($item) != 0){
				if(!isset($_SESSION))
					session_start();

				$_SESSION = array(
					'user_id'=>$item["user_id"],
					'email'=>$item["email"],
					'password'=>$item["password"],
					'firstname'=>$item["firstname"],
					'lastname'=>$item["lastname"],
					'department_id'=>$item["department_id"],
					'position'=>$item["position"],
					'phone'=>$item["phone"],
					'local_phone'=>$item["local_phone"]
				);

				$itemList = $this->dbservice_model->messageInfo('successLogin');
			}else
				$itemList = $this->dbservice_model->messageInfo('errorLogin');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function logout(){
			$this->dbservice_model->destroySession();
		}

		public function getDropdownList($dataList){
			$itemList = array();

			foreach($dataList as $data){
				switch($data){
					case 'meetingRoomList':
						$sqlCmd = "SELECT meeting_room_id, meeting_room_name 
									FROM meeting_room 
									ORDER BY meeting_room_id";
						$itemList['meetingRoomList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'meetingTypeList':
						$sqlCmd = "SELECT meeting_type_id, meeting_type_name 
									FROM meeting_type 
									ORDER BY meeting_type_id";
						$itemList['meetingTypeList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'meetingTableTypeList':
						$sqlCmd = "SELECT meeting_table_type_id, meeting_table_type_name 
									FROM meeting_table_type 
									ORDER BY meeting_table_type_id";
						$itemList['meetingTableTypeList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'meetingRequiredList':
						$sqlCmd = "SELECT meeting_required_id, meeting_required_name 
									FROM meeting_required 
									ORDER BY meeting_required_id";
						$itemList['meetingRequiredList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'departmentList':
						$sqlCmd = "SELECT department_id, department_name 
									FROM department 
									ORDER BY department_id";
						$itemList['departmentList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'budgetTypeList':
						$sqlCmd = "SELECT budget_type_id, budget_type_name 
									FROM budget_type 
									ORDER BY budget_type_id";
						$itemList['budgetTypeList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'equipmentList':
						$sqlCmd = "SELECT equipment_id, equipment_name 
									FROM equipment 
									ORDER BY equipment_id";
						$itemList['equipmentList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'bookingStatusList':
						$sqlCmd = "SELECT booking_status_id, booking_status_name 
									FROM booking_status 
									ORDER BY booking_status_id";
						$itemList['bookingStatusList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					case 'permissionStatusList':
						$sqlCmd = "SELECT permission_status_id, permission_status_name 
									FROM permission_status 
									ORDER BY permission_status_id";
						$itemList['permissionStatusList'] = $this->dbservice_model->getListObj($sqlCmd);
						break;
					default: return false;
				}
			}

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function validateUnique($param){
			$item = array();
			$status = false;

			$tblName = $param['tblName'];
			$field = $param['fieldName'];
			$value = $param['param'];

			$sqlCmd = "SELECT COUNT($field) AS count_user 
						FROM $tblName 
						WHERE $field = '$value'";
			$item = $this->dbservice_model->getObj($sqlCmd);

			if($item['count_user'] > 0)
				$status = true;

			echo json_encode($status, JSON_UNESCAPED_UNICODE);
		}
	}
?>