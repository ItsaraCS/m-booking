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

		public function getDropdownList(){
			$itemList = array();

			$sqlCmd = "SELECT booking_status_id, booking_status_name ";
			$sqlCmd .= "FROM booking_status ";
			$sqlCmd .= "WHERE booking_status_name IN ('รออนุมัติ', 'รอยกเลิก') ";
			$sqlCmd .= "ORDER BY booking_status_id";
			$itemList['bookingStatusList'] = $this->dbservice_model->getListObj($sqlCmd);

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>