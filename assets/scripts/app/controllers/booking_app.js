angular.module('mainApp')
.controller('bookingController', function($scope, initService){
	console.log('This is Ctrl of page: bookingController');
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

		//--Timepicker
		$('.timepicker').timepicker({
			timeOnlyTitle: 'เลือกเวลา',
			timeText: 'เวลา',
			hourText: 'ชั่วโมง',
			minuteText: 'นาที',
			currentText: 'ขณะนี้',
			closeText: 'ตกลง',
			showSecond: false,
    		showTimezone: false
		});

		$(document).on('click', '#timepicker-from-btn, #timepicker-to-btn', function(e){
			$(this).closest('.input-group').find('input').focus();
		});

		//--Set element on load and resize page
		setResizePage();
		$(window).on('resize', function(e){
			setResizePage();
		});

		function setResizePage(){
			var sizeInputGroupAddon = $('.section-booking').find('.col-inline span.input-group-addon').outerWidth();
			var sizeInputGroupAddonFluid = $('.section-booking').find('.col-inline .input-group-addon-fluid');
			$(sizeInputGroupAddonFluid).css({ 'width': sizeInputGroupAddon });
		}
	});
});