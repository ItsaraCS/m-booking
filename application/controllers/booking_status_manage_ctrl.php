<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Booking_status_manage_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->library('email');
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

			if($status){
				$sqlCmd = "SELECT u.email, u.firstname, u.lastname, d.department_name, b.meeting_topic, mr.meeting_room_name, mt.meeting_type_name,
								CONCAT(
									'วันที่ ', 
									CASE SUBSTRING(DATE_FORMAT(b.start_date, '%d'), 1, 1) 
								       WHEN '0' THEN SUBSTRING(DATE_FORMAT(b.start_date, '%d'), 2, 1)
								       ELSE DATE_FORMAT(b.start_date, '%d')
								       END, ' ', 
									CASE DATE_FORMAT(b.start_date, '%m') 
										WHEN '01' THEN 'ม.ค.' 
										WHEN '02' THEN 'ก.พ.' 
										WHEN '03' THEN 'มี.ค.' 
										WHEN '04' THEN 'เม.ย.' 
										WHEN '05' THEN 'พ.ค.' 
										WHEN '06' THEN 'มิ.ย.' 
										WHEN '07' THEN 'ก.ค.' 
										WHEN '08' THEN 'ส.ค.' 
										WHEN '09' THEN 'ก.ย.' 
										WHEN '10' THEN 'ต.ค.' 
										WHEN '11' THEN 'พ.ย.' 
										WHEN '12' THEN 'ธ.ค.' 
										END, ' ', 
									(DATE_FORMAT(b.start_date, '%Y')+543), 
									' เวลา ', TIME_FORMAT(b.start_time, '%H:%i'), ' น.'
									' ถึง ', 
									CASE SUBSTRING(DATE_FORMAT(b.end_date, '%d'), 1, 1) 
								       WHEN '0' THEN SUBSTRING(DATE_FORMAT(end_date, '%d'), 2, 1)
								       ELSE DATE_FORMAT(end_date, '%d')
								       END, ' ', 
									CASE DATE_FORMAT(b.end_date, '%m') 
										WHEN '01' THEN 'ม.ค.' 
										WHEN '02' THEN 'ก.พ.' 
										WHEN '03' THEN 'มี.ค.' 
										WHEN '04' THEN 'เม.ย.' 
										WHEN '05' THEN 'พ.ค.' 
										WHEN '06' THEN 'มิ.ย.' 
										WHEN '07' THEN 'ก.ค.' 
										WHEN '08' THEN 'ส.ค.' 
										WHEN '09' THEN 'ก.ย.' 
										WHEN '10' THEN 'ต.ค.' 
										WHEN '11' THEN 'พ.ย.' 
										WHEN '12' THEN 'ธ.ค.' 
										END, ' ', 
									(DATE_FORMAT(b.end_date, '%Y')+543), 
									' เวลา ', TIME_FORMAT(b.end_time, '%H:%i'), ' น.'
								) AS date_used
							FROM user u
                            INNER JOIN booking b
                                ON u.department_id = b.department_id
                            INNER JOIN meeting_room mr
                            	ON b.meeting_room_id = mr.meeting_room_id
                            INNER JOIN meeting_type mt
                            	ON b.meeting_type_id = mt.meeting_type_id
                            INNER JOIN department d 
								ON u.department_id = d.department_id
                            WHERE u.department_id = (
                            	SELECT u.department_id 
                                FROM booking b
                                INNER JOIN user u
                                	ON u.user_id = b.user_id
                                WHERE booking_id = '$bookingID'
                            )
                            AND b.booking_id = '$bookingID'
							ORDER BY u.user_id";
				$userData = $this->dbservice_model->getListObj($sqlCmd);

				/*$config['useragent'] = 'Eiamheng';
		        $config['protocol'] = 'smtp';
		        $config['smtp_host'] = 'smtp-relay.gmail.com';  
		        $config['smtp_user'] = 'itsara.ra.cs@gmail.com';  
		        $config['smtp_pass'] = 'IT1501033a';  
		        $config['smtp_port'] = '25';  
		        $config['smtp_crypto'] = 'tls';*/
		        $config['mailtype'] = 'html';
	            $config['wordwrap'] = true;
	            $config['newline'] = "\r\n";
		        $this->email->initialize($config);

				foreach($userData as $user){
					$emailTo = $user['email'];
					$emailSubject = 'ขอเชิญเข้าร่วม'.$user['meeting_type_name'].'เรื่อง "'.$user['meeting_topic'].'"';
					$emailHeader = 'eiamheng-support@gmail.com';
					$emailMessage = '<b>เรียนคุณ '.$user['firstname'].'</b><br><br> ';
					$emailMessage .= 'ขอเชิญคุณ '.$user['firstname'].' '.$user['lastname'].' ';
					$emailMessage .= 'แผนก '.$user['department_name'].' ';
					$emailMessage .= 'เข้าร่วมประชุมในหัวข้อเรื่อง "'.$user['meeting_topic'].'" ';
					$emailMessage .= 'ใน'.$user['date_used'].' ';
					$emailMessage .= 'ณ '.$user['meeting_room_name'].' ';
					$emailMessage .= '<br><br>จึงเรียนมาเพื่อทราบ<br><b>ขอบคุณค่ะ<b>';

					$this->email->from($emailHeader, 'Eiamheng');   
		        	$this->email->to($emailTo, $user['firstname']); //$this->email->to('demo@localhost.com', 'Demo User');
		        	$this->email->subject($emailSubject); 
		        	$this->email->message($emailMessage);  
		        	$emailStatus = $this->email->send();
					
					if(!$emailStatus)
						$status = false;
				}
			}

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