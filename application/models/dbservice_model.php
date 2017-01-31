<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dbservice_model extends CI_Controller{
		public function __construct(){
			parent::__construct();

			//--Connect database
			global $mysqli;
			$configDb = get_instance()->db;

			$mysqli = mysqli_connect($configDb->hostname, $configDb->username, $configDb->password, $configDb->database);
			$mysqli->set_charset($configDb->char_set);

			if(mysqli_connect_error()){
				die('<b>Connect error</b>: '.mysqli_connect_errno().'<br><b>Parse error</b>: '.mysqli_connect_error());
				exit();
			}else
				return true;
		}

		//--Query sql command
		public function getQuery($sqlCmd){
			global $mysqli;

			if($mysqli->multi_query($sqlCmd))
				return true;
			else
				return false;
		}

		//--Get object item
		public function getObj($sqlCmd){
			global $mysqli;
			
			$query = $mysqli->query($sqlCmd) 
				or die('<b>SQL error</b>: \''.$sqlCmd.'\'<br><b>Parse error</b>: '.$mysqli->error);

			$item = $query->fetch_assoc();

			return $item;
		}

		//--Get array item
		public function getListObj($sqlCmd){
			global $mysqli;
			$itemList = array();
			
			$query = $mysqli->query($sqlCmd) 
				or die('<b>SQL error</b>: \''.$sqlCmd.'\'<br><b>Parse error</b>: '.$mysqli->error);

			while($item = $query->fetch_assoc()){
				array_push($itemList, $item);
			}

			return $itemList;
		}

		//--Get fieldname on table
		public function getFieldName($tblName){
			global $mysqli;
			$itemList = array();

			$sqlCmd = "SELECT * FROM $tblName LIMIT 1";
			$query = $mysqli->query($sqlCmd) 
				or die('<b>SQL error</b>: \''.$sqlCmd.'\'<br><b>Parse error</b>: '.$mysqli->error);

			while($item = $query->fetch_field()){
				array_push($itemList, $item);
			}

			return $itemList;
		}

		//--Insert data
		public function insertData($tblName, $dataList, $getLastInsertID = false){
			global $mysqli;

			if(array_key_exists(0, $dataList)){
				foreach($dataList as $data){
					$status = false;
					$fields = "";
					$values = "";
					$fieldIndex = 1;

					foreach($data as $key=>$val){
						if($fieldIndex != 1){
							$fields .= ", ";
							$values .= ", ";
						}
						$fields .= "$key";
						$values .= "'$val'";
						$fieldIndex++;
					}
					
					$sqlCmd = "INSERT INTO $tblName($fields) VALUES($values)";
					$status = $mysqli->query($sqlCmd);
					$lastInsertID = $mysqli->insert_id;
				}
			}else{
				$status = false;
				$fields = "";
				$values = "";
				$fieldIndex = 1;

				foreach($dataList as $key=>$val){
					if($fieldIndex != 1){
						$fields .= ", ";
						$values .= ", ";
					}
					$fields .= "$key";
					$values .= "'$val'";
					$fieldIndex++;
				}
				
				$sqlCmd = "INSERT INTO $tblName($fields) VALUES($values)";
				$status = $mysqli->query($sqlCmd);
				$lastInsertID = $mysqli->insert_id;
			}

			if($status){
				if($getLastInsertID)
					return array('status'=>true, 'lastInsertID'=>$lastInsertID);
				else
					return true;
			}else
				return false;
		}

		//--Insert data for sub table
		public function insertDataSubTable($tblName, $dataList){
			global $mysqli;

			if(array_key_exists(0, $dataList)){
				foreach($dataList as $data){
					$status = false;
					$subStatus = false;
					$fields = "";
					$values = "";
					$fieldIndex = 1;
					$subTableList = array();

					foreach($data as $key=>$val){
						if(is_array($val))
							array_push($subTableList, $val);
						else{
							if($fieldIndex != 1){
								$fields .= ", ";
								$values .= ", ";
							}
							$fields .= "$key";
							$values .= "'$val'";
							$fieldIndex++;
						}
					}

					$sqlCmd = "INSERT INTO $tblName($fields) VALUES($values)";
					$status = $mysqli->query($sqlCmd);
					$lastInsertID = $mysqli->insert_id;

					if(count($subTableList) > 0){
						foreach($subTableList as $subTable){
							$subTblName = $subTable['tblName'];
							$foreignKey = $subTable['foreignKey'];
							$subDataArr = $subTable['data'];

							foreach($subDataArr as $subData){
								$subFields = "";
								$subValues = "";
								$subFieldIndex = 1;

								foreach($subData as $subKey=>$subVal){
									if($subFieldIndex != 1){
										$subFields .= ", ";
										$subValues .= ", ";
									}
									$subFields .= "$subKey";
									$subValues .= "'$subVal'";
									$subFieldIndex++;
								}

								$subSqlCmd = "INSERT INTO $subTblName($subFields, $foreignKey) VALUES($subValues, '$lastInsertID')";
								$subStatus = $mysqli->query($subSqlCmd);
							}
						}
					}
				}
			}else{
				$status = false;
				$subStatus = false;
				$fields = "";
				$values = "";
				$fieldIndex = 1;
				$subTableList = array();

				foreach($dataList as $key=>$val){
					if(is_array($val))
						array_push($subTableList, $val);
					else{
						if($fieldIndex != 1){
							$fields .= ", ";
							$values .= ", ";
						}
						$fields .= "$key";
						$values .= "'$val'";
						$fieldIndex++;
					}
				}

				$sqlCmd = "INSERT INTO $tblName($fields) VALUES($values)";
				$status = $mysqli->query($sqlCmd);
				$lastInsertID = $mysqli->insert_id;

				if(count($subTableList) > 0){
					foreach($subTableList as $subTable){
						$subTblName = $subTable['tblName'];
						$foreignKey = $subTable['foreignKey'];
						$subDataArr = $subTable['data'];

						foreach($subDataArr as $subData){
							$subFields = "";
							$subValues = "";
							$subFieldIndex = 1;

							foreach($subData as $subKey=>$subVal){
								if($subFieldIndex != 1){
									$subFields .= ", ";
									$subValues .= ", ";
								}
								$subFields .= "$subKey";
								$subValues .= "'$subVal'";
								$subFieldIndex++;
							}

							$subSqlCmd = "INSERT INTO $subTblName($subFields, $foreignKey) VALUES($subValues, '$lastInsertID')";
							$subStatus = $mysqli->query($subSqlCmd);
						}
					}
				}
			}

			if(count($subTableList) > 0){
				if($status && $subStatus)
					return true;
				else
					return false;
			}else{
				if($status)
					return true;
				else
					return false;
			}
		}

		//--Update data
		public function updateData($tblName, $dataList){
			global $mysqli;

			if(array_key_exists(0, $dataList)){
				foreach($dataList as $data){
					$status = false;
					$update = "";
					$fieldIndex = 1;
					
					foreach($data as $key=>$val){
						if($key == 'condition')
							continue;
						else{
							if($fieldIndex != 1)
								$update .= ", ";

							$update .= "$key = '$val'";
							$fieldIndex++;
						}
					}

					if(!empty($update)){
						$update .= ", updated = CURRENT_TIMESTAMP";
						$sqlCmd = "UPDATE $tblName SET $update WHERE ".$data['condition'];
						$status = $mysqli->query($sqlCmd);
					}else
						$status = true;
				}
			}else{
				$status = false;
				$update = "";
				$fieldIndex = 1;

				foreach($dataList as $key=>$val){
					if($key == 'condition')
						continue;
					else{
						if($fieldIndex != 1)
							$update .= ", ";

						$update .= "$key = '$val'";
						$fieldIndex++;
					}
				}

				if(!empty($update)){
					$update .= ", updated = CURRENT_TIMESTAMP";
					$sqlCmd = "UPDATE $tblName SET $update WHERE ".$dataList['condition'];
					$status = $mysqli->query($sqlCmd);
				}else
					$status = true;
			}

			if($status)
				return true;
			else
				return false;
		}

		//--Update data for sub table
		public function updateDataSubTable($tblName, $dataList){
			global $mysqli;

			if(array_key_exists(0, $dataList)){
				foreach($dataList as $data){
					$status = false;
					$subStatus = false;
					$update = "";
					$fieldIndex = 1;
					$subTableList = array();
					
					foreach($data as $key=>$val){
						if($key == 'condition')
							continue;
						else{
							if(is_array($val))
								array_push($subTableList, $val);
							else{
								if($fieldIndex != 1)
									$update .= ", ";

								$update .= "$key = '$val'";
								$fieldIndex++;
							}
						}
					}

					if(!empty($update)){
						$update .= ", updated = CURRENT_TIMESTAMP";
						$sqlCmd = "UPDATE $tblName SET $update WHERE ".$data['condition'];
						$status = $mysqli->query($sqlCmd);
					}else
						$status = true;

					if(count($subTableList) > 0){
						foreach($subTableList as $subTable){
							$subTblName = $subTable['tblName'];
							$foreignKey = $subTable['foreignKey'];
							$subDataArr = $subTable['data'];

							if(array_key_exists(0, $subDataArr))
								$this->$subStatus = updateData($subTblName, $subDataArr);
							
							if(array_key_exists('insertData', $subDataArr))
								$this->$subStatus = insertData($subTblName, $subDataArr['insertData']);
							
							if(array_key_exists('deleteData', $subDataArr))
								$this->$subStatus = deleteDataList($subTblName, $subDataArr['deleteData']);
						}
					}
				}
			}else{
				$status = false;
				$subStatus = false;
				$update = "";
				$fieldIndex = 1;
				$subTableList = array();
				
				foreach($dataList as $key=>$val){
					if($key == 'condition')
						continue;
					else{
						if(is_array($val))
							array_push($subTableList, $val);
						else{
							if($fieldIndex != 1)
								$update .= ", ";

							$update .= "$key = '$val'";
							$fieldIndex++;
						}
					}
				}

				if(!empty($update)){
					$update .= ", updated = CURRENT_TIMESTAMP";
					$sqlCmd = "UPDATE $tblName SET $update WHERE ".$dataList['condition'];
					$status = $mysqli->query($sqlCmd);
				}else
					$status = true;

				if(count($subTableList) > 0){
					foreach($subTableList as $subTable){
						$subTblName = $subTable['tblName'];
						$foreignKey = $subTable['foreignKey'];
						$subDataArr = $subTable['data'];
						
						if(array_key_exists(0, $subDataArr))
							$subStatus = $this->updateData($subTblName, $subDataArr);

						if(array_key_exists('insertData', $subDataArr))
							$subStatus = $this->insertData($subTblName, $subDataArr['insertData']);

						if(array_key_exists('deleteData', $subDataArr))
							$subStatus = $this->deleteDataList($subTblName, $subDataArr['deleteData']);
					}
				}
			}

			if(count($subTableList) > 0){
				if($status && $subStatus)
					return true;
				else
					return false;
			}else{
				if($status)
					return true;
				else
					return false;
			}
		}

		//--Delete data
		public function deleteData($tblName, $condition){
			global $mysqli;

			$sqlCmd = "DELETE FROM $tblName WHERE $condition";

			if($mysqli->query($sqlCmd))
				return true;
			else
				return false;
		}

		//--Delete data for 
		public function deleteDataList($tblName, $dataList){
			global $mysqli;
			$sqlCmd = "";
			$status = false;

			if(count($dataList) != 0){
				/*foreach($dataList as $data){
					$condition = $data['condition'];
					$sqlCmd .= "DELETE FROM $tblName WHERE $condition; ";
				}

				if($mysqli->multi_query($sqlCmd))
					return true;
				else
					return false;*/
				
				foreach($dataList as $data){
					$condition = $data['condition'];
					$sqlCmd = "DELETE FROM $tblName WHERE $condition";
					$status = $mysqli->query($sqlCmd);
				}

				return $status;
			}else
				return true;
		}

		//--Delete file in folder
		public function deleteFile($pathFile, $itemList){
			$status = false;

			foreach($itemList as $item){
				foreach($item as $key=>$val){
					$status = unlink($pathFile.$val);
				}
			}

			if($status)
				return true;
			else
				return false;
		}

		//--Get message status 
		public function messageInfo($status){
			$itemList = array(
				'successLogin'=>array(
					'status'=>true,
					'msg'=>'บัญชีผู้ใช้ถูกต้อง'
				),
				'errorLogin'=>array(
					'status'=>false,
					'msg'=>'บัญชีผู้ใช้ไม่ถูกต้อง'
				),
				'successRegister'=>array(
					'status'=>true,
					'msg'=>'สมัครสมาชิกเรียบร้อย'
				),
				'errorRegister'=>array(
					'status'=>false,
					'msg'=>'ไม่สามารถสมัครสมาชิกได้'
				),
				'errorAlready'=>array(
					'status'=>true,
					'msg'=>'ข้อมูลซ้ำ'
				),
				'successInsert'=>array(
					'status'=>true,
					'msg'=>'บันทึกข้อมูลเรียบร้อย'
				),
				'errorInsert'=>array(
					'status'=>false,
					'msg'=>'ไม่สามารถบันทึกข้อมูลได้'
				),
				'successUpdate'=>array(
					'status'=>true,
					'msg'=>'แก้ไขข้อมูลเรียบร้อย'
				),
				'errorUpdate'=>array(
					'status'=>false,
					'msg'=>'ไม่สามารถแก้ไขข้อมูลได้'
				),
				'successDelete'=>array(
					'status'=>true,
					'msg'=>'ลบข้อมูลเรียบร้อย'
				),
				'errorDelete'=>array(
					'status'=>false,
					'msg'=>'ไม่สามารถลบข้อมูลได้'
				)
			);

			return $itemList[$status];
		}

		//--Create and get session
		public function getSession(){
			$item = array();

			if(!isset($_SESSION))
				session_start();

			if(isset($_SESSION['user_id'])){
				$item['user_id'] = $_SESSION['user_id'];
				$item['email'] = $_SESSION['email'];
				$item['password'] = $_SESSION['password'];
				$item['firstname'] = $_SESSION['firstname'];
				$item['lastname'] = $_SESSION['lastname'];
				$item['department_id'] = $_SESSION['department_id'];
				$item['position'] = $_SESSION['position'];
				$item['phone'] = $_SESSION['phone'];
				$item['local_phone'] = $_SESSION['local_phone'];

				$sqlCmd = "SELECT permission_id, p.user_id, p.menu_id, p.menu_sub_id, p.permission_status_id, 
								m.menu_name, ms.menu_sub_name, ps.permission_status_code AS perm_status 
							FROM permission p 
								INNER JOIN menu_sub ms 
									ON p.menu_sub_id = ms.menu_sub_id 
								INNER JOIN menu m 
									ON ms.menu_id = m.menu_id 
								INNER JOIN permission_status ps 
									ON p.permission_status_id = ps.permission_status_id 
							WHERE p.user_id = '".$_SESSION['user_id']."' 
							ORDER BY permission_id";
				$item['userPermissionData'] = $this->getListObj($sqlCmd);
			}else{
				$item['user_id'] = '';
				$item['email'] = '';
				$item['password'] = '';
				$item['firstname'] = '';
				$item['lastname'] = '';
				$item['department_id'] = '';
				$item['position'] = '';
				$item['phone'] = '';
				$item['local_phone'] = '';
			}

			return $item;
		}

		//--Destroy session
		public function destroySession(){
			if(!isset($_SESSION))
				session_start();

			if(isset($_SESSION['user_id'])){
				unset($_SESSION['user_id']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				unset($_SESSION['firstname']);
				unset($_SESSION['lastname']);
				unset($_SESSION['department_id']);
				unset($_SESSION['position']);
				unset($_SESSION['phone']);
				unset($_SESSION['local_phone']);
			}
		}
	}
?>