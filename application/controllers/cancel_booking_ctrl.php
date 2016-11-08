<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cancel_booking_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');
		}

		public function index(){
			$data = json_decode(file_get_contents('php://input'), true);
			$this->$data['funcName']($data['param']);
		}

		public function getDropdownList(){
			$itemList = array();

			$sqlCmd = "SELECT meeting_room_id, meeting_room_name ";
			$sqlCmd .= "FROM meeting_room ";
			$sqlCmd .= "ORDER BY meeting_room_id";
			$itemList['meetingRoomList'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>