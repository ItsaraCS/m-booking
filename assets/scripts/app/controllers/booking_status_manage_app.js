angular.module('mainApp')
.controller('bookingStatusManageController', function($scope, $rootScope, $location, $state, $stateParams, initService, connectDBService, dataService){
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
		'booking_status_id': '',
		'metting_room_id': ''
	};
	$scope.stateParams = $stateParams;
	$scope.bookingStatusManagePage = $stateParams['bookingStatusManagePage'] || '1';
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

				if(sessionData['user_id'] != '' && sessionData['user_id'] != undefined)
					angular.copy(sessionData, $rootScope.entryUser);
				else
					$location.path('/login');
			}
		});
	}
	$scope.getSession();

	$scope.searchBooking = function(){
		var searchStartDate = '';
		var searchEndDate = '';
		if($scope.entrySearchBooking['start_date'] != '' && $scope.entrySearchBooking['start_date'] != undefined)
			var searchStartDate = dataService.getDateFormateForDB($scope.entrySearchBooking['start_date']);
		
		if($scope.entrySearchBooking['end_date'] != '' && $scope.entrySearchBooking['end_date'] != undefined)
			var searchEndDate = dataService.getDateFormateForDB($scope.entrySearchBooking['end_date']);

		var stateParams = { 
			'bookingStatusManagePage': '1', 
			'startDate': searchStartDate || '', 
			'endDate': searchEndDate || '',
			'bookingStatusID': $scope.entrySearchBooking['booking_status_id'] || '',
			'meetingRoomID': $scope.entrySearchBooking['meeting_room_id'] || ''
		};
		$state.go('จัดการสถานะการจอง', stateParams);
	}

	$scope.searchBookingByStateParams = function(){
		ajaxUrl = 'booking_status_manage_ctrl';
		param = {
			'funcName': 'searchBooking',
			'param': {
				'startDate': $stateParams['startDate'] || '',
				'endDate': $stateParams['endDate'] || '',
				'bookingStatusID': $stateParams['bookingStatusID'] || '',
				'meetingRoomID': $stateParams['meetingRoomID'] || ''
			}
		};
		
		connectDBService.query(ajaxUrl, param).success(function(response){
			$scope.searchBookingData = response['bookingData'];

			if($scope.searchBookingData.length != 0){
				$scope.totalPage = response['totalPage'];
				$scope.totalPageList = [];
				for(var i=1; i<=$scope.totalPage; i++){
					$scope.totalPageList.push({
						'bookingStatusManagePage': i,
						'startDate': $stateParams['startDate'] || '',
						'endDate': $stateParams['endDate'] || '',
						'bookingStatusID': $stateParams['bookingStatusID'] || '',
						'meetingRoomID': $stateParams['meetingRoomID'] || ''
					});
				}

				$scope.getBookingDataPerPage($stateParams['bookingStatusManagePage']);
			}else{
				$scope.resetEntry('entrySearchBooking');
				$scope.bookingData = [];
				$rootScope.msgWarningPopup = 'ไม่พบข้อมูล';
				$('.warning-popup').modal('show');
			}
		});
	}
	if($location.path() == '/booking_status_manage/' && $stateParams['bookingStatusManagePage'] != undefined)
		$scope.searchBookingByStateParams();

	$scope.getBookingDataPerPage = function(page = 1){
		var perPage = 10;
		var startPage = ((page - 1) * perPage);
		
		$scope.bookingData = [];
		for(var i=1; i<=perPage; i++){
			if(!$.isEmptyObject($scope.searchBookingData[startPage]))
				$scope.bookingData.push($scope.searchBookingData[startPage]);

			startPage++;
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
	if($location.path() == '/booking_status_manage/waitapprove' || $location.path() == '/booking_status_manage/waitcancel')
		$scope.getBookingDetailData();

	$scope.approveBooking = function(bookingID){
		if(bookingID != '' && bookingID != undefined){
			ajaxUrl = 'booking_status_manage_ctrl';
			param = {
				'funcName': 'approveBooking',
				'param': bookingID
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');
					console.log($rootScope.previousParams);
					if(statusData['status'])
						$state.go('จัดการสถานะการจอง', $rootScope.previousParams);
				}
			});
		}
	}

	$scope.approveCancelBooking = function(bookingID){
		if(bookingID != '' && bookingID != undefined){
			ajaxUrl = 'booking_status_manage_ctrl';
			param = {
				'funcName': 'approveCancelBooking',
				'param': bookingID
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');
					
					if(statusData['status'])
						$state.go('จัดการสถานะการจอง', $rootScope.previousParams);
				}
			});
		}
	}

	$scope.notApproveBooking = function(bookingID){
		if(bookingID != '' && bookingID != undefined){
			ajaxUrl = 'booking_status_manage_ctrl';
			param = {
				'funcName': 'notApproveBooking',
				'param': bookingID
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');
					
					if(statusData['status'])
						$state.go('จัดการสถานะการจอง', $rootScope.previousParams);
				}
			});
		}
	}

	$scope.deleteBooking = function(bookingID){
		if(bookingID != '' && bookingID != undefined){
			ajaxUrl = 'booking_ctrl';
			param = {
				'funcName': 'deleteBooking',
				'param': bookingID
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');

					if(statusData['status'])
						$scope.searchBookingByStateParams();
				}
			});
		}
	}

	$scope.getDropdownList = function(){
		//--Get default dropdown list
		$scope.meetingRoomList = [];
		dataService.getDropdownList($scope, [
			'meetingRoomList'
		]);

		//--Get custom dropdown list
		$scope.bookingStatusList = [];
		ajaxUrl = 'booking_status_manage_ctrl';
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

	$scope.resetEntry = function(entry, form){
		if(entry != '' && entry != undefined)
        	$scope[entry] = {};

        if(form != '' && form != undefined)
        	$scope[form].$setPristine();
    }

	//--Function, Event on page load
	$(document).ready(function(){
		//--Datepicker
		$.datepicker.regional['th'] = {
	        dateFormat: 'dd/mm/yy',
			changeMonth: true,
	    	changeYear: true,
	    	yearOffSet: 543
	    };
		$.datepicker.setDefaults($.datepicker.regional['th']);
		$('.datepicker').datepicker($.datepicker.regional["th"]);
		$('.datepicker').datepicker("setDate", new Date());

		$(document).on('click', '#datepicker-from-btn, #datepicker-to-btn', function(e){
			$(this).closest('.input-group').find('input').focus();
		});
	});
});