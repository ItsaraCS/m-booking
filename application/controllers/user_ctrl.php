<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');
		}

		public function index(){
			$data = json_decode(file_get_contents('php://input'), true);
			$this->$data['funcName']($data['param']);
		}

		public function register($param){
			$itemList = array();
			$status = false;

			$tblName = $param['tblName'];
			$dataList = $param['data'];
			$statusInsertUser = array();
			$statusInsertUser = $this->dbservice_model->insertData($tblName, $dataList, true);
			
			if($statusInsertUser['status']){
				$sqlCmd = "SELECT menu_sub_id, menu_sub_name, menu_id ";
				$sqlCmd .= "FROM menu_sub ";
				$sqlCmd .= "ORDER BY menu_sub_id";
				$menuSubData = array();
				$menuSubData = $this->dbservice_model->getListObj($sqlCmd);

				$permissionData = array();
				foreach($menuSubData as $menuSub){
					if($menuSub['menu_sub_name'] == 'จัดการสถานะการจอง' ||
						$menuSub['menu_sub_name'] == 'ตั้งค่าสิทธิ์การใช้งาน'){

						$permission_status_id = '3' ;
					}else
						$permission_status_id = '2' ;

					$item = array(
						'user_id'=>$statusInsertUser['lastInsertID'],
						'menu_id'=>$menuSub['menu_id'],
						'menu_sub_id'=>$menuSub['menu_sub_id'],
						'permission_status_id'=>$permission_status_id,
					);

					array_push($permissionData, $item);
				}
				
				$status = $this->dbservice_model->insertData('permission', $permissionData);

				if($status)
					$itemList = $this->dbservice_model->messageInfo('successRegister');
				else
					$itemList = $this->dbservice_model->messageInfo('errorRegister');

				echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
			}
		}

		public function searchUser($param){
			$item = array();
			$itemList = array();

			$firstname = $param['firstname'];
			$email = $param['email'];

			$sqlCmd = "SELECT user_id, email, firstname, lastname, ";
			$sqlCmd .= "d.department_name, position, phone, local_phone ";
			$sqlCmd .= "FROM user u ";
			$sqlCmd .= "INNER JOIN department d ";
			$sqlCmd .= "ON u.department_id = d.department_id ";
			$sqlCmd .= "WHERE firstname LIKE '%$firstname%' ";
			$sqlCmd .= "OR email = '$email' ";
			$sqlCmd .= "ORDER BY user_id";
			$itemList['userData'] = $this->dbservice_model->getListObj($sqlCmd);

			$item = count($itemList['userData']);
			$perPage = 3;
			$itemList['totalPage'] = ceil($item / $perPage);


			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function getUserPermissionDataForManage($userID){
			$itemList = array();

			$sqlCmd = "SELECT user_id, email, firstname, lastname, ";
			$sqlCmd .= "d.department_name, position, phone, local_phone ";
			$sqlCmd .= "FROM user u ";
			$sqlCmd .= "INNER JOIN department d ";
			$sqlCmd .= "ON u.department_id = d.department_id ";
			$sqlCmd .= "WHERE user_id = '$userID' ";
			$sqlCmd .= "ORDER BY user_id";
			$itemList['userData'] = $this->dbservice_model->getObj($sqlCmd);

			$sqlCmd = "SELECT permission_id, p.user_id, p.menu_id, p.menu_sub_id, p.permission_status_id, ";
			$sqlCmd .= "m.menu_name, ms.menu_sub_name, ps.permission_status_code AS perm_status ";
			$sqlCmd .= "FROM permission p ";
			$sqlCmd .= "INNER JOIN menu_sub ms ";
			$sqlCmd .= "ON p.menu_sub_id = ms.menu_sub_id ";
			$sqlCmd .= "INNER JOIN menu m ";
			$sqlCmd .= "ON ms.menu_id = m.menu_id ";
			$sqlCmd .= "INNER JOIN permission_status ps ";
			$sqlCmd .= "ON p.permission_status_id = ps.permission_status_id ";
			$sqlCmd .= "WHERE p.user_id = '".$userID."' ";
			$sqlCmd .= "ORDER BY permission_id";
			$itemList['userPermissionData'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function updateUserPermission($param){
			$itemList = array();
			$status = false;

			$tblName = $param['tblName'];
			$dataList = $param['data'];
			$userID = $param['userID'];
			$status = $this->dbservice_model->updateData($tblName, $dataList);

			if($status){
				$sqlCmd = "SELECT permission_id, p.user_id, p.menu_id, p.menu_sub_id, p.permission_status_id, ";
				$sqlCmd .= "m.menu_name, ms.menu_sub_name, ps.permission_status_code AS perm_status ";
				$sqlCmd .= "FROM permission p ";
				$sqlCmd .= "INNER JOIN menu_sub ms ";
				$sqlCmd .= "ON p.menu_sub_id = ms.menu_sub_id ";
				$sqlCmd .= "INNER JOIN menu m ";
				$sqlCmd .= "ON ms.menu_id = m.menu_id ";
				$sqlCmd .= "INNER JOIN permission_status ps ";
				$sqlCmd .= "ON p.permission_status_id = ps.permission_status_id ";
				$sqlCmd .= "WHERE p.user_id = '".$userID."' ";
				$sqlCmd .= "ORDER BY permission_id";
				$itemList['userPermissionData'] = $this->dbservice_model->getListObj($sqlCmd);

				$itemList['statusData'] = $this->dbservice_model->messageInfo('successUpdate');
			}else
				$itemList['statusData'] = $this->dbservice_model->messageInfo('errorUpdate');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function updateUserinfo($param){
			$itemList = array();
			$status = false;

			$tblName = $param['tblName'];
			$dataList = $param['data'];
			$userID = $param['userID'];
			$status = $this->dbservice_model->updateData($tblName, $dataList);

			if($status){
				$sqlCmd = "SELECT user_id, email, password, firstname, lastname, ";
				$sqlCmd .= "department_id, position, phone, local_phone ";
				$sqlCmd .= "FROM user ";
				$sqlCmd .= "WHERE user_id = '$userID' ";
				$sqlCmd .= "ORDER BY user_id";
				$itemList['userinfoData'] = $this->dbservice_model->getObj($sqlCmd);

				if(!isset($_SESSION))
					session_start();

				$_SESSION = array(
					'user_id'=>$itemList['userinfoData']["user_id"],
					'email'=>$itemList['userinfoData']["email"],
					'password'=>$itemList['userinfoData']["password"],
					'firstname'=>$itemList['userinfoData']["firstname"],
					'lastname'=>$itemList['userinfoData']["lastname"],
					'department_id'=>$itemList['userinfoData']["department_id"],
					'position'=>$itemList['userinfoData']["position"],
					'phone'=>$itemList['userinfoData']["phone"],
					'local_phone'=>$itemList['userinfoData']["local_phone"]
				);

				$itemList['statusData'] = $this->dbservice_model->messageInfo('successUpdate');
			}else
				$itemList['statusData'] = $this->dbservice_model->messageInfo('errorUpdate');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>