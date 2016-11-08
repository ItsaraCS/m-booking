angular.module('mainApp', ['ui.router']);

angular.module('mainApp')
.controller('mainController', function($scope, $rootScope, $location, initService, connectDBService){
	//--Set initials
	console.log('This is Ctrl of page: mainController');
	initService.activeMenu();

	//--Declar variables
	var ajaxUrl = 'dbservice_ctrl';
	var param = {
		'funcName': '',
		'param': ''
	};
	$rootScope.entryUser = {
		'user_id': '',
		'email': '',
		'password': '',
		'firstname': '',
		'lastname': '',
		'department_id': '',
		'position': '',
		'phone': '',
		'local_phone': ''
	};
	$rootScope.userPermissionData = [];

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
					$location.path("/login");
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

	$scope.login = function(){
		if(!$.isEmptyObject($scope.entryLogin)){
			ajaxUrl = 'dbservice_ctrl';
			param = {
				'funcName': 'login',
				'param': $scope.entryLogin
			};

			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != "" && response != undefined){
					var statusData = response;

					$scope.resetEntry('entryLogin', 'loginForm');

					if(statusData['status']){
						$scope.getSession();
						$location.path('/schedule_meeting_use');
					}else{
						$scope.msgWarningPopup = statusData['msg'];
						$('.warning-popup').appendTo("body").modal('show');
					}
				}
			});
		}
	}

	$scope.logout = function(){
		ajaxUrl = 'dbservice_ctrl';
		param = {
			'funcName': 'logout',
			'param': ''
		};

		connectDBService.query(ajaxUrl, param).success(function(){
			$rootScope.entryUser = {};
			$location.path("/login");
		});
	}

	$scope.resetEntry = function(entry, form){
		if(entry != '' && entry != undefined)
        	$scope[entry] = {};

        if(form != '' && form != undefined)
        	$scope[form].$setPristine();
    }

	//--Function, Event on page load
	$(document).ready(function(){
		//--Active menu on window resize
    	$(window).on('resize', function(e){
			initService.activeMenu();
		});
    });
});