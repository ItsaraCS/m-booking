<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Booking_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();

			$this->load->model('dbservice_model');
		}

		public function index(){
			$data = json_decode(file_get_contents('php://input'), true);
			$this->$data['funcName']($data['param']);
		}

		public function insertBooking($param){
			$itemList = array();
			$status = false;

			$tblName = $param['tblName'];
			$dataList = $param['data'];

			$status = $this->dbservice_model->insertDataSubTable($tblName, $dataList);

			if($status)
				$itemList = $this->dbservice_model->messageInfo('successInsert');
			else
				$itemList = $this->dbservice_model->messageInfo('errorInsert');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function updateBooking($param){
			$itemList = array();
			$status = false;

			$tblName = $param['tblName'];
			$dataList = $param['data'];
			$bookingID = $param['bookingID'];

			$status = $this->dbservice_model->updateDataSubTable($tblName, $dataList);

			if($status){
				$itemList['bookingData'] = $this->getBookingData($bookingID, false);
				$itemList['info'] = $this->dbservice_model->messageInfo('successInsert');
			}else
				$itemList['info'] = $this->dbservice_model->messageInfo('errorInsert');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}

		public function getBookingData($bookingID, $returnJSON = true){
			$item = array();
			
			$sqlCmd = "SELECT booking_id, user_id, meeting_room_id, meeting_type_id, 
							CONCAT(DATE_FORMAT(start_date, '%d/'), 
								DATE_FORMAT(start_date, '%m/'), 
								(DATE_FORMAT(start_date, '%Y') + 543)
							) AS start_date, 
							TIME_FORMAT(start_time, '%H:%i') AS start_time, 
							CONCAT(DATE_FORMAT(end_date, '%d/'), 
								DATE_FORMAT(end_date, '%m/'), 
								(DATE_FORMAT(end_date, '%Y') + 543)
							) AS end_date, 
							TIME_FORMAT(end_time, '%H:%i') AS end_time, meeting_topic, meeting_number, meeting_detail, department_id, 
							meeting_table_type_id, meeting_required_id, budget_type_id
						FROM booking	
						WHERE booking_id = '$bookingID'";
			$item = $this->dbservice_model->getObj($sqlCmd);

			$sqlCmd = "SELECT equipment_id 
						FROM equipment";
			$equipmentList = array();
			$equipmentList = $this->dbservice_model->getListObj($sqlCmd);

			$sqlCmd = "SELECT booking_equipment_id, equipment_id, booking_id
						FROM booking_equipment
						WHERE booking_id = '$bookingID'";
			$bookingEquipmentList = array();
			$bookingEquipmentList = $this->dbservice_model->getListObj($sqlCmd);

			$item['entryBookingEquipment']['tblName'] = 'booking_equipment';
			$item['entryBookingEquipment']['foreignKey'] = 'booking_id';
			$item['entryBookingEquipment']['data'] = array();
			foreach($equipmentList as $key=>$equipment){
				$item['entryBookingEquipment']['data'][$key]['equipment_id'] = 0;
				$item['entryBookingEquipment']['data'][$key]['booking_id'] = $bookingID;

				foreach($bookingEquipmentList as $bookingEquipment){
					if($equipment['equipment_id'] == $bookingEquipment['equipment_id']){
						$item['entryBookingEquipment']['data'][$key]['booking_equipment_id'] = $bookingEquipment['booking_equipment_id'];
						$item['entryBookingEquipment']['data'][$key]['equipment_id'] = ($key + 1);
					}
				}
			}
			
			if(!$returnJSON)
				return $item;
			
			echo json_encode($item, JSON_UNESCAPED_UNICODE);
		}

		public function getBookingDetailData($bookingID){
			$item = array();
			$itemList = array();

			$sqlCmd = "SELECT booking_id, u.user_id, m.meeting_room_name, bs.booking_status_name, 
							CONCAT(
								CASE SUBSTRING(DATE_FORMAT(start_date, '%d'), 1, 1) 
							       WHEN '0' THEN SUBSTRING(DATE_FORMAT(start_date, '%d'), 2, 1)
							       ELSE DATE_FORMAT(start_date, '%d')
							       END, 
							       ' ', 
								CASE DATE_FORMAT(start_date, '%m') 
									WHEN '01' THEN 'มกราคม' 
									WHEN '02' THEN 'กุมภาพันธ์' 
									WHEN '03' THEN 'มีนาคม' 
									WHEN '04' THEN 'เมษายน' 
									WHEN '05' THEN 'พฤษภาคม' 
									WHEN '06' THEN 'มิถุนายน' 
									WHEN '07' THEN 'กรกฎาคม' 
									WHEN '08' THEN 'สิงหาคม' 
									WHEN '09' THEN 'กันยายน' 
									WHEN '10' THEN 'ตุลาคม' 
									WHEN '11' THEN 'พฤศจิกายน' 
									WHEN '12' THEN 'ธันวาคม' 
									END, ' ', 
								(DATE_FORMAT(start_date, '%Y')+543), 
								' เวลา ', TIME_FORMAT(start_time, '%H:%i'), ' น.'
							) AS start_datetime, 
							CONCAT(
								CASE SUBSTRING(DATE_FORMAT(end_date, '%d'), 1, 1) 
							       WHEN '0' THEN SUBSTRING(DATE_FORMAT(end_date, '%d'), 2, 1)
							       ELSE DATE_FORMAT(end_date, '%d')
							       END, 
							       ' ', 
								CASE DATE_FORMAT(end_date, '%m') 
									WHEN '01' THEN 'มกราคม' 
									WHEN '02' THEN 'กุมภาพันธ์' 
									WHEN '03' THEN 'มีนาคม' 
									WHEN '04' THEN 'เมษายน' 
									WHEN '05' THEN 'พฤษภาคม' 
									WHEN '06' THEN 'มิถุนายน' 
									WHEN '07' THEN 'กรกฎาคม' 
									WHEN '08' THEN 'สิงหาคม' 
									WHEN '09' THEN 'กันยายน' 
									WHEN '10' THEN 'ตุลาคม' 
									WHEN '11' THEN 'พฤศจิกายน' 
									WHEN '12' THEN 'ธันวาคม' 
									END, ' ', 
								(DATE_FORMAT(end_date, '%Y')+543), 
								' เวลา ', TIME_FORMAT(end_time, '%H:%i'), ' น.'
							) AS end_datetime, 
							meeting_topic, mt.meeting_type_name, meeting_number, meeting_detail, d.department_name, 
							CONCAT(
								u.firstname, ' (', 
								CASE u.phone 
									WHEN '' THEN u.local_phone 
									ELSE u.phone 
									END, 
								')'
							) AS booking_user, 
							mtt.meeting_table_type_name, bt.budget_type_name, mr.meeting_required_name, m.meeting_room_img 
						FROM booking b 
							INNER JOIN booking_status bs 
								ON b.booking_status_id = bs.booking_status_id 
							INNER JOIN meeting_room m 
								ON b.meeting_room_id = m.meeting_room_id 
							INNER JOIN meeting_type mt 
								ON b.meeting_type_id = mt.meeting_type_id 
							INNER JOIN department d 
								ON b.department_id = d.department_id 
							INNER JOIN user u 
								ON b.user_id = u.user_id 
							INNER JOIN meeting_table_type mtt 
								ON b.meeting_table_type_id = mtt.meeting_table_type_id 
							INNER JOIN budget_type bt 
								ON b.budget_type_id = bt.budget_type_id 
							INNER JOIN meeting_required mr 
								ON b.meeting_required_id = mr.meeting_required_id 
						WHERE booking_id = '$bookingID'";
			$item = $this->dbservice_model->getObj($sqlCmd);

			$sqlCmd = "SELECT e.equipment_name 
						FROM booking_equipment be 
							INNER JOIN equipment e 
								ON be.equipment_id = e.equipment_id 
						WHERE booking_id = '$bookingID'";
			$itemList = $this->dbservice_model->getListObj($sqlCmd);

			$equipmentName = "";
			foreach($itemList as $idx=>$equipmentItem){
				if($idx != 0)
					$equipmentName .= ", ";

				$equipmentName .= (string)$equipmentItem['equipment_name'];
			}

			if($equipmentName != "")
				$item['equipment_name'] = $equipmentName;

			echo json_encode($item, JSON_UNESCAPED_UNICODE);
		}

		public function deleteBooking($bookingID){
			$itemList = array();
			$status = false;

			$sqlCmd = "DELETE FROM booking_equipment 
						WHERE booking_id = '$bookingID'; ";
			$sqlCmd .= "DELETE FROM booking 
						WHERE booking_id = '$bookingID'";
			$status = $this->dbservice_model->getQuery($sqlCmd);

			if($status)
				$itemList = $this->dbservice_model->messageInfo('successDelete');
			else
				$itemList = $this->dbservice_model->messageInfo('errorDelete');

			echo json_encode($itemList, JSON_UNESCAPED_UNICODE);
		}
	}
?>