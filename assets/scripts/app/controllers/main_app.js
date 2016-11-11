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
	$rootScope.userPermission = {};
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
					$rootScope.statusMenu = {
						'menu1': false,
						'menu2': false,
						'menu3': false,
						'menu4': false,
						'menu5': false,
						'menu6': false,
						'menu7': false,
						'menu8': false,
						'menu9': false,
						'menu10': false,
						'menu11': false,
						'menu12': false
					};
					$scope.getUserPermissionData();
				}else{
					$rootScope.statusMenu = {
						'menu1': true,
						'menu2': false,
						'menu3': false,
						'menu4': true,
						'menu5': false,
						'menu6': true,
						'menu7': false,
						'menu8': true,
						'menu9': true,
						'menu10': true,
						'menu11': false,
						'menu12': false
					};
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

			$rootScope.statusMenu = {
				'menu1': ($rootScope.userPermissionData[0]['perm_status'] != 'DN'),
				'menu2': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[1]['perm_status'] != 'DN')),
				'menu3': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[2]['perm_status'] != 'DN')),
				'menu4': ($rootScope.userPermissionData[3]['perm_status'] != 'DN'),
				'menu5': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[4]['perm_status'] == 'R/W')),
				'menu6': ($rootScope.userPermissionData[5]['perm_status'] != 'DN'),
				'menu7': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[6]['perm_status'] != 'DN')),
				'menu8': ($rootScope.userPermissionData[7]['perm_status'] != 'DN'),
				'menu9': (!$rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[8]['perm_status'] != 'DN')),
				'menu10': (!$rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[9]['perm_status'] != 'DN')),
				'menu11': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[10]['perm_status'] != 'DN')),
				'menu12': ($rootScope.entryUser['user_id'] && ($rootScope.userPermissionData[11]['perm_status'] == 'R/W'))
			};

			$.each($rootScope.userPermissionData, function(idx, item){
				$rootScope.userPermission[idx] = item;
			});
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
						$rootScope.msgWarningPopup = statusData['msg'];
						$('.warning-popup').modal('show');
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

		//--Set initial for 'password' input
    	$(document).on('focus', 'form[name="loginForm"] input[name="password"]', function(e){
			$(this).prop('type', 'text');
		});

		$(document).on('blur', 'form[name="loginForm"] input[name="password"]', function(e){
			if($(this).val() != '')
				$(this).prop('type', 'password');
		});

		//--Focus next input on 'enter' key press
		$('.next-focus').eq(0).focus();
		$(document).on('keydown', '.next-focus', function(e){
			if(e.keyCode === 13){
				var index = $('.next-focus').index(this) + 1;
             	$('.next-focus').eq(index).focus();
			}
		});

		//--Hide modal on 'enter' key press
		$(window).on('keypress', function(e){
			if(($('.modal').is(':visible')) && (e.keyCode === 13)){
			    $('.modal').modal('hide');
			    $('.next-focus').eq(0).focus();
			};
		});
    });
});