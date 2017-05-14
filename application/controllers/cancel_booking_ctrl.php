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

		public function searchBooking($param){
			$itemList = array();

			$startDate = $param['startDate'];
			$endDate = $param['endDate'];
			$meetingRoomID = $param['meetingRoomID'];

			$sqlCmd = "SELECT booking_id, user_id, bs.booking_status_code, bs.booking_status_name, 
							CONCAT(
								'จาก ', 
								CASE SUBSTRING(DATE_FORMAT(start_date, '%d'), 1, 1) 
							       WHEN '0' THEN SUBSTRING(DATE_FORMAT(start_date, '%d/'), 2, 2)
							       ELSE DATE_FORMAT(start_date, '%d/')
							       END, 
								DATE_FORMAT(start_date, '%m/'), 
								(DATE_FORMAT(start_date, '%y')+43), 
								' (', TIME_FORMAT(start_time, '%H:%i'), 
								') ถึง ', 
								CASE SUBSTRING(DATE_FORMAT(end_date, '%d'), 1, 1) 
							       WHEN '0' THEN SUBSTRING(DATE_FORMAT(end_date, '%d/'), 2, 2)
							       ELSE DATE_FORMAT(end_date, '%d/')
							       END, 
								DATE_FORMAT(end_date, '%m/'), 
								(DATE_FORMAT(end_date, '%y')+43), 
								' (', TIME_FORMAT(end_time, '%H:%i'), 
								')'
							) AS date_used, 
							m.meeting_room_name 
						FROM booking b 
							INNER JOIN booking_status bs 
								ON b.booking_status_id = bs.booking_status_id 
							INNER JOIN meeting_room m 
								ON b.meeting_room_id = m.meeting_room_id 
						WHERE b.booking_status_id = '1' ";

			if($startDate != '')
				$sqlCmd .= "AND start_date >= '$startDate' ";

			if($endDate != '')
				$sqlCmd .= "AND end_date <= '$endDate' ";

			if($meetingRoomID != '')
				$sqlCmd .= "AND b.meeting_room_id = '$meetingRoomID' ";

			$sqlCmd .= "ORDER BY booking_id DESC";
			$itemList['bookingData'] = $this->dbservice_model->getListObj($sqlCmd);

			$itemCount = count($itemList['bookingData']);
			$perPage = 10;
			$itemList['totalPage'] = ceil($itemCount / $perPage);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function cancelBooking($bookingID){
			$itemList = array();
			$status = false;

			$sqlCmd = "UPDATE booking 
						SET booking_status_id = '4', 
							updated = CURRENT_TIMESTAMP 
						WHERE booking_id = '$bookingID'";
			$status = $this->dbservice_model->getQuery($sqlCmd);

			if($status)
				$itemList = $this->dbservice_model->messageInfo('successUpdate');
			else
				$itemList = $this->dbservice_model->messageInfo('errorUpdate');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function getDropdownList(){
			$itemList = array();

			$sqlCmd = "SELECT meeting_room_id, meeting_room_name 
						FROM meeting_room 
						ORDER BY meeting_room_id";
			$itemList['meetingRoomList'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>