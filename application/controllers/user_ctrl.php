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
			$itemList = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>