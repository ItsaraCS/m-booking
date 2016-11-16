<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Schedule_meeting_use_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');    
		}

		public function index(){
			if($_GET){
				$itemList = array();

				$sqlCmd = "SELECT booking_id AS id, meeting_topic AS title, meeting_detail AS detail, start_date AS start, end_date AS end, 
								CONCAT('#/booking_show/showScheduleMeetingUse?bookingID=', booking_id) AS url, 
								CASE booking_status_id 
									WHEN '1' THEN '#4D90FD'
									WHEN '2' THEN '#dfa63b'
									WHEN '3' THEN '#B3624D'
									WHEN '4' THEN '#a44769'
									WHEN '5' THEN '#ED5B56'
								END AS color
							FROM booking
							WHERE DATE(start_date) >= '".$_GET['start']."'
							AND DATE(end_date) <= '".$_GET['end']."'
							ORDER BY booking_id DESC";
				$itemList = $this->dbservice_model->getListObj($sqlCmd);

				echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
			}
		}
	}
?>