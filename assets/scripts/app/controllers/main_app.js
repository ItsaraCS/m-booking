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
				}
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

	$scope.login = function(){
		if(!$.isEmptyObject($scope.entryLogin)){
			ajaxUrl = 'dbservice_ctrl';
			param = {
				'funcName': 'login',
				'param': $scope.entryLogin
			};

			$rootScope.userPermissionData = [];
			for(var i=1; i<12; i++){
				$rootScope.userPermissionData.push({
					'perm_status': 'DN'
				});
			}

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
			initService.setResizePage();
		});

    	//--Set autofocus for 'email' input
		$('form[name="loginForm"] input[name="email"]').focus();

		//--Set initial for 'password' input
    	$(document).on('focus', 'form[name="loginForm"] input[name="password"]', function(e){
			$(this).prop('type', 'text');
		});

		$(document).on('blur', 'form[name="loginForm"] input[name="password"]', function(e){
			if($(this).val() != '')
				$(this).prop('type', 'password');
		});

		//--Call 'login' function when press enter key
		$(window).on('keypress', function(e){
			if(e.keyCode == 13){
				var selectorEmail = $('form[name="loginForm"] input[name="email"]');
				var selectorPassword = $('form[name="loginForm"] input[name="password"]');

				if(selectorEmail.val() != '' && selectorPassword.val() != '')
					$scope.login();
			}
		});
    });
});