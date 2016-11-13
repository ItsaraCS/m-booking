angular.module('mainApp')
.controller('bookingController', function($scope, $rootScope, $location, $state, $stateParams, initService, connectDBService, dataService){
	//--Set initials
	console.log('This is Ctrl of page: bookingController');
	initService.activeMenu();
	initService.setResizePage();

	//--Declar variables
	var ajaxUrl = 'booking_ctrl';
	var param = {
		'funcName': '',
		'param': ''
	};
	$scope.entryBooking = {
		'meeting_room_id': '',
		'meeting_type_id': '',
		'start_date': '',
		'end_date': '',
		'start_time': '',
		'end_time': '',
		'meeting_topic': '',
		'meeting_number': '',
		'meeting_detail': '',
		'department_id': '',
		'meeting_table_type_id': '',
		'meeting_required_id': '',
		'budget_type_id': '',
		'entryBookingEquipment': {}
	};
	$scope.currentLocation = $location.path();
	console.log($scope.currentLocation);
	$scope.stateParams = $stateParams;
	$rootScope.$on('$stateChangeSuccess', function(ev, next, nextParams, previous, previousParams){
	    $rootScope.previousParams = previousParams;
	});

	//-Function
	$scope.getSession = function(){
		ajaxUrl = 'dbservice_ctrl';
		param = {
			'funcName': 'getSession',
			'param': ''
		};

		connectDBService.query(ajaxUrl, param).success(function(response){
			if(response != '' && response != undefined){
				var sessionData = response;

				if(sessionData['user_id'] != '' && sessionData['user_id'] != undefined){
					angular.copy(sessionData, $rootScope.entryUser);
					$scope.getUserPermissionData();
				}else
					$location.path('/login');
			}
		});
	}
	$scope.getSession();

	$scope.getUserPermissionData = function(){
		ajaxUrl = 'dbservice_ctrl';
		param = {
			'funcName': 'getUserPermissionData',
			'param': $rootScope.entryUser['user_id']
		};
		
		connectDBService.query(ajaxUrl, param).success(function(response){
			angular.copy(response, $rootScope.userPermissionData);
		});
	}

	$scope.insertBooking = function(){
		if(!$.isEmptyObject($scope.entryBooking)){
			$scope.entryBooking['booking_status_id'] = '2';
			$scope.entryBooking['start_date'] = dataService.getDateFormateForDB($scope.entryBooking['start_date']);
			$scope.entryBooking['end_date'] = dataService.getDateFormateForDB($scope.entryBooking['end_date']);
			$scope.entryBooking['user_id'] = $rootScope.entryUser['user_id'];

			var entryBookingEquipmentList = [];
			$.each($scope.entryBooking['entryBookingEquipment'], function(key, value){
				if(value == true){
					entryBookingEquipmentList.push({
						'equipment_id': key
					});
				}
			});

			if(entryBookingEquipmentList.length != 0){
				$scope.entryBooking['entryBookingEquipment'] = {
					'tblName': 'booking_equipment',
					'foreignKey': 'booking_id',
					'data': entryBookingEquipmentList
				};
			}else{
				$scope.entryBooking = dataService.filterObjNoUsed($scope.entryBooking, [
					'entryBookingEquipment'
				]);
			}

			ajaxUrl = 'booking_ctrl';
			param = {
				'funcName': 'insertBooking',
				'param': {
					'tblName': 'booking',
					'data': $scope.entryBooking
				}
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					if(statusData['status'])
						$scope.resetEntry('entryBooking', 'bookingForm');

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');
				}
			});
		}
	}

	$scope.getBookingDetailData = function(){
		if($stateParams['bookingID'] != '' && $stateParams['bookingID'] != undefined){
			ajaxUrl = 'booking_ctrl';
			param = {
				'funcName': 'getBookingDetailData',
				'param': $stateParams['bookingID']
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					$scope.bookingDetailData = {};
					angular.copy(response, $scope.bookingDetailData);
				}
			});
		}
	}
	if($location.path() == '/booking_show/showCancelBooking' || 
		$location.path() == '/booking_show/showSearchBooking' || 
		$location.path() == '/booking_show/showManageStatusBooking'){
		$scope.getBookingDetailData();
	}

	$scope.getDropdownList = function(){
		//--Get default dropdown list
		$scope.meetingRoomList = [];
		$scope.meetingTypeList = [];
		$scope.meetingTableTypeList = []; 
		$scope.meetingRequiredList = [];
		$scope.departmentList = []; 
		$scope.budgetTypeList = []; 
		$scope.equipmentList = [];
		$scope.bookingStatusList = [];
		dataService.getDropdownList($scope, [
			'meetingRoomList',
			'meetingTypeList',
			'meetingTableTypeList',
			'meetingRequiredList',
			'departmentList',
			'budgetTypeList',
			'equipmentList',
			'bookingStatusList'
		]);
	}
	$scope.getDropdownList();

	$scope.resetEntry = function(entry, form){
		if(entry != '' && entry != undefined)
        	$scope[entry] = {};

        if(form != '' && form != undefined)
        	$scope[form].$setPristine();
    }

    //--Function, Event on page load
	$(document).ready(function(){
		//--Datepicker
		$('.datepicker').datepicker({ 
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
	    	changeYear: true
		});

		$(document).on('click', '#datepicker-from-btn, #datepicker-to-btn', function(e){
			$(this).closest('.input-group').find('input').focus();
		});

		//--Timepicker
		$('.timepicker').timepicker({
			timeOnlyTitle: 'เลือกเวลา',
			timeText: 'เวลา',
			hourText: 'ชั่วโมง',
			minuteText: 'นาที',
			currentText: 'ขณะนี้',
			closeText: 'ตกลง',
			showSecond: false,
    		showTimezone: false
		});

		$(document).on('click', '#timepicker-from-btn, #timepicker-to-btn', function(e){
			$(this).closest('.input-group').find('input').focus();
		});

		//--Set element on load and resize page
		$(window).on('resize', function(e){
			initService.setResizePage();
		});
	});
});