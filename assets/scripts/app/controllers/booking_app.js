angular.module('mainApp')
.controller('bookingController', function($scope, $location, $stateParams, initService, connectDBService, dataService){
	//--Set initials
	console.log('This is Ctrl of page: bookingController');
	initService.activeMenu($stateParams);
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
		'equipment_list': []
	};
	$scope.currentLocation = $location.path();
	$scope.stateParams = $stateParams;

	//-Function
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

	$scope.insertData = function(){
		console.log($scope.entryBooking);
	}

	$scope.resetEntry = function(entry){
        $scope[entry] = {};
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