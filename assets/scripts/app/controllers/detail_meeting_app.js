angular.module('mainApp')
.controller('detailMeetingController', function($scope, initService){
	console.log('This is Ctrl of page: detailMeetingController');
	initService.activeMenu();
});