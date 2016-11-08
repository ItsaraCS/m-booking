angular.module('mainApp')
.controller('meetingDetailController', function($scope, $location, initService, connectDBService){
	//--Set initials
	console.log('This is Ctrl of page: meetingDetailController');
	initService.activeMenu();

	//--Declar variables
	var ajaxUrl = 'meeting_detail_ctrl';
	var param = {
		'funcName': '',
		'param': ''
	};
	$scope.meetingDetailData = [];

	//-Function
	$scope.getMeetingDetailData = function(){
		param['funcName'] = 'getMeetingDetailData';

		connectDBService.query(ajaxUrl, param).success(function(response){
			if(response != "" && response != undefined){
				var itemList = response;
				angular.copy(itemList['meetingDetailData'], $scope.meetingDetailData);
			}
		});
	}
	$scope.getMeetingDetailData();
});