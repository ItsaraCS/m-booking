angular.module('mainApp')
.controller('scheduleTodayController', function($scope, initService, dataService){
	console.log('This is Ctrl of page: scheduleTodayController');
	initService.activeMenu();

	$scope.today = dataService.getCurrentDateTH();
});