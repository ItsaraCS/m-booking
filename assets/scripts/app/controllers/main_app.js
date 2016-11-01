angular.module('mainApp', ['ui.router']);

angular.module('mainApp')
.controller('mainController', function($scope, initService){
	console.log('This is Ctrl of page: mainController');
	initService.activeMenu();
});