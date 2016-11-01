angular.module('mainApp', ['ui.router']);

angular.module('mainApp')
.controller('mainController', function($scope, initService){
	console.log('This is Ctrl of page: mainController');
	initService.activeMenu();

	$(document).ready(function(){
		//--Active menu on window resize
    	$(window).on('resize', function(e){
			initService.activeMenu();
		});
    });
});