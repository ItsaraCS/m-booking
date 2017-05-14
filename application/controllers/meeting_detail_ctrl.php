<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Meeting_detail_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');
		}

		public function index(){
			$data = json_decode(file_get_contents('php://input'), true);
			$this->$data['funcName']($data['param']);
		}

		public function getMeetingDetailData(){
			$itemList = array();

			$sqlCmd = "SELECT meeting_room_id, meeting_room_name, meeting_room_size, meeting_room_location, meeting_room_detail, meeting_room_img 
						FROM meeting_room 
						ORDER BY meeting_room_id";
			$itemList['meetingDetailData'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>