angular.module('mainApp')
.controller('userController', function($scope, $rootScope, $location, initService, connectDBService, dataService){
	//--Set initials
	console.log('This is Ctrl of page: userController');
	initService.activeMenu();

	//--Declar variables
	var ajaxUrl = 'user_ctrl';
	var param = {
		'funcName': '',
		'param': ''
	};
	$scope.entryLogin = {
		'email': '',
		'password': ''
	};
	$scope.entryRegister = {
		'email': '',
		'password': '',
		'firstname': '',
		'lastname': '',
		'department_id': '',
		'position': '',
		'phone': '',
		'local_phone': ''
	};
	$scope.entryRegisterData = [];
	$scope.entryUserinfo = $rootScope.entryUser;
	$scope.entryUserinfoData = [];
	$scope.entrySearchUser = {
		'firstname': '',
		'email': ''
	};
	$scope.msgWarningPopup = '';
	
	//-Function
	$scope.register = function(){
		if(!$.isEmptyObject($scope.entryRegister)){
			$scope.entryRegisterData = [];
			$scope.entryRegisterData.push($scope.entryRegister);

			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'register',
				'param': {
					'tblName': 'user',
					'data': $scope.entryRegisterData
				}
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != "" && response != undefined){
					var statusData = response;

					$scope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').appendTo("body").modal('show');

					$scope.resetEntry('entryRegister', 'registerForm');
				}
			});
		}
	}

	$scope.searchUser = function(){
		ajaxUrl = 'user_ctrl';
		param = {
			'funcName': 'searchUser',
			'param': {
				'firstname': $scope.entrySearchUser.firstname || '',
				'email': $scope.entrySearchUser.email || ''
			}
		};
		
		connectDBService.query(ajaxUrl, param).success(function(response){
			$scope.userData = response;
			console.log($scope.userData);

			if($scope.userData.length == 0){
				$scope.resetEntry('entrySearchUser');
				$scope.msgWarningPopup = 'ไม่พบข้อมูลผู้ใช้';
				$('.warning-popup').appendTo("body").modal('show');
			}
		});
	}

	$scope.getDropdownList = function(){
		//--Get default dropdown list
		$scope.departmentList = [];
		$scope.permissionStatusList = [];
		dataService.getDropdownList($scope, [
			'departmentList',
			'permissionStatusList'
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
    	//--Set initial for 'password' input
    	$(document).on('focus', 'form[name="loginForm"] input[name="password"]', function(e){
			$(this).attr('type', 'text');
		});

		$(document).on('blur', 'form[name="loginForm"] input[name="password"]', function(e){
			if($(this).val() != '')
				$(this).attr('type', 'password');
		});
    });
});