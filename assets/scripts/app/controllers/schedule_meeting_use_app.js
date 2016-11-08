angular.module('mainApp')
.controller('scheduleMeetingUseController', function($scope, $location, initService, dataService, connectDBService){
	//--Set initials
	console.log('This is Ctrl of page: scheduleMeetingUseController');
	initService.activeMenu();

	//--Function, Event on page load
	$(document).ready(function(){
		//--Schedule of booking
		$scope.today = dataService.getCurrentDate();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: $scope.today,
			navLinks: true, 
			editable: true,
			eventLimit: true, 
			height: 500,
			fixedWeekCount: false,
			events: [
				{
					title: 'การประชุม',
					start: '2016-11-01'
				},
				{
					title: 'การประชุมยาว',
					start: '2016-11-07',
					end: '2016-11-10'
				}
			]
		});
	});
});