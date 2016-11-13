<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Booking_status_manage_ctrl extends CI_Controller{
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
			$bookingStatusID = $param['bookingStatusID'];
			$meetingRoomID = $param['meetingRoomID'];

			$sqlCmd = "SELECT booking_id, user_id, b.booking_status_id, bs.booking_status_code, bs.booking_status_name, 
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
						WHERE b.booking_status_id IN ('2', '4') ";

			if($startDate != '')
				$sqlCmd .= "AND '$startDate' >= start_date ";

			if($endDate != '')
				$sqlCmd .= "AND '$endDate' <= end_date ";

			if($bookingStatusID != '')
				$sqlCmd .= "AND b.booking_status_id = '$bookingStatusID' ";

			if($meetingRoomID != '')
				$sqlCmd .= "AND b.meeting_room_id = '$meetingRoomID' ";

			$sqlCmd .= "ORDER BY booking_id DESC";
			$itemList['bookingData'] = $this->dbservice_model->getListObj($sqlCmd);

			$itemCount = count($itemList['bookingData']);
			$perPage = 10;
			$itemList['totalPage'] = ceil($itemCount / $perPage);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function approveBooking($bookingID){
			$itemList = array();
			$status = false;

			$sqlCmd = "UPDATE booking 
						SET booking_status_id = '1', 
							updated = CURRENT_TIMESTAMP 
						WHERE booking_id = '$bookingID'";
			$status = $this->dbservice_model->getQuery($sqlCmd);

			if($status)
				$itemList = $this->dbservice_model->messageInfo('successUpdate');
			else
				$itemList = $this->dbservice_model->messageInfo('errorUpdate');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function approveCancelBooking($bookingID){
			$itemList = array();
			$status = false;

			$sqlCmd = "UPDATE booking 
						SET booking_status_id = '3', 
							updated = CURRENT_TIMESTAMP 
						WHERE booking_id = '$bookingID'";
			$status = $this->dbservice_model->getQuery($sqlCmd);

			if($status)
				$itemList = $this->dbservice_model->messageInfo('successUpdate');
			else
				$itemList = $this->dbservice_model->messageInfo('errorUpdate');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function notApproveBooking($bookingID){
			$itemList = array();
			$status = false;

			$sqlCmd = "UPDATE booking 
						SET booking_status_id = '5', 
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

			$sqlCmd = "SELECT booking_status_id, booking_status_name 
						FROM booking_status 
						WHERE booking_status_name IN ('รออนุมัติ', 'รอยกเลิก') 
						ORDER BY booking_status_id DESC";
			$itemList['bookingStatusList'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>