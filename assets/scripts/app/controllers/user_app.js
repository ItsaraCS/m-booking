angular.module('mainApp')
.controller('userController', function($scope, $rootScope, $location, $state, $stateParams, initService, connectDBService, dataService){
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
	$scope.entryUserinfo = {
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
	$scope.entryUserinfoOrigin = {};
	$scope.entrySearchUser = {
		'firstname': '',
		'email': ''
	};
	$scope.entryUserData = {};
	$scope.entryUserPermissionData = [];
	$scope.entryUserPermissionDataOrigin = [];
	$scope.msgWarningPopup = '';
	$scope.permissionPage = $stateParams['permissionPage'] || '1';
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
					angular.copy(sessionData, $scope.entryUserinfoOrigin);
					angular.copy(sessionData, $scope.entryUserinfo);
					$scope.getUserPermissionData();
				}else
					if($location.path() == '/userinfo' || $location.path() == '/permission' ||
						$location.path() == '/permission/' || $location.path() == '/permission_manage/'+ $stateParams['userID'])
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

	$scope.register = function(){
		if(!$.isEmptyObject($scope.entryRegister)){
			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'register',
				'param': {
					'tblName': 'user',
					'data': $scope.entryRegister
				}
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var statusData = response;

					if(statusData['status'])
						$scope.resetEntry('entryRegister', 'registerForm');

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');
				}
			});
		}
	}

	$scope.searchUser = function(){
		var stateParams = { 
			'permissionPage': '1', 
			'firstname': $scope.entrySearchUser['firstname'] || '', 
			'email': $scope.entrySearchUser['email'] || '' 
		};
		$state.go('ตั้งค่าสิทธิ์การใช้งาน', stateParams);
	}

	$scope.searchUserByStateParams = function(){
		ajaxUrl = 'user_ctrl';
		param = {
			'funcName': 'searchUser',
			'param': {
				'firstname': $stateParams['firstname'] || '',
				'email': $stateParams['email'] || ''
			}
		};
		
		connectDBService.query(ajaxUrl, param).success(function(response){
			$scope.searchUserData = response['userData'];

			if($scope.searchUserData.length != 0){
				$scope.totalPage = response['totalPage'];
				$scope.totalPageList = [];
				for(var i=1; i<=$scope.totalPage; i++){
					$scope.totalPageList.push({
						'permissionPage': i,
						'firstname': $stateParams['firstname'] || '',
						'email': $stateParams['email'] || ''
					});
				}

				$scope.getUserDataPerPage($stateParams['permissionPage']);
			}else{
				$scope.resetEntry('entrySearchUser');
				$scope.userData = [];
				$rootScope.msgWarningPopup = 'ไม่พบข้อมูล';
				$('.warning-popup').modal('show');
			}
		});
	}
	if($location.path() == '/permission/' && $stateParams['permissionPage'] != undefined)
		$scope.searchUserByStateParams();

	$scope.getUserDataPerPage = function(page = 1){
		var perPage = 10;
		var startPage = ((page - 1) * perPage);
		
		$scope.userData = [];
		for(var i=1; i<=perPage; i++){
			if(!$.isEmptyObject($scope.searchUserData[startPage]))
				$scope.userData.push($scope.searchUserData[startPage]);

			startPage++;
		}
	}

	$scope.getUserPermissionDetailData = function(){
		if($stateParams['userID'] != '' && $stateParams['userID'] != undefined){
			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'getUserPermissionDetailData',
				'param': $stateParams['userID']
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					var userData = response;
					
					angular.copy(userData, $scope.entryUserData);
					angular.copy(userData['userPermissionData'], $scope.entryUserPermissionDataOrigin);
					angular.copy(userData['userPermissionData'], $scope.entryUserPermissionData);
				}
			});
		}
	}
	if($location.path() == '/permission_manage/'+ $stateParams['userID'])
		$scope.getUserPermissionDetailData();

	$scope.updateUserPermission = function(){
		$scope.entryUserPermissionDataUpdate = [];
		$scope.entryUserPermissionDataUpdate = dataService.getDataArrChange(
			$scope.entryUserPermissionDataOrigin,
			$scope.entryUserPermissionData, 
			'permission_id'
		);

		if($scope.entryUserPermissionDataUpdate.length != 0){
			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'updateUserPermission',
				'param': {
					'tblName': 'permission',
					'data': $scope.entryUserPermissionDataUpdate,
					'userID': $stateParams['userID'] || '1'
				}
			};

			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response.length != 0){
					if(response['statusData']['status']){
						$scope.entryUserPermissionDataOrigin = [];
						$scope.entryUserPermissionData = [];
						angular.copy(response['userPermissionData'], $scope.entryUserPermissionDataOrigin);
						angular.copy(response['userPermissionData'], $scope.entryUserPermissionData);
					}

					$rootScope.msgWarningPopup = response['statusData']['msg'];
					$('.warning-popup').modal('show');
				}
			});
		}else{
			$rootScope.msgWarningPopup = 'ยังไม่มีการแก้ไขข้อมูล';
			$('.warning-popup').modal('show');
		}
	}

	$scope.updateUserinfo = function(){
		$scope.entryUserinfoUpdate = {};
		$scope.entryUserinfoUpdate = dataService.getDataObjChange(
			$scope.entryUserinfoOrigin,
			$scope.entryUserinfo,
			'user_id'
		);

		if(!$.isEmptyObject($scope.entryUserinfoUpdate)){

			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'updateUserinfo',
				'param': {
					'tblName': 'user',
					'data': $scope.entryUserinfoUpdate,
					'userID': $scope.entryUserinfo['user_id'] || '1'
				}
			};

			connectDBService.query(ajaxUrl, param).success(function(response){
				if(response != '' && response != undefined){
					if(response['statusData']['status']){
						$scope.entryUserinfoOrigin = {};
						$scope.entryUserinfo = {};
						angular.copy(response['userinfoData'], $scope.entryUserinfoOrigin);
						angular.copy(response['userinfoData'], $scope.entryUserinfo);
					}

					$rootScope.msgWarningPopup = response['statusData']['msg'];
					$('.warning-popup').modal('show');
				}
			});
		}else{
			$rootScope.msgWarningPopup = 'ยังไม่มีการแก้ไขข้อมูล';
			$('.warning-popup').modal('show');
		}
	}

	$scope.deleteUser = function(userID){
		if(userID != '' && userID != undefined){
			ajaxUrl = 'user_ctrl';
			param = {
				'funcName': 'deleteUser',
				'param': userID
			};
			
			connectDBService.query(ajaxUrl, param).success(function(response){
				console.log(response);
				if(response != '' && response != undefined){
					var statusData = response;

					$rootScope.msgWarningPopup = statusData['msg'];
					$('.warning-popup').modal('show');

					if(statusData['status'])
						$scope.searchUserByStateParams();
				}
			});
		}
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
});