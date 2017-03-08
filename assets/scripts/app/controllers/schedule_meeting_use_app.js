angular.module('mainApp')
.controller('scheduleMeetingUseController', function($scope, $location, initService, dataService, connectDBService){
	//--Set initials
	console.log('This is Ctrl of page: scheduleMeetingUseController');
	initService.activeMenu();

	//--Function, Event on page load
	$(document).ready(function(){
		//--Schedule of booking
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: dataService.getCurrentDate(),
			defaultView: 'month',
			navLinks: true, 
			editable: false,
			eventLimit: true, 
			height: 500,
			fixedWeekCount: false,
			events: {
				url: 'schedule_meeting_use_ctrl'
			},
			eventRender: function(event, element) {
		      	$(element).tooltip({
		      		title: event.detail,
		      		container: 'body',
		      		placement: 'top',
		      	});
		  	},
		  	eventClick: function(event, element){
	            $('.tooltip').hide();    
	        }  
		});
	});
});