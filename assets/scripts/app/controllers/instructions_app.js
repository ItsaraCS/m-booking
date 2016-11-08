angular.module('mainApp')
.controller('instructionsController', function($scope, $location, initService, connectDBService){
	//--Set initials
	console.log('This is Ctrl of page: instructionsController');
	initService.activeMenu();
});