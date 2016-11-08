angular.module('mainApp')
.controller('searchBookingController', function($scope, $location, initService, connectDBService, dataService){
	//--Set initials
	console.log('This is Ctrl of page: searchBookingController');
	initService.activeMenu();

	//--Declar variables
	var ajaxUrl = 'search_booking_ctrl';
	var param = {
		'funcName': '',
		'param': ''
	};
	$scope.entrySearchBooking = {
		'start_date': '',
		'end_date': '',
		'status_id': '',
		'metting_room_id': ''
	};

	//-Function
	$scope.getDropdownList = function(){
		//--Get default dropdown list
		$scope.meetingRoomList = [];
		$scope.bookingStatusList = [];
		dataService.getDropdownList($scope, [
			'meetingRoomList',
			'bookingStatusList'
		]);
	}
	$scope.getDropdownList();

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
	});
});