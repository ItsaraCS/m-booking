angular.module('mainApp')
.controller('userController', function($scope, initService){
	console.log('This is Ctrl of page: userController');
	initService.activeMenu();

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
		'id': '',
		'email': '',
		'password': '',
		'firstname': '',
		'lastname': '',
		'department_id': '',
		'position': '',
		'phone': '',
		'local_phone': ''
	};

	$scope.resetEntry = function(entry){
        $scope[entry] = {};
    }
});