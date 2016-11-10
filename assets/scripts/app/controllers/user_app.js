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
	$scope.entryRegisterData = [];
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
	$scope.entryUserinfoData = [];
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

	$scope.getUserDataPerPage = function(page = 1){
		var perPage = 3;
		var startPage = ((page - 1) * perPage);
		
		$scope.userData = [];
		for(var i=1; i<=perPage; i++){
			if(!$.isEmptyObject($scope.searchUserData[startPage]))
				$scope.userData.push($scope.searchUserData[startPage]);

			startPage++;
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
				$scope.msgWarningPopup = 'ไม่พบข้อมูลผู้ใช้';
				$('.warning-popup').appendTo("body").modal('show');
			}
		});
	}
	if($location.path() == '/permission/')
		$scope.searchUserByStateParams();

	if($location.path() == '/permission_manage/'+ $stateParams['userID']){
		ajaxUrl = 'user_ctrl';
		param = {
			'funcName': 'getUserPermissionDataForManage',
			'param': $stateParams['userID']
		};
		
		connectDBService.query(ajaxUrl, param).success(function(response){
			if(response != '' && response != undefined){
				angular.copy(response['userData'], $scope.entryUserData);
				angular.copy(response['userPermissionData'], $scope.entryUserPermissionDataOrigin);
				angular.copy(response['userPermissionData'], $scope.entryUserPermissionData);
			}
		});
	}

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
				if(response.length != '' && response != undefined){
					if(response['statusData']['status']){
						$scope.entryUserPermissionDataOrigin = [];
						$scope.entryUserPermissionData = [];
						angular.copy(response['userPermissionData'], $scope.entryUserPermissionDataOrigin);
						angular.copy(response['userPermissionData'], $scope.entryUserPermissionData);
					}

					$scope.msgWarningPopup = response['statusData']['msg'];
					$('.warning-popup').appendTo("body").modal('show');
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