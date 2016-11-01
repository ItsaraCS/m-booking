angular.module('mainApp')
.controller('searchBookingController', function($scope, initService){
	console.log('This is Ctrl of page: searchBookingController');
	initService.activeMenu();

	$(document).ready(function(){
		//--Datepicker
		$('.datepicker').datepicker({ 
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
	    	changeYear: true
		});

		$(document).on('click', '#datepicker-from-btn, #datepicker-to-btn', function(e){
			$(this).closest('.input-group').find('input').focus();
		});
	});
});