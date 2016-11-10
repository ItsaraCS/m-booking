angular.module('mainApp')
.controller('bookingStatusManageController', function($scope, $rootScope, $location, initService, connectDBService, dataService){
	//--Set initials
	console.log('This is Ctrl of page: bookingStatusManageController');
	initService.activeMenu();

	//--Declar variables
	var ajaxUrl = 'booking_status_manage_ctrl';
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
					console.log($rootScope.entryUser);
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
			console.log($rootScope.userPermissionData);
		});
	}

	$scope.getDropdownList = function(){
		//--Get default dropdown list
		$scope.meetingRoomList = [];
		dataService.getDropdownList($scope, [
			'meetingRoomList'
		]);

		//--Get custom dropdown list
		$scope.bookingStatusList = [];
		param['funcName'] = 'getDropdownList';

		connectDBService.query(ajaxUrl, param).success(function(response){
			if(response != "" && response != undefined){
				var itemList = response;
				$scope.bookingStatusList = [];
				angular.copy(itemList['bookingStatusList'], $scope.bookingStatusList);
			}
		});
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